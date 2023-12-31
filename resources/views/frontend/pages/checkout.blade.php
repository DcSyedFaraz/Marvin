@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('content')


    <section class="checkout-div-1">
        <h2 class="Shopping-heading">Checkout</h2>
        <div class="checkout-div-2">
            <div class="container">
            <form class="form" method="POST" action="{{route('cart.order')}}" id="payment-form">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="checkout-form">
                            <h3 class="billing-text">Billing Details</h3>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="checkout-form-label">First name: *</label>
                                        <input type="text" name="first_name" value="{{old('first_name')}}" class="billing-name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="checkout-form-label">Last name: *</label>
                                        <input type="text" name="last_name" class="billing-name" value="{{old('last_name')}}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="checkout-form-label">Company name (optional)</label>
                                        <input type="text" name="company_name" value="{{old('company_name')}}" class="billing-name">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="checkout-form-label">Country: *</label>
                                        <select id="country" class="billing-name" name="country" required>
                                            <option>Select Country</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="AX">Aland Islands</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctica</option>
                                            <option value="AG">Antigua and Barbuda</option>
                                            <option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia</option>
                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BA">Bosnia and Herzegovina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="BN">Brunei Darussalam</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verde</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos (Keeling) Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo, Democratic Republic of the Congo</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="CI">Cote D'Ivoire</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curacao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea-Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard Island and Mcdonald Islands</option>
                                            <option value="VA">Holy See (Vatican City State)</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran, Islamic Republic of</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">Isle of Man</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">Korea, Democratic People's Republic of</option>
                                            <option value="KR">Korea, Republic of</option>
                                            <option value="XK">Kosovo</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Lao People's Democratic Republic</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libyan Arab Jamahiriya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                                            <option value="MG">Madagascar</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia, Federated States of</option>
                                            <option value="MD">Moldova, Republic of</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">Montenegro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="AN">Netherlands Antilles</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">Norfolk Island</option>
                                            <option value="MP">Northern Mariana Islands</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PS">Palestinian Territory, Occupied</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papua New Guinea</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Reunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="BL">Saint Barthelemy</option>
                                            <option value="SH">Saint Helena</option>
                                            <option value="KN">Saint Kitts and Nevis</option>
                                            <option value="LC">Saint Lucia</option>
                                            <option value="MF">Saint Martin</option>
                                            <option value="PM">Saint Pierre and Miquelon</option>
                                            <option value="VC">Saint Vincent and the Grenadines</option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">San Marino</option>
                                            <option value="ST">Sao Tome and Principe</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="CS">Serbia and Montenegro</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra Leone</option>
                                            <option value="SG">Singapore</option>
                                            <option value="SX">Sint Maarten</option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">Solomon Islands</option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                                            <option value="SS">South Sudan</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">Sri Lanka</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard and Jan Mayen</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="SY">Syrian Arab Republic</option>
                                            <option value="TW">Taiwan, Province of China</option>
                                            <option value="TJ">Tajikistan</option>
                                            <option value="TZ">Tanzania, United Republic of</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">Timor-Leste</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinidad and Tobago</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">Turkmenistan</option>
                                            <option value="TC">Turks and Caicos Islands</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="GB">United Kingdom</option>
                                            <option value="US">United States</option>
                                            <option value="UM">United States Minor Outlying Islands</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="UZ">Uzbekistan</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VE">Venezuela</option>
                                            <option value="VN">Viet Nam</option>
                                            <option value="VG">Virgin Islands, British</option>
                                            <option value="VI">Virgin Islands, U.s.</option>
                                            <option value="WF">Wallis and Futuna</option>
                                            <option value="EH">Western Sahara</option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="checkout-form-label">Street address: *</label>
                                        <input type="text" class="billing-name" name="address" value="{{old('addrss')}}" placeholder="House number and street name" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="checkout-form-label">Postcode / ZIP (optional)</label>
                                        <input type="text" name="zip_code" value="{{old('zip_code')}}" class="billing-name">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="checkout-form-label">Town / City: *</label>
                                        <input type="text" name="city" value="{{old('city')}}" class="billing-name" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="checkout-form-label">Phone: *</label>
                                        <input type="text" name="phone" value="{{old('phone')}}" class="billing-name" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="checkout-form-label">Email address: *</label>
                                        <input type="email" name="email" value="{{old('email')}}" class="billing-name" required>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" value="{{old('another_ship')}}" name="another_ship" name="mycheckbox" type="checkbox"
                                                id="mycheckbox">
                                            <label class="form-check-label create-acc" for="mycheckbox">
                                                Ship to a different address?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 shipchange" id="toggle-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="checkout-form-label">Street address: *</label>
                                                <input type="text" value="{{old('another_address')}}" name="another_address" class="billing-name"
                                                    placeholder="House number and street name" >
                                            </div>
                                            <div class="col-md-12">
                                                <label class="checkout-form-label">Postcode / ZIP</label>
                                                <input type="text" value="{{old('another_zip')}}" name="another_zip" class="billing-name" >
                                            </div>
                                            <div class="col-md-12">
                                                <label class="checkout-form-label">Town / City: *</label>
                                                <input type="text" value="{{old('another_city')}}" name="another_city" class="billing-name" >
                                            </div>
                                            <div class="col-md-12">
                                                <label class="checkout-form-label">Phone: *</label>
                                                <input type="number" value="{{old('another_phone')}}" name="another_phone" class="billing-name" >
                                            </div>
                                            <div class="col-md-12">
                                                <label class="checkout-form-label">Email address: *</label>
                                                <input type="email" value="{{old('another_email')}}" name="another_email" class="billing-name" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="checkout-form-label">Order notes (optional)</label>
                                        <textarea rows="8" value="{{old('note')}}" name="note" class="billing-name1"
                                            placeholder="Note about your orders, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        
                        <h3 class="billing-text">Your Order</h3>
                        <div class="product-total-div">
                            <div class="product-total-div1">
                                <h2 class="txt-pro">Product</h2>
                                <!--<h2 class="txt-pro">total</h2>-->
                            </div>
							@php 
							$total = 0;
							@endphp
                            @if(Helper::getAllProductFromCart())
							
						        @foreach(Helper::getAllProductFromCart() as $key=>$cart)
							        <?php $total += $cart->amount ?>
                                    <div class="product-total-div2">
                                        <h3 class="txt-pro1">{{$cart->product['title']}} ({{$cart->quantity}})</h3>
                                        <h3 class="txt-pro2">${{number_format($cart['price'],2)}}</h3>
                                    </div>
                                @endforeach
                            @endif
                            <br>
                            <div class="single-widget">
                                    <h2>Payments</h2>
                                    <div class="content">
                                        <div class="checkbox">
                                            {{-- <label class="checkbox-inline" for="1"><input name="updates" id="1" type="checkbox"> Check Payments</label> --}}
                                            <select onchange="next()" class="form-control" name="payment_method" id="payment_method">
                                                <option value="">::select payment method::</option>
                                                <option value="paypal">Paypal</option>
                                                <option value="stripe">Stripe</option>
                                            </select>       
                                            <span id="payment-method"></span>                                         
                                            <br>
                                            <div id="card-element">
                                            </div>
                                            <div id="card-errors" class="text-danger" role="alert"></div>
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                    </div>
                                </div>
                            <div id="card-element"></div>
                            <div id="card-errors" class="text-danger" role="alert"></div>
                            <br>
                            
                            <div class="single-widget payement">
                                <div class="content">
                                    <img style="width:100%" src="{{('backend/img/payment-method.png')}}" alt="#">
                                </div>
                            </div>
                            <div class="blue box" id="div3"> Pay with PayPal.</div>
                            
                        </div>

                            <button type="submit"  class="place-an-order"> Next </button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
        var publishable_key = '{{ env('STRIPE_PUBLISHABLE_KEY') }}';
</script>
	<script>
        $('#card-element').hide();
        function next(){
            if($('#payment_method').val() == 'paypal')
            {
                $('#payment_method').attr("disabled", true);
                $('#payment-method').html('<input name="payment_method" hidden value="paypal" >');
                
                $('#card-element').hide();
            }
            else if($('#payment_method').val() == 'stripe')
            {                
                $('#payment_method').attr("disabled",true);
                $('#payment-method').html('<input name="payment_method" hidden value="stripe" >');
                $('#card-element').show();
            }
            else{
                toastr.error('error','Please Select Payment Mathod');
            }
        }
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0; 
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>
    
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
    var publishable_key = '{{ env('STRIPE_PUBLISHABLE_KEY') }}';
    var stripe = Stripe(publishable_key);
  // Create an instance of Elements.
  var elements = stripe.elements();
    
  // Custom styling can be passed to options when creating an Element.
  // (Note that this demo uses a wider set of styles than the guide below.)
  var style = {
      base: {
          color: '#32325d',
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
              color: '#aab7c4'
          }
      },
      invalid: {
          color: '#fa755a',
          iconColor: '#fa755a'
      }
  };
    
  // Create an instance of the card Element.
  var card = elements.create('card', {style: style});
    
  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');
    
  // Handle real-time validation errors from the card Element.
  card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
          displayError.textContent = event.error.message;
      } else {
          displayError.textContent = '';
      }
  });
    
  // Handle form submission.
  var form = document.getElementById('payment-form');
  

  form.addEventListener('submit', function(event) {
      event.preventDefault();
      if($('#payment_method').val()== 'stripe')
        {
        stripe.createToken(card).then(function(result) {
            if (result.error) {
            
                    // // Inform the user if there was an error.
                    // alert('asd');
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
      }
      else {
                // Send the token to your server.
                form.submit();
            }
  });
    
  // Submit the form with the token ID.
  function stripeTokenHandler(token) {
    // alert(token.id);
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    // return false;

      form.submit();
  }


    </script>
@endsection

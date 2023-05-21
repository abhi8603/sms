<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo asset(app_config('AppLogo','2')); ?>" type="image/png" sizes="16x16">

<style type="text/css">
#overlay
{

		position: fixed;
		top: 0px;
		bottom: 0;
		left: 0;
		right: 0;
		margin: auto;
		width: 100%;
		height: 100%;
		z-index: 999;
		background-color: rgba(0,0,0,0.85);

}
#overlay #loading {
		z-index: 9999;
		position: fixed;
		top: 0px;
		bottom: 0;
		left: 55;
		right: 0;
		margin: auto;
		width: 300px;
		height: 300px;
		background-size: 100% 100%;
		opacity: 1;
}
@-webkit-keyframes spin {
	0% { -webkit-transform: rotate(0deg); }
	100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
	0% { transform: rotate(0deg); }
	100% { transform: rotate(360deg); }
}

.loading:after {
	content: ' .';
	animation: dots 1s steps(5, end) infinite;
}
@keyframes dots {
	0%, 20% {
		color: rgba(0,0,0,0);
		text-shadow:
			.25em 0 0 rgba(0,0,0,0),
			.5em 0 0 rgba(0,0,0,0);}
	40% {
		color: white;
		text-shadow:
			.25em 0 0 rgba(0,0,0,0),
			.5em 0 0 rgba(0,0,0,0);}
	60% {
		text-shadow:
			.25em 0 0 white,
			.5em 0 0 rgba(0,0,0,0);}
	80%, 100% {
		text-shadow:
			.25em 0 0 white,
			.5em 0 0 white;}
		}
		input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
</style>

<script>
	window.onload = function() {
	//	 document.getElementById("overlay").show();
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
</head>
<body>
	<form method="post" id="customerData" name="customerData" action="{{url('payonline/paymentgatway/redirect')}}">
		<div id="overlay">
			<div style="text-align: center;
    margin-top: 55px;">
			  <img src="<?php echo asset(app_config('AppLogo','2')); ?>"/>
			</div>
	        <br><br><br><br>
	          <div id="loading" class="text-center" style="color:white;">
	           <i class="fa fa-spinner fa-spin" style="font-size: 70px;"></i>
	           <br><h3>Redirecting to Payment Gatway <span  class="loading"></span></h3>
	          </div>
	      </div>
				<?php
					/*print_r(session('onlinepay_data.amt') );
					print_r($paydata['amt']);
					exit; */
					if(session('onlinepay_data.order_id')==$paydata['transactionId'] && session('onlinepay_data.amt')==$paydata['amt']){

					}else{
						header('Location:'.url('/').'/admission-form');
						exit;
					}
			?>

		 <input type="text" name="tid" id="tid" readonly />
		 <input type="text" name="merchant_id" value="{{app_config('pg_merchant_id','2')}}"/>
		 <input type="text" name="order_id" value="{{$paydata['transactionId']}}"/>
		 <input type="text" id="amt" name="amount" value="{{$paydata['amt']}}"/>
		 <input type="text" name="currency" value="INR"/>
		 <input type="text" name="redirect_url" value="<?php echo url('/')."/payonline/getresponse" ?>"/>
		 <input type="text" name="cancel_url" value="<?php echo url('/')."/payonline/getresponse" ?>"/>
		 <input type="text" name="language" value="EN"/>
		 <input type="text" name="billing_name" value="{{$paydata['name']}}"/>
		 <input type="text" name="billing_address" value="{{$paydata['billing_address']}}"/>
		 <input type="text" name="billing_city" value="{{$paydata['city'] OR 'Ranchi'}}"/>
		 <input type="text" name="billing_state" value="{{$paydata['state'] OR 'Jharkhand'}}"/>
		 <input type="text" name="billing_zip" value="{{$paydata['pin']}}"/>
		 <input type="text" name="billing_country" value="India"/>
		 <input type="text" name="billing_tel" value="{{$paydata['stu_phone']}}"/>
		 <input type="text" name="billing_email" value="{{$paydata['email']}}"/>

		 <input type="text" name="delivery_name" value="{{$paydata['name']}}"/>
		 <input type="text" name="delivery_address" value="{{$paydata['billing_address']}}"/>
		 <input type="text" name="delivery_city" value="{{$paydata['city'] OR 'Ranchi'}}"/>
		 <input type="text" name="delivery_state" value="{{$paydata['state'] OR 'Jharkhand'}}"/>
		 <input type="text" name="delivery_zip" value="{{$paydata['pin']}}"/>
		 <input type="text" name="delivery_country" value="India"/>
		 <input type="text" name="delivery_tel" value="{{$paydata['stu_phone']}}"/>

		 <input type="text" name="merchant_param1" value=""/>
		 <input type="text" name="merchant_param2" value=""/>
		 <input type="text" name="merchant_param3" value=""/>
	   <input type="text" name="merchant_param4" value=""/>
		 <input type="hidden" name="merchant_param5" value=""/>
		 <input type="hidden" name="promo_code" value=""/>
		 <input type="text" name="customer_identifier" value="{{$paydata['transactionId']}}"/>
		 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
		<script src="{{ URL::asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
		<script>
		$(document).ready(function () {

			function disableBack() {window.history.forward()}
			    window.onload = disableBack();
			    window.onpageshow = function (evt) {if (evt.persisted) disableBack()}


			$(document).keydown(function (event) {
		 	if (event.keyCode == 123) { // Prevent F12
		 			alert("Action not allowed.");
		 			return false;
		 	} else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
		 		alert("Action not allowed.");
		 			return false;
		 	}
		 });
		 $('body').bind('cut copy paste select', function(e) {
		 alert("Action not allowed");
		 	e.preventDefault();

		 });
		  $(document).bind("contextmenu",function(e){
		 			return false;
		 	 });

		});
		$(window).on('keydown',function(event)
		    {
		    if(event.keyCode==123)
		    {
		        //alert('Entered F12');
		        return false;
		    }
		    else if(event.ctrlKey || event.shiftKey || event.keyCode==73)
		    {
		      //  alert('Entered ctrl+shift+i')
		      //  return false;  //Prevent from ctrl+shift+i
		    }
		    else if(event.ctrlKey || event.keyCode==73)
		    {
		      //  alert('Entered ctrl+shift+i')
		      //  return false;  //Prevent from ctrl+shift+i
		    }
		});

 $( window ).bind( 'mousewheel DOMMouseScroll', function ( event )
 {
		 if ( event.ctrlKey == true ){event.preventDefault();}
 } );
		</script>
		<script language='javascript'>
		const amt=<?php echo $paydata['amt'];  ?>;
		const fee_amt=document.getElementById("amt").value;
		if(parseFloat(amt)==parseFloat(fee_amt)){
					document.getElementById("customerData").submit();
		}else{
			alert("something went worng.");
			window.location.href = "<?php echo url('/')."/parents/ward/fee/payonline/tempered" ?>";
		}
	//	alert(amt);

	//	document.redirect.submit();
	</script>
	</body>

</html>

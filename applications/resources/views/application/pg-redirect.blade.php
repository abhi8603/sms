<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo asset(app_config('AppLogo','2')); ?>" type="image/png" sizes="16x16">

  <style>
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
        .5em 0 0 white;}}
  </style>
</head>
<body>
<center>
<!--	<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">-->

<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction "> 
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

echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
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
        return false;  //Prevent from ctrl+shift+i
    }
    else if(event.ctrlKey || event.keyCode==73)
    {
      //  alert('Entered ctrl+shift+i')
        return false;  //Prevent from ctrl+shift+i
    }
});

$( window ).bind( 'mousewheel DOMMouseScroll', function ( event )
{
 if ( event.ctrlKey == true ){event.preventDefault();}
} );
</script>
<script language='javascript'>
document.redirect.submit();
</script>
</body>
</html>

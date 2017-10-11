<?php
error_reporting (E_ALL ^ E_NOTICE);

session_start();

if ($_SESSION['phone']) {

echo "";

}else{

$_SESSION['phone'] = $_GET['phone'];

}

error_reporting (E_ALL ^ E_NOTICE);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<style>
    #apDiv1 {
	position:absolute;
	width:225px;
	height:120px;
	z-index:1;
	left: 12px;
	top: 15px;
}

#apDiv2 {
	position:absolute;
	width:150px;
	height:89px;
	z-index:1;
	left: 12px;
	top: 15px;
	background-image:url(http://joomla.eos.net/~restyler/BodyArmor/bd_logo.png);
	background-repeat:no-repeat;
}

</style>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Body Armor Lookup</title>
        <link rel="stylesheet" type="text/css" media="screen" href="iphone_blue.css">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-touch-fullscreen" content="YES">
        
        
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" /> 
        
        
        <link rel="apple-touch-icon" href="images/webclip.png">
<script type="application/x-javascript" src="javascript/iphone_fm.js" charset="utf-8">
</script>

<script type="text/javascript" src="NKit.js"></script>

<script>
      document.ontouchmove = function(event) {
        event.preventDefault();

		NKTabBarController();
		
		NKAlert("hello", "");
      }
    </script>

</head>
<body class="portrait">
<div id="apDiv2"></div>

<br />

<div style="margin-left:150px;"> <a href="http://www.restylerschoice.com/mobile/index.mobile.html"><img border="0" style="border:none;" src="home_moldings.png" /></a> </div>

<div id="container">
            <!--HEADER-->
           
            <!--Navigation Menu-->
            <!-- PAGE BODY -->
            <div id="content">
            
               <div align="center" id="record" class="find">
                        <br /><br /><br /><ul><br />
                            <!-- Display search field input controls -->
                            <li>
                            <span style="color:#aa1e21;" class="fieldLabel">Select Your Vehicle Type</span> 
                            <form method="post" action="app_redirect.php" name="makelist" id="makelist">
                              <select style="width:5em;" name="type" id="type" onChange="document.makelist.submit();">
                              	<option value=" ">&nbsp;</option>
                                
                                <option value="CT">Cars,Trucks,SUVs</option>
                                <option value="MRC">Cycles,Rvs,Other</option>
                                
                              </select>
                             </form>
                          </li>
                 </ul>
                 
                 
              </div>
            </div>
</div>
</body>
</html>


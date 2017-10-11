<?

error_reporting(0);

session_start();

//### ##############SETUP VALUES ######################

$userid = 'pqsrestchoice'; //<-- Inter User ID
$userpss = 'ui*h_4rt'; //<-- Inter User password
$file_name = 'BAiPhone-MR.php'; //<-- if raname this file you must give the name of the file here.

//################################################

?>

<html>
<head>
<title>Body Armor Lookup</title>
<style>
	.pick{font-family:arial, 'verdana'; color:#007FFF; font-weight: bold; text-decoration: none}
	.pick:hover{text-decoration: underline; color:#FF7F00 }
	
	#record ul {
	
	list-style-type: none;
	padding: 0 15px 10px;
}

#record ul:last-child {
	border: none;
	margin-bottom: -5px;
}

#record li {
	-webkit-border-radius: 8px;
	border: 1px solid #aaa;
	background-color: #fff;
	margin: auto -5px 10px;
	padding: 8px 26px 8px 8px;
}

#record li span.fieldLabel {
	font-weight: bold;
	padding-right: 5px;
	padding-bottom: 5px;
	vertical-align: top;
	display: block;
}

#apDiv1 {
	position:absolute;
	width:152px;
	height:63px;
	z-index:1;
	left: 12px;
	top: 15px;
	background-image:url(http://joomla.eos.net/~restyler/BodyArmor/bd_logo.png);
	background-repeat:no-repeat;
}
</style>


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
<body bgcolor="#919191">
<a href="app_choose.php"><div id="apDiv1"></div></a>
<div id="record">
<form name="my_form" id="my_form" method="get" action="<? echo "$file_name"; ?>" >
<?php
function xmlparse( $result){
	$simple = "$result";
	$p = xml_parser_create();
	xml_parse_into_struct($p, $simple, $vals, $index);
	xml_parser_free($p);
	$content = $vals[1];
	$content = $content['attributes'];
	return  $content;
}


function xmlyearParse($result){
$simple = "$result";
	$p = xml_parser_create();
	xml_parse_into_struct($p, $simple, $vals, $index);
	xml_parser_free($p);

	$what = array();
		foreach($vals as $attribute){
				if($attribute['attributes']){
					array_push($what, $attribute['attributes']);
				}
				
		};
	return  $what;
}


function rawxml($result){
$simple = "$result";
	$p = xml_parser_create();
	xml_parse_into_struct($p, $simple, $vals, $index);
	xml_parser_free($p);
	$what = $vals;
	return  $what;
}


$client = new SoapClient(NULL, array('location' => 'https://app4.xpel.com:8443/jboss-net/services/PartQuery', 'uri' => 'https://app4.xpel.com:8443/jboss-net/services/PartQuery', 'login' => $userid , 'password' => $userpss, ));

function currency_format($name, $dec = 0, $point = ".", $sep = "") {
      $name = number_format($name, $dec, $point, "");
      while(strpos($name,$point)!= false && substr($name,strlen($name)-1,1)=="0"){
		  $name = substr($name,0,strlen($name) - 1);
		  $dec = $dec - 1;
      }
      echo number_format($name, $dec, $point, $sep);
}

function showResults($content){

		echo "<br /><br /><br /><br />";
		foreach($content as $item){
		$first = substr($item[PARTNUMBER], 0, 1);
		
		$photo = "https://www.xpel.com/products/media/images/parts/" . $item[PARTNUMBER] . ".gif";
		
		$information = array();
		 
		$sizy = getimagesize($photo); 
		// information is the aray of your data
		
		if ($first == 'P') {
			echo "";
			$my_size = $sizy[0];
			$final_size = (int)$my_size;
			
			echo "";
			
				if ($final_size > 280) {
			
			
			echo "<ul><li><p><img width='280' src=https://www.xpel.com/products/media/images/parts/$item[PARTNUMBER].gif /></p>";
			echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Part Number:</font><font style='font-family:Arial;'> $item[PARTNUMBER] </b></font></p>";
			echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Description:</b></font> <span style='color:#999; font-family:Arial;'>$item[CONTENTSDESCRIPTION] </span></p>";
			echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Dificulty:</font><font style='font-family:Arial;'> $item[DIFFICULTY] </b></font></p>";
			echo "<p><font color='#aa1e21' face='Arial' style='font-size:16px;'><b> Retail price:</font> <span style='color:#000000; font-family:Arial;'><i>$". money_format('%!i',round($item['RETAIL'], 2)) ."</span></i></b></p>";
			echo "</li></ul>";
			
			
			
				}else{
				
				
			echo "<ul><li><p><img src=https://www.xpel.com/products/media/images/parts/$item[PARTNUMBER].gif /></p>";
			echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Part Number:</font><font style='font-family:Arial;'> $item[PARTNUMBER] </b></font></p>";
			echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Description:</b></font> <span style='color:#999; font-family:Arial;'>$item[CONTENTSDESCRIPTION] </span></p>";
			echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Dificulty:</font><font style='font-family:Arial;'> $item[DIFFICULTY] </b></font></p>";
			echo "<p><font color='#aa1e21' face='Arial' style='font-size:16px;'><b> Retail price:</font> <span style='color:#000000; font-family:Arial;'><i>$". money_format('%!i',round($item['RETAIL'], 2)) ."</span></i></b></p>";
			echo "</li></ul>";
			
			
			
				}
			
			}
		else {
		echo "";
		}
		
		}
		
		if ($_SESSION['phone'] == 'yes') echo '<ul><li><span style="color:#aa1e21;" class="fieldLabel"><a style="color:#aa1e21;" href="tel:18007333316">Click here to order now!</a></span></li></ul>';
		echo "<p align='center'>&#8226;&nbsp;Tap Body Armor logo to start over</p>";
}

if($_GET['SERIES']){
	$theYear = (int)$_GET['year'];
	$themakename = split( '\|' , $_GET['make'] );
	$themake = (int)$_GET['make'];
	$themodelname = split( '\|' , $_GET['model'] );
	$themodel = (int)$_GET['model'];
	$thesubmodelname = split( '\|' , $_GET['SUBMODEL'] );
	$thesubmodel = (int)$_GET['SUBMODEL'];
	$theseriesname = split( '\|' , $_GET['SERIES'] );
	$theseries = (int)$_GET['SERIES'];
	$result = $client->__soapCall('performSearch', array('year' => $theYear ,'seriesid',$theseries ));
	$return = rawxml($result);
	$return = $return[0];
	$return = $return['tag'];
	$content = xmlyearParse($result);
	$thisquery = $content[0];
	$thisquery = array_keys($thisquery);
	
	
	if($return == 'RESULTS'){
		echo "<div>";
		showResults($content);
		$showresults = true;
		echo "</div>";
	}else{
		echo "Pick a ". ucfirst(strtolower($thisquery[0])) .": <select style='width:5em;' name='$thisquery[0]'>";
		foreach($content as $make){
			echo "<option value='$make[ID]'>";
				echo $make[$thisquery[0]];
			echo "</option>";
		}
		echo "</select>
			<input type='hidden' name='year' id='year' value='$theYear' >
			<input type='hidden' name='make' id='make' value='$_GET[make]' >
			<input type='hidden' name='model' id='model' value='$_GET[model]' >
			<input type='hidden' name='SUBMODEL' id='SUBMODEL' value='$_GET[SUBMODEL]' >";
	}


}else if($_GET['SUBMODEL']){
	$theYear = (int)$_GET['year'];
	$themakename = split( '\|' , $_GET['make'] );
	$themake = (int)$_GET['make'];
	$themodelname = split( '\|' , $_GET['model'] );
	$themodel = (int)$_GET['model'];
	$thesubmodelname = split( '\|' , $_GET['SUBMODEL'] );
	$thesubmodel = (int)$_GET['SUBMODEL'];
	$result = $client->__soapCall('performSearch', array('year' => $theYear ,'submodelid',$thesubmodel ));
	$return = rawxml($result);
	$return = $return[0];
	$return = $return['tag'];
	//echo $return ;
	$content = xmlyearParse($result);
	$thisquery = $content[0];
	$arraycount = count($content);
	
	if ($arraycount > 0){
		$thisquery = array_keys($thisquery);
		
		if($return == 'RESULTS'){
			echo "<div>";
			showResults($content);
			$showresults = true;
			echo "</div>";
		}else{
			echo "&nbsp;&nbsp;&nbsp;&nbsp;<font color='#aa1e21' face='Arial' style='font-size:16px;'><br /><ul><li><div align='center'><b>Pick a ". ucfirst(strtolower($thisquery[0])) .":<br /></b></font> <select style='width:5em;' name='$thisquery[0]' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
			foreach($content as $make){
				echo "<option value='$make[ID]|$make[SERIES]'>";
					echo $make[$thisquery[0]];
				echo "</option>";
			}
			echo "</select></div></li></ul>
				<input type='hidden' name='year' id='year' value='$theYear' >
				<input type='hidden' name='make' id='make' value='$_GET[make]' >
				<input type='hidden' name='model' id='model' value='$_GET[model]' >
				<input type='hidden' name='SUBMODEL' id='SUBMODEL' value='$_GET[SUBMODEL]' >";
				
				echo "&nbsp;&nbsp;&nbsp;&nbsp;<a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name'><b>$theYear</b></a> / <a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name?year=$theYear'><b> $themakename[1]</b></a> / ";
	echo "<a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name?year=$theYear&make=$_GET[make]'><b> $themodelname[1]</b> </a> / ";
	echo "<a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name?year=$theYear&make=$_GET[make]&model=$_GET[model]'> <b>$thesubmodelname[1]</b> </a> / ";
	echo "<p align='center'>&#8226;&nbsp;Tap Body Armor logo to start over</p>";
	
		}
	}else{
		echo "<br /><br /><br /><br />
			<div style='border: 2px solid red; padding: 10px; background-color: #ffffff; margin-top: 5px;'>
			<h3>Vehicle Design In Progress</h3>
			<p>We currently have no products available for this model. Our Design Team is aware of the need for these products and will begin the design process as soon as a vehicle can be obtained for patterning.</p>
			<p>Please check back soon for details.</p>
			</div>";
		$showresults = true;
	}

}else if($_GET['model']){
	$theYear = (int)$_GET['year'];
	$themakename = split( '\|' , $_GET['make'] );
	$themake = (int)$_GET['make'];
	$themodelname = split( '\|' , $_GET['model'] );
	$themodel = (int)$_GET['model'];
	$result = $client->__soapCall('performSearch', array('year' => $theYear ,'modelid',$themodel ));
	$return = rawxml($result);
	$return = $return[0];
	$return = $return['tag'];
	$content = xmlyearParse($result);
	$thisquery = $content[0];
	$arraycount = count($content);
	
	if ($arraycount > 0){
		$thisquery = array_keys($thisquery);
		
		if($return == 'RESULTS'){
			echo "<div>";
			showResults($content);
			$showresults = true;
			echo "</div>";
		}else{
			echo "<br /><br /><br /><br /><ul><li><div align='center'><font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Pick a ". ucfirst(strtolower($thisquery[0])) .":<br /></b></font> <select style='width:5em;' name='$thisquery[0]' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
			foreach($content as $make){
				echo "<option value='$make[ID]|$make[SUBMODEL]'>";
					echo $make[$thisquery[0]];
				echo "</option>";
			}
			echo "</select></div></li></ul>
				<input type='hidden' name='year' id='year' value='$theYear' >
				<input type='hidden' name='make' id='make' value='$_GET[make]' >
				<input type='hidden' name='model' id='model' value='$_GET[model]' >";
				
				echo "&nbsp;&nbsp;&nbsp;&nbsp;<a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name'><b>$theYear</b></a> / <a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name?year=$theYear'><b> $themakename[1]</b></a> / ";
	echo "<a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name?year=$theYear&make=$_GET[make]'><b> $themodelname[1]</b> </a> / ";
	echo "<a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name?year=$theYear&make=$_GET[make]&model=$_GET[model]'> <b>$thesubmodelname[1]</b> </a>  ";
	echo "<p align='center'>&#8226;&nbsp;Tap Body Armor logo to start over</p>";
	
		}
	}else{
		echo "<br /><br /><br /><br />
			<div style='border: 2px solid red; padding: 10px; background-color: #ffffff; margin-top: 5px;'>
			<h3>Vehicle Design In Progress</h3>
			<p>We currently have no products available for this model. Our Design Team is aware of the need for these products and will begin the design process as soon as a vehicle can be obtained for patterning the paint protection kit.</p>
			<p>Please check back soon for details.</p>
			</div>";
		$showresults = true;
	}


}else if($_GET['make']){
	$theYear = (int)$_GET['year'];
	$themakename = split( '\|' , $_GET['make'] );
	$themake = (int)$_GET['make'];
	$result = $client->__soapCall('performSearch', array('year' => $theYear ,'makeid',$themake ));
	$content = xmlyearParse($result);
	
	echo "<br /><br /><br /><br /><ul><li><div align='center'><font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Select a Model:<br /></b></font> <select style='width:5em;' name='model' id='model' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
	foreach($content as $model){
		echo "<option value='$model[ID]|$model[MODEL]'>";
			echo "$model[MODEL]";
	echo "</option>";
	}
	echo "</select></div></li></ul>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name'><b>$theYear</b></a> / <a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name?year=$theYear'><b> $themakename[1]</b></a><input type='hidden' name='year' id='year' value='$theYear' ><input type='hidden' name='make' id='make' value='$_GET[make]' > / ";
	echo "<p align='center'>&#8226;&nbsp;Tap Body Armor logo to start over</p>";
			
			
}else if($_GET['year']){
	$theYear = (int)$_GET['year'];
	$result = $client->__soapCall('performSearch', array('year' => $theYear ,'',0 ));
	$content = xmlyearParse($result);
	//print_r($content);	
	
	echo "<br /><br /><br /><br /><ul><li><div align='center'><font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Select a Make:<br /></b></font> <select style='width:5em;' name='make' id='make' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
	foreach($content as $make){
	
	if ($make[ID] !="42" && $make[ID] !="43" && $make[ID] !="49" && $make[ID] !="62" && $make[ID] !="64" && $make[ID] !="69" && $make[ID] !="70" && $make[ID] !="71" && $make[ID] !="73" && $make[ID] !="76" && $make[ID] !="81" && $make[ID] !="82"
	 && $make[ID] !="85" && $make[ID] !="89" && $make[ID] !="90" && $make[ID] !="92" && $make[ID] !="112" && $make[ID] !="115" && $make[ID] !="129" && $make[ID] !="131" && $make[ID] !="182" && $make[ID] !="82" && $make[ID] !="89" && $make[ID] !="105" && $make[ID] !="182" && $make[ID] !="92" && $make[ID] !="85" && $make[ID] !="73" && $make[ID] !="64" && $make[ID] !="112" && $make[ID] !="63" && $make[ID] !="70" && $make[ID] !="182" && $make[ID] !="123" && $make[ID] !="122" && $make[ID] !="49" && $make[ID] !="69" && $make[ID] !="42" && $make[ID] !="57" && $make[ID] !="72" && $make[ID] !="81" && $make[ID] !="77" && $make[ID] !="129" && $make[ID] !="62" && $make[ID] !="71" && $make[ID] !="78" && $make[ID] !="93" && $make[ID] !="74" && $make[ID] !="134" && $make[ID] !="79" && $make[ID] !="43") 
		{
		
		}
		else
		{
		echo "<option value='$make[ID]|$make[MAKE]'>";
			echo "$make[MAKE]";
		echo "</option>";
		
		}		
	}
	echo "</select></li></ul></div><input type='hidden' name='year' id='year' value='$theYear' >";
	echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<a style='color:#000000; font-family:Arial; font-size:16px;' href='$file_name'><b>$theYear</b></a> / ";
	echo "<p align='center'>&#8226;&nbsp;Tap Body Armor logo to start over</p>";
}else{

$result = $client->__soapCall('getYearRange', array());

$content = xmlparse($result);
$sYear = (int)$content['SYEAR'];
$eYear = (int)$content['EYEAR'];
$totalyears = $eYear - $sYear;


echo "<br /><br /><br /><br /><ul><li><div align='center'><font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Select a Year:<br /></b></font> <select style='width:5em;' name='year' id='year' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
$eYear = $eYear + 1;
for ( $i = 1; $i <= $totalyears + 1; $i++){
	$eYear = $eYear - 1;
	echo "<option name='$eYear' id='$eYear' >";
		echo "$eYear";
	echo "</option>";
}
echo "</select></div></li></ul>";
echo "<p align='center'>&#8226;&nbsp;Tap Body Armor logo to start over</p>";

}

?>
<br /><br />
<? if($showresults){
}else{
	echo "";
} ?>
</form>
</div>
</body>
</html>

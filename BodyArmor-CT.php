<?php

//error_reporting(0);
session_start();
if ($_GET['site'] == "yes") {
	
    $_SESSION['site'] = "yes";
	
	
		if ($_REQUEST['order'] == "yes") {
			
			 $_SESSION['order'] = "true";
	
		}else{
			
		}
	
	
	
} else {
    echo "";
}



include_once 'xpel-api-includes.php';



?>

<html>
    <head>
        <title>Body Armor Lookup</title>
        <style>
            .pick{font-family:arial, 'verdana'; color:#007FFF; font-weight: bold; text-decoration: none}
            .pick:hover{text-decoration: underline; color:#FF7F00 }

            #record ul {



            }

            #record ul:last-child {
                border: none;

            }

            #record li {
                -webkit-border-radius: 8px;
                border: 1px solid #CCC;
                background-color: #ffffff;

                padding: 8px 8px 8px 8px;
            }

            #record li span.fieldLabel {
                font-weight: bold;
                padding-right: 5px;
                padding-bottom: 5px;
                vertical-align: top;

            }


        </style>
        <link rel="stylesheet" type="text/css" media="screen" href="iphone_blue2.css">
    </head>
    <body bgcolor="#ffffff">

        <div id="record" align="center">
            <form name="my_form" id="my_form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<?php

if (isset($_GET['series'])) {
    $theYear = (int)$_GET['year'];
    $themakename = explode('|', $_GET['make']);
    $themake = (int)$_GET['make'];
    $themodelname = explode('|', $_GET['model']);
    $themodel = (int)$_GET['model'];
    $thesubmodelname = explode('|', $_GET['submodel']);
    $thesubmodel = (int)$_GET['submodel'];
    $theseriesname = explode('|', $_GET['series']);
    $theseries = (int)$_GET['series'];
    
    $xml = getXML(1, $theYear, $themake, $themodel, $thesubmodel, $theseries);
    $dropdownData = xmlGetDropdownData($xml);
    
    if (xmlHasKits($xml)) {
        echo "<div>";
        xmlDisplayKits($xml);
        echo "</div>";
    } else {
        echo designInProgress();
    }
} elseif (isset($_GET['submodel'])) {
    $theYear = (int)$_GET['year'];
    $themakename = explode('|', $_GET['make']);
    $themake = (int)$_GET['make'];
    $themodelname = explode('|', $_GET['model']);
    $themodel = (int)$_GET['model'];
    $thesubmodelname = explode('|', $_GET['submodel']);
    $thesubmodel = (int)$_GET['submodel'];
    
    $xml = getXML(1, $theYear, $themake, $themodel, $thesubmodel);
    $dropdownData = xmlGetDropdownData($xml);

    if (!count($dropdownData)) {
        if (xmlHasKits($xml)) {
            echo "<div>";
            xmlDisplayKits($xml);
            echo "</div>";
        } else {
            echo designInProgress();
        }
    } else {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<font color='#aa1e21' face='Arial' style='font-size:16px;'><br /><ul><li><b>Pick a Series:<br /></b></font> <select name='series' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
        foreach ($dropdownData as $make) {
            echo "<option value='{$make['ID']}|{$make['NAME']}'>";
            echo $make['NAME'];
            echo "</option>";
        }
        echo "</select></div></li></ul>
            <input type='hidden' name='year' id='year' value='$theYear' >
            <input type='hidden' name='make' id='make' value='{$_GET['make']}' >
            <input type='hidden' name='model' id='model' value='{$_GET['model']}' >
            <input type='hidden' name='submodel' id='submodel' value='{$_GET['submodel']}' >";

        echo "&nbsp;&nbsp;&nbsp;&nbsp;<a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}'><b>$theYear</b></a> / <a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}?year=$theYear'><b> $themakename[1]</b></a> / ";
        echo "<a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}?year=$theYear&make={$_GET['make']}'><b> $themodelname[1]</b> </a> / ";
        echo "<a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}?year=$theYear&make={$_GET['make']}&model={$_GET['model']}'> <b>$thesubmodelname[1]</b> </a> / <div align='center'><a href='http://php.eos.net/~restyler/BodyArmor/BodyArmor_choose.php'><u>Start Over</u></a></div>";
    }
} elseif (isset($_GET['model'])) {
    $theYear = (int)$_GET['year'];
    $themakename = explode('|', $_GET['make']);
    $themake = (int)$_GET['make'];
    $themodelname = explode('|', $_GET['model']);
    $themodel = (int)$_GET['model'];
    
    $xml = getXML(1, $theYear, $themake, $themodel);
    $dropdownData = xmlGetDropdownData($xml);

    if (!count($dropdownData)) {
        if (xmlHasKits($xml)) {
            echo "<div>";
            xmlDisplayKits($xml);
            echo "</div>";
        } else {
            echo designInProgress();
        }
    } else {
        echo "<br /><ul><li><font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Pick a Submodel:<br /></b></font> <select name='submodel' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
        foreach ($dropdownData as $make) {
            echo "<option value='{$make['ID']}|{$make['NAME']}'>";
            echo $make['NAME'];
            echo "</option>";
        }
        echo "</select></li></ul>
            <input type='hidden' name='year' id='year' value='$theYear' >
            <input type='hidden' name='make' id='make' value='{$_GET['make']}' >
            <input type='hidden' name='model' id='model' value='{$_GET['model']}' >";

        echo "&nbsp;&nbsp;&nbsp;&nbsp;<a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}'><b>$theYear</b></a> / <a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}?year=$theYear'><b> $themakename[1]</b></a> / ";
        echo "<a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}?year=$theYear&make={$_GET['make']}'><b> $themodelname[1]</b> </a> / ";
    }
} elseif (isset($_GET['make'])) {
    $theYear = (int)$_GET['year'];
    $themakename = explode('|', $_GET['make']);
    $themake = (int)$_GET['make'];
    $xml = getXML(1, $theYear, $themake);
    $dropdownData = xmlGetDropdownData($xml);

    echo "<br /><ul><li><font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Select a Model:<br /></b></font> <select  name='model' id='model' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
    foreach ($dropdownData as $model) {
        echo "<option value=\"{$model['ID']}|{$model['NAME']}\">";
        echo $model['NAME'];
        echo "</option>";
    }
    echo "</select></li></ul>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;<a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}'><b>$theYear</b></a> / <a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}?year=$theYear'><b> $themakename[1]</b></a><input type='hidden' name='year' id='year' value='$theYear' ><input type='hidden' name='make' id='make' value='{$_GET['make']}' > / <div align='center'><a href='http://php.eos.net/~restyler/BodyArmor/BodyArmor_choose.php'><u>Start Over</u></a></div> ";
} elseif (isset($_GET['year'])) {
    $theYear = (int)$_GET['year'];
    $xml = getXML(1, $theYear);
    $dropdownData = xmlGetDropdownData($xml);

    echo "<br /><ul><li><font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Select a Make:<br /></b></font> <select name='make' id='make' onchange='document.my_form.submit();'><option name='blank' value='blank'>&nbsp;</option>";
    foreach ($dropdownData as $make) {
        if ($make['ID'] != "42" && $make['ID'] != "43" && $make['ID'] != "49" && $make['ID'] != "62" && $make['ID'] != "64" && $make['ID'] != "69" && $make['ID'] != "70" && $make['ID'] != "71" && $make['ID'] != "73" && $make['ID'] != "76" && $make['ID'] != "81" && $make['ID'] != "82" && $make['ID'] != "85" && $make['ID'] != "89" && $make['ID'] != "90" && $make['ID'] != "92" && $make['ID'] != "112" && $make['ID'] != "115" && $make['ID'] != "129" && $make['ID'] != "131" && $make['ID'] != "182" && $make['ID'] != "82" && $make['ID'] != "89" && $make['ID'] != "105" && $make['ID'] != "182" && $make['ID'] != "92" && $make['ID'] != "85" && $make['ID'] != "73" && $make['ID'] != "64" && $make['ID'] != "112" && $make['ID'] != "63" && $make['ID'] != "70" && $make['ID'] != "182" && $make['ID'] != "123" && $make['ID'] != "122" && $make['ID'] != "49" && $make['ID'] != "69" && $make['ID'] != "42" && $make['ID'] != "57" && $make['ID'] != "72" && $make['ID'] != "81" && $make['ID'] != "77" && $make['ID'] != "129" && $make['ID'] != "62" && $make['ID'] != "71" && $make['ID'] != "78" && $make['ID'] != "93" && $make['ID'] != "74" && $make['ID'] != "134" && $make['ID'] != "79" && $make['ID'] != "43") {
            echo "<option value=\"{$make['ID']}|{$make['NAME']}\">";
            echo $make['NAME'];
            echo "</option>";
        }
    }
    echo "</select></li></ul><input type='hidden' name='year' id='year' value='$theYear' >";
    echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;<a style='color:#000000; font-family:Arial; font-size:16px;' href='{$_SERVER['PHP_SELF']}?year=$theYear'><b>$theYear</b></a> / <div align='center'><a href='http://php.eos.net/~restyler/BodyArmor/BodyArmor_choose.php'><u>Start Over</u></a></div>";
} else {

    $xml = getXML(1);

    $dropdownData = xmlGetStartEndYear($xml);
    $sYear = (int)$dropdownData['SYEAR'];
    $eYear = (int)$dropdownData['EYEAR'];
    $totalyears = $eYear - $sYear;

    echo "<br />";
    ?>
                    <ul><li><div align="center"><font color="#aa1e21" face="Arial" style="font-size:16px;"><b>Select a Year:<br /></b></font>  <select name="year" id="year" onChange="document.my_form.submit()"><option value="blank" id="blank">&nbsp;</option>

                    <?php
                    $eYear++;
                    for ($i = 1; $i <= $totalyears + 1; $i++) {
                        $eYear = $eYear - 1;
                        ?>
                            <option value="<?php echo $eYear;?>" id="<?php echo $eYear;?>">
                        <?php echo $eYear;?></option>

                        <?php }
                    ?>
                            </select></div></li></ul><br /><div align="center"><a href="http://php.eos.net/~restyler/BodyArmor/BodyArmor_choose.php"><u>Start Over</u></a></div>

                <?php }
                ?>
                <br /><br />
            </form>
        </div>

    </body>
</html>

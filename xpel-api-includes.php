<?php

/**
 * Common functions used by the XPEL Catalog. 
 * Note that the only difference between CT and MR is that CT is a 1 and MR is a 2 when calling getXML().
 * There is also a new authentication key that is different from the DAP credentials for the Kit API.
 * Contact: Oren Baldinger <obaldinger@comsite.net>
 * Last Updated: 1-27-2015
 */

define('XPEL_API_URL', "https://dap70.xpel.com/partsearch/search/1"); //region is hardcoded
define('XPEL_API_KEY', "rcike*gen^8hy");
define('XPEL_IMG_URL', "http://az16997.vo.msecnd.net/kit-artwork");

/**
 * Echo's the final kit display to the browser. Does not return anything.
 * @param string $xml
 * @return void
 */
function xmlDisplayKits($xml)
{
    $content = xmlParseKits($xml);
    foreach ($content as $item) {
//        $first = substr($item['PARTNUMBER'], 0, 1);
        $make_pieces = explode("|", $_GET['make']);
        $my_make = $make_pieces[1];
        $model_pieces = explode("|", $_GET['model']);
        $my_model = $model_pieces[1];

        if (isset($_GET['submodel'])) {
            $submodel_pieces = explode("|", $_GET['submodel']);
            $my_submodel = $submodel_pieces[1];
        } 

        if (isset($_GET['series'])) {
            $series_pieces = explode("|", $_GET['series']);
            $my_series = $series_pieces[1];
        } 

        if (isset($_GET['submodel']) && isset($_GET['series'])) {
            $my_desc = $my_make . "-" . $my_model . "-" . $my_submodel . "-" . $my_series . "-" . $_GET['year'];
        } else {
            if (isset($_GET['submodel'])) {
                $my_desc = $my_make . "-" . $my_model . "-" . $my_submodel . "-" . $_GET['year'];
            } elseif (isset($_GET['series'])) {
                $my_desc = $my_make . "-" . $my_model . "-" . $my_series . "-" . $_GET['year'];
            } else {
                $my_desc = $my_make . "-" . $my_model . "-" . $_GET['year'];
            }
        }

        echo "<ul><li><p><img src=" . XPEL_IMG_URL . "/{$item['PARTNUMBER']}.gif /></p>";
        echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>P/N:</font><font style='font-family:Arial;'> {$item['PARTNUMBER']} </b> - {$item['PARTDESCRIPTION']} </font></p>";
        echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Dificulty:</font><font style='font-family:Arial;'> {$item['DIFFICULTY']}   </b></font> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Retail Price:</b></font><font style='font-family:Arial;'><i>$" . currencyFormat($item['PC0']) . "</span></i></font>";
		
		
		
		if ($_SESSION['order'] == "true") {
		
		echo "<br /><br /><form name='add_order' id='add_order' target='_parent' action='http://www.restylerschoice.com/Support/Portal/portal_order_item_submit.php' method='post'><table width='35%' border='0'><tbody><tr><td align='center' width='50%'>QTY:</td><td width='50%'>&nbsp;</td></tr><tr><td align='center' width='30%'><input type='text' name='qty' id='qty' value='1' style='width:40px; font-size:18px; text-align:center;' /></td><td align='center' width='50%'><input style='height:100%;' type='image' src='add_item_to_order.png' name='submit' id='submit' value='Submit' /><br /></td></tr></tbody></table><input type='hidden' name='part' id='part' value='BA-Xpel Kit' /><input type='hidden' name='BA_desc' id='BA_desc' value='{$item['PARTDESCRIPTION']}' /><input type='hidden' name='BA_price' id='BA_price' value='" . currencyFormat($item['PC0']) . "' /><input type='hidden' name='BA' id='BA' value='true' /><input type='hidden' name='options' id='options' value='{$item['PARTNUMBER']}' /><input type='hidden' name='make' id='make' value='" . $_REQUEST['make'] . "' /><input type='hidden' name='model' id='model' value='" . $_REQUEST['model'] . "' /><input type='hidden' name='year' id='year' value='" . $_REQUEST['year'] . "' /></form>";
		
	
		}else{
			
			
			//echo "not true";
			
		}
		
		echo "</p>";
		

        $fixed_price = currencyFormat($item['PC0']);

        if (isset($item['KITTYPE'])) {
            echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Kit Type:</b></font> <span style='color:#000000; font-family:Arial;'>{$item['KITTYPE']} </span></p>";
        } else {
            $item['KITTYPE'] = ''; //needs a value for the add-to-cart function. Avoiding error supression. 
        }
        if (isset($item['FOOTNOTE'])) {
            echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Notes:</b></font> <span style='color:#000000; font-family:Arial;'>{$item['FOOTNOTE']} </span></p>";
        } else {
            $item['FOOTNOTE'] = '';
        } 
        if (isset($item['SPECIALNOTE'])) {
            echo "<p> <font color='#aa1e21' face='Arial' style='font-size:16px;'><b>Special:</b></font> <span style='color:#000000; font-family:Arial;'>{$item['SPECIALNOTE']} </span></p> <br />";
        } else {
            $item['SPECIALNOTE'] = '';
        } 
        if (isset($_SESSION['site']) && $_SESSION['site'] == "yes") {
            echo "";
        } else {
            echo "<p>  <span style='color:#000000; font-family:Arial;'><a href='BodyArmorGet.php?part={$item['PARTNUMBER']}&desc=$my_desc&price=$fixed_price&diff={$item['DIFFICULTY']}&kittype={$item['KITTYPE']}&notes={$item['FOOTNOTE']}&special={$item['SPECIALNOTE']}'><input type='button' name='my_button' id='my_button' value='Add to Order' style='width: 200px; cursor:pointer;' /></a> </span></p>";
        }
        echo "</li></ul>";
    }
    echo "<div align='center'><a href='{$_SERVER['PHP_SELF']}'><u>Start Over</u></a></div>";
}

/**
 * Queries Xpel to retrieve XML for the dropdowns and kits. Technically region is the first part of the query, 
 * but it is hardcoded in the XPEL_API_URL constant.
 * @param string autotype (required)
 * @param string year, make, model, submodel, series (optional params)
 * @return string
 */
function getXML($autotype)
{
    //build the url to query
    $url = XPEL_API_URL;
    $numArgs = func_num_args();
    for ($i = 0; $i < $numArgs && $i < 6; $i++) {
        $arg = func_get_arg($i);
        if (!empty($arg)) {
            $url .= "/$arg";
        } else {
            break;
        }
    }
    
    //get the xml with curl
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => array('X-PartServiceKey: ' . XPEL_API_KEY),
        CURLOPT_TIMEOUT => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FAILONERROR => 1,
        CURLOPT_FOLLOWLOCATION => 1,
    ));
    $xml = curl_exec($ch);
    curl_close($ch);
    
    return $xml;
}

/**
 * Checks if XML data contains kits, or just dropdowns.
 * @param string $xml
 * @return boolean
 */
function xmlHasKits($xml)
{
    $vals = xmlToStruct($xml);
    return isset($vals[8]) && $vals[8]['tag'] == 'RESULTS';
}

/**
 * Used only to get the years for the year dropdown.
 * @param string $xml
 * @return array
 */
function xmlGetStartEndYear($xml)
{
    $vals = xmlToStruct($xml);
    $content = $vals[2]['attributes'];
    return $content;
}

/**
 * All dropdowns except for the year have ID's. There is either dropdown data, or kits, but not both 
 * in the XML.
 * @param string $xml
 * @return array
 */
function xmlGetDropdownData($xml)
{
    $vals = xmlToStruct($xml);
    $content = array();
    foreach ($vals as $attribute) {
        if (isset($attribute['attributes']) && isset($attribute['attributes']['ID'])) {
            array_push($content, $attribute['attributes']);
        }
    }
    return $content;
}

/**
 * Used only by xmlDisplayKits. The first two entries are the names of the retail/dealer prices.
 * PC0 is retail pricing. There is either dropdown data, or kits, but not both in the XML.
 * @param string $xml
 * @return array
 */
function xmlParseKits($xml)
{
    $vals = xmlToStruct($xml);
    $content = array();
    foreach ($vals as $attribute) {
        if (isset($attribute['attributes']) && isset($attribute['attributes']['PC0'])) {
            array_push($content, $attribute['attributes']);
        }
    }
    return $content;
}

/**
 * Parses an XML string into an array. Used internally only.
 * @param string $xml
 * @return array
 */
function xmlToStruct($xml)
{
    $vals = array();
    $p = xml_parser_create();
    xml_parse_into_struct($p, (string)$xml, $vals);
    xml_parser_free($p);
    return $vals;
}

/**
 * Doesn't do anything because the prices are already formatted by Xpel. Might as well leave it.
 * @param string $val
 * @return string
 */
function currencyFormat($val)
{
    return $val;
}

/**
 * Returns HTML to display when a vehicle doesn't have any kits. Note that it returns a string, rather 
 * than echoing directly.
 * @return string
 */
function designInProgress()
{
    return "<div style='border: 2px solid red; padding: 10px; background-color: #ffffff; margin-top: 5px;'>
			<h3>Vehicle Design In Progress</h3>
			<p>We currently have no products available for this model. Our Design Team is aware of the need for these products and will begin the design process as soon as a vehicle can be obtained for patterning.</p>
			<p>Please check back soon for details.</p>
			</div>";
}



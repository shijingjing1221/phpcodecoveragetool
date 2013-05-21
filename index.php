<?php
xdebug_start_code_coverage();
require_once('your_application_index.php'));

//print_r(xdebug_get_code_coverage());
$result = xdebug_get_code_coverage();
//print_r($result);
register_shutdown_function('coverageLog', $result);
xdebug_stop_code_coverage();

function coverageLog($result = NULL){
	if(empty($result)){
		$result = $result = xdebug_get_code_coverage();
	}
	$xmlString = "";
	$xmlBody = "";
	if(!empty($result)) {
		foreach($result as $file => &$lines) {
			$xmlBody .= "<file path=\"".$file . "\">";
			foreach($lines as $linenum => &$frequency) {
				$xmlBody .= "<line line-number=\"" . $linenum . "\"";
				$xmlBody .= " frequency=\"" . $frequency . "\"/>";
			}
			$xmlBody .= "</file>\n";
		}
	}


	$rand = rand();
	$uri = $_SERVER['REQUEST_URI'];
	$uri = trim($uri, "/");
	$uri = str_replace(array("/", "?", "&"), "_", $uri);
	//echo "\n".$uri;
	$file_name = $uri."_$rand";
	//echo "\n".$file_name;
	$xmlBody = '<?xml version="1.0" encoding="utf-8" ?><spike-phpcoverage>'."\n" . $xmlBody.'</spike-phpcoverage>';
	file_put_contents(dirname(__FILE__)."/phpcc_xml/".$file_name.".xml", $xmlBody);
}


?>

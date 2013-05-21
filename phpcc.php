<?php
//define("PHPCOVERAGE_HOME", dirname(__FILE__));
define("PHPCOVERAGE_HOME", dirname(__FILE__)."/phpcc_src");
define("PHPCOVERAGE_REPORT_DIR", dirname(__FILE__)."/phpcc_report");
define("PHPCOVERAGE_APPBASE_PATH", realpath("../app"));
//define("PHPCOVERAGE_APPBASE_PATH", "../");
define("XML_HOME", dirname(__FILE__)."/phpcc_xml");
require_once  PHPCOVERAGE_HOME."/remote/RemoteCoverageRecorder.php";
require_once  PHPCOVERAGE_HOME."/reporter/HtmlCoverageReporter.php";
echo PHPCOVERAGE_APPBASE_PATH."</br>";
 
$target = "*.xml";
if(!empty($_REQUEST['target'])){
	$target = $_REQUEST['target'];
	$target = trim($target, "/");
	$target = str_replace(array("/", "?", "&"), "_", $target)."*.xml";
}
$target = XML_HOME . "/$target";
echo "</br>target is:".$target."</br></br>";
$all_xml_files = glob($target);
// echo "XML file list:</br>";
//print_r($all_xml_files);
// Configure reporter, and generate report
$covReporter = new HtmlCoverageReporter(
        "Sample Web Test Code Coverage", "", PHPCOVERAGE_REPORT_DIR);
echo "1<br>";
$excludePaths = array();
// Set the include path for the web-app
// PHPCOVERAGE_APPBASE_PATH is passed on the commandline
$includePaths = array(realpath(PHPCOVERAGE_APPBASE_PATH));

// Notice the coverage recorder is of type RemoteCoverageRecorder
$cov = new RemoteCoverageRecorder($includePaths, $excludePaths, $covReporter);
// Pass the code coverage XML url into the generateReport function
//$cov->generateReport($cov_url . "?phpcoverage-action=get-coverage-xml", true);
echo "2<br>";
$cov->generateReport($all_xml_files, false);
echo "3<br>";
//$covReporter->printTextSummary(PHPCOVERAGE_REPORT_DIR . "report.txt");
// Clean up
// file_get_contents($cov_url . "?phpcoverage-action=cleanup");
$url = "";
if(isset($_SERVER['HTTPS'])) {
	$url = "https://".$_SERVER["HTTP_HOST"]."/phpcc_report/index.html";
} else {
	$url = "http://".$_SERVER["HTTP_HOST"]."/phpcc_report/index.html";
}
echo "please go for <a href=\"$url\">$url</a> to check the code coverage report</br>";
echo "XML file list:</br>";
print_r($all_xml_files);

?>

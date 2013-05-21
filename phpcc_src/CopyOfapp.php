<?php
function __code_coverage_xdebug_stop($result){
    include_once 'code_coverage_class.php';
    $code_coverage = new code_coverage(__FILE__,'/xdebug/');
   // $code_coverage->code_coverage_analysis_save();
//print_r($result);
    $code_coverage->code_coverage_reports($result);
}
xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);
require_once(realpath(dirname(__FILE__) . '/../app/lib/application.php'));

//print_r(xdebug_get_code_coverage());
$result = xdebug_get_code_coverage();
 //   print_r($result);
register_shutdown_function('__code_coverage_xdebug_stop', $result);
xdebug_stop_code_coverage(true);
?>

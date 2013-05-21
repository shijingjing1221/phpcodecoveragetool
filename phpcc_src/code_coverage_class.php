<?php
// REF: http://www.phpclasses.org/browse/file/29511.html

class code_coverage{
    private $analysis_file;
    private $reports_dir;

    function __construct($analysis_file , $reports_dir) {
        $this->reports_dir      = $reports_dir;
        $this->analysis_file    = $analysis_file;
        
        if(!is_dir($reports_dir)){
            mkdir($reports_dir, 0755);
        }
    }

    public function code_coverage_reports($code_coverage_analysis) {
       // require_once $this->analysis_file;
       // print_r($code_coverage_analysis);
        $counter=0;
        foreach($code_coverage_analysis as $file_name=>$lines_executed) {
        	
            if($file_name == __FILE__){
                continue;
            }
            
            $file_name_array = explode ('/',$file_name);
            $file_name_html = end($file_name_array);

            if($counter != 0){
                $code = array();
                $source_code = file($file_name);
                //print_r($source_code);
                $run_line = 0;
                $unrun_line = 0;
                foreach($source_code as $lines=>$source) {
                    if(isset($lines_executed[($lines+1)])) {
                        if($lines_executed[($lines+1)] == 1){
                            $color = 'yellow';
                            ++$run_line;
                        }else{
                            $color = 'red';
                            ++$unrun_line;
                        }
                    } else {
                        $color = '';
                    }
                    $code[] = sprintf('
                    <tr BGCOLOR = "%s">
                        <td>%d</td>
                        <td><pre>%s</pre></td>
                    </tr>
                    ', $color, ($lines+1), $source);
                }
                //print_r($code);
                $html = sprintf("
                    <html>
                    <head>
                        <title>
                            Xdebug Code Coverage Reports
                        </title>
                    </head>
                    <body>
                    <div>Check Lines: %d</div>
                    <div>Run Lines: %d</div>
                    <div>Un-Run Lines: %d</div>
                    <div>Code Coverage: %d%%</div>
                    <table border='1'>
                        <tr>
                            <td>Line no</td>
                            <td>PHP Code</td>
                        </tr>
                        %s
                    </table>                 
                    </body>
                    </html>
                    ", ($run_line+$unrun_line)
                     , $run_line
                     , $unrun_line
                     , round(100*$run_line/($run_line+$unrun_line))
                     , implode("\n", $code)
                );
                echo $html;
                echo "-----------------";
                echo $this->reports_dir.$file_name_html.".html";
                file_put_contents($this->reports_dir.$file_name_html.".html",$html);
            }
            $counter++;
        }
    }    
    
    public function code_coverage_analysis_save(){
        file_put_contents($this->analysis_file,"<?php \$code_coverage_analysis = ".var_export(xdebug_get_code_coverage(),TRUE)." ?>");
        xdebug_stop_code_coverage(true);
    }
}

?>
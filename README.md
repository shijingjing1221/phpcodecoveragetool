phpcodecoveragetool
===================

a php code coverage tool base on http://phpcoverage.sourceforge.net/


<h1>Usage</h1>

<h2>Generate the XML file to record the data for code coverage</h2>

1. Download the folder and put it in your root of your application
2. Require your root file of your application in Line 3 of index.php
3. Create two new folder in your root foldre "phpcc_xml" and "phpcc_report"
4. Give the permission to three folder "phpcc_xml", "phpcc_report" and "phpcc_src" with the following commands
sudo chmod -R 777 phpcc_xml phpcc_report phpcc_src
sudo chown www-data -R phpcc_xml phpcc_report phpcc_src(Ubuntu) or sudo chown apache -R phpcc_xml phpcc_report phpcc_src(Redhat)
5. make the index.php to be the root file instead

Call your services as same as before, and then the xml file will be generated in "phpcc_xml"

<h2>Generate Code Coverage report</h2>

Call <i><a>http://your_app_host/phpcc.php</a></i> in your browser or run the following command(recommand), The code coverage report will be generated in phpcc_report.
<pre><code>php phpcc.php</code></pre> 
The phpcc.php will give the code coverage link at the end of execution.You can directly check the report with <i><a>http://your_app_host/phpcc_report/index.html</a></i>

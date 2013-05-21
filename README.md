phpcodecoveragetool
===================

a php code coverage tool base on http://phpcoverage.sourceforge.net/


Usage
Generate the XML file to record the data for code coverage

1. Download the folder and put it in your root of your application
2. Require your root file of your application in Line 3 of index.php
3. Create two new folder in your root foldre "phpcc_xml" and "phpcc_report"
4. Give the permission to three folder "phpcc_xml", "phpcc_report" and "phpcc_src" with the following commands
sudo chmod -R 777 phpcc_xml phpcc_report phpcc_src
sudo chown www-data -R phpcc_xml phpcc_report phpcc_src(Ubuntu) or sudo chown apache -R phpcc_xml phpcc_report phpcc_src(Redhat)
5. make the index.php to be the root file instead

Call your services as same as before, and then the xml file will be generated in "phpcc_xml"

Generate Code Coverage report

Call http://your_app_host/phpcc.php in your browser or run php phpcc.php command(recommand), the code coverage report will be generated in phpcc_report. The phpcc.php will give the code coverage link, or you can directly check the report with http://your_app_host/phpcc_report/index.html

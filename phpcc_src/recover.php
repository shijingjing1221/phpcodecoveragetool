<?php
require_once("../app/models/user.php");
require_once("../app/lib/uvsdatabase.php");

if(isset($_POST['submit'])) {
	$email = $_POST['email'];
	//verify the email
	if(!User::find_by_email($email, true, NULL, true)){
		print_form();
	    echo '<center><font size="3", color="red"><b>No such primary email!</b></font></center><p>';
	    exit; 
	}
    if(isset($_SERVER['HTTPS'])) {
    	   $server_root = "https://".$_SERVER["HTTP_HOST"];
    } else {
    	   $server_root = "http://".$_SERVER["HTTP_HOST"];
    }
      
	$url      = $server_root."/user/forgot_password?email=".$email;
	$ch = init_request($url);
	$response = json_decode(curl_exec($ch));
	if($response->status =="ok") {
           echo '
<head>
    <meta charset="utf-8">
    <title>Welcome to Usher</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/respond.min.js"></script>
    <script src="js/modernizr.custom.62920.js"></script>
</head>
<meta content="width=283, minimum-scale=0.1" name="viewport" />
<body>
    <tr><td valign="top" align="center">
                   <img src="http://usher.com/img/icon_email.png"  alt="usher" title="Learn more at usher.com">
             </td></tr>
             <tr><td valign="top" align="center"> 
               <center><font size="3">A verification code has been sent to your email. If you did not receive the code, please check your spam folder.</font></center>
             </td></tr>
</body>
</html>
           ';
             
        } else {
           echo '<center><font size="3", color="red"><b>Failed! Please try again later.</b></font></center><p>';
        } 
}else {
	print_form();
}

function print_form() { 
	$today = getdate();
 	echo '
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Usher</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/respond.min.js"></script>
    <script src="js/modernizr.custom.62920.js"></script>
</head>
<meta content="width=283, minimum-scale=0.1" name="viewport" />
<body>
    <header class="topbar">
        <div class="wrap">
            <a href="http://pro.usher.com"><img src="img/logo.png" alt="Usher"></a>
        </div>
    </header>
    <div id="container">
        <form action="recover.php" method="post" id="login">
            <h2>Password Reminder </h2>
            <label>
                <span>Enter your email:</span>
                <input type="email" name="email">
            </label>
            <input id="submit" type="submit" name="submit" value="Submit">
        </form>
    </div>
    <footer>
        <ul>
            <li><a href="http://pro.usher.com/terms.html">Terms of Use</a> |</li>
            <li><a href="http://pro.usher.com/privacy.html">Privacy Policy</a> |</li>
            <li><a href="mailto:support@usherpro.com">Feedback</a></li>
        </ul>
        <p class="legal">&copy; '.$today['year'].' MicroStrategy Incorporated. All Rights Reserved.</p>
    </footer>
</body>
         ';
}

function init_request($url, $timeout = 30, $connect_timeout = 10) {
	$handle = curl_init($url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handle, CURLOPT_BINARYTRANSFER, true);
	curl_setopt($handle, CURLOPT_DNS_USE_GLOBAL_CACHE, false); // Not true is not thread-safe.
	curl_setopt($handle, CURLOPT_TIMEOUT, $timeout); // Total time the function is allowed to execute.
	curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, $connect_timeout);
	return $handle;
}

?>



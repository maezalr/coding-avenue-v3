<?

/***********************************
USER VARIABLES
/***********************************
$_SESSION['__email_verified__'];
$_SESSION['__email__'];
$_SESSION['__name__'];
$_SESSION['__picture__'];
************************************/

session_start();

//App Name
define("APP_NAME", "Coding Avenue");
define("BASE_NAME", "/coding-avenue-v3");

//Database Connection
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "coding_avenue");

//Google API
//https://console.developers.google.com/apis/dashboard?project=codingavenue-169518&duration=PT1H
define("CLIENT_ID", "973251889452-hktefsr473ro9s79vuhl9hnvcdpf7uhs.apps.googleusercontent.com");
define("CLIENT_SECRET", "PVno_FcCKHuXl4m_bRSDXmEM");

//Post per page
define("POST_PER_PAGE", 5);

//Display special characters
header('Content-Type: text/html; charset=ISO-8859-1');

?>
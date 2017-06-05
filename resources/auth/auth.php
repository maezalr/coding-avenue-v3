<?

if(empty($_SESSION['__email_verified__'])) {
	header("Location: ".BASE_NAME);
	exit;
}

?>
<?

//App Configuration 
include_once('../config/app.php');

// Get $id_token via HTTPS POST
$id_token = $_POST['idtoken'];

$expToken = explode(".",$id_token);

$payload = base64_decode($expToken[1]);

$payload = json_decode($payload);

if($payload->aud == CLIENT_ID) {
	$_SESSION['__email_verified__'] = $payload->email_verified;
	$_SESSION['__email__'] = $payload->email;
	$_SESSION['__name__'] = $payload->name;
	$_SESSION['__picture__'] = $payload->picture;
	echo "TRUE";
} else {
	echo "FALSE";
}

?>
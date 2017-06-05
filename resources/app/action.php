<?

//App Configuration 
include_once('../config/app.php');

//DB connections
include_once('db/sql.php');
include_once('db/sqlfunc.php');

//Custom functions
include_once('functions/defines.php');

$result = 'FALSE';

$action = $_POST['action'];

$title = '';
$body = '';

$name = $_SESSION['__name__'];
$email = $_SESSION['__email__'];

if(isset($_POST['id'])) $id = $_POST['id'];
if(isset($_POST['title'])) $title = $_POST['title'];
if(isset($_POST['body'])) $body = $_POST['body'];

//Create New Post
if($action == 'create') {
	$result = createPost($title, $body, $name, $email);
	$result = renderActionResult2($result);
}

//Update Post
if($action == 'update') {
	$result = updatePost($id, $title, $body);
	$result = renderActionResult2($result);
}

//Action for Trash
if($action == 'trash') {
	$result = deletePost($id);
	$result = renderActionResult2($result);
}

//Action for Publish
if($action == 'publish') {
	$result = publishPost($id);
	$result = renderActionResult2($result);
}

//Action for UNPublish
if($action == 'unpublish') {
	$result = unpublishPost($id);
	$result = renderActionResult2($result);
}

//Get Editor HTML
if($action == 'geteditorhtml') {
	$post = false;
	if($id) $post = getPost($id);
	$result = editorHTML($post);
}

echo $result;

?>
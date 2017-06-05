<?

//App Configuration 
include_once('resources/config/app.php');

//DB connections
include_once('resources/app/db/sql.php');
include_once('resources/app/db/sqlfunc.php');

//Custom functions
include_once('resources/app/functions/parsedown.php');
include_once('resources/app/functions/defines.php');

$id = false;
$post = false;

$page = $_GET['page'];

if(isset($_GET['id']) && strlen($_GET['id']))
	$id = $_GET['id'];

if($id)
	$post = getPost($id);

?>
<div class="panel panel-default">
	<div class="panel-body" id="posts">

	<a href="main.php?page=<?=$page?>" type='button' class='btn btn-link btn-xs' style="float: left;">Back to Main</a>

		<hr />	

	<?

		if($post) 
			renderPost($post, $page, TRUE);
		else 
			echo "No post to show on this page.";

	?>

	</div>
</div>
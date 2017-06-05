<?

//App Configuration 
include_once('resources/config/app.php');

//DB connections
include_once('resources/app/db/sql.php');
include_once('resources/app/db/sqlfunc.php');

//Custom functions
include_once('resources/app/functions/parsedown.php');
include_once('resources/app/functions/defines.php');

?>

<div class="panel panel-default">
	<div class="panel-body" id="posts">

	<hr />

	<?

		$page = (isset($_GET['page']) && strlen($_GET['page']) > 0) ? $_GET['page'] : 1;

		$posts = getPosts($page);		

		if(count($posts) > 0) {
			
			foreach($posts as $post) {
				renderPost($post, $page);
			} 
			
			pagination($page);

		}
		else {
			echo "No post to show on this page.";
		}

	?>
	</div>
</div>

<?

if(count($posts) > 0) echo "<br /><br />";

?>
<?
//App Configuration 
include_once('resources/config/app.php');

//Authentication
include_once('resources/auth/auth.php');

//DB connections
include_once('resources/app/db/sql.php');
include_once('resources/app/db/sqlfunc.php');

//Custom functions
include_once('resources/app/functions/defines.php');

//Header HTML
include_once('resources/layout/header.php');

$id = false;
$post = false;

//If ID is supplied in URL
if(isset($_GET['id']) && strlen($_GET['id']))
	$id = $_GET['id'];

//Fetch record
if($id)
	$post = getPost($id);

?>

<!-- Container of Alerts -->
<div id="alertrenderer" style="display:none;"></div>

<div class="panel panel-default">

	<div class="panel-heading"><strong>Editor</strong></div>

	<div id="editorhtml" class="panel-body">

		<? editorHTML($post); ?>
	
	</div>
	
</div>

<!-- Editor CDNs -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.7.1/showdown.min.js"></script>

<script>

//Initialize Markdown Converter
var converter = new showdown.Converter();

//Create Editor
var simplemde = new SimpleMDE({ 
	element: $("#post_editor")[0],
	autofocus: true,
	status: false,
	hideIcons: ["heading", "guide"],
	showIcons: ["strikethrough", "code", "table"],
	previewRender: function(plainText, preview) { 
		return preview.innerHTML = converter.makeHtml(plainText);
	}
});

</script>

<!-- Actions -->
<script src="resources/js/action.js"></script>

<?
//Footer HTML
include_once('resources/layout/footer.php');
?>
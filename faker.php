<?

ini_set('max_execution_time', 900);

//App Configuration 
include_once('resources/config/app.php');

//DB connections
include_once('resources/app/db/sql.php');
include_once('resources/app/db/sqlfunc.php');

require_once('vendor/fzaninotto/faker/src/autoload.php');

$numfakes = '';

if(isset($_POST['numfakes'])) $numfakes = $_POST['numfakes'];

$error = FALSE;

if(!ctype_digit($numfakes)) $error = "Please provide a valid number of fakes to generate.";

if($error) {
	echo "<font color='red'>".$error."</font><br />";
}

?>

<form action="faker.php" method="POST">
	Fakes to Generate: <input type="text" name="numfakes" maxlength="5" size="5" value="<?=$numfakes?>">&nbsp;&nbsp;
	<input type="submit" value="Generate">
</form>

<?

if($error) exit;

$faker = Faker\Factory::create();

$db = new DB(); 

for($i = 1; $i <= $numfakes; $i++) {

	$title = $db->quote($faker->sentence($nbWords = 15, $variableNbWords = true));
	$body = $db->quote(implode("\n",$faker->paragraphs($nb = 10, $asText = false)));
	$name = $db->quote($faker->name);
	$email = $db->quote($faker->email);

	$result = $db->query("insert into posts(title, body, author, author_email) values ({$title}, {$body}, {$name}, {$email})");

	echo "Faker[{$i}]: {$title}<br />";

}

$db->close();


?>

<?

//Get all post per page
function getPosts($page) {
	
	$limit = POST_PER_PAGE;
	$offset = ($page - 1) * $limit;

	$db = new DB();
	$posts = $db->select("select * from posts where published = true order by datepublished desc limit {$offset}, {$limit}");
	$db->close();

	return $posts;

}

//Get Posts by Specific User
function getUserPosts($user) {

	$user = strtolower($user);

	$db = new DB();
	$posts = $db->select("select id, title, published, datecreated, datepublished from posts where lower(author_email) = '{$user}' order by datecreated desc");
	$db->close();

	return $posts;

}

//Get Specific Post
function getPost($id) {

	$db = new DB();
	$post = $db->select("select * from posts where id = ".$id);
	$db->close();

	if(count($post) > 0)
		return $post[0];

	return false;

}

//Count All Posts
function countPosts() {

	$db = new DB();
	$result = $db->select("select count(*) as cnt from posts");
	$db->close();

	return $result[0]['cnt'];

}

//Publish a Post
function publishPost($id) {

	$db = new DB();
	$result = $db->query("update posts set published = 1, datepublished = now() where id = {$id}");
	$db->close();

	if($result) return array("result" => "success", "message" => "Post has been successfully published. View <a href='admin.php'>dashboard</a> for all posts.");

	return array("result" => "fail", "message" => "Unable to publish post. Please try again.");

}

//Unpublish a Post
function unpublishPost($id) {

	$db = new DB();
	$result = $db->query("update posts set published = 0, datepublished = null where id = {$id}");
	$db->close();

	if($result) return array("result" => "success", "message" => "Post has been successfully unpublished. View <a href='admin.php'>dashboard</a> for all posts.");

	return array("result" => "fail", "message" => "Unable to unpublish post. Please try again.");

}

//Delete a Post
function deletePost($id) {

	$db = new DB(); 
	$result = $db->query("delete from posts where id = {$id}");
	$db->close();

	if($result) return array("result" => "success", "message" => "Post has been successfully deleted. View <a href='admin.php'>dashboard</a> for remaining posts or create a new post below.");

	return array("result" => "fail", "message" => "Unable to delete post. Please try again.");

}

//Create a Post
function createPost($title, $body, $name, $email) {

	if(strlen(trim($title)) < 1 || strlen(trim($body)) < 1) return array("result" => "fail", "message" => "Please specify the title and the body of your post.");

	$db = new DB(); 

	$title = $db->quote($title);
	$body = $db->quote($body);
	$name = $db->quote($name);
	$email = $db->quote($email);

	$result = $db->query("insert into posts(title, body, author, author_email) values ({$title}, {$body}, {$name}, {$email})");
	$db->close();

	if($result) return array("result" => "success", "message" => "Post has been successfully published. View <a href='admin.php'>dashboard</a> for all posts or create a new post below.");

	return array("result" => "fail", "message" => "Unable to publish post. Please try again.");

}

//Create a Post
function updatePost($id, $title, $body) {

	if(strlen(trim($title)) < 1 || strlen(trim($body)) < 1) return array("result" => "fail", "message" => "Please specify the title and the body of your post.");

	$db = new DB(); 

	$title = $db->quote($title);
	$body = $db->quote($body);

	$result = $db->query("update posts set title = {$title}, body = {$body} where id = {$id}");
	$db->close();

	if($result) return array("result" => "success", "message" => "Post has been successfully updated. View <a href='admin.php'>dashboard</a> for all posts.");

	return array("result" => "fail", "message" => "Unable to update post. Please try again.");

}

?>
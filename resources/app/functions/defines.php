<?

function editorHTML($post) {

?>

<form id="editorform" method="POST">

	<!-- Show available actions for existing posts -->
	<? if($post) { ?>

		<div style="float: right; margin-bottom: 15px;">
			<!-- Toggle Publish/Unpublish -->
			<? if($post['published']) { ?>
			<button type="button" class="btn btn-success btn-xs" onclick="submitForm('unpublish')">Unpublish</button>     
			<? } else { ?>
			<button type="button" class="btn btn-success btn-xs" onclick="submitForm('publish')">Publish</button>     
			<? } ?>
			<!-- Trash post -->
			<button type="button" class="btn btn-danger btn-xs" onclick="submitForm('trash')">Move to Trash</button>	
		</div>

	<? } ?>

		<?

		$title = '';
		$body = '';

		if(isset($post['title'])) $title = $post['title'];
		if(isset($post['body'])) $body = $post['body'];

		?>

		<!-- Title -->
		<input type="text" id="post_title" class="form-control" placeholder="New Title" maxlength="255" name="title" value="<?=$title?>" required><br />
	    
		<!-- Editor Form -->
	    <textarea id="post_editor" name="body" style="display: none;" required><?=$body?></textarea>

	    <br />
	    
	    <!--Toggle Update or Create-->
		<? if($post) { ?>
	    <button type="button" class="btn btn-primary btn-sm" onclick="submitForm('update')" style="padding-right: 35px; padding-left: 35px;">Update</button>
	    <? } else { ?>
	    <button type="button" class="btn btn-primary btn-sm" onclick="submitForm('create')" style="padding-right: 35px; padding-left: 35px;">Publish</button>
		<? } ?>

		<!-- Store POST ID -->
		<? if($post) { ?>
		<input type="hidden" id="id" name="id" value="<?=$post['id']?>">
		<? } ?>

		<!-- Stores action to perform -->
		<input type="hidden" id="perform" name="perform">	


	</form>

<?

}

//Action Result Rendering
function renderActionResult2($actionresult) {

	if($actionresult['result'] == 'success') {
		$class = 'alert-success';
		$strong = 'Success!';
	}

	if($actionresult['result'] == 'fail') {
		$class = 'alert-danger';
		$strong = 'Failed!';
	}

	if($actionresult['result'] == 'warning') {
		$class = 'alert-warning';
		$strong = 'Warning!';
	}

	$message = $actionresult['message'];

	return "
		<div class='alert {$class} alert-dismissable fade in'>
			<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong>{$strong}</strong> {$message}
		</div>
	";

}

//Action Result Rendering
function renderActionResult($actionresult) {

	if($actionresult['result'] == 'success') {
		$class = 'alert-success';
		$strong = 'Success!';
	}

	if($actionresult['result'] == 'fail') {
		$class = 'alert-danger';
		$strong = 'Failed!';
	}

	if($actionresult['result'] == 'warning') {
		$class = 'alert-warning';
		$strong = 'Warning!';
	}

	$message = $actionresult['message'];

	echo "
		<div class='alert {$class} alert-dismissable fade in'>
			<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong>{$strong}</strong> {$message}
		</div>
	";

}

//Post rendering
function renderPost($post, $page, $individual = false) {

	$Parsedown = new Parsedown();	

	echo "

	<p>
		<big>
			<b>
				". $post['title'] ."
			</b>
		</big>
		<br />
		<small>
			<i>
				Published: <b>". formatDate($post["datepublished"]) ."</b> <br />
				Author: <b>" . $post['author'] ."</b>
			</i>
		</small>
	</p>
	<p>
		<small>";

		if(!$individual) 
			echo $Parsedown->text(nl2br(wordsCut($post['body'], 100))) ."
				<a href='post.php?id=". $post['id'] ."&page=". $page ."' type='button' class='btn btn-default btn-xs'>Read More</a>";
		else 
			echo $Parsedown->text(nl2br($post['body']));
	
	echo "
		</small>
	</p>

	<hr />

	";

}

//Create Pagination
function pagination($currPage) {

	//Count all posts
	$pages = ceil( countPosts() / POST_PER_PAGE );

	$min = $currPage - 8;
	$max = $currPage + 8;

	$minpage = $min;
	$maxpage = $max;

	if($min < 1) {
		$minpage = 1;
		$maxpage = $max + abs($min);
	} 

	if($max > $pages) {
		$maxpage = $pages;
		$minpage = $min - ($max - $pages);
	}
	
	//Pagination container
	echo "<div id='pagination' style='float:right; padding-right: 20px;'>";

	//Previous button
	$disable = ($currPage == 1) ? 'disabled active' : ''; 
	echo "<a href='main.php?page=".($currPage - 1)."' type='button' class='btn btn-default btn-xs {$disable}' style='margin: 2px 2px;'>Previous</a>";

	if($min > 1) {
		echo ". . . ";
	}

	//Numbered buttons
	for($i = $minpage; $i <= $maxpage; $i++) {
		$disable = ($currPage == $i) ? 'disabled active' : ''; 
		echo "<a href='main.php?page={$i}' type='button' class='btn btn-default btn-xs {$disable}' style='margin: 2px 2px; min-width: 30px;'>{$i}</a>";
	}

	if($max < $pages) {
		echo ". . . ";
	}

	//Next button
	$disable = ($currPage == $pages) ? 'disabled active' : ''; 
	echo "<a href='main.php?page=".($currPage + 1)."' type='button' class='btn btn-default btn-xs {$disable}' style='margin: 2px 2px;'>Next</a>";

	echo "</div>";

}

//Cut post body by $howmany words
function wordsCut($words, $howmany) {

	$result = '';

	$expWords = explode(" ", $words);

	if(count($expWords) > $howmany) {
		for($i = 0; $i < $howmany; $i++) {
			$result .= " ". $expWords[$i];
		}
		$result .= "...";
	} 
	else $result = $words;
	

	return $result;

}

function formatDate($date) {
	return date("F j, Y g:s A", strtotime($date));
}

?>
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

$posts = getUserPosts($_SESSION['__email__']);

?>
<div class="panel panel-default">
	<div class="panel-heading"><strong>Dashboard</strong></div>
	<div class="panel-body">
		<a href="editor.php" type="button" class="btn btn-primary btn-sm" style="float: right;">Create New Post</a><br /><br />
	    <table class="table small table-striped table-hover">
		    <thead>
		      	<tr>
		        	<th>Title</th>
		        	<th width="200px">Date Published</th>
		        	<th width="200px">Date Created</th>	        	
		      	</tr>	      	
		    </thead>
		    <tbody>
		    <? if(count($posts) < 1) { ?>
		    	<tr>
		    		<td colspan="4">
		    			No post to show on this page.
		    		</td>
		    	</tr>
		    <? } else { ?>
			    <? foreach($posts as $post) { ?>
			      	<tr>
			        	<td>
			        		<a href="editor.php?id=<?=$post['id']?>">
			        			<?
			        			$title = $post['title'];
			        			if(strlen($title) > 80) echo substr($title, 0, 80). "..."; else echo $title;
			        			?>
			        		</a>
			        	</td>
			        	<td><?=($post['published']) ? formatDate($post['datepublished']) : '<b><i><font color="#bfbfbf">UNPUBLISHED</font></i></b>'?></td>
			        	<td><?=formatDate($post['datecreated'])?></td>
			      	</tr>
			    <? } ?>
		    <? } ?>
		    </tbody>
	    </table>
	</div>
</div>
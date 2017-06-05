//Submits action
function submitForm(action) {
	
	var id = $('#id').val();
	var title = $('#post_title').val();
	var body = simplemde.value();

	var data = '';

	//Move to Trash or Publish or Unpublish
	if(action == 'trash' || action == 'publish' || action == 'unpublish') {
		data = data + 'action=' + action + '&id=' + id;
		ajaxRequest(data);
	}

	//Create
	if(action == 'create') {
		data = data + 'action=create&title=' + title + '&body=' + body;
		ajaxRequest(data);
	}

	//Update
	if(action == 'update') {
		data = data + 'action=update&title=' + title + '&body=' + body + '&id=' + id;
		ajaxRequest(data);
	}

}

//Ajax Request
function ajaxRequest(data) {
  	
  	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'resources/app/action.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
	    	$('#alertrenderer').html(this.responseText).show();
	    	if(this.responseText.includes('Success!')) getEditorHTML();	    	
	  	}
	};

	xhr.send(data);

}

function getEditorHTML() {

	var id = $('#id').val();

  	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'resources/app/action.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
	    	$('#editorhtml').html(this.responseText);
	    	simplemde = new SimpleMDE({ 
				element: $("#post_editor")[0],
				autofocus: true,
				status: false,
				hideIcons: ["heading", "guide"],
				showIcons: ["strikethrough", "code", "table"],
				previewRender: function(plainText, preview) { 
					return preview.innerHTML = converter.makeHtml(plainText);
				}
			});
	  	}
	};

	xhr.send('action=geteditorhtml&id=' + id);	

}

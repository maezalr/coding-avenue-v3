function onSignIn(googleUser) {
  	var id_token = googleUser.getAuthResponse().id_token;
  	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'resources/auth/verifytoken.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if(xhr.responseText == "TRUE") window.location.replace("admin.php");
	};
	xhr.send('idtoken=' + id_token);
}

/*********************************************
THIS IS NOT WORKING!!!!!
/*********************************************
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      window.location.replace("logout.php");
    });
}

function onLoad() {
	gapi.load('auth2', function() {
		gapi.auth2.init();
	});
}
**********************************************/
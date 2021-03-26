function _(x) {
	return document.getElementById(x);
}

function savefiles () {
	var cpp_content = editor.getValue(); //save the value from the editor
	var request = new XMLHttpRequest(); //create an XMLHttpRequest object
	
	request.onload = function() {
    	if (this.readyState == 4 && this.status == 200) {
  			console.log("Successful");
    	// Success!
   			var resp = this.response;
  		} else {
    	// We reached our target server, but it returned an error
    	alert ("Target server reached, but it returned an error" );
 		}
	};

	request.onerror = function() {
	  // There was a connection error of some sort
	};
	request.open('POST', './save_contents.php', true); //request a "POST" method request to the server to open the file
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send('cpp_content=' + encodeURIComponent(cpp_content)); //send the value of the editor by using the the encodeURIComponent funtion
}

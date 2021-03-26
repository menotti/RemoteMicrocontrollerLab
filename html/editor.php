<html>
<head>
    <script type="text/javascript" src="sendContent.js"></script>
<script>
function save() {
savefiles(editorTA);
}
</script>



<script>
if (typeof XMLHttpRequest === "undefined") {
    XMLHttpRequest = function () {
        try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); }
        catch (e) {}
        try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); }
        catch (e) {}
        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
        catch (e) {}
        throw new Error("This browser does not support XMLHttpRequest.");
    };
}

function loadExample(file) {
    function reqListener () {
        //document.getElementById("editorTA").value = "teste";
        //txtinput = this.responseText;
	editor.getDoc().setValue(this.responseText);

    }

    var filePath = "http://datacom.bipes.net.br:5000/examples/" + file + ".txt";

    var oReq = new XMLHttpRequest();
    oReq.onload = reqListener;
    oReq.open("get", filePath, true);
    oReq.send();
}
</script>




</head>

<body>

<button id="save" onclick="savefiles(editorTA)">Save</button>
Exemplos:
<button onclick="loadExample('blink');">Blink</button>
<button onclick="loadExample('serial');">Serial Bits</button>
<button onclick="loadExample('echo');">Serial Echo</button>
<button onclick="loadExample('ethernet');">Ethernet Raw</button>

<textarea id=editorTA>

/*
  Blink
  Turns on an LED on for one second, then off for one second, repeatedly.
  This example code is in the public domain.
 */

void setup() {                
	// initialize the digital pin as an output.
	// Pin 13 has an LED connected on most Arduino boards:
	pinMode(13, OUTPUT);     
}

void loop() {
	digitalWrite(13, HIGH);   // set the LED on
	delay(1000);              // wait for a second
	digitalWrite(13, LOW);    // set the LED off
	delay(1000);              // wait for a second
}




</textarea>

<!-- Create a simple CodeMirror instance -->
<link rel="stylesheet" href="codemirror-5.58.1/lib/codemirror.css">
<script src="codemirror-5.58.1/lib//codemirror.js"></script>
<script src="codemirror-5.58.1/mode/clike/clike.js"></script>
<script>
  var editor = CodeMirror.fromTextArea(editorTA, {
     lineNumbers: true,
        matchBrackets: true,
        mode: "text/x-c++src"
  });
</script>


</body>
</html>




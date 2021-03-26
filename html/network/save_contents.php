<?php

$cpp_content = $_POST['cpp_content']; //save the content send by the .js file
$filename = 'packet.hex'; //save the name of the empty file

/*the following 3 lines of code are if you want to add the new content to an existing file.
$functionsFile = 'cpp_functions3.cpp';
$cpp_complete = file_get_contents($functionsFile);
$cpp_complete .= $cpp_content;*/

file_put_contents($filename, $cpp_content); //put content into the empty file

?>

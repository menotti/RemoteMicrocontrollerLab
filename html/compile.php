<!DOCTYPE html>
<html>
<body>


<?php

$dbHost="localhost"; //MySQL server
$dbUnam="reservas"; //database username
	$dbPwrd="mysql_pass"; //database password
$dbName="reservas"; //database name


global $con;
$con = mysqli_connect($dbHost, $dbUnam, $dbPwrd) or trigger_error("Erro ao acessar o Banco de Dados: " . mysqli_error($con));

mysqli_select_db($con, $dbName) or trigger_error("Erro ao acessar o banco de dados: " . mysqli_error($con));


if ($con) {
        $query="set names utf8";
        $result=mysqli_query($con,$query);
}


if (is_numeric($_GET['key'])) {

	$k=$_GET['key'];
	$sql = "SELECT * FROM slots WHERE akey=\"$k\"";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {

			$s=$row["start"];
			$e=$row["end"];

			$dt = date('Y-m-d H:i:s');
			echo "Sessão: Inicio: $s Fim: $e / Agora: $dt";

			$A = strtotime($s); //gives value in Unix Timestamp (seconds since 1970)
			$B = strtotime($e);
			$C = strtotime($dt);

			if ((($C < $A) && ($C > $B)) || (($C > $A) && ($C < $B)) ){
			  echo " liberado";
			   
			} else {
			   echo "<br><br>Esta chave so permite acesso no horário $s até $e";
			   if (strcmp($k, '25051979') == 0)
				   echo "Admin";
			   else 
				   //exit;
				   echo ".";
			}



		}
	} else {
		echo "<BR><center>Chave inexistente - agende um horário</center>";
		echo "<BR><center><a href=/agenda>Agenda</a></center>";
		echo "key=$k<BR>";
			   if (strcmp($k, '25051979') == 0)
			echo 'admin';
		else
			echo ".";
			//exit;
	}


	
} else {
	echo "<BR><center>Chave inválida - agende um horário</center>";
	echo "<BR><center><a href=/agenda>Agenda</a></center>";
		if ($k == '25051979') 
		echo 'admin';
	else
		//exit;
		echo ".";
}

?>



<?php
ob_implicit_flush(true);ob_end_flush(); 

$p = $_GET['target'];

echo "Iniciando ($p)...";

$cmd = "/bin/bash /home/rafael/DataComRemoteLab/compila.sh $p";

$descriptorspec = array(
   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
   2 => array("pipe", "w")    // stderr is a pipe that the child will write to
);
flush();
$process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());
echo "<pre>";
if (is_resource($process)) {
    while ($s = fgets($pipes[1])) {
        print $s;
        flush();
    }
}
echo "</pre>";

echo "FIM";


?>

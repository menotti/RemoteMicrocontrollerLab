<!DOCTYPE html>
<html>
<body>
<head>
        <title></title>
        <script>
            function changeSrc(loc) {
			//document.getElementById('iframeId').save();
                document.getElementById('iframeId').src = loc;
            }

	function openInNewTab(url) {
	  var win = window.open(url, '_blank');
	  win.focus();
	}
      </script>
    </head>
    <body>

<center>
Lab DATACOM Remoto - DC - UFSCar
<BR>

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


$go=1;
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
				$go=0;
			}



		}
	} else {
		echo "<BR><center>Chave inexistente - agende um horário</center>";
		echo "<BR><center><a href=/agenda>Agenda</a></center>";
		echo "key=$k";
			   if (strcmp($k, '25051979') == 0)
			echo 'admin';
		else
			$go=0;
	}


	
} else {
	echo "<BR><center>Chave inválida - agende um horário</center>";
	echo "<BR><center><a href=/agenda>Agenda</a></center>";
		if ($k == '25051979') 
		echo 'admin';
	else
		$go=0;
}

if ($go == 1) {
	echo "*";
} else {

	$sql = "select ID, title, sDate, sTime,  eTime from mycal_events WHERE sDate = date(now())";
	$result = mysqli_query($con, $sql);

	echo "<br>Agendamentos de hoje";
	echo "<br>";
	echo "<table border=1>";
	echo "<tr><td>Titulo</td><td>Data</td><td>Hora inicial</td><td>Hora final</td></tr>";
	$pode=1;
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {

			$id=$row["ID"];
			$t=$row["title"];
			$sd=$row["sDate"];
			$st=$row["sTime"];
			$et=$row["eTime"];

			$sql = "select ID, title, sDate, sTime,  eTime from mycal_events WHERE sDate = date(now()) AND time(now()) >= sTime AND time(now()) <= eTime AND ID=$id";
			$result2 = mysqli_query($con, $sql);
			if (mysqli_num_rows($result2) > 0) { 
				$x="<font color=red>";
				$pode=0;
			}
			else
				$x="<font color=black>";
			echo "<tr><td>$x $t</td><td>$sd</td><td>$st</td><td>$et</td></tr>";
		}
	}
	echo "</table>";

	if ($pode==1) {
		echo "Nao ha reserva para agora. Voce pode usar";
		echo "<br><br>";
	}
	else {
		echo "<center><br>Acesso negado. Horario reservado para outro usuario";
		exit;
	}
}

?>


</center>


	<button onclick="window.location.href='/diagrama'">Diagrama</button>
	<button onclick="window.location.href='http://datacom.bipes.net.br:8081'">Camera 1</button>
	<button onclick="window.location.href='http://uc.bipes.net.br:8090/cgi-bin/mjpg/video.cgi?subtype=1'">Camera 2</button>
	<button onclick="window.location.href='/agenda'">Agenda</button>
	<button onclick="changeSrc('/compile.php?key=<?php echo $k;?>')">Make</button>
        <button onclick="changeSrc('/compile.php?key=<?php echo $k;?>&target=upload')">Make & Upload</button>
        <button onclick="changeSrc('/compile.php?key=<?php echo $k;?>&target=clean')">Make Clean</button>
        <button onclick="openInNewTab('/terminal');">Serial Console</button>
        <button onclick="openInNewTab('/network');">Network Console</button>
    </body>




<p>Editor:
<br>
(Lembre de salvar (Save) antes de dar o Make)
<br>
<iframe src="/editor.php" width="100%" height="350">
</iframe>



<!--
<p>An iframe with a thin black border:</p>
<iframe src="/default.asp" width="100%" height="300" style="border:1px solid black;">
</iframe>
-->

<hr>
Console:

<iframe id="iframeId" src="/result.html" width="100%" height="300" style="border:none;">
</iframe>

</body>
</html>


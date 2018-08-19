<?php
	session_start();            
	$x = $_GET["X"];
	$y = $_GET["Y"];
	$r = $_GET["R"];
	$check;                   
	$currentTime = date('H:i:s',strtotime('-1 hour'));
	$runtime = microtime(true); 
	if (!isset($_SESSION['tableArray'])) {
		$_SESSION['tableArray'] = array();
	}    
?>
<html>
<head>
	<style type="text/css">
		table {
			border-radius:4px; 
			border: double 4px #555;
			font-size: 18px; 
			text-align: center;	
		}
		.parametr {
			width: 10%;
		}
	</style>
</head>
<body>
	<table border="1" cellpadding="0" cellspacing="0" width="80%" align="center" margin="auto">
		<tr>
			<th class="parametr">X</th><th class="parametr">Y</th><th class="parametr">R</th>
				<th width="15%">Result</th><th width="15%">Time</th><th width="20%">Runtime (µs)</th>
		</tr>
<?	
	if (is_numeric($x) && is_numeric($y) && is_numeric($r) && 
		$x>=-3 && $x<=5 && strlen($x)==strlen(intval($x)) &&
		$y>-3 && $y<3 &&
		$r>=1 && $r<=5 && ctype_digit(strval($r))) {
		if (
			($x <= 0 && $y >= 0 && (pow($x,2)+pow($y,2)) <= pow($r,2)) || 
			($x <= 0 && $x >= -$r && $y <= 0 && $y >= -$r/2) || 
			($x >= 0 && $y >= 0 && $y <= ($r/2-$x)))
			$check = "True";
		else
			$check = "False";
	}
	else $check = "Arguments are incorrect!";


	$runtime = round((microtime(true)-$runtime)*1000000,5);
	if (count($_SESSION['tableArray'])>19) {
		unset($_SESSION['tableArray'][0]);
		$_SESSION['tableArray'] = array_values($_SESSION['tableArray']);		
	}
	$_SESSION['tableArray'][] = "<tr><td>$x</td><td>$y</td><td>$r</td><td>$check</td><td>$currentTime</td><td>$runtime</td></tr>";
	foreach($_SESSION['tableArray'] as $row)
		echo $row;
?>	              
	</table> <br/>
</body>
</html>
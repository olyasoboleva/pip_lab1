<?php                                
	session_start();            
	$x = $_GET["X"];
	$y = $_GET["Y"];
	$r = $_GET["R"];
	$check;   
	$symbol;                
	$currentTime = date('H:i:s',strtotime('-1 hour'));
	$runtime = microtime(true); 
	if (!isset($_SESSION['tableArray'])) {
		$_SESSION['tableArray'] = array();
	}    
?>
<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
		body {                         
			font-family: monospace;
		}
		table {
			border-radius:4px; 
			border: double 4px #555;
			font-size: 18px;       
			text-align: center;
			margin-top: 30px;	
		}
		.parametr {
			width: 10%;
		}
		.classTrue{
			color: #00ff00;
		}
		.classFalse{
			color: #ff0000;
		}
	</style>
</head>
<body>
	<H2 align="center">Результаты</H2>
	<table border="1" cellpadding="0" cellspacing="0" width="80%" align="center" margin="auto">
		<tr>
			<th class="parametr">X</th><th class="parametr">Y</th><th class="parametr">R</th>
				<th width="15%">Result</th><th width="15%">Time</th><th width="20%">Runtime (µs)</th>
		</tr>
<?php	
	if (is_numeric($x) && is_numeric($y) && is_numeric($r) &&
		$x>=-3 && $x<=5 && strlen($x)==strlen(intval($x)) &&
		$y>-3 && $y<3 &&
		$r>=1 && $r<=5 && strlen($x)==strlen(intval($x))) {
		if (
			($x <= 0 && $y >= 0 && (pow($x,2)+pow($y,2)) <= pow($r,2)) || 
			($x <= 0 && $x >= -$r && $y <= 0 && $y >= -$r/2) || 
			($x >= 0 && $y >= 0 && $y <= ($r/2-$x))) {
			$check = "classTrue";
			$symbol = "&#10004;";
		}
				
		else  {
			$check = "classFalse";
			$symbol = "&#215;";
		}
	}
	else {
		$check = "Arguments are incorrect!";
	}                                                                                                       

	$runtime = round((microtime(true)-$runtime)*1000000,5);
	if (count($_SESSION['tableArray'])>19) {
		unset($_SESSION['tableArray'][0]);
		$_SESSION['tableArray'] = array_values($_SESSION['tableArray']);		
	}
	$_SESSION['tableArray'][] = "<tr><td>$x</td><td>$y</td><td>$r</td><td class=\"$check\">$symbol</td><td>$currentTime</td><td>$runtime</td></tr>";
	foreach($_SESSION['tableArray'] as $row){
		echo $row;
	}
?>	              
	</table> <br/>
</body>
</html>
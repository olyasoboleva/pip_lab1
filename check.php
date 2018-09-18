<?php                                
	session_start();            
	//$x = $_GET["X"];
	$x = strip_tags($_GET['X']);
	$y = strip_tags($_GET['Y']);
	$r = strip_tags($_GET['R']);
	$yR = str_replace(",",".",$y);
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
			font-size: 16px;       
			text-align: center;
			margin-top: 30px;	
		}
		.parametr {
			width: 15%;
		}
		.classTrue{
			color: #00ff00;
		}
		.classFalse{
			color: #ff0000;
		}
		th {
			font-size: 18px;
		}
	</style>
</head>
<body>
	<H2 align="center">Результаты</H2>
	<table border="1" cellpadding="0" cellspacing="0" width="80%" align="center">
		<tr>
			<th class="parametr">X</th><th class="parametr">Y</th><th class="parametr">R</th>
				<th width="17%">Result</th><th width="16%">Time</th><th width="22%">Runtime ,µs</th>
		</tr>
<?php	
	if (is_numeric($x) && is_numeric($yR) && is_numeric($r) &&
		$x>=-3 && $x<=5 && strlen($x)==strlen(intval($x)) &&
		$yR>-3 && $yR<3 &&
		$r>=1 && $r<=5 && strlen($r)==strlen(intval($r))) {
		$yR = (string)floatval($yR);  
		if (                      
			($x <= 0 && $yR >= 0 && (pow($x,2)+pow($yR,2)) <= pow($r,2)) || 
			($x <= 0 && $x >= -$r && $yR <= 0 && $yR >= -$r/2) || 
			($x >= 0 && $yR >= 0 && $yR <= ($r/2-$x))) {
			$check = "classTrue";
			$symbol = "&#10004;";
		}
				
		else  {
			$check = "classFalse";
			$symbol = "&#215;";
		}
	}
	else {
		$symbol = "Incorrectly";
		$check = "classFalse";
	}   
	if (strlen($x)>6) {$x = substr($x, 0, 6)."&#8230;";}
	if (strlen($y)>6) {$y = substr($y, 0, 6)."&#8230;";}
	if (strlen($r)>6) {$r = substr($r, 0, 6)."&#8230;";}                                                                                                    

	$runtime = round((microtime(true)-$runtime)*1000000,4);
	if (count($_SESSION['tableArray'])>49) {
		unset($_SESSION['tableArray'][0]);
		$_SESSION['tableArray'] = array_values($_SESSION['tableArray']);		
	}
	$_SESSION['tableArray'][] = "<tr><td>$x</td><td>$yR</td><td>$r</td><td class=\"$check\">$symbol</td><td>$currentTime</td><td>$runtime</td></tr>";
	foreach($_SESSION['tableArray'] as $row){
		echo $row;
	}
?>	              
	</table> <br/>
</body>
</html>
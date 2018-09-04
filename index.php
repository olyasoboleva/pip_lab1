<?php                                         
	session_start();    
?>
<!DOCTYPE html>

<html>

<head>
	<title>Lab1</title>  
	<meta charset="utf-8"> 
	<script src="script.js"></script>                                               
	<style type="text/css">
		body {                         
			text-align: center;
			font-family: monospace;
			height: 100%;
			background-color: #444;
			background-attachment: fixed;
			background: url(spb.png) bottom repeat-x;
			background-color: #444;
			background-attachment: fixed;
		}
		@keyframes city {
			from { background-position: -500px 100%, 0 0;}
			to { background-position: 339 100%; }
		}
		select {                  ;
			width: 100px;
		}
		table {
			margin: auto;
		}
		body>table {                                
			width: 50%;
			height: 100%;
			font-size: 18px;
			padding-top: 10px;  
			border-radius: 30px;
			border-color: none;
			background: #ddd; 
			border-collapse: collapse;   
		}
		th {
			font-family: monospace; 
			color: #444;
			font-size: 20px;
			height: 60px;                   
			border-bottom: 6px groove #888888;      		
		}                                     
		.formFields {
			margin-top: 20px;
		}
		input[type="text"], select{
			width:12em; 
			border-radius:2px; 
			border: solid 1px #ccc; 
			padding:1.2%;
			box-shadow: inset 0 1px 1px rgba(0,0,0,0.2);
		}
		input[type="text"] + label {
			margin: 20px;
		}
		select option:checked {
			font-weight: bold;			
		}                                               
		input[type="button"] { 
			padding:4% 6%;  
			border-radius:4px; 
			font-weight:bold; 
			font-size:18px;
			background: #ddd;
			border:solid 1px #999;
			box-shadow:0 1px 5px rgba(0,0,0,0.2);                                   
			background: -webkit-gradient(linear, 0 0, 0 100%, from(#ddd), to(#ccc));
			margin-bottom: 20px;                                       
		} 
		input[type="button"]:active {      
			box-shadow:none;
		}
		input[type="button"]:hover {
			background: -webkit-gradient(linear, 0 0, 0 100%, from(#ddd), to(#bbb));                                                                         
		}
		select:focus,input:focus {
			outline: none;
		}  
		form table {
			width: 60%;
		}                  
		form table td {
			padding-bottom: 5%;
		}           
		span {
			display: inline;
			font-size: 11px;
			color: #ff0000;
		}               
		#footer {                                                                       
			background: linear-gradient(to bottom, #ddd, #000);
			color: #000;
			height: 80px;			 	
		}   
		fieldset {                                                          
			border: 1px solid black;
			height: 100%; 
			width: 80%;
		}
		a:link,a:visited,a:active { 
			text-decoration: none; 
			color: #444;	
		}                        
		a:hover {
			text-decoration: underline;
			color: #444;
		}
		#canvas {
			background-color:#ffffff;
			border-radius: 20px;
			width: 300;
		}
	</style>
</head>

<body onunload="<?php session_destroy()?>" onload="createPanel('canvas',0,0,0);scaling();ajaxSend();">
	<table id="content" border="0" cellpadding="0" cellspacing="0">
		<tr>    
		        <th colspan="2">
				<table width="100%">
					<tr>
						<td><a href="https://isu.ifmo.ru/pls/apex/f?p=2143:GR:116320706676860::NO::GR_GR,GR_DATE:p3112,20.08.2018" target="_blank">Группа P3212</a></td>
						<td><a href="https://isu.ifmo.ru/pls/apex/f?p=2143:PERSON:116320706676860::NO:RP:PID:243887" target="_blank">Соболева О.А.</a></td>      
						<td>Вариант 28211</td>
					</tr>
				</table>
			</th>
		</tr>
		<tr height="350" valign="bottom">
			<td><canvas id="canvas" height="300"></canvas></td>                              
			<td>    
				<form class="from" action="check.php" method="get" id="formXYR" target="resultFrame" onkeydown="if(event.keyCode==13){createRequest();return false;}">
				  <fieldset>
					<legend><H2>Параметры</H2></legend>
					<label for "X"> X : </label>
					<select size=1 width=100px name="X">
						<option value="-3">-3</option>
						<option value="-2">-2</option>
						<option value="-1">-1</option>
						<option selected value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select><br>

					<label for="Y"> Y : </label>
 		        		<input class="formFields" id="Y" type="text" name="Y" placeholder="(-3 .. 3)" maxlength="8" 
						required title="Введите значение в промежутке от -3 до 3" onfocus="clearWarnings();" oninput="checkTextfield();clearWarnings();"><br>

					<span id="warning"><br/></span>
                                                                                         
					<table>
        					<tr>
                  					<td rowspan="2"> R : </td>
	        					<td>
							<input onchange="clearWarnings();likeRadiobox(this);" class="checkbox" type="checkbox" id="ch1" name="R" value=1>1</td>
        						<td>
							<input onchange="clearWarnings();likeRadiobox(this);" class="checkbox" type="checkbox" id="ch2" name="R" value=2>2</td>
        						<td>
							<input onchange="clearWarnings();likeRadiobox(this);" class="checkbox" type="checkbox" id="ch3" name="R" value=3>3</td>
        					</tr>
        					<tr>              
        						<td>
							<input onchange="clearWarnings();likeRadiobox(this);" class="checkbox" type="checkbox" id="ch4" name="R" value=4 checked>4</td>
        						<td></td><td>
							<input onchange="clearWarnings();likeRadiobox(this);" class="checkbox" type="checkbox" id="ch5" name="R" value=5>5</td>
	        				</tr>
              				</table>                                                                                                                                                         
					<input class="formFields" type="button" name="button" id="button" value="Проверить" disabled>
				  </fieldset>
        			</form>
			</td>
		</tr>
		<tr height="220">                                                                          
			<td colspan=2  valign="top"><iframe name="resultFrame" height="220" width="100%" id="resultFrame"
				frameborder="no" scrolling="no" seamless style="display:inline"
				onload="resizeFrame();"></iframe> </td>   
		</tr>
		<tr id="footer">
			<td rowspan="2"> 
				<img src="vt_logo.png" align="left" hspace="80" height="70"/>
			</td> 
			<td><p onclick="document.body.style.animation='city 30s linear infinite';">Санкт-Петербург<br/>2018</p></td>
		</tr>                
	</table>                                                                                                                               
		
	
</body>

</html>
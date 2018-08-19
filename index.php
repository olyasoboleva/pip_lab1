<?php
	session_start();
?>
<!DOCTYPE html>

<html>

<head>
	<title>Lab1</title>
	<meta charset="UTF-8" />
	<style type="text/css">
		body {
			background: #444;
			text-align: center;
			font-family: monospace;
			height: 100%;
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
			display: none;
			font-size: 12px;
			color: #ff0000;
		}               
		#footer {                                                                       
			background: linear-gradient(to bottom, #ddd, #444);
			color: #000;			 	
		}    
	</style>
</head>

<body onunload="<?php session_destroy()?>">
	<table id="content" border="0" cellpadding="0" cellspacing="0">
		<tr>    
		        <th colspan="2">
				<table width="100%">
					<tr>
						<td>Группа P3212</td>
						<td>Соболева О.А.</td>      
						<td>Вариант 28211</td>
					</tr>
				</table>
			</th>
		</tr>
		<tr height="420">
			<td><img src="graph.png" height="300"></td>                              
			<td>
				<H2>Параметры</H2>
				<form class="from" action="check.php" method="get" id="formXYR" target="resultFrame" onkeydown="if(event.keyCode==13){return false;}">
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
						required title="Введите значение в промежутке от -3 до 3" onfocus="clearWarnings();"><br>
                                                                                         
					<table class="formFields">
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
					<span id="radiusSpan">Выберите ровно один радиус!</span><br>                                                                                                     
					<input class="formFields" type="button" name="button" value="Проверить" onclick="validation()">
        			</form>
			</td>
		</tr>
		<tr height="130" >                                                                          
			<td colspan=2><iframe name="resultFrame" height="130" width="100%" id="resultFrame"
				frameborder="no" scrolling="no" seamless style="display:inline" vspace="20"
				onload="resizeFrame();"></iframe> </td>   
		</tr>
		<tr height="80px" id="footer">
			<td rowspan="2">  
				<img src="vt_logo.png" align="left" hspace="80" height="70"/>
			</td> 
			<td><p>Санкт-Петербург<br/>2018</p></td>
		</tr>                
	</table>                                                                                                                               
		
	<script type="text/javascript">
		function validation(){
			var form = document.forms[0];
			var chBoxes = document.getElementsByClassName("checkbox");
			var rChecked = 0;
			var success = true;
			var R = 0;
			for (var i=0;i<chBoxes.length;i++){
				if (chBoxes[i].checked){
					rChecked++;
					R = chBoxes[i].value;
				}
			}
			var X = form.X.value;
			var Y = form.Y.value;
			if (rChecked!=1){                                                  
				success = false;
				document.getElementById('radiusSpan').style.display="inline";
			}
			if (Y>=3 || Y<=-3 || Y.length>8 || isNaN(Y) || Y.length<1){          
			        document.getElementById('Y').style.border="1px solid red";                                             
				success = false;
			} else {
				document.getElementById('Y').style.border="1px solid green";
			}
			
			if (success){                                                        
				document.getElementById("formXYR").submit();                         	                	
			}
		}  

		function clearWarnings(){                                   
			document.getElementById('Y').style.border="1px solid #ccc";
			document.getElementById('radiusSpan').style.display="none";
		} 
         
		function resizeFrame(){                                                                     
			document.getElementById('resultFrame').height = document.getElementById('resultFrame').contentWindow.document.body.offsetHeight+15+'px';
			document.getElementById('resultFrame').parentElement.height = document.getElementById('resultFrame').contentWindow.document.body.offsetHeight+20+'px';
		        document.getElementById('resultFrame').style.display="block";
		}  

		function likeRadiobox(click){
			var chBoxes = document.getElementsByClassName("checkbox");
                        for (var i=0;i<chBoxes.length;i++){
				chBoxes[i].checked = false;				
				if (chBoxes[i].id==click.id){
					chBoxes[i].checked = true;
				}
			}
		}
		                                                      
	</script>
</body>

</html>
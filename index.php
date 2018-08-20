<?php                                         
	session_start();
?>
<!DOCTYPE html>

<html>

<head>
	<title>Lab1</title>  
	<meta charset="utf-8">                                                
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
			background: linear-gradient(to bottom, #ddd, #444);
			color: #000;			 	
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
			<td><canvas id="canvas" style="background-color:#ffffff; border-radius: 20px;" width="300" height="300"></canvas></td>                              
			<td>    
				<form class="from" action="check.php" method="get" id="formXYR" target="resultFrame" onkeydown="if(event.keyCode==13){return false;}">
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
						required title="Введите значение в промежутке от -3 до 3" onfocus="clearWarnings();"><br>

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
					<input class="formFields" type="button" name="button" id="button" value="Проверить" >
				  </fieldset>
        			</form>
			</td>
		</tr>
		<tr height="210">                                                                          
			<td colspan=2  valign="top"><iframe name="resultFrame" height="210" width="100%" id="resultFrame"
				frameborder="no" scrolling="no" seamless style="display:inline"
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
		function validation(X,Y,R,rChecked){
			var form = document.forms[0];
			var success = true;
			if (rChecked!=1){                                                  
				success = false;                                          
			}
			if (Y>=3 || Y<=-3 || Y.length>8 || isNaN(Y) || Y.length<1 || Y.charAt(0)=="."){          
			        document.getElementById('Y').style.border="1px solid red";                                                                    
				success = false;
				if (Y.length<1) document.getElementById('warning').innerHTML = "Введите X!";
				else if (Y.search(/^[0-9]+\,[0-9]+$/) != -1) document.getElementById('warning').innerHTML = "Дробная часть отделяется точкой!"; 
				else if (Y>=3) document.getElementById('warning').innerHTML = "Значение меньше 3!";
				else if (Y<=3) document.getElementById('warning').innerHTML = "Значение больше -3!";
				else if (isNaN(Y)||Y.charAt(0)==".") document.getElementById('warning').innerHTML = "X - целое или дробное число!";
			} else {
				document.getElementById('Y').style.border="1px solid green";
			}
			
			return success;
		}  

		function clearWarnings(){                                   
			document.getElementById('Y').style.border="1px solid #ccc";
			document.getElementById('warning').innerHTML = "<br/>";
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


		function ajaxSend(){
			var btn = document.getElementById('button');
  			var frame = document.getElementById('resultFrame');
                                                
			var request = new XMLHttpRequest();	
  			request.onreadystatechange = function() {
				if(request.readyState == 4) {
					if(request.status == 200) {
						frame.srcdoc = request.responseText; 
						frame.style.display="block";
						       
					} else {
						frame.innerHTML = 'Произошла ошибка при запросе: ' +  request.status + ' ' + request.statusText;
					}
				}
			}                   

			btn.addEventListener('click', function() {
				var url = 'check.php?';
				var R = 0;
				var form = document.forms[0];
				var chBoxes = document.getElementsByClassName("checkbox");
				var rChecked = 0;
			
				for (var i=0;i<chBoxes.length;i++){
					if (chBoxes[i].checked){
						rChecked++;
						R = chBoxes[i].value;
					}
				}
				var X = form.X.value;
				var Y = form.Y.value;
				url += 'X='+X+'&Y='+Y+'&R='+R;
				
				// определяем тип запроса
				request.open('Get', url);
			
				if (validation(X,Y,R,rChecked)){
					// отправляем запрос
					createPanel('canvas',X,Y,R);
					request.send();
				}
			});	
		}

		function scaling(){
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				document.getElementById("content").style.width = "80%";
			}
		}

		function createPanel(id,x,y,r){
			var canvas = document.getElementById(id),      
			ctx = canvas.getContext("2d");
			size = canvas.width;                 
			ctx.clearRect(0, 0, size, size);

			if (r!=0){
				//сектор
				ctx.beginPath();
				ctx.moveTo(size/2,size/2);
				ctx.arc(size/2,size/2,size*2/5,Math.PI,Math.PI*3/2,false);
				ctx.closePath();
				ctx.fillStyle = "blue";
				ctx.strokeStyle = "blue";
				ctx.fill();
				ctx.stroke();
	
				//треугольник
				ctx.beginPath();
				ctx.moveTo(size/2,size/2-size/5);
				ctx.lineTo(size/2+size/5,size/2);
				ctx.lineTo(size/2,size/2);
				ctx.lineTo(size/2,size/2-size/5);
				ctx.closePath();                           
				ctx.fill();
				ctx.stroke();
	
				//прямоугольник
				ctx.beginPath();           
				ctx.fillRect(size/10,size/2,size*2/5,size/5);
				ctx.closePath(); 

				ctx.fillStyle = "black";
				ctx.fillText("Y",size/2+size/20, size/30);
				ctx.fillText("X",size-size/30,size/2+size/10);	
				ctx.fillText(-r,size/10-size/30, size/2-size/15);
				ctx.fillText(-r/2,size*3/10-size/30, size/2-size/15);
				ctx.fillText(r/2,size*7/10-size/30, size/2-size/15);
				ctx.fillText(r,size*9/10-size/30, size/2-size/15);
				ctx.fillText(-r,size/2+size/30, size*9/10+size/30);
				ctx.fillText(-r/2,size/2+size/30, size*7/10+size/30);
				ctx.fillText(r/2,size/2+size/20, size*3/10+size/30);
				ctx.fillText(r,size/2+size/20, size/10+size/30); 
				
			}           
			else {
	       			ctx.font = "16px Calibri";  //подписи к осям   			ctx.fillStyle = "black";
				ctx.fillText("Y",size/2+size/20, size/30);
				ctx.fillText("X",size-size/30,size/2+size/10);
				ctx.fillText("-R",size/10-size/30, size/2-size/15);
				ctx.fillText("-R/2",size*3/10-size/30, size/2-size/15);
				ctx.fillText("R/2",size*7/10-size/30, size/2-size/15);
				ctx.fillText("R",size*9/10-size/30, size/2-size/15);
				ctx.fillText("-R",size/2+size/30, size*9/10+size/30);
				ctx.fillText("-R/2",size/2+size/30, size*7/10+size/30);
				ctx.fillText("R/2",size/2+size/20, size*3/10+size/30);
				ctx.fillText("R",size/2+size/20, size/10+size/30);                       	
			}

			//оси
			ctx.beginPath();
			ctx.moveTo(size/2,0);
			ctx.lineTo(size/2,size);
			ctx.moveTo(0,size/2);
			ctx.lineTo(size,size/2);

			ctx.moveTo(size/2,0);      //стрелки
			ctx.lineTo(size/2-size/30,size/30);
			ctx.moveTo(size/2,0);
			ctx.lineTo(size/2+size/30,size/30);
                        ctx.moveTo(size,size/2);      
			ctx.lineTo(size-size/30,size/2-size/30);
			ctx.moveTo(size,size/2);
			ctx.lineTo(size-size/30,size/2+size/30);


			ctx.moveTo(size/2+size/5,size/2-size/60);    //деления оси X
			ctx.lineTo(size/2+size/5,size/2+size/60);
			ctx.moveTo(size/2+size*2/5,size/2-size/60);
			ctx.lineTo(size/2+size*2/5,size/2+size/60);                
			ctx.moveTo(size/2-size/5,size/2-size/60);
			ctx.lineTo(size/2-size/5,size/2+size/60);
			ctx.moveTo(size/2-size*2/5,size/2-size/60);
			ctx.lineTo(size/2-size*2/5,size/2+size/60);

			ctx.moveTo(size/2-size/60,size/2+size/5); //деления оси Y
			ctx.lineTo(size/2+size/60,size/2+size/5);
			ctx.moveTo(size/2-size/60,size/2+size*2/5);
			ctx.lineTo(size/2+size/60,size/2+size*2/5);
			ctx.moveTo(size/2-size/60,size/2-size/5);
			ctx.lineTo(size/2+size/60,size/2-size/5);
			ctx.moveTo(size/2-size/60,size/2-size*2/5);
			ctx.lineTo(size/2+size/60,size/2-size*2/5);
			
			ctx.closePath();
			ctx.fillStyle = "black";
			ctx.strokeStyle = "black";
			ctx.fill();
			ctx.stroke();

			if (r!=0){
				//точка
				ctx.beginPath();
				ctx.arc(size/2+x*size*2/(5*r),size/2-y*size*2/(5*r),2,0,2*Math.PI)
				ctx.fillStyle = "red";
				ctx.fill();
				ctx.closePath();
			}                         
		}

		                                                      
	</script>
</body>

</html>
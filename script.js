//<script type="text/javascript">
	function validation(X,Y,R,rChecked){

		var form = document.forms[0];
		var success = true;
		var YR = Y.replace(",",".");
		if (rChecked!=1){                                                  
			success = false;                                          
		}             
		if (YR>=3 || YR<=-3 || YR.length>8 || isNaN(YR) || YR.length<1 || YR.search(/^\s+$/) != -1){          
		        document.getElementById('Y').style.border="1px solid red";                                                                    
			success = false;
			if (YR.length<1||(YR.search(/^\s+$/) != -1)) document.getElementById('warning').innerHTML = "Введите Y!";
			else if (YR>=3) document.getElementById('warning').innerHTML = "Значение меньше 3!";
			else if (YR<=-3) document.getElementById('warning').innerHTML = "Значение больше -3!";
			else if (isNaN(YR)) document.getElementById('warning').innerHTML = "Y - целое или дробное число!";
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
	var request;
        function ajaxSend(){
		var btn = document.getElementById('button');
  		var frame = document.getElementById('resultFrame');
                                               
		request = new XMLHttpRequest();	
  		request.onreadystatechange = function() {
			if(request.readyState == 4) {
				//alert("1");
				if(request.status == 200) {
					//alert("1");
					frame.srcdoc = request.responseText; 
					frame.style.display="block";
					       
				} else {
					frame.srcdoc = '<p align="center">Произошла ошибка при запросе: ' +  request.status + ' ' + request.statusText+'</p>';
				}
			}
		}                   
        		btn.addEventListener('click', createRequest);	
	}

	function createRequest(){
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
		
		//window.open(url, "_blank");   
		
		if (validation(X,Y,R,rChecked)){
			// отправляем запрос
			createPanel('canvas',X,Y.replace(",","."),R);
			request.send();
		}
	}

	function scaling(){                                       
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			document.getElementById("content").style.width = "80%";
			document.body.style.backgroundAttachment = "scroll";      
		}
	}
	function createPanel(id,x,y,r){
		var canvas = document.getElementById(id);	
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
	
	function checkTextfield(){
		var field = document.getElementById("Y").value;
		var btn = document.getElementById("button");
		if (field==""){
			btn.disabled = true;
		} else{
			btn.disabled = false;
		}				
	}                                                                 
//</script>
	window.onload=function  () {
		   var canvas=document.getElementById("canvas");
		   var cobj=canvas.getContext("2d");
		   var originx=120;
		   var originy=120;
		   var radius=100;
		  
		   setInterval(function  () {
		           cobj.clearRect(0,0,250,250);
		           audio.currentTime=0;
		
				   cobj.shadowColor="#888";
				   cobj.shadowOffsetX=1;
				   cobj.shadowOffsetY=1;
				   cobj.shadowBlur=3;
		
				   var colorObj=cobj.createRadialGradient(originx,originy,1,originx,originy,100);
				   colorObj.addColorStop(0,"#efefef"); 
				   colorObj.addColorStop(1,"#cecece"); 
				   cobj.fillStyle=colorObj;
				   cobj.lineWidth=8;
				   cobj.beginPath();
				   cobj.strokeStyle=colorObj;
				   cobj.arc(originx,originy,radius,0,2*Math.PI);
				   cobj.stroke();
				   cobj.fill();

				   cobj.shadowColor="#888";
				   cobj.shadowOffsetX=0;
				   cobj.shadowOffsetY=0;
				   cobj.shadowBlur=0;
				 
				   drawMark ()

					var date=new Date();
					var ha=date.getHours()*30+(date.getMinutes()*6/12)-90;
					var ma=date.getMinutes()*6-90;
					var sa=date.getSeconds()*6-90;
				
					drawPointer(55,ha,4,"#000");
				
					drawPointer(65,ma,3,"#888");
			
					drawPointer(75,sa,2,"#ff0000");

					cobj.shadowColor="#888";
					cobj.shadowOffsetX=1;
					cobj.shadowOffsetY=1;
					cobj.shadowBlur=3;
					cobj.fillStyle="#aaa";
					cobj.beginPath();
					cobj.arc(originx,originy,4,0,2*Math.PI);
					cobj.fill();
		   
		   },1000)
		  
		   //»­ÕëµÄº¯Êý
		   function drawPointer (radius,angle,width,color) {
		           cobj.lineWidth=width;
				   cobj.strokeStyle=color;
				   cobj.beginPath();
				   cobj.moveTo(originx,originy);
				   cobj.lineTo(originx+radius*Math.cos(angle*Math.PI/180),originy+radius*Math.sin(angle*Math.PI/180));
				   cobj.stroke();
		   }
       
		   function drawMark () {
		     for (var i=0; i<60; i++) {
			   var angle=i*6*Math.PI/180;
			   var radius1=radius-4;
			   var lw=2;
			   if(i%5==0){
			     radius1=radius-8;
				 lw=4
			   }
			   cobj.strokeStyle="#888";
			   cobj.lineWidth=lw;
			   cobj.beginPath();
			   cobj.moveTo(originx+radius*Math.cos(angle),originy+radius*Math.sin(angle));
			   cobj.lineTo(originx+(radius1)*Math.cos(angle),originy+(radius1)*Math.sin(angle));
			   cobj.stroke();
		     }
		   }
		}
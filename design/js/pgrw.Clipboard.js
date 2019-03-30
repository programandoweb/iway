/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
var imageObj 	= 	new Image();
window.onload 	= 	function() {
	document.getElementById("pasteTarget").addEventListener("paste", handlePaste);
	var canvas 	= 	document.getElementById('canvasTarget');
	var context = 	canvas.getContext('2d');
	imageObj.onload = function() {
		canvas.width=this.width;
		canvas.height=this.height;
		context.drawImage(imageObj, 0, 0);
		document.getElementById('base64image').value = canvas.toDataURL('image/jpeg');
		
		document.body.style.margin = 0;
		//canvas.style.position = 'fixed';
		var ctx =	context;
		//resize();
		var pos = { x: 100, y: 100 };
		
		//window.addEventListener('resize', resize);
		document.addEventListener('mousemove', draw);
		document.addEventListener('mousedown', setPosition);
		document.addEventListener('mouseenter', setPosition);
		
		// new position from mouse event
		function setPosition(e) {
		  pos.x = e.clientX;
		  pos.y = e.clientY;
		}
		
		// resize canvas
		function resize() {
			return false;
		  ctx.canvas.width 	= window.innerWidth;
		  ctx.canvas.height = window.innerHeight;
		}
		
		function draw(e) {
		  // mouse left button must be pressed
		  if (e.buttons !== 1) return;
		  ctx.beginPath(); // begin
		  ctx.lineWidth = 5;
		  ctx.lineCap = 'round';
		  ctx.strokeStyle = '#c0392b';
		  ctx.moveTo(pos.x, pos.y); // from
		  setPosition(e);
		  ctx.lineTo(pos.x, pos.y); // to
		  ctx.stroke(); // draw it!
		}
		
	};
};
function handlePaste(e) {
	for (var i = 0 ; i < e.clipboardData.items.length ; i++) {
		var item = e.clipboardData.items[i];
		if (item.type.indexOf("image") != -1) {
			//uploadFile(item.getAsFile());
			imageObj.src = URL.createObjectURL(item.getAsFile());
		} else {
			console.log("Discarding non-image paste data");
		}
	}
}

<div style="height: 40px;"></div>
<div class="container">
	<div class="row">		
		<div class="col-md-4 text-center">
			<canvas width="400" height="400" data-objeto="{'type':'bar','label':'# Roxana','text':'Ventas Globales',colores:['Yellow','Blue','Red'],valores:[12,19,3]}"></canvas>
		</div>
		<div class="col-md-4 text-center">
			<canvas width="400" height="400" data-objeto="{'type':'horizontalBar','label':'# Julian','text':'Ventas USD',colores:['Yellow','Blue','Red'],valores:[12,19,30]}"></canvas>
		</div>
		<div class="col-md-4 text-center">
			<canvas width="400" height="400" data-objeto="{'type':'doughnut','label':'# Julian','text':'Ventas USD',colores:['Yellow','Blue','Red'],valores:[12,5,3]}"></canvas>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 text-center">
			<canvas width="400" height="400" data-objeto="{'type':'polarArea','label':'# Julian','text':'Ventas USD',colores:['Yellow','Blue','Red'],valores:[12,19,3]}"></canvas>
		</div>
		<div class="col-md-4 text-center">
			<canvas width="400" height="400" data-objeto="{'type':'pie','label':'# Julian','text':'Ventas USD',colores:['Yellow','Blue','Red'],valores:[12,19,3]}"></canvas>
		</div>
		<div class="col-md-4 text-center" >
			<canvas width="400" height="400" data-objeto="{'type':'radar','label':'# Julian','text':'Ventas USD',colores:['Yellow','Blue','Red'],valores:[12,19,3]}"></canvas>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	var canvas	= 	$("canvas");	
	canvas.each(function(){
		makeCanvas($(this));
	})
});
</script>
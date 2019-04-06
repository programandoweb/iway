<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array('user_id' => $this->user->user_id,'campo' => "logo","redirect"=>base_url($this->uri->segment(1)."/ModificarImagen"));
#echo form_open_multipart(current_url(),array(),$hidden);	
?>
<div class="container" style="margin-bottom:20px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Cargar imágen de perfil</h3>
                    </div>
                </div>
                <div class="row form-group">
                	<div class="col-md-3">	
                    </div>
	                <div class="col-md-4">	
                    	<div id="cropper">
                        </div>                    	
                    </div>
                </div>
			</div>
        </div>
    </div>
</div>
<?php #echo form_close();?>
<script>
	$(document).ready(function(){
		$("#botonera").attr("disabled","disabled");	
		$(".btn-warning").click(function(){
			$("#botonera").removeAttr("disabled");	
		});
		$(".js-export").click(function(){
			$("#div1").append('<input type="hidden" value="'+$("#div1").find("img").attr("src")+'" name="image" />');
		});
	})
</script>
<script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="assets/js/jquery.mousewheel.min.js"></script>
<script src="assets/js/croppic.js"></script>
<style>
	#cropper {
		width: 350px;
		height: 350px;
		position:relative; /* or fixed or absolute */
	}
</style>
<script>
	var croppicContainerEyecandyOptions = {
		btnTitle:"Imagen de Perfil",
		uploadUrl:'<?php echo base_url("Configuracion/Add_Logo_Ajax")?>',
		cropUrl:'<?php echo base_url("Configuracion/Save_Logo_Ajax")?>',
		imgEyecandy:false,	
		modal:true,
		doubleZoomControls:true,
		rotateControls: false,			
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>',
		onBeforeImgUpload: function(){
			console.log('onBeforeImgUpload'); 
		},
		onAfterImgUpload: function(data){
			//document.location.reload();
			console.log('onAfterImgUpload') },
		onImgDrag: function(){ console.log('onImgDrag') },
		onImgZoom: function(){ console.log('onImgZoom') },
		onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
		onAfterImgCrop:function(){
			make_message("Importane","Por favor espere en breve será cargada tu imágen");
			setTimeout(() => {
				parent.location.reload(true);
			},5000); 
		},
		onReset:function(){ console.log('onReset') },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
	}	
	
	var cropperHeader = new Croppic('cropper', croppicContainerEyecandyOptions);
	
	
</script>
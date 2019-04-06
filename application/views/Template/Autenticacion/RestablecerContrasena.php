<?php 
$modulo		=	$this->ModuloActivo;
$hidden 	= 	array('token'=>$this->uri->segment(3),"redirect"=>base_url());
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:20px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Cambio de Contraseña</h3>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Contraseña Nueva *</b>
                    </div>
                    <div class="col-md-6">	
	                    <input name="clave_nueva" value="" id="clave_nueva" placeholder="Contraseña Nueva" class="form-control " type="password">	
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Repetir Contraseña*</b>
                    </div>
                    <div class="col-md-6">	
	                    <input value="" id="clave_nueva2" placeholder="Repetir Contraseña" class="form-control " type="password">	
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url();?>">Cerrar y Volver</a>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		$("form").submit(function(){
			if($("#clave_nueva").val()==''){
				alert("Ingrese la contraseña nueva");
				$("#clave_nueva").focus();
				return;
			}
			if($("#clave_nueva").val()==$("#clave_nueva2").val()){
				$.post($(this).attr("action"),$(this).serialize(),function(data){
					if(data.code==200){
						alert(data.message);
						document.location.href	=	"<?php echo base_url();?>";
					}else{
						alert(data.message);
					}
				},'json');
			}else{
				alert("las claves no coinciden");	
			}
		});
	});
</script>
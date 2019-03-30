<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array('type'=>$this->uri->segment(3),'user_id' => (isset($row->user_id))?$row->user_id:'',"redirect"=>base_url("Empresas/Listado"));
//pre($this->user);
echo form_open(current_url(),array('aja' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	
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
                    	<b>Contraseña Actual *</b>
                    </div>
                    <div class="col-md-6">
                    	<input name="clave_actual" value="" id="clave_actual" placeholder="Contraseña Actual" class="form-control "  type="password">	
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Contraseña Nueva *</b>
                    </div>
                    <div class="col-md-6">	
	                    <input name="clave_nueva" value="" id="clave_nueva" placeholder="Contraseña Nueva" class="form-control validar" type="password">	
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Repetir Contraseña*</b>
                    </div>
                    <div class="col-md-6">	
	                    <input value="" id="clave_nueva2" placeholder="Repetir Contraseña" class="form-control validar" type="password">	
                    </div>
                    <div id="alerta" class="col-md-6 offset-md-6 mt-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" disabled="disabled" class="btn btn-primary">Guardar</button>
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
        $('input').keyup(function() {
            var campo_validar = $(this).val(); 
            $(this).val(campo_validar.replace(/ /g, ""));
        });

        $(".validar").keyup(function() {
            comparar_pasword();
        });

        function comparar_pasword(){
            if($("#clave_nueva").val() == $("#clave_nueva2").val() ){
                    $("#alerta").html('');
                    $("button[type=submit]").removeAttr('disabled');
            }else{
                    $("#alerta").html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> Las contraceñas no coinciden.</div>');
                    $("button[type=submit]").attr('disabled','disabled');
            }    
        };

	/*	$("form").submit(function(){
             console.log('submit')
			if($("#clave_nueva").val()==$("#clave_nueva2").val()){
				$.post($(this).attr("action"),{clave_vieja:$("#clave_actual").val(),clave_nueva:$("#clave_nueva").val()},function(data){
					//console.log(data);
					if(data.code==200){
						//alert(data.message);
						document.location.href	=	"<?php echo base_url();?>";
					}else{
						//alert(data.message);
					}
				},'json');
			}else{
				alert("las claves no coinciden");	
			}
		});*/
	});
</script>
<?php 
$modulo		=	$this->ModuloActivo;
$row = get_NotificacionEmail(base_url("Utilidades/CorreoNotificacion/SolicitudPlataformas"));
$hidden = array();
if(!empty($row)){
    $correo = array();
    foreach ($row as $key => $value) {
        $correo[] = $value->correo;
    }
    $json_correo = json_encode($correo);
    $hidden = array("correos"=>$json_correo);
}
//pre($this->Usuarios->result);
//pre($this->user);
echo form_open($this->uri->segment(1).'/'.$this->uri->segment(2).'/50',array('ajax' => 'true'),$hidden);	?>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="col-md-12 mb-4">
                    <h3>Crear Solicitud de Plataformas.</h3>
                </div>
            </div>
            <div class="form group row col-md-12">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-2 text-right">
                                <b>Plataforma.</b>
                            </div>    
                            <div class="col-md-6 mt-2"> 
                                <?php echo MakePlataformas("plataforma",@$row->id_plataforma,array("class"=>"form-control"),$this->Usuarios->get_plataformas_rel_master(false));?>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-2 text-right">
                                <b>Nombres y Apellidos.</b>
                            </div>    
                            <div class="col-md-6 mt-2">    
                                <?php echo modelo("modelo","",array("class"=>"form-control","placeholder"=>"Modelo")); ?>
                            </div>
                            <div id="alerta_modelos" class="col-md-6 offset-md-6 mt-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-2 text-right">
                                <b>Usuario.</b>
                            </div>    
                            <div class="col-md-6 mt-2">    
                                <input type="text" class="form-control" name="usuario" id="Usuario" placeholder="Usuario">
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-2 text-right">
                                <b>Contraseña.</b>
                            </div>    
                            <div class="col-md-6 mt-2">    
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="confirmarPass" style="display:none;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-2 text-right">
                                <b>Confirmar Contraseña.</b>
                            </div>    
                            <div class="col-md-6 mt-2">    
                                <input type="password" class="form-control" id="password2" placeholder="Contraseña">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-2 offset-md-6">    
                                <?php echo set_input_checkbox("","mostrarCaracteres","",false,null); ?>
                                <b style="vertical-align:top">Mostrar Caracteres</b>
                            </div>
                        </div>
                    </div>
                </div>               
				<div class="col-md-12">
                    <div class="col-md-12">
                    	<div class="row">
                            <div class="col-md-6 mt-2 text-right">
                                <b>Bloquear País.</b>
                            </div>    
                            <div class="col-md-6 mt-2">    
                                <?php echo MakeSiNo("bloquear_pais",'',array("class"=>"form-control")); ?>
                            </div>
                        </div>
                    </div>
                </div>    
				<div class="col-md-12">
                    <div class="col-md-12">
                    	<div class="row">
                            <div class="col-md-6 mt-2 text-right">
                                <b>Prioridad.</b>
                            </div>    
                            <div class="col-md-6 mt-2">    
                               <?php echo MakePrioridad("prioridad",$estado=null,$extra=array("class"=>"form-control"));?>
                            </div>
                        </div>
                    </div>
                </div>                               
            </div>
	    </div>
		<div class="col-md-12 text-center">
        	<div class="form-group text-center">
            	<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
		</div>
	</div>                   
</div>                    
<?php echo form_close();?>
<script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function($) {
        $("#id_modelo").attr("name","nombre_modelo");
        $('#id_modelo').focusout(function(event) {
            id = $('#id_modelo_oculto').val();
                $.post('<?php echo current_url().'/form_control'; ?>',{id:id}, function($data){
                    console.log($data);
                    $json = JSON.parse($data);
                    console.log($json);
                    $('#Usuario').val($json.nickname);
                    $('#password').val($json.password);
                    $("#confirmarPass").fadeIn();
                    $("#confirmarPass").val($json.password);
                }); 
        });
        var pass = "";
        $("#password").focusout(function(){
            pass = $(this).val();
            if(pass == ""){
                $("#confirmarPass").fadeOut();
                $("button[type=submit]").removeAttr('disabled');
            }else{
                $("button[type=submit]").attr('disabled','disabled');
                $("#confirmarPass").fadeIn();
            }    
        });
        $("#password2").focusout(function(){
            var pass2 = $(this).val();
            if(pass.length > 0 && pass2.length > 0 ){
                if(pass == pass2){
                    $("button[type=submit]").removeAttr('disabled');
                }else{
                    make_message("Lo sentimos","Las contraceñas no coinciden");
                    $("button[type=submit]").attr('disabled','disabled');
                }
            }    
        });

        $('#mostrarCaracteres').change(function(){
            if($(this).prop("checked")){
                $("#password2").attr('type','text');
                $("#password").attr('type','text');
            }else{
                $("#password2").attr('type','password');
                $("#password").attr('type','password');
            }
        });

    });
</script>

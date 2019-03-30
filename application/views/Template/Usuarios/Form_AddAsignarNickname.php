<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$tipo_paginas = array();
foreach ($this->Usuarios->get_plataformas_rel_master(false) as $k => $v) {
	if($v->tipo_persona == "Free" || $v->tipo_persona == "PVT" || $v->tipo_persona == "RPH"){
		$tipo_paginas[] = $v->user_id;
	}else{
        $tipo_rss[] = $v->user_id;
    }
}
if(@$row->id_modelo){
	$user2				=	centrodecostos($row->id_modelo);	
	$_centro_de_costos	=	$user2->centro_de_costos;
}else{
	$user2				=	centrodecostos($this->uri->segment(3));	
	$_centro_de_costos	=	$user2->centro_de_costos;
	//$user2				=	$this->uri->segment(3);	
	//$_centro_de_costos	=	$this->user->centro_de_costos;
}
$perfil_profecional = @json_decode($row->opciones_adicionales)->perfil_profesional;
$hidden 	= 	array("centro_de_costos"=>$_centro_de_costos,"rss"=>json_encode($tipo_rss),"id_modelo"=>$user2->user_id,'nickname_id' => (isset($row->nickname_id))?$row->nickname_id:'');
echo form_open(current_url(),array('aja' => 'true'),$hidden);?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Plataforma *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakePlataformas("id_plataforma",@$row->id_plataforma,array("class"=>"form-control","require"=>"require"),$this->Usuarios->get_plataformas_rel_master(false));?>
                    </div>
				</div>
                <div class="row form-group Opciones_especiales">
	                <div class="col-md-3 text-right">	
                    	<b>Master *</b>
                    </div>
                    <div class="col-md-6">	
                    	<?php echo MakeMaster();?>
                    </div>

				</div> 
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Usuario</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nickname",@$row,$placeholder='Nickname');?>
                        <div class="alerta1 mt-2">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Contraseña</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php 
							set_input("password",@$row,$placeholder='Contraseña');?>
                    </div>
                </div>
                <div class="row form-group Opciones_especiales">
                    <div class="col-md-3 text-right">	
                    	<b>Perfil profesional</b>
                    </div>
                    <div class="col-md-3 row ml-5">
                    	<h6 class="mr-2">Si</h6>
                    	<div class="col-md-3">	
	                    	<?php echo set_input_radio("perfil_profesional","","Si",(@$perfil_profecional=="Si")?true:false,"custom-control-input",""); ?>
	                    </div> 
                    </div>
                    <div class="col-md-3 row">
                    	<h6 class="mr-4">No</h6>	
	                    <?php echo set_input_radio("perfil_profesional","","No",(@$perfil_profecional=="No")?true:false,"custom-control-input",""); ?> 
                    </div>
                </div>
                <div class="row form-group Opciones_especiales">
                    <div class="col-md-3 text-right">	
                    	<b>Bloqueo País</b>
                    </div>
                    <div class="col-md-3 row ml-5">
                    	<h6 class="mr-2">Si</h6>
                    	<div class="col-md-3">	
	                    	<?php echo set_input_radio("bloqueo_pais","","Si",(@$row->bloqueo_pais=="Si")?true:false,"custom-control-input",""); ?>
	                    </div> 
                    </div>
                    <div class="col-md-3 row">
                    	<h6 class="mr-4">No</h6>	
	                    <?php echo set_input_radio("bloqueo_pais","","No",(@$row->bloqueo_pais=="No")?true:false,"custom-control-input",""); ?> 
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-3 text-right">	
                    	<b>Estado</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div>
                <div class="row">
                    <div id="alerta2" class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" disabled = "disabled">Guardar</button>
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
        var redes = '<?php echo @json_encode($tipo_rss); ?>';
        var url = '<?php echo base_url('Usuarios/consultarModelos_x_Master'); ?>';
        var id_modelo = '<?php echo $this->uri->segment(3); ?>';
        function consultarUsuario_x_master($usuario){
            $.post(url,$usuario,function(data){
            },'json').fail(function() {
                make_message("Error","Ha ocurrido un error al conectar con la base de datos por favor informe al administrodor del sistema");
            }).done(function(data){
                if(!$.isEmptyObject(data)){
                    $('.alerta1').html('<div class="alert alert-danger" role="alert"><strong>Importante! </strong>Este usuario ya está registrado para esta plataforma y esta master, por favor escoja otro</div>');
                }else{
                    $('.alerta1').html('');
                }
            });
        }
        $('#nickname').keyup(function() {
            var plataforma = $('#id_plataforma').val();
            var master     = $('#id_master').val();
            var usuario    = $(this).val();
            var array_usuario = {plataforma:plataforma,master:master,usuario:usuario,id_modelo:id_modelo}
            consultarUsuario_x_master(array_usuario);
        });
        var array   =   <?php echo json_encode($tipo_paginas); ?>;
        var valor   =   parseInt($("#id_plataforma").val());
        $("."+valor).each(function(k,v){
            $(v).show();
            if($(v).val()=='<?php echo @$row->id_master;?>'){
                $(v).attr("selected","selected");
            }
        });
        function prueba(id_plataforma){
            var valor   =   id_plataforma;
            if($.inArray(valor, array) == -1){
                $(".Opciones_especiales").hide();   
            }else{
                $(".item_plataforma ").hide();
                $(".Opciones_especiales").show();   
                $("." +parseInt(valor)).show();
                $("#id_master").val('');
            }
        }
        if(!$.isEmptyObject($("#id_plataforma").val())){
            prueba($("#id_plataforma").val());
        }
		//$(".Opciones_especiales").hide();	
		$("#id_plataforma").change(function(){
            prueba($(this).val());
		});
        $("#id_master").val('<?php echo @$row->id_master; ?>');
        $("select").change(function(){
            var plataforma = $("#id_plataforma").val();
            if(redes.indexOf(plataforma) < 0){
                validar_master();
            }else{
                $("button[type='submit']").removeAttr("disabled");
                $("#alerta2").html("");
            }
        });
        $("input").keyup(function(){
            var plataforma = $("#id_plataforma").val();
            if(redes.indexOf(plataforma) < 0){
                validar_master();
            }else{
                $("button[type='submit']").removeAttr("disabled");
                $("#alerta2").html("");
            }
        });
        function validar_master(){
            if($("#id_master").val() == null){
                $("button[type='submit']").attr("disabled","disabled");
                $("#alerta2").html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> No puede continuar sin seleccionar master.</div>');
            }else{
                $("button[type='submit']").removeAttr("disabled");
                $("#alerta2").html("");
            }
        }
	});
</script>
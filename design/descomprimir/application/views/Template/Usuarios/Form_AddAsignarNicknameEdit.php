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
$hidden 	= 	array("id_modelo"=>$this->uri->segment(3),'nickname_id' => (isset($row->nickname_id))?$row->nickname_id:'');
echo form_open(current_url(),array('aja' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Página *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakePlataformas("id_plataforma",@$row->id_plataforma,array("class"=>"form-control","require"=>"require"),$this->Usuarios->get_plataformas_rel_master(false));?>
                    </div>
				</div>
                <div class="row form-group" id="contenedor_master">
	                <div class="col-md-3 text-right">	
                    	<b>Master *</b>
                    </div>
                    <div class="col-md-6">	
                       	<?php echo MakeMaster();?>
                    </div>
				</div> 
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Nickname</b>
                    </div>
                    <div class="col-md-6">	
                    	<?php #pre($row->nickname);?>
	                    <?php set_input("nickname",@$row,$placeholder='Nickname');?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Contraseña</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("password",@$row->password,$placeholder='Contraseña');?>
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
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
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
		$(".item_plataforma").hide();
		if($("#id_plataforma").val()=='00000000156' || $("#id_plataforma").val()=='00000000155' || $("#id_plataforma").val()==''){
			$("#contenedor_master").hide();	
		}else{
			$("#contenedor_master").show();	
		}
		$("#id_plataforma").change(function(){
			$(".item_plataforma").hide();
			var valor 	= 	parseInt($(this).val());
			
			$("."+valor).show()
			if($("#id_plataforma").val()=='00000000156' || $("#id_plataforma").val()=='00000000155' || $("#id_plataforma").val()==''){
				$("#contenedor_master").hide();	
			}else{
				$("#contenedor_master").show();	
			}
		});
	});
</script>
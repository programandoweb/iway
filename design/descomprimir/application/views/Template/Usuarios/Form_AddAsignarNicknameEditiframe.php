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
$plataforma	=	centrodecostos(@$row->id_plataforma);
$hidden 	= 	array("nickname_id"=>$this->uri->segment(3),"id_empresa"=>$this->user->id_empresa,"plataforma"=>@$plataforma->primer_nombre);
echo form_open(current_url(),array('aja' => 'true'),$hidden);	
//pre($row);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
            	<div class="row form-group">
	                <div class="col-md-12 text-center">	
                    	<b>Atención:</b> el sistema no tomará los cambios, mientras la modelo no se encuentre creada,
                        al guardar cambios verifique que la casilla de estado sea "activo".
                    </div>
                </div>
	            <div class="row form-group" id="contenedor_master">
	                <div class="col-md-3 text-right">	
                    	<b>Modelo *</b>
                    </div>
                    <div class="col-md-6">	
                       	<?php 
							echo modelo($row, $estado = null,$extra=array("class"=>"form-control"));
						?>
                    </div>
				</div> 
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Página *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 
							
							echo $plataforma->primer_nombre;
							//pre($plataforma);
						?>
                    </div>
				</div>
                <div class="row form-group" id="contenedor_master">
	                <div class="col-md-3 text-right">	
                    	<b>Master *</b>
                    </div>
                    <div class="col-md-6">	
                       	<?php 
							echo master($row, $estado = null,$extra=array("class"=>"form-control"));
						?>
                    </div>
				</div> 
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Nickname</b>
                    </div>
                    <div class="col-md-6">	
                    	<?php #pre($row->nickname);?>
	                    <?php set_input("nickname",@$row,$placeholder='Nickname',false,"",array("readonly"=>"readonly"));?>
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
                        <?php 
							echo MakeEstado("estado",(isset($row->estado) && $row->estado!=0)?$row->estado:1,array("class"=>"form-control","require"=>"require"));?>
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
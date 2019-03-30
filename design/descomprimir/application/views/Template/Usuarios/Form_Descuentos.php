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
$hidden 	= 	array("iframe"=>"Add_Todos_Iframe","user_id"=>$this->uri->segment(3),"id_empresa"=>$row->id_empresa,"centro_de_costos"=>$row->centro_de_costos);
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Concepto *</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo MakeDescuentosConceptos("concepto",@$row->concepto,array("class"=>"form-control","require"=>"require"));?>
                    </div>
				</div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Observación</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php
							$data = array(
								'name'        => 	'observacion',
								'id'          => 	'observacion',
								'value'       =>  	@$row->observacion,
								'rows'        => 	'5',
								'cols'        => 	'5',
								'style'       => 	'width:100%',
								'class'       => 	'form-control'
							);
							echo form_textarea($data);
						?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Monto.</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("valor",@$row,$placeholder='Monto');?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>No. Quincenas.</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nro_quincenas",@$row,$placeholder='No. Quincenas');?>
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
		$("#nro_cuenta").mask("9999-9999-9999-9999");
	});
</script>
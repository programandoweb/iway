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
$hidden 	= 	array("iframe"=>"Add_Todos_Iframe");
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-4 text-right">	
                    	<b>Tercero *</b>
                    </div>
                    <div class="col-md-6">	
                       <?php 
							echo modelo($row, $estado = null,$extra=array("class"=>"form-control","name"=>"user_id"));
						?>
                        <input type="hidden" name="centro_de_costos" id="centro_de_costos"/>
                    </div>
				</div>
                <div class="row form-group">
                    <div class="col-md-4 text-right">	
                    	<b>Concepto *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php //set_input("concepto",@$row,$placeholder='Concepto');?>
                        <?php 
                            echo autocomplete_concepto("concepto",@$row, $estado = null);
                        ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4 text-right">	
                    	<b>Observación *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php #set_input("observacion",@$row,$placeholder='Observación');
							$data = array('name' => 'observacion','value' =>@$row, 'id'=>'observacion',  'class' => 'form-control' ,'rows' => '3', 'cols' => '40','require'=>'true');
							echo form_textarea($data);
						?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4 text-right">	
                    	<b>Monto *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("valor",@$row,$placeholder='Monto',true,"form-control money");?>
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
<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
	if(!centro_de_costos()){
		return;
	}
?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array();
echo form_open(current_url(),array(),$hidden);	?>
<div class="container" style="margin-bottom:20px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Sucursal *</b>
                    </div>
                    <div class="col-md-6">	
                    	<?php 
							echo MakeCentrodeCostos($this->user->id_empresa,@$row->centro_de_costos);
						?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Tipo de Gasto *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeGasto("tipo_gasto",$row,array("class"=>"form-control"));?>
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Concepto de Gasto</b>
                    </div>
                    <div class="col-md-6">	
                    	<input type="hidden" id="concepto_gastos" name="concepto_gasto" require />
						<?php 
                            echo autocomplete_gastos_operacionales($row, $estado = null,$extra=array("class"=>"form-control replicar","data-rel"=>"concepto"),$subfuncion='complete_key');
                        ?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Valor </b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("valor",$row,$placeholder='Valor',$require=false,"firstLetterText money");?>
                    </div>
				</div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Observacion </b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo form_textarea("observacion",$row,$atrr=array("class"=>"form-control","id"=>"observacion"));?>
                    </div>
                </div>                
                <div class="text-center" id="btn-generar">
                        <button type="submit" class="btn btn-primary btn-md">Agregar</button>
                </div>                                     
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
	function complete_key(obj){
		$("#concepto_gastos").val(obj.value);
	}
</script>	
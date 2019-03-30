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
$hidden = array('id_escala' => (isset($row->id_escala))?$row->id_escala:'',"redirect"=>base_url("Ventas/Escalas"));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}
	set_input_hidden("id_empresa","id_empresa",$this->user->id_empresa);
	set_input_hidden("centro_de_costos","centro_de_costos",$this->user->centro_de_costos);			
?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Maestro Escala de Pagos</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre Escala *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nombre_escala"  placeholder="Nombre Escala" value="<?php echo (isset($row->nombre_escala))?$row->nombre_escala:''?>" <?php echo (isset($row->nombre_escala))?'readonly="readonly"':''?>  require/>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Porcentaje descuento Dólar *</b>
                    </div>
                    <div class="col-md-6">
                    	<div class="input-group">	
	                        <input type="text" class="form-control" name="porcentaje_descuento_dolar"  id="porcentaje_descuento_dolar"  placeholder="Porcentaje de Pago (Bonificación)" value="<?php echo (isset($row->porcentaje_descuento_dolar))?$row->porcentaje_descuento_dolar:''?>" require  />
                            <span class="input-group-addon" >%</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Meta *</b>
                    </div>
                    <div class="col-md-6">	
	                    <div class="input-group">
                        	<input type="text" class="form-control" name="meta"  placeholder="Meta" value="<?php echo (isset($row->meta))?$row->meta:''?>" require  />
                            <span class="input-group-addon" >Tokens</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Salario *</b>
                    </div>
                    <div class="col-md-6">
                    	<div class="input-group">	
                            <input type="text" class="form-control" name="salario"  placeholder="Salario" value="<?php echo (isset($row->salario))?$row->salario:''?>" require  />
                            <span class="input-group-addon" >COP</span>
						</div>                        
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Auxilio de Transporte *</b>
                    </div>
                    <div class="col-md-6">
	                    <div class="input-group">	
                            <input type="text" class="form-control" name="auxilio_transporte"  placeholder="Auxilio de Transporte" value="<?php echo (isset($row->auxilio_transporte))?$row->auxilio_transporte:''?>" require  />
                            <span class="input-group-addon" >COP</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>EPS *</b>
                    </div>
                    <div class="col-md-6">	
	                    <div class="input-group">
                            <input type="text" class="form-control" name="eps"  placeholder="EPS" value="<?php echo (isset($row->eps))?$row->eps:''?>" require  />
                            <span class="input-group-addon" >COP</span>
						</div>                            
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>ARL *</b>
                    </div>
                    <div class="col-md-6">	
	                    <div class="input-group">
                            <input type="text" class="form-control" name="arl"  placeholder="ARL" value="<?php echo (isset($row->arl))?$row->arl:''?>" require  />
                            <span class="input-group-addon" >COP</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Caja Compensación *</b>
                    </div>
                    <div class="col-md-6">	
                    	<div class="input-group">
                            <input type="text" class="form-control" name="caja_compensacion"  placeholder="Caja Compensación" value="<?php echo (isset($row->caja_compensacion))?$row->caja_compensacion:''?>" require  />
                            <span class="input-group-addon" >COP</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Pensión *</b>
                    </div>
                    <div class="col-md-6">	
	                    <div class="input-group">
                            <input type="text" class="form-control" name="pension"  placeholder="Pensión" value="<?php echo (isset($row->pension))?$row->pension:''?>" require  />
                            <span class="input-group-addon" >COP</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Porcentaje de Pago (Bonificación) *</b>
                    </div>
                    <div class="col-md-6">
                    	<div class="input-group">	
	                        <input type="text" class="form-control" name="bonificacion"  id="bonificacion" placeholder="Bonificación" value="<?php echo (isset($row->bonificacion))?$row->bonificacion:''?>" require  />
                            <span class="input-group-addon" >%</span>
                        </div>
                    </div>
                </div>
                
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Prima *</b>
                    </div>
                    <div class="col-md-6">
                    	<div class="input-group">	
	                        <input type="text" class="form-control" name="prima"  placeholder="Prima" value="<?php echo (isset($row->prima))?$row->prima:''?>" require  />
                            <span class="input-group-addon" >%</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Factor Bonificación *</b>
                    </div>
                    <div class="col-md-6">
                     	<div class="input-group">	
                            <input type="text" class="form-control" name="factor_bonificacion" id="factor_bonificacion" readonly="readonly"  placeholder="Factor Bonificación" value="<?php echo (isset($row->factor_bonificacion))?$row->factor_bonificacion:''?>" require  />
                            <span class="input-group-addon" >%</span>
                        </div>
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado Escala</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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
		var porcentaje_descuento_dolar = $("#porcentaje_descuento_dolar");
		var bonificacion=$("#bonificacion");
		var factor_bonificacion=$("#factor_bonificacion");
		bonificacion.keyup(function(){
			if(porcentaje_descuento_dolar.val()==''){
				alert("Debe suministrar el % de descuento por dólar");
				porcentaje_descuento_dolar.focus();				
			}else{
				var calculo		=	parseFloat(bonificacion.val()) /100;
					calculo		=	calculo * 0.05;
					calculo		= 	calculo	* (1 - parseFloat((porcentaje_descuento_dolar.val() /100)));
					factor_bonificacion.val(parseFloat(calculo).toFixed(6));	
			}
		});
	});
</script>
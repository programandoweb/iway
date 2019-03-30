<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo				=	$this->ModuloActivo;
$row				=	$this->$modulo->result;
$fecha				=	date("Y-m-d");
$ciclo_informacion	=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
$periodo_pagos		=	centrodecostos($this->user->id_empresa);
$ciclopago			=	ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
$hidden 			= 	array();
echo form_open(base_url("Reportes/MakeFactura2"),array('ajaxing' => 'true'),$hidden);?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                    	<div class="card-header" role="tab" id="headingOne">
                    		<h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                   	¿Proveedor?
                                </a>
                                <a class="btn btn-primary pull-right ligthbox" title="Agregar Proveedor" data-type="iframe" href="<?php echo base_url("Usuarios/Add_Todos_IFRAME_ADD/Proveedores/Reportes/Add_Factura2")?>">
                                <i class="fa fa-plus" aria-hidden="true"></i></a>
                    		</h5>
                		</div>
                		<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                			<div class="card-block">
								<?php 
                                	echo proveedores(@$row,$estado = null,$extra=array("class"=>"form-control"),'subfuncion');
                                ?>
                			</div>
                		</div>
                	</div>
                	<div class="card">
                		<div class="card-header" role="tab" id="headingTwo">
                			<h5 class="mb-0">
                				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                					Detalle facturación
                				</a>
                			</h5>
                		</div>
                		<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                			<div class="card-block" id="contenedor_ajax">
                            	<div class="row" style="margin-bottom:40px;">
                                	<div class="col-md-2 text-left">
                                    	Expedición:<BR />
	                                    <input id="fecha_emision" type="text" name="fecha_emision" class="form-control datepicker" />
                                    </div>
                                    <div class="col-md-2 text-left">
                                    	Vencimiento:
	                                    <input id="fecha_vencimiento" type="text" name="fecha_vencimiento" class="form-control datepicker" />
                                    </div>
                                    <div class="col-md-3 text-left">
                                    	Nro factura:
	                                    <input id="factura" type="text" name="nro_documento_ext" class="form-control" />
                                    </div>
                                    <div class="col-md-3 text-left">
                                    	Moneda:
                                        <?php echo  MakeMonedas("moneda","Pesos",array("id"=>"moneda","class"=>"form-control"));?>
                                    </div>  
                                    <div class="col-md-2 text-left">
                                    	TRM:
	                                    <input id="trm" type="text" name="trm" class="form-control" disabled="disabled" />
                                    </div>                              
                                </div> 
                                
                                <div class="row">
                                	<div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Concepto</th>
                                                    <th class="text-center" width="200">Total</th>
                                                    <th class="text-center" width="100">Acción</th>
                                                </tr>
                                            </thead>                                            
                                            <tbody id="tbody">
                                                <tr clonar="true" data-padre="tbody">
                                                    <td>
                                                    	<span class="concepto d-none" id="mostrarme"></span>
                                                        <?php 
															echo autocomplete_gastos_operacionales($row, $estado = null,$extra=array("class"=>"form-control replicar","data-rel"=>"concepto"),$subfuncion='complete_key');
														?>
													</td>
                                                    <td class="text-right">
	                                                    <span class="monto d-none"></span>
                                                    	<input type="text" name="valor[]" data-type="number" data-rel="monto" class="form-control replicar text-right"/>
                                                    </td>
                                                    <td class="text-center">
                                                    	<div class="btn btn-primary clonar">
                                                        	<i class="fa fa-plus"></i>
                                                        </div>
                                                    </td>
                                                </tr>                                            
                                            </tbody>
                                        </table>
									</div>                                        
                                </div>              					
								<div class="row" style="margin-top:20px">
                                	<div class="col-md-12">
                                    	<input type="submit" value="Guardar" class="btn btn-primary" />
                                    </div>
								</div>                                    
                			</div>
                		</div>
                	</div>
                </div>                  
			</div>
        </div>
    </div>
    <input type="hidden" id="ciclo_de_produccion" name="ciclo_de_produccion" require="require" value="<?php print($ciclopago);?>" />
    
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		$("#moneda").change(function(){
			if($(this).val()!='Pesos' && $(this).val()!=''){
				$("#trm").removeAttr("disabled");
			}else{
				$("#trm").attr("disabled","disabled");
			}
		});
		$(".replicar").keyup(function(){
			if($(this).data("type")=='number'){
				$(this).parent("td").find("span").html("$"+parseFloat($(this).val()).toFixed(2));
			}
		});
		$( ".datepicker" ).datepicker();
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
		$( "#fecha_emision" ).val("<?php echo $fecha;?>");
		$( "#fecha_vencimiento" ).val("<?php echo calculo_fechas($fecha,'+5');?>");
		$("#nombre_legal").click(function(){
			console.log($(this).val());
		});
	});
	
	function complete_key(obj){
		$("#mostrarme").html(obj.value);
	}
	function subfuncion(){
		$('#collapseOne').collapse('hide');
		$('#collapseTwo').collapse('show');
	}
</script>
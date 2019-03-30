<?php
	$modulo		=	"Usuarios";
	$hidden 	= 	array("reporte_diario_id"=>$this->uri->segment(3));
	if(count($this->$modulo->result)==0){ 
		$hidden	=	array('onsubmit' => 'return false');
	}
	echo form_open(current_url(),$hidden,$hidden);	
	$me		=	centrodecostos($this->user->user_id);
	if($me->type!='Modelos'){
		echo '<h2 class="text-center">Seleccione un perfil modelo</h2>';
		echo 'Actual '.$this->user->type;
		return;	
	}
?>
<script>
	$( function() {
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
	});
</script>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row form-group">
                <div class="col-md-6 text-right">	
                    <b>Fecha *</b>
                </div>
                <div class="col-md-6 fecha">	
                   	<?php 
						#set_input("fecha",@$row->fecha,$placeholder='AAAA-MM-DD',$require=true,"datepicker");
						echo  makeReporteDiario("fecha",@$row->fecha,array("class"=>"form-control","require"=>"true"),$me);
					?>
                    
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$colums		=	'';
						$colums		.=	'<tr>';
						$count		=	0;
						
						$ciclo		=	$this->$modulo->fields;
						$colums		.=	'</tr>';	
					?>
							<div class="row">
								<div class="text-center col-md-3"><b>Plataforma</b></div>
                                <div class="text-center col-md-3"><b>Usuario</b></div>
                                <div width="40%" class="text-center col-md-3"><b>Producción</b></div>
                                <div width="40%" class="text-center col-md-3"><b>Tokens (0.05)</b></div>
                                <!--td width="100"><b>Ganado</b></td-->
							</div>
							<?php
							$inc=0;
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
							?>
                            			<div class="row">
                                        	<div class="text-center col-md-3">
                                            	<?php 
													print_r($v->plataforma);
													$detalle_plataforma		=	centrodecostos($v->id_plataforma);
													$equivalencia			=	str_replace(",",".",$detalle_plataforma->equivalencia);
													$moneda_de_pago			=	$detalle_plataforma->moneda_de_pago;
												?>
                                                
                                            </div>
                                            <div class="text-center col-md-3">
                                            	<?php 
													print_r($v->nickname);
												?>
                                                
                                            </div>
                                            <div class="text-center col-md-3">
                                            	<div class="input-group">
	                                                <input type="text" autocomplete="off" name="monto[]" id="monto" data-e="<?php echo $equivalencia; ?>" data-m="<?php echo $moneda_de_pago;?>" data-rel="<?php echo $v->id_plataforma.$inc;?>" class="form-control montos" value="<?php echo @$row->monto;?>"  /> 
                                                	<span class="input-group-addon" id="btnGroupAddon" style="width:100px;"><?php echo $moneda_de_pago;?></span>
                                                </div>
                                            </div>
                                            <div class="text-center col-md-3">
	                                            <input type="text" readonly="readonly" id="token-<?php echo $v->id_plataforma.$inc;?>" class="form-control" />
                                                <input type="hidden" name="tokens[]" readonly="readonly" id="token2-<?php echo $v->id_plataforma.$inc;?>" class="form-control" />
                                                <input type="hidden" name="nickname_id[]" value="<?php print_r($v->nickname_id);?>" />
                                                <input type="hidden" name="id_plataforma[]" value="<?php print_r($v->id_plataforma);?>" />
                                            </div>
                                            <!--td>
												<input type="text" name="total[]" readonly="readonly" id="total-<?php echo $v->id_plataforma.$inc;?>" value="<?php echo $equivalencia; ?>" class="form-control" />
                                            </td-->
                                        </div>
                            <?php		$inc++;	
									}
								}
							?>
                    <?php if((count($this->$modulo->result)>0)){?>
					<div class="container">
						<div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>                        
                            </div>
                        </div> 
					</div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		if($("#fecha").val()==''){
			$(".montos").attr("disabled","disabled");
		}
		if($("#validar").val() == 0){
			$("button[type='submit']").remove();
		}
		$("#fecha").change(function(){
			$(".montos").removeAttr("disabled");
		});
		
		$(".montos").keyup(function(){
			var moneda			=	$(this).data("m");
			var equivalencia	=	parseFloat($(this).data("e")).toFixed(4);
			if(moneda=='Tokens' || moneda=='Créditos'){
				//console.log(equivalencia);
				if($(this).data("e")!='0.05'){
					var total_total		=	parseFloat(parseFloat($(this).val()) * equivalencia).toFixed(2);
					$("#token-"+$(this).data("rel")).val(accounting.formatNumber((total_total	/ 0.05), 0, ".", ""));
					$("#token2-"+$(this).data("rel")).val(total_total	/ 0.05);
				}else{
					$("#token-"+$(this).data("rel")).val(accounting.formatNumber($(this).val(), 0, ".", ""));
					$("#token2-"+$(this).data("rel")).val($(this).val());
				}				
			}else if(moneda=='Dólares'){
				var total_total		=	parseFloat(parseFloat($(this).val()) / 0.05 ).toFixed(0);
				$("#token-"+$(this).data("rel")).val(accounting.formatNumber(total_total, 0, ".", ""));
				$("#token2-"+$(this).data("rel")).val(total_total);
			}
		});
	});
</script>
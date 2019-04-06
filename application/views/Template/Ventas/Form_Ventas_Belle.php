<?php 
$modulo		=	$this->ModuloActivo;
if(empty($this->$modulo->result)){
    $row        =   get_ConfigSeguridadSocial("*");
}else{
    $row        =   $this->$modulo->result;
}
    if(@$row->eps > 0){
        $data['Costo_EPS'] = "Si";
    }else{
        $data['Costo_EPS'] = "No";
    }
    if(@$row->arl > 0){
        $data['Costo_ARL'] = "Si";
    }else{
        $data['Costo_ARL'] = "No";
    }
    if(@$row->caja_compensacion > 0){
        $data['Costo_caja_comp_Familiar'] = "Si";
    }else{
        $data['Costo_caja_comp_Familiar'] = "No";
    }
    if(@$row->pension > 0){
        $data['Costo_pension'] = "Si";
    }else{
        $data['Costo_pension'] = "No";
    }
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
    $Descuento = @$row->Descuento;
    $empresa    =   centrodecostos($this->user->id_empresa);
?>
<div class="container" style="margin-bottom:70px;">	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Maestro escala de pagos.</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre Escala *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nombre_escala"  placeholder="Nombre Escala" value="<?php echo (isset($row->nombre_escala))?$row->nombre_escala:''?>"  require/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Tipo de descuento *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo  DescuentoDolar("Descuento",@$row->Descuento,array("class"=>"form-control","id"=>"Descuento")); ?>
                    </div>
                </div>
                <div class="row form-group ocultar" id="descuento_dolar" <?php echo (@$row->Descuento == "valor fijo")?'':'style="display:none;"'; ?>>
                    <div class="col-md-6 text-right">   
                        <b>Valor fijo descuento *</b>
                    </div>
                    <div class="col-md-6">  
                        <input type="text" class="form-control money" name="Descuento_dolar"  placeholder="Valor fijo descuento" value="<?php echo (isset($row->Descuento_dolar))?format($row->Descuento_dolar,true):''?>" <?php echo (isset($row->Descuento_dolar))?'readonly="readonly"':''?>/>
                    </div>
                </div>
                <div class="row form-group ocultar" id="porcent" <?php echo (@$row->Descuento == "Porcentual")?'':'style="display:none;"'; ?>>
	                <div class="col-md-6 text-right">	
                    	<b>Porcentaje descuento Dólar *</b>
                    </div>
                    <div class="col-md-6">
                    	<div class="input-group">	
	                        <input type="text" class="form-control soloNumeros" name="porcentaje_descuento_dolar"  id="porcentaje_descuento_dolar"  placeholder="Porcentaje descuento Dólar" value="<?php echo (isset($row->porcentaje_descuento_dolar))?$row->porcentaje_descuento_dolar:1?>" require readonly="readonly" />
                            <span class="input-group-addon" >%</span>
                        </div>
                    </div>
                </div>
                <?php
                    if($empresa->sistema_salarial==1){
                ?>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Meta *</b>
                    </div>
                    <div class="col-md-6">	
	                    <div class="input-group">
                        	<input type="text" class="form-control soloNumeros" name="meta"  placeholder="Meta" value="<?php echo (isset($row->meta))?$row->meta:''?>" require  />
                            <span class="input-group-addon" >Tokens</span>
                        </div>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                    <input type="hidden" name="meta"  value="0" require  />
                <?php
                    }
                ?>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Salario *</b>
                    </div>
                    <div class="col-md-6">
                    	<div class="input-group">
                        	<?php set_input("salario",@$row,'Salario',$require=true,"money");?>
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
                       		<?php set_input("auxilio_transporte",@$row,$placeholder='Auxilio Transporte',$require=true,"money");?>
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
                            <?php 
                                set_input("eps",format(@$row->Costo_EPS,true),$placeholder='EPS',$require=false,"money option-true",array("style"=>"display:none","readonly"=>"readonly"));?>
                            <span class="input-group-addon option-true" style="display: none">COP</span>
                            <button type="button" class="btn btn-secondary opcion" data-opcion="Si" data-active='Costo_EPS'>SI</button>
                            <button type="button" class="btn btn-secondary opcion" data-opcion="No" data-active='Costo_EPS'>NO</button>
						</div>                            
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>ARL *</b>
                    </div>
                    <div class="col-md-6">	
	                    <div class="input-group">
                            <?php
                                set_input("arl",format(@$row->Costo_ARL,true),$placeholder='ARL',$require=false,"money option-true",array("style"=>"display:none","readonly"=>"readonly"));?>
                            <span class="input-group-addon option-true" style="display: none">COP</span>
                            <button type="button" class="btn btn-secondary opcion" data-opcion="Si" data-active='Costo_ARL'>SI</button>
                            <button type="button" class="btn btn-secondary opcion" data-opcion="No" data-active='Costo_ARL'>NO</button>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Caja Compensación *</b>
                    </div>
                    <div class="col-md-6">	
                    	<div class="input-group">
                            <?php
                                set_input("caja_compensacion",format(@$row->Costo_caja_comp_Familiar,true),$placeholder='Caja Compensación',$require=false,"money option-true",array("style"=>"display:none","readonly"=>"readonly"));?>
                            <span class="input-group-addon option-true" style="display: none">COP</span>
                            <button type="button" class="btn btn-secondary opcion" data-opcion="Si" data-active='Costo_caja_comp_Familiar'>SI</button>
                            <button type="button" class="btn btn-secondary opcion" data-opcion="No" data-active='Costo_caja_comp_Familiar'>NO</button>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Pensión *</b>
                    </div>
                    <div class="col-md-6">	
	                    <div class="input-group">
                            <?php
                                set_input("pension",format(@$row->Costo_pension,true),$placeholder='Pensión',$require=true,"money option-true",array("style"=>"display:none","readonly"=>"readonly"));?>
                            <span class="input-group-addon option-true" style="display: none">COP</span>
                            <button type="button" class="btn btn-secondary opcion" data-opcion="Si" data-active='Costo_pension'>SI</button>
                            <button type="button" class="btn btn-secondary opcion" data-opcion="No" data-active='Costo_pension'>NO</button>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Porcentaje de Pago (Bonificación) *</b>
                    </div>
                    <div class="col-md-6">
                    	<div class="input-group">	
	                        <input type="text" class="form-control soloNumeros" name="bonificacion"  id="bonificacion" placeholder="Bonificación" value="<?php echo (isset($row->bonificacion))?$row->bonificacion:''?>" require  />
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
	                        <input type="text" class="form-control soloNumeros" name="prima"  placeholder="Prima" value="<?php echo (isset($row->prima))?$row->prima:''?>" require  />
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
                            <input type="text" class="form-control soloNumeros" name="factor_bonificacion" id="factor_bonificacion" readonly="readonly"  placeholder="Factor Bonificación" value="<?php echo (isset($row->factor_bonificacion))?$row->factor_bonificacion:''?>" require  />
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
        function calcular_factor(){
            porcentaje_descuento_dolar = $("#porcentaje_descuento_dolar");
            bonificacion=$("#bonificacion");
            factor_bonificacion=$("#factor_bonificacion");
            bonificacion.keyup(function(){
                if(porcentaje_descuento_dolar.val()==''){
                    //alert("Debe suministrar el % de descuento por dólar");
                    porcentaje_descuento_dolar.focus();             
                }else{
                    var calculo     =   parseFloat(bonificacion.val()) /100;
                        calculo     =   calculo * 0.05;
                        factor_bonificacion.val(parseFloat(calculo).toFixed(6));    
                }
            });

            porcentaje_descuento_dolar.keyup(function(){
                if(porcentaje_descuento_dolar.val()==''){
                    //alert("Debe suministrar el % de descuento por dólar");
                    porcentaje_descuento_dolar.focus();             
                }else{
                    var calculo     =   parseFloat(bonificacion.val()) /100;
                        calculo     =   calculo * 0.05;
                        factor_bonificacion.val(parseFloat(calculo).toFixed(6));    
                }
            });
        }
        calcular_factor();
        solonumeros('.soloNumeros');
        var por_des = '<?php echo (!empty($row->porcentaje_descuento_dolar))? $row->porcentaje_descuento_dolar: 1;?>';
        $('#Descuento').change(function(){
            var porcentaje_descuento_dolar = '';
            var bonificacion = '';
            var factor_bonificacion ='';
            $('.ocultar').hide();
            if($(this).val() == "Porcentual"){
                $('#porcent').fadeIn(1000);
                $('#porcentaje_descuento_dolar').removeAttr('readonly').val('');
                $('input[name="Descuento_dolar"]').removeAttr("require");
                calcular_factor();
            }else if($(this).val() == "valor fijo"){
                $('#porcentaje_descuento_dolar').attr('readonly','readonly').val(1);
                $('#descuento_dolar').fadeIn(1000);
                calcular_factor();
            }else{
                $('.ocultar').hide();
            }
        });
        $('.opcion').click(function(){
            var parent = $(this).parent('div');
            var val    = parent.find('.option-true').val();
            if($(this).data('opcion') == "Si"){
                parent.find('.opcion').removeClass('btn-primary').addClass('btn-secondary');
                parent.find('.option-true').fadeIn(1000);
                parent.find('.sumar').val(circumference(val));
                $(this).hide();
            }else{
                $(this).removeClass('btn-secondary').addClass('btn-primary');
                parent.find('.option-true').fadeOut(1000);
                parent.find('.opcion').show();
                parent.find('.sumar').val(0);
            }
        });
        $('#porcentaje_descuento_dolar').val(por_des);
        var data = JSON.parse('<?php echo @json_encode($data); ?>');
        var button = $('[data-active]');
        button.each(function(index, el) {
            $.each(data,function(i,v){
                console.log(el.dataset.active);
                console.log(i);
                if(el.dataset.opcion == v && el.dataset.active == i){
                    el.click();
                }
            });
        });
	});
</script>
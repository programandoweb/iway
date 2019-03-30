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
$hidden = array('id_cuenta' => (isset($row->id_cuenta))?$row->id_cuenta:'',"redirect"=>base_url("Finanzas/CuentasBancarias"));
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
		            	<h3>Crear Cuenta Bancaria</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Entidad Bancaria *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 
							echo bancos($row);
						?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Titular *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("titular",$row,$placeholder='Titular',$require=true,"PrimeraMayuscula__");?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Tipo cuenta *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo MakeTipoCuenta("modo_cuenta",(isset($row->modo_cuenta))?$row->modo_cuenta:NULL,array("class"=>"form-control","require"=>"require","id"=>"modo_cuenta"));?>
                    </div>
                </div>
                <div class="row form-group" style="display:none;">
                    <div class="col-md-6 text-right">   
                        <b>Modalidad Cuenta *</b>
                    </div>
                    <div class="col-md-6"> 
	                    <?php set_input("tipo_cuenta",$row,$placeholder='Titular',$require=true,"PrimeraMayuscula");?> 
                    </div>
                </div>
                <div id="Moneda" class="row form-group" style="display:none;">
	                <div class="valor col-md-6 text-right">	
                    	<b>Registra valores en *</b>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="tipo_monedas" value="COP">	
                        <?php echo MakeMonedas("",(isset($row->tipo_monedas))?$row->tipo_monedas:NULL,array("class"=>"form-control tipo_monedas"));?>
                    </div>
                </div>               
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Número de Cuenta o Tarjeta *</b>
                    </div>
                    <div class="col-md-6">	
					<?php 
						set_input("nro_cuenta",@$row,$placeholder='Número de Cuenta o Tarjeta',$require=true,'',array("maxlength"=>"20","id"=>"nro_cuenta","class"=>"form-control credit0"));
					?>
        			</div>
				</div>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado de Cuenta</b>
                    </div>
                    <div class="col-md-3">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div> 
                <div class="row form-group item">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Importante</h4>
                        <p>Por su seguridad, utilice solamente los últimos cuatro (4) dígitos, cuando esté inscribiendo una tarjeta de crédito, crédito prepagado (monedero) o Ewallet.</p>
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
<script type="text/javascript" src="<?php echo DOMINIO?>/assets/js/credit.js"></script>
<script>
	$(document).ready(function(){
		$(".credit0").SoloNumeros();
		var _select			= 	$("#modo_cuenta");
		var _select2		=	$(".tipo_monedas");
		if(_select.val() == 112510 || _select.val() == 112520 ||_select.val() == 111010 || _select.val() == 111010){
			$('#Moneda').removeAttr("style").addClass("flipInX animated");
			_select2.attr('name', 'tipo_monedas');//
		}
		_select.change(function(){
			$("#tipo_cuenta").val($( "#modo_cuenta option:selected" ).text());
			if(_select.val() == 112510 || _select.val() == 112520 ||_select.val() == 111010 || _select.val() == 111010){
				$('#Moneda').removeAttr("style").addClass("flipInX animated").attr('name', 'tipo_monedas');
				_select2.attr('name', 'tipo_monedas');//
			}else{
				$('#Moneda').removeClass("flipInX  animated").addClass("flipOutX animated").fadeOut().removeClass("flipOutX  animated").find('select').removeAttr('name').removeClass("ZoomOutleft animated");	
			}
			if(_select.val() == 111010 || _select.val() == 112520 || _select.val() == 112515){
				
			}
		});
	});
</script>
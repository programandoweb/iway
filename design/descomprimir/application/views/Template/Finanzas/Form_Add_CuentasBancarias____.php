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
		            	<h3>Maestro Cuentas Bancarias</h3>
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
                        <?php set_input("titular",$row,$placeholder='Titular',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Registra valores en *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeMonedas("tipo_monedas",(isset($row->tipo_monedas))?$row->tipo_monedas:NULL,array("class"=>"form-control","require"=>"require"));?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Modalidad Cuenta *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeCuentaBancaria("tipo_cuenta",(isset($row->tipo_cuenta))?$row->tipo_cuenta:NULL,array("class"=>"form-control","require"=>"require"));?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Tipo Cuenta *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeModalidadCuentaBancaria("modo_cuenta",(isset($row->modo_cuenta))?$row->modo_cuenta:NULL,array("class"=>"form-control","require"=>"require","id"=>"modo_cuenta"));?>
                    </div>
                </div>                
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Número de Cuenta o Tarjeta *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 
							set_input("nro_cuenta",$row,$placeholder='Número de Cuenta o Tarjeta',$require=true,'',array("id"=>"nro_cuenta"));
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
                        <p>Por seguridad, utilice solamente los últimos cuatro (4) dígitos cuando esté inscribiendo una tarjeta de crédito prepagada.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url($this->uri->segment(1).'/CuentasBancarias');?>">Cerrar y Volver</a>
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
		var _select			= 	$("#modo_cuenta");
			cadena 			= 	$("#nro_cuenta").val();
		if(	_select.val()	==	'Crédito prepagada'){
			$("#nro_cuenta").attr("maxlength",4).val(cadena.substr(-4));	
		}else{
			$("#nro_cuenta").removeAttr("maxlength");	
		}
		_select.change(function(){
			cadena 				= 	$("#nro_cuenta").val();
			if(	_select.val()	==	'Crédito prepagada'){
				$("#nro_cuenta").attr("maxlength",4).val(cadena.substr(-4));	
			}else{
				$("#nro_cuenta").removeAttr("maxlength");	
			}
		});
	});
</script>
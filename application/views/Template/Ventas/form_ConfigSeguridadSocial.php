<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
$modulo		=	$this->ModuloActivo;
$row		=	get_ConfigSeguridadSocial("*");
if(!empty($row)){
    $var = new stdClass;
    $var->Proveedor= @centrodecostos($row->Proveedor)->nombre_legal;
}        
echo form_open(current_url(),array('ajaxing' => 'true'));	?>		

<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Servicio de seguridad social</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Tipo de servicio *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo makeTipoServicio("Tipo_de_servicio",@$row->Tipo_de_servicio,array("id"=>"tipoServicio","class"=>"form-control")) ?>
                    </div>
                </div>
                <div id="divproveedor" class="row form-group" <?php  if(empty($row->Proveedor)){echo 'style="display: none;"';} ?> >
                    <div class="col-md-6 text-right">   
                        <b>Proveedor *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo MakeProveedores(@$var,"Proveedor","Proveedor",false); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                    </div>
                    <div id="mesagge">  
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Costo afiliacion *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo set_input("Costo_afiliacion",$row,"Costo de afiliacion",true,"money",'',true) ?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Costo EPS *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo set_input("Costo_EPS",$row,"Costo EPS",true,"money",'',true) ?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Costo ARL *</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo set_input("Costo_ARL",$row,"Costo ARL",true,"money",'',true) ?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Costo caja comp. Familiar *</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo set_input("Costo_caja_comp_Familiar",$row,"Costo caja comp. Familiar",true,"money",'',true) ?>
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Costo Pensión</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo set_input("Costo_pension",$row,"Costo pension",true,"money",'',true); ?>
                    </div>
				</div>
                <div class="row form-group item">
                    <div class="col-md-6 text-right">   
                        <b>Total</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo set_input("Total",@$row->Total,"Total",true,'',array("readonly"=>"readonly"),true); ?>
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
        $('#Proveedor').val('<?php echo @$row->Proveedor; ?>');
        var proveedor = '<?php echo $this->user->id_empresa; ?>';
        $('#tipoServicio').change(function(){
            if($(this).val() == "Proveedor" ){
                $('#divproveedor').fadeIn();
                $('#contentProveedor').val('');
            }else{
                $('#divproveedor').fadeOut();
                $('#Proveedor').val(proveedor);
                $('#Proveedor').removeAttr('require');
            }
        });
        $('.money').keyup(function(){
            var total = 0;
            var montos = $('.sumar');
            montos.each(function(key,elem){
                if(elem.name != "Costo_afiliacion"){
                    total += parseFloat(elem.value);
                }
                $('#Total').val(total);
            });
        });
	});
</script>
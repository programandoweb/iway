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
if($this->uri->segment(3)!=="Agregar"){
    $hidden     =   array("iframe"=>"Add_Todos_Iframe","descuento_id"=>$this->uri->segment(3,0),"centro_de_costos"=>$row->centro_de_costos);
    echo form_open(current_url(),array('ajaxi' => 'true'),$hidden);
}else{
    echo form_open(current_url(),array('ajaxi' => 'true'));
}
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
                <?php if($this->uri->segment(3)=="Agregar") {?>
                <div class="row form-group">
                    <div class="col-md-3 text-right">   
                        <b>Tipo descuento</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo MakeTipoDescuento("tipo_descuento",$row,array("class"=>"form-control","id"=>"tipo_descuento")); ?> 
                    </div>
                </div>
                <?php } ?>
                <div class="row form-group">
                    <div class="col-md-3 text-right">   
                        <b>Concepto *</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo MakeDescuentosConceptos("concepto",@$row->concepto,array("class"=>"form-control","require"=>"require","id"=>"concepto"));?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">   
                        <b>Proveedor *</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo MakeProveedores($row,"Proveedor","Proveedor",true,array("Administrativos","Asociados","Modelos","Monitores","Proveedores"),"nom");?>
                    </div>
                </div>
                <?php if($this->uri->segment(3)=="Agregar") {?>
                <div class="row form-group">
                    <div class="col-md-3 text-right">   
                        <b>Funcinario</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo MakeProveedores($row,"user_id","Nombre",true,array("Administrativos","Asociados","Modelos","Monitores"));?> 
                    </div>
                </div>
                <?php } ?>
                <div class="row form-group">
                    <div class="col-md-3 text-right">   
                        <b>Monto.</b>
                    </div>
                    <div class="col-md-6">  
                        <?php 
                            if(empty($row)){
                                set_input("valor",@$row,$placeholder='Monto',$require=false,"money");
                            }else{
                                echo format($row->valor,true);
                            }
                        ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">   
                        <b>No. Quincenas.</b>
                    </div>
                    <div class="col-md-6">  
                        <?php set_input("nro_quincenas",@$row,$placeholder='No. Quincenas',true);?>
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
				<!--<?php 
					if(empty($row)){
				?>								
                        <div class="row form-group">
                            <div class="col-md-3 text-right">	
                                <b>Donde Debitar.</b>
                            </div>
                            <div class="col-md-6">	
                                <select id="donde_debitar" name="donde_debitar" class="form-control" data-href="<?php echo site_url("Ajax/donde_debitar")?>" require >
                                    <option>Seleccione</option>
                                    <option value="caja">Caja</option>
                                    <option value="procesador">Banco</option>
                                </select>
                            </div>
                        </div>
				<?php
					}
				?> -->                               
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
        var empresa = '<?php echo nombre(centrodecostos($this->user->id_empresa)); ?>';
        console.log(empresa);
		$("#nro_cuenta").mask("9999-9999-9999-9999");
        $('#tipo_descuento').change(function(){
            if($(this).val() == "Tercero"){
                $("#concepto option").hide();
                $("option[value='Préstamos']").show();
                $("option[value='Otro']").show();
                $("option[value='Juguetería o lencería']").show();
                $("#contentProveedor").removeAttr('readonly');
                $("#contentProveedor").val('');
            }else{
                $("#concepto option").show();
                //$("option[value='Otro']").hide();
                $("#contentProveedor").val(empresa).attr('readonly','readonly');
                $("#Proveedor").val(empresa);
            }
        });
	});
</script>
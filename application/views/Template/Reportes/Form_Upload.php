<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array("redirect"=>base_url("Reportes/InformePlano"),"equivalencia"=>"0","moneda_de_pago"=>"PERFIL IMPORTADO","tipo_persona"=>"PERFIL IMPORTADO");
echo form_open_multipart(current_url(),array("id"=>"archiv_planito"),$hidden);	?>

<div class="container" style="margin-bottom:20px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
            	<?php if(!empty($this->Reportes->TRM_Promedio["fecha"])){?>
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3><i class="fas fa-cloud-upload-alt"></i> Cargar archivo plano.</h3>
                    </div>
                </div>               
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Período *</b>
                    </div>
                    <div class="col-md-3">	
                        <?php 
							
							$dia_periodo	=  date("d",strtotime($this->Reportes->TRM_Promedio["fecha"]->fecha_desde));
							if($this->user->periodo_pagos==4){
								if($dia_periodo>=0 && $dia_periodo<=7){
									$inc			=	1;
								}else if($dia_periodo>=8 && $dia_periodo<=15){
									$inc			=	2;
								}else if($dia_periodo>=16 && $dia_periodo<=23){
									$inc			=	3;
								}else{
									$inc			=	4;
								}								
							}else{
								if($dia_periodo>=0 && $dia_periodo<=15){
									$inc			=	1;
								}else{
									$inc			=	2;
								}
							}
							
							$letra_periodo	= ($this->user->periodo_pagos==4)?'S'.$inc.'':'Q'.$inc.'';
							$letra_periodo.date("m",strtotime($this->Reportes->TRM_Promedio["fecha"]->fecha_desde)).date("Y");
							$mes =  (int)date("m",strtotime($this->Reportes->TRM_Promedio["fecha"]->fecha_desde));
							
							
							
							$ciclo_informacion							=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
							echo $rp_honorarios_modelos["ciclopago"]	=	ciclopago($this->user->periodo_pagos,(int)date("m",strtotime($ciclo_informacion->fecha_desde)),$ciclo_informacion->fecha_desde);
							
						?>
                        <input type="hidden" name="mes"  value="<?php echo $mes;?>" require="true" />
                        <input type="hidden" name="periodo_pagos" value="<?php echo $inc;?>" />
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b>Archivo Plano *</b>
                    </div>
                    <div class="col-md-3">
						<input class="inputfile" type="file" id="userfile" name="userfile" placeholder="Imagen a Subir" require>
                        <div id="montrar_nombre_archivo">No Seleccionado aún</div>
                        <div id="advertencia"></div>
                    </div>
				</div>
                <div class="row form-group text-center">
	                <div class="alert alert-info col-md-12" role="alert">
                        <h4 class="alert-heading">Importante:</h4>
                    	<p>Los archivos sólo serán admitidos con un peso máximo de 5MB y formatos en xls o xlsx</p>
                    </div>
                </div>
               	<div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                            <a href="<?php echo base_url("Reportes/Formato"); ?>" class="btn btn-primary dowload"><i class="fas fa-file-excel"></i> Formato</a>
                            <a class="btn btn-warning" href="<?php echo base_url("Reportes/FacturaVentas");?>"><i class="fas fa-times"></i> Cerrar</a>
                        </div>                        
                    </div>
                </div> 
				<?php }else{
				?>
                <div class="row form-group item">
	                <div class="col-md-12 text-center">
    		            <h3>No existen períodos a cerrar aún</h3>
            	    </div>
                </div>
                <?php	
				}
				?>                  
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		function getFileExtension(filename) {
		  return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
		}
		$(".inputfile").change(function(){
			$("#advertencia").html('');
			$("#montrar_nombre_archivo").html(document.getElementById('userfile').files[0].name);
			if(getFileExtension(document.getElementById('userfile').files[0].name) == "xlsx"){
				$("#archiv_planito").submit();
			}else{
				$("#advertencia").html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> Archivo no permitido.</div>');
			}
		});
	});
</script>
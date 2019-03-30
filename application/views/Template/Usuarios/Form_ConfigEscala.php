<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	@get_form_control(base_url("Usuarios/configuracionEscala"));
$actual = @json_decode($row[0]->data)->Escala_por_defecto;
$documento  =   @DocumentoHonorarios(54);
echo form_open(base_url("Usuarios/configuracionEscala"),array('ajax' => 'true'));	?>
<input type="hidden" value="1" require />
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Escala por defecto *</b>
                    </div>
                    <div class="col-md-6">
                    <?php	
                        echo get_escala_pagos(@$actual,array("class"=>"form-control","required"=>"required"),"Escala_por_defecto","nombre_escala");
                    ?>
                    </div>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
            <div class="col-md-12">
                <table class="display table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><b>Tipo documento</b></th>
                            <th class="text-center"><b>Consecutivo</b></th>
                            <th class="text-center"><b>Responsable</b></th>
                            <th class="text-center"><b>Fecha</b></th>
                            <th class="text-center"><b>Escala por defecto</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total_meta         =   0;
                            $total_metaideal    =   0;
                            if(count($row)>0){
                                foreach($row as $v){
                                $json = json_decode($v->data);
                                $fecha = new DateTime($json->fecha);
                        ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $documento->nombre; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $documento->id_documento; ?>
                                            <?php echo ceros($json->consecutivo); ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                echo $json->responsable;
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                echo $fecha->format('Y-m-d');
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $json->Escala_por_defecto; ?>
                                        </td>   
                                    </tr>
                        <?php       
                                }
                            }else{
                        ?>
                        <?php       
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
    $(document).ready(function(){
        validar('select');
    });
</script>
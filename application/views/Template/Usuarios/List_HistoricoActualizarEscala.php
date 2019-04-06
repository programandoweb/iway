<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$modelo		=	nombre($this->$modulo->result);
$historico  =   get_form_control(current_url());
$tipo_documento = DocumentoHonorarios(52);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                <thead>
                    <tr>
                        <th class="text-center"><b>Tipo documento</b></th>
                        <th class="text-center"><b>Consecutivo</b></th>
                        <th class="text-center"><b>Responsable</b></th>
                        <th class="text-center"><b>Fecha</b></th>
                        <th class="text-center"><b>Escala de Pago</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total_meta         =   0;
                        $total_metaideal    =   0;
                        if(count($historico)>0){
                            foreach($historico as $v){
                                $json = json_decode($v->data);
                                $fecha = new DateTime($json->fecha);
                    ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $tipo_documento->nombre;?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $tipo_documento->id_documento; ?>
                                        <?php echo ceros($v->consecutivo); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            echo $json->responsable;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            echo  $fecha->format('Y-m-d');
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo escala($json->id_escala)->nombre_escala; ?>
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
<?php echo form_close();?>
<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	get_cf_meta_ideal(array($this->user->centro_de_costos));
echo form_open(base_url("Usuarios/configuracionMeta"),array('ajax' => 'true'));	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Valor mínimo meta ideal *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo set_input("min_meta_ideal",@$row,"Valor minimo meta ideal",true,"form-control money");?>
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
                            <th class="text-center"><b>Consecutivo</b></th>
                            <th><b>Responsable</b></th>
                            <th class="text-center"><b>Fecha</b></th>
                            <th class="text-center"><b>Valor minimo meta ideal</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total_meta         =   0;
                            $total_metaideal    =   0;
                            if(count($row)>0){
                                foreach($row as $v){
                                    $json = json_decode($v->data_meta_ideal);
                                    $fecha = new DateTime($json->fecha);
                        ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $json->consecutivo; ?>
                                        </td>
                                        <td>
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
                                            <?php echo format($json->min_meta_ideal,true); ?>
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
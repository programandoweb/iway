<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
	//pre($this->$modulo->result);return;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Formas de Pagos.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar Formas de Pagos.",
															"url"	=>	base_url($this->uri->segment(1)."/Add_FormasPagos"),
															"lightbox"=>true),	
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
					<table class="ordenar display table table-hover">
                        <thead>
                            <tr>
                            	<th>
                                	Escala
                                </th>
                                <th width="100" class="text-center">
                                	Estado
                                </th>
                                <th width="40" class="text-center">
                                	Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($this->$modulo->result)>0){
                                    foreach($this->$modulo->result as $v){
							?>
                                        <tr>
                                            <td>
                                                <?php echo $v->nombre_escala;?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    $variable	=	"CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END";
                                                    echo $v->$variable;
                                                ?>
                                            </td>
                                            <td width="10" class="text-center">
                                                <?php
                                                    print($v->edit);
                                                ?>
                                            </td>
                                        </tr>
                            <?php
									}
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

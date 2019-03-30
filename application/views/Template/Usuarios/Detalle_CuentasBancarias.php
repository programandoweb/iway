<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
	
	Agregar
	<i class="fa fa-plus" aria-hidden="true"></i>
	Ver
	<i class="fa fa-search" aria-hidden="true"></i>
	Editar
	<i class="fas fa-edit" aria-hidden="true"></i>
*/?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Cuentas Bancarias.",
															'icono'=>'<i class="fas fa-piggy-bank"></i>',
															"url"	=>	current_url()),
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$colums		=	'';
						$colums		.=	'<tr>';
						$count		=	0;
						$modulo		=	$this->ModuloActivo;
						$ciclo		=	$this->$modulo->fields;
						$colums		.=	'</tr>';
						$datos 		=   $this->$modulo->result;
						//pre($datos);	
					?>
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<!--<th><b>Nombre</b></th>-->
                                <th  class="text-center"><b>Banco</b></th>
                                <th class="text-center"><b>Tipo Cuenta</b></th>
                                <th class="text-center"><b>No Cuenta</b></th>
                                <th class="text-center"><b>Fecha</b></th>
                                <th class="text-center"><b>Responsable</b></th>
                                <th class="text-center"><b>Consecutivo</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$json    =  json_decode($datos[0]->cambio_cuentas_bancarias);
								foreach ($json as $k => $v) {
									$cuentas = json_decode($v);
									//pre($cuentas);
							?>
                    			<tr>
                                	<!--<td>
                                    	<?php echo ($datos[0]->primer_nombre.' '.$datos[0]->segundo_nombre.' '.$datos[0]->primer_apellido.' '.$datos[0]->segundo_apellido);?>
                                    </td>-->
                                    <td class="text-center">
                                        <?php echo entidadbancaria($cuentas->entidad_bancaria);?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo($cuentas->tipo_cuenta);?>
                                    </td>
                                    <td class="text-center"><?php echo ($cuentas->nro_cuenta);?></td>
                                    <td class="text-center"><?php echo $cuentas->fecha_creacion; ?></td>
                                    <td class="text-center"><?php pre(nombreUsuario($cuentas->responsable)->Responsable); ?></td>
                                    <td class="text-center"><?php echo @$cuentas->consecutivo; ?></td>	
                                </tr>
                            <?php
                            	} 
                            ?>
						</tbody>
						<tfoot>
							<tr>
								<!--<td><b>Nombre</b></td>-->
                                <td  class="text-center"><b>Banco</b></td>
                                <td class="text-center"><b>Tipo Cuenta</b></td>
                                <td class="text-center"><b>No Cuenta</b></td>
                                <th class="text-center"><b>Fecha</b></th>
                                <th class="text-center"><b>Responsable</b></th>
                                <td class="text-center"><b>Consecutivo</b></td>
							</tr>
						</tfoot>
					</table>
					<div class="container">
						<?php 
							echo $this->pagination->create_links();
						?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

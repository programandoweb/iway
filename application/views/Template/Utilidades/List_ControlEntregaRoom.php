<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo = $this->ModuloActivo;	
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
            	echo	TaskBar(array(	"name"		=>	array(	"title"	=>	"Control Entrega Room",
																"url"	=>	current_url()),
																"add"		=>	array(	"title"	=>	"Condiciones del Room",
																"lightbox"=>true),	
								)
							);
			?>
            <div class="row">
            	<div class="col-md-12">
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="asc">
						<thead>
							<tr>
                            	
							    <th class="text-center"><b>Fecha</b></th>
								<!--<th class="text-center"><b>Sucursal</b></th>-->
								<th class="text-center"><b>Modelo</b></th>
							    <th class="text-center"><b>Room</b></th>
						        <th class="text-center"><b>Turno</b></th>
                              
                                <th class="text-center"><b>Acciónnn</b></th>
							</tr>
						</thead>
						<tbody>
							<?php		
								if(count($this->$modulo->result)){
									foreach ($this->$modulo->result as $k => $v) {
										$json = json_decode($v->data);
										$fecha = new DateTime(@json_decode($v->data)->fecha);
										
							?>
							<tr>
							<td class="text-center">
									<?php echo $fecha->format('Y-m-d'); ?>
								</td>
								<!--<td class="text-center"><?php echo @nombre(centrodecostos($v->centro_de_costos)); ?></td>-->
								<td class="text-center"><?php echo @nombre(centrodecostos($v->user_id)); ?></td>
								<td class="text-center"><?php echo $json->room; ?></td>
								
								<td class="text-center">
									<?php
										if($json->turnos == "turno_manama"){
											$turno = "Mañana";
										}
										if($json->turnos == "turno_tarde"){
											$turno = "Tarde";
										}
										if($json->turnos == "turno_noche"){
											$turno = "Noche";
										}
										if($json->turnos == "turno_intermedio"){
											$turno = "Intermedio";
										}
										echo $turno;
									?>		
								</td>
							
								<td  class="text-center">
									<a class="" target="_blank" href="<?php echo base_url("Utilidades/ControlEntregaRoom/".$v->id_form_contrl."/PDF")?>">
                                       	<i class="fas fa-file-pdf"></i>
									</a>	
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
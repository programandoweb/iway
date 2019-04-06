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
	<i class="fa fa-pencil" aria-hidden="true"></i>
*/?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"> Días Trabajados.</h4>
                </div>
           	</div>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$colums		=	'';
						$colums		.=	'<tr>';
						$count		=	0;
						$modulo		=	$this->ModuloActivo;
						$ciclo		=	$this->$modulo->fields;
						$colums		.=	'</tr>';	
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<td><b>Nombre</b></td>
                                <td class="text-center" width="150"><b>Programados</b></td>
                                <td class="text-center" width="150"><b>Laborados</b></td>
                                <td class="text-center" width="150"><b>No Asistidos</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td>
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            </td>
                                            <td class="text-center">
                                            	15
                                            </td>
                                            <td class="text-center">
                                            	<?php
													$ciclo_de_produccion		=	get_cf_ciclos_pagos_new($v->id_empresa,$estado=0);
													$trm_ciclo					=	trm_ciclo($this->user->periodo_pagos,get_ciclo_pago($this->user->periodo_pagos),date("m"));
													$v->ciclo_de_produccion		=	$ciclo_de_produccion->fecha_desde;
													$get_dias_trabajados		=	get_dias_trabajados($v->user_id,$ciclo_de_produccion->fecha_desde);
													$v->dias_trabajados			=	(!empty($get_dias_trabajados))?$get_dias_trabajados->dias_trabajados:15;
													$v->dias_trabajados_id		=	(!empty($get_dias_trabajados))?$get_dias_trabajados->dias_trabajados_id:null;
													$v->mes						=	strftime("%m",strtotime($ciclo_de_produccion->fecha_desde));
                                                	set_input_dinamico("dias_trabajados",$v,null,false,"text-center",NULL,array("user_id","mes","ciclo_de_produccion","centro_de_costos","id_empresa","dias_trabajados_id"));
												?>
                                            </td>
                                            <td class="text-center" id="content_<?php echo $v->user_id?>">
                                            	<?php
                                                	echo 15 - $v->dias_trabajados;
												?>
                                            </td>
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="4" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td><b>Nombre</b></td>
                                <td class="text-center"><b>Programados</b></td>
                                <td class="text-center"><b>Laborados</b></td>
                                <td class="text-center"><b>No Asistidos</b></td>
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
<script>
  	function set_count(contenedor,dias_trabajados){
		$("#content_"+contenedor).html(15 - dias_trabajados);
	}
</script>
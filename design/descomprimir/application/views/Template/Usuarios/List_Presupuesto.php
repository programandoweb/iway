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
		            <h4 class="font-weight-700 text-uppercase orange"> Gestión Metas.</h4>
                </div>
           	</div>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$modulo		=	$this->ModuloActivo;
						$ciclo		=	$this->$modulo->fields;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<td><b>Modelos</b></td>
                                <td width="120" class="text-center"><b>Escala</b></td>
                                <td class="text-center"><b>Meta</b></td>
                                <td width="140" class="text-center"><b>Meta Ideal</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								$total_meta			=	0;
								$total_metaideal	=	0;
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$escala	=	get_escala_x_user_id($v->user_id);
							?>
                            			<tr>
                                        	<td>
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo (isset($escala))?$escala->nombre_escala:'No asignada';?>
                                            </td>
                                            <td class="text-center">
                                            	<?php 
													echo (isset($escala))?format($escala->meta,false):'No asignada';
													$total_meta		=	$total_meta + @$escala->meta;
												?>
                                            </td>
                                            <td class="text-right">
                                            	<?php
													$total_metaideal	=	$total_metaideal + $v->meta_ideal;
													//pre($v->meta_ideal);
                                                	set_input_dinamico("meta_ideal",$v,null,false,"input_dinamico");
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
								<td></td>
                                <td width="120" class="text-center"><b>Total</b></td>
                                <td  class="text-center"><b><?php echo format( $total_meta,false);?></b></td>
                                <td  class="text-right"><b><?php echo format($total_metaideal,false);?></b></td>
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


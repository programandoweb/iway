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
*/
$row		=	get_cf_meta_ideal(array($this->user->centro_de_costos));
if(!empty($row)){
	$key = count($row)-1;
	$json = json_decode($row[$key]->data_meta_ideal);
}
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				$submenu =	array("name"		=>	array(	"title"	=>	"Gestión de Metas.",
																				"url"	=>	current_url()),
														"config"	=>	array(	"title"	=>	"Configuración meta ideal",
																					"icono"	=>	'<i class="fas fa-cogs"></i>',
																					"url"	=>	current_url().'/Configuracion',
																					"lightbox"=>true)
												);
				if($this->user->type != "Asociados" && $this->user->type != "root" ){
					unset($submenu['config']);
				}
				echo TaskBar($submenu);
			?>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$modulo		=	$this->ModuloActivo;
						$ciclo		=	$this->$modulo->fields;
						//pre($this->$modulo->result); return;
					?>
					<table class="ordenar display table table-hover" ordercol=0 order="asc">
						<thead>
							<tr>
								<th><b>Tercero</b></th>
                                <th width="180" class="text-center"><b>Escala</b></th>
                                <?php if(@centrodecostos($this->$modulo->result[0]->id_empresa)->sistema_salarial == 1){ ?>
                                	<th class="text-center"><b>Meta escala</b></th>
                                <?php } ?>
                                <th width="140" class="text-center"><b>Meta ideal</b></th>
                                <th class="text-center"><b>Acción</b></th>
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
                                            <?php if(centrodecostos($v->id_empresa)->sistema_salarial == 1){ ?>
	                                            <td class="text-right">
	                                            	<?php 
														echo (isset($escala))?format($escala->meta,true):'No asignada';
														$total_meta		=	$total_meta + @$escala->meta;
													?>
													<input type="hidden" class="monto_oculto2" value = '<?php echo (isset($escala))?$escala->meta:0;?>'>
	                                            </td>
                                        	<?php } ?>
                                            <td class="text-right">
                                            	<?php
													$total_metaideal	=	$total_metaideal + $v->meta_ideal;
													//pre($v->meta_ideal);
                                                	//set_input_dinamico("meta_ideal",$v,null,false,"input_dinamico",null,array("user_id"),"hidden");
												?>
												<?php
													echo form_open(current_url(),array('ajax' => 'true'));
												?>
												<input type="text" readonly="readonly" meta_ideal = true class="form-control text-right money" value = "<?php echo (!empty($v->meta_ideal))?format($v->meta_ideal,true):format(@$json->min_meta_ideal,true); ?>">
												<input type="hidden" name="Nombre" value="<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>">
												<input type="hidden" name="Escala" value="<?php echo (isset($escala))?$escala->nombre_escala:'No asignada';?>" >
												<input type="hidden" name="meta_escala" value = '<?php echo (isset($escala))?$escala->meta:0;?>'>
												<input type="hidden" class="monto_oculto" name="meta_ideal" value="<?php echo (!empty($v->meta_ideal))?$v->meta_ideal:@$json->min_meta_ideal; ?>" require = true>
												<input type="hidden" name="user_id" value="<?php echo $v->user_id; ?>" require = true >

												<?php	
													echo form_close();
												?>
                                            </td>
                                            <td class="text-center">
                                            	<?php
													if(!empty($v->data)){
												?>
                                                <a class="lightbox" title="ver detalle historico <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" data-type="iframe" href="<?php echo current_url().'/cf_meta/'.$v->user_id; ?>">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            	</a>
												<?php
													}
												?>
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
						<tfoot>
							<tr>
								<td></td>
                                <td width="120" class="text-center"><b>Total</b></td>
                                <?php 
                                	if(@centrodecostos($v->id_empresa)->sistema_salarial == 1){ ?>
                                	<td  class="text-right"><b id="total_general2"><?php echo format( $total_meta,false);?></b></td>
                            	<?php } ?>
                                <td  class="text-right"><b id="total_general"><?php echo format($total_metaideal,false);?></b></td>
                                <td></td>
							</tr>
						</tfoot>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>

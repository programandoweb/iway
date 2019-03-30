<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<div class="container" id="main_">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">Liquidación recaudos Modelos.</h4>
                </div>
                <!--div class="col-md-6 text-right">
                    <a class="btn btn-primary btn-md lightbox" data-type="iframe" title="Asignar TRM" href="<?php echo base_url("");?>">
                    	<i class="fa fa-chevron-left" aria-hidden="true"></i> 
                        Asignar TRM
					</a>
                </div-->
            </div>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$modulo		=	$this->ModuloActivo;
						$ciclo		=	$this->$modulo->fields;
					?>
					<table class="table table-hover">
						<thead>
							<tr>
								<td><b>Nombre</b></td>
                                <td><b>Escala</b></td>
								<td width="100" class="text-center"><b>Vr. Honorarios</b></td>
                                <td width="100" class="text-center"><b>Acción</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$escala	=	escala($v->id_escala);
							?>
                            			<tr>
                                        	<td>
                                            	<?php echo nombre($v);?><br />
                                                <?php #echo (!empty(rol($v)))?rol($v)->rol:'No definido';?>
                                            </td>
                                            <td>
                                            	<?php echo (isset($escala->nombre_escala))?$escala->nombre_escala:'Pendiente';?>
                                            </td>
                                            <td class="text-right">
                                            	<?php 
													$decode	=	json_decode($v->json_honorarios);
													if(is_object($decode) ){
														print(format($decode->honorarios,true));
													}
													
													if(isset($escala->nombre_escala) && !is_object($decode)){
													
											?>	
                                            		<input class="update_user" type="hidden" value="<?php echo $v->user_id;?>" />
                                            <?php		
													}
												?>
                                                <?php #echo $v->user_id;?>
                                            </td>
                                            <td class="text-center">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
												<?php
													if(isset($escala->nombre_escala)){ ?>
														<a class="btn btn-secondary lightbox" title="Honorarios de <?php echo nombre($v);?>" data-type="iframe" href="<?php echo base_url("Usuarios/HonorariosModelo/".$v->user_id)?>">
                                                    		<i class="fa fa-eye" aria-hidden="true"></i>
													</a>
                                                <?PHP }else{?>
                                                    		<i class="fa fa-error" aria-hidden="true"></i>
												<?PHP }?>
												</div>
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
                                <td><b>Escala</b></td>
								<td><b>Vr. Honorarios</b></td>
                                <td width="100"><b>Acción</b></td>
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
	$(document).ready(function(){
		var reloader	=	false;
		inputs			=	$(".update_user");
		inputs.each(function(index,v){
			reloader	=	true;	
			//$("#main_").addClass("blurdiv");
			$.post("<?php echo site_url("Usuarios/HonorariosModelo")?>/"+$(this).val());			
		});
		if(reloader==true){
			//setTimeout(function(){document.location.reload();}, 2500);
			
		}
	});
</script>
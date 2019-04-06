<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	//pre($this->$modulo->result);return;
	$pasos		=	1;
	if($this->uri->segment(4)==0 || $this->uri->segment(4)>0){
		
		$pasos	=	(int)$this->uri->segment(4)	+	1;
		switch($pasos){
			case 1:
				//$title		=	"Crear Plataformas Inexistentes";
			
			case 2:
				$title		=	"Crear Nicknames Inexistentes";
			break;	
			case 3:
				$title		=	"Crear Nicknames Inexistentes";
			break;
			case 4:
				$title		=	"Finalizar";
			break;	
			case 5:
				$title		=	"Terminar";
			break;	
			default:
				$title		=	"";
		}
	}
	$regresar	=	false;
?>
<div class="container">
	<?php #pre($this->user);?>
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	Resultado Importación <?php echo count($this->$modulo->result);?>.
					</h4>
                    <?php 
						switch($pasos){
							case 1:
								echo "Producción por nickname.";
							break;
							case 2:
								echo "Producción por plataforma.";
							break;
							case 3:
								echo "Producción por plataforma.";
							break;
							case 4:
								echo "Resultado Final de Importación.";
							break;
						}
					?>
                </div>
                <div class="col-md-6 text-right">
                	<?php 
						if($pasos==1){
							$pasos=3;	
						}
					?>
                	<a class="btn btn-primary btn-md" id="back" href="<?php echo ($pasos<5)?base_url("Reportes/ResultadoImport/Debug/".$pasos):base_url("");?>">
                    	<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> 
                        <?php echo $title.' (Paso ';  echo $pasos.') ';?> 
					</a>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
                            	<td><b>ID Empresa</b></td>
                                <td><b>Sucursales</b></td>
                                <td><b>Mes</b></td>
                                <td><b>PP</b></td>
                                <?php if($this->uri->segment(4)=='' || $this->uri->segment(4)=='1'|| $this->uri->segment(4)=='2' || $this->uri->segment(4)=='3'){?>
                                <td><b>Página</b></td>
                                <?php }?>
                                <?php if($this->uri->segment(4)=='' || $this->uri->segment(4)=='2' || $this->uri->segment(4)=='3'){?>
                                	<td><b>Nickname</b></td>
                                <?php }else{
								?>
	                               
                                <?php	
								}?>
                                <td width="100" class="text-center"><b>Tokens</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								$total_tokens=0;
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
							?>
                            			<tr id="nickname_id<?php echo $v->nickname;?>">
                                            <td><?php print_r($v->id_empresa);?></td>
                                            <td><?php print_r($v->abreviacion);?></td>
                                            <td><?php print_r($v->mes);?></td>
                                            <td><?php print_r($v->periodo_pagos);?></td>
                                            
                                           	<?php if($this->uri->segment(4)=='' || $this->uri->segment(4)=='1'|| $this->uri->segment(4)=='2' || $this->uri->segment(4)=='3'){?>
											<td>
                                            	<?php 
													if($pasos==3 || $pasos==2){
														$like_name	=	usuarios_like_name($v->pagina);
														if($like_name->nombre_legal=='PERFIL IMPORTADO'){
												?>
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a class="btn btn-warning lightbox" data-type="iframe" title="Editar Plataforma" href="<?php echo base_url("Usuarios/Add_Todos_Iframe/Plataformas/".$like_name->user_id)?>">
                                                                    <i class="fa fa-pencil fa-spin" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                <?php
														}
													}
													print_r($v->pagina); 
												?>
                                                
											</td>
                                            <?php }?>
                                            <?php if($this->uri->segment(4)=='' || $this->uri->segment(4)=='2' || $this->uri->segment(4)=='3'){?>
                                            <td>
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
													<?php 
                                                        $like_name	=	nickname_like_name($v->nickname,$v->pagina);
                                                        if($pasos==3){
                                                            //pre($like_name);
                                                            if(@$like_name->id_modelo=='0' || @$like_name->id_master=='0'){
                                                    ?>
                                                                <a class="btn btn-warning lightbox" data-type="iframe"  title="Editar Usuario" href="<?php echo base_url("Usuarios/AddAsignarNicknameEdit/".$like_name->nickname_id."/iframe")?>">
                                                                    <i class="fa fa-pencil fa-spin" aria-hidden="true"></i>
                                                                </a>
                                                    <?php			
                                                            }
                                                        }
														if(is_object($like_name) && @$v->abreviacion2==''){
                                                    ?>
                                                    	   <a  data-rel="<?php echo $v->nickname;?>" class="btn btn-primary lightbox" title="Agregar Usuario" data-type="iframe" href="<?php echo base_url("Usuarios/Add_Todos/Modelos")?>">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </a>
                                                           <a  data-rel="<?php echo $v->nickname;?>" class="btn btn-primary delete_nickname" title="Eliminar Usuario" href="<?php echo base_url("Usuarios/DeleteNickname/".$like_name->nickname_id.'/'.$v->nickname)?>">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                    <?php 
														}
													?>
                                                </div>
                                                <?php	
													print_r($v->nickname);
													if($this->uri->segment(4)=='3'){
														if(is_object($like_name)){
															$get_modelo	=	centrodecostos($like_name->id_modelo);
															if(!empty($get_modelo)){	
																print_r('<br/><b>'.$get_modelo->primer_nombre.' '.$get_modelo->segundo_nombre.' '.$get_modelo->primer_apellido.' '.$get_modelo->segundo_apellido.'</b>');
															}else{
																echo '<br><b> Regresar al paso anterior y Completar datos.</b>';
																if($regresar==false){
																	$regresar	=	true;	
																}
															}
														}else{
															echo '<br><b> Regresar al paso anterior y Completar datos.</b>';
															if($regresar==false){
																$regresar	=	true;	
															}
														}
													}
												?>
                                                <?php }else{?>
                                                
                                            	<?php		
												}
												?>
											</td>
                                            <td class="text-right">
												<?php 
													print_r(format($v->tokens,false));
													$total_tokens=$v->tokens + $total_tokens;
												?>
                                            </td>
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td  <?php if($this->uri->segment(4)=='' ){ echo 'colspan="7"';}else{echo 'colspan="6"';} ?> class="text-center">
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
                                <td></td>
                                <td></td>
                                <td></td>
								<?php if($this->uri->segment(4)=='' || $this->uri->segment(4)=='2' || $this->uri->segment(4)=='3'){?>
	                                <td></td>
                                <?php }?>
                                <td><B>Total:</B></td>
                                <td><B class="text-right"><?php echo format($total_tokens,false);?></B></td>
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
		<?php if($regresar== true && $this->uri->segment(4)==3){?>
			$("#back").attr("href","<?php echo base_url("Reportes/ResultadoImport/Debug/2");?>");	
			$("#back").html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> Completar para Culminar');
		<?php }?>
		$(".delete_nickname").click(function(){
			var obj		=	$(this);
			$.post($(this).attr("href"),function(data){
				if(data.code==200){
					$("#nickname_id"+obj.data("rel")).remove();	
				}else{
					alert(data.message);	
				}
			},'json');
			return false;
		});
	});
</script>
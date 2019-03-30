<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	//print_r($this->$modulo->result);return;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$colums		=	'';
						$colums		.=	'<tr>';
						$count		=	0;
						
						$ciclo		=	$this->$modulo->fields;
						$colums		.=	'</tr>';	
					?>
					<table class="table table-hover">
						<thead>
							<tr>
								<td><b>Plataforma</b></td>
                                <td><b>Nickname</b></td>
                                <td><b>Contraseña</b></td>
                                <?php if($this->user->type<>'Modelos'){?>
                                <td width="50" class="text-center"><b>Acción</b></td>
                                <?php }?>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td>
                                            	<?php 
													print_r($v->plataforma);
												?>
                                            </td>
                                            <td>
	                                            <?php 
													//print_r($v->nickname);
													set_input_dinamico("nickname",$v,null,false,"input_dinamico",NULL,array("plataforma"));
												?>
                                            </td>
                                            <td>
												<?php
													if($this->user->principal==1){
														set_input_dinamico("password",$v,null,false,"input_dinamico",NULL,array("plataforma"));
													}else{
														echo $v->password;	
													}
												?>
                                            </td>
                                            <?php if($this->user->type<>'Modelos'){?>
                                            <td class="text-center">
	                                           	<?php 
													//pre($v);
													if($this->uri->segment(4)){
												?>
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                   	 	<a class="btn <?php if($v->estado==1){echo 'btn-warning active';}?>" <?php if($v->estado==0){ echo 'href="'.base_url("Usuarios/ActivarNickName/".$v->nickname_id.'/1/'.$this->uri->segment(3)).'"';}else{echo 'href="'.base_url("Usuarios/ActivarNickName/".$v->nickname_id.'/0/'.$this->uri->segment(3)).'"';}?> title="Activar o deactivar Nickname" >
                                                    		<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                                    	</a>
                                                        <a class="btn btn-primary" <?php echo 'href="'.base_url("Usuarios/AddAsignarNickname/".$v->nickname_id).'"';?> title="Editar Nickname" >
                                                    		<i class="fa fa-edit" aria-hidden="true"></i>
                                                    	</a>
                                                    </div>
                                                <?php		
													}else{
														echo ($v->estado==0)?"Inactivo":'Activo';
													}
												?>                                                    
                                            </td>
                                            <?php }?>
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

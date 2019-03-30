<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	//pre($this->$modulo->result);
		$Free 	= array();
		$PVT 	= array();
		$RSS 	= array();
		foreach ($this->$modulo->result as $k => $v) {
			if(@$v->tipo == "Free" && @$v->estado == 1){
				$Free[] = $v;
			}
			if(@$v->tipo == "PVT" && @$v->estado == 1){
				$PVT[]  = $v;
			}
			if(@$v->tipo == "RSS" && @$v->estado == 1){
				$RSS[]  = $v;
			}
		}
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs" role="tablist"> 
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#free" role="tab">
                        	    Free
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#pvt" role="tab">
                                PVT
                            </a>
                         </li>                         
                         <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#rss" role="tab">
                                RSS
                            </a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inactivas" role="tab">
                                Inactivas
                            </a>
                         </li>
                    </ul>
				</div> 
            	<div class="tab-content col-md-12">
            		 <div id="free" class="tab-pane active row justify-content-md-center mt-3" role="tabpanel">
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
									<th><b>Plataforma</b></th>
	                                <th><b>Usuario</b></th>
	                                <th><b>Contraseña</b></th>
	                                <?php if($this->user->type<>'Modelos'){?>
	                                <th width="80" class="text-center"><b>Acción</b></th>
	                                <?php }?>
								</tr>
							</thead>
							<tbody>
								<?php
									if(count($Free)>0){
										foreach($Free as $v1){
											
								?>
	                            			<tr>
	                                        	<td>
	                                            	<?php
		                                            		print_r($v1->plataforma);	
													?>
	                                            </td>
	                                            <td>
		                                            <?php 
														if($this->user->type == "Modelos"){
															echo $v1->nickname;
														}else{
															if($this->uri->segment($this->uri->total_segments()) == "edit"){
			                                            		set_input_dinamico("nickname",$v1,null,false,"input_dinamico text-left",NULL,array("plataforma"));
			                                            	}else{
			                                            		echo $v1->nickname;
			                                            	} 
														}
													?>
	                                            </td>
	                                            <td>
													<?php
														if($this->uri->segment($this->uri->total_segments()) == "edit" && $this->user->type !== "Modelos"){
		                                            		if($this->user->principal==1){
																set_input_dinamico("password",$v1,null,false,"input_dinamico text-left",NULL,array("plataforma"));
															}else{
																echo $v1->password;	
															}
		                                            	}else{
		                                            		echo $v1->password;	
		                                            	} 
													?>
	                                            </td>
	                                            <?php if($this->user->type<>'Modelos'){?>
	                                            <td class="text-center">
		                                           	<?php 
														//pre($v1);
														if($this->uri->segment(4)){
													?>
	                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                   	 	<a <?php if($v1->estado==0){ echo 'href="'.base_url("Usuarios/ActivarNickName/".$v1->nickname_id.'/1/'.$this->uri->segment(3)).'"';}else{echo 'href="'.base_url("Usuarios/ActivarNickName/".$v1->nickname_id.'/0/'.$this->uri->segment(3)).'"';}?> title="<?php if($v1->estado==1){echo 'Desactivar';}else{ echo 'Activar';}?> Usuario" style="vertical-align: middle;">
	                                                   	 	<?php if($v1->estado==1){?>
	                                                   	 		<i class="fas fa-times" aria-hidden="true"></i>
	                                                    	<?php }else{ ?>
	                                                 	<i class="fas fa-check" aria-hidden="true"></i>
	                                                    	<?php } ?>
	                                                    	</a>
	                                                    </div>
	                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                        <a <?php echo 'href="'.base_url("Usuarios/AddAsignarNickname/".$v1->nickname_id).'"';?> title="Editar Usuario">
	                                                    		<i class="fa fa-edit" aria-hidden="true"></i>
	                                                    	</a>
	                                                    </div>
	                                                <?php		
														}else{
															echo '<i class="fa fa-eye" aria-hidden="true"></i>';
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
                    <div id="pvt" class="tab-pane row justify-content-md-center mt-3" role="tabpanel">
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
									<th><b>Plataforma</b></th>
	                                <th><b>Usuario</b></th>
	                                <th><b>Contraseña</b></th>
	                                <?php if($this->user->type<>'Modelos'){?>
	                                <th width="80" class="text-center"><b>Acción</b></th>
	                                <?php }?>
								</tr>
							</thead>
							<tbody>
								<?php
									if(count($PVT)>0){
										foreach($PVT as $v2){
											
								?>
	                            			<tr>
	                                        	<td>
	                                            	<?php 
														print_r($v2->plataforma);
													?>
	                                            </td>
	                                            <td>
		                                            <?php 
														//print_r($v2->nickname);
														if($this->uri->segment($this->uri->total_segments()) == "edit" && $this->user->type !== "Modelos"){
		                                            		set_input_dinamico("nickname",$v2,null,false,"input_dinamico text-left",NULL,array("plataforma"));
		                                            	}else{
		                                            		echo $v2->nickname;
		                                            	} 
													?>
	                                            </td>
	                                            <td>
													<?php
														if($this->uri->segment($this->uri->total_segments()) == "edit" && $this->user->type !== "Modelos"){
		                                            		if($this->user->principal==1){
																set_input_dinamico("password",$v2,null,false,"input_dinamico text-left",NULL,array("plataforma"));
															}else{
																echo $v2->password;	
															}
		                                            	}else{
		                                            		echo $v2->password;	
		                                            	} 
													?>
	                                            </td>
	                                            <?php if($this->user->type<>'Modelos'){?>
	                                            <td class="text-center">
		                                           	<?php 
														//pre($v2);
														if($this->uri->segment(4)){
													?>
	                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                   	 	<a <?php if($v2->estado==0){ echo 'href="'.base_url("Usuarios/ActivarNickName/".$v2->nickname_id.'/1/'.$this->uri->segment(3)).'"';}else{echo 'href="'.base_url("Usuarios/ActivarNickName/".$v2->nickname_id.'/0/'.$this->uri->segment(3)).'"';}?> title="<?php if($v2->estado==1){echo 'Desactivar';}else{ echo 'Activar';}?> Usuario" style="vertical-align: middle;">
	                                                   	 	<?php if($v2->estado==1){?>
	                                                   	 		<i class="fas fa-times" aria-hidden="true"></i>
	                                                    	<?php }else{ ?>
	                                                    		<i class="fas fa-check" aria-hidden="true"></i>
	                                                    	<?php } ?>
	                                                    	</a>
	                                                    </div>
	                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                        <a <?php echo 'href="'.base_url("Usuarios/AddAsignarNickname/".$v2->nickname_id).'"';?> title="Editar Usuario">
	                                                    		<i class="fa fa-edit" aria-hidden="true"></i>
	                                                    	</a>
	                                                    </div>
	                                                <?php		
														}else{
															echo '<i class="fa fa-eye" aria-hidden="true"></i>';
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
                    <div id="rss" class="tab-pane row justify-content-md-center mt-3" role="tabpanel">
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
									<th><b>Plataforma</b></th>
	                                <th><b>Usuario</b></th>
	                                <th><b>Contraseña</b></th>
	                                <?php if($this->user->type<>'Modelos'){?>
	                                <th width="80" class="text-center"><b>Acción</b></th>
	                                <?php }?>
								</tr>
							</thead>
							<tbody>
								<?php
									if(count($RSS)>0){
										foreach($RSS as $v3){
											
								?>
	                            			<tr>
	                                        	<td>
	                                            	<?php 
														print_r($v3->plataforma);
													?>
	                                            </td>
	                                            <td>
		                                            <?php 
														//print_r($v3->nickname);
														if($this->uri->segment($this->uri->total_segments()) == "edit" && $this->user->type !== "Modelos"){
		                                            		set_input_dinamico("nickname",$v3,null,false,"input_dinamico text-left",NULL,array("plataforma"));
		                                            	}else{
		                                            		echo $v3->nickname;
		                                            	} 
													?>
	                                            </td>
	                                            <td>
													<?php
														if($this->uri->segment($this->uri->total_segments()) == "edit" && $this->user->type !== "Modelos"){
		                                            		if($this->user->principal==1){
																set_input_dinamico("password",$v3,null,false,"input_dinamico text-left",NULL,array("plataforma"));
															}else{
																echo $v3->password;	
															}
		                                            	}else{
		                                            		echo $v3->password;	
		                                            	} 
													?>
	                                            </td>
	                                            <?php if($this->user->type<>'Modelos'){?>
	                                            <td class="text-center">
		                                           	<?php 
														//pre($v3);
														if($this->uri->segment(4)){
													?>
	                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                   	 	<a <?php if($v3->estado==0){ echo 'href="'.base_url("Usuarios/ActivarNickName/".$v3->nickname_id.'/1/'.$this->uri->segment(3)).'"';}else{echo 'href="'.base_url("Usuarios/ActivarNickName/".$v3->nickname_id.'/0/'.$this->uri->segment(3)).'"';}?> title="<?php if($v3->estado==1){echo 'Desactivar';}else{ echo 'Activar';}?> Usuario" style="vertical-align: middle;">
	                                                   	 	<?php if($v3->estado==1){?>
	                                                   	 		<i class="fas fa-times" aria-hidden="true"></i>
	                                                    	<?php }else{ ?>
	                                                    		<i class="fas fa-check" aria-hidden="true"></i>
	                                                    	<?php } ?>
	                                                    	</a>
	                                                    </div>
	                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                        <a <?php echo 'href="'.base_url("Usuarios/AddAsignarNickname/".$v3->nickname_id).'"';?> title="Editar Usuario">
	                                                    		<i class="fa fa-edit" aria-hidden="true"></i>
	                                                    	</a>
	                                                    </div>
	                                                <?php		
														}else{
															echo '<i class="fa fa-eye" aria-hidden="true"></i>';
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
                    <div id="inactivas" class="tab-pane row justify-content-md-center mt-3" role="tabpanel">
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
									<th><b>Plataforma</b></th>
	                                <th><b>Usuario</b></th>
	                                <th><b>Contraseña</b></th>
	                                <?php if($this->user->type<>'Modelos'){?>
	                                <th width="80" class="text-center"><b>Acción</b></th>
	                                <?php }?>
								</tr>
							</thead>
							<tbody>
								<?php
									if(count($this->$modulo->result)>0){
										foreach($this->$modulo->result as $v4){
											if($v4->estado == 0){
								?>
	                            			<tr>
	                                        	<td>
	                                            	<?php 
														print_r($v4->plataforma);
													?>
	                                            </td>
	                                            <td>
		                                            <?php 
														//print_r($v4->nickname);
														if($this->uri->segment($this->uri->total_segments()) == "edit" && $this->user->type !== "Modelos"){
		                                            		set_input_dinamico("nickname",$v4,null,false,"input_dinamico text-left",NULL,array("plataforma"));
		                                            	}else{
		                                            		echo $v4->nickname;
		                                            	} 
													?>
	                                            </td>
	                                            <td>
													<?php
														if($this->uri->segment($this->uri->total_segments()) == "edit" && $this->user->type !== "Modelos"){
		                                            		if($this->user->principal==1){
																set_input_dinamico("password",$v4,null,false,"input_dinamico text-left",NULL,array("plataforma"));
															}else{
																echo $v4->password;	
															}
		                                            	}else{
		                                            		echo $v4->password;	
		                                            	} 
													?>
	                                            </td>
	                                            <?php if($this->user->type<>'Modelos'){?>
	                                            <td class="text-center">
		                                           	<?php 
														//pre($v4);
														if($this->uri->segment(4)){
													?>
	                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                   	 	<a <?php if($v4->estado==0){ echo 'href="'.base_url("Usuarios/ActivarNickName/".$v4->nickname_id.'/1/'.$this->uri->segment(3)).'"';}else{echo 'href="'.base_url("Usuarios/ActivarNickName/".$v4->nickname_id.'/0/'.$this->uri->segment(3)).'"';}?> title="<?php if($v4->estado==1){echo 'Desactivar';}else{ echo 'Activar';}?> Usuario" style="vertical-align: middle;">
	                                                   	 	<?php if($v4->estado==1){?>
	                                                   	 		<i class="fas fa-times" aria-hidden="true"></i>
	                                                    	<?php }else{ ?>
	                                                    		<i class="fas fa-check" aria-hidden="true"></i>
	                                                    	<?php } ?>
	                                                    	</a>
	                                                    </div>
	                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                        <a <?php echo 'href="'.base_url("Usuarios/AddAsignarNickname/".$v4->nickname_id).'"';?> title="Editar Usuario">
	                                                    		<i class="fa fa-edit" aria-hidden="true"></i>
	                                                    	</a>
	                                                    </div>
	                                                <?php		
														}else{
															echo '<i class="fa fa-eye" aria-hidden="true"></i>';
														}
													?>                                                    
	                                            </td>
	                                            <?php }?>
	                                        </tr>
	                            <?php
	                            			}	
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
</div>

<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
    		<?php if($this->user->type=='root' || $this->user->type=='CentroCostos'){?>
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Asignar Usuario.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Recargar Nicknames.",
															"icono"	=>	'<i class="fas fa-sync"></i>',
															"url"	=>	base_url($this->uri->segment(1)."/Reload/Nicknames"),
															"lightbox"=>true),	
							)
						);
			?>
			<?php }else{ ?>
			<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Asignar Usuario.",
															"url"	=>	current_url()),
							)
						);
			?>
			<?php } ?>
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
					<ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Modelos" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Modelos 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Monitores" role="tab">
                               <i class="fas fa-angle-right"></i>  Monitores 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Administrativos" role="tab">
                               <i class="fas fa-angle-right"></i>  Administrativos 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Asociados" role="tab">
                               <i class="fas fa-angle-right"></i>  Asociados 
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content row">
    					<div class="tab-pane active col-md-12" id="Modelos" role="tabpanel">
							<table class="ordenar display table table-hover" ordercol= 0  order="asc">
								<thead>
									<tr>
										<th><b>Nombre</b></th>
		                                <th><b>Turno</b></th>
		                                <th class="text-">Room</th>
		                                <th width="300" class="text-right"><b>Acciónes</b></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(count($this->$modulo->result['Modelos'])>0){
											foreach($this->$modulo->result['Modelos'] as $v){
												
									?>
		                            			<tr>
		                                        	<td>
		                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
		                                            </td>
		                                            <td>
			                                            <?php echo VerificaTurnos($v); ?>
		                                            </td>
		                                            <td>
		                                            	<?php
		                                            		if($v->room_transmision <= 100){
		                                            			echo 'Room #'.'&nbsp;'.$v->room_transmision;	
		                                            		}else{
		                                            			echo 'Satelite';
		                                            		}  
		                                            	?>
		                                            </td>
		                                            <td class="text-right">
		                                            	
		                                                	<?php if($this->user->type=='root'){?>
		                                                        <a class="" title="Asignar Modelo" href="<?php echo base_url("Usuarios/SetPerfil/".$v->user_id."/AsignarNickname")?>">
		                                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
		                                                        </a>
		                                                    <?php }?>
		                                                    <?php
                												if($this->user->type == "Asociados" || $this->user->type == "root" || $this->user->type == "Administrativos"){
		                                                    ?>
		                                                	<a class="lightbox" data-type="iframe" title="Agregar Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/AddAsignarNickname/".$v->user_id."/new")?>">
		                                                    	<i class="fa fa-plus" aria-hidden="true"></i>
		                                                    </a>
		                                                  
		                                                    <a class=" lightbox" data-type="iframe" title="Editar Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id.'/edit')?>">
		                                                    <i class="fas fa-edit" aria-hidden="true"></i>
		                                                    </a>
		                                                	<?php } ?>
															<a class="lightbox" data-type="iframe" title="Ver Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id)?>">
		                                                    	<i class="fa fa-eye" aria-hidden="true"></i>
		                                                    </a>
		                                                
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
										<td><b>Nombre</b></td>
		                                <td><b>Turno</b></td>
		                                <td><b>Room</b></td>
		                                <td width="300" class="text-right"><b>Acciónes</b></td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="tab-pane col-md-12" id="Monitores" role="tabpanel">
							<table class="ordenar display table table-hover" ordercol= 0  order="asc">
								<thead>
									<tr>
										<th><b>Nombre</b></th>
		                                <th width="300" class="text-right"><b>Acciónes</b></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(count($this->$modulo->result['Monitores'])>0){
											foreach($this->$modulo->result['Monitores'] as $v){
												
									?>
		                            			<tr>
		                                        	<td>
		                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
		                                            </td>
		                                            <td class="text-right">
		                                            	
		                                                	<?php if($this->user->type=='root'){?>
		                                                        <a class="" title="Asignar Modelo" href="<?php echo base_url("Usuarios/SetPerfil/".$v->user_id."/AsignarNickname")?>">
		                                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
		                                                        </a>
		                                                    <?php }?>
		                                                    <?php
                												if($this->user->type == "Asociados" || $this->user->type == "root" || $this->user->type == "Administrativos"){
		                                                    ?>
		                                                	<a class="lightbox" data-type="iframe" title="Agregar Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/AddAsignarNickname/".$v->user_id."/new")?>">
		                                                    	<i class="fa fa-plus" aria-hidden="true"></i>
		                                                    </a>
		                                                   
		                                                    <a class=" lightbox" data-type="iframe" title="Editar Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id.'/edit')?>">
		                                                   <i class="fas fa-edit" aria-hidden="true"></i>
		                                                    </a>
		                                                	<?php } ?>
															<a class="lightbox" data-type="iframe" title="Ver Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id)?>">
		                                                    	<i class="fa fa-eye" aria-hidden="true"></i>
		                                                    </a>
		                                                
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
										<td><b>Nombre</b></td>
		                                <td width="300" class="text-right"><b>Acciónes</b></td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="tab-pane col-md-12" id="Administrativos" role="tabpanel">	 <table class="ordenar display table table-hover" ordercol= 0  order="asc">
								<thead>
									<tr>
										<th><b>Nombre</b></th>
		                                <th width="300" class="text-right"><b>Acciónes</b></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(count($this->$modulo->result['Administrativos'])>0){
											foreach($this->$modulo->result['Administrativos'] as $v){
												
									?>
		                            			<tr>
		                                        	<td>
		                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
		                                            </td>
		                                            <td class="text-right">
		                                            	
		                                                	<?php if($this->user->type=='root'){?>
		                                                        <a class="" title="Asignar Modelo" href="<?php echo base_url("Usuarios/SetPerfil/".$v->user_id."/AsignarNickname")?>">
		                                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
		                                                        </a>
		                                                    <?php }?>
		                                                    <?php
                												if($this->user->type == "Asociados" || $this->user->type == "root" || $this->user->type == "Administrativos"){
		                                                    ?>
		                                                	<a class="lightbox" data-type="iframe" title="Agregar Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/AddAsignarNickname/".$v->user_id."/new")?>">
		                                                    	<i class="fa fa-plus" aria-hidden="true"></i>
		                                                    </a>
		                                                   
		                                                    <a class=" lightbox" data-type="iframe" title="Editar Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id.'/edit')?>">
		                                                    	<i class="fas fa-edit" aria-hidden="true"></i>
		                                                    </a>
		                                                	<?php } ?>
															<a class="lightbox" data-type="iframe" title="Ver Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id)?>">
		                                                    	<i class="fa fa-eye" aria-hidden="true"></i>
		                                                    </a>
		                                                
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
										<td><b>Nombre</b></td>
		                                <td width="300" class="text-right"><b>Acciónes</b></td>
									</tr>
								</tfoot>
							</table>
						</div> 
						<div class="tab-pane col-md-12" id="Asociados" role="tabpanel">
							<table class="ordenar display table table-hover" ordercol= 0  order="asc">
								<thead>
									<tr>
										<th><b>Nombre</b></th>
		                                <th width="300" class="text-right"><b>Acciónes</b></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(count($this->$modulo->result['Asociados'])>0){
											foreach($this->$modulo->result['Asociados'] as $v){
												
									?>
		                            			<tr>
		                                        	<td>
		                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
		                                            </td>
		                                            <td class="text-right">
		                                            	
		                                                	<?php if($this->user->type=='root'){?>
		                                                        <a class="" title="Asignar Modelo" href="<?php echo base_url("Usuarios/SetPerfil/".$v->user_id."/AsignarNickname")?>">
		                                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
		                                                        </a>
		                                                    <?php }?>
		                                                    <?php
                												if($this->user->type == "Asociados" || $this->user->type == "root" || $this->user->type == "Administrativos"){
		                                                    ?>
		                                                	<a class="lightbox" data-type="iframe" title="Agregar Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/AddAsignarNickname/".$v->user_id."/new")?>">
		                                                    	<i class="fa fa-plus" aria-hidden="true"></i>
		                                                    </a>
		                                                  
		                                                    <a class=" lightbox" data-type="iframe" title="Editar Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id.'/edit')?>">
		                                                    	<i class="fas fa-edit" aria-hidden="true"></i>
		                                                    </a>
		                                                	<?php } ?>
															<a class="lightbox" data-type="iframe" title="Ver Usuario <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id)?>">
		                                                    	<i class="fa fa-eye" aria-hidden="true"></i>
		                                                    </a>
		                                                
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
										<td><b>Nombre</b></td>
		                                <td width="300" class="text-right"><b>Acciónes</b></td>
									</tr>
								</tfoot>
							</table>
						</div>  
					</div>
					<div class="container">
						<?php 
							//echo $this->pagination->create_links();
						?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

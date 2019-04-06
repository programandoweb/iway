<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
	if(!centro_de_costos()){
		return;
	}
?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->task;
$json		=	json_decode($row->descripcion);
//pre($json);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información de Tarea</h3>
                    </div>
                    <?php 
						if($row->user_id==$this->user->user_id || $this->user->user_id==1){
					?>
                            <div class="col-md-12 text-center">
	                            <a class="btn btn-primary" href="<?php echo base_url("Utilidades/ViewTask/".$this->uri->segment(3).'/close');?>">Cerrar Incidencia</a>
                            </div>
                    <?php
						}
					?>
                </div>
                <div id="extra_datos">
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Tarea *</b>
                        </div>
                        <div class="col-md-6">
                            <?php print($row->tarea);?>	
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Pantalla *</b>
                        </div>
                        <div class="col-md-6"> 
	                        <?php print($json->pantalla);?>  
						</div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Módulo  *</b>
                        </div>
                        <div class="col-md-6"> 
							<?php print($json->modulo);?> 
						</div>
                    </div> 
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>SubMódulo  *</b>
                        </div>
                        <div class="col-md-6"> 
							<?php print($json->submodulo);?>  	                              
						</div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>URL  *</b>
                        </div>
                        <div class="col-md-6"> 
	                        <?php print($json->url);?>  
						</div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Tiempo en Minutos  *</b>
                        </div>
                        <div class="col-md-6"> 
	                        <?php print($json->tiempo);?>  
						</div>
                    </div>  
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Prioridad *</b>
                        </div>
                        <div class="col-md-6"> 
                        	<?php print(contar_dias_entre_fecha_x_prioridad($json->fecha_hasta))?>
						</div>
                    </div>  
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Fecha desde / hasta *</b>
                        </div>
                        <div class="col-md-6"> 
	                        <?php print($row->fecha_desde);?>  /  <?php print($row->fecha_hasta);?>
						</div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Observacion *</b>
                            <br />
							<?php 
	                            if($row->user_id==$this->user->user_id || $this->user->user_id==1){
                            ?>
                            		<i class="fas fa-edit edit" style="cursor:pointer;"></i>
                            <?php
								}
							?>
                        </div>
                        <div class="col-md-6">
                        	<div id="activo" class="items">	
                            	<?php print(saltoLinea($json->descripcion));?>
                            </div>
							<?php 
	                            if($row->user_id==$this->user->user_id || $this->user->user_id==1){
                            ?>
                            <div id="inactivo" class="items">
                            	<?php 	
										$hidden 	= 	array('tarea_id' => $this->uri->segment(3));
										echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	
								?>
                            	<?php 	echo form_textarea('descripcion', $row->descripcion, array('class'=>'form-control',"require"=>true));?>
                                <br />
                                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
                                <?php 	echo form_close();?>
                            </div>
                            <?php
								}
							?>
                        </div>
                    </div>
                    <?php if(is_array($this->Utilidades->files)){?>
                    <div class="row form-group item">
                        <div class="col-md-12 text-center">
                            <h3>Adjuntos</h3>
                        </div>
                    </div>
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                        <thead>
                            <tr>
                                <td><b>Archivo</b></td>
                                <td width="20" class="text-center"><b>Acción</b></td>
                            </tr>
                        </thead>
						<tbody>
							<?PHP 
								foreach($this->Utilidades->files as $v){
									if($v!='index.html'){
							?>
                                        <tr>
                                            <td>
                                            	<?php
													if (strpos($v, "/")>0) {
                                                ?>
                                                		<i class="far fa-folder-open fa-2x"></i>
                                                        <?php 
															$files = directory_map(PATH_BASE.'images/uploads/tasks/'.$this->uri->segment(3).'/'.$v, 1, FALSE);
															foreach($files as $v2){
																if($v2!='index.html'){
																	?>
                                                                    	<a href="<?PHP echo IMG.'uploads/tasks/'.$this->uri->segment(3).'/'.$v.'/'.$v2?>" target="_blank">
                                                                    		<img width="40" src="<?PHP echo IMG.'uploads/tasks/'.$this->uri->segment(3).'/'.$v.'/'.$v2?>" />
                                                                        </a>
                                                                    <?php
																}
															}
														?>
												<?php	
													}else{
												?>		<a href="<?PHP echo IMG.'uploads/tasks/'.$this->uri->segment(3).'/'.$v?>" target="_blank">
                                                			<img width="50" src="<?PHP echo IMG.'uploads/tasks/'.$this->uri->segment(3).'/'.$v?>" />
                                                        </a>
                                                <?php
													}
												?>    
                                            </td>
                                            <td class="text-center">
                                            	<?php
													if (strpos($v, "/")==0) {
                                                ?>
		                                                <a href="<?PHP echo IMG.'uploads/tasks/'.$this->uri->segment(3).'/'.$v?>" class="link" target="_blank"><i class="fas fa-eye" aria-hidden="true"></i></a>
                                                <?php
													}else{
														echo '-';	
													}
												?>    
                                            </td>
                                        </tr>
                            <?php 
									}
								}
							?>
                        </tbody>
					</table>                        
                    <?php		
						}
					?>
                    <div class="row form-group item">
                        <div class="col-md-12 text-center">
                            <h3>Usuarios Asignados</h3>
                        </div>
                    </div>
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                        <thead>
                            <tr>
                                <td width="200"><b>Responsable</b></td>
                                <td  class="text-left"><b>Asignacion</b></td>
                                <td width="100" class="text-center"><b>Estatus</b></td>
                                <td width="20" class="text-center"><b>Acción</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($this->$modulo->usuarios)>0){
                                    foreach($this->$modulo->usuarios as  $key => $v){
                                        
                            ?>
                                        <tr>
                                            <td>
                                                <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            </td>
                                            <td>
                                            	<?php print($v->asignacion);?>
                                            </td>
                                            <td class="text-center">
                                            	<?php print(Utilidades_Estatus("ut_tareas_asignacion",$v->estatus));?>
                                            </td>
                                            <td class="text-center">
                                            	<?php 
													if($row->estatus<2){?>
                                            			<a href="<?php echo base_url($this->uri->segment(1)."/ViewTaskResponse/".$this->uri->segment(3))?>"><i class="fas fa-check"></i></a>
                                                <?php 
													}else{
														echo '-';	
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
                    </table>
				</div>                    
			</div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$("#inactivo").hide();
		$(".edit").click(function(){
			$("#activo").toggle(function(){
				$("#inactivo").toggle();
			});
		});
	});
</script>
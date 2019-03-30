<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row">
            	<div class="col-md-12">
                	<ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#mistareas" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Mis Tareas 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tareas" role="tab">
                               <i class="fas fa-angle-right"></i>  Tareas 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tareasprecerradas" role="tab">
                               <i class="fas fa-angle-right"></i>  PreCerradas 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tareascerradas" role="tab">
                               <i class="fas fa-angle-right"></i>  Cerradas 
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#personal" role="tab">
                               <i class="fas fa-angle-right"></i>  Personal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#notificaciones" role="tab">
                               <i class="fas fa-angle-right"></i>  Notificaciones
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content row">
                        <div class="tab-pane  col-md-12" id="mistareas" role="tabpanel">
                        	<div class="row filters">
                               	<div class="col-md-6 text-right">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="ordenar display table table-hover">
                                        <thead>
                                            <tr>
                                                 <th><b>Id</b></th>
                                                <th><b>Tarea</b></th>
                                                <th width="100" class="text-center"><b>Fecha</b></th>
                                                <th width="100" class="text-center"><b>Estado</b></th>
                                                <th width="20" class="text-right"><b>Acción</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(count($this->$modulo->tasksMe)>0){
                                                    foreach($this->$modulo->tasksMe as $v){
														//$json	=	json_decode($v->descripcion);
														//$user	=	centrodecostos($json->asignacion[0]);
                                            ?>
                                                        <tr>
                                                            <td>
                                                            	<?php //pre($v);?>
                                                            	<?php echo anchor('Utilidades/ViewTask/'.$v->tarea_id, "UB".$v->tarea_id, array("title"=>"Ver Tarea Programada","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                            </td>
                                                            <td>
                                                                <?php print($v->tarea);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php 
																	print(prioridad_x_dias($v->fecha_hasta));
																?>
                                                            </td>
                                                            <!--td class="text-center">
                                                                <?php print($v->fecha_desde);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php print($v->fecha_hasta);?>
                                                            </td-->
                                                            <td class="text-center">
                                                                <?php print(Utilidades_Estatus("ut_tareas",$v->estatus));?>
                                                            </td>                                                            
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                    <?php echo anchor('Utilidades/ViewTask/'.$v->tarea_id, '<i class="fas fa-eye" aria-hidden="true"></i>', array("title"=>"Ver Tarea Programada","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                                </div>
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
                        <div class="tab-pane active col-md-12" id="tareas" role="tabpanel">
                            <div class="row filters">
                                <div class="col-md-6 text-right">
                                    <?php echo anchor('Utilidades/AddTask/0', '<i class="fas fa-plus-circle"></i>', array("title"=>"Agregar Tarea","class"=>"lightbox","data-type"=>"iframe"));?>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="ordenar display table table-hover">
                                        <thead>
                                            <tr>
                                                <th><b>Id</b></th>
                                                <th><b>Patalla</b></th>
                                                <th width="100" class="text-center"><b>Módulo</b></th>
                                                <th width="100" class="text-center"><b>SubMódulo</b></th>
                                                <th width="100" class="text-center"><b>Tiempo</b></th>
                                                <th width="100" class="text-center"><b>Responsable</b></th>
                                                 <th width="100" class="text-center"><b>Tarea</b></th>
                                                <th width="20" class="text-right"><b>Acción</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(count($this->$modulo->tasks)>0){
                                                    foreach($this->$modulo->tasks as $v){
														$json	=	json_decode($v->descripcion);
														$user	=	centrodecostos($json->asignacion[0]);
                                            ?>		
                                                        <tr>
                                                            <td>
                                                                UB<?php echo anchor('Utilidades/ViewTask/'.$v->tarea_id, $v->tarea_id, array("title"=>"Ver Tarea Programada","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                            </td>
                                                            <td>
                                                                <?php print($json->pantalla);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php 
																	print($json->modulo);
																?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php 
																	print($json->submodulo);
																	
																?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php 
																	print($json->tiempo);
																?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php print(nombre($user));?>
                                                            </td>
                                                            <td class="text-center">
                                                            	<?php 
																	print($v->tarea);
																	//print(Utilidades_Estatus("ut_tareas",$v->estatus));
																?>
                                                            </td>                                                            
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                    <?php echo anchor('Utilidades/ViewTask/'.$v->tarea_id, '<i class="fas fa-eye" aria-hidden="true"></i>', array("title"=>"Ver Tarea Programada","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                                </div>
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
                        <div class="tab-pane col-md-12" id="tareasprecerradas" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="ordenar display table table-hover">
                                        <thead>
                                            <tr>
                                                <th><b>Id</b></th>
                                                <th><b>Tarea</b></th>
                                                <th width="100" class="text-center"><b>Fecha</b></th>
                                                <th width="100" class="text-center"><b>Estado</b></th>
                                                <th width="20" class="text-right"><b>Acción</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(count($this->$modulo->preready)>0){
                                                    foreach($this->$modulo->preready as $v){
                                            ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $v->tarea_id ?>
                                                            </td>
                                                            <td>
                                                                <?php print($v->tarea);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php print($v->fecha_desde);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php print(Utilidades_Estatus("ut_tareas",$v->estatus));?>
                                                                <?php #print($v->estatus);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                    <?php echo anchor('Utilidades/ViewTask/'.$v->tarea_id, '<i class="fas fa-eye" aria-hidden="true"></i>', array("title"=>"Ver Tarea Programada","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                                </div>
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
                        <div class="tab-pane col-md-12" id="tareascerradas" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="ordenar display table table-hover">
                                        <thead>
                                            <tr>
                                                <th><b>Id</b></th>
                                                <th><b>Tarea</b></th>
                                                <th width="100" class="text-center"><b>Fecha</b></th>
                                                <th width="100" class="text-center"><b>Estado</b></th>
                                                <th width="20" class="text-right"><b>Acción</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(count($this->$modulo->ready)>0){
                                                    foreach($this->$modulo->ready as $v){
                                            ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $v->tarea_id; ?>
                                                            </td>
                                                            <td>
                                                                <?php print($v->tarea);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php print($v->fecha_desde);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php print(Utilidades_Estatus("ut_tareas",$v->estatus));?>
                                                                <?php #print($v->estatus);?>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                    <?php echo anchor('Utilidades/ViewTask/'.$v->tarea_id, '<i class="fas fa-eye" aria-hidden="true"></i>', array("title"=>"Ver Tarea Programada","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                                </div>
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
                        <!-- Pendientes-->
                        <div class="tab-pane col-md-12" id="personal" role="tabpanel">
                        	<div class="row filters">
                                <div class="col-md-6 text-right">
                                    <?php echo anchor('Utilidades/Edit/0', '<i class="fas fa-plus-circle"></i>', array("title"=>"Agregar Usuario","class"=>"lightbox","data-type"=>"iframe"));?>  
                                </div>
                            </div>
                            <table class="ordenar display table table-hover">
                                <thead>
                                    <tr>
                                        <th><b>Nombre</b></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th width="10" class="text-right"><b>Acción</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->$modulo->usuarios)>0){
                                            foreach($this->$modulo->usuarios as $v){
                                                
                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                            <?php echo anchor('Utilidades/Edit/'.$v->user_id, '<i class="fas fa-edit" aria-hidden="true"></i>', array("title"=>"Editar Perfil","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                        </div>
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
                        <div class="tab-pane col-md-12" id="notificaciones" role="tabpanel">
                        	<div class="row filters">
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                        $modulo		=	$this->ModuloActivo;
                                    ?>
                                    <table class="ordenar display table table-hover">
                                        <thead>
                                            <tr>
                                                <th><b>Asunto</b></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th width="10" class="text-right"><b>Acción</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(count($this->$modulo->notificaciones)>0){
                                                    foreach($this->$modulo->notificaciones as $v){
                                                        
                                            ?>
                                                        <tr>
                                                            <td>
                                                                <?php 
                                                                    $Notificacion	=	Notificacion($v);
                                                                    print($Notificacion->tarea);
                                                                ?>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                    <?php echo anchor('Utilidades/ViewNotification/'.$v->notificacion_id, '<i class="fas fa-eye" aria-hidden="true"></i>', array("title"=>"Ver Notificación","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                                </div>
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
            </div>
        </div>
    </div>
</div>
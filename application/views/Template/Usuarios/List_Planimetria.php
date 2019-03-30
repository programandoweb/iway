.<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<?php 
		echo TaskBar(array("name"		=>	array(	"title"	=>	"Planimetria",
													"url"	=>	current_url()),
							"pdf"		=>	true,

					)
				);
	?>
    <ul class="nav nav-tabs" role="tablist"> 
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#primaria" role="tab">
                Sede
            </a>
        </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#secundaria" role="tab">
                Satelite
            </a>
         </li> 
    </ul>
	<div class="justify-content-md-center tab-content" id="imprimeme">
		<div id="primaria" class="tab-pane active col-md-12" role="tabpanel">
            <div class="row">
                <div class=" col-md-12">
                <?php
                    if(count($this->$modulo->result['sede']) > 0){
                        foreach($this->$modulo->result['sede'] as $k => $v){
                            $exp_room_transmision	=	explode("|s|",$v->room_transmision);
                            $exp_nombre_modelo		=	explode("|s|",$v->nombre_modelo);
                            $exp_turno_manama		=	explode("|s|",$v->turno_manama);
                            $exp_turno_tarde		=	explode("|s|",$v->turno_tarde);
                            $exp_turno_noche		=	explode("|s|",$v->turno_noche);
                            $exp_turno_intermedio	=	explode("|s|",$v->turno_intermedio);
                ?>			
                			<h4><?php echo $v->abreviacion;?></h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="12%"><b>Room</b></th>
                                        <?php
                                        	if($v->manana == 1){
                                        ?>
                                        <th class="text-center" width="22%"><b>Mañana</b></th>		
										<?php
                                        	}
                                        ?>
                                         <?php
                                        	if($v->tarde == 1){
                                        ?>
                                        	<th class="text-center" width="22%"><b>Tarde</b></th>		
										<?php
                                        	}
                                        ?>
                                         <?php
                                        	if($v->noche == 1){
                                        ?>
                                        	<th class="text-center" width="22%"><b>Noche</b></th>		
										<?php
                                        	}
                                        ?>
                                         <?php
                                        	if($v->intermedio == 1){
                                        ?>
                                        	<th class="text-center" width="22%"><b>Intermedio</b></th>		
										<?php
                                        	}
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
										for($i=1;$i<=$v->n_rooms;$i++){
                                            $manana ='';
                                            $tarde = '';
                                            $noche = '';
                                            $intermedio = '';
    
    										foreach ($exp_room_transmision as $k2 => $v2) {
                                                
    										 	if($v2 == $i){
                                                        if($v->manana == 1){
                                                            if($exp_turno_manama[$k2] == 1){
                                                                $manana .= $exp_nombre_modelo[$k2].'<br>';
                                                            }
                                                        }
                                                        if($v->tarde == 1){
                                                            if($exp_turno_tarde[$k2] == 1){
                                                                $tarde .= $exp_nombre_modelo[$k2].'<br>';
                                                            } 
                                                        }
                                                        if($v->noche == 1){
                                                            if($exp_turno_noche[$k2] == 1){
                                                                $noche .= $exp_nombre_modelo[$k2].'<br>';
                                                            } 
                                                        }  
                                                    }
    											}
                                    ?>
                                    <tr>
                                        <td><b>Room <?php echo $i; ?></b></td>
                                        <?php
                                            if($v->manana == 1){
                                        ?>
                                        <td class="text-center p-2">
                                            <?php
                                                if(empty($manana)){
                                                    echo '<b style="color:#FD9100;">Disponible<b>';
                                                }else{
                                                    echo $manana;
                                                } ?>
                                        </td>
                                        <?php
                                            }
                                            if($v->tarde == 1){
                                        ?>
                                        <td class="text-center p-2">
                                            <?php
                                                if(empty($tarde)){
                                                    echo '<b style="color:#FD9100;">Disponible<b>';
                                                }else{
                                                    echo $tarde;
                                                } ?>
                                        </td>
                                        <?php
                                            }
                                            if($v->noche == 1){
                                        ?>
                                        <td class="text-center p-2">
                                            <?php
                                                if(empty($noche)){
                                                    echo '<b style="color:#FD9100;">Disponible<b>';
                                                }else{
                                                    echo $noche;
                                                } ?>
                                        </td>
                                        <?php
                                            }
                                            if($v->intermedio == 1){
                                        ?>
                                        <td class="text-center p-2">
                                            <?php
                                                if(empty($intermedio)){
                                                    echo '<b style="color:#FD9100;">Disponible<b>';
                                                }else{
                                                    echo $intermedio;
                                                } ?>
                                        </td>
                                        <?php
                                            }
                                        ?>
                                    </tr>
                                    <?php
                                        }
									?> 
                                </tbody>
                            </table>
                <?php 
                        }
                    }
                ?>
                </div>    
            </div>
        </div>
        <div id="secundaria" class="tab-pane justify-content-md-center col-md-12" role="tabpanel">
        	            <div class="row">
                <div class=" col-md-12">
                <?php
                	//pre($this->$modulo->result['satelite']);
                	if(count($this->$modulo->result['satelite']) > 0){
                        foreach($this->$modulo->result['satelite'] as $v){
                            $exp_room_transmision	=	explode("|s|",$v->room_transmision);
                            $exp_nombre_modelo		=	explode("|s|",$v->nombre_modelo);
                            $exp_turno_manama		=	explode("|s|",$v->turno_manama);
                            $exp_turno_tarde		=	explode("|s|",$v->turno_tarde);
                            $exp_turno_noche		=	explode("|s|",$v->turno_noche);
                            $exp_turno_intermedio	=	explode("|s|",$v->turno_intermedio);
                ?>			<h4><?php echo $v->abreviacion;?></h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="12%"><b>Room</b></th>
                                        <th class="text-center" width="22%"><b>Modelo</b></th>
                                        <th class="text-center" width="22%"><b>Turno</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
											foreach ($exp_room_transmision as $k2 => $v2) {?>
									<tr>
										<td> 
											Satelite
										</td>
										<td class="text-center ">
											<?php echo $exp_nombre_modelo[$k2]; ?>
										</td>
										<td class="text-center ">
											<?php
													if(@$exp_turno_manama[$k2] == 1){
											 			echo '<b>Mañana</b><br>';
											 		}
											 		if(@$exp_turno_tarde[$k2] == 1){
											 			echo '<b>Tarde</b><br>';
											 		}
											 		if(@$exp_turno_noche[$k2] == 1){
											 			echo '<b>Noche</b><br>';
											 		}
											 		if(@$exp_turno_intermedio[$k2] == 1){
											 			echo '<b>Intermedio</b><br>';
											 		}
											?>
										</td>
									</tr>
                                        <?php
                                            }
                                        ?> 
                                </tbody>
                            </table>
                <?php 
                        }
                    }
                ?>
                </div>    
            </div>    
        </div>
    </div>
</div>
.<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal?><br/>
            Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php echo $empresa->direccion;?><br />               
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br/>
            <?php #pre($empresa); ?>
        </td>
    </tr>
</table>
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: -20px;">
    <div style="height: 20px;"></div>
    <div><b>Sede </b><b></b></div>
    <div style="height: 20px;"></div>
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
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr class="colorFondo">
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
                        <td class="bordeAll"><b>Room <?php echo $i; ?></b></td>
                        <?php
                            if($v->manana == 1){
                        ?>
                        <td class="center bordeAll">
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
                        <td class="center bordeAll">
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
                        <td class="center bordeAll">
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
                        <td class="center bordeAll">
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
    <div style="height: 20px;"></div>
    <div><b>Satelite </b><b></b></div>
    <div style="height: 20px;"></div>
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
?>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr class="colorFondo">
                        <th width="12%"><b>Room</b></th>
                        <th class="text-center" width="22%"><b>Modelo</b></th>
                        <th class="text-center" width="22%"><b>Turno</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
							foreach ($exp_room_transmision as $k2 => $v2) {?>
					<tr>
						<td class="bordeAll"> 
							Satelite
						</td>
						<td class="center bordeAll">
							<?php echo $exp_nombre_modelo[$k2]; ?>
						</td>
						<td class="center bordeAll">
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
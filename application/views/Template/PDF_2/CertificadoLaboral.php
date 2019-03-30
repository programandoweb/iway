<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$this->load->helper('numeros');
	setlocale(LC_ALL,"es_ES.UTF-8");
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 100px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
                <?php echo mb_strtoupper($empresa->nombre_legal)?><br />
                <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php  echo $centrodecostos->direccion; ?><br />
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br />

            </td>
        </tr>
    </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
        <tr>
            <td style="text-align:center; font-weight:bold; font-size:13px;">
                CERTIFICADO COMERCIAL
            </td>        
        </tr>
        <tr style="text-align: center; font-size:16px;">
          <td>
            <b>
                A QUIÉN INTERESE.
            </b>
          </td>
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
        <tr>
            <td colspan="2" style="text-align:justify;">
                <b><?php echo mb_strtoupper($empresa->nombre_legal)?></b> con número de identificación tributario 
                <b><?php echo mb_strtoupper($empresa->identificacion);?> - <?php echo $empresa->identificacion_ext;?>;</b> certifica qué actualmente sostiene relaciones comerciales con
                el (la) señor (a) <b><?php print mb_strtoupper( nombre($user));?></b> identificado (a) con <b style="text-transform:capitalize;"><?php print mb_strtoupper($user->tipo_identificacion );?></b> número <b><?php print_r( format($user->identificacion,false));?></b>, 
                consistente en el desarrollo de actividades de Gestión y Operación de Redes Sociales,  
                desde el día <b>
				<?php 
					//echo $user->fecha_contratacion; 
					
					echo strftime("%A %d de %B del %Y",strtotime($user->fecha_contratacion));
				?></b>.<br>
                <br/>Los siguientes dineros son pagados en una frecuencia <b><?php echo ($empresa->periodo_pagos==2)?'QUINCENAL':'SEMANAL' ?></b> 
                <?php
                    if(!empty($user->entidad_bancaria)){
                 ?> 
                a la cuenta <b><?php print_r( $user->tipo_cuenta );?></b> del banco <b><?php print_r( entidadbancaria($user->entidad_bancaria) );?></b> número <b><?php print_r( $user->nro_cuenta );?></b>.
                <?php } ?>                                
            </td>        
        </tr>
        <tr>
        	<td colspan="2"><h3 class="text-center" style="text-align:center; text-transform:uppercase;">Detalle de Ingresos</h3></td>
        </tr>
        <tr style="background-color:#f2f2f2;">
        	<td width="50%">Salario básico mensual</td>
        	<td width="50%" style="text-align:right;">
            	<b>
					<?php #echo num_to_letras(trim($user->salario_basico));?>
	                $<?php 
						$total_general	=0;
						$escala = escala($user->id_escala); 
						if(!empty($user->salario_basico)){
							echo	format($user->salario_basico,true); 
							$total_general		=	$user->salario_basico;
						}else if(!empty($escala->salario)){
							echo format($escala->salario);	
							$total_general		=	$escala->salario;
						}else{
							$total_general		=	0;
							echo '0,00';	
						}
					?>
				</b>
			</td>
        </tr>
        <?php if($user->id_escala>0){ ?>
        <tr>
        	<td width="50%">Auxilio de Transporte</td>
        	<td width="50%" style="text-align:right;">
            	<b>
					$<?php echo format($escala->auxilio_transporte,true);
						$total_general		=	$total_general+ $escala->auxilio_transporte;
					?>
				</b>
			</td>
        </tr>
        <?php }?>
        <tr style="background-color:#f2f2f2;">
        	<td width="50%">Comisiones y/o Bonificaciones(Promedio)</td>
        	<td width="50%" style="text-align:right;">
            	<b>
					$0,00
				</b>
			</td>
        </tr>
        <tr>
        	<td width="50%" style="font-weight:bold;">Total Ingresos</td>
        	<td width="50%" style="text-align:right;">
            	<b>
					$<?php echo format($total_general,true);?>
				</b>
			</td>        
        </tr>
    </table>  
    
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr>
            <td style="text-align:justify;">
               Para constancia se explide el presente documento de manera virtual y a solicitud del interesado, el día <b><?php echo strftime("%A %d de %B del %Y");?></b>, en la ciudad de <b><?php echo $centrodecostos->ciudad;?> <?php echo $centrodecostos->pais ?></b>. 			
            </td>        
      </tr>
  </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr>
            <td style="text-align:justify;">
                Cordialmente,
            </td>        
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr>
            <td style="text-align:justify;">
                <div style="width:300px; text-align:center;">
                  <?php if(!empty($empresa->firma)){ ?>
                  <img src="<?php echo DOMINIO?>images/uploads/<?php echo $empresa->firma;?>" style="width:153px;height:55px;" />
                <?php }else{ ?>
                  <div style="width:153px;height:55px;"></div>
                <?php } ?>
                </div>
                <div class="bordeBottom" style="width:300px; margin-bottom:10px;"></div>
                <div style="width:300px; text-align:left; "><?php print($empresa->nombre_representante_legal);?>  |  <?php print_r($empresa->rol_cargo);?></div>
                <div style="width:300px; text-align:left; ">CC. <?php print($empresa->nro_identificacion_representante_legal);?>  |  <?php print($empresa->ciudad_expedicion_legal);?></div>
                <div style="width:300px; text-align:left;">Representante legal, sin obligación natural</div>
                <br /><br />
                Para verificar la autenticidad del presente documento; usted puede comunicarse a la(s) línea(s)
                <?php print_r($empresa->cod_telefono.' '.$empresa->telefono);?> <?php if($empresa->cod_otro_telefono>0){?> | <?php print_r($empresa->cod_otro_telefono.' '.$empresa->otro_telefono);}?>, de Lunes a Viernes, en los horarios de 8 a.m. a 12 m y de 2 p.m. a 5:30 p.m.
            </td>        
        </tr>
    </table>
      <div class="footer bordetop" style="position: absolute; bottom:0px; width: 100%">
          <table>
              <tr>
                  <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                  <td style="text-align: center;font-size: 9px;">Página 1 / 1</td>
                  <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
              </tr>
          </table>
      </div>
</div>  
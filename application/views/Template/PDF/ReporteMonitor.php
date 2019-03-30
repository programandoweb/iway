<?php
$modulo   = $this->ModuloActivo;
$rows = $this->$modulo->result;
$ciclos_pagos = get_cf_ciclos_pagos(date("m"),$this->uri->segment(4));
$total_ultimo_dia = 0;
$total_meta = 0;
$total_meta_ideal = 0;
$asi_voy = 0;
$me_falta = 0;  
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result[0];
$registro_contable	=	getMovimientosGeneral($this->uri->segment(3),NULL,array(12,14),array("138020","111005"));
$registro_cuotas	=	getMovimientosGeneral(NULL,$this->uri->segment(3),array(12),array("138020"));
$procesador = centrodecostos($this->uri->segment(3));
$empresa = centrodecostos($row->centro_de_costos);
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
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Cuenta origen</b></div>
                  <table>
                      <tr>
                        <td>
                            <b>
                                <?php
                                    echo @nombre($procesador);
                                ?>        
                            </b>
                        </td>
                      </tr>
                      <tr>
                          <td>Documento (Id): <b><?php echo @$procesador->identificacion; ?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección: <b><?php echo @$procesador->direccion;; ?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo @$procesador->ciudad; ?></td>
                      </tr>
                      <tr>
                          <td>Teléfono: <b><?php echo (!empty($procesador->telefono)?$procesador->telefono:"N.A."); ?></b></td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td width="120">
                                Reporte Monitor: 
                             </td>
                             <td>
                                <b>
                                    <?php echo @$empresa->abreviacion.' '.tipo_documento(39,true).' '.ceros(intval($this->uri->segment(3))); ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedicion:</td>
                             <td><b><?php echo date("Y-m-d");?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo date("Y-m-d");?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
       
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td></b><?php echo $empresa->abreviacion; ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <thead>
          <tr class="colorFondo">
              <th class="center">Nombre Modelo</th>
              <th class="center">Turno</th>
              <th class="center">Escala</th>
              <th class="center">Último día</th>
              <th class="center">Meta Real</th>
              <th class="center">Meta Ideal</th>
              <th class="center">Así voy</th>
              <th class="center">Me falta</th>
              <th class="center">Cumplimiento</th>
          </tr>
      </thead>
      <tbody>
        <?php 
          foreach($rows as $k=> $v){?>
                  <tr>
                      <td class="bordeAll"><?php print(nombre($v))?></td>
                      <td class="bordeAll center">
                          <?php
                              if($v->turno_manama>0){
                                  echo "Mañana";
                              }
                              if($v->turno_tarde>0){
                                  echo "Tarde";
                              }
                              if($v->turno_noche>0){
                                  echo "Noche";
                              }
                              if($v->turno_intermedio>0){
                                  echo "Intermedio";
                              }
                              if($v->turno_manama==0 && $v->turno_tarde==0 && $v->turno_noche==0 && $v->turno_intermedio==0 ){
                                  echo "Default";
                              }
                          ?>
                      </td>
                      <td class="center bordeAll"><?php echo $v->nombre_escala;?></td>
                      <td class="center bordeAll">
                          <?php
                              $ultimo_dia = get_ultimo_dia($v->user_id)->tokens;
                              if(!empty($ultimo_dia)){
                                  $total_ultimo_dia += $ultimo_dia;
                                  echo format($ultimo_dia,false);
                              }else{
                                  echo "---";
                              } 
                          ?>
                      </td>
                      <td class="center bordeAll">
                          <?php echo format($v->meta,false); $total_meta += $v->meta; ?>
                      </td>
                      <td class="center bordeAll">
                          <?php
                              echo @format($v->meta_ideal,false);
                              $total_meta_ideal +=  $v->meta_ideal;
                          ?>
                      </td>
                      <td class="center bordeAll">
                          <?php
                              foreach($ciclos_pagos as $k1 => $v1){
                                  if($v1->fecha_desde < date("Y-m-d") && $v1->fecha_hasta > date("Y-m-d")){
                                      $total_produccion   = get_total_tokens($v->user_id,$v1->fecha_desde,$v1->fecha_hasta);
                                  }
                              }
                              if($total_produccion > 0){
                                  $asi_voy += $total_produccion;
                                  echo @format($total_produccion,false);
                              }else{
                                  echo "---";
                              }
                          ?>
                      </td>
                      <td class="center bordeAll">
                          <?php
                              echo @format(($v->meta - $total_produccion),false);
                              $me_falta += ($v->meta - $total_produccion); 
                          ?>
                      </td>
                      <td class="center bordeAll">
                          <?php 
                              if(!empty($v->meta) && !empty($total_produccion)){
                                  echo format((($total_produccion/$v->meta)*100),false);    
                              }else{
                                  echo "0";
                              } 
                          ?> %
                      </td>
                  </tr>
          <?php }?>
      </tbody>
      <tfoot>
          <tr class="colorFondo">
              <td></td>
              <td></td>
              <td></td>
              <td class="right"><?php echo format($total_ultimo_dia,false); ?></td>
              <td class="right"><?php echo format($total_meta,false); ?></td>
              <td class="right"><?php echo format($total_meta_ideal,false); ?></td>
              <td class="right"><?php echo format($asi_voy,false) ?></td>
              <td class="right"><?php echo format($me_falta,false) ?></td>
              <td></td>
          </tr>
      </tfoot>
    </table>
    <div style="height:20px; "></div>
    <div class="recuadro fondoCell bordeAll">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento, medio de pago: <b>transferencia interbancaria</b>.
                    <!--<?php echo(!empty($row->responsable_id))?" Documento elaborado por <b>".nombre(centrodecostos($row->responsable_id)).'</b>':''; ?>-->
                </td>
            </tr>
        </table>
        <div style="width: 100%;">
            <div style="height: 40px;"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="45%">
                            <div class="bordetop linea">
                                Elaboró:
                            </div>
                        </td>
                        <td width="10%"> </td>
                        <td width="45%"> 
                            <div class="bordetop linea"> 
                                Revisó:
                            </div>
                        </td>
                    </tr>
            </table> 
        </div>
    </div>   
</div>

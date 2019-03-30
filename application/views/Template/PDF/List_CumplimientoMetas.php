<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo				= 	$this->ModuloActivo;
	$periodos_de_pago	=	centrodecostos($this->user->id_empresa)->periodo_pagos;
    $empresa = centrodecostos($this->user->centro_de_costos);
    if($periodos_de_pago == 2){
        $ciclo = array(15,cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")));
    }else{
        $ciclo = array(8,15,23,cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")));
    }
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
                  <div class="colorFondo"><b>datos sucursal</b></div>
                  <table>
                      <tr>
                        <td>
                            <b>
                                <?php
                                    echo @nombre($empresa);
                                ?>        
                            </b>
                        </td>
                      </tr>
                      <tr>
                          <td>Documento (Id): <b><?php echo @$empresa->identificacion; ?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección: <b><?php echo @$empresa->direccion;; ?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo @$empresa->ciudad; ?></td>
                      </tr>
                      <tr>
                          <td>Teléfono: <b><?php echo (!empty($empresa->telefono)?$empresa->telefono:"N.A."); ?></b></td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td colspan="2">
                                <b>
                                    Resumen metas por Modelo.
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
                                    En proceso.       
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
<?php
    $td = '';
    $total = 0;
if(!empty($ciclo)){
    foreach ($ciclo as $k1 => $v1){
        $n1 = $k1+1;
        if($k1 == 0){
            $index = 1;
        }else{
            $key = $k1 - 1;
            $index = $ciclo[$key] + 1;
        }
?>
<div style="height: 20px;"></div>
<div>
    <b>
        Detalle: 
    </b>
    <b>
        <?php
            if($periodos_de_pago == 2){
                echo 'Quincena-'.$n1;
            }else{
                echo 'Semana-'.($n1);
            }
        ?>        
    </b>
</div>
<div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" >
        <thead>
            <tr class="colorFondo">
                <th>Modelo</th>
                <th>Meta ideal</th>
                <?php
                    if($v1 =="total"){
                        if($periodos_de_pago == 2){
                ?>
                <th>Quincena-1</th>
                <th>Quincena-2</th>
                <?php
                        }else{
                ?>
                <th>Semana-1</th>
                <th>Semana-2</th>
                <th>Semana-3</th>
                <th>Semana-4</th>
                <?php            
                        }
                    }else{
                ?>
                <?php  
                        for($a=$index; $a<=$v1;$a++){
                ?>
                    <th class="dias"><?php echo $a;?></th>
                <?php	
                        }
                    }
                ?>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($this->$modulo->result)){
                foreach ($this->$modulo->result as $key => $value){
            ?>
            <tr>
                <td class="bordeAll"><?php echo $value['modelo']; ?></td>
                <td class="bordeAll center"><?php echo @format($value['meta_ideal'],false); ?></td>
                <?php
                    if($v1 == 'total'){
                        echo $td;
                    }else{ 
                        for($a=$index; $a<=$v1;$a++){
                ?>
                    <th class="bordeAll center"><?php if(empty($value[$a]['tokens'])){echo 0;}else{echo format($value[$a]['tokens'],false);}?></th>
                <?php   
                        @$subtotal += $value[$a]['tokens'];
                        }
                    }
                ?>
                <td class="bordeAll right">
                    <b>
                        <?php 
                            if($v1 == "total"){
                                echo format($total,false);
                            }else{
                                echo format($subtotal,false);
                            }
                        ?>
                    </b>  
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
}
?>
    <div style="height:20px; "></div>
    <div class="recuadro fondoCell bordeAll">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento, medio de pago: <b>transferencia interbancaria</b>.
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
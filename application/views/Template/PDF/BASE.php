
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 80px;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="30%" style="text-align:center;">
                <img src="<?php echo DOMINIO?>images/uploads/<?php echo $empresa->logo;?>" style="width:153px;height:55px;" />                
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
                <?php echo $empresa->nombre_legal?><br />
                <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?>:<br />                
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br />
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table>  
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha fondoCell">    
                  <div class="colorFondo">Datos Cliente </div>
                  <b><?php echo $this->$modulo->result->nombre_cliente?></b><br/> 
                  NIT (Id): <?php print ( $this->$modulo->result->Nit )?><br>
                  Dirección: <?php $Texto=$this->$modulo->result->direccion; $direccion = wordwrap($Texto, 45, "<br />\n");
                  echo $direccion; ?><br>
                  Ciudad: <?php echo ( $this->$modulo->result->Ciudad )?><br>
                  Telefono:<br/> 
               </div>                   
            </td>        
            <td>
                <div class="recuadro fondoCell">
                    <div class="colorFondo">Datos documento</div>
                     <table>
                         <tr>
                             <td>Factura:</td>
                             <td><?php echo $this->$modulo->result->nro_documento;?></td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedicion:</td>
                             <td><?php print ( $this->$modulo->result->fecha_emision )?></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><?php echo calculo_fechas($this->$modulo->result->fecha_emision,'+5'); ?></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td></td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td><?php print_r($items[0]->abreviacion);?></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="width:100%; height:40px;"></div>
</div>    
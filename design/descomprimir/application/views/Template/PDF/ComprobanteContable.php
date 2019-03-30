<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
    $this->load->helper('numeros');
    setlocale(LC_ALL,"es_ES.UTF-8"); 
    $modulo     =   $this->ModuloActivo;
	  $row		=	$this->$modulo->result;
    $items      =   items_factura($this->uri->segment(5));
?>
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
                  <b><?php echo $this->$modulo->factura->nombre_cliente?></b><br/> 
                  NIT (Id): <?php print ( $this->$modulo->factura->Nit )?><br>
                  Dirección: <?php $Texto=$this->$modulo->factura->direccion; $direccion = wordwrap($Texto, 45, "<br />\n");
                  echo $direccion; ?><br>
                  Ciudad: <?php echo ( $this->$modulo->factura->Ciudad )?><br>
                  Telefono:<br/> 
               </div>                   
            </td>        
            <td>
                <div class="recuadro fondoCell">
                    <div class="colorFondo">Datos documento</div>
                     <table>
                         <tr>
                             <td>Comprobante:</td>
                             <td><?php echo $this->$modulo->factura->nro_documento;?></td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedicion:</td>
                             <td><?php print ( $this->$modulo->factura->fecha_emision )
                             ?>
                             </td>
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
    <div style="width:100%; height:10px;"></div>
    Detalle del comprobante:
    <div style="width:100%; height:9px;"></div>
        <table border="0" cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr width="540">
                    <td width="340">Concepto</td>
                    <td width="100">Documento</td>
                    <td width="100">Valor</td>
                </tr>
            </thead>
            <tbody>
             	<tr>
                    	<td>Cancelación / Abono Factura de Ventas</td>
                        <td  class="text-center" style="text-align:center"><?php print_r($this->$modulo->factura->nro_documento);?></td>
                        <td  class="text-right creditos" style="text-align:right" ><?php print_r($this->$modulo->factura->usd);?></td>
                    </tr>
                <tr>
                <tr>
					<td valign="top" rowspan="3" class="bordetop bordeBottom"><b>Firma y documento de identidad</b>
					<td><?php pre($items); ?></td>
                    <td>texto</td>
                    <td>texto</td>
                </tr>
                <tr>
                        </td>
                        <td class="bordetop oscurecer"><b>Total</b></td>
                        <td class="bordetop textRight oscurecer"><b><?php echo $this->$modulo->factura->total_facturado_dolar;?></b></td>
                        
                </tr>
                <tr style="height: 20px">
                        <td style="height: 20px;border:0;"></td>
                        <td style="height: 20px;border:0;"></td>
                </tr>
                <tr style="height: 20px">
                        <td style="height: 20px;border:0;"></td>
                        <td style="height: 20px;border:0;"></td>
                </tr>
            </tbody>
        </table>
    <div style="width:100%; height:10px;"></div>
    <div class="bordeBottom" style="text-align: center;"><b>Valor en letras: <?php echo strtolower(num_to_letras($this->$modulo->factura->total_facturado_dolar,'','dólares'))?> </b></div>
    <div style="width:100%; height:40px;"></div>
    Registro contable:
    <div style="width:100%; height:9px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr width="540">
                <td width="108">Cuenta</td>
                <td width="216">Descripción</td>
                <td width="108">Débito</td>
                <td width="108">Crédito</td>
            </tr>
        </thead>
        <tbody>
       			<?php 
					$debito		=	0;
					$credito	=	0;
					foreach($row as $v){
				?>   
                        <tr>
                            <td  class="bordeBottom" style="text-align:center;"><?php print_r($v->codigo_contable);?></td>
                            <td  class="bordeBottom" style="text-align:center"><?php print(get_codigo_contable($v->codigo_contable)->cuenta_contable);?></td>
                            <td  class="bordeBottom" style="text-align:right"><?php print($v->debito);?></td>
                            <td  class="bordeBottom" style="text-align:right"><?php print($v->credito);?></td>
                        </tr>
				<?php
					}
				?>   
        </tbody>
    </table>
    <div style="width:100%; height:40px;"></div>
    Detalle de ingreso:
    <div style="width:100%; height:9px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr width="540">
                <td width="432">Procesador de pago</td>
                <td width="108">Valor</td>
            </tr>
        </thead>
        <tbody>
           <?php 
				$debito		=	0;
				$credito	=	0;
				foreach($row as $v){
					if($v->credito>0){
			?>                       
						<tr>
							<td  class="bordeBottom">
								<?php 
									echo entidad_bancaria($v);

								?>
							</td>
							<td class="bordeBottom text-right">
								<?php
										$credito +=$v->credito;
										print(format($v->credito,true));
								?>
							</td>
						</tr>
			<?php }
				}
			?>
        </tbody>
    </table>
</div>
<div class="firmas" style="position:absolute;bottom:150px;width: 100%;">
                    <table class="ancho" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <div class="bordetop linea">
                                        Aprobado.
                                    </div>
                                </td>
                                <td>
                                    <div class="bordetop linea">
                                       Revisado. 
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top:15px;">
                                    Esta factura se asimila en todos sus efectos a una letra de cambio, de conformidad con el articulo 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por concepto de mora. 
                                </td>
                            </tr>
                    </table> 
                 </div>

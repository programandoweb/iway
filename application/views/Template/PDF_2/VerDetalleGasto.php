<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	if($this->user->type=='Modelos'){
		return;	
	}
	$row		=	$this->$modulo->result;
    $OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
        $reg=count($row);
        $num=$reg/12;
        $Pag=ceil($num)-1;
        $numPag=0;           
        for($i=0;$i<=$Pag;$i++){
        $numPag++; 
		$proveedor	=	json_decode($row[0]->json);		
		//pre($proveedor->direccion);
?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 100px;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table> 
    <div style="height: 30px;"></div>
    <table  border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead class="bordeAll">
            <tr class="colorFondo">
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>ID Proveedor</th>
                <th>Dirección</th>
                <th>Ciclo de producción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bordeAll">
                	<?php 
						if(!empty($proveedor->nombre_legal)){
							echo $proveedor->nombre_legal;
						}else{
							echo $proveedor->nombre_legal;
						}
                    ?>        
                </td>
                <td class="bordeAll" style="text-align:center;"><?php echo $row[0]->fecha;?></td>
                <td class="bordeAll" style="text-align:center;"><?php echo $row[0]->Nit;?></td>
                <td class="bordeAll" style="text-align:center;">
                	<?php 
						if(!empty($proveedor->direccion)){
							echo $proveedor->direccion;
						}else{
							echo $row[0]->Direccion;
						}
                    ?>        
                </td>
                <td class="bordeAll" style="text-align:center;"><?php echo $row[0]->ciclo_de_produccion?></td>
            </tr>
        </tbody>
    </table>
	<div style=" width:100%; height:20px;"></div>
     <div>
        <b>Detalle de Ingreso</b> 
     </div>
        <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
            <thead class="bordeAll">
                <tr class="colorFondo">
                    <th class="text-left">Concepto</th>
                    <th width="100" class="text-center">Documento</th>
                    <th width="100" class="text-right">Crédito</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(count($this->$modulo->result)>0){
                        
                        $debito=0;
                        $credito=0;
                        foreach($this->$modulo->result as $v){
							if(!empty($v->tipo_documento)){
                ?>
                                <tr>
                                    <td class="bordeAll">
										<?php 
                                            print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                                        ?>
										<?php 
											//echo tipo_documento($v->tipo_documento); 
										?>
									</td>
                                    <td class="bordeAll" style="text-align:center;">
                                        <?php echo $v->consecutivo ?>
                                    </td>
                                    <td class="bordeAll" style="text-align:right;"><?php echo format($v->debito_COP,false);$debito+= $v->debito_COP; ?></td>
                                </tr>
                <?php
							}
                    	}
                	}else{ 
                 ?>
                 
                 <?php 
                    }
                 ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right"></th>
                    <th class="colorFondo">Total:</th>
                    <th class="colorFondo" style="text-align:right;"><?php echo format(@$debito,false); ?></th>
                </tr>
            </tfoot>
        </table>
        <div style=" width:100%; height:20px;"></div> 
        <div>
            <b>Registro Contable</b>
        </div> 
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead class="bordeAll">
            <tr class="colorFondo">
                <th width="100"><b>Cuenta</b></th>
                <th><b>Concepto Contable</b></th>
                <th width="100" class="text-center"><b>Débito</b></th>
                <th width="100" class="text-center"><b>Crédito</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $debito		=	0;
                $credito	=	0;
                $items		=	items_factura_contable($this->uri->segment(3),array(),array("tipo_documento"=>8));
                foreach($this->$modulo->result['registro_contable'] as $k=>$v){
            ?>                       
                <tr>
                    <td class="bordeAll">
                        <?php
                            print($v->codigo_contable);
                        ?>
                    </td>
                    <td class="bordeAll">
                        <?php 
                            print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                        ?>
                    </td>
                    <td class="bordeAll" style="text-align:right;">
                        <?php
                                $debito +=	@$v->debito;
                                print(format(@$v->debito,true));
                        ?>
                    </td>
                    <td class="bordeAll" style="text-align:right;">
                        <?php
                                $credito +=$v->credito;
                                print(format($v->credito,true));
                        ?>
                    </td>
                </tr>
            <?php }?>
        </tbody>                      
    </table>  
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table" style="margin-top: 20px;">
        <thead>
            <tr class="colorFondo">
                <th>Nombre</th>
                <th>Observacion</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach (Observaciones($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'#observacion') as $key => $value) {
            ?>
            <tr>
                <td class="bordeBottom">
                    <?php echo nombre($value); ?>
                </td>
                <td class="bordeBottom">
                    <?php echo $value->observacion; ?>
                </td>
                <td class="bordeBottom" style="text-align: right;">
                    <?php echo $value->fecha; ?>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table> 
</div>
<div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página <?php echo $numPag.' / '.($Pag+1); ?></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div><?php } ?>
<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
	$modulo		=	$this->ModuloActivo;
	$row		=	$this->$modulo->result;
?>

<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-12">
		            <?php echo submenu('Datos del Cliente','Comprobante de Ingresos','xl');?>
                </div>
            </div>
       	 	<div class="row">
            	<div class="col-md-2">
		           Cliente
                </div>
                <div class="col-md-4">
                    <b>
	                    <?php 
							echo $this->$modulo->factura->nombre_cliente;
						?>
                    </b>
                </div>
                <div class="col-md-2">
                	Fecha<br />
		         	ID Cliente
                </div>
                <div class="col-md-4 text-right">
                	 <b><?php echo $row[0]->fecha;?>
                	<br />
                   
	                    <?php echo $this->$modulo->factura->identificacion_empresa;?>
                    </b>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-2">
		           Dirección
                </div>
                <div class="col-md-4">
                    <b>
	                    <?php echo str_replace($this->$modulo->factura->pais,"",$this->$modulo->factura->direccion)?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Ciclo de producción
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php echo $this->$modulo->factura->ciclo_de_produccion?>
                   	</b>
                </div>
            </div>
		</div>
	</div> 
    <div style=" width:100%; height:20px;"></div>
        <ul class="nav nav-tabs" role="tablist">
             <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#Detalle" role="tab" style="margin:0px,padding:0px">
                        Detalle de Ingreso 
                    </a>
             </li>
             <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#registro" role="tab">
                        Registro Contable
                    </a>
             </li>
             <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#ProcesadorPago" role="tab">
                        Procesador de Pago
                     </a>
             </li>
        </ul>





	 
    <div class="tab-content col-md-12">
    <div id="Detalle" class="tab-pane active row justify-content-md-center" role="tabpanel">
    	<div class="col-md-12">
        	<table class="table table-hover">
                <thead>
                    <tr>
                        <td ><b>Concepto</b></td>
                        <td width="100" class="text-center"><b>Documento</b></td>
                        <td width="100" class="text-center"><b>Valor</b></td>
                    </tr>
                </thead>
                <tbody>
					<tr>
                    	<td>Cancelación / Abono Factura de Ventas</td>
                        <td  class="text-center"><?php print_r($this->$modulo->factura->nro_documento);?></td>
                        <td  class="text-right creditos" ><?php print_r($this->$modulo->factura);?></td>
                    </tr>                   
                </tbody>  
            </table> 
        </div>    
    </div> 

    <div class="tab-pane row justify-content-md-center" role="tabpanel" id="registro">
    	<div class="col-md-12">
        	<table class="tablesorter table table-hover">
                <thead>
                    <tr>
                        <td width="100"><b>Cuenta</b></td>
                        <td><b>Concepto Contable</b></td>
                        <td width="100" class="text-center"><b>Débito</b></td>
                        <td width="100" class="text-center"><b>Crédito</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $debito		=	0;
                        $credito	=	0;
						foreach($row as $v){
					?>                       
                        <tr>
                            <td>
								<?php
                            		print($v->codigo_contable);
								?>
                            </td>
                            <td>
								<?php 
	                                print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                                ?>
                                <?php 
									
									//echo entidad_bancaria($v);
                                ?>
                            </td>
                            <td class="text-center">
								<?php
										$debito +=$v->debito;
                                        print(format($v->debito,true));
                                ?>
                            </td>
                            <td  class="text-right">
                           	 	<?php
										$credito +=$v->credito;
                                        print(format($v->credito,true));
                                ?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>  
                <!--tfoot>
                	<tr>
                    	<td></td>
						<td class="text-right"><b>Total:</b></td>
                        <td class="text-right"><?php echo format($debito,true);?></td>
                        <td class="text-right"><?php echo format($credito,true);?>
                        	
                        </td>
                    </tr>
                </tfoot-->  
                <input type="hidden" id="credito" value="<?php echo format($credito,true);?>" />                    
            </table> 
        </div>    
    </div>
    <div class="tab-pane row justify-content-md-center" role="tabpanel" id="ProcesadorPago">
    	<div class="col-md-12">
        	<table class="table table-hover">
                <thead>
                    <tr>
                        <td><b>Procesador de Pago</b></td>
                        <td width="100" class="text-center"><b>Valor</b></td>
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
                                    <td>
        								<?php
                                    		print($v->codigo_contable);
        								?>
                                    </td>
                                    <td>
        								<?php 
        	                                print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                                        ?>
                                        <?php 
        									
        									//echo entidad_bancaria($v);
                                        ?>
                                    </td>
                                    <td class="text-center">
        								<?php
        										$debito +=$v->debito;
                                                print(format($v->debito,true));
                                        ?>
                                    </td>
                                    <td  class="text-right">
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
                        <!--tfoot>
                        	<tr>
                            	<td></td>
        						<td class="text-right"><b>Total:</b></td>
                                <td class="text-right"><?php echo format($debito,true);?></td>
                                <td class="text-right"><?php echo format($credito,true);?>
                                	
                                </td>
                            </tr>
                        </tfoot-->  
                        <input type="hidden" id="credito" value="<?php echo format($credito,true);?>" />                    
                    </table> 
            </div>  
            <div class="row justify-content-md-center">
            	<div class="col-md-12">
                	<table class="table table-hover">
                        <thead>
                            <tr>
                                <td><b>Procesador de Pago</b></td>
                                <td width="100" class="text-center"><b>Valor</b></td>
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
                                            <td>
                                                <?php 
                                                    echo entidad_bancaria($v);
                
                                                ?>
                                            </td>
                                            <td class="text-right">
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
                        <!--tfoot>
                        	<tr>
        						<td class="text-right"><b>Total:</b></td>
                                <td class="text-right"><?php echo format($credito,true);?>
                                	<input type="hidden" id="credito" value="<?php echo format($credito,true);?>" />
                                </td>
                            </tr>
                        </tfoot-->                      
                    </table> 
                </div>    
            </div>
        </div>
    </div>
  </div> 
</div>
<script>
	$(document).ready(function(){
		$(".creditos").html($("#credito").val());
		$(".recibir").remove();
	});
</script>
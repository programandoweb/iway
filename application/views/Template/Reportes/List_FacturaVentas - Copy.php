<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	$pendiente	=	$this->$modulo->result['pendiente'];
	$pagadas	=	$this->$modulo->result['pagadas'];
	$anuladas	=	$this->$modulo->result['anuladas'];	
?>


<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array( "name"		=>	array(	"title"	=>	"Facturas de Ventas",
															"url"	=>	current_url()),
									"import"	=>	array(	"title"	=>	"Importar Datos",
															"url"	=>	base_url("Reportes/InformePlano")),
									"check"		=>	array(	"title"	=>	"Verificar Datos",
															"url"	=>	base_url("Reportes/ResultadoImport/Debug/2")),																															
									"add"		=>	array(	"title"	=>	"Factura Manual",
															"url"	=>	base_url("Reportes/Add_Factura"),
															"lightbox"=>true),
									"impresion"	=>	true,
                                    "excel"     =>  true,
                                    "mail"      =>  true,

									"config"	=>	array(	"title"	=>	"Personalización",
															"icono"	=>	'<i class="fas fa-cogs"></i>',
															"url"	=>	base_url("Configuracion/OpcionesFactura"),
															"lightbox"=>true),
							)
						);
			?>
		
			<div class="section" id="imprimeme">
				<ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                    	<a class="nav-link active" data-toggle="tab" href="#pendientes" role="tab" style="margin:0px,padding:0px">
                    		<i class="fas fa-angle-right"></i> Pendientes 
                    	</a>
                    </li>
			  		<li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#pagadas" role="tab">
                           <i class="fas fa-angle-right"></i>  Pagadas 
                        </a>
			  		</li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#anuladas" role="tab">
                           <i class="fas fa-angle-right"></i>  Anuladas
                        </a>
			  		</li>
				</ul>		
				<!--/UL-->
				<div class="tab-content row">
                    <!-- Pendientes-->
                    <div class="tab-pane active col-md-12" id="pendientes" role="tabpanel">
                        <?php
                            $count			=	0;
                            $ciclo			=	$this->$modulo->fields;
                            $suma_token			=	0;
                            $suma_equivalencia	=	0;
                        ?>
                        <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=3 order="desc">
                            <thead>
                                <tr>
                                    <th class="text-center"><b>Fecha</b></th>
                                    <th class="text-left"><b>Tercero</b></th>
                                    <th class="text-center"><b>Sucursal</b></th>
                                    <th width="150" class="text-center"><b>Documento</b></th>
                                    <th width="100" class="text-right"><b>Total(USD)</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$sum_total=0;
									$sum_total_pendiente=0;
                                    if(count($pendiente)>0){
                                        foreach($pendiente as $v){
                                ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php //pre($v);?>
                                                    <?php print_r($v->fecha);?>	                                           
                                                </td>
                                                <td class="text-left">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                        <?php print($v->nombre_cliente);?>	                                           
                                                    </a>                                                  
                                                </td>
                                                <td class="text-center">
	                                                <?php print($v->abreviacion);?>	                                           
                                                </td>
                                                <td class="text-center">
                                                    <a class="btnss btn-primaryss btn-mdss documentos" title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                      <?php print_r($v->consecutivo);?>
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                    	<?php 
															$sum_total	+=	$v->total;
															print(format($v->total,true));?>
                                                    </a>
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
                            <tfoot>
                            	<th></th>
                                <th></th>
                                <th></th>
                                <th class="text-right">Total</th>
                                <th class="text-right"><?php echo format($sum_total,true);?></th>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /Pendientes-->
                    <!-- Pagadas-->
                    <div class="col-md-12 tab-pane" id="pagadas" role="tabpanel">
                        <?php
                            $count			=	0;
                            $ciclo			=	$this->$modulo->fields;
                            $suma_token			=	0;
                            $suma_equivalencia	=	0;
                        ?>
                        <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                            <thead>
                                <tr>
                                    <th class="text-center"><b>Fecha</b></th>
                                    <th class="text-left"><b>Tercero</b></th>
                                    <th class="text-center"><b>Sucursal</b></th>
                                    <th width="50" class="text-center"><b>Documento</b></th>
                                    <th width="50" class="text-right"><b>Total(USD)</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$sum_total=0;
                                    if(count($pagadas)>0){
                                        foreach($pagadas as $v){
											
                                ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php //pre($v);?>
                                                    <?php print_r($v->fecha);?>	                                           
                                                </td>
                                                <td class="text-left">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                        <?php print($v->nombre_cliente);?>	                                           
                                                    </a>                                                  
                                                </td>
                                                <td class="text-center">
	                                                <?php print($v->abreviacion);?>	                                           
                                                </td>
                                                <td class="text-center">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                      <?php print_r($v->consecutivo);?>
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btnss btn-primaryss btn-mdss" title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                    	<?php 
															$sum_total	+=	$v->total;
															print(format($v->total,true));?>
                                                    </a>
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
                            <tfoot>
                            	<th></th>
                                <th></th>
                                <th></th>
                                <th class="text-right">Total</th>
                                <th class="text-right"><?php echo format($sum_total,true);?></th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-12 tab-pane" id="anuladas" role="tabpanel">
                        <?php
                            $count			=	0;
                            $ciclo			=	$this->$modulo->fields;
                            $suma_token			=	0;
                            $suma_equivalencia	=	0;
                        ?>
                        <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                            <thead>
                                <tr>
                                    <th class="text-center"><b>Fecha</b></th>
                                    <th class="text-left"><b>Tercero</b></th>
                                    <th class="text-center"><b>Sucursal</b></th>
                                    <th width="50" class="text-center"><b>Documento</b></th>
                                    <th width="50" class="text-right"><b>Total(USD)</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$sum_total=0;
                                    if(count($anuladas)>0){
                                        foreach($anuladas as $v){
											
                                ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php //pre($v);?>
                                                    <?php print_r($v->fecha);?>	                                           
                                                </td>
                                                <td class="text-left">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                        <?php print($v->nombre_cliente);?>	                                           
                                                    </a>                                                  
                                                </td>
                                                <td class="text-center">
	                                                <?php print($v->abreviacion);?>	                                           
                                                </td>
                                                <td class="text-center">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                      <?php print_r($v->consecutivo);?>
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btnss btn-primaryss btn-mdss" title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo)?>"> 
                                                    	<?php 
															$sum_total	+=	$v->total;
															print(format($v->total,true));?>
                                                    </a>
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
                            <tfoot>
                            	<th></th>
                                <th></th>
                                <th></th>
                                <th class="text-right">Total</th>
                                <th class="text-right"><?php echo format($sum_total,true);?></th>
                            </tfoot>
                        </table>
                    </div>
               	</div>
            </div>
        </div>
    </div>
</div>

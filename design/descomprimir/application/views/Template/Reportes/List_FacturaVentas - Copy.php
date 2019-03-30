<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	$activos	=	array();
	$inactivos	=	array();
	foreach($this->$modulo->result as $v){
		$recalculo_factura	=	recalculo_factura($v->id_empresa,$v->nro_documento);
		if($recalculo_factura->total_facturado_dolar < $v->total_facturado_dolar){
			//pre( $recalculo_factura->total_facturado_dolar .' - - - - '. $v->total_facturado_dolar);
			$activos[]	=	$v;
		}else{
			//pre( $recalculo_factura->total_facturado_dolar .' - - - - '. $v->total_facturado_dolar);
			$inactivos[]	=	$v;
		}
	}
?>

<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">Facturas de Ventas.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-primary btn-md lightbox" title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/Add_Factura")?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
                    <a class="btn btn-primary btn-md" title="Aprobar facturas de Venta" href="<?php echo base_url("Reportes/ResultadoImport/Debug/4")?>"><i class="fa fa-plus" aria-hidden="true"></i> Aprobar Facturas</a>
                    <a class="btn btn-primary btn-md " href="<?php echo base_url();?>">
                    	<i class="fa fa-chevron-left" aria-hidden="true"></i> 
                        Volver
					</a>
                </div>
            </div>  
		<!--UL-->
		<div class="section">
				<ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                    	<a class="nav-link active" data-toggle="tab" href="#pendientes" role="tab" style="margin:0px,padding:0px">
                    		Pendientes 
                    	</a>
                    </li>
			  		<li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#pagadas" role="tab">
                            Pagadas 
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
                        <table class="ordenar display table table-hover">
                            <thead>
                                <tr>
                                    <td class="text-center"><b>Fecha</b></td>
                                    <td class="text-center"><b>Tercero</b></td>
                                    <td class="text-center"><b>Documento</b></td>
                                    <td width="220" class="text-right"><b>Total(USD)</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($activos)>0){
                                        foreach($activos as $v){
                                ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php #pre($v);?>
                                                    <?php print_r($v->fecha_emision);?>	                                           
                                                </td>
                                                <td class="text-left">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->nro_documento)?>"> 
                                                        <?php print_r($v->nombre_cliente);?>	                                           
                                                    </a>                                                  
                                                </td>
                                                <td class="text-center">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->nro_documento)?>"> 
                                                      <?php print_r($v->nro_documento);?>
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btnss btn-primaryss btn-mdss" title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->nro_documento)?>"> 
                                                    <?php echo format($v->total_facturado_dolar);?>
                                                    </a>
                                                </td>
                                            </tr>
                                <?php		
                                        }
                                    }else{
                                ?>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No hay registros disponibles
                                        </td>
                                    </tr>
                                <?php		
                                    }
                                ?>
                            </tbody>
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
                        <table class="ordenar display table table-hover">
                            <thead>
                                <tr>
                                    <td class="text-center"><b>Fecha</b></td>
                                    <td class="text-center"><b>Tercero</b></td>
                                    <td class="text-center"><b>Documento</b></td>
                                    <td width="220" class="text-center"><b>Total(USD)</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($inactivos)>0){
                                        foreach($inactivos as $v){
                                ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php print_r($v->fecha_emision);?>	                                           
                                                </td>
                                                <td class="text-left">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->nro_documento)?>"> 
                                                        <?php print_r($v->nombre_cliente);?>	                                           
                                                    </a>                                                  
                                                </td>
                                                <td class="text-center">
                                                    <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->nro_documento)?>"> 
                                                      <?php print_r($v->nro_documento);?>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btnss btn-primaryss btn-mdss" title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->nro_documento)?>"> 
                                                    <?php echo format($v->total_facturado_dolar);?>
                                                    </a>
                                                </td>
                                            </tr>
                                <?php		
                                        }
                                    }else{
                                ?>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No hay registros disponibles
                                        </td>
                                    </tr>
                                <?php		
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
               	</div>
            </div>
        </div>
    </div>
</div>

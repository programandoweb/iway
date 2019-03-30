<?php
/*	
	Agregar
	<i class="fa fa-plus" aria-hidden="true"></i>
	Ver
	<i class="fa fa-search" aria-hidden="true"></i>
	Editar
	<i class="fas fa-edit" aria-hidden="true"></i>
*/?>
<?php  
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result[0];
$proveedor  = centrodecostos($row->user_id);
$codigo_contable = array();
foreach ($this->$modulo->result as $key => $value) {
    $codigo_contable[] = $value->codigo_contable;
}
$registro_contable	=	getMovimientosGeneral($this->uri->segment(3),NULL,array(12,14),array("138020","111005"));
$registro_cuotas	=	getMovimientosGeneral($this->uri->segment(3),NULL,array(13),$codigo_contable,NULL,$row->user_id);

if(@$row->estatus == 9){
?>
<div class="container text-center">
    <h2 class="font-weight-700 text-uppercase orange">ANULADA</h2>
</div>
<?php
    }
?>
<div class="container">
    <?php 
        $submenu = array("name"       =>  array(  "title" =>  "Detalle descuento",
                                                    "url"   =>  current_url()),
                            "back"      =>  ($this->uri->segment(4)=='iframe' || $this->uri->segment(5)=='iframe')?true:false,
                            "pdf"       =>  array("title"=> "PDF",
                                                  "url"  => current_url().'/PDF'),
                            "config"    =>  array("title" =>  "Anular Descuento",
                                                  "icono"  =>  '<i class="fas fa-trash"></i>',
                                                  "url"   =>  base_url("Usuarios/AnularDescuentos/".$this->uri->segment(3))));
        if(!empty($registro_cuotas)){
            unset($submenu['config']);
        }
        echo TaskBar($submenu);
    ?>
	<div class="section">
            <div class="row">
                <div class="col-md-2">
                   Tercero<BR /> ID Tercero
                </div>
                <div class="col-md-4">
                    <b>
                        <?php 
                            echo nombre($proveedor);
                        ?>
                        <br />
                        <?php echo $proveedor->identificacion;?>
                    </b>
                </div>
                <div class="col-md-2">
                    Fecha Expedición<br />
                    Fecha Vencimiento                   
                </div>
                <div class="col-md-4 text-right">
                     <b>
                     <?php 
                        /*DAVID MANDÓ A CAMBIAR*/
                        echo $row->fecha;
                     ?>
                    <br />
                    <?php
                        echo $row->fecha;
                    ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                   Dirección
                </div>
                <div class="col-md-4">
                    <b>
                        <?php 
                            echo $proveedor->direccion; //str_replace($row[0]->Pais,"",$row[0]->Direccion)
                        ?>
                    </b>
                </div>
                <div class="col-md-3 ">
                   Ciclo de producción
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php echo $row->ciclo_produccion_id?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Cuotas
                </div>
                <div class="col-md-4">
                    <b>
                        <?php 
                            echo $row->nro_quincenas; //str_replace($row[0]->Pais,"",$row[0]->Direccion)
                        ?>
                    </b>
                </div>
            </div>
	</div>        
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="sections">           
                <div class="row">
                    <div class="col-md-12">
                        <div class="bd-example bd-example-tabs" role="tabpanel">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pagos" role="tab" aria-controls="home" aria-expanded="false">Pagos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#registrocontable" role="tab" aria-controls="home" aria-expanded="false">Registro Contables</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="home-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="home" aria-expanded="false">Observaciones</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
								<div role="tabpanel" class="tab-pane fade" id="registrocontable" aria-labelledby="home-tab" aria-expanded="false">
                                	<table class="tablesorter table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="100"><b>Cuenta</b></th>
                                                <th><b>Descripción</b></th>
                                                <th width="100" class="text-center"><b>Débito</b></th>
                                                <th width="100" class="text-center"><b>Crédito</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $debito		=	0;
                                                $credito	=	0;
												
												
                                               	foreach($this->$modulo->result as $k => $v){?>
                                            <tr>
                                                <td><?php print_r($v->codigo_contable);?></td>
                                                <td><?php echo get_codigo_contable($v->codigo_contable)->cuenta_contable;?></td>
                                                <td class="text-right">
                                                    <?php 
                                                            //pre($v);
                                                           $debito	=	$debito 	+ 	round($v->debito,2); 	
                                                           print_r(format($v->debito));
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 	
                                                            $credito	=	$credito 	+ 	round($v->credito,2); 	
                                                            print_r(format($v->credito));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody> 
                                        <tfoot>
                                            <tr>
                                                <th width="100"></th>
                                                <th><b>Sumas Iguales</b></th>
                                                <th width="100" class="text-right"><b><?php echo format(($debito),true); ?></b></th>
                                                <th width="100" class="text-right"><b><?php echo @format($credito,true); ?></b></th>
                                            </tr>
                                        </tfoot>                        
                                    </table>  
                                </div>
                                <div role="tabpanel" class="tab-pane fade " id="observaciones" aria-labelledby="home-tab" aria-expanded="false">
                                    <div class="col-md-12">
                                    	<div style=" width:100%; height:20px;"></div>
										<?php 
                                        	HtmlObservaciones();
                                        ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade active show" id="pagos" aria-labelledby="home-tab" aria-expanded="false">
                                	<table class="tablesorter table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="100"><b>Cuenta</b></th>
                                                <th><b>Descripción</b></th>
                                                <th width="100" class="text-center"><b>Documento</b></th>
                                                <th width="100" class="text-center"><b>Total</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $debito		=	0;
                                                $descuento_pagos	=	0;
												
												
                                               	foreach($registro_cuotas as $k => $v){?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                            print($v->fecha);
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            print(tipo_documento($v->tipo_documento));
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="documentos" title="Detalle Honorario?>" href="<?php echo base_url("Usuarios/HonorariosModeloAprobados/".$v->user_id."/".$v->documento."/".$v->estatus.'/Iframedes')?>">
                                                            <?php
                                                                echo $v->consecutivo;
                                                            ?>
                                                        </a>
                                                    </td>
                                                    <td  class="text-right">
                                                        <?php
                                                                $descuento_pagos +=$v->credito;
                                                                print(format($v->credito,true));
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                                <tfoot>
                                                    <tr>
                                                        <th width="100"></th>
                                                        <th><b>Saldo pendiente</b></th>
                                                        <th width="100" class="text-right"></th>
                                                        <th width="100" class="text-right"><b><?php echo @format(($row->debito - $descuento_pagos),true); ?></b></th>
                                                    </tr>
                                                </tfoot>
                                        </tbody>                        
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>                                                                                                                                            
		</div>            
    </div>
</div>

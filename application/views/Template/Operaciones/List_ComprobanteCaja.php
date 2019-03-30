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
    $row        =   $this->$modulo->result;
    $json      =   @json_decode($row[0]->json);
?>
<div class="container">
   <div class="row justify-content-md-center">
        <?php
            if(@$row[0]->estatus == 9){
        ?>
        <div class="container text-center">
            <h2 class="font-weight-700 text-uppercase orange">ANULADA</h2>
        </div>
        <?php
            }
        ?>
        <div class="col">
            <div class="row filters">
                <div class="col-md-12">
        <?php   
           $submenu = array("name"       =>  array(  "title" =>  "Comprobante de caja",
                                                                  "url"   =>  current_url()),
                            "back"      =>  ($this->uri->segment(4)=='iframe' || $this->uri->segment(5)=='iframe')?true:false,
                            "anular"    =>  array(  "title" =>  "Anular Transferencia",
                                                                "confirm"=>true,
                                                                "url"   =>  base_url("Operaciones/AnularComprobanteCaja/".@$row[0]->consecutivo.'/'.@$row[0]->tipo_documento.'/'.@$json->id_caja_origen.'-'.@$row[0]->codigo_contable),
                                                                "icono" =>  '<i class="fas fa-trash-alt"></i>'),
                            "pdf"       =>   array(  "url"   => $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/PDF'),         
                                    );
           if($row[0]->estatus == 9){
                unset($submenu['anular']);
           }
                        echo TaskBar($submenu);
        ?> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                   Caja de origen<BR/> Caja de destino
                </div>
                <div class="col-md-4">
                    <b>
                        <?php 
                            echo getCaja($json->id_caja_origen);
                        ?>
                        <br />
                        <?php echo getCaja($json->id_caja_destino);?>
                    </b>
                </div>
                <div class="col-md-3">
                    Comprobante de caja: <br />
                    Fecha Expedición                   
                </div>
                <div class="col-md-3 text-right">
                        <?php echo @$row[0]->abreviacion.' '.@tipo_documento($row[0]->tipo_documento,true).' '.@ceros($row[0]->consecutivo); ?>
                    <br />
                    <?php
                        echo @$row[0]->fecha;
                    ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-6">
                   Ciclo de producción
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php echo @$row[0]->ciclo_de_produccion?>
                    </b>
                </div>
            </div>
        </div>
    </div>
    <div style=" width:100%; height:20px;"></div>
	<div class="bd-example bd-example-tabs" role="tabpanel">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Detalle" role="tab" style="margin:0px,padding:0px">
                    Detalle
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#registro" role="tab">
                    Registro Contable
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">Observaciones</a>
            </li>
        </ul>
        <div class="tab-content col-md-12 ">
            <div id="Detalle" class="tab-pane active row justify-content-md-center" role="tabpanel">
                <div class="col-md-12">
                    <table class="tablesorter table table-hover">
                        <thead>
                            <tr>
                                <th ><b>Concepto</b></th>
                                <?php
                                    if(@$row[0]->tipo_documento == 18){
                                ?>
                                <th class="text-center"><b>Caja</b></th>
                                <?php
                                    }else{
                                ?>
                                <th class="text-center"><b>Caja</b></th>
                                <?php
                                    }
                                ?>
                                <th width="100" class="text-center"><b>Documento</b></th>
                                <th width="100" class="text-center"><b>Monto</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sum	=	0;
                                //pre($this->$modulo->result);
                            ?>
                                <tr>
                                    <td>
                                        Traslado de dinero en efectivo entre cajas.
                                    </td>
                                    <td class="text-center">
                                    <?php
                                        echo getCaja($json->id_caja_origen);
                                    ?>
                                    </td>
                                    <td  class="text-center">
                                            <?php echo $this->uri->segment(3);?>
                                    </td>
                                    <td  class="text-right creditos" >
                                        <?php echo format($json->monto,true);?>
                                    </td>
                                </tr>                   
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th class="text-center">Total</th>
                            <th class="text-right"><?php echo format($json->monto,true);?></th>
                        </tfoot>  
                    </table> 
                </div>    
            </div> 
            <div class="tab-pane row justify-content-md-center" role="tabpanel" id="registro">
                <div class="col-md-12">
                    <table class="tablesorter table table-hover">
                        <thead>
                            <tr>
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
                                $sum1		=		$sum2		=	0;
                                foreach($row as $k=>$v){
                                    
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
                                    </td>
                                    <td class="text-right">
                                        <?php
                                                $debito +=	@$v->debito;
                                                print(format(@$v->debito,true));
                                                $sum1	+=	@$v->debito;
                                        ?>
                                    </td>
                                    <td  class="text-right">
                                        <?php
                                                $credito +=$v->credito;
                                                print(format($v->credito,true));
                                                $sum2	+=	@$v->credito;
                                        ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody> 
                        <tfoot>
                            <th></th>                            
                            <th class="text-center">Sumas iguales</th>
                            <th class="text-right"><?php echo format($sum1,true);?></th>
                            <th class="text-right"><?php echo format($sum2,true);?></th>
                        </tfoot> 
                        <input type="hidden" id="credito" value="<?php echo format($credito,true);?>" />                    
                    </table> 
                </div>    
            </div>
            <div class="tab-pane fade" id="observaciones" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
                <div class="col-md-12">
                    <div style=" width:100%; height:20px;"></div>
                    <?php 
                        HtmlObservaciones();
                    ?>
                </div>
            </div>
		</div>                
	</div>
</div>
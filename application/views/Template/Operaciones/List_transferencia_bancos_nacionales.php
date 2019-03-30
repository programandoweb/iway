<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
	$modulo		=	$this->ModuloActivo;
    if(is_numeric($this->uri->segment(4))){
        $row = array();
        foreach ($this->$modulo->result as $key => $value){
            if($value->consecutivo == $this->uri->segment(4)){
                $row[] = $value;
            } 
        }
    }else{
            $row        =   $this->$modulo->result;
    }
    $json2      =   @json_decode($row[0]->json);
    if(@$row[0]->tipo_documento == 18){
        $caja_id = explode("/-/",$json2->caja_id);
        $nombre_caja = getCaja($caja_id[0]);
    }
    $banco      =   @explode("/-/",$json2->Banco_destino);   
    $detalle    =   detalle_contable($this->uri->segment(3),array(),array("8"));
    $json       =   @json_decode($detalle[0]->json);
    $proveedor =   @centrodecostos($json->cliente_id);
    @$empresa    =   centrodecostos($json->centro_de_costos);
    $debito = 0;
    $credito = 0;
    foreach ($row as $key => $value) {
        if($value->codigo_contable =="111005"){
            $debito +=  $value->debito;
            $credito +=  $value->credito;
        }
    }
    $saldo = $credito - $debito;
?>
<div class="container">
   <div class="row justify-content-md-center">
        <div class="col">
            <div class="row filters">
                <div class="col-md-12">
        <?php   
           $submenu = array("name"       =>  array(  "title" =>  "Cancelacion / Abono a Proveedor",
                                                                  "url"   =>  current_url()),
                            "back"      =>  ($this->uri->segment(4)=='iframe' || $this->uri->segment(6)=='iframe')?true:false,
                            "anular"    =>  array(  "title" =>  "Anular Transferencia",
                                                                "confirm"=>true,
                                                                "url"   =>  base_url("Operaciones/Anular_transferencia/".@$row[0]->consecutivo.'/'.@$row[0]->tipo_documento.'/'.$this->uri->segment(3)),
                                                                "icono" =>  '<i class="fas fa-trash-alt"></i>'),
                            "pdf"       =>   array(  "url"   =>  current_url().'/PDF' ),         
                                    );
                        echo TaskBar($submenu);
        ?> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                   Proveedor<BR /> ID Proveedor
                </div>
                <div class="col-md-4">
                    <b>
                        <?php 
                            echo @nombre($proveedor);
                        ?>
                        <br />
                        <?php echo @$proveedor->identificacion;?>
                        <?php
                            if(!empty($proveedor->identificacion_ext)){
                                echo ' - '.$proveedor->identificacion_ext;
                            }
                        ?>
                    </b>
                </div>
                <div class="col-md-2">
                    Detalle de gasto: <br />
                    Fecha Expedición                   
                </div>
                <div class="col-md-4 text-right">
                        <?php echo @$row[0]->abreviacion.' '.@tipo_documento($row[0]->tipo_documento,true).' '.@ceros($row[0]->consecutivo); ?>
                    <br />
                    <?php
                        echo @$row[0]->fecha;
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
                            echo @$json->direccion; //str_replace($row[0]->Pais,"",$row[0]->Direccion)
                        ?>
                    </b>
                </div>
                <div class="col-md-3 ">
                   Ciclo de producción
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php echo (empty($json->ciclo_de_produccion))?$row[0]->ciclo_produccion_id:$json->ciclo_de_produccion;?>
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
                    <table class="ordenar tablesorter table table-hover" ordercol=0 order="asc">
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
                                <th class="text-center"><b>Procesador</b></th>
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
                                        Cancelación / Abono a proveedor
                                    </td>
                                    <td class="text-center">
                                    <?php
                                        if(@$row[0]->tipo_documento == 18){
                                            echo $nombre_caja; 
                                        }else{
                                            echo entidadbancaria($banco[0]);
                                        }
                                    ?>
                                    </td>
                                    <td  class="text-center">
                                        <a class="vin" href="<?php echo base_url("Reportes/VerDetalleGasto/".$this->uri->segment(3)); ?>" title="Cancelacion abono a proveedor">
                                            <?php echo $this->uri->segment(3); ?>
                                        </a>           
                                    </td>
                                    <td  class="text-right creditos" >
                                        <?php echo format($json2->monto,true);?>
                                    </td>
                                </tr>                   
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th class="text-center">Total</th>
                            <th class="text-right"><?php echo format($json2->monto,true);?></th>
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
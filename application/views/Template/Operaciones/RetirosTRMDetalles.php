<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
	$modulo		=	$this->ModuloActivo;
	$row		=	$this->$modulo->result;
	$trm		=	$row[0];
	$json		=	json_decode($trm->json);
    $empresa = centrodecostos($this->user->centro_de_costos)->abreviacion;
    $documento = tipo_documento(6,true);
    if($trm->estatus == 0){
?>
<div class="container text-center">
    <h2 class="font-weight-700 text-uppercase orange">
    <input id="nuevo_estatus" type="hidden" value="Pendiente">ANULADA</h2>
</div>
<?php
    }
?>
<div class="container" style="margin-bottom:100px;" id="imprimeme">
    <?php 
        $submenu = array("name"     =>  array(  "title" =>  "Monetización",
                                                    "url"   =>  current_url()),
                            "back"      =>  ($this->uri->segment(4)=='iframe')?true:false,
                            "pdf"       =>  true,
                            "config"    =>  array("title" =>  "Anular monetizacion",
                                                  "icono"  =>  '<i class="fas fa-trash"></i>',
                                                  "url"   =>  base_url("Operaciones/Cambiarestado/".$trm->consecutivo.'/'.$trm->tipo_documento.'/0/iframe'))
                    );
        if($this->uri->segment(4) != $this->uri->segment(3) || !$this->uri->segment(4)){
        }
        if($trm->estatus == 0){
            unset($submenu['config']);
        }
		echo TaskBar($submenu);
	?>
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row">
                <div class="col-md-3">
                    <b>
                        Monetizador:
                    </b>
                </div>
                <div class="col-md-3 text-right">
                    <b> 
                        <?php echo $json->Monetizador; ?>
                    </b>
                </div>
                <div class="col-md-3">
                        Monetización:
                </div>
                <div class="col-md-3">
                    <b>
                        <?php echo $empresa.' '.$documento.' '.ceros($trm->consecutivo);?>
                    </b>
                </div>
                <div class="col-md-3">
                    Fecha
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            print($json->fecha_transaccion);
                        ?>
                    </b>
                </div>
                 <div class="col-md-3">
                    Tercero
                </div>
                <div class="col-md-3">
                    <b>
                        <?php 
                            if(!empty($json->banco_id)){
                                echo entidadbancaria($json->banco_id);
                            }else{
                                echo @nombre(centrodecostos($json->Tercero));
                            }
                        ?>
                    </b>
                </div>
                <div class="col-md-3">
                    Ciclo de Producción
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            print($json->ciclo_de_produccion);
                        ?>
                    </b>
                </div>
                <div class="col-md-3">
                    Cuenta bancaria del exterior:
                </div>
                <div class="col-md-3">
                    <?php $banco  =   @get_banco($json->procesador_id); $cuenta_banco = entidadbancaria($banco->entidad_bancaria).' ( '.@$banco->nro_cuenta.' )'; ?>
                    <a href="#" class="Popover" data-toggle="popover" data-trigger="hover" data-placement="bottom" title="Cuenta" data-content="<?php echo $cuenta_banco; ?>">
                    <?php 
                        print(@entidadbancaria($banco->entidad_bancaria));     
                    ?>
                    </a>
                </div>
                <div class="col-md-3">
                    USD Cargado
                </div>
                <div class="col-md-3 text-right">
                    USD <b><?php print(format($json->usd_cargado,true));?></b>
                </div>
                <div class="col-md-3">
                    Tipo transacción
                </div>
                <div class="col-md-3">
                    <b><?php echo $json->Tipo_transaccion;?></b>
                </div>
                <div class="col-md-3">
                    Destino
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php
                            if(!empty($json->Banco_destino)){
                                $destino = explode("/-/",$json->Banco_destino);
                                echo @entidadbancaria($destino[0]).' ('.$destino[2].')';       
                            }else{
                                echo @getCaja($json->CajaDestino);
                            }
                        ?>
                    </b>
                </div>
                <div class="col-md-3">
                    TRM
                </div>
                <div class="col-md-3 text-left">
                    <b>
                        $ <?php
                            echo $json->trm;
                        ?>
                    </b>
                </div>
            </div>
            <!--<div class="row">
            	<div class="col-md-3">
		           Nro. Transacción
                </div>
                <div class="col-md-3">
                    <b>
	                    <?php 
							print($json->nro_transaccion);
						?>
                    </b>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-3">
		           Valor Retiro
                </div>
                <div class="col-md-3">
	                <b>$<?php print(format($json->valor_retiro,false));?></b>
                </div>
            </div>-->
		</div>
	</div>
    <div style=" width:100%; height:20px;"></div> 
    <div class="bd-example bd-example-tabs" role="tabpanel">
        <ul class="nav nav-tabs" role="tablist">
             <li class="nav-item">
                <a id="registro-tab" class="nav-link active" data-toggle="tab" href="#registro" role="tab">
                    Registro Contable
                </a>
             </li>
             <li class="nav-item">
                <a id="observacion-tab" class="nav-link" data-toggle="tab" href="#observacion" role="tab">
                    Observaciones
                </a>
             </li>
        </ul> 
        <div class="tab-content col-md-12">
            <div id="registro" class="tab-pane active row justify-content-md-center" role="tabpanel">
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
                                foreach($row as $k	=> $v){
                                    if($v->debito > 0 || $v->credito >0){
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
                                    <td  class="text-right">
                                        <?php
                                                $debito +=$v->debito;
                                                print(format($v->debito,true));
                                        ?>
                                    </td>
                                    <td class="text-right" id="td<?php echo $k?>">
                                        <?php
                                                print(format(($v->credito),true));
                                                $credito +=$v->credito;
                                        ?>
                                    </td>                           
                                </tr>
                            <?php
                                    } 
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="100"></th>
                                <th><b>Sumas Iguales</b></th>
                                <th width="100" class="text-right"><b><?php echo format(($debito),true); ?></b></th>
                                <th width="100" class="text-right"><b><?php echo @format($debito,true); ?></b></th>
                            </tr>
                        </tfoot>    
                        <input type="hidden" id="credito" value="<?php echo format($debito,true);?>" />                    
                    </table> 
                </div>                
            </div>    
            <div id="observacion" class="tab-pane row justify-content-md-center" role="tabpanel" >
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
<script>
	$(document).ready(function(){
        $('.Popover').click(function(e){
            e.preventDefault();
        }).popover();
		$(".creditos").html($("#credito").val());
		$(".recibir").remove();
		$("#td0").html($("#credito").val());
	});
</script>
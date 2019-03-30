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
	$trm		=	$row[0];
	$json		=	json_decode($trm->json);
?>

<div class="container" style="margin-bottom:100px;">
    <?php
        if($trm->estatus == 9){
    ?>
    <div class="container text-center">
        <h2 class="font-weight-700 text-uppercase orange">
        <input id="nuevo_estatus" type="hidden" value="Pendiente">ANULADA</h2>
    </div>
    <?php
        }
    ?>
    <div class="mb-4 col-md-12">
    <?php 
        $submenu = array("name"     =>  array(  "title" =>  "Consignación bancaria",
                                                    "url"   =>  current_url()),
                            "back"      =>  ($this->uri->segment(4)=='iframe')?true:false,
                            "pdf"       =>  true,
                            "config"    =>  array("title" =>  "Anular consignación",
                                                  "icono"  =>  '<i class="fas fa-trash"></i>',
                                                  "url"   =>  base_url("Operaciones/Cambiarestado/".$trm->consecutivo.'/'.$trm->tipo_documento.'/9/iframe')),
                    );
        if($trm->estatus == 9){
            unset($submenu['config']);
        }
        echo TaskBar($submenu);
    ?>
    </div>
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row">
                <div class="col-md-2">
		           Cuenta Bancaria
                </div>
                <div class="col-md-4">
                    <?php 
						$banco	=	get_banco($json->procesador_id);
						print(entidadbancaria($banco->entidad_bancaria)); 
						
					?> <b>( <?php print($banco->nro_cuenta);?> )</b>
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
            </div>
            <div class="row">
                <div class="col-md-2">
                   Caja Origen:
                </div>
                <div class="col-md-4">
                    <b><?php 
                        echo getCaja($json->caja_id); 
                        
                    ?></b>
                </div>
                <div class="col-md-2">
                   Nro. Transacción
                </div>
                <div class="col-md-4 text-right">
                    <b>
                        <?php 
                            print($json->nro_documento);
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                	Ciclo de Producción
                </div>
                <div class="col-md-4">
                	<b>
						<?php 
                            print($json->ciclo_de_produccion);
                        ?>
                    </b>
                </div>
            </div>
		</div>
	</div>
    <div style=" width:100%; height:20px;"></div>  
	<div class="row filters">
        <div class="col-md-12">
            <h4 class="font-weight-700 text-uppercase orange">
                Registro Contable
            </h4>
        </div>
    </div>              
    <div class="row justify-content-md-center">
    	<div class="col-md-12">
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
                                    <td  style="text-align: right;">
                                        <?php
                                                $debito +=$v->debito;
                                                print(format($v->debito,true));
                                        ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php
                                                $credito +=$v->credito;
                                                print(format($v->credito,true));
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
</div>
<!--<script>
	$(document).ready(function(){
		$(".creditos").html($("#credito").val());
		$(".recibir").remove();
		$("#td0").html($("#credito").val());
	});
</script>-->
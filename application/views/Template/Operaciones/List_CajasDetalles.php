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
	//pre($this->user);
?>
<div class="container" id="factura">
    <?php 
		echo TaskBar(array("name"		=>	array(	"title"	=>	"Resumen de Caja",
													"url"	=>	current_url()),
                            "back"      =>  ($this->uri->segment(4)=='iframe' || $this->uri->segment(6)=='iframe')?true:false,
							"pdf"		=>	array("title"=> "PDF",
                                                  "url"  => current_url().'/PDF'),

					)
				);
	?>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#resumen" role="tab" style="margin:0px,padding:0px">
                <i class="fas fa-angle-right"></i> Resumen 
            </a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#detalle" role="tab">
               <i class="fas fa-angle-right"></i>  Detalle 
            </a>
        </li>-->
    </ul>
	<div class="row justify-content-md-center tab-content" id="imprimeme">
        <div class="col-md-12 tab-pane active" id="resumen" role="tabpanel">
            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=0 order="asc">
                <thead>
                    <tr>
                        <th class="text-left">Fecha</th>
                        <th class="text-left">Tipo Documento</th>
                        <th class="text-center">Documento</th>
                        <th width="100" class="text-right">Debito</th>
                        <th width="100" class="text-right">Crédito</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(count($this->$modulo->result)>0){
							
							$debito=0;
							$credito=0;
                            foreach($this->$modulo->result as $v){
                    ?>
                    <tr>
                        <td><?php echo $v->fecha;// pre($v); ?></td>
                        <td><?php echo tipo_documento($v->tipo_documento); ?></td>
                        <td class="text-center">
                        	<?php if($v->tipo_documento== 6){?>
	                        	<a class="nav-link vin"   data-event="reload" data-type="iframe" title="Comprobante Retiro TRM No. <?php echo $v->consecutivo;?>" href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo."/iframe")?>"><?php echo $v->consecutivo ?></a>
                            <?php }elseif($v->tipo_documento== 9){?>
                                <a class="nav-link vin"  data-event="reload" title="Comprobante Caja No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/ComprobanteCaja/'.$v->consecutivo.'/'.$v->tipo_documento.'/iframe');?>">
                                <?php echo $v->consecutivo ?></a>
                            <?php }else if($v->tipo_documento== 11){?>
                                <a class="nav-link vin"  data-event="reload" title="Comprobante Transferencia No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/Transferencia/'.$v->consecutivo.'/iframe');?>">
                                    <?php echo $v->consecutivo; ?></a>
                            <?php }elseif($v->tipo_documento == 10){ ?>
                                <a class="nav-link vin"  data-event="reload" title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/RetirosTRMDetallesContable/'.$v->consecutivo.'/iframe');?>">
                                    <?php echo $v->consecutivo; ?></a>
                            <?php }elseif($v->tipo_documento == 14){ ?>
                                <a class="lightbox documentos" title="Honorarios" data-type="iframe" href="<?php echo json_decode($v->json)->redirect; ?>">
                                    <?php echo $v->consecutivo; ?></a>
                            <?php }else{ ?>
                               <a class="nav-link vin"  data-event="reload" title="Comprobante Transferencia No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/transferencia_nacionales/'.$v->nro_documento.'/'.$v->consecutivo.'/'.$v->tipo_documento.'/iframe');?>"><?php echo $v->consecutivo ?></a>
							<?php }?>
						</td>
                        <td class="text-right">
                            <?php echo format($v->debito_COP,false);$debito+= $v->debito_COP; ?>
                        </td>
                        <td class="text-right">
                            <?php echo format($v->credito_COP,false); $credito+= $v->credito_COP;?>
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
                	<tr>
                    	<th></th>
                        <th></th>
                        <th class="text-right">Total:</th>
                        <th class="text-right"><?php echo @format($debito,false); ?></th>
                        <th class="text-right"><?php echo format(@$credito,false); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--<div class="col-md-12 tab-pane" id="detalle" role="tabpanel">
            <div class="col-md-4 text-center">
                <canvas width="400" height="400" data-objeto="{'type':'pie','label':'#Operacion','text':'Caja',colores:['Yellow','Blue'],valores:[<?php echo @$credito ?>,<?php echo @$debito; ?>]}"></canvas>
            </div>
        </div>-->
    </div>
</div>
<script>
	$(document).ready(function(){
        var canvas  =   $("canvas");    
        canvas.each(function(){
            makeCanvas($(this));
        });
		var	credito						=	parseFloat($("#credito").val()).toFixed(2);
		var	credito_cuenta_contable		=	parseFloat($("#credito_cuenta_contable").val()).toFixed(2);
		if(credito == credito_cuenta_contable){
			//console.log(credito + ' CREDITO');
			//console.log(credito_cuenta_contable + 'CONTABLE');
			$("#pagado").html('<h2 class="font-weight-700 text-uppercase orange">PAGADO</h2>');
			$(".recibir").remove();
			$(".anular").remove();	
		}
	});
</script>
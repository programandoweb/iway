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
    <div class="row filters">
                <div class="col-md-12">
                    <?php echo submenu("Bancos","Resumen Bancos") ?>
                </div>
            </div>
            <div style="height: 50px"></div>
	<div class="row justify-content-md-center">
        <div class="col-md-12">
            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                <thead>
                    <tr>
                        <th class="text-left">Fecha</th>
                        <th class="text-center">Tipo Documento</th>
                        <th class="text-center">Documento</th>
                        <th class="text-right">Debito</th>
                        <th class="text-right">Crédito</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(count($this->$modulo->result)>0){
                            foreach($this->$modulo->result as $v){
                    ?>
                    <tr>
                        <td><?php echo $v->fecha ?></td>
                        <td><?php echo $v->tipo_documento ?></td>
                        <td class="text-center"><a href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo)?>"><?php echo $v->consecutivo ?></a></td>
                        <td class="text-right"><?php echo format($v->debito,true) ?></td>
                        <td class="text-right"><?php echo format($v->credito,true) ?></td>
                    </tr>
                    <?php
                        }
                    }else{ 
                     ?>
                     <tr>
                         <td colspan="5">
                             No existen Registros
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
<script>
	$(document).ready(function(){
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
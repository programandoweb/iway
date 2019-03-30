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
	//pre($row);return;
?>

<div class="container" style="margin-bottom:100px;">
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th>Cuenta Bancaria</th>
                <th>Fecha</th>
                <th>Nro. Transacción</th>
                <th>Ciclo de Producción</th>
            </tr>
        </thead>
        <tbody>
            <tr> 
                <td class="bordeAll">
                    <?php 
                        $banco  =   get_banco($json->procesador_id);
                        print(entidadbancaria($banco->entidad_bancaria)); 
                        
                    ?> <b>( <?php print($banco->nro_cuenta);?> )</b>
                </td>
                <td class="bordeAll">
                    <?php 
                        print($json->fecha_transaccion);
                    ?>
                </td>
                <td class="bordeAll">
                    <?php 
                        print($json->nro_documento);
                    ?>
                </td>
                <td class="bordeAll">
                    <?php 
                        print($json->ciclo_de_produccion);
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align: center;">
        <h4>
            Registro Contable
        </h4>
    </div>
    <div style="height: 20px;"></div>            
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
                    <td  class="text-right">
                   	 	<?php
								$credito +=$v->credito;
                                print(format($v->credito,false));
                        ?>
                    </td>
                    <td class="text-center" id="td<?php echo $k?>">
						<?php
								$debito +=$v->debito;
                                print(format($v->debito,false));
                        ?>
                        
                    </td>                           
                </tr>
            <?php }?>
        </tbody>                      
    </table> 
</div>    
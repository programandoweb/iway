<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
	
	Agregar
	<i class="fa fa-plus" aria-hidden="true"></i>
	Ver
	<i class="fa fa-search" aria-hidden="true"></i>
	Editar
	<i class="fas fa-edit" aria-hidden="true"></i>
*/?>
<?php 
		$modulo		=	$this->ModuloActivo;
		$ciclo		=	$this->$modulo->fields;
		$items = 	$this->$modulo->result;
        $reg=count($items);
        $num=$reg/12;
        $Pag=ceil($num)-1;
        $numPag=0;             
        for($i=0;$i<=$Pag;$i++){
		$numPag++; 
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
    		<table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
		        <tr>
		            <td width="30%">
		                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
		            </td>
		            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="2">
		                <?php echo $empresa->nombre_legal?><br/>
		                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
		                <?php echo $empresa->direccion;?><br />               
		                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
		                <?php echo $empresa->website;?><br/>
		                <?php #pre($empresa); ?>
		            </td>
		        </tr>
		    </table> 
        	<div class="row filters">
        		<div style="height: 20px;"></div>
            	<div style="text-align: center;">
		            <h4> Cumpleaños.</h4>
                </div>
           	</div>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$colums		=	'';
						$colums		.=	'<tr>';
						$count		=	0;
						$colums		.=	'</tr>';	
					?>
					<table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
						<thead>
							<tr class="colorFondo">
								<th colspan="2"><b>Nombre</b></th>
                                <th><b>Cumpleaños</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td class="bordeAll" colspan="2">
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            	<?PHP 
													if($v->dia_nacimiento==date("d") && $v->mes_nacimiento==date("m")){
												?>
                                                		<br /><b>Hoy de cumpleaños	 <i class="fa fa-birthday-cake" aria-hidden="true"></i></b>

                                                <?php	
													}
												?>
                                            </td>
                                            <td class="bordeAll">
	                                            <?php print_r($v->fecha_nacimiento);?>
                                            </td>
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="3" style="text-align: center;">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td class="colorFondo" colspan="3" style="text-align:center;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
							</tr>
						</tfoot>
					</table>        
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if($this->uri->segment($this->uri->total_segments())!=="PDF"){?>
        <table>
            <tr></tr>
            <tr></tr>
            <tr>
                <td rowspan="4"></td>
                <td></td>
                <td rowspan="4">
                    <?php
                        if(!empty($empresa->firma)){
                                echo '<img src="'. img_firma($empresa->firma).'" style="width:153px;height:55px;" />';
                        }
                    ?>
                </td> 
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td class="bordetop" width="200">
                    Aprobado:
                </td>
                <td width="100"></td>
                <td class="bordetop" width="200">
                    <?php
                        if(@$OpcionesFactura->firmaFac==1){
                            echo $empresa->nombre_representante_legal.' C.C. '.$empresa->nro_identificacion_representante_legal;
                        }else{
                            echo 'Firma y sello autorizado';
                        }
                    ?> 
                </td>    
            </tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td class="bordetop">
                    Fecha impresión documento <?php echo date('Y-m-d'); ?>
                </td>
                <td class="bordetop">
                    Página <?php echo $numPag.' / '.($Pag+1); ?>
                </td>
                <td class="bordetop">
                    Powered by LogicSoft&reg; | www.webcamplus.com.co
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?>
                </td>
            </tr>
        </table>
    </div>
<?php }else{ ?>
<div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página <?php echo $numPag.' / '.($Pag+1); ?></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div><?php } }?>
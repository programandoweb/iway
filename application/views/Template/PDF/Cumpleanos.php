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
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal?><br/>
            Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php echo $empresa->direccion;?><br />               
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br/>
            <?php #pre($empresa); ?>
        </td>
    </tr>
</table>
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
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
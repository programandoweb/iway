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
<?php $modulo		=	$this->ModuloActivo; ?>
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
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"><i class="fas fa-file-alt"></i> Presupuesto</h4>
                </div>
            </div>
            <div class="row">			    <?php
					if(count($this->$modulo->result)>0){
						$Totalizado   = array();
						$Variable     = array();
						$Fijo         = array();
						foreach($this->$modulo->result as $v){
							if($v->tipo_gasto=="Variable"){
								$Variable[]     =  $v;
							}elseif($v->tipo_gasto=="Fijo"){
								$Fijo[]         =  $v;
							}
						}
					}
				?>	            
            	<div class="tab-content col-md-12">            	  
            		<div class="tab-pane active  col-md-12" id="Variable" role="tabpanel">
					<?php
						$modulo		=	$this->ModuloActivo;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" width="540">
						<thead>
							<tr>
								<td><b>Tipo de Gasto</b></td>
                                <td class="text-center"><b>Concepto Gasto</b></td>
                                <td class="text-center"><b>Observación</b></td>
                                <td class="text-center" width="120"><b>Valor</b></td>
							</tr>
						</thead>
						<tbody>
								

							<?php
								$TotalVariable=0;
								if(!empty($Variable)){
									foreach($Variable as $v){
							?>
                            			<tr>
                                        	<td>
                                            	<?php echo($v->tipo_gasto); ?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo($v->concepto_gasto); ?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo($v->observacion); ?>
                                            </td>
                                            <td class="text-right">
                                                <?php 
                                                $TotalVariable+= $v->valor;
												echo format($v->valor,true);
                                                //set_input_dinamico("valor",$v,null,false,"input_dinamico"); ?>                                   	
                                            </td>	
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="4" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
							<tr>
                            	<td colspan="2"></td>
								<td  class="text-right"><b>Total</b></td>								
								<td class="text-right"><b><?php echo format($TotalVariable); ?></b></td>
							</tr>
						</tbody>
					</table>
					<div class="container">
						<?php 
							echo $this->pagination->create_links();
						?>
					</div>                    
                 </div>
                 <div class="tab-pane  col-md-12" id="Fijo" role="tabpanel">
					<?php
						$modulo		=	$this->ModuloActivo;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" width="540">
						<thead>
							<tr>
								<td><b>Tipo de Gasto</b></td>
                                <td class="text-center"><b>Concepto Gasto</b></td>
                                <td class="text-center"><b>Observación</b></td>
                                <td class="text-center" width="120"><b>Valor</b></td>
							</tr>
						</thead>
						<tbody>
								

							<?php
								$TotalFijo=0;
								if(!empty($Fijo)){
									foreach($Fijo as $v){
							?>
                            			<tr>
                                        	<td>
                                            	<?php echo($v->tipo_gasto); ?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo($v->concepto_gasto); ?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo($v->observacion); ?>
                                            </td>
                                            <td class="text-right">
                                                <?php 
                                                $TotalFijo+=$v->valor;
												echo format($v->valor,true);
                                                //set_input_dinamico("valor",$v,null,false,"input_dinamico"); ?>                                   	
                                            </td>	
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="4" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
							<tr>
                            	<td colspan="2"></td>
								<td  class="text-right"><b>Total</b></td>								
								<td class="text-right"><b><?php print_r(format($TotalFijo)); ?></b></td>
							</tr>
						</tbody>
					</table>
					<div class="container">
						<?php 
							echo $this->pagination->create_links();
						?>
					</div>                    
                 </div>
                  <div class="tab-pane col-md-12" id="Totalizado" role="tabpanel">
					<?php
						$modulo		=	$this->ModuloActivo;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" width="540">
						<thead>
							<tr>
								<td><b>Tipo de Gasto</b></td>
                                <td class="text-center"><b>Concepto Gasto</b></td>
                                <td class="text-center"><b>Observación</b></td>
                                <td class="text-center" width="120"><b>Valor</b></td>
							</tr>
						</thead>
						<tbody>
								

							<?php
								$Total=0;
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
							?>
                            			<tr>
                                        	<td>
                                            	<?php echo($v->tipo_gasto); ?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo($v->concepto_gasto); ?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo($v->observacion); ?>
                                            </td>
                                            <td class="text-right">
                                                <?php 
                                                $Total+=$v->valor;
												echo format($v->valor,true);
                                                //set_input_dinamico("valor",$v,null,false,"input_dinamico"); ?>                                   	
                                            </td>	
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="4" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
							<tr>
                            	<td colspan="2"></td>
								<td  class="text-right"><b>Total</b></td>								
								<td class="text-right"><b><?php echo format($Total); ?></b></td>
							</tr>
						</tbody>
					</table>                    
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>



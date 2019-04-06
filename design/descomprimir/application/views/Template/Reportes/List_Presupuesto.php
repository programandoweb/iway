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
	<i class="fa fa-pencil" aria-hidden="true"></i>
*/?>
<?php $modulo		=	$this->ModuloActivo; ?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">Presupuesto</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary btn-md lightbox" title="Agregar Presupuesto" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/Add_".$this->uri->segment(2))?>">
                        <i class="fa fa-plus" aria-hidden="true"></i> 
                        Agregar
                    </a>
                </div>
            </div>
            <div class="row">
            	<ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                    	<a class="nav-link active" data-toggle="tab" href="#Variable" role="tab" style="margin:0px,padding:0px">
                    		Variable 
                    	</a>
                    </li>
			  		<li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Fijo" role="tab">
                            Fijo
                        </a>
			  		</li>
			  		<li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Totalizado" role="tab">
                            Totalizado
                        </a>
			  		</li>
				</ul>
			    <?php
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
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
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
							if(!empty($Variable)){
								$TotalVariable=0;
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
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
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
							if(!empty($Fijo)){
								$TotalFijo=0;
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
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
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
							if(count($this->$modulo->result)>0){
								$Total=0;
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
					<div class="container">
						<?php 
							echo $this->pagination->create_links();
						?>
					</div>                    
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>



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
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="filters">
            	<?php 
					echo TaskBar(array("name"		=>	array(	"title"	=>	"Cumpleaños",
																"icono"	=>	'<i class="fas fa-users"></i>',
																"url"	=>	current_url()),
	                                                            "pdf"   =>  true,
	                                                            "excel"     =>  true,
                                                            	"mail"      =>  array(  "id"    =>  "mail" ),)
							    );
				?>
           	</div>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$colums		=	'';
						$colums		.=	'<tr>';
						$count		=	0;
						$modulo		=	$this->ModuloActivo;
						$ciclo		=	$this->$modulo->fields;
						$colums		.=	'</tr>';	
					?>
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<th><b>Nombre</b></th>
                                <th  class="text-center"><b>Cumpleaños</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr class="<?PHP if($v->dia_nacimiento==date("d") && $v->mes_nacimiento==date("m")){echo 'table-info';}?>">
                                        	<td >
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            	<?PHP 
													if($v->dia_nacimiento==date("d") && $v->mes_nacimiento==date("m")){
												?>
                                                		<br /><b>Hoy de cumpleaños	 <i class="fa fa-birthday-cake" aria-hidden="true"></i></b>

                                                <?php	
													}
												?>
                                            </td>
                                            
                                            <td class="text-center">
	                                            <?php print_r($v->fecha_nacimiento);?>
                                            </td>
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="2" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
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

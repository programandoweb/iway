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
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <div class="row">
            	<div class="col-md-12">
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<td width="140"><b>Nombre</b></td>
                                <td width="100" class="text-center"><b>Concepto</b></td>
                                <td  width="150" class="text-center"><b>Observacion</b></td>
                                <td width="100" class="text-right"><b>Quincenas</b></td>
                                <td width="100" class="text-right"><b>Valor</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td>
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            </td>
                                            
                                            <td class="text-center">
	                                            <?php print_r($v->concepto);?>
                                            </td>
                                            <td class="text-center">
	                                            <?php print ($v->observacion);?>
                                            </td>
                                            <td class="text-right">
	                                            <?php print ($v->nro_quincenas);?>
                                            </td>
                                            <td class="text-right">
	                                            <?php print ($v->valor);?>
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
						</tbody>
						<tfoot>
							<tr>
								<td><b>Nombre</b></td>
                                <td width="120" class="text-center"><b>Concepto</b></td>
                                <td  class="text-center"><b>Observacion</b></td>
                                <td width="100" class="text-right"><b>Quincenas</b></td>
                                <td width="100" class="text-right"><b>Valor</b></td>
							</tr>
						</tfoot>
					</table>
					<div class="container">
						<?php 
							//echo $this->pagination->create_links();
						?>
					</div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

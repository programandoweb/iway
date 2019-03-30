<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	$pasos		=	1;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	<i class="fas fa-list-ul"></i> Resultado Importación <?php echo count($this->$modulo->result);?>.
					</h4>
               </div>
                <div class="col-md-6 text-right">
	                <a class="btn btn-primary btn-md" href="<?php echo base_url("Reportes/InformePlano")?>"><i class="fas fa-upload"></i> Importar</a>
                    <?php 
						if($this->user->type=='root'){
					?>
                			<a class="btn btn-primary btn-md" confirm="true" href="<?php echo base_url("Reportes/ResultadoImport/Clear")?>"><i class="fas fa-magic"></i> Limpiar</a>
                    <?php
						}
					?>
                	<a class="btn btn-primary btn-md continuar" href="<?php echo base_url("Reportes/ResultadoImport/Debug/4")?>"><i class="fas fa-angle-double-right"></i> Continuar</a>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
                                <th>Plataforma</th>
                                <th>Usuario</th>                                
                                <th class="text-left">Sucursal</th>
                                <th class="text-left">Modelo</th>
                                <th class="text-left">Master</th>
                                <th width="100" class="text-right">Producción</th>
                                <th width="100" class="text-right">Acción</th>
							</tr>
						</thead>
						<tbody>
                        	<?php 
								$total_tokens	=	0;
								if(count($this->$modulo->result)>0){
								foreach($this->$modulo->result as $k =>$v){
									//pre($v);
									$search_ext_data	=	search_nickname($v->nickname,$v->plataforma_id);
									if(!empty($v->pagina)){
										if(!empty($search_ext_data)){
							?>
                            	<tr>
                                    <td><?php print($v->pagina);?></td>
                                    <td><?php print($v->nickname);?></td>
                                    <td><?php 
											if(!empty($search_ext_data->sucursal)){	
												print($search_ext_data->sucursal);
											}
										?>
									</td>
                                    <td><?php
											if(!empty($search_ext_data->sucursal)){ 
												print($search_ext_data->modelo);
											}
										?>
                                    </td>
                                    <td class="list-action">
                                    	<?php 
											//pre($search_ext_data);
											if(empty($search_ext_data->sucursal)){
										?>
                                                <a class="btn btn-warning lightbox" data-type="iframe"  title="Editar Usuario" href="<?php echo base_url("Usuarios/AddAsignarNicknameEdit/".@$search_ext_data->nickname_id."/iframe")?>">
                                                    <i class="fas fa-edit fa-spin" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-primary"  title="Eliminar Usuario" href="<?php echo base_url("Reportes/ResultadoImportDeleteItem/".$v->reporte_archivo_plano_id)?>">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                        <?php 
											}else{
										?>		
                                        		<?php print($search_ext_data->master);?>
                                        <?php	
											}
										?>
									</td>                                    
                                    <td class="text-right"><?php print(format($v->tokens,false)); $total_tokens+=$v->tokens;?></td>
                                    <td class="text-right">
                                    	<?php
                                        	//pre($search_ext_data);
										?>
                                        <a title="Limpiar Usuario" href="<?php echo base_url("Reportes/ResultadoImportDeleteNickName/".$search_ext_data->nickname_id)?>">
                                        	<i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php								
									}}}
								}else{
							?>
                            	
                            <?php		
								}
							?>							
						</tbody>
                        <tfoot>
                        	<tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
							    <td class="text-left"><B>Total:</B></td>
                                <td class="text-right"><B><?php echo format($total_tokens,false);?></B></td>
                                <td></td>
                            </tr>
                        </tfoot>
					</table>
		
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		if($("td.list-action .lightbox").length>0){
			$(".continuar").remove();	
		}
	});
</script>
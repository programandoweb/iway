<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	Usuarios X Master 
					</h4>
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
                                <td width="150"><b>Plataforma</b></td>
                                <td><b>Resumen</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								$total_tokens=0;
								$total_dolares=0;
								$total_pesos=0;
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
										$ListMaster=get_ListMaster($v->id_plataforma);
										if(!empty($ListMaster)){
							?>
                                            <tr><td colspan="3" class="text-center"><h3><?php print_r($v->primer_nombre);?></h3></td></tr>
                                            <tr>
                                                
                                                <td class="text-left"></td>
                                                <td class="text-left" style="" >
                                                    <?php 
                                                        
                                                        foreach($ListMaster as $v2){
                                                            $Nickname	=	get_Nickname($v->id_plataforma,$v2->rel_plataforma_id);
                                                            $Cuenta		=	get_Cuenta($v2->cuenta_id);
                                                    ?>	
                                                            <div class="row"> 
                                                                <div class="col-md-1" >
                                                                    <b>Cta</b>
                                                                </div>
                                                                <div class="col-md-3" >
                                                                    <b>Master</b>
                                                                </div>
                                                                <div class="col-md-8" >
                                                                    <b>Nickname/Modelo</b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <?php 
                                                                    print('<div class="col-md-1" >'.substr($Cuenta->nro_cuenta,-4,4).'</div>');
                                                                    print('<div class="col-md-3" >'.$v2->nombre_master.'</div>');
                                                                    echo '<div  class="col-md-8 " style="min-height:26px;background-color:#e2e2e2;border-bottom:solid 1px #ddd; margin-bottom:10px;">';
                                                                    foreach($Nickname as $v3){
                                                                ?>
                                                                        <div class="row">
                                                                            <div class="col-md-6"> 
                                                                                <?php print_r($v3->nickname);?>
                                                                            </div>
                                                                            <div class="col-md-6"> 
                                                                                <?php print_r(nombre($v3));?>
                                                                            </div>
                                                                        </div>                                                                        
                                                                <?php
                                                                    } 
                                                                    echo '</div>';
                                                                ?>
                                                            </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td></td>
                                            </tr>
                            <?php		
										}
									}
								}else{
							?>
								<tr>
									<td  colspan="2" class="text-center">
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
<script>
	$(document).ready(function(){
		<?php if($regresar== true && $this->uri->segment(4)==3){?>
			$("#back").attr("href","<?php echo base_url("Reportes/ResultadoImport/Debug/2");?>");	
			$("#back").html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> Completar para Culminar');
		<?php }?>
	});
</script>
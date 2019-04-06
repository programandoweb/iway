<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$cpanel	=	cpanel();
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
            	echo	TaskBar(array(	"name"		=>	array(	"title"	=>	"Gestión de Mails",
																"url"	=>	current_url()),
																"mail"		=>	array(	"title"	=>	"Iniciar Sesión.",
																"url"	=>	"https://p3plvcpnl29130.prod.phx3.secureserver.net:2096/",
																"popup"=>true),
																"add"		=>	array(	"title"	=>	"Agregar Email.",
																"lightbox"=>true),	
								)
							);
			?>
            <div class="row">
            	<div class="col-md-12">
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="asc">
						<thead>
							<tr>
                            	<th><b>Usuario</b></th>
                                <th><b>Email</b></th>
								<th><b>Dominio</b></th>
                                <th><b>Cuota</b></th>
                                <th><b>Usado</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$modulo		=	$this->ModuloActivo;
								if(!empty($cpanel)){
									foreach($cpanel as $k	=> 	$v){
										
							?>
                            		<tr>
                                    	<td>
											<?php print($v->user);?>											
                                        </td>
                                        <td>
											<?php print($v->email);?>
                                        </td>
                                        <td>
                                            <?php print($v->domain);?>
                                        </td>
                                        <td>
                                            <?php print($v->diskquota);?>
                                        </td>
                                        <td>
											<?php print($v->humandiskused);?>
                                        </td>                                        
                                    </tr>	
                            <?php		
									}
								}
							?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$("#dominio").change(function(){
			if($(this).val()!=''){
				$("#dominios").submit();
			}
		});
	})
</script>
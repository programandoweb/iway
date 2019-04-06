<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo; ?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
        			echo TaskBar(array("name"		=>	array(	"title"	=>	"Perfiles Modelos.",
																"url"	=>	current_url()),
						
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
	                <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#activos" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Activos 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inactivos" role="tab">
                               <i class="fas fa-angle-right"></i>  Inactivos 
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content row">
    					<div class="tab-pane active col-md-12" id="activos" role="tabpanel">	
                            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="asc">
                                <thead>
                                    <th class="text-center">Avatar</th>
                                    <th>Nombre</th>
                                    <th>Url Imagenes</th>
                                    <th>Tipo Modelo</th>
                                    <th style="text-align: center;">Acciónes</th>
                                </thead>
                                <tbody>
                                	<?php 
										foreach(GetUsuarios("Modelos",$select="*",$this->user->id_empresa,1) as $k=> $v){?>
                                        <tr>
                                            <td><img src="<?php print(img_profile($v->user_id))?>" class="img rounded-circle mx-auto d-block" width="30" alt="<?php print(nombre($v))?>" /></td>
                                            <td><?php print(nombre($v))?></td>
                                            <td><?php print($v->cod_telefono.' '.$v->telefono.'<br>'.$v->email);?></td>
                                            <td><?php print($v->tipo_modelo);?></td>
                                            <td style="text-align: center;">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <?php echo form_open_multipart(base_url('Usuarios/FotoPerfil/'.$v->user_id),array()); ?>
                                                    <input id="foto" type="file" name="foto" style="display: none;">
                                                    <i title="Subir imagen" class="fa fa-file" id="file" style="cursor: pointer;"></i>
                                                    <input type="submit" id="upload" style="cursor: pointer;display: none;">
                                                </div>
                                                <?php echo form_close();?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
						</div>
                        <div class="tab-pane  col-md-12" id="inactivos" role="tabpanel">	
                            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=3 order="desc">
                                <thead>
                                    <th class="text-center">Avatar</th>
                                    <th>Nombre</th>
                                    <th width="340">Url Imagenes</th>
                                    <th>Tipo Modelo</th>
                                    <th style="text-align: center;">Acciónes</th>
                                </thead>
                                <tbody>
                                	<?php 
										foreach(GetUsuarios("Modelos",$select="*",$this->user->id_empresa,"INACTIVOS") as $k=> $v){?>
                                        <tr>
                                            <td><img src="<?php print(img_profile($v->user_id))?>" class="img rounded-circle mx-auto d-block" width="30" alt="<?php print(nombre($v))?>" /></td>
                                            <td><?php print(nombre($v))?></td>
                                            <td><?php
                                            $ruta_imagenes = verArchivo("images/uploads/perfilesModelos/".$v->user_id,true);
                                                if(!empty($ruta_imagenes)){
                                                    foreach ($ruta_imagenes as $key => $value) {
                                                        if($value !== "index.html"){
                                                            echo base_url("images/uploads/perfilesModelos/".$v->user_id.'/'.$value)."<br>";
                                                        }
                                                    } 
                                                }
                                            ?>
                                            </td>
                                            <td><?php print($v->tipo_modelo);?></td>
                                            <td style="text-align: center;">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <?php echo form_open_multipart(base_url('Usuarios/FotoPerfil/'.$v->user_id),array()); ?>
                                                    <input type="file" name="foto" class="foto" style="display: none;">
                                                    <i title="Subir imagen" class="fa fa-file file" style="cursor: pointer;"></i>
                                                    <input type="submit" class="upload" style="cursor: pointer;display: none;">
                                                </div>
                                                <?php echo form_close();?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
						</div>
					</div>                                                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".file").click(function(){
            var e = $(this).parent().find(".foto").click();
            e.change(function(img){
                var name = img.target.files[0];
                if(validarArchivo(this)){
                    //$(".file").html('<span> '+name["name"]+'</span>');
                    $('.upload').click();
                }else{
                    make_message("Error","Este tipo de archivo no es permitido");
                }
            });
        });  

        function validarArchivo(datos) {
            var extensionesValidas = ".png, .gif, .jpeg, .jpg";
            var ruta = datos.value;
            var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
            var extensionValida = extensionesValidas.indexOf(extension);
            if(extensionValida < 0) {

                return false;

            }else{

                return true;

            }
        }
    });
</script>

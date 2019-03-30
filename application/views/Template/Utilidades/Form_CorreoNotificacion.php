<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row        =   get_NotificacionEmail();
$hidden     =   array("Modulo"=>$this->uri->segment(1));
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="col-md-12 mb-4">
                    <h3>Configurar email.</h3> 
                </div>
            </div>
            <div class="form group row col-md-12">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <div class="form-group">
                                        <div class="row mb-4">    
                                            <div class="col-md-8">    
                                                <input type="email" class="form-control" name="correo" placeholder="Email" require = true>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <button type="submit" class="btn btn-primary">Agregar</button>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <table class="display table table-hover" ordercol=1 order="asc">
                                                    <tbody id="correo">
                                                        <?php
                                                            if(!empty($row)){       
                                                                foreach ($row as $k => $v) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $v->correo; ?></td>
                                                            <td class="text-center">
                                                                <a href="<?php echo base_url("Utilidades/deleteItem/".$v->id_email)?>">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
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
                        </div>
                    </div>
                </div>                                    
            </div>
	    </div>
	</div>                   
</div>                    
<?php echo form_close();?>
<script type="text/javascript" charset="utf-8" async defer>
        $("#id_modelo").attr("name","nombre_modelo");
        $('#id_modelo').focusout(function(event) {
        id = $('#id_modelo_oculto').val();
            $.post('<?php echo current_url().'/form_control'; ?>',{id:id}, function($data){
                console.log($data);
                $json = JSON.parse($data);
                console.log($json);
                $('#Usuario').val($json.nickname);
            }); 
        });
</script>

<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		 =	$this->ModuloActivo;
    //$prefijo     =  $this->$modulo->result['prefijo']->prefijoFacturaFac;
   @$prefijo = getOpcionesFactura($this->uri->segment(3))->prefijoFacturaFac;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row">
            	<div class="col-md-12">
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
                            	<th width="300"><b>Documento</b></th>
                                <th class="text-center" width="80"><b>Id sistema</b></th>
                            	<th width="150" class="text-center"><b>Prefijo</b></th>
                                <th class="text-center"><b>Consecutivo</b></th>
							</tr>
						</thead>
						<tbody>
                        	<?php 
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $k => $v){?>
                                        <tr>
                                            <td>
                                            	<?php 
                                                    print($v->nombre);
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $v->id_documento; ?>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <?php
													$json	=	json_decode($v->json);
													if(is_object($json) && isset($json->PrefijoDocumentos)){
                                                   		echo $json->PrefijoDocumentos;
													}
                                                ?>
                                             </td>
                                             <td class="text-center" style="vertical-align:middle;">
                                                <?php echo form_open(current_url(),array('ajaxing' => 'true')); ?>
                                                    <div style="display: flex;">
                                                        <?php
                                                            $row = ceros($v->consecutivo);
                                                            set_input("consecutivo",$row,"Consecutivo",true,"mr-2 consecutivo text-right",array("readonly"=>"readonly"));
                                                            set_input_hidden("documento_id","type_".$k,$v);
                                                            if(!empty($v->id)){
                                                                set_input_hidden("id","id_".$k,$v); 
                                                            }
                                                        ?>  
                                                        <button type="submit" class="btn btn-primary" style="cursor:pointer;"><i class="far fa-save"></i></button>
                                                    </div>
                                                <?php echo form_close();?>
                                            </td>
                                        </tr>	
                            <?php 	}
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
    $(document).ready(function($) {
        $('input').dblclick(function(){
            $(this).removeAttr('readonly');
        });
    });
</script>
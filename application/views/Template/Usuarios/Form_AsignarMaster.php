<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array("rel_plataforma_id"=>$this->uri->segment(4),"redirect"=>base_url("Usuarios/AsignarMaster"));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:70px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3><?php if(!$this->uri->segment(3)){echo'Agregar';}else{echo 'Editar';} ?> máster</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-4 text-right">	
                    	<b>Plataforma *</b>
                    </div>
                    <div class="col-md-8">	
                        <?php echo MakePlataformas("id_plataforma",@$row->id_plataforma,array("class"=>"form-control"),$this->Usuarios->get_plataformas_rel_master());?>
                    </div>
				</div>                    
                <div class="row form-group">
	                <div class="col-md-4 text-right">	
                    	<b>Nombre máster *</b>
                    </div>
                    <div class="col-md-8">	
                        <?php set_input("nombre_master",@$row,$placeholder='Nombre del Master',$require=true);?>
                    </div>
				</div>
                <div class="row form-group">
                    <div class="offset-md-4 col-md-8" id="mensaje"></div>
                </div>
                <div class="row form-group">
	                <div class="col-md-4 text-right">	
                    	<b>Cuenta Bancaria *</b>
                    </div>
                    <div class="col-md-8">
                        <?php echo MakeCuentasBancarias("cuenta_id",@$row->cuenta_id,array("class"=>"form-control","required"=>"required"),$this->Usuarios->get_CuentasBancarias(true));?>
                    </div>
				</div>
                <div class="row form-group item">
	                <div class="col-md-4 text-right">	
                    	<b>Estado</b>
                    </div>
                    <div class="col-md-3">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php 
    echo form_close();
?>
<script>
    $(document).ready(function(){
        $('#nombre_master').keyup(function(e){
            var plataforma = $('#id_plataforma').val();
            $.post('<?php echo current_url().'/validar'; ?>',{plataforma:plataforma}, function($data){
                    $json = JSON.parse($data);
                    if($.inArray(e.target.value,$json) >= 0){
                        $("#mensaje").html('<div class="alert alert-danger col-md-12" role="alert"><strong>Importante:</strong> Esta master ya fué inscrita.</div>');
                        $('button[type=submit]').attr('disabled','disabled');
                    }else{
                        $("#mensaje").html('');
                        $('button[type=submit]').removeAttr('disabled');
                    }
            }); 
        }); 
    });
</script>
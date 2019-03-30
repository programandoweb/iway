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
$hidden 	= 	array("iframe"=>"Add_Todos_Iframe","user_id"=>$this->uri->segment(3),'type' => (isset($row->type))?$row->type:'');
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Banco *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo bancos(@$row);?>
                    </div>
				</div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Tipo de Cuenta *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeModalidadCuentaBancaria("tipo_cuenta",(isset($row->tipo_cuenta))?$row->tipo_cuenta:NULL,array("class"=>"form-control","require"=>"require"));?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Número de Cuenta *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nro_cuenta",@$row,$placeholder='Número de Cuenta');?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		//$("#nro_cuenta").mask("9999-9999-9999-9999");
	});
</script>
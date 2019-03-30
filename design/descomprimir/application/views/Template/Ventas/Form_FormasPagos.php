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
$hidden = array('id_forma_pago' => (isset($row->id_forma_pago))?$row->id_forma_pago:'',"redirect"=>base_url("Ventas/FormasPagos"));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}
	set_input_hidden("id_empresa","id_empresa",$this->user->id_empresa);
	set_input_hidden("centro_de_costos","centro_de_costos",$this->user->centro_de_costos);			
?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Maestro Formas de Pagos</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre Forma de Pago *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nombre_escala"  placeholder="Nombre Escala" value="<?php echo (isset($row->nombre_escala))?$row->nombre_escala:''?>" <?php echo (isset($row->nombre_escala))?'readonly="readonly"':''?>  require/>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Días de Pago *</b>
                    </div>
                    <div class="col-md-6">	
	                    <div class="input-group">
                        	<input type="text" class="form-control" name="dias_pago"  placeholder="Días de Pago" value="<?php echo (isset($row->dias_pago))?$row->dias_pago:''?>" require  />
                            <span class="input-group-addon" ><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado Forma de Pago</b>
                    </div>
                    <div class="col-md-6">	
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
<?php echo form_close();?>
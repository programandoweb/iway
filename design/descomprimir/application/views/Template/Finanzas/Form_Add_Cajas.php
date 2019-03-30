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
$hidden = array('id_caja' => (isset($row->id_caja))?$row->id_caja:'',"redirect"=>base_url("Finanzas/Cajas"));
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
		            	<h3>Maestro Cajas</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre de Caja *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nombre_caja"  placeholder="Nombre de Caja" value="<?php echo (isset($row->nombre_caja))?$row->nombre_caja:''?>" <?php echo (isset($row->nombre_caja))?'readonly="readonly"':''?>  require/>
                    </div>
                </div>
                <!--div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Responsable *</b>
                    </div>
                    <div class="col-md-6">	
                         <?php  echo MakeUsersNoRoot("id_responsable",@$row->id_responsable,array("class"=>"form-control"),$this->users);?>
                    </div>
                </div-->
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado Escala</b>
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
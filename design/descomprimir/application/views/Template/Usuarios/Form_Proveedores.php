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
$hidden 	= 	array('type'=>$this->uri->segment(3),'user_id' => (isset($row->user_id))?$row->user_id:'',"redirect"=>base_url("Usuarios/Todos/".$this->uri->segment(3)));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);?>
<?php 
	if(!centro_de_costos()){
		return;
	}
?>	
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información Básica Proveedor</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Naturaleza e identificación *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeTipoPersona("tipo_persona",(isset($row->tipo_persona))?$row->tipo_persona:NULL,array("class"=>"form-control","id"=>"tipo_persona"));?>
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Nombre Legal *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nombre_legal",$row,$placeholder='Nombre Legal',$require=true,"firstLetterText");?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Nombre Comercial *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nombre_comercial",$row,$placeholder='Nombre Comercial',$require=true,"firstLetterText");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Tipo de Documento *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeTipoIdentificacion("tipo_identificacion",(isset($row->tipo_identificacion))?$row->tipo_identificacion:NULL,array("class"=>"form-control"));?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>No. Documento *</b>
                    </div>
                    <div class="col-md-5">	
	                    <?php set_input("identificacion",$row,$placeholder='No. Documento',$require=true);?>
                    </div>
                    <div class="col-md-1">	
						<input type="text" class="form-control" name="identificacion_ext" maxlength="1"  value="<?php echo (isset($row->identificacion_ext))?$row->identificacion_ext:''?>" />
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información de Contacto</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Teléfono / Móvil *</b>
                    </div>
                    <div class="col-md-3">	
	                    <div class="input-group input-group-sm">
	                        <input type="text" class="form-control col-md-3" name="cod_telefono" maxlength="3"  value="<?php echo (isset($row->cod_telefono))?$row->cod_telefono:''?>" require />
                        	<input type="text" class="form-control col-md-9" name="telefono"  maxlength="10"  value="<?php echo (isset($row->telefono))?$row->telefono:''?>" require />                            
                        </div>
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b>Número Fijo</b>
                    </div>
                    <div class="col-md-3">	
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control col-md-3" name="cod_otro_telefono" maxlength="3" value="<?php echo (isset($row->cod_otro_telefono))?$row->cod_otro_telefono:''?>" />
                            <input type="text" class="form-control col-md-9" name="otro_telefono"  maxlength="10" value="<?php echo (isset($row->otro_telefono))?$row->otro_telefono:''?>" />                            
                        </div>
                    </div>
                </div>
                <?php
                	echo direccion($row);
				?>
                <!--div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Concepto de Gastos *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 
							//echo get_concepto_gastos((isset($row->get_concepto_gastos))?$row->get_concepto_gastos:NULL,array("class"=>"form-control"));
							echo gastos($row,$estado = null,$extra=array("class"=>"form-control"));
						?>
                    </div>
				</div>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>¿Frecuente? *</b>
                    </div>
                    <div class="col-md-3">	
                        <?php echo MakeSiNo("recurrente",(isset($row->recurrente))?$row->recurrente:NULL,array("class"=>"form-control","id"=>"recurrente","require"=>"require"));?>
                    </div>
				</div> 
                <div class="row form-group" id="contenedor_valor">                    
                    <div class="col-md-6 text-right">	
                        <b>Valor *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("salario_basico",$row,$placeholder='Valor');?>
                    </div>
                </div-->
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado del Perfil</b>
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
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		var obj					=	$("#recurrente");
		var contenedor_valor	=	$("#contenedor_valor");	
		if(obj.val()==1){
			contenedor_valor.show();	
		}else{
			contenedor_valor.hide();	
		}
		obj.change(function(){
			if($(this).val()==1){
				contenedor_valor.show();	
			}else{
				contenedor_valor.hide();	
			}	
		});		
	});
</script>
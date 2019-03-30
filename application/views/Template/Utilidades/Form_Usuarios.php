<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
	if(!centro_de_costos()){
		return;
	}
?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array('user_id' => (isset($row->user_id))?$row->user_id:'');
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<script>
	$( function() {
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#fecha_expedicion_documento_identidad" ).val("<?php echo (isset($row->fecha_expedicion_documento_identidad)?$row->fecha_expedicion_documento_identidad:null);?>");
		$( "#fecha_nacimiento" ).val("<?php echo (isset($row->fecha_nacimiento)?$row->fecha_nacimiento:null);?>");
		$( "#fecha_contratacion" ).val("<?php echo (isset($row->fecha_contratacion)?$row->fecha_contratacion:null);?>");
	});
</script>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información Básica Modelos</h3>
                    </div>
                </div>
                <div id="extra_datos">
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Primer Nombre *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("primer_nombre",$row,$placeholder='Primer Nombre',$require=true,"firstLetterText");?>
                        </div>
                    </div>                    
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Segundo Nombre</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("segundo_nombre",$row,$placeholder='Segundo Nombre',$require=false,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Primer Apellido *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("primer_apellido",$row,$placeholder='Primer Apellido',$require=false,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Segundo Apellido</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("segundo_apellido",$row,$placeholder='Segundo Apellido',$require=false,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Tipo de Documento *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php echo MakeTipoIdentificacion2("tipo_identificacion",(isset($row->tipo_identificacion))?$row->tipo_identificacion:NULL,array("class"=>"form-control"));?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>No. Documento *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("identificacion",$row,$placeholder='No. Documento',$require=false);?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Fecha Expedición *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("fecha_expedicion_documento_identidad",$row,$placeholder='AAAA-MM-DD',$require=false,"datepicker");?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Lugar Expedición *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php echo expedicion($row,"lugar_expedicion_documento_identidad",'Lugar de Expedición',$require=false, "firstLetterText");?>
                            <?php #set_input("lugar_expedicion_documento_identidad",$row,$placeholder='Lugar Expedición',$require=false);?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Fecha Nacimiento *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("fecha_nacimiento",$row,$placeholder='AAAA-MM-DD',$require=false,"datepicker");?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Lugar Nacimiento *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php echo expedicion($row,"lugar_nacimiento",'Lugar de Nacimiento',$require=false,"firstLetterText");?>
                            <?php #set_input("lugar_nacimiento",$row,$placeholder='Lugar Nacimiento',$require=false);?>
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
                    <div class="row form-group">
                        <div class="col-md-3 text-right">	
                            <b>Correo Electrónico *</b>
                        </div>
                        <div class="col-md-3">	
                            <input type="text" class="form-control" name="email" maxlength="100" value="<?php echo (isset($row->email))?$row->email:''?>" require  />
                        </div>
                        <div class="col-md-3 text-right">	
                            <b>Estado Civil</b>
                        </div>
                        <div class="col-md-3">	
                            <?php echo MakeEstadoCivil("estado_civil",(isset($row->estado_civil))?$row->estado_civil:NULL,array("class"=>"form-control"));?>
                        </div>
                    </div>
                    <div class="row form-group item">
                        <div class="col-md-12 text-center">
                            <h3>Parámetros Especiales</h3>
                        </div>
                    </div>
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
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		
		
		if($("#centro_de_costos").val()==''){
			$("#extra_datos").hide();	
		}
		$("#centro_de_costos").change(function(){
			var nrooms	=	$(this).find("option:selected").data("rooms");
			$("#room_transmision").attr("data-nrooms",nrooms);
			$("#room_transmision").html("");
			for (var i=1; i<=nrooms; i++) {
				$("#room_transmision").append("<option value='"+i+"'> Room "+i+"</option>");			
			}
			$("#room_transmision").append("<option value='1000000'> Satélite</option>");
			if($("#centro_de_costos").val()==''){
				$("#extra_datos").hide();	
			}else{
				$("#extra_datos").show();	
			}
		});		
	})
</script>
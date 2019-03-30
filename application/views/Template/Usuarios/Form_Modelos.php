<?php 
	if(!centro_de_costos()){
		return;
	}
?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$json		=	json_db(@$row->json);
if(!empty($row->id_empresa)){
	$id_empresa			=	@$row->id_empresa;
	$centro_de_costos	=	@$row->centro_de_costos;
}else{
	$id_empresa			=	$this->user->id_empresa;
	$centro_de_costos	=	$this->user->centro_de_costos;
}
$empresa	=	centrodecostos(@$id_empresa);
$centro_de_costos	=	centrodecostos(@$centro_de_costos);
$jempresa	=	json_db(@$empresa->json,"decode");
$data = @json_decode(get_form_control(base_url("Configuracion/tipoModelo"))[0]->data);
$tipoModelo = @$data->select_tipo_modelo;
$now = new DateTime('now');
$hidden 	= 	array('type'=>$this->uri->segment(3),'user_id' => (isset($row->user_id))?$row->user_id:'',"id_empresa" => $this->user->id_empresa,"redirect"=>base_url("Usuarios/Todos/".$this->uri->segment(3)),"fecha_creacion"=>$now->format('Y-m-d H:i:s'), "id_responsable"=>$this->user->user_id);
//>user->user_id;	
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<script>
	$( function() {
        var ano = (new Date).getFullYear();
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true ,yearRange: '1940:'});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#fecha_expedicion_documento_identidad" ).val("<?php echo (isset($row->fecha_expedicion_documento_identidad)?$row->fecha_expedicion_documento_identidad:null);?>");
		$( "#fecha_nacimiento" ).val("<?php echo (isset($row->fecha_nacimiento)?$row->fecha_nacimiento:null);?>");
		$( "#fecha_contratacion" ).val("<?php echo (isset($row->fecha_contratacion)?$row->fecha_contratacion:null);?>");
	});
</script>
<div class="container" style="margin-bottom:100px;">
	<input type="hidden" value="2" name="rol_id" />
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información básica modelos</h3>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Nombre Usuario *</b>
                    </div>
                    <div class="col-md-6">  
                       <?php 
                            if(empty($row)){$data = array("data-dependiente"=>"dependiente","data-action"=>base_url("Usuarios/SearchUser")); 
                            }else{
                                $data = "";
                            }    
                            set_input("nombre_usuario",$row,$placeholder='Nombre Usuario',$require=true,'',$data);
                        ?> 
                    </div>
                </div>
                <div class="row form-group" id="alert">
                    
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Tipo de Documento *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo MakeTipoIdentificacion2("tipo_identificacion",(isset($row->tipo_identificacion))?$row->tipo_identificacion:NULL,array("class"=>"form-control tipo_identificacion"));?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                        <b>Número de Documento *</b>
                    </div>
                    <div class="col-md-6 ">	
                        <?php 
                            set_input("identificacion",$row,$placeholder='Número de Documento',$require=true,'soloNumeros',$data);
                        ?>
                    </div>
                </div>
                <div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Lugar Expedición *</b>
                        </div>
                        <div class="col-md-6">  
                            <?php echo expedicion($row,"lugar_expedicion_documento_identidad",'Lugar de Expedición',$require=true, "firstLetterText");?>
                            <?php #set_input("lugar_expedicion_documento_identidad",$row,$placeholder='Lugar Expedición',$require=true);?>
                        </div>
                    </div>
                    <!--<div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Rol *</b>
                        </div>
                        <div class="col-md-6">	
                            Modelos
                        </div>
                    </div>-->
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
                                <?php set_input("primer_apellido",$row,$placeholder='Primer Apellido',$require=true,"firstLetterText");?>
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
                        <!--<div class="row form-group">
                            <div class="col-md-6 text-right">	
                                <b>Email Corporativo *</b>
                            </div>
                            <div class=" col text-left">	
                                <b><span id="email"><?php echo @$json->email?></span>@<?php if(@$jempresa->dominio!=''){echo @$jempresa->dominio;}else{echo 'dominio.com';}?></b>
                            </div>
                            <div class=" col-md-3  pl-0 ml-0">	
                                <input readonly="readonly" type="hidden" id="contenedor_email" name="json[email]"  placeholder="Dominio.com" value="<?php echo @$json->email?>"/>
                                <input readonly="readonly" type="hidden" class="form-control" name="json[dominio]"  placeholder="Dominio.com" value="<?php if(@$jempresa->dominio!=''){echo @$jempresa->dominio;}else{echo 'dominio.com';}?>"/>
                            </div>
                        </div>-->
                        <!--<div class="row form-group">                    
                            <div class="col-md-6 text-right">	
                                <b>Fecha Expedición *</b>
                            </div>
                            <div class="col-md-6">	
                                <?php set_input("fecha_expedicion_documento_identidad",$row,$placeholder='AAAA-MM-DD',$require=true,"datepicker");?>
                            </div>
                        </div>-->
                        <div class="row form-group">                    
                            <div class="col-md-6 text-right">	
                                <b>Fecha Nacimiento *</b>
                            </div>
                            <div class="col-md-6">	
                                <?php set_input("fecha_nacimiento",$row,$placeholder='AAAA-MM-DD',$require=true,"datepicker");?>
                            </div>
                        </div>
                        <div class="row form-group">                    
                            <div class="col-md-6 text-right">	
                                <b>Lugar Nacimiento *</b>
                            </div>
                            <div class="col-md-6">	
                                <?php echo expedicion($row,"lugar_nacimiento",'Lugar de Nacimiento',$require=true,"firstLetterText");?>
                                <?php #set_input("lugar_nacimiento",$row,$placeholder='Lugar Nacimiento',$require=true);?>
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
                                    <input type="text" id="cod_telefono" class="form-control col-md-4 salto soloNumeros" data-salto="telefono" name="cod_telefono" maxlength="3"  value="<?php echo (isset($row->cod_telefono))?$row->cod_telefono:''?>" require />
                                    <input id="telefono" data-salto="end" type="text" class="form-control col-md-8 soloNumeros" name="telefono"  maxlength="10"  value="<?php echo (isset($row->telefono))?$row->telefono:''?>" require />                            
                                </div>
                            </div>
                            <div class="col-md-3 text-right">   
                                <b>Número Fijo</b>
                            </div>
                            <div class="col-md-3">  
                                <div class="input-group input-group-sm">
                                    <input type="text" id="cod_otro_telefono" class="form-control col-md-4 salto soloNumeros" data-salto="otro_telefono" name="cod_otro_telefono" maxlength="3" value="<?php echo (isset($row->cod_otro_telefono))?$row->cod_otro_telefono:''?>" />
                                    <input id="otro_telefono" data-salto="end" type="text" class="form-control col-md-8 soloNumeros" name="otro_telefono"  maxlength="10" value="<?php echo (isset($row->otro_telefono))?$row->otro_telefono:''?>" />                            
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3 text-right">	
                                <b>Correo Electrónico *</b>
                            </div>
                            <div class="col-md-4">	
                                <input type="text" id="correo" data-url="<?php echo base_url("Usuarios/checkemail"); ?>" class="form-control" name="email" maxlength="100" value="<?php echo (isset($row->email))?$row->email:''?>" require  />
                            </div>
                            <div class="col-md-2 text-right">	
                                <b>Estado Civil</b>
                            </div>
                            <div class="col-md-3">	
                                <?php echo MakeEstadoCivil("estado_civil",(isset($row->estado_civil))?$row->estado_civil:NULL,array("class"=>"form-control","id"=>"estado_civil"));?>
                            </div>
                        </div>
                        <div class="row form-group">                    
                            <div class="col-md-6 text-right">   
                                <b>Dirección  *</b>
                            </div>
                            <div class="col-md-6">  
                                <?php echo set_input("direccion",$row,$placeholder='Dirección',$require=true,"firstLetterText");?>
                            </div>
                        </div>
                        <div class="row form-group">                    
                            <div class="col-md-6 text-right">   
                                <b>Ciudad *</b>
                            </div>
                            <div class="col-md-6">  
                                <?php echo ciudad($row,"ciudad","Ciudad");?>
                            </div>
                        </div>
                        <div class="row form-group">                    
                            <div class="col-md-6 text-right">   
                                <b>Departamento *</b>
                            </div>
                            <div class="col-md-6">  
                                <?php echo set_input("departamento",$row,$placeholder='departamento',$require=true,"firstLetterText");?>
                            </div>
                        </div>
                        <div class="row form-group">                    
                            <div class="col-md-6 text-right">   
                                <b>Pais *</b>
                            </div>
                            <div class="col-md-6">  
                                <?php echo set_input("pais",$row,$placeholder='pais',$require=true,"firstLetterText");?>
                            </div>
                        </div>
                        <div class="row form-group item">
                            <div class="col-md-12 text-center">
                                <h3>Parámetros Especiales</h3>
                            </div>
                        </div>
                            <div class="row form-group">
                                <div class="col-md-3 text-right">   
                                    <b>Turno de Transmisión *</b>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <?php 
                                            $this->empresa      =   $this->Usuarios->get_empresa(@$this->user->centro_de_costos);
                                            //pre($this->empresa);
                                            if($this->empresa->turno_manama==1){
                                        ?>  
                                            <div class="col-md-3 text-center">
                                                <h6 class="">Mañana</h6>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="turno_manama" class="custom-control-input " name="turno_manama" value="1" <?php echo (isset($row->turno_manama)&& $row->turno_manama==1)?'checked="checked"':''?>>
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                        <?php       
                                            }
                                        ?>
                                        <?php 
                                            if($this->empresa->turno_tarde==1){
                                        ?>  
                                            <div class="col-md-3 text-center">
                                                <h6 class="">Tarde</h6>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="turno_tarde" class="custom-control-input " name="turno_tarde" value="1" <?php echo (isset($row->turno_tarde)&& $row->turno_tarde==1)?'checked="checked"':''?>>
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                        <?php       
                                            }
                                        ?>
                                        <?php 
                                            if($this->empresa->turno_noche==1){
                                        ?>  
                                            <div class="col-md-3 text-center">
                                                <h6 class="">Noche</h6>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="turno_noche" class="custom-control-input " name="turno_noche" value="1" <?php echo (isset($row->turno_noche)&& $row->turno_noche==1)?'checked="checked"':''?>>
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                        <?php       
                                            }
                                        ?>
                                        <?php 
                                            if($this->empresa->turno_intermedio==1){
                                        ?>  
                                            <div class="col-md-3 text-center">
                                                <h6 class="">Intermedio</h6>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="turno_intermedio" class="custom-control-input " name="turno_intermedio" value="1" <?php echo (isset($row->turno_intermedio)&& $row->turno_intermedio==1)?'checked="checked"':''?>>
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </div>
                                        <?php       
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div> 
                        <?php 
                            if($this->centro_costo || $this->user->centro_de_costos){
                                if(is_object($this->centro_costo)){
                        ?>
                                    <div class="row form-group item">
                                        <div class="col-md-6 text-right">	
                                            <b>Centro de Costos</b>
                                        </div>
                                        <div class="col-md-6">	
                                            <?php  echo MakeListCentrosCostosAsociados("centro_de_costos",@$row->centro_de_costos,array("class"=>"form-control","require"=>"require","id"=>"centro_de_costos"),$this->centro_costo);?>            	
                                        </div>
                                    </div>
                                <?php 
                                }else{
                                    //set_input_hidden("centro_de_costos","centro_de_costos",$this->user->centro_de_costos);	
                                }
                            }
                        ?>
                        <?php 
                            if(1==1){?>
                                
                                <div class="row form-group item">
                                    <div class="col-md-6 text-right">	
                                        <b>Room de Transmisión *</b>
                                    </div>
                                    <div class="col-md-6">
                                        <?php 
                                            if(!empty($row->centro_de_costos)){
                                                $nrooms=nrooms($row->centro_de_costos);
                                            }else{
                                                $nrooms=nrooms($this->user->centro_de_costos);	
                                            }
                                            ?>
                                        <select class="form-control rooms" id="room_transmision" name="room_transmision" data-ct="<?php echo $this->user->centro_de_costos;?>" data-nrooms="<?php echo $nrooms;?>" data-main="<?php echo @$row->room_transmision?>"></select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 text-right">   
                                        <b>Sucursal *</b>
                                    </div>
                                    <div class="col-md-6">  
                                        <?php 
                                            echo MakeSucursal($this->user->id_empresa,"centro_de_costos",$this->user->centro_de_costos,array("class"=>"form-control"),true);
                                        ?>
                                    </div>
                                </div>
                                <div class="row form-group item">
                                    <div class="col-md-6 text-right">	
                                        <b>Tipo de Contratación *</b>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo MakeTipoContratacion("tipo_contratacion",(isset($row->tipo_contratacion))?$row->tipo_contratacion:NULL,array("class"=>"form-control","id"=>"tipo_contratacion"));?>
                                    </div>
                                </div>
                                <div class="row form-group">                    
                                    <div class="col-md-6 text-right">	
                                        <b>Fecha de Contratación *</b>
                                    </div>
                                    <div class="col-md-6">	
                                        <?php set_input("fecha_contratacion",$row,$placeholder='Fecha de Contratación',$require=true,"datepicker");?>
                                    </div>
                                </div>
                                <div class="row form-group">                    
                                    <div class="col-md-6 text-right">   
                                        <b>Tipo Modelo *</b>
                                    </div>
                                    <div class="col-md-6">  
                                        <?php echo MakeTipoModelo("tipo_modelo",@$tipoModelo,@$row->tipo_modelo,array("class"=>"form-control","id"=>"tipo_modelo"));?>
                                    </div>
                                </div>
                                <!--div class="row form-group">                    
                                    <div class="col-md-6 text-right">	
                                        <b>Escala de Pago *</b>
                                    </div>
                                    <div class="col-md-6">	
                                        <?php echo get_escala_pagos((isset($row->tipo_contratacion))?$row->tipo_contratacion:NULL,array("class"=>"form-control"));?>
                                    </div>
                                </div-->
                                <div class="row form-group">                    
                                    <div class="col-md-6 text-right">	
                                        <b>Cargo *</b>
                                    </div>
                                    <div class="col-md-6">	
                                        <?php set_input("cargo",$row,$placeholder='Cargo',$require=true,"firstLetterText");?>
                                    </div>
                                </div>                                                      
                        <?php 
                            }
                        ?>
                        <div class="row form-group">                    
                            <div class="col-md-6 text-right">   
                                <b>Monitor *</b>
                            </div>
                            <div class="col-md-6">  
                                <?php echo MakeMonitores($this->user->id_empresa,@$row->monitor); ?>
                            </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-md-6 text-right">	
                                <b>Ciclo de Pago *</b>
                            </div>
                            <div class="col-md-3">	
                                <?php 
                                        echo MakeCiclosPagos("id_forma_pago",(isset($row->id_forma_pago))?$row->id_forma_pago:NULL,array("class"=>"form-control","id"=>"id_forma_pago"),$this->Usuarios->get_FormasPagos());
                                        set_input_hidden("estado","",1);

                                ?>
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
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
        solonumeros(".soloNumeros");		
		var sucursal		=	"<?php print(strtolower($centro_de_costos->abreviacion));?>";
		
		makemail($("#primer_nombre").val()+$("#primer_apellido").val());
		
		$("#primer_nombre").keyup(function(){
			 makemail($(this).val()+$("#primer_apellido").val());
		})
		$("#primer_apellido").keyup(function(){
			 makemail($("#primer_nombre").val()+$(this).val());
		})
	
    	function makemail(data){
    		data	=	data.toLowerCase();
    		data	=	getCleanedString(data);
    		$("#contenedor_email").val(data);
    		$("#email").html(data+'.'+sucursal);
    	}

    });
</script>
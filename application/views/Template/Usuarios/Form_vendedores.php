<?php
  $modulo   = $this->ModuloActivo;
  if($this->uri->segment(5) == "Activos"){
    $row    = $this->$modulo->result["Activos"][0];
  }else{
    $row    = $this->$modulo->result["Inactivos"][0];
  }
   
   $hidden   =   array('user_id' => (isset($row->user_id))?$row->user_id:'','id' =>(isset($row->id))?$row->id:'',);
   echo form_open(current_url(),array('ajaxing' => 'true'),$hidden); 
   ?>
   <div class="container mt-4">

<!-- SmartWizard html -->
<div id="smartwizard">
    <ul class="d-flex justify-content-around">
        <li><a href="#step-1"><i class="fas fa-user"></i><br /><small>Información Basica</small></a></li>
        <li><a href="#step-2"><i class="fas fa-comment"></i><br /><small>Contacto</small></a></li>
        <li><a href="#step-3"><i class="fas fa-cogs"></i><br /><small>Configuración</small></a></li>
    </ul>

    <div>
        <div id="step-1" class="">
          <script>
            $( function() {
              $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
              $( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
              $( "#fecha_matricula" ).val("<?php echo  @$row->fecha_matricula;?>");
              $('[name="documento"]').SoloNumeros();
              $('[name="telefono"]').SoloNumeros();
              $('[name="celular"]').SoloNumeros();
            });
          </script>
          <div class="container" style="margin-bottom:100px;">
            <div class="row justify-content-md-center">
              <div class="col-md-8">
                  <div class="form">
                  <div class="row form-group">
                                <div class="col-md-6">
                                  <label for="username">Nombre Usuario *</label>  
                                  
                                  <?php    
                                      if(empty($row)){$data = array("data-dependiente"=>"dependiente","data-action"=>base_url("Usuarios/SearchUser")); 
                                      }else{
                                          $data = "";
                                      }    
                                    set_input("username",@$row,$placeholder='Nombre Usuario',$require=true,'',array("id"=>"username")); ?>
                                  <?php if(!isset($row)){?>
                                    <input type="hidden" id="url" value="<?php echo base_url() ?>">
                                   <?php   }?>
                                
                                </div>
                                <div class="col-md-6">
                                  <label for="rol_id">Rol *</label>  
                                  <?php  
                                  echo MakeRoles("rol_id",(isset($row))?$row->rol_id:17,array("class"=>"form-control","id"=>"rol_id","require"=>"require"));
                                    ?> 
                                </div>
                            </div> 

                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="regimen_empresa">Regimen Empresa *</label>  
                          <?php  
                            echo MakeSelect("regimen_empresa",(isset($row))?$row->regimen_empresa:NULL,array("class"=>"form-control","require"=>"require"),array(""=>"Seleccione",'Regimen Simplificado'=> 'Régimen Simplificado','Regimen Común' => 'Regimen Común'));
                          ?> 
                        </div>
                        <div class="col-md-6">
                          <label for="naturaleza">Naturaleza *</label>  
                          <?php  
                              echo MakeSelect("naturaleza",@$row->naturaleza,array("class"=>"form-control", "id"=>"naturaleza" ,"require"=>"require"),array(""=>"Seleccione",'PERSONA NATURAL' => 'Persona Natural','PERSONA JURÍDICA'  => 'Persona Jurídica'));
                          ?> 
                        </div>
                    </div>
                    
                    <div class="row form-group">
                    <div class="col-md-6">
                          <label for="tipo_identificacion">Tipo de identificacion *</label>
                            <?php  
                              echo MakeTipoIdentidad("tipo_identificacion",(isset($row->tipo_identificacion))?$row->tipo_identificacion:NULL,array("class"=>"form-control target","id"=>"tipo_identificacion","pgrw-dependency"=>"{option:'NIT',primary:'identificacion',secundary:'identificacion_ext'}"),array(''=> 'Seleccione','NIT'=>'NIT','CÉDULA CIUDADANÍA'=>'Cédula Ciudadanía','PASAPORTE'=>'Pasaporte'));
                            ?>
                        </div>
                        <div class="col-md-4">
                          <label for="numero_identificacion">Numero de identificación *</label>  
                            <input type="text" class="form-control col-md-12" name="numero_identificacion" id="identificacion"  placeholder="Número de Identificación" maxlength="12" value="<?php echo (isset($row->numero_identificacion))?$row->numero_identificacion:''?>" <?php echo (isset($row->identificacion))?'readonly="readonly"':''?> require />
                        </div>
                        <div class="col-md-2 digito-verificacion">
                          <label for="declara_renta">Digito verificacion *</label>  
                         <input type="text" class="form-control col-md-12" name="digito_verificacion" id="identificacion_ext"  placeholder="DV" maxlength="1" value="<?php echo (isset($row->identificacion_ext))?$row->identificacion_ext:'1'?>"/>
                        </div>
                    </div>
                    <div class="row form-group">
                    <div class="col-md-6">
                        <label for="nombre">Nombre representante legal *</label>  
                        <input typpe="text" class="form-control" name="nombre"  placeholder="Nombre Representante Legal" value="<?php echo (isset($row->nombre))?$row->nombre:''?>" require  />
                    </div>
                    <div class="col-md-6">
                        <label for="nombre_comercial">Nombre Comercial *</label>  
                        <input type="text" class="form-control col-md-12" name="nombre_comercial" id="nombre_comercial"  placeholder="Nombre Comercial" value="<?php echo @$row->nombre_comercial; ?>" />
                     </div> 
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="documento">Documento representante legal *</label>  
                            <input type="text" class="form-control col-md-12" name="documento" id="documento"  placeholder="Documento representante legal" value="<?php echo @$row->documento; ?>" />
                        </div>
                        <div class="col-md-6">
                          <label for="ciudad_expedicion">Ciudad de expedicion *</label>  
                            <?php echo expedicion(@$row->ciudad_expedicion,"ciudad_expedicion",'Ciudad de Expedición',$require=true);?>
                        </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div id="step-2" class="">
          <div class="container" style="margin-bottom:100px;">
            <div class="row justify-content-md-center">
              <div class="col-md-8">
                  <div class="form">
                    <div class="row form-group">
                      <div class="col-md-6">
                        <label for="ciudad">Ciudad *</label>  
                    <?php echo ciudad(@$row->ciudad,"ciudad","Ciudad");?> 
                      </div>
                      <div class="col-md-6">
                        <label for="direccion">Dirección *</label>  
                        <?php echo set_input("direccion",@$row->direccion,$placeholder='Dirección',$require=true,"firstLetterText");?> 
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-6">
                        <label for="telefono">Telefono *</label>  
                        <?php    
                          set_input("telefono",@$row->telefono,$placeholder='Telefono',$require=true,"",array("id"=>"telefono"));
                        ?> 
                      </div>
                      <div class="col-md-6">
                        <label for="celular">Celular *</label>  
                        <?php    
                          set_input("celular",@$row->celular,$placeholder='Celular',$require=true); 
                        ?>  
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-6">
                        <label for="email">Email *</label>  
                        <?php    
                          set_input("email",@$row->email,$placeholder='Email',$require=true,"",array("id"=>"email"));
                        ?> 
                      </div>
                      <div class="col-md-6">
                        <label for="cargo">Cargo *</label>  
                       <?php    
                        echo  cargo(@$row->cargo,'cargo',$placeholder='Cargo',$require=true);
                        ?> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>   
        </div>
        <div id="step-3" class="">
          <div class="container" style="margin-bottom:100px;">
            <div class="row justify-content-md-center">
              <div class="col-md-8">
                  <div class="form">
                    <div class="row form-group">
                      <div class="col-md-6">
                        <label for="pagina_web">pagina web *</label>  
                        <?php echo set_input("pagina_web",@$row->pagina_web,$placeholder='Pagina web',$require=true,"firstLetterText");?> 
                      </div>
                      <div class="col-md-6">
                        <label for="divisa_oficial">Divisa oficial *</label>  
                        <?php echo MakeDivisa("divisa_oficial",@$row->divisa_oficial,array("class"=>"form-control"));?> 
                      </div>
                    </div>
                    <div class="row form-group">
                     <!-- <div class="col-md-12">
                        <label for="email">Email *</label>  
                        <?php    
                          set_input("email",$row,$placeholder='Email',$require=true);
                        ?> 
                      </div>-->
                    </div>
                  </div>
                </div>
              </div>
         
            </div> 
           
        </div>
        <div id="step-4" class="">
            <h3 class="border-bottom border-gray pb-2">Step 4 Content</h3>
            <div class="card">
                <div class="card-header">My Details</div>
                <div class="card-block p-0">
                
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo form_close();?>
</div><!--fin samartwizard -->    

</div><!--fin container -->      
<script>
	$(document).ready(function(){
        solonumeros(".soloNumeros");
        $('#tipo_identificacion').change(function(){
            var tipo_persona = $('#tipo_persona').val();
            if($(this).val() == "NIT" && tipo_persona == "PERSONA JURÍDICA"){
            }else{
                $('#tipo_identificacion').find('option').show();
            }
        });
        $('#identificacion').keyup(function(event) {
            $('#identificacion_ext').show();
            CalcularDv();
        });
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
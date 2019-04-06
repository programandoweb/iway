<?php
  $modulo   = $this->ModuloActivo;
  if($this->uri->segment(4) == "Activos"){
    $row    = $this->$modulo->result["Activos"][0];
  }else{
    $row    = $this->$modulo->result["Inactivos"][0];
  }
  //$json   = json_db(@$row->json,"decode");
  //pre($row); 
  //pre($this->user);
  

  $hidden   =   array('user_id' => (isset($row->user_id))?$row->user_id:'','empresa_id' =>(isset($row->id))?$row->id:'',);
  echo form_open(current_url(),array('ajaxing' => 'true'),$hidden); 
?>
    <div class="container mt-4">

        <!-- SmartWizard html -->
        <div id="smartwizard">
            <ul class="d-flex justify-content-around">
                <li><a href="#step-1"><i class="fas fa-user"></i><br /><p style="margin-top:10px;">Informacón</p> <p style="margin-top:-10px;">Básica</p></a></li>
                <li><a href="#step-2"><i class="fas fa-comment"></i><br /><p style="margin-top:10px;">Contáctos</p></a></li>
                <li><a href="#step-3"><i class="fas fa-cogs"></i><br /><p style="margin-top:10px;">Configuracíón</p></a></li>
            </ul>
            <div>
                <div id="step-1" class="">
                  <script>
                    $( function() {
                    
                      $.datepicker.setDefaults($.datepicker.regional['es']);
                      $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true, maxDate: '+0d'});
                      $( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
                      $( "#fecha_matricula" ).val("<?php echo  @$row->fecha_matricula;?>");
                      $('[name="documento"]').SoloNumeros();
                      $('[name="telefono"]').SoloNumeros();
                      $('[name="celular"]').SoloNumeros();
                    });
                  </script>
                  <div class="container" style="margin-bottom:20px;">
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
                             // echo MakeRoles("rol_id",(isset($row))?$row->rol_id:2,array("class"=>"form-control","id"=>"rol_id","require"=>"require"));
                             echo MakeSelect("rol_id",(isset($row))?$row->regimen_empresa:NULL,array("class"=>"form-control","require"=>"require"),array(2=>"Empresa"));
                                    ?> 
                                </div>
                            </div>
                            <div class="row form-group">
                            <div class="col-md-6">
                                 <label for="primer_nombre">Primer nombre *</label> 
                                <?php echo set_input("primer_nombre",@$row->primer_nombre,'Primer nombre',$require=true,"",array("id"=>"primer_nombre")); ?> 
                              </div>
                              <div class="col-md-6">
                                 <label for="segundo_nombre">Segundo nombre *</label> 
                                    <?php echo set_input("segundo_nombre",@$row->segundo_nombre,'Segundo nombre',$require=false,"",array("id"=>"segundo_nombre")); ?> 
                               </div>
                            </div>
                            <div class="row form-group">
                            <div class="col-md-6">
                                 <label for="primer_apellido">Primer apellido *</label> 
                                  <?php echo set_input("primer_apellido",@$row->primer_nombre,'Primer apellido',$require=true,"",array("id"=>"primer_apellido")); ?> 
                             </div>
                             <div class="col-md-6">
                                     <label for="segundo_apellido">Segundo apellido *</label> 
                                   <?php echo set_input("segundo_apellido",@$row->segundo_apellido,'Segundo apellido',$require=false,"",array("id"=>"segundo_apellido")); ?> 
                             </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col-md-6">
                                  <label for="regimen_empresa">Regimen Empresa *</label>  
                                  <?php  
                                    echo MakeSelect("regimen_empresa",(isset($row))?$row->regimen_empresa:NULL,array("class"=>"form-control", "id"=>"regimen_empresa", "require"=>"require","pgrw-dependency"=>"{generate:'Responsable de IVA (RC)',options:{input1:{name:'naturaleza',settrue:'PERSONA JURÍDICA',setfalse:'PERSONA NATURAL'},input2:{name:'declara_renta',settrue:1,setfalse:0},input3:{name:'tipo_identificacion',settrue:6,setfalse:3}}}"),array(""=>"Seleccione",'No responsable de IVA (RS)'=> 'No responsable de IVA (RS)','Responsable de IVA (RC)' => 'Responsable de IVA (RC)'));
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
                                  <label for="fecha_matricula">Fecha de matricula *</label>  
                                    <?php set_input("fecha_matricula",@$row->fecha_matricula,$placeholder='AAAA-MM-DD',$require=true,"datepicker",array("id"=>"fecha_matricula"));?> 
                                </div>
                                <div class="col-md-6">
                                  <label for="declara_renta">Declara renta *</label>  
                                    <?php echo MakeSiNo("declara_renta",@$row->declara_renta,array("class"=>"form-control","id"=>"declara_renta"));?> 
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                  <label for="profijo_documento">Prefijo documentos *</label>  
                                    <?php set_input("prefijo_documento",@$row->prefijo_documento,$placeholder='Prefijo Documentos',$require=true,"MayusculasTodas",array("id"=>"PrefijoDocumentos","maxlength"=>3));?> 
                                </div>
                                <div class="col-md-6">
                                  <label for="tipo_identificacion">Tipo de identificacion *</label>
                                    <?php  
                                      echo MakeTipoIdentidad("tipo_identificacion",(isset($row->tipo_identificacion))?$row->tipo_identificacion:NULL,array("class"=>"form-control target","id"=>"tipo_identificacion","pgrw-dependency"=>"{option:'NIT',primary:'identificacion',secundary:'identificacion_ext'}"),array(''=> 'Seleccione','NIT'=>'NIT','CÉDULA CIUDADANÍA'=>'Cédula Ciudadanía','PASAPORTE'=>'Pasaporte'));
                                    ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-9">
                                  <label for="numero_identificacion">Numero de identificación *</label>  
                                    <input type="text" class="form-control col-md-12" name="numero_identificacion" id="identificacion"  placeholder="Número de Identificación" maxlength="12" value="<?php echo (isset($row->numero_identificacion))?$row->numero_identificacion:''?>" <?php echo (isset($row->identificacion))?'readonly="readonly"':''?> require />
                                </div>
                                <div class="col-md-3 digito-verificacion">
                                  <label for="declara_renta">Digito verificacion *</label>  
                                 <input type="text" class="form-control col-md-12" name="digitos_verificacion" id="identificacion_ext"  placeholder="DV" maxlength="1" value="<?php echo (isset($row->digitos_verificacion))?$row->digitos_verificacion:'0'?>"/>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                  <label for="numero_identificacion">Nombre legal *</label>  
                                    <input type="text" class="form-control col-md-12" name="nombre_legal" id="nombre_legal"  placeholder="Nombre Legal"  value="<?php echo (isset($row->nombre_legal))?$row->nombre_legal:''?>" <?php echo (isset($row->identificacion))?'readonly="readonly"':''?> require />
                                </div>
                                <div class="col-md-6">
                                  <label for="nombre_comercial">Nombre Comercial *</label>  
                                    <input type="text" class="form-control col-md-12" name="nombre_comercial" id="nombre_comercial"  placeholder="Nombre Comercial" value="<?php echo @$row->nombre_comercial; ?>" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                  <label for="nombre">Nombre representante legal *</label>  
                                    <input typpe="text" class="form-control" name="nombre"  placeholder="Nombre Representante Legal" value="<?php echo (isset($row->primer_nombre))?$row->primer_nombre:''?>" require  />
                                </div>
                                <div class="col-md-6">
                                  <label for="documento">Documento representante legal *</label>  
                                    <input type="text" class="form-control col-md-12" name="documento" id="documento"  placeholder="Documento representante legal" value="<?php echo @$row->documento; ?>" />
                                </div>
                            </div>
                            
                            <div class="row form-group">
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
                  <div class="container" style="margin-bottom:20px;">
                    <div class="row justify-content-md-center">
                      <div class="col-md-8">
                          <div class="form">
                            <div class="row form-group">
                              <div class="col-md-6">
                                <label for="ciudad">Ciudad empresa *</label>  
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
                                  set_input("celular",@$row->celular,$placeholder='Celular',$require=true,'', array("id"=>"Celular","maxlength"=>10)); 
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
                                <label for="persona_contacto">Persona de contacto *</label>  
                               <?php    
                                echo  set_input("persona_contacto",@$row->persona_contacto,$placeholder='Persona de contacto',$require=true,"firstLetterText");
                                ?> 
                              </div>
                              
                              <!--<div class="col-md-6">
                                <label for="cargo">Cargo *</label>  
                               <?php    
                                echo  cargo(@$row->cargo,'cargo',$placeholder='Cargo',$require=true);
                                ?> 
                              </div>-->
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>   
                </div>
                <div id="step-3" class="">
                  <div class="container" style="margin-bottom:20px;">
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
                            <div class="col-md-6">
                                  <label for="documento_moneda_extranjera">Documento moneda extranjera*</label>  
                                    <?php echo MakeSiNo("documento_moneda_extranjera",@$row->documento_moneda_extranjera,array("class"=>"form-control"));?> 
                                </div>
                                <div class="col-md-6">
                                  <label for="demo">Demo*</label>  
                                    <?php echo MakeSiNo("demo",@$row->demo,array("class"=>"form-control"));?> 
                                </div>
                                
                            </div>
                            <div class="row form-group">
                            <div class="col-md-6">
                                  <label for="ciudad_expedicion">Descripcion *</label>  
                                  <input type="text" class="form-control col-md-12" name="descripcion_cliente" id="descripcion_cliente"  placeholder="Descripcion" value="<?php echo @$row->descripcion_cliente; ?>" />
                                </div>
                            
                            <div class="col-md-6">
                                  <label for="documento_moneda_extranjera">Estado*</label>  
                                  <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                                </div>
                              
                                
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
                          <table class="table">
                              <tbody>
                                  <tr> <th>Name:</th> <td>Tim Smith</td> </tr>
                                  <tr> <th>Email:</th> <td>example@example.com</td> </tr>
                              </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close();?>
    <div class="container">
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title " style="float:right; position: absolute;">Atención</h4>
        </div>
        <div class="modal-body">
          <hr>
          <p id="text-alert"></p>
          <hr>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
  <script>
    $(document).ready(function(){
      $(".Guardar").click(function(){
        //alert('hola mundo')
      });
    });

        
  </script>
  <style>

  </style>
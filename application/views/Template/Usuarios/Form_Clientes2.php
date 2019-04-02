<?php
$modulo   = $this->ModuloActivo;
$row      = $this->$modulo->result[0];
/*if($this->uri->segment(5) == "Activos"){
  $row    = $this->$modulo->result["Activos"][0];
}else{
  $row    = $this->$modulo->result["Inactivos"][0];
}*/
$hidden   =   array('user_id' => (isset($row->user_id))?$row->user_id:'');
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden); 
?>
 <div class="mt-4">

<!-- SmartWizard html -->
<div id="smartwizard">
    <ul class="d-flex justify-content-around">
    <li><a href="#step-1"><i class="fas fa-user"></i><br /><p style="margin-top:10px;">Informacón</p> <p style="margin-top:-10px;">Básica</p></a></li>
    <li><a href="#step-2"><i class="fas fa-comment"></i><br /><p style="margin-top:10px;">Contactos</p></a></li>
     <li><a href="#step-3"><i class="fas fa-cogs"></i><br /><p style="margin-top:10px;">Configuracíon</p></a></li>
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
                echo MakeRoles("rol_id",@$row->rol_id,array("class"=>"form-control","id"=>"rol_id","require"=>"require"));
                  ?> 
              </div>
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
              <div class="col-md-6">
                <label for="tipo_identificacion">Tipo de identificacion *</label>
                  <?php  
                    echo MakeTipoIdentidad("tipo_identificacion",@$row->tipo_identificacion,array("class"=>"form-control target","id"=>"tipo_identificacion","pgrw-dependency"=>"{option:'NIT',primary:'identificacion',secundary:'identificacion_ext'}"),array(''=> 'Seleccione','NIT'=>'NIT','CÉDULA CIUDADANÍA'=>'Cédula Ciudadanía','PASAPORTE'=>'Pasaporte'));
                  ?>
              </div>
              <div class="col-md-4">
                <label for="numero_identificacion">Numero de identificación *</label>  
                  <input type="text" class="form-control col-md-12" name="numero_identificacion" id="numero_identificacion"  placeholder="Número de Identificación" maxlength="12" value="<?php echo @$row->numero_identificacion; ?>" <?php echo (isset($row->identificacion))?'readonly="readonly"':''?> require />
              </div>
              <div class="col-md-2 digito-verificacion">
                <label for="declara_renta">Digito verificacion *</label>  
               <input type="text" class="form-control col-md-12" name="digito_verificacion" id="identificacion_ext"  placeholder="DV" maxlength="1" value="<?php echo (isset($row->identificacion_ext))?$row->identificacion_ext:'1'?>"/>
              </div>
              <div class="col-md-6">
                  <label for="nombre">Nombre representante legal *</label>  
                  <input typpe="text" class="form-control" name="nombre"  placeholder="Nombre Representante Legal" value="<?php echo (isset($row->nombre))?$row->nombre:''?>" require  />
              </div>
              <div class="col-md-6">
                  <label for="nombre_comercial">Nombre Comercial *</label>  
                  <input type="text" class="form-control col-md-12" name="nombre_comercial" id="nombre_comercial"  placeholder="Nombre Comercial" value="<?php echo @$row->nombre_comercial; ?>" />
              </div> 
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
        <div id="step-2" class="">
          <div class="container" style="margin-bottom:100px;">
            <div class="row justify-content-md-center">
              <div class="col-md-6">
                <label for="ciudad_user">Ciudad *</label>  
            <?php echo ciudad(@$row->ciudad_user,"ciudad_user","Ciudad");?> 
              </div>
              <div class="col-md-6">
                <label for="direccion_user">Dirección *</label>  
                <?php echo set_input("direccion_user",@$row->direccion_user,$placeholder='Dirección',$require=true,"firstLetterText");?> 
              </div>
              <div class="col-md-6">
                <label for="telefono_user">Telefono *</label>  
                <?php    
                  set_input("telefono_user",@$row->telefono_user,$placeholder='Telefono',$require=true,"",array("id"=>"telefono"));
                ?> 
              </div>
              <div class="col-md-6">
                <label for="celular_user">Celular *</label>  
                <?php    
                  set_input("celular_user",@$row->celular_user,$placeholder='Celular',$require=true); 
                ?>  
              </div>
              <div class="col-md-6">
                <label for="email_user">Email *</label>  
                <?php    
                  set_input("email_user",@$row->email_user,$placeholder='Email',$require=true,"",array("id"=>"email"));
                ?> 
              </div>
              <div class="col-md-6">
                <label for="cargo">Cargo *</label>  
               <?php    
                echo  cargo(@$row->cargo,'cargo',$placeholder='Cargo',$require=true);
                ?> 
              </div>
              <div class="col-md-6">
                <label for="centro_de_costos">Centro de costos *</label>  
                <?php    
                  set_input("centro_de_costos",@$row->centro_de_costos,$placeholder='centro de costos',$require=true,"",array("id"=>"email"));
                ?> 
              </div>
            </div>
          </div>   
        </div>
        <div id="step-3" class="">
          <div class="container" style="margin-bottom:100px;">
            <div class="row justify-content-md-center">
              <div class="col-md-6">
                <label for="pagina_web">pagina web *</label>  
                <?php echo set_input("pagina_web",@$row->pagina_web,$placeholder='Pagina web',$require=true,"firstLetterText");?> 
              </div>
              <div class="col-md-6">
                <label for="divisa_oficial">Divisa oficial *</label>  
                <?php echo MakeDivisa("divisa_oficial",@$row->divisa_oficial,array("class"=>"form-control"));?> 
              </div>
             <!-- <div class="col-md-12">
                <label for="email">Email *</label>  
                <?php    
                  set_input("email_user",$row,$placeholder='Email',$require=true);
                ?> 
              </div>-->
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
     
     
    
    </div><!--fin samartwizard -->    

</div><!--fin container -->      
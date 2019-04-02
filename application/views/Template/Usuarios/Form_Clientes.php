<?php
$modulo   = $this->ModuloActivo;
$row      = $this->$modulo->result[0];
/*if($this->uri->segment(5) == "Activos"){
  $row    = $this->$modulo->result["Activos"][0];
}else{
  $row    = $this->$modulo->result["Inactivos"][0];
}*/
//pre(get_estadoCivil());
//pre($this->uri->segment(3));
if($this->uri->segment(3)=='Asociado'){
$campos= '["primer_nombre","segundo_nombre","primer_apellido","segundo_apellido","username","rol_id","fecha_nacimiento",
"lugar_nacimiento","ciudad_expedicion","ciudad_user","telefono_user","celular_user","email_user","cargo","salario_basico",
 "EPS", "ARP","pension","cesantias","forma_de_pago","tipo_de_contratacion","documento_moneda_extranjera"]';
}else if ($this->uri->segment(3)=='Cliente'){
  $campos= '["primer_nombre","segundo_nombre","primer_apellido","segundo_apellido","username","rol_id","fecha_nacimiento",
  "lugar_nacimiento","ciudad_expedicion","ciudad_user","telefono_user","celular_user","email_user","cargo","salario_basico",
   "EPS", "ARP","pension","cesantias","forma_de_pago","tipo_de_contratacion","documento_moneda_extranjera"]';
}else if ($this->uri->segment(3)=='Proveedores'){
  $campos= '["tipo_proveedor","regimen_empresa","naturaleza","tipo_identificacion","numero_identificacion", 
  "digito_verificacion", "nombre_legal","nombre_comercial", "nombre","ciudad_user","ciudad_expedicion","telefono_user","celular_user",
  "email_user","persona_de_contacto","cargo","pagina_web","documento_moneda_extranjera","credito","dias_credito","cupo_credito",
   "banco","tipo_de_cuenta","numero_de_cuenta"]';
}else if($this->uri->segment(3)=='Medicos'){

}
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
              $.datepicker.setDefaults($.datepicker.regional['es']);
              $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,  maxDate: '+0d'});
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
                <label for="primer_nombre">Primer nombre *</label> 
                <?php echo set_input("primer_nombre",@$row->primer_nombre,'Primer nombre',$require=true,"",array("id"=>"primer_nombre")); ?> 
              </div>
              <div class="col-md-6">
                <label for="segundo_nombre">Segundo nombre *</label> 
                <?php echo set_input("segundo_nombre",@$row->segundo_nombre,'Segundo nombre',$require=false,"",array("id"=>"segundo_nombre")); ?> 
              </div>
              <div class="col-md-6">
                <label for="primer_apellido">Primer apellido *</label> 
                <?php echo set_input("primer_apellido",@$row->primer_nombre,'Primer apellido',$require=true,"",array("id"=>"primer_apellido")); ?> 
              </div>
              <div class="col-md-6">
                <label for="segundo_apellido">Segundo apellido *</label> 
                <?php echo set_input("segundo_apellido",@$row->segundo_apellido,'Segundo apellido',$require=false,"",array("id"=>"segundo_apellido")); ?> 
              </div>
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
                <label for="nombre_legal">nombre legal *</label> 
                <?php echo set_input("nombre_legal",@$row->nombre_legal,'Nombre legal',$require=true,"",array("id"=>"Nombre_legal")); ?> 
              </div>
              <div class="col-md-6">
                <label for="fecha_nacimiento">Fecha nacimiento *</label> 
                <?php echo set_input("fecha_nacimiento",@$row->fecha_nacimiento,'AAAA/MM//DD',$require=true,"form-control datepicker",array("id"=>"fecha_nacimiento")); ?> 
              </div>
              <div class="col-md-6">
                <label for="lugar_nacimiento">Lugar nacimiento *</label>  
                  <?php echo expedicion(@$row->lugar_nacimiento,"lugar_nacimiento",'Lugar de nacimiento',$require=true);?>
              </div>
              <div class="col-md-6">
                <label for="estado_civil">Estado civil *</label>
                  <?php
                  echo MakeSelect("estado_civil",@$row->estado_civil,array("class"=>"form-control","require"=>"require"),get_estadoCivil(),$key = false);
                  ?>  
               
              </div>
              <div class="col-md-6">
                <label for="regimen_empresa">Regimen Empresa *</label>  
                <?php  
                  echo  MakeSelect("regimen_empresa",(isset($row))?$row->regimen_empresa:NULL,array("class"=>"form-control", "id"=>"regimen_empresa", "require"=>"require","pgrw-dependency"=>"{generate:'Responsable de IVA (RC)',options:{input1:{name:'naturaleza',settrue:'PERSONA JURÍDICA',setfalse:'PERSONA NATURAL'},input2:{name:'declara_renta',settrue:1,setfalse:0},input3:{name:'tipo_identificacion',settrue:6,setfalse:3}}}"),array(""=>"Seleccione",'No responsable de IVA (RS)'=> 'No responsable de IVA (RS)','Responsable de IVA (RC)' => 'Responsable de IVA (RC)'));
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
                <input type="text" class="form-control col-md-12" name="numero_identificacion" id="identificacion"  placeholder="Número de Identificación" maxlength="12" value="<?php echo (isset($row->numero_identificacion))?$row->numero_identificacion:''?>" <?php echo (isset($row->identificacion))?'readonly="readonly"':''?> require />
              </div>
              <div class="col-md-2 digito-verificacion">
                <label for="declara_renta">Digito verificacion *</label>  
               <input type="text" class="form-control col-md-12" name="digito_verificacion" id="identificacion_ext"  placeholder="DV" maxlength="1" value="<?php echo (isset($row->identificacion_ext))?$row->identificacion_ext:'0'?>"/>
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
                <label for="documento">Documento *</label>  
                  <input type="text" class="form-control col-md-12" name="documento" id="documento"  placeholder="Documento" value="<?php echo @$row->documento; ?>" />
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
                <label for="persona_de_contacto">Persona de contacto *</label> 
                <?php echo set_input("persona_de_contacto",@$row->persona_de_contacto,'Persona de contacto',$require=true,"",array("id"=>"persona_de_contacto")); ?> 
              </div>
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
                <label for="tipo_proveedor">Tipo proveedor *</label>  
                  <?php echo set_input("tipo_proveedor",@$row->tipo_proveedor,'tipo_proveedor',$require=true,"form-control",array("id"=>"tipo_proveedor")); ?>
              </div>
              <div class="col-md-6">
                <label for="suspendido_ventas">Suspendido ventas *</label>  
                  <?php echo set_input("suspendido_ventas",@$row->suspendido_ventas,'suspendido_ventas',$require=true,"form-control",array("id"=>"suspendido_ventas")); ?>
              </div>  
              <div class="col-md-6">
                <label for="lista_de_precios">Lista de precios *</label>  
                  <?php echo set_input("lista_de_precios",@$row->lista_de_precios,'Lista de precios',$require=true,"form-control",array("id"=>"lista_de_precios")); ?>
              </div>
              <div class="col-md-6">
                <label for="Vendedor">Vendedor *</label>  
                  <?php echo set_input("Vendedor",@$row->Vendedor,'Vendedor',$require=true,"form-control",array("id"=>"Vendedor")); ?>
              </div>
              <div class="col-md-6">
                <label for="cupo_credito">Cupo credito *</label>  
                  <?php echo set_input("cupo_credito",@$row->cupo_credito,'Cupo credito',$require=true,"form-control",array("id"=>"cupo_credito")); ?>
              </div>
              <div class="col-md-6">
                <label for="dias_credito">Dias credito *</label>  
                  <?php echo set_input("dias_credito",@$row->dias_credito,'dias credito',$require=true,"form-control",array("id"=>"dias_credito")); ?>
              </div>
              <div class="col-md-6">
                <label for="credito">credito *</label>  
                  <?php echo set_input("credito",@$row->credito,'credito',$require=true,"form-control",array("id"=>"credito")); ?>
              </div>
              <div class="col-md-6">
                <label for="documento_moneda_extranjera">documento moneda extranjera *</label>  
                <?php echo MakeSiNo("documento_moneda_extranjera",@$row->documento_moneda_extranjera,array("class"=>"form-control"));?> 
              </div>
              <div class="col-md-6">
                <label for="tipo_empleado">Tipo empleado *</label>  
                  <?php echo set_input("tipo_empleado",@$row->tipo_empleado,'Tipo empleado',$require=true,"form-control",array("id"=>"tipo_empleado")); ?>
              </div>
              <div class="col-md-6">
                <label for="tipo_de_contratacion">Tipo de contratacion *</label>  
                  <?php echo set_input("tipo_de_contratacion",@$row->tipo_de_contratacion,'Tipo de contratacion',$require=true,"form-control",array("id"=>"tipo_de_contratacion")); ?>
              </div>
              <div class="col-md-6">
                <label for="forma_de_pago">Forma de pago *</label>  
                  <?php echo set_input("forma_de_pago",@$row->forma_de_pago,'Forma de pago',$require=true,"form-control",array("id"=>"forma_de_pago")); ?>
              </div>
              <div class="col-md-6">
                <label for="tipo_de_cuenta">Tipo de cuenta *</label>  
                  <?php echo set_input("tipo_de_cuenta",@$row->tipo_de_cuenta,'tipo_de_cuenta',$require=true,"form-control",array("id"=>"tipo_de_cuenta")); ?>
              </div>
              <div class="col-md-6">
                <label for="banco">Banco *</label>  
                  <?php
                  echo MakeSelect("banco",@$row->banco,array("class"=>"form-control","require"=>"require"),get_bancos(),$key = false);
                  ?>  
              </div>
              <div class="col-md-6">
                <label for="numero_de_cuenta">Numero de cuenta *</label>  
                  <?php echo set_input("numero_de_cuenta",@$row->numero_de_cuenta,'Numero de cuenta',$require=true,"form-control",array("id"=>"numero_de_cuenta")); ?>
              </div>
              <div class="col-md-6">
                <label for="pension">Pension *</label>  
                  <?php echo set_input("pension",@$row->pension,'Pension',$require=true,"form-control",array("id"=>"pension")); ?>
              </div>
              <div class="col-md-6">
                <label for="cesantias">Cesantias *</label>  
                  <?php echo set_input("cesantias",@$row->cesantias,'Cesantias',$require=true,"form-control",array("id"=>"forma_de_pago")); ?>
              </div>
              <div class="col-md-6">
                <label for="salario_basico">Salario Basico *</label>  
                <?php echo set_input("salario_basico",@$row->salario_basico,$placeholder='Salario basico',$require=true,"firstLetterText");?> 
              </div>
              <div class="col-md-6">
                <label for="EPS">EPS *</label>  
                <?php echo set_input("EPS",@$row->EPS,$placeholder='EPS',$require=true,"firstLetterText");?> 
              </div>
              <div class="col-md-6">
                <label for="ARP">ARP *</label>  
                <?php echo set_input("ARP",@$row->ARP,$placeholder='ARP',$require=true,"firstLetterText");?> 
              </div>
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
    </div>
</div>
</div>
<?php echo form_close();?>
    </div><!--fin samartwizard -->    

</div><!--fin container -->
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
var segmento='<?php echo $this->uri->segment(3)?>';
var campos= '<?php echo json_encode($campos)?>';
//console.log(campos);
if(segmento=='Asociado'){
  var campos=["primer_nombre","segundo_nombre","primer_apellido","segundo_apellido","username","rol_id","fecha_nacimiento",
"lugar_nacimiento","ciudad_expedicion","ciudad_user","telefono_user","celular_user","email_user","cargo","salario_basico",
 "EPS", "ARP","pension","cesantias","forma_de_pago","tipo_de_contratacion","documento_moneda_extranjera"]
} 
if(segmento=='Cliente'){
  var campos=["primer_nombre","segundo_nombre","primer_apellido","segundo_apellido","username","rol_id","fecha_nacimiento",
"lugar_nacimiento","ciudad_expedicion","ciudad_user","telefono_user","celular_user","email_user","cargo","salario_basico",
 "EPS", "ARP","pension","cesantias","forma_de_pago","tipo_de_contratacion","documento_moneda_extranjera"]
} 
if(segmento=='Proveedores'){
  var campos=["tipo_proveedor","regimen_empresa","naturaleza","tipo_identificacion","numero_identificacion", 
  "digito_verificacion", "nombre_legal","nombre_comercial", "nombre","ciudad_user","ciudad_expedicion","telefono_user","celular_user",
  "email_user","persona_de_contacto","cargo","pagina_web","documento_moneda_extranjera","credito","dias_credito","cupo_credito",
   "banco","tipo_de_cuenta","numero_de_cuenta"]
} 
if(segmento=='Medico'){
  var campos=["primer_nombre","segundo_nombre","primer_apellido","segundo_apellido","username","rol_id","fecha_nacimiento",
"lugar_nacimiento","ciudad_expedicion","ciudad_user","telefono_user","celular_user","email_user","cargo","salario_basico",
 "EPS", "ARP","pension","cesantias","forma_de_pago","tipo_de_contratacion","documento_moneda_extranjera"]
}

console.log(campos);
var inputs= $("[name]");
console.log(campos)
 inputs.each(function(index,el){

 if($.inArray(el.name,campos)<0){
   $(this).parent('div').remove()
   //console.log($(this));
 }
 });



});
</script>

<?php
	$modulo		=	$this->ModuloActivo;
    if($this->uri->segment(4) == "Activos"){
        $row    = $this->$modulo->result["Activos"][0];
      }else{
        $row    = $this->$modulo->result["Inactivos"][0];
      }
    // pre($row)
?>

<div class="container mt-4">

<!-- SmartWizard html -->
<div id="smartwizard">
    <ul class="d-flex justify-content-around">
        <li><a href="#step-1"><i class="fas fa-user"></i><br /><p style="margin-top:10px;">Informacón</p> <p style="margin-top:-10px;">Básica</p></a></li>
        <li><a href="#step-2"><i class="fas fa-comment"></i><br /><p style="margin-top:10px;">Contactos</p></a></li>
        <li><a href="#step-3"><i class="fas fa-cogs"></i><br /><p style="margin-top:10px;">Configuracíon</p></a></li>
    </ul>

    <div>
        <div id="step-1" class="">
          
          <div class="container" style="margin-bottom:100px;">
            <div class="row justify-content-md-center">
              <div class="col-md-8">
                  <div class="form">
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="username">Nombre Usuario *</label>  
                          
                            <p> <?php   echo @$row->username ?></p>
                         
                        
                        </div>
                        <div class="col-md-6">
                          <label for="rol_id">Rol *</label>  
                         <p> <?php  
                         echo "Empresa"
                            ?> </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="regimen_empresa">Regimen Empresa *</label>  
                        <p>  <?php  
                            echo  @$row->regimen_empresa;
                          ?> </p>
                        </div>
                        <div class="col-md-6">
                          <label for="naturaleza">Naturaleza *</label>  
                         <p> <?php  
                              echo @$row->naturaleza
                          ?> </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="fecha_matricula">Primer nombre *</label>  
                           <p> <?php echo  @$row->primer_nombre?> </p>
                        </div>
                        <div class="col-md-6">
                          <label for="declara_renta">Segundo Nombre *</label>  
                          <p>  <?php echo @$row->segundo_nombre ?> </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="fecha_matricula">Primer Apellido *</label>  
                           <p> <?php echo  @$row->primer_apellido?> </p>
                        </div>
                        <div class="col-md-6">
                          <label for="declara_renta">Segundo Apellido *</label>  
                          <p>  <?php echo  @$row->segundo_apellido ?> </p>
                        </div>
                    </div>
                    
                    
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="fecha_matricula">Fecha de matricula *</label>  
                           <p> <?php echo  @$row->fecha_matricula?> </p>
                        </div>
                        <div class="col-md-6">
                          <label for="declara_renta">Declara renta *</label>  
                          <p>  <?php echo  (@$row->declara_renta==1)?'si':'no' ?> </p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="profijo_documento">Prefijo documentos *</label>  
                           <p> <?php echo @$row->prefijo_documento ?> </p>
                        </div>
                        <div class="col-md-6">
                          <label for="tipo_identificacion">Tipo de identificacion *</label>
                            <p><?php  
                              echo @tip_identificacion( @$row->tipo_identificacion)->tipo_identidad;;
                            ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="numero_identificacion">Numero de identificación *</label>  
                           <p><?php echo @$row->numero_identificacion ?></p>
                        </div>
                        <div class="col-md-6 ">
                          <label for="declara_renta">Digito verificacion *</label>  
                       <?php echo @$row->digitos_verificacion ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="numero_identificacion">Nombre legal *</label>  
                              <p> <?php echo @$row->nombre_legal?></p>
                        </div>
                        <div class="col-md-6">
                          <label for="nombre_comercial">Nombre Comercial *</label>  
                             <p><?php echo @$row->nombre_comercial; ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                          <label for="nombre">Nombre representante legal *</label>  
                          <p> <?php echo $row->primer_nombre?></p>
                        </div>
                        <div class="col-md-6">
                          <label for="documento">Documento representante legal *</label>  
                         <p> <?php echo @$row->documento; ?></p>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                      <div class="col-md-6">
                          <label for="ciudad_expedicion">Ciudad de expedicion *</label>  
                           <p> <?php echo @ciudad_expedicion(isset($row->ciudad_expedicion) ?@$row->ciudad_expedicion:'')->union?></p>
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
                        <label for="ciudad">Ciudad empresa *</label>  
                       <p> <?php echo @ciudad_expedicion(isset($row->ciudad) ?@$row->ciudad:'')->union?></p>
                   
                      </div>
                      <div class="col-md-6">
                        <label for="direccion">Dirección *</label>  
                        <p><?php echo @$row->direccion?> </p>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-6">
                        <label for="telefono">Telefono *</label>  
                        <p><?php    
                         echo @$row->telefono ;
                        ?> </p>
                      </div>
                      <div class="col-md-6">
                        <label for="celular">Celular *</label>  
                        <p><?php    
                          echo @$row->celular ; 
                        ?> </p> 
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-6">
                        <label for="email">Email *</label>  
                        <p><?php    
                        echo @$row->email;
                        ?> </p>
                      </div>
                      <div class="col-md-6">
                        <label for="cargo">Cargo *</label>  
                       <?php    
                        echo  cargo(@$row->cargo,'cargo',$placeholder='Cargo',$require=true);
                        ?> 
                      </div>
                      <div class="col-md-6">
                        <label for="persona_contacto">Persona de contacto *</label>  
                       <p><?php    
                        echo  @$row->direccion;
                        ?></p>
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
                       <p> <?php echo @$row->pagina_web ?> </p>
                      </div>
                      <div class="col-md-6">
                        <label for="divisa_oficial">Divisa oficial *</label>  
                        <p><?php echo @$row->divisa_oficial?></p> 
                      </div>
                    </div>
                    <div class="row form-group">
                    <div class="col-md-6">
                          <label for="documento_moneda_extranjera">Documento moneda extranjera*</label>  
                          <p>  <?php echo  (@$row->declara_renta==1)?'si':'no' ?> </p>
                        </div>
                        <div class="col-md-6">
                          <label for="demo">Demo*</label>  
                          <p>  <?php echo  (@$row->declara_renta==1)?'si':'no' ?> </p>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                    <div class="col-md-6">
                          <label for="ciudad_expedicion">Descripcion *</label>  
                         <p><?php echo @$row->documento; ?> </p>
                        </div>
                    
                    <div class="col-md-6">
                          <label for="documento_moneda_extranjera">Estado*</label>  
                          <p>  <?php echo  (@$row->estado==1)?'Activo':'Inactivo' ?> </p>
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





<!--<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-12">
		            <h4 style="font-family: 'Oswald', sans-serif;" class="font-weight-700 text-uppercase orange">
                    	Datos de la Empresa
					</h4>
                </div>
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Empresa
                </div>
                <div class="col-md-6">
                    <b>
	             <?php print_r(@$row->nombre_comercial);?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Naturaleza e identificación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo @$row->naturaleza;?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Tipo identificación
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo @tip_identificacion( @$row->tipo_identificacion)->tipo_identidad;?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Identificación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->numero_identificacion))?$row->numero_identificacion:''?>
                        <?php echo (isset($row->identificacion_ext))?"-".$row->identificacion_ext:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Nombre legal
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->nombre_legal))?@$row->nombre_legal:''?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Nombre comercial
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->nombre_comercial))?@$row->nombre_comercial:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Nombre Representante Legal
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->nombre_legal))?@$row->nombre_legal:''?>
                    </b>
                </div>
			</div>
            <div class="row separar">
                <div class="col-md-6 text-right">
		          	Idenficación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->nro_identificacion_representante_legal))?@$row->nro_identificacion_representante_legal:''?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
                 	Ciudad Exp.
				</div>                    
				<div class="col-md-6">
                    <b>
						<?php echo @ciudad_expedicion(isset($row->ciudad_expedicion) ?@$row->ciudad_expedicion:'')->union ?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Dirección
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->direccion))?$row->direccion:''?>
                    </b>
                </div>
            </div>
                   
			
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Teléfono Móvil
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->telefono))?@$row->telefono:''?>
                    </b>
                </div>
			</div>
      <div class="row separar">                
                <div class="col-md-6 text-right">
		          	Rol / Cargo
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo @rol(isset($row->rol_id)? $row->rol_id:'')->rol ?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Website
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->pagina_web))?$row->pagina_web:''?>
                    </b>
                </div>
            </div>
         <div class="row separar">
            	<div class="col-md-3 text-center">
		           Mañana
                   <?php echo (isset($row->turno_manama)&& @$row->turno_manama==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Tarde
                   <?php echo (isset($row->turno_tarde)&& @$row->turno_tarde==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Noche
                   <?php echo (isset($row->turno_noche)&& @$row->turno_noche==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Intermedio
                   <?php echo (isset($row->turno_intermedio)&& @$row->turno_intermedio==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
            </div>
        </div>
    </div>
</div>-->
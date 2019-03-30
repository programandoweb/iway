<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php $modulo       =   $this->ModuloActivo; ?>
<?php 
          echo form_open(current_url("Formularios/ConocimientoAspirante"));     
?>
    <div class="container" >
          <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#paso1" role="tab" style="margin:0px,padding:0px">
                            1 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso2" role="tab">
                            2
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso3" role="tab">
                            3
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso4" role="tab">
                            4
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso5" role="tab">
                            5
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso6" role="tab">
                            6
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso7" role="tab">
                            7
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso8" role="tab">
                            8
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso9" role="tab">
                            9
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso10" role="tab">
                            10
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso11" role="tab">
                            11
                        </a>
                    </li> <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso12" role="tab">
                            12
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso13" role="tab">
                            13
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso14" role="tab">
                            14
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso15" role="tab">
                            15
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso16" role="tab">
                            16
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso17" role="tab">
                            17
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paso18" role="tab">
                            18
                        </a>
                    </li>
                </ul>
                <div class="tab-content row p-2">
                    <div class="tab-pane active col-md-12" id="paso1" role="tabpanel">
                    	<div class="form">
                        	<div class="form-group item">
                    			<h3 class="text-center">Certificación del aspirante.</h3>
                            </div>
                        </div>
                        <p>Por la presente y para todos los efectos legales, certifico que: </p>
                        <ol>
                            <li> Entiendo  que BELLE Colombia®, operan y gestionan páginas de entretenimiento para adultos de contenido erótico. </li>
                            <li>Me encuentro de manera libre y voluntaria en las instalaciones de BELLE Colombia®. </li>
                            <li> Soy de mente sana. </li>
                            <li> Tengo dieciocho (18) años o más. </li>
                            <li> He presentado documentación que acredita mi edad y me declaro penalmente responsable ante la falsificación o uso de documento privado o público, tipificado en el código penal Colombiano y excluyo a BELLE Colombia® de cualquier responsabilidad, certificando que considero que ellos han actuado en razón de su buena fe penal, civil y comercial. </li>
                            <li>No he sido obligada (o) o presionada (o) de ninguna manera para la presentación voluntaria a esta primera entrevista en las instalaciones de BELLE Colombia®.</li>
                            <li>Entiendo que de conformidad con lo dispuesto en la Ley Estatutaria 1581 de 2012 sobre el uso de los datos personales que se obtengan por medio de este proceso, serán recogidos y almacenados y objeto de tratamiento en bases de datos hasta por cinco (5) años más, esta base de datos cuenta con las medidas de seguridad necesarias para la conservación adecuada de los datos personales, con la aceptación de la presente autorización, permito el tratamiento de mis datos personales para las finalidades mencionadas y certifico que los datos suministrados a BELLE Colombia® son ciertos, dejando por sentado que no he omitido o adulterado ninguna información.</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-4">
                              	<label><b>Certifico</b></label>
                            </div>
                            <div class="col-md-4">
                              	<h6>Si</h6>
                              	<?php echo set_input_radio("certifico","","Si",false,"custom-control-input",""); ?>
                            </div>
                            <div class="col-md-4">
                              	<h6>No</h6>
                              	<?php echo set_input_radio("certifico","","No",false,"custom-control-input",""); ?>                  
                            </div>  
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                              	<label><b>Nombres</b></label>
                            </div>
                            <div class="col-md-4">
                            	<?php set_input("PrimerNombre","",$placeholder='Primer Nombre',$require=true,"firstLetterText");?>
                            </div>
                            <div class="col-md-4">
                            	<?php set_input("SegundoNombre","",$placeholder='PrimerApellido',$require=true,"firstLetterText");?>
                            </div>  
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                              	<label><b>Apellidos</b></label>
                            </div>
                            <div class="col-md-4">
                            	<?php set_input("PrimerApellido","",$placeholder='Primer Apellido',$require=true,"firstLetterText");?>                  
                            </div>
                            <div class="col-md-4">
                            	<?php set_input("SegundoApellido","",$placeholder='PrimerApellido',$require=true,"form-control");?>
                            </div>  
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label><b>Numero de Cedula</b></label>
                            </div>
                             <div class="col-md-4">
                                  <?php set_input("NroCedula","",$placeholder='NroCedula',$require=true,"firstLetterText");?>
                             </div>
                             <div class="col-md-4"></div>
                         </div>
                         <div class="row mb-4">
                             <div class="col-md-4">
                            	<label><b>Ciudad de Expedición</b></label>
                        	 </div>
                             <div class="col-md-4">
                                  <?php set_input("CiudadExpedicion","",$placeholder='CiudadExpedicion',$require=true);?>
                                  <input type="hidden" name="FechaPresentacion" value="<?php echo date("Y-m-d"); ?>">
                              	  <input type="hidden" name="SedeAplica" value="<?php ?>">
                             </div>
                             <div class="col-md-4"></div>
                         </div>                                                            
                    </div>
                    <div class="tab-pane col-md-12" id="paso2" role="tabpanel">
                    	<div class="form">
                             <div class="form-group item">
                                  <div class="p-3">
                                       <h3><b>Información general.</b></h3>
                                  </div>
                             </div>
                    	</div>
                             <div class="row form-group col-md-12">
                                  <div class="col-md-4">
                                       <b>¿Cómo obtuviste información de la vacante?</b>
                                  </div>
                                  <div class="col-md-8"> 
                                            <div class="col-md-12"><?php echo set_input_radio("rss","","acepto",false,"custom-control-input",""); ?>         
                                       <label for="">Facebook</label></div>
                                            <div class="col-md-12"><?php echo set_input_radio("rss","","acepto",false,"custom-control-input",""); ?>  
                                       <label for="">OLX</label></div>
                                            <div class="col-md-12"><?php echo set_input_radio("rss","","acepto",false,"custom-control-input",""); ?>
                                       <label for="">Instagram</label></div>
                                            <div class="col-md-12"><?php echo set_input_radio("rss","","acepto",false,"custom-control-input",""); ?>
                                       <label for="">Google</label></div>
                                            <div class="col-md-12"><?php echo set_input_radio("rss","","acepto",false,"custom-control-input",""); ?>
                                       <label for="">Twitter</label></div>
                                            <div class="col-md-12"><?php echo set_input_radio("rss","","acepto",false,"custom-control-input",""); ?>
                                       <label for="">Tinder</label></div>
                                           <div class="col-md-12"><?php echo set_input_radio("rss","","acepto",false,"custom-control-input",""); ?>
                                       <label for="">Linkedln</label></div>
                                       <div class="row col-md-12"><h5 class="col-md-2"><b>Otro</b></h5><div class="col-md-6 md-push-4"> 
                                            <?php set_input("OtraRss","",$placeholder='Otra red Social',$require=true);?></div></div> 
                                  </div>
                                  <div class="oculto row">
                                      <div class="col-md-4">
                                            <b>¿Te recomienda algún integrante de la empresa?</b>
                                      </div>
                                      <div class="col-md-8"> 
                                                 <div class="col-md-12"><?php echo set_input_radio("Recomendado","","Si",false,"custom-control-input Mostrar",""); ?> Si</div>
                                                 <div class="col-md-12"><?php echo set_input_radio("Recomendado","","No",false,"custom-control-input Mostrar",""); ?> No</div>
                                       </div>
                                      <div class="row form-group col-md-12 Opcional">
                                           <div class="col-md-4">
                                                <b>Si tu respuesta anterior fue SI, por favor escribe su nombre.</b>
                                           </div>
                                           <div class="col-md-8">
                                                <div class="col-md-8 md-push-4">
                                                     <?php set_input("Intermediario","",$placeholder='Nombre Completo',$require=false,"form-control");?>
                                                </div>
                                           </div>
                                      </div>
                                 </div>
                           </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso3" role="tabpanel">
                        <div class="form">
                             <div class="form-group item">
                                  <div class="p-3">
                                       <h3><b>Información personal.</b></h3>
                                  </div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4">
                                       <b>Email</b>
                                  </div>
                                  <div class="col-md-4">
                                       <?php set_input("email","",$placeholder='Email',$require=true,"form-control") ?>
                                  </div>
                                  <div class="col-md-4"></div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4">
                                       <b>Nombre entrevistado (a)</b>
                                  </div>
                                  <div class="col-md-4">
                                       <?php set_input("NombreEntrevistado","",$placeholder='Nombres entrevistado',$require=true,"form-control") ?>
                                  </div>
                                  <div class="col-md-4">
                                       <?php set_input("ApellidoEntrevistado","",$placeholder='Apellidos Entrevistado',$require=true,"form-control") ?>
                                  </div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4">
                                       <b>Fecha de nacimiento</b>
                                  </div>
                                  <div class="col-md-4">
                                        <?php set_input("FechaNacimiento","",$placeholder='AAAA-MM-DD',$require=true,"datepicker");?>
                                  </div>
                                  <div class="col-md-4"></div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4">
                                       <b>Ciudad de nacimiento</b>
                                  </div>
                                  <div class="col-md-4">
                                       <?php set_input("CiudadNacimiento","",$placeholder="Ciudad de Nacimiento",$require=true,"form-control"); ?>
                                  </div>
                                  <div class="col-md-4"></div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4">
                                       <b>Estado Civil</b>
                                  </div>
                                  <div class="col-md-4">
                                       <?php echo MakeEstadoCivil("EstadoCivil","",array("Class"=>"form-control","require"=>"require")); ?>
                                  </div>
                                  <div class="col-md-4"></div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-8">
                                       <b>Direccion Domicilio</b>
                                  </div>
                                  <div class="col-md-8">
                                       <?php set_input("DireccionDomicilio","",$placeholder="Direccion Domicilio",$require=true,"form-control"); ?>
                                  </div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4"></div>
                                  <div class="col-md-8">
                                       <?php set_input("Direccion2","",$placeholder="Direccion 2",$require=true,"form-control"); ?>
                                  </div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4"></div>
                                  <div class="col-md-4">
                                       <?php set_input("Ciudad","",$placeholder="Ciudad",$require=true,"form-control"); ?>
                                  </div>
                                  <div class="col-md-4">
                                       <?php set_input("Region","",$placeholder="Region",$require=true,"form-control"); ?>
                                  </div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4"></div>
                                  <div class="col-md-4">
                                       <?php set_input("CodigoPostal","",$placeholder="Codigo Postal",$require=true,"form-control"); ?>
                                  </div>
                                  <div class="col-md-4">
                                       <?php set_input("Pais","",$placeholder="Pais",$require=true,"form-control"); ?>
                                  </div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4"><b>Telefono Celular</b></div>
                                  <div class="col-md-2">
                                       <?php set_input("Ind","",$placeholder="#",$require=true,"form-control",array("maxlength"=>"3")); ?>
                                  </div>
                                  <div class="col-md-2">
                                       <?php set_input("Ind2","",$placeholder="#",$require=true,"form-control",array("maxlength"=>"3")); ?>
                                  </div>
                                  <div class="col-md-4">
                                       <?php set_input("NumCel","",$placeholder="#",$require=true,"form-control"); ?>
                                  </div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4"><b>Estrato Socieconomico</b></div>
                                  <div class="col-md-4">
                                        <?php echo MakeEstrato("Estrato","",array("Class"=>"form-control","require"=>"require")); ?>
                                  </div>
                                  <div class="col-md-4"></div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4"><b>Telefono Fijo</b></div>
                                  <div class="col-md-2">
                                       <?php set_input("IndF","",$placeholder="#",$require=true,"form-control",array("maxlength"=>"3")); ?>
                                  </div>
                                  <div class="col-md-2">
                                       <?php set_input("Ind2F","",$placeholder="#",$require=true,"form-control",array("maxlength"=>"3")); ?>
                                  </div>
                                  <div class="col-md-4">
                                       <?php set_input("NumFijo","",$placeholder="#",$require=true,"form-control");?>
                                  </div>
                             </div>
                             <div class="row form-group">
                                  <div class="col-md-4">
                                       <b>Turno en el cual transmitirás.</b>
                                  </div>
                                  <div class="row col-md-4">
                                       <div class="col-md-2"><?php echo set_input_radio("Turno","","Mañan (06:30 a.m. - 02:00 p.m.)",false,"custom-control-input",""); ?></div>
                                       <h6 class="col-md-10">Mañana   (06:30 a.m. - 02:00 p.m.)</h6>
                                       <div class="col-md-2"><?php echo set_input_radio("Turno","","Tarde (01:30 p.m. - 10:00 p.m.)",false,"custom-control-input",""); ?></div>
                                       <h6 class="col-md-10">Tarde    (01:30 p.m. - 10:00 p.m.)</h6>
                                       <div class="col-md-2"><?php echo set_input_radio("Turno","","Noche (09:30 p.m. - 06:00 a.m.)",false,"custom-control-input",""); ?></div>
                                       <h6 class="col-md-10">Noche    (09:30 p.m. - 06:00 a.m.)</h6>
                                  </div>
                             </div>
                        </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso4" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Información financiera.</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Estás trabajando actualmente?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("TrabajoActual","","Si",false,"custom-control-input Mostrar",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("TrabajoActual","","No",false,"custom-control-input Mostrar",""); ?>                  
                               </div>  
                          </div>
                          <div class="row form-group Opcional">
                               <div class="col-md-4">
                                    <b>¿Cuánto suman tus ingresos actuales? </b>
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("IngresosActuales","",$placeholder="Ingresos Actuales",$require=false,"form-control");?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group Opcional">
                               <div class="col-md-4">
                                    <b>¿Cuánto suman tus obligaciones mensuales? </b>
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("Obligaciones","",$placeholder="Obligaciones Actuales",$require=false,"form-control");?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Cuánto requieres ganar  mensualmente?</b> 
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("AspiracionSalarial","",$placeholder="Aspiracion Salarial",$require=true,"form-control");?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Tienes vehículo?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Vehiculo","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Vehiculo","","No",false,"custom-control-input",""); ?>                  
                               </div>  
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso5" role="tabpanel">
                    	<div class="row">
                           <div class="form col-md-12">
                                <div class="form-group item">
                                     <h3><b>Información familiar.</b></h3>
                                </div>    
                           </div>
                      </div>
                      <div class="row form-group">
                           <div class="col-md-4">
                                <b>Nombre de tu esposo (a) o compañero (a)</b>
                           </div>
                           <div class="col-md-4">
                                <?php set_input("NombrePareja","",$placeholder="Nombre de Esposo (a) o compañero",$require=true,"form-control");?>
                           </div>
                           <div class="col-md-4"></div>
                      </div>
                      <div class="row form-group">
                           <div class="col-md-4">
                                <b>Profesión, ocupación u oficio.</b>
                           </div>
                           <div class="col-md-4">
                                <?php set_input("Profesion","",$placeholder="Profesion",$require=true,"form-control");?>
                           </div>
                           <div class="col-md-4"></div>
                      </div>
                      <div class="row form-group">
                           <div class="col-md-4"><b>Telefono</b></div>
                           <div class="col-md-2">
                                <?php set_input("TelPareja","",$placeholder="#",$require=true,"form-control",array("maxlength"=>"3")); ?>
                           </div>
                           <div class="col-md-2">
                                <?php set_input("IndP2","",$placeholder="#",$require=true,"form-control",array("maxlength"=>"3")); ?>
                           </div>
                           <div class="col-md-4">
                                <?php set_input("NumP","",$placeholder="#",$require=true,"form-control"); ?>
                           </div>
                      </div>
                      <div class="row form-group">
                           <div class="col-md-4">
                                <b>¿Número de personas que dependen económicamente de ti?</b>
                           </div>
                           <div class="col-md-4">
                                <?php set_input("PersonasACargo","",$placeholder="# de Personas a cargo",$require=true,"form-control"); ?>
                           </div>
                           <div class="col-md-4"></div>
                      </div>
                      <div class="row form-group">
                           <div class="col-md-4">
                                <b>Vives en casa</b>
                           </div>
                           <div class="col-md-2">
                                Propia
                                <?php set_input_radio("ViveEnCasa","","Propia",false,"custom-control-input",""); ?>
                           </div>
                           <div class="col-md-2">                    
                                Familiar
                                <?php set_input_radio("ViveEnCasa","","Familiar",false,"custom-control-input",""); ?>
                           </div>
                           <div class="col-md-4">
                                Arrendada
                                <?php set_input_radio("ViveEnCasa","","Arrendada",false,"custom-control-input",""); ?>
                           </div>
                      </div>
                      <div class="row form-group col-md-12">
                           <div class="col-md-4">
                                <b>¿Tienes hijos? </b>
                           </div>
                           <div class="col-md-4"><?php echo set_input_radio("Hijos","","Si",false,"custom-control-input Mostrar",""); ?> Si</div>
                           <div class="col-md-4"><?php echo set_input_radio("Hijos","","No",false,"custom-control-input mostrar",""); ?> No</div>
                      </div>
                      <div class="row form-group col-md-12" id="NomRec">
                           <div class="col-md-12">
                                <b>Si tu respuesta anterior fue SI, por favor escribe su informacion.</b>
                           </div>
                      </div>
                      <div class="row form-group">
                           <div class="col-md-4">
                                <b>Hijo # 1 </b><br/>
                                Nombre y edad
                           </div>
                           <div class="col-md-4">
                                <?php set_input("Hijo1","",$placeholder="Nombre Completo",$require=true,"form-control"); ?>
                           </div>
                           <div class="col-md-4"></div>
                      </div>
                      <div class="row form-group">
                           <div class="col-md-4">
                                <b>Hijo # 2 </b><br/>
                                Nombre y edad
                           </div>
                           <div class="col-md-4">
                                <?php set_input("Hijo2","",$placeholder="Nombre Completo",$require=true,"form-control"); ?>
                           </div>
                           <div class="col-md-4"></div>
                      </div>
                      <div class="row form-group">
                           <div class="col-md-4">
                                <b>Hijo # 3 </b><br/>
                                Nombre y edad
                           </div>
                           <div class="col-md-4">
                                <?php set_input("Hijo3","",$placeholder="Nombre Completo",$require=true,"form-control"); ?>
                           </div>
                           <div class="col-md-4"></div>
                      </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso6" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3>Información académica.</h3>
                                    </div>
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">               
                                   <b>Nivel académico</b> 
                               </div>
                               <div class="col-md-4">
                                   <?php echo MakeNivelAcademico("NivelAcademico","",array("Class"=>"form-control","require"=>"require")); ?> 
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">               
                                   <b>Campo de especialidad</b> 
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("CampoEspecialidad","",$placeholder="Campo de especialidad",$require=true,"form-control"); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group col-md-12">
                               <div class="col-md-4">
                                    <b>¿Realizas estudios actualmente?  </b>
                               </div>
                               <div class="col-md-4"><?php echo set_input_radio("EstudioActual","","Si",false,"custom-control-input Mostrar",""); ?> Si</div>
                               <div class="col-md-4"><?php echo set_input_radio("EstudioActual","","No",false,"custom-control-input Mostrar",""); ?> No</div>
                          </div>
                          <div class="col-md-12 Opcional">
                               <div class="col-md-12">
                                    <b>Si tu respuesta anterior fue SI, por favor escribe su informacion.</b>
                               </div>
                               <div class="row form-group">
                                    <div class="col-md-4">
                                         <b>Nombre institución educativa.</b>
                                    </div>
                                    <div class="col-md-4">
                                         <?php set_input("InsEdu","",$placeholder="Nombre Institución educativa",$require=true,"form-control"); ?>
                                    </div>
                                    <div class="col-md-4"></div>
                               </div>
                          </div>
                          <div class="col-md-12 Opcional">
                               <div class="row form-group">
                                    <div class="col-md-4">
                                         <b>Horario que estudias.</b>
                                    </div>
                                    <div class="col-md-4">
                                         <?php echo MakeHora("HoraEstudio","","","form-control"); ?>
                                    </div>
                                    <div class="col-md-4"></div>
                               </div>
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso7" role="tabpanel">
                    	<div class="row"> 
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                          <h3><b> Información laboral.</b></h3>    
                                    </div>  
                               </div>  
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <label><b>¿Has sido modelo webcam?</b></label>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("ModeloWeb","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("ModeloWeb","","No",false,"custom-control-input",""); ?>                  
                               </div>  
                          </div>
                          <div class="row form-group Opcional">  
                               <div class="col-md-4">
                                    <b>Nombre del estudio</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("NombreEstudio","",$placeholder="Nombre del Estudio",$require=true,"form-control"); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group Opcional">  
                               <div class="col-md-4">
                                    <b>Páginas trabajadas</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("PaginasTrabajadas","",$placeholder="Paginas Trabajadas",$require=true,"form-control"); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group Opcional">  
                               <div class="col-md-4">
                                    <b>Nombre de la última o actual empresa</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("NombreUltimaEmpresa","",$placeholder="Nombre de la ultima empresa",$require=true,"form-control"); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group Opcional">  
                               <div class="col-md-4">
                                    <b>Cargo desempeñado</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("CargoDesempeñado","",$placeholder="Cargo desempeñado",$require=true,"form-control"); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group Opcional">  
                               <div class="col-md-4">
                                    <b>Funciones realizadas</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php echo form_textarea("FuncionesRealizadas","",$arrayName = array('class' =>"form-control" ,"require"=>"require")); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">  
                               <div class="col-md-4">
                                    <b>Fecha de ingreso</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("FechaIngreso","",$placeholder="AA/MM/DD",$require=true,"form-control datepicker"); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">  
                               <div class="col-md-4">
                                    <b>Fecha de retiro</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("FechaRetiro","",$placeholder="AA/MM/DD",$require=true,"form-control datepicker"); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso8" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Información seguridad social.</b></h3>     
                                    </div>
                               </div>
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <label><b>Tipo de seguridad social (EPS)</b></label>
                               </div>    
                               <div class="col-md-8">
                                    <h6>Subsidiado (SISBEN)</h6>
                                    <?php echo set_input_radio("TipoSeguridadSocial","","Subsidiado (SISBEN)",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4"></div>
                               <div class="col-md-8">
                                    <h6>Contributivo</h6>
                                    <?php echo set_input_radio("TipoSeguridadSocial","","Contributivo",false,"custom-control-input",""); ?>      
                               </div>
                               <div class="col-md-4"></div>
                               <div class="col-md-8">
                                    <h6>Beneficiario</h6>
                                    <?php echo set_input_radio("TipoSeguridadSocial","","Beneficiario",false,"custom-control-input",""); ?>                  
                               </div>
                               <div class="col-md-4"></div>     
                               <div class="col-md-8">
                                    <h6>Ninguno</h6>
                                    <?php echo set_input_radio("TipoSeguridadSocial","","Ninguno",false,"custom-control-input",""); ?>                  
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>Nombre de la entidad promotora de salud (EPS)</b>
                               </div>
                               <div class="col-md-4">
                                   <?php set_input("NombreEntidad","",$placeholder="Nombre entidad de salud",$require=true,"form-control"); ?> 
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>Fondo de pensiones</b>
                               </div>
                               <div class="col-md-4">
                                   <?php set_input("FondoPensiones","",$placeholder="Fondo de pensiones",$require=true,"form-control"); ?> 
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>Fondo de cesantías</b>
                               </div>
                               <div class="col-md-4">
                                   <?php set_input("FondoCesantías","",$placeholder="Fondo de cesantías",$require=true,"form-control"); ?> 
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                           <div class="row form-group">
                               <div class="col-md-4">
                                    <b>Sufres o has sufrido de alguna enfermedad importante</b>
                               </div>
                               <div class="col-md-4">
                                   <?php set_input("EnfermedadImportante","",$placeholder="Sufres o has sufrido de alguna enfermedad importante",$require=true,"form-control"); ?> 
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso9" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Aptitudes especifícas. </b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class="form-group">
                               <div class="col-md-12">
                                    <b>Marca de uno (1) a diez (10) según consideres, siendo uno (1) muy poco y diez (10) muy bueno.</b>
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-xs-12 col-sm-12 col-md-4">
                                    <b>¿Cuánto sabes de digitación?</b>
                               </div>
                               <div class="row col-xs-12 col-sm-12 col-md-8 center-block">
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                    <div class="col-xs-1 col-xs-1 col-md-1">
                                         <h6>1</h6>
                                    <?php echo set_input_radio("Digitacion","","1",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>2</h6>
                                    <?php echo set_input_radio("Digitacion","","2",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>3</h6>
                                    <?php echo set_input_radio("Digitacion","","3",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>4</h6>
                                    <?php echo set_input_radio("Digitacion","","4",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>5</h6>
                                    <?php echo set_input_radio("Digitacion","","5",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>6</h6>
                                    <?php echo set_input_radio("Digitacion","","6",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>7</h6>
                                    <?php echo set_input_radio("Digitacion","","7",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>8</h6>
                                    <?php echo set_input_radio("Digitacion","","8",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>9</h6>
                                    <?php echo set_input_radio("Digitacion","","9",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>10</h6>
                                    <?php echo set_input_radio("Digitacion","","10",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-xs-12 col-sm-12 col-md-4">
                                    <b>¿Cuánto sabes de inglés?</b>
                               </div>
                               <div class="row col-xs-12 col-sm-12 col-md-8">
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                    <div class="col-xs-1 col-xs-1 col-md-1">
                                         <h6>1</h6>
                                    <?php echo set_input_radio("Ingles","","1",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>2</h6>
                                    <?php echo set_input_radio("Ingles","","2",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>3</h6>
                                    <?php echo set_input_radio("Ingles","","3",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>4</h6>
                                    <?php echo set_input_radio("Ingles","","4",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>5</h6>
                                    <?php echo set_input_radio("Ingles","","5",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>6</h6>
                                    <?php echo set_input_radio("Ingles","","6",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>7</h6>
                                    <?php echo set_input_radio("Ingles","","7",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>8</h6>
                                    <?php echo set_input_radio("Ingles","","8",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>9</h6>
                                    <?php echo set_input_radio("Ingles","","9",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>10</h6>
                                    <?php echo set_input_radio("Ingles","","10",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-xs-12 col-sm-12 col-md-4">
                                    <b>¿Tienes buena ortografía?</b>
                               </div>
                               <div class="row col-xs-12 col-sm-12 col-md-8">
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                    <div class="col-xs-1 col-xs-1 col-md-1">
                                         <h6>1</h6>
                                    <?php echo set_input_radio("Ortografia","","1",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>2</h6>
                                    <?php echo set_input_radio("Ortografia","","2",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>3</h6>
                                    <?php echo set_input_radio("Ortografia","","3",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>4</h6>
                                    <?php echo set_input_radio("Ortografia","","4",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>5</h6>
                                    <?php echo set_input_radio("Ortografia","","5",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>6</h6>
                                    <?php echo set_input_radio("Ortografia","","6",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>7</h6>
                                    <?php echo set_input_radio("Ortografia","","7",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>8</h6>
                                    <?php echo set_input_radio("Ortografia","","8",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>9</h6>
                                    <?php echo set_input_radio("Ortografia","","9",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>10</h6>
                                    <?php echo set_input_radio("Ortografia","","10",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-xs-12 col-sm-12 col-md-4">
                                    <b>¿Sabes bailar?</b>
                               </div>
                               <div class="row col-xs-12 col-sm-12 col-md-8">
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                    <div class="col-xs-1 col-xs-1 col-md-1">
                                         <h6>1</h6>
                                    <?php echo set_input_radio("Baile","","1",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>2</h6>
                                    <?php echo set_input_radio("Baile","","2",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>3</h6>
                                    <?php echo set_input_radio("Baile","","3",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>4</h6>
                                    <?php echo set_input_radio("Baile","","4",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>5</h6>
                                    <?php echo set_input_radio("Baile","","5",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>6</h6>
                                    <?php echo set_input_radio("Baile","","6",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>7</h6>
                                    <?php echo set_input_radio("Baile","","7",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>8</h6>
                                    <?php echo set_input_radio("Baile","","8",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>9</h6>
                                    <?php echo set_input_radio("Baile","","9",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                         <h6>10</h6>
                                    <?php echo set_input_radio("Baile","","10",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                               </div>
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso10" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Presentación personal.</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class="form-group">
                               <div class="col-md-12">
                                    <b>Queremos recordarte que el modelaje webcam es un trabajo de elegancia y profesionalismo, por lo cual la presentación personal es fundamental para nuestra empresa, te informamos que está prohibido transmitir con la misma ropa que llegas a nuestras instalaciones, tampoco el uso de Jeans frente a cámara.</b>
                               </div>  
                          </div>
                          <div class="form-group">
                               <div class="col-md-12">
                                    <b>De igual manera para el caso de las chicas deberán presentarse siempre maquilladas y con las uñas en perfecto estado, igualmente deberás estar con un mínimo de treinta (30) minutos antes, recuerda llevar tu cabello y lencería siempre en perfecto estado y completamente aseado.</b>
                               </div>
                          </div>
                           <div class=" row form-group">
                               <div class="col-md-4">
                                    <label><b>¿Utilizas maquillaje?</b></label>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Maquillaje","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Maquillaje","","No",false,"custom-control-input",""); ?>                  
                               </div>  
                          </div>
                          <div class="row form-group">
                                 <div class="col-md-4">
                                      <b>Color del cabello </b>
                                 </div>
                                 <div class="col-md-4">
                                      <?php echo MakePelo("ColorPelo","",array("Class"=>"form-control","require"=>"require")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  
                          </div>
                           <div class="row form-group">
                                 <div class="col-md-4">
                                      <b>Longitud del Cabello </b>
                                 </div>
                                 <div class="col-md-4">
                                      <?php echo MakeLargoPelo("ColorLargoPelo","",array("Class"=>"form-control","require"=>"require")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <label><b>¿Utilizas accesorios?</b></label>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Accesorios","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Accesorios","","No",false,"custom-control-input",""); ?>
                               </div>  
                          </div>
                          <div class="row form-group">
                                 <div class="col-md-4">
                                      <b>Tamaño de tus accesorios </b>
                                 </div>
                                 <div class="col-md-4">
                                      <?php echo Accesorios("TamAccesorios","",array("Class"=>"form-control","require"=>"require")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  
                          </div>
                          <div class="row form-group">
                                 <div class="col-md-4">
                                      <b>Estado de las uñas de tus manos. </b>
                                 </div>
                                 <div class="col-md-4">
                                      <?php echo TamAccesorios("TamAccesoriosManos","",array("Class"=>"form-control","require"=>"require")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  
                          </div>
                          <div class="row form-group">
                                 <div class="col-md-4">
                                      <b>Estado de las uñas de tus pies. </b>
                                 </div>
                                 <div class="col-md-4">
                                      <?php echo TamAccesorios("EstadoUñasPies","",array("Class"=>"form-control","require"=>"require")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso11" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Importante </b></h3>
                                    </div>
                               </div>
                         </div>
                         <div class="form-group">
                               <div class="col-md-12">
                                    <b>Queremos informarte que ninguna de las preguntas que te presentamos a continuación serán determinantes para tu contratación, siéntete libre al responder.</b>
                               </div>
                         </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso12" role="tabpanel">
                    	 <div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Perfil socio sexual.</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Puedes sostener conversaciones sobre morbo?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("ConversacionMorbo","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("ConversacionMorbo","","No",false,"custom-control-input",""); ?>
                               </div>  
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <label><b>¿Te masturbas?</b></label>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("TeMasturbas","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("TeMasturbas","","No",false,"custom-control-input",""); ?>            
                               </div>  
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <label><b>¿Con que frecuencia?</b></label>
                               </div>
                               <div class="row col-md-8">
                                    <div class="col-md-4">
                                         <h6>Diariamente</h6>
                                         <?php echo set_input_radio("ConQueFrecuencia","","Diariamente",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-md-4">
                                         <h6>Al menos una vez por semana</h6>
                                         <?php echo set_input_radio("ConQueFrecuencia","","Al menos una vez por semana",false,"custom-control-input",""); ?>                  
                                    </div>
                                    <div class="col-md-4">
                                         <h6>Al menos una vez al mes</h6>
                                         <?php echo set_input_radio("ConQueFrecuencia","","Al menos una vez al mes",false,"custom-control-input",""); ?>                  
                                    </div>
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <label><b>¿Tendrías sexo anal?</b></label>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("SexoAnal","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("SexoAnal","","No",false,"custom-control-input",""); ?>             
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Vez porno?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("VezPorno","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("VezPorno","","No",false,"custom-control-input",""); ?>          
                               </div>  
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Con que frecuencia?</b>
                               </div>
                               <div class="row col-md-8">
                                    <div class="col-md-4">
                                         <h6>Diariamente</h6>
                                         <?php echo set_input_radio("FrecuenciaVezPorno","","Diariamente",false,"custom-control-input",""); ?>
                                    </div>
                                    <div class="col-md-4">
                                         <h6>Al menos una vez por semana</h6>
                                         <?php echo set_input_radio("FarecuenciaVezPorno","","Al menos una vez por semana",false,"custom-control-input",""); ?>               
                                    </div>
                                    <div class="col-md-4">
                                         <h6>Al menos una vez al mes</h6>
                                         <?php echo set_input_radio("FrecuenciaVezPorno","","Al menos una vez al mes",false,"custom-control-input",""); ?>
                                    </div>  
                               </div>     
                          </div> 
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Has tenido relaciones sexuales con personas de tu mismo sexo?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("RelacionesConMisnoGenero","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("RelacionesConMisnoGenero","","No",false,"custom-control-input",""); ?>               
                               </div>     
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Tendrías relaciones sexuales con personas de tu mismo sexo?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("TenRelacionesMismoGenero","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("TenRelacionesMismoGenero","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Has realizado sexo oral?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("RealizaSexoOral","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("RealizaSexoOral","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Has salido con alguien por dinero?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("SalidoAlguienDinero","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("SalidoAlguienDinero","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Has tenido relaciones sexuales por dinero?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("SexoPorDinero","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("SexoPorDinero","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Actualmente tienes pareja sexual estable?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("ParejaSexual","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("ParejaSexual","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Tienes tatuajes?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Tatuajes","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Tatuajes","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿En que parte (s) de tu cuerpo? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php set_input("TatuajeParteCuerpo","",$placeholder="Fondo de cesantías",$require=true,"form-control"); ?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Tienes pearcing?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Pearcing","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Pearcing","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Has practicado sexo con dolor? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("SexoConDolor","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("SexoConDolor","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>En caso afirmativo, ¿cómo has actuado? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Dominante</h6>
                                    <?php echo set_input_radio("SexoDolorActuado","","Dominante",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>Sumisa</h6>
                                    <?php echo set_input_radio("SexoDolorActuado","","Sumisa",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Fumas?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Fuma","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Fuma","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Consumes actualmente Drogas?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Drogas","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Drogas","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso13" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>¿Qué estarías dispuesta (o) a hacer en cámara?</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Utilizar consolador? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Consolador","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Consolador","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Utilizar redes sociales con tu nombre artístico? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("NombreArtisticoRss","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("NombreArtisticoRss","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Transmitir con otra persona?  </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("TransmitirConOtro","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("TransmitirConOtro","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Masturbarte?  </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Masturbarte","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Masturbarte","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Sexo anal?   </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("SexoAnal?","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("SexoAnal?","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Utilizar juguetería sexual?   </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("JugueteriaSexual?","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("JugueteriaSexual?","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Baile erótico?   </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("BaileErotico","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("BaileErotico","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Orgasmo online?   </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("OrgasmoOnline","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("OrgasmoOnline","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Leche - MILF?  </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("LecheMilf","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("LecheMilf","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Striptease?  </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Striptease","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Striptease","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Juego de roles? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("JuegoDeRoles","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("JuegoDeRoles","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Disfraces? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("JuegoDeRoles","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("JuegoDeRoles","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Sexo salvaje? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("SexoSalvaje","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("SexoSalvaje","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿CAM2CAM? </b><br/>
                                    Ver la cámara del miembro con el que se está chateando
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Cam2Cam","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Cam2Cam","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Show de aceite? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("ShowAceite","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("ShowAceite","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Nalgadas? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Nalgadas","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Nalgadas","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Doble penetración? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("DoblePenetracion","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("DoblePenetracion","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Orinar - Squirter? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("OrinarSquirter","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("OrinarSquirter","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Hablar sucio? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("HablarSucio","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("HablarSucio","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Fetiche de pies? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("FetichePies","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("FetichePies","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Fetiche de manos? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("FeticheManos","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("FeticheManos","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Show dedos vagina? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("ShowDedosVagina","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("ShowDedosVagina","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Show dedos anal? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("ShowDedosAnal","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("ShowDedosAnal","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Varias chicas en cámara? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("VariasChicasCam","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("VariasChicasCam","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Esclavitud o servidumbre? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("EsclavitudServidumbre","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("EsclavitudServidumbre","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Dominatriz? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Dominatriz","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Dominatriz","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Azote? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Azote","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Azote","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Pezones perforados? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("PezonesPerforados","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("PezonesPerforados","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso14" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Tipo de música preferida.</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Inglés </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Ingles","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Ingles","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Electrónica </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Electrónica","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Electrónica","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Vallenatos </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Vallenatos","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Vallenatos","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Rancheras </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Rancheras","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Rancheras","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Baladas </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Baladas","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Baladas","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Popular </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Popular","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Popular","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Pop en español </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("PopEspañol","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("PopEspañol","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Rock en español </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("RockEspañol","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("RockEspañol","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Rock en inglés</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("RockIngles","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("RockIngles","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso15" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Ciclo menstrual.</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Tu ciclo menstrual es?</b>
                               </div>
                               <div class="col-md-4">
                                    <?php echo MakeCicloMestrual("CicloMes","",array("Class"=>"form-control","require"=>"require"));?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Fechas aproximadas del Periodo</b>
                               </div>
                               <div class="col-md-4">
                                    <?php echo MakePeriodoMestruacion("PeriodoMestruacion","",array("Class"=>"form-control","require"=>"require"));?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Cólicos</b>
                               </div>
                               <div class="col-md-4">
                                    <?php echo MakeDuracionPeriodo("Colicos","",array("Class"=>"form-control","require"=>"require"));?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Duración del periodo</b>
                               </div>
                               <div class="col-md-4">
                                    <?php echo MakeColicos("DuracionPeriodo","",array("Class"=>"form-control","require"=>"require"));?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso16" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>¿De tu cuerpo te gusta?</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Pelo?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Pelo","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Pelo","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Labios?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Labios","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Labios","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Cara?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Cara","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Cara","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Oídos?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Oidos","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Oidos","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Cejas?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Cejas","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Cejas","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Ojos?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Ojos","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Ojos","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Nariz?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Nariz","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Nariz","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Uñas?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Uñas","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Uñas","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Senos?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Senos","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Senos","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Manos?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Manos","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Manos","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Pies?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Pies","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Pies","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Cintura?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Cintura","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Cintura","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Espalda?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Espalda","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Espalda","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Hombros?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Hombros","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Hombros","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Abdomen?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Abdomen","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Abdomen","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Qué es lo que más te gusta de tu cuerpo?</b>
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("MasMegustaDelCuerpo","",$placeholder='Lo que mas te gusta de tu cuerpo',$require=true,"firstLetterText");?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Qué es lo que menos te gusta de tu cuerpo?</b>
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("MenosMegustaDelCuerpo","",$placeholder='Lo que menos te gusta de tu cuerpo',$require=true,"firstLetterText");?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso17" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Contratación.</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Qué vas a decir en casa?</b>
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("QueVasDecirCasa","",$placeholder='Que vas a decir en Casa',$require=true,"firstLetterText");?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group">
                               <div class="col-md-4">
                                    <b>¿Cómo te gustaría llamarte en las páginas?</b>
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("Nickname","",$placeholder='Cómo te gustaría llamarte en las páginas',$require=true,"firstLetterText");?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Estarías dispuesto (a) a firmar contrato por un año?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("FirmarContrato","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("FirmarContrato","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                    </div>
                    <div class="tab-pane col-md-12" id="paso18" role="tabpanel">
                    	<div class="row">
                               <div class="form col-md-12">
                                    <div class="form-group item">
                                         <h3><b>Facultades personales.</b></h3>
                                    </div>
                               </div>
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Aprendes fácilmente?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("AprendeFacil","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("AprendeFacil","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Te gustan los retos?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Retos","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Retos","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Puedes obedecer órdenes?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Ordenes","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Ordenes","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Rompes las reglas?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("RompesReglas","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("RompesReglas","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Eres puntual?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Puntual","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Puntual","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Eres cumplido (a)? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Cumplido","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Cumplido","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Eres responsable? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Responsable","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Responsable","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Cumples horarios? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("CumplesHorarios","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("CumplesHorarios","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Te gusta madrugar? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Madrugar","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Madrugar","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>¿Te gusta trasnochar?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Trasnochar","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Trasnochar","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class="form col-md-12">
                               <div class="form-group item">
                                    <div class="col-md-12">
                                         <h5><b>Certifico que todas las anteriores respuesta son veraces. </b></h5>
                                    </div>
                               </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                                </div>
							</div>
						</div>
                    </div>
                      <div class="col-md-12">
                          <div id="botones" class="text-center">
                          	  <div id="Volver" class="btn btn-primary">ATRAS</div>
                              <div id="Siguiente" class="btn btn-primary">SIGUIENTE</div>
                          </div>
                      </div>
                  </div>                    
            </div>
      </div>
</div>
<?php echo form_close();?>
<script>
$(document).ready(function() {
	//$('.nav-tabs').hide();
    var activo	= $('.nav>li> .active').attr('href');
	$('#Volver').hide();
		$("#Siguiente").click(function(){
			$('#Volver').show();
			$('.nav>li> .active').parent().next().find('a').trigger('click');
				activo	= $('.nav>li> .active').attr('href');
        if(activo=='#paso18'){
          $('#botones').hide();
          $('.nav>li> a').removeAttr('href');
		  
		  
		  
		  function getTimeRemaining(endtime) {
			  var tiempo = Date.now();
			  var mseg = endtime * 60000 + Date.parse(Date.now());
			  var t = mseg - Date.parse(new Date());
			  var segundos = Math.floor((t / 1000) % 60);
			  var minutos = Math.floor((t / 1000 / 60) % 60);
			  var horas = Math.floor((t / (1000 * 60 * 60)) % 24);
			  var dias = Math.floor(t / (1000 * 60 * 60 * 24));
			  console.log(tiempo);
			
			  return {
				'total': t,
				'dias': dias,
				'horas': horas,
				'minutos': minutos,
				'segundos': segundos
			  };
			}

function initializeReloj(id, endtime) {
  var reloj = document.getElementById(id);
  var diaSpan = reloj.querySelector('.dias');
  var horaSpan = reloj.querySelector('.horas');
  var minutoSpan = reloj.querySelector('.minutos');
  var segundoSpan = reloj.querySelector('.segundos');
  console.log(diaSpan);

  function updateReloj() {
		var t = getTimeRemaining(endtime);
		diaSpan.innerHTML = t.dias;
		horaSpan.innerHTML = ('0' + t.horas).slice(-2);
		minutoSpan.innerHTML = ('0' + t.minutos).slice(-2);
		segundoSpan.innerHTML = ('0' + t.segundos).slice(-2);
		if (t.total <= 0) {
		  clearInterval(timeinterval);
		}
	  }
	  updateReloj();
	  var timeinterval = setInterval(updateReloj, 1000);
	}

var deadline = 28;
initializeReloj('reloj', deadline);
		  
		  
		  
		  
		  
		  
		  
		  
        }else{
          $('#botones').show();
        }
		});
		$("#Volver").click(function(){
				$('.nav>li> .active').parent().prev().find('a').trigger('click');
				activo	= $('.nav>li> .active').attr('href');
        if(activo=='#paso1'){
          $('#Volver').hide();
        }else{
          $('#Volver').show();
        }
			});	
});
</script>
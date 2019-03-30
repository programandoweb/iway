
                    <div class="tab-pane col-md-12" id="paso6" role="tabpanel">
                    	 
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
                                    <label><b class="pregunta">¿Has sido modelo webcam?</b></label>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("ModeloWeb","","Si",false,"custom-control-input Mostrar",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("ModeloWeb","","No",false,"custom-control-input Mostrar",""); ?>                  
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
                                    <?php echo form_textarea("FuncionesRealizadas","",$arrayName = array('class' =>"form-control" )); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group Opcional">  
                               <div class="col-md-4">
                                    <b>Fecha de ingreso</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("FechaIngreso","",$placeholder="AA/MM/DD",$require=false,"form-control datepicker"); ?>
                               </div>
                               <div class="col-md-4"></div>
                          </div>
                          <div class="row form-group Opcional">  
                               <div class="col-md-4">
                                    <b>Fecha de retiro</b>   
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("FechaRetiro","",$placeholder="AA/MM/DD",$require=false,"form-control datepicker"); ?>
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
                                    <label><b class="pregunta">Tipo de seguridad social (EPS)</b></label>
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
                                    <b class="pregunta">¿Cuánto sabes de digitación?</b>
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
                                    <b class="pregunta">¿Cuánto sabes de inglés?</b>
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
                                    <b class="pregunta">¿Tienes buena ortografía?</b>
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
                                    <b class="pregunta">¿Sabes bailar?</b>
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
                                    <label><b class="pregunta">¿Utilizas maquillaje?</b></label>
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
                                      <?php echo MakePelo("ColorPelo","",array("Class"=>"form-control")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  
                          </div>
                           <div class="row form-group">
                                 <div class="col-md-4">
                                      <b>Longitud del Cabello </b>
                                 </div>
                                 <div class="col-md-4">
                                      <?php echo MakeLargoPelo("ColorLargoPelo","",array("Class"=>"form-control")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <label><b class="pregunta">¿Utilizas accesorios?</b></label>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Accesorios","","Si",false,"custom-control-input Mostrar",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Accesorios","","No",false,"custom-control-input Mostrar",""); ?>
                               </div>  
                          </div>
                          <div class="row form-group Opcional">
                                 <div class="col-md-4">
                                      <b>Tamaño de tus accesorios </b>
                                 </div>
                                 <div class="col-md-4">
                                      <?php echo Accesorios("TamAccesorios","",array("Class"=>"form-control")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  
                          </div>
                          <div class="row form-group">
                                 <div class="col-md-4">
                                      <b>Estado de las uñas de tus manos. </b>
                                 </div>
                                 <div class="col-md-4">
                                      <?php echo TamAccesorios("TamAccesoriosManos","",array("Class"=>"form-control")); ?>
                                 </div>
                                 <div class="col-md-4"></div>  

                          </div>

                          <div class="row form-group">

                                 <div class="col-md-4">

                                      <b>Estado de las uñas de tus pies. </b>

                                 </div>

                                 <div class="col-md-4">

                                      <?php echo TamAccesorios("EstadoUñasPies","",array("Class"=>"form-control")); ?>

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

                                    <b class="pregunta">¿Puedes sostener conversaciones sobre morbo?</b>

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

                                    <label><b class="pregunta">¿Te masturbas?</b></label>

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

                                    <label><b class="pregunta">¿Con que frecuencia?</b></label>

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

                                    <label><b class="pregunta">¿Tendrías sexo anal?</b></label>

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

                                    <b class="pregunta">¿Vez porno?</b>

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

                                    <b class="pregunta">¿Con que frecuencia?</b>

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

                                    <b class="pregunta">¿Has tenido relaciones sexuales con personas de tu mismo sexo?</b>

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

                                    <b class="pregunta">¿Tendrías relaciones sexuales con personas de tu mismo sexo?</b>

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

                                    <b class="pregunta">¿Has realizado sexo oral?</b>

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

                                    <b class="pregunta">¿Has salido con alguien por dinero?</b>

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

                                    <b class="pregunta">¿Has tenido relaciones sexuales por dinero?</b>

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

                                    <b class="pregunta">¿Actualmente tienes pareja sexual estable?</b>

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
                                    <b class="pregunta">¿Tienes tatuajes?</b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Tatuajes","","Si",false,"custom-control-input Mostrar",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Tatuajes","","No",false,"custom-control-input Mostrar",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group Opcional">
                               <div class="col-md-4">
                                    <b>¿En que parte (s) de tu cuerpo? </b>
                               </div>
                               <div class="col-md-4">
                                    <?php set_input("TatuajeParteCuerpo","",$placeholder="En que parte (s) de tu cuerpo tienes tatuajes",$require=false,"form-control"); ?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b class="pregunta">¿Tienes pearcing?</b>
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
                                    <b class="pregunta">¿Has practicado sexo con dolor? </b>
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
                                    <b class="pregunta">En caso afirmativo, ¿cómo has actuado? </b>
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
                                    <b class="pregunta">¿Fumas?</b>
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
                                    <b class="pregunta">¿Consumes actualmente Drogas?</b>
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
                                    <b class="pregunta">¿Utilizar consolador? </b>
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
                                    <b class="pregunta">¿Utilizar redes sociales con tu nombre artístico? </b>
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
                                    <b class="pregunta">¿Transmitir con otra persona?  </b>
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
                                    <b class="pregunta">¿Masturbarte?  </b>
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
                                    <b class="pregunta">¿Sexo anal?   </b>
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

                                    <b class="pregunta">¿Utilizar juguetería sexual?   </b>

                               </div>

                               <div class="col-md-4">

                                    <h6>Si</h6>

                                    <?php echo set_input_radio("JugueteriaSexual","","Si",false,"custom-control-input",""); ?>

                               </div>

                               <div class="col-md-4">

                                    <h6>No</h6>

                                    <?php echo set_input_radio("JugueteriaSexual?","","No",false,"custom-control-input",""); ?>               

                               </div>       

                          </div>

                          <div class=" row form-group">

                               <div class="col-md-4">

                                    <b class="pregunta">¿Baile erótico?   </b>

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

                                    <b class="pregunta">¿Orgasmo online?   </b>

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

                                    <b class="pregunta">¿Leche - MILF?  </b>

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

                                    <b class="pregunta">¿Striptease?  </b>

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
                                    <b class="pregunta">¿Juego de roles? </b>
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
                                    <b class="pregunta">¿Disfraces? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("Disfraces","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("Disfraces","","No",false,"custom-control-input",""); ?>               
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b class="pregunta">¿Sexo salvaje? </b>
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
                                    <b class="pregunta">¿CAM2CAM? </b><br/>
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
                                    <b class="pregunta">¿Show de aceite? </b>
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

                                    <b class="pregunta">¿Nalgadas? </b>

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

                                    <b class="pregunta">¿Doble penetración? </b>

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

                                    <b class="pregunta">¿Orinar - Squirter? </b>

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

                                    <b class="pregunta">¿Hablar sucio? </b>

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

                                    <b class="pregunta">¿Fetiche de pies? </b>

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

                                    <b class="pregunta">¿Fetiche de manos? </b>

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

                                    <b class="pregunta">¿Show dedos vagina? </b>

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

                                    <b class="pregunta">¿Show dedos anal? </b>

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

                                    <b class="pregunta">¿Varias chicas en cámara? </b>

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

                                    <b class="pregunta">¿Esclavitud o servidumbre? </b>

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

                                    <b class="pregunta">¿Dominatriz? </b>

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

                                    <b class="pregunta">¿Azote? </b>

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
                                    <b class="pregunta">¿Pezones perforados? </b>
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
                                    <b class="pregunta">Inglés </b>
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
                                    <b class="pregunta">Electrónica </b>
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
                                    <b class="pregunta">Vallenatos </b>
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
                                    <b class="pregunta">Rancheras </b>
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
                                    <b class="pregunta">Baladas </b>
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
                                    <b class="pregunta">Popular </b>
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
                                    <b class="pregunta">Pop en español </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("PopEspa","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("PopEspa","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b class="pregunta">¿Pop en inglés? </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("PopIngles","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("PopIngles","","No",false,"custom-control-input",""); ?>         
                               </div>      
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b class="pregunta">Rock en español </b>
                               </div>
                               <div class="col-md-4">
                                    <h6>Si</h6>
                                    <?php echo set_input_radio("RockEspa","","Si",false,"custom-control-input",""); ?>
                               </div>
                               <div class="col-md-4">
                                    <h6>No</h6>
                                    <?php echo set_input_radio("RockEspa","","No",false,"custom-control-input",""); ?>         
                               </div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b class="pregunta">Rock en inglés</b>
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
                                    <?php echo MakeCicloMestrual("CicloMes","",array("Class"=>"form-control"));?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Fechas aproximadas del Periodo</b>
                               </div>
                               <div class="col-md-4">
                                    <?php echo MakePeriodoMestruacion("PeriodoMestruacion","",array("Class"=>"form-control"));?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Cólicos</b>
                               </div>
                               <div class="col-md-4">
                                    <?php echo MakeDuracionPeriodo("Colicos","",array("Class"=>"form-control"));?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Duración del periodo</b>
                               </div>
                               <div class="col-md-4">
                                    <?php echo MakeColicos("DuracionPeriodo","",array("Class"=>"form-control"));?>
                               </div>
                               <div class="col-md-4"></div>       
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Talla de senos o tamaño del pene:</b>
                               </div>
                               <div class="col-md-8">
                                    <?php set_input("TamMiembro","",$placeholder='Talla de senos o tamaño del pene:',$require=true,"firstLetterText");?>
                               </div>    
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Cintura (según medida de jeans):</b>
                               </div>
                               <div class="col-md-8">
                                    <?php set_input("MedidaCintura","",$placeholder='Cintura (según medida de jeans):',$require=true,"firstLetterText");?>
                               </div>    
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Estatura - metros:</b>
                               </div>
                               <div class="col-md-8">
                                    <?php set_input("EstaturaMetros","",$placeholder='Estatura - metros:',$require=true,"firstLetterText");?>
                               </div>    
                          </div>
                          <div class=" row form-group">
                               <div class="col-md-4">
                                    <b>Peso – kilos:</b>
                               </div>
                               <div class="col-md-8">
                                    <?php set_input("PesoKilos","",$placeholder='Peso – kilos:',$require=true,"firstLetterText");?>
                               </div>    
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
                                    <b class="pregunta">¿Pelo?</b>
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
                                    <b class="pregunta">¿Labios?</b>
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
                                    <b class="pregunta">¿Cara?</b>
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
                                    <b class="pregunta">¿Oídos?</b>
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
                                    <b class="pregunta">¿Cejas?</b>
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
                                    <b class="pregunta">¿Ojos?</b>
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
                                    <b class="pregunta">¿Nariz?</b>
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
                                    <b class="pregunta">¿Uñas?</b>
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
                                    <b class="pregunta">¿Senos?</b>
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
                                    <b class="pregunta">¿Manos?</b>
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
                                    <b class="pregunta">¿Pies?</b>
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
                                    <b class="pregunta">¿Cintura?</b>
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
                                    <b class="pregunta">¿Espalda?</b>
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
                                    <b class="pregunta">¿Hombros?</b>
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
                                    <b class="pregunta">¿Abdomen?</b>
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
                                    <b class="pregunta">¿Estarías dispuesto (a) a firmar contrato por un año?</b>
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
                                    <b class="pregunta">¿Aprendes fácilmente?</b>
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
                                    <b class="pregunta">¿Te gustan los retos?</b>
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
                                    <b class="pregunta">¿Puedes obedecer órdenes?</b>
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
                                    <b class="pregunta">¿Rompes las reglas?</b>
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
                                    <b class="pregunta">¿Eres puntual?</b>
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
                                    <b class="pregunta">¿Eres cumplido (a)? </b>
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
                                    <b class="pregunta">¿Eres responsable? </b>
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
                                    <b class="pregunta">¿Cumples horarios? </b>
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
                                    <b class="pregunta">¿Te gusta madrugar? </b>
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
                                    <b class="pregunta">¿Te gusta trasnochar?</b>
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
                                         <h5><b class="pregunta">Certifico que todas las anteriores respuestas son veraces. </b></h5>
                                         <div class="col-md-4">
                                              <h6>Si</h6>
                                              <?php echo set_input_radio("AseptoTerminos","","Si",false,"custom-control-input Mostrar",""); ?>
                                         </div>
                                         <div class="col-md-4">
                                              <h6>No</h6>
                                              <?php echo set_input_radio("AseptoTerminos","","No",false,"custom-control-input Mostrar",""); ?>         
                                         </div>  
                                    </div>
                               </div>
                          </div>
                          <div class="row Opcional">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                                </div>
              							</div>
              						</div>
                    </div>
                      <div class="col-md-12 certifico">
                          <div id="botones" class="text-center">
                          	  <div id="Volver" class="btn btn-primary">ATRAS</div>
                              <div id="Siguiente" class="btn btn-primary">SIGUIENTE</div>
                          </div>
                      </div>
                  </div>                    
            </div>
      </div>
</div>
<?php
if($this->session->userdata("Entrevista")){
  echo form_close();
}else{
  echo '<script type="text/javascript">
          $(document).ready(function(){
          $("button[type=submit]").attr("id","mensaje");
          });
        </script>';
} 
?>
<script>

$(document).ready(function() {
  $('.certifico').hide();
  $('.check').click(function(){
        if($(this).val()=="Si"){
          $('.certifico').slideDown(1000);
        }else{
          $('.certifico').slideUp(1000);
        }
      });
  $('#mensaje').click(function() {
      make_message('Error','estos datos no seran guardados debido a que usted no cuenta con una invitacion de entrevista valida');
  });
	$('.nav-tabs').hide();
  $('.Opcional').hide();

    var activo	= $('.nav>li> .active').attr('href');		

	$('#Volver').hide();

	$("#Siguiente").click(function(){

      var set_inputs  = $(".tab-content> .active").find("input[require]");
      var input_radio_checkeado = $(".tab-content> .active").find("input[type=radio]:checked").length;
      var total_input_radio = $(".tab-content> .active").find(".pregunta").length;
      var retorno     = false;
      var casilla     = "";
      set_inputs.each(function(){
          if($(this).val()==""){
            retorno = true;
            casilla = $(this).attr('placeholder');
          } 
      });
        if(input_radio_checkeado!=total_input_radio){
          make_message("No es posible continuar","Falta alguna casilla de verificacion por llenar ");
              retorno = true;
        }      

      if(retorno==true){
        make_message("No es posible continuar","Por favor complete los campos requeridos "+casilla);
        return;

      }      

      $('#Volver').show();
			$('.nav>li> .active').parent().next().find('a').trigger('click');
				activo	= $('.nav>li> .active').attr('href');
        if(activo=='#paso18'){
          $('#botones').hide();	  
        }else{
          $('#botones').show();
        }

    $(".tab-content> .active").find('.Mostrar').click(function(){
        if($(this).val()=="Si"){
          $(".tab-content> .active").find('.Opcional').slideDown(1000);
          $(".tab-content> .active").find('.Opcional').find('input').attr('require', true);
        }else{
          $(".tab-content> .active").find('.Opcional').slideUp(1000);
          $(".tab-content> .active").find('.Opcional').find('input').removeAttr('require');
        }
      });
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
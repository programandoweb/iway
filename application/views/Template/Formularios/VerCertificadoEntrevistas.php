<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/?>
<?php 
echo form_open(current_url("Formularios/Autenticacion"));
$modulo     =   $this->ModuloActivo;
$empresa = centrodecostos($this->user->id_empresa);
?>
<div class="container" style="margin-bottom:20px;">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="form">
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <h3>GH1-02 Certificado entrevista aspirante <?php echo $empresa->nombre_legal; ?> - Versión 01</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                    <?php
                        foreach($this->$modulo->result as  $key => $v){
                            $datos_entrevistado =    json_decode($v->json_entrevista);                                 
                    ?> 
                 <div class="col-md-12 text-center"><h6>FUNCIONARIO RESPONSABLE DE LA ENTREVISTA <?php echo $empresa->nombre_legal; ?></h6></div>
                 <div class="col-md-12 mt-3">
                      Yo _____________________________________certifico  que  el  día de hoy <?php echo date('d') ?> del mes de <?php setlocale(LC_ALL,"es_ES");
                                echo strftime("%B"); ?> del año <?php echo date('Y'); ?>    ; he procedido a entrevistar al aspirante cuyos datos se relacionan a continuación, en la sede de <?php echo $empresa->nombre_legal; ?>, ubicada en la Ciudad de <?php echo $empresa->ciudad ?>
                                del Departamento de <?php echo $empresa->departamento ?>;   en  la  dirección <?php echo $empresa->direccion ?>
                                    ; donde he podido certificar, que es mayor de edad, en cumplimiento del Código de infancia y adolescencia (ley 1098 de 2006), el Código Penal Colombiano (Ley 599 del 2000) | Articulo 219 - Utilización o facilitación de medios de comunicación para ofrecer actividades sexuales con personas menor de 18 años, la ley 679 de 2001 y  normas concordantes, certifico que he dado inicio a la entrevista y presentación general de nuestra empresa a las <?php echo date("h:i a"); ?> y ha
                                terminado a las ________(AM PM ).
                 </div>
                 <div class="col-md-12 text-center mt-3">
                     <h6>DATOS ENTREVISTADO (A)</h6>
                 </div>
                 <div class="row col-md-12 mt-3">
                     <div class="col-md-4"><b>Nombre completo</b></div>
                     <div class="col-md-8">
                         <?php    
                                if(!empty($datos_entrevistado->PrimerNombre)){
                                           echo $datos_entrevistado->PrimerNombre." ";
                                } 
                                if(!empty($datos_entrevistado->SegundoNombre)){
                                   echo $datos_entrevistado->SegundoNombre." ";
                                }
                                if(!empty($datos_entrevistado->PrimerApellido)){
                                   echo $datos_entrevistado->PrimerApellido." ";
                                } 
                                if(!empty($datos_entrevistado->SegundoApellido)){
                                   echo $datos_entrevistado->SegundoApellido." ";
                                }
                            ?>
                     </div>
                     <div class="col-md-3"><b>Número ID</b></div>
                     <div class="col-md-3"><?php echo $v->entrevista_id ?></div>
                     <div class="col-md-3"><b>Ciudad  expedición</b></div>
                     <div class="col-md-3">
                         <?php 
                              if(!empty($datos_entrevistado->CiudadExpedicion)){
                                   echo $datos_entrevistado->CiudadExpedicion;
                                } 
                         ?>
                     </div>
                     <div class="col-md-4"><b>Número Contacto</b></div>
                     <div class="col-md-8">
                       <?php
                            if(!empty($datos_entrevistado->Ind)){
                                   echo $datos_entrevistado->Ind." ";
                                }
                            if(!empty($datos_entrevistado->Ind2)){
                               echo $datos_entrevistado->Ind2." ";
                            }
                            if(!empty($datos_entrevistado->NumCel)){
                               echo $datos_entrevistado->NumCel;
                            }
                         ?>
                         <?php
                            if(!empty($datos_entrevistado->IndF)){
                                   echo " Fijo: ".$datos_entrevistado->IndF." ";
                                }
                            if(!empty($datos_entrevistado->Ind2F)){
                               echo $datos_entrevistado->Ind2F." ";
                            }
                            if(!empty($datos_entrevistado->NumFijo)){
                               echo $datos_entrevistado->NumFijo;
                            }
                         ?>   
                     </div>
                     <div class="col-md-4"><b>Correo electrónico</b></div>
                     <div class="col-md-8">
                        <?php echo  $v->email ?> 
                     </div>
                     <div class="col-md-12 mt-4">
                        Yo <b><?php    
                                if(!empty($datos_entrevistado->PrimerNombre)){
                                           echo $datos_entrevistado->PrimerNombre." ";
                                } 
                                if(!empty($datos_entrevistado->SegundoNombre)){
                                   echo $datos_entrevistado->SegundoNombre." ";
                                }
                                if(!empty($datos_entrevistado->PrimerApellido)){
                                   echo $datos_entrevistado->PrimerApellido." ";
                                } 
                                if(!empty($datos_entrevistado->SegundoApellido)){
                                   echo $datos_entrevistado->SegundoApellido." ";
                                }?></b>
                                 por la presente certifico que soy consciente que <?php echo $empresa->nombre_legal; ?> es una empresa de entretenimiento para adultos, la cual opera y gestiona plataformas digitales de contenido erótico, estoy de manera libre y voluntaria dentro de estas instalaciones, soy de mente sana, tengo dieciocho (18) años o más, he presentado documentación que acredita mi edad y certifico que no he sido obligada o presionada de ninguna manera a entrevistarme o llegar a contratar los servicios de esta empresa, así mismo comprendo que deberé presentar tres (3) test virtuales (entrevista psicotécnica, test de inglés y test de digitación), igual que una entrevista presencial que bajo ninguna circunstancia implicará contacto físico con algún funcionario o Directivo de <?php echo $empresa->nombre_legal; ?>, así mismo se me ha informado que por mi seguridad este espacio esta siendo monitoreado por circuito cerrado de televisión (CCTV), durante el desarrollo de esta entrevista, se me ha informado sobre:
                    </div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>a. La posibilidad de ser visto (a) en Colombia por medio de aplicativos virtuales</p></div>
                    <div class="col-md-2">(Máscaras IP) <b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>b. La posibilidad de ser grabado o que se generen imágenes o vídeos de mis actuaciones en servidores NO administrados por <?php echo $empresa->nombre_legal; ?>.</p></div>
                    <div class="col-md-2"><b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>c. El tipo de actividad desarrollada por <?php echo $empresa->nombre_legal; ?>, donde se me ha explicado de manera detallada sobre la gestión de una o más sitios web que ofrecen servicios de entretenimiento interactivo para adultos en vivo y las implicaciones que esto tienen a nivel personal, legal y social.</p></div>
                    <div class="col-md-2"><b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>d. Las condiciones en que eventualmente contrataré los servicios de <?php echo $empresa->nombre_legal; ?>, donde contaré con un espacio de transmisión en el turno de la mañana   , tarde     , noche     o satélite (desde casa)</p></div>
                    <div class="col-md-2"><b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>e. La forma y métodos de pago y liquidación de los dineros recaudados, donde se me ha notificado sobre la existencia de un pacto comercial que busca generar estabilidad económica para el desarrollo de mis actividades, así como la practica de Retención en la fuente equivalente al Cuatro (4) por ciento del valor total de mis ingresos recibidos.</p></div>
                    <div class="col-md-2"><b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>f. Las fechas y ciclos de pagos de los dineros recaudados por concepto de entretenimiento para adultos en las plataformas virtuales a las que <?php echo $empresa->nombre_legal; ?> opte por afiliarme.</p></div>
                    <div class="col-md-2"><b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>g. El compromiso esperado por parte de <?php echo $empresa->nombre_legal; ?> en el desarrollo de mis actividades diarias, donde se incluye pero no se limita la asistencia puntual al turno contratado, la buena presentación personal, la gestión de redes sociales que apoyen mi desarrollo comercial, el acatamiento de las normas internas consignado en el documento GH3-01 Reglamento Interno <?php echo $empresa->nombre_legal; ?> Versión 02 del 08 de Diciembre de 2017.</p></div>
                    <div class="col-md-2"><b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>h. La dignidad y legalidad existente en el desarrollo de esta actividad.</p></div>
                    <div class="col-md-2"><b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="col-md-12 mt-4 text-center"><h6>INFORMO QUE MI DESICIÓN SERÁ LA DE:</h6></div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>a. Contratar los servicios profesionales de <?php echo $empresa->nombre_legal; ?></p></div>
                    <div class="col-md-2"><b><?php  if(!empty($datos_entrevistado->certifico)){
                                   echo $datos_entrevistado->certifico;
                                } ?></b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>b. Esperar un tiempo prudente para la contratación de los servicios profesionales de <?php echo $empresa->nombre_legal; ?></p></div>
                    <div class="col-md-2"><b>No</b></div>
                 </div>
                 <div class="row col-md-12 mt-3">
                    <div class="col-md-10"><p>c. Rechazar de manera definitiva e irrevocable la oferta de <?php echo $empresa->nombre_legal; ?></p></div>
                    <div class="col-md-2"><b>No</b></div>
                 </div>
                 <div class="col-md-12 mt-4 text-center">
                     <h6>CON MI FIRMA CERTIFICO LA VERACIDAD DE LA TOTALIDAD DE LA INFORMACIÓN ANTERIOR.</h6>
                 </div>
                 <div class="col-md-12 row" style="min-height: 90px;">
                     <div class="col-md-4"><p>Firma entrevistado (a)</p></div>
                     <div class="col-md-5"></div>
                     <div class="col-md-3"><p>Huella</p></div>
                 </div>
                 <div class="col-md-12 row" style="min-height: 90px;">
                     <div class="col-md-4">Firma funcionario <?php echo $empresa->nombre_legal; ?></div>
                     <div class="col-md-5"></div>
                     <div class="col-md-3">Huella</div>
                 </div>
                 <div class="col-md-12 row" style="min-height: 90px;">
                     <div class="col-md-4">Firma Gerente de sede <?php echo $empresa->nombre_legal; ?></div>
                     <div class="col-md-5"></div>
                     <div class="col-md-3">
                            <img src="<?php echo $empresa->firma; ?>" alt="No se encontro Una firma valida">
                        Huella
                     </div>
                 </div>
                    <?php 
                        } 
                    ?>
            </div>
        </div>	
    </div>
</div>
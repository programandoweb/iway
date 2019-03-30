<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
    $modulo                     =   $this->ModuloActivo;
    $data = $this->$modulo->result;
    $user = centrodecostos($data[0]->id_modelo);
    $empresa_modelo = centrodecostos($data[0]->id_empresa);
    $centro_costos_modelo = centrodecostos($data[0]->centro_de_costos);
    if(centrodecostos($data[0]->id_empresa)->periodo_pagos == 2){
        $dias = 13;
    }else{
        $dias = 6;
    }
?>
<style type="text/css" media="screen">
    p{
        text-align: justify;
    }
    .line_height p{
        line-height: 14px;
    }
</style>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="cabecera">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
            </td>
            <td style="text-align:right;font-size:12px;font-weight:bold;" valign="top">
               <?php echo $empresa->nombre_legal?><br />
                <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php  echo $centrodecostos->direccion; ?><br />
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br />
            </td>
        </tr>
    </table>
     <div class="footer bordetop pie_de_pagina">
      <table>
          <tr>
              <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha generacion documento <?php echo date("Y-m-d"); ?></td>
              <td style="text-align: center;font-size: 9px;">
              </td>
              <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
          </tr>
      </table>
  </div>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Tercero</b></div>
                  <table>
                      <tr>
                        <td>
                            <b>
                                <?php
                                    echo nombre($user); ?></b>
                        </td>
                      </tr>
                      <tr>
                          <td>NIT (Id): <b><?php echo @$user->identificacion; ?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección: <b><?php echo @$user->direccion;; ?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo @$user->ciudad; ?></td>
                      </tr>
                      <tr>
                          <td>Teléfono: <b><?php echo (!empty($user->telefono)?$user->telefono:"N.A."); ?></b></td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td width="120">
                                Reporte Diario: 
                             </td>
                             <td>
                                <b>
                                    <?php echo @$centro_costos_modelo->abreviacion.' '.@tipo_documento($data[0]->tipo_documento,true).' '.ceros(@$data[0]->consecutivo); ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo $data[0]->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo $data[0]->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
                                    <?php 
                                        if($this->$modulo->result[0]->estado==9){
                                    ?>
                                        Anulado    
                                    <?php       
                                        }else{
                                    ?>
                                        Procesado
                                    <?php
                                        }
                                    ?>        
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Ciclo:</td>
                             <td></b><?php echo @$data[0]->ciclo_pago; ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle Reporte Diario: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table class="table" border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th>Plataforma</th>
                <th>Usuario</th>
                <th>Producción</th>
            </tr>
        </thead>
            <tbody>
                <?php
                    if(count($this->$modulo->result)>0){
                        $suma_equivalencia = 0;
                        foreach($this->$modulo->result as $v){
                            $detalle    =   $this->Reportes->get_detalle($v->fecha,$v->estado,$v->consecutivo);
                ?>
                            <tr>
                                <td>
                                    <?php 
                                        foreach($detalle as $k2=>$v2){
                                            echo '<div class="bordetop">';
                                                print_r($v2->primer_nombre);
                                            echo '</div>';  
                                        }                                                   
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        foreach($detalle as $k2=>$v2){
                                            echo '<div class="bordetop">';
                                            echo $v2->nickname;
                                            echo '</div>';
                                        }   
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php 
                                        foreach($detalle as $k2=>$v2){
                                            echo '<div class="bordetop">';
                                                echo format($v2->tokens,true).' ';
                                                $suma_equivalencia      +=  $v2->tokens;
                                            echo '</div>';  
                                        }                                                   
                                    ?>                                              
                                </td>
                            </tr>
                <?php       
                        }
                    }else{
                ?>
                <?php       
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class="colorFondo">
                    <td></td>
                    <td class="text-right"><b>Total:</b></td>                                
                    <td class="text-right" style="text-align: right"><b><?php echo format($suma_equivalencia,true).' ';?></b></td>
                </tr>
            </tfoot>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Análisis de cumplimiento diario: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table class="table" border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th>Detalle</th>
                <th>Análisis</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bordeBottom">Meta ideal (<b>diaria</b>)</td>
                <td class="bordeBottom" style="text-align: right;"><?php $meta_diaria = ($user->meta_ideal/$dias); echo format($meta_diaria,true); ?></td>
            </tr>
            <tr>
                <td class="bordeBottom">Producción actual</td>
                <td class="bordeBottom" style="text-align: right;"><?php echo format($suma_equivalencia,true); ?></td>
            </tr>
            <tr>
                <td class="bordeBottom">Cumplimiento</td>
                <td class="bordeBottom" style="text-align: right;">
                <?php
                    if($suma_equivalencia == 0 || $meta_diaria == 0){
                        echo '0';
                    }else{
                        echo format(($suma_equivalencia*100)/$meta_diaria,true);
                    }
                ?> %
                </td>
            </tr>
        </tbody>
    </table>
    <div style="height:20px; "></div>
    <div class="recuadro fondoCell bordeAll" style="margin-bottom: 180px;">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                    Certifico que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento.
                    <?php echo(!empty($data[0]->id_modelo))?" Documento elaborado por <b>".nombre(centrodecostos($data[0]->id_modelo)).'</b>':''; ?>
                </td>
            </tr>
        </table>
        <div style="width: 100%;">
            <div style="height: 40px;"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="45%">
                        <div class="bordetop linea">
                            Elaboró:
                        </div>
                    </td>
                    <td width="10%"> </td>
                    <td width="45%"> 
                        <div class="bordetop linea"> 
                            Revisó:
                        </div>
                    </td>
                </tr>
            </table> 
        </div>
    </div> 
    <div class="line_height">
        <h5 style="text-align: center;">Términos y condiciones.</h5>

        <p><b>¡<?php echo nombre($user); ?> hemos recibido tu informe!</b>, este ha sido almacenado en la base de datos administrada por Ingeniar™; empresa propietaria del  aplicativo www.webcamplus.com.co y quien actúa como proveedor tecnológico; para efectos de seguridad, respaldo y seguimiento una copia de la información suministrada ha sido enviada a tu email, esta información se considera dentro de la categoría de NO PÚBLICA y NO constituye bajo ningún motivo aceptación por parte de <b><?php echo nombre($empresa_modelo); ?></b>, toda información será verificada de manera detallada, el uso inadecuado del presente informe será tu responsabilidad.</p>

        <p>Queremos recordarte que <b><?php echo nombre($empresa_modelo); ?></b> gestiona páginas de entretenimiento para adultos de contenido erótico, igualmente que estas de manera libre y voluntaria dentro de sus instalaciones, eres de mente sana, tienes dieciocho (18) años o más, has presentado documentación que acredita tu edad y certificas que: no has sido obligado (a) o presionado (a) de ninguna manera, de igual manera certificas con el envío del presente reporte diario de producción que  has asistido el día de hoy a tu turno de transmisión de manera libre y voluntaria, para realizar la actividad de modelo webcam, mediante contrato de mandato o cuentas en participación.</p>

        <p><b><?php echo nombre($empresa_modelo); ?> </b> hace claridad respecto a la posibilidad de que seas vista en Colombia a través de mecanismos virtuales o programas informáticos diseñados para tal fin, igualmente certificas que ha sido informada por <b><?php echo nombre($empresa_modelo); ?> </b> de manera detallada respecto a la posibilidad de quedar información (imágenes o videos) de los shows realizados con tu o tus nickname - nombre sustituto adoptado por ti frente a la web con el fin de preservar tu identidad - en diversos servidores los cuales NO son administrados, ni tiene competencia <b><?php echo nombre($empresa_modelo); ?> </b>, por lo anterior <b><?php echo nombre($empresa_modelo); ?> </b>  no mediará para la eliminación de dicho material de las diferentes plataformas web dedicadas a esta práctica, situación que has aceptado.</p>

        <p><b><?php echo nombre($empresa_modelo); ?></b> en cumplimiento del Artículo 114 de la Ley de Financiamiento 2018 y del parágrafo tercero, del Estatuto Tributario, podrá (deberá) practicarte retención en la fuente a título de Renta, en calidad de persona Jurídica y/o Natural, exportador(a) de servicios de entretenimiento para adultos a través del sistema webcam por los servicios desarrollados mediante tu contrato de mandato y/o cuentas en participación.</p>

        <h5 style="text-align: center;">Política de privacidad.</h5>
        <p><b><?php echo nombre($empresa_modelo); ?> </b> (en adelante “LA EMPRESA” o “Nosotros”) valora a sus integrantes y está comprometida a proteger su privacidad, en el desempeño de dicho compromiso, LA EMPRESA ha aceptado esta política de privacidad, desarrollada por Ingeniar™; empresa propietaria del  aplicativo www.webcamplus.com.co y quien actúa como proveedor tecnológico (en adelante, la “Política de Privacidad” o “Política”) que describe las políticas y prácticas en lo que se refiere a la recolección, uso y divulgación de información personal recopilada, al visitar, utilizar y/o registrarse en este sitio web (en adelante, el “Sitio Web”).</p> 
        <p><b><?php echo nombre($user); ?> </b> te reconoces como usuario de la plataforma, por lo anterior aceptas las prácticas que se detallan a continuación. esta política contiene las prácticas de privacidad del sitio web operado por LA EMPRESA, en cumplimiento de la ley de protección de datos personales en Colombia, ley número 1581 de 2012 y decreto número 1377 de 2013 y sus normas complementarias (en adelante, “LPDP”).</p>

        <p>a.  Información Recopilada: LA EMPRESA recibe y almacena cualquier información que los usuarios proporcionen al navegar por el sitio web, al utilizar este servicio en línea, ya sea al proporcionarlos de manera telefónica en nuestro centro de atención, al participar en promociones y ofertas, al registrarte como usuario y/o autorizar tu registro por intermedio de <b><?php echo nombre($empresa_modelo); ?></b>, vía correo electrónico, información publicada en los foros, grupos de chat o comentarios mediante los cuales interactúe en el sitio web, al utilizar nuestra aplicación para teléfonos móviles y tabletas (la “aplicación”) o de cualquier forma cuando contratas con nosotros algún producto o servicio, la información recopilada (en adelante la “información personal”) incluye –entre otros- nombres y apellidos, dirección postal, nacionalidad, número telefónico, clave de identificación tributaria, dirección de correo electrónico, y en sí todo dato suministrado por LA EMPRESA, podrás elegir no darnos información, pero en general se requiere cierta información para realizar operaciones en nuestro sitio web o la aplicación, si eliges no darnos determinada información, entonces no podrás utilizar nuestro aplicativo.</p>

        <p>b.  Otra Información Recopilada: En la medida permitida por la ley, el aplicativo podrá obtener información personal y añadirla a la Información Personal que LA EMPRESA y/o tú previamente nos has proporciono ya sea de entidades afiliadas o socios comerciales, la información recopilada durante una entrevista, conversación telefónica, chat y/o a través de aplicaciones interactivas. ten en cuenta que toda la información que recopilamos puede combinarse con la información personal para, por ejemplo, ayudarnos a adaptar nuestras comunicaciones a tus necesidades y desarrollar nuevos productos o servicios que puedan ser de tu interés.</p> 

        <p>Cualquier Información personal obtenida por LA EMPRESA por los medios aquí descriptos será tratada de conformidad con las disposiciones de esta política de privacidad, tal como establece esta política más abajo, esta política no cubre las prácticas de aquellos terceros de los cuales recibimos información.</p>

        <p>c.  Autorización de registro y tratamiento de la información personal: Al visitar, utilizar y/o registrarte en el sitio web y/o en la aplicación, autorizas expresamente a registrar y tratar tu información personal para –entre otros- los siguientes fines: llevar a cabo las transacciones u operaciones que hayas iniciado; ofrecerte productos y servicios; remitirte confirmación y actualizaciones sobre tus solicitudes; procesamiento de informes; responder a tus preguntas y comentarios; contactarte para propósitos de servicio al cliente, realizar encuestas, estadísticas o análisis sobre hábitos de consumo o preferencias, notificarte por correo electrónico las ofertas especiales, actividades y los productos y servicios que podrían ser de  tu interés salvo que no lo desees (ver más adelante: política de renuncia “Opt. Out”).</p>

        <p>d.  Almacenamiento y transferencia de información personal; consentimiento: toda información personal es recolectada y almacenada en servidores ubicados físicamente en los Estados Unidos, podremos reubicar estos servidores en cualquier otro país, en el futuro, y almacenar información personal en los Estados Unidos o en otros países, con fines de respaldo o back up. prestas tu consentimiento inequívoco para que el aplicativo pueda transferir datos con destino a cualquier país del mundo, al remitir información personal en el aplicativo, podrás autorizar y prestar tu consentimiento libre e informado (a) para que, de conformidad con la LPDP y nuestra política de privacidad, el aplicativo recopile, utilice y almacene tu Información personal para (i) proveer los productos y servicios que solicites; y (ii) enviarte información relevante en forma personalizada – incluido pero no limitado a la promoción de los productos, servicios y producción diaria o quincenal -. En el caso de transferencia de datos personales, informamos que el receptor de los datos personales asumirá las mismas obligaciones que corresponden al responsable que transfiere los datos personales.</p>

        <p>e.  Custodia y confidencialidad de la información personal:  La información personal será tratada con el grado de protección legalmente exigible para garantizar la seguridad de la misma y evitar su alteración,</p>

            <p>f.  Pérdida, tratamiento o acceso no autorizado: El aplicativo resguarda tu Información personal de acuerdo a estándares y procedimientos de seguridad y confidencialidad impuestas por la LPDP, no transmitiremos, divulgaremos o proporcionaremos tu Información personal recopilada a terceros diferentes del titular de dicha información personal y/o aquellos terceros descriptos en la presente política. En este sentido, el aplicativo toman los recaudos para proteger la Información personal de nuestros usuarios.</p>

            <p>g.  Acceso a la información personal por terceros: Prestas tu consentimiento inequívoco para que el aplicativo pueda compartir la Información personal relevante de sus usuarios con proveedores para la gestión de sus páginas, tales como proveedores de correo electrónico, páginas de entretenimiento para adultos y proveedores de productos o servicios que contrates con él aplicativo, además, el aplicativo podrá compartir Información personal con socios comerciales, con quienes conjuntamente podríamos ofrecer productos o servicios, dichos proveedores y socios comerciales están sujetos a contratos de confidencialidad que prohíben la utilización o divulgación no autorizada de la información personal a la cual tienen acceso. El aplicativo podrá compartir también su información personal con la finalidad de cumplir la normativa aplicable y cooperar con las autoridades competentes. Finalmente, el aplicativo podrá también compartir tu información personal con las empresas pertenecientes a Ingeniar™.</p>

        <p>h.  Política de renuncia (opt out): Cuando realices informes, transacciones o te registres como usuario, se te dará una opción en cuanto a si desea recibir circulares promocionales, mensajes o alertas de correo electrónico sobre ofertas, podrás modificar tus elecciones en cualquier momento, a través de la configuración de correo electrónico de la página del aplicativo www.webcamplus.com.co, aunque actualmente no lo hace, él aplicativo se reserva el derecho de restringir el registro en el futuro a aquellos usuarios que NO aceptan recibir circulares promocionales, mensajes o alertas de correo electrónico, también se te dará en cada mensaje de correo electrónico que te enviemos la oportunidad de darte de baja en la subscripción a la recepción de mensajes.</p>

        <h5 style="text-align: center;">Uso de la página (Plataforma).</h5>

        <p>Ten presente que cuando accedes al aplicativo nosotros automáticamente recibimos información sobre ti y tu computadora, por ejemplo, recibimos información de cookies (ver definición más abajo), web beacons (ver definición más abajo) respecto de tu navegador y tu sistema operativo, de las páginas de Internet que has visitado, de los enlaces que has visto, de la(s) dirección(es) de IP de tu computadora y del sitio web que cerraste antes de ingresar a nuestro aplicativo; el aplicativo utiliza la información recopilada principalmente para mejorar tu experiencia de usuario y mejorar nuestro servicio, en todo momento, podrás elegir no recibir un archivo de cookies habilitando tu navegador web para que rechace cookies o te informe antes de aceptarlas, ten en cuenta que al negarte a aceptar una cookie no podrás obtener acceso al aplicativo y herramientas de planificación ofrecidos por este aplicativo.</p>

        <p>“Cookies” son archivos de texto que se descargan automáticamente y se almacenan en el disco rígido de tu computadora cuando navegas en una página o en un portal de internet específico, los cuales permiten guardar cierta cantidad de datos sobre tu actividad en internet. Las cookies se utilizan con el fin de conocer los intereses, el comportamiento y la demografía de quienes visitan o son usuarios de nuestro aplicativo y de esa forma, comprender mejor tus necesidades e intereses y dartes un mejor servicio o proveerte información relacionada. También usaremos la información obtenida por intermedio de las cookies para analizar las páginas navegadas por el visitante o usuario, las búsquedas realizadas, mejorar nuestras iniciativas comerciales y promocionales, mostrar publicidad o promociones, banners de interés, personalizar contenidos, presentación y servicios.</p>

        <p>“Web beacons” son imágenes que pueden aparecer insertadas en páginas y sitios web y tienen una finalidad similar a los cookies. Adicionalmente un Web beacon es utilizado para medir patrones de tráfico de los usuarios de una página a otra con el objeto de maximizar como fluye el tráfico a través de la Web.</p>

        <p>a.   Protección de contraseñas y acceso: Al registrarte en él aplicativo te hemos asignado un usuario y una contraseña (es decir, acceder a una cuenta personal dentro del aplicativo, llamado “Autenticacion”), asimismo, el aplicativo te permite acceder a través de tu cuenta de facebook, de google+ u otras redes sociales (en adelante las “redes sociales”) que en el futuro se compatibilicen con el acceso al aplicativo, si pierdes el control de tu cuenta o contraseña de acceso a las redes sociales puedes perder el control de tu información personal y estarías sujeto a transacciones legalmente válidas llevadas a cabo en tu nombre. Por lo tanto, si por cualquier razón tu contraseña llega a estar comprometida, deberás de inmediato: (i) cambiarla, modificando tu información de registro que fue entregada a este aplicativo, y/o (ii) contactarnos.</p>

            <p>b.  Vínculos externos: Este aplicativo puede contener vínculos (links) a otros sitios web que tienen sus propias políticas de privacidad y confidencialidad, por ello te recomendamos que si visitas esos otros sitios web, revises cuidadosamente sus prácticas y políticas de confidencialidad, toda vez que esta política de privacidad no cubre las prácticas o políticas de terceros, incluyendo aquellos que pueden revelar y/o compartir información con el aplicativo.</p>

        <p>c.  Información Pública: Ten presente que cuando colocas información en un área pública de este aplicativo sin limitar: avisos, grupos de chat, álbumes de fotografías electrónicos y comentarios sobre los productos y servicios), la estás poniendo a disposición de otros miembros, usuarios del aplicativo y al público en general; lo cual queda fuera del ámbito de control del aplicativo, por favor, recuerda lo anterior y se cuidadoso (a) con la información que decides divulgar.</p>

        <p>d.  Responsable de la protección de tu información personal: <b>Ingeniar Proyectos y Desarrollos de Colombia S.A.S. (Carrera 31 # 15 – 87, Sector San Luis, Complejo Tecnológico ParqueSoft Risaralda, Pereira (Risaralda) Colombia).</b></p>

        <p>e.  Modificaciones: Ingeniar™ podrá realizar modificaciones a esta política de privacidad en el futuro, cualquier modificación a la manera como Ingeniar™ utiliza la información personal será reflejada en versiones futuras de esta “Política de Privacidad,” y serán publicadas en el aplicativo, por lo que se te aconseja revisar periódicamente la Política de Privacidad.</p>

        <p>f.  Contacto: Si tienes preguntas sobre esta política de privacidad, las prácticas de Ingeniar™, o sus transacciones en el aplicativo, nos puedes contactar en info@ingeniarproyectos.com, o en nuestro PBX(6)348-6351</p> 
    </div>
</div>
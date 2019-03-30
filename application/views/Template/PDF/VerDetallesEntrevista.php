<?php 
    @$modulo     =   @$this->ModuloActivo;
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal?><br/>
            Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php echo $empresa->direccion;?><br />               
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br/>
            <?php #pre($empresa); ?>
        </td>
    </tr>
</table>
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <div style="text-align: justify;">
        <h2 style="text-align:center;"><strong>Conocimiento de aspirantes <?php echo @$empresa->nombre_legal?></strong></h2>
        <div style="height: 10px;"></div>
        <p> Bienvenida (o) a <?php echo @$empresa->nombre_legal?>;</p>

                <?php echo @$empresa->direccion;?><br />               
                PBX: <?php echo @$empresa->cod_telefono;?>-<?php echo @$empresa->telefono?><br />
                <?php echo @$empresa->website;?><br/>
        <p>  Antes de iniciar la presentación de tus test, quiero darte las gracias por estar el día de hoy en nuestras instalaciones e iniciar este proceso de selección, el cual esperamos concluya satisfactoriamente, durante los siguientes minutos realizaras tres (3) tipos de test, los cuales serán:</p>
        <ul>

        <li> <strong>Un test psicotécnico</strong>; este busca perfilarte para que nuestros profesionales sepan como debemos trabajar junto a vos, ten presente que en este primer test no existe respuesta equivocada, con el paso del tiempo hemos entendido que lo genial de nuestra empresa es que nos permite contar con personas ampliamente diversas, el objetivo real de este formulario será detectar tus pasiones, gustos, proyectos futuros <span>y debilidades</span>, queremos conocerte y ser parte de tus proyectos con miras a tener una mejor calidad de vida.</li>
        </ul>
        <br />
        <ul>

        <li><strong>Un test de inglés</strong>, este test tiene por objetivo saber tu nivel de inglés real, no buscamos con ello “corcharte”, jamás será nuestra intención, pero es vital para nosotros conocer tus competencias técnicas en este aspecto, pues ello nos permitirá saber que tanto apoyo requieres de nuestra parte, ten presente que este test será cronometrado, por lo cual cuando cumplas Ocho (8) minutos, este se cerrara de manera automática y se enviaran las respuestas a nuestra división de Gestión Humana para su respectivo análisis.</li>
        </ul>
        <br />

        <ul>
        <li><strong>Un test de digitación</strong>, en este test buscaremos calcular la cantidad de palabras digitadas por minutos, mi consejo es que lo realices con total tranquilidad, sin duda alguna y con toda seguridad te sorprenderás de tus capacidades.</li>
        </ul>

        <p>Ten presente que cada una de tus respuestas nos ayudarán a saber exactamente cómo podemos apoyarte en tu proceso de profesionalización como modelo contratante webcam, esperamos ser de gran apoyo para vos en cada parte de este proceso, por favor cada duda que tengas no dudes en consultarla con nuestro encargado (a)  de sede o escribirnos directamente a nuestro número oficial +57 <?php echo @$empresa->cod_telefono." ".@$empresa->telefono; ?>.</p>

        <p><strong>¡Atrévete a iniciar esta aventura!</strong> y comprueba porque <?php echo @$empresa->nombre_legal?> ha sido catalogada como una de las mejores empresas del entretenimiento para adultos para trabajar en Colombia.</p>

        <p> Gracias por tu tiempo y mis mejores energías, cada que llegan personas geniales como vos a nuestra empresa, esta crece y asegura su estabilidad y continuidad en un mercado competitivo con grandes posibilidades para todos.</p>

        <p> Cordialmente,<br /><br /><br/><?php echo @$empresa->nombre_representante_legal; ?><br />Gerente General <?php echo @$empresa->nombre_legal?></p>
        <p> </p>
    </div>
    <div style="height: 20px;"></div> 
    <div style="text-align:center;">
        <h3 class="text-center">Certificación del aspirante.</h3>
    </div>
    <div style="height: 20px;"></div>
    <p>Por la presente y para todos los efectos legales, certifico que: </p>
    <ol>
        <li> Entiendo  que <?php echo @$empresa->nombre_legal?>, operan y gestionan páginas de entretenimiento para adultos de contenido erótico. </li>
        <li>Me encuentro de manera libre y voluntaria en las instalaciones de <?php echo @$empresa->nombre_legal?>. </li>
        <li> Soy de mente sana. </li>
        <li> Tengo dieciocho (18) años o más. </li>
        <li> He presentado documentación que acredita mi edad y me declaro penalmente responsable ante la falsificación o uso de documento privado o público, tipificado en el código penal Colombiano y excluyo a <?php echo @$empresa->nombre_legal?> de cualquier responsabilidad, certificando que considero que ellos han actuado en razón de su buena fe penal, civil y comercial. </li>
        <li>No he sido obligada (o) o presionada (o) de ninguna manera para la presentación voluntaria a esta primera entrevista en las instalaciones de <?php echo @$empresa->nombre_legal?>.</li>
        <li>Entiendo que de conformidad con lo dispuesto en la Ley Estatutaria 1581 de 2012 sobre el uso de los datos personales que se obtengan por medio de este proceso, serán recogidos y almacenados y objeto de tratamiento en bases de datos hasta por cinco (5) años más, esta base de datos cuenta con las medidas de seguridad necesarias para la conservación adecuada de los datos personales, con la aceptación de la presente autorización, permito el tratamiento de mis datos personales para las finalidades mencionadas y certifico que los datos suministrados a <?php echo @$empresa->nombre_legal?> son ciertos, dejando por sentado que no he omitido o adulterado ninguna información.</li>
    </ol>
    <div style="height: 20px;"></div>
    <?php
        foreach($this->$modulo->result as  $key => $v){
            $datos_entrevistado =    json_decode($v->json_entrevista);                                 
    ?>
    <table width="540">
        <tr>
            <td width="150"><b>Certifico</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->certifico); ?>
            <td width="200"> </td>
        </tr>
        <tr>
            <td><b>Nombre Entrevistado:</b></td>
            <td colspan="4" class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->PrimerNombre)){
                        echo @$datos_entrevistado->PrimerNombre." ";
                    } 
                    if(!empty(@$datos_entrevistado->SegundoNombre)){
                        echo @$datos_entrevistado->SegundoNombre." ";
                    }
                    if(!empty(@$datos_entrevistado->PrimerApellido)){
                        echo @$datos_entrevistado->PrimerApellido." ";
                    } 
                    if(!empty(@$datos_entrevistado->SegundoApellido)){
                        echo @$datos_entrevistado->SegundoApellido." ";
                    }
                ?>
            </td>
            <td></td>
        </tr>
        <tr>
            <td><b>Número de cédula:</b></td>
            <td colspan="4" class="bordeBottom">
             <?php 
                   echo $v->nro_piso_cedula;
             ?>
            </td>
            <td></td>
        </tr>
        <tr>
            <td><b>Ciudad de Expedicion</b></td>
            <td colspan="4" class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->cedula_ciudad_expedicion)){
                        echo @$datos_entrevistado->cedula_ciudad_expedicion;
                    } 
                ?>
            </td>
            <td></td>
        </tr>
        <tr>
            <td><b>Fecha presentación test:</b></td>
            <td colspan="4" class="bordeBottom">
                <?php 
                        echo @$v->fecha;
                 ?>
            </td>
            <td></td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;"><b>Información general.</b></div>
    <div style="height: 20px;"></div>
    <table width="540">
        <tr>
            <td width="200" rowspan="7" style="vertical-align: top;"><b>¿Cómo obtuviste información de la vacante?</b></td>
            <td width="100">Facebook</td>
            <td width="240">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                        if(!empty(@$datos_entrevistado->rss)){
                          if(@$datos_entrevistado->rss=="Facebook"){
                             echo "X";
                          } 
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>OLX</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->rss=="OLX"){
                            echo "X";
                        }
                    ?>
                </div>    
            </td>
        </tr>
        <tr>
            <td>Instagram</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->rss=="Instagram"){
                            echo "X";
                        }
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Google</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->rss=="Google"){
                            echo "X";
                        }
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Twitter</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->rss=="Twitter"){
                            echo "X";
                        }
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Tinder</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->rss=="Tinder"){
                            echo "X";
                        }
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Linkedln</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->rss=="Linkedln"){
                            echo "X";
                        }
                    ?>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
    <table width="400">
        <tr>
            <td width="200"></td>
            <td width="100">Otra red:</td>
            <td width="100" class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->OtraRss)){
                       echo @$datos_entrevistado->OtraRss;
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <td width="200"><b>Recomendado Por:</b></td>
            <td colspan="2" class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->Intermediario)){
                       echo @$datos_entrevistado->Intermediario;
                    } 
                ?>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;">
        <b>Información personal.</b>
    </div>
    <div style="height: 20px;"></div>
    <table width="540">
        <tr>
            <td width="160"><b>Email:</b></td>
            <td class="bordeBottom"><?php echo  $v->email ?></td>
        </tr>
        <tr>
            <td><b>Nombre entrevistado (a):</b></td>
            <td class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->PrimerNombre)){
                        echo @$datos_entrevistado->PrimerNombre." ";
                    } 
                    if(!empty(@$datos_entrevistado->SegundoNombre)){
                        echo @$datos_entrevistado->SegundoNombre." ";
                    }
                    if(!empty(@$datos_entrevistado->PrimerApellido)){
                        echo @$datos_entrevistado->PrimerApellido." ";
                    } 
                    if(!empty(@$datos_entrevistado->SegundoApellido)){
                        echo @$datos_entrevistado->SegundoApellido." ";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Fecha de nacimiento:</b></td>
            <td class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->FechaNacimiento)){
                       echo @$datos_entrevistado->FechaNacimiento;
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Lugar de nacimiento:</b></td>
            <td class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->CiudadNacimiento)){
                       echo @$datos_entrevistado->CiudadNacimiento;
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Estado civil:</b></td>
            <td class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->EstadoCivil)){
                       echo @$datos_entrevistado->EstadoCivil;
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Dirección de domicilio:</b></td>
            <td class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->DirecciónDomicilio)){
                       echo @$datos_entrevistado->DirecciónDomicilio;
                    } 
                ?> 
            </td>
        </tr>
        <tr>
            <td><b>Direccion Alternativa</b></td>
            <td class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->Dirección2)){
                       echo @$datos_entrevistado->Dirección2;
                    } 
                ?>
            </td>
        </tr>
        <tr>    
            <td><b>Estrato socioeconómico:</b></td>
            <td class="bordeBottom">
                <?php
                    if(!empty(@$datos_entrevistado->Estrato)){
                       echo @$datos_entrevistado->Estrato." ";
                    }
                ?> 
            </td>
        </tr>    
        <tr>
            <td><b>Teléfono celular:</b></td>
            <td class="bordeBottom">
                <?php
                    if(!empty(@$datos_entrevistado->Ind)){
                           echo '('.@$datos_entrevistado->Ind.") ";
                        }
                    if(!empty(@$datos_entrevistado->Ind2)){
                       echo @$datos_entrevistado->Ind2." ";
                    }
                    if(!empty(@$datos_entrevistado->NumCel)){
                       echo @$datos_entrevistado->NumCel;
                    }
                 ?> 
            </td>
        </tr>
        <tr>
            <td><b>Teléfono fijo:</b></td>
            <td class="bordeBottom">
                <?php
                    if(!empty(@$datos_entrevistado->IndF)){
                           echo '('.@$datos_entrevistado->IndF.") ";
                        }
                    if(!empty(@$datos_entrevistado->Ind2F)){
                       echo @$datos_entrevistado->Ind2F." ";
                    }
                    if(!empty(@$datos_entrevistado->NumFijo)){
                       echo @$datos_entrevistado->NumFijo;
                    }
                 ?>
            </td>
        </tr>
    </table>
    <div style="height: 30px;"></div>
    <table width="500">
        <tr>
            <td width="200" rowspan="3" style="vertical-align: top;"><b>Turno en el cuál transmitirás:</b></td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">

                    <?php 
                          if(!empty(@$datos_entrevistado->Turno)){
                            if(@$datos_entrevistado->Turno=="Mañan (06:30 a.m. - 02:00 p.m.)"){
                             echo "X";
                            }
                    ?>
                </div>
            </td>
            <td width="250">Mañana (06:30 a.m. – 02:00 p.m.)</td>
        </tr>
        <tr>
            <td>
                 <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                        if(@$datos_entrevistado->Turno=="Tarde (01:30 p.m. – 10:00 p.m.)"){
                           echo "X";
                        }
                    ?>
                 </div>
            </td>
            <td>Tarde (01:30 p.m. – 10:00 p.m.)</td>
        </tr>
        <tr>
            <td>
                 <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                        if(@$datos_entrevistado->Turno=="Noche (09:30 p.m. - 06:00 a.m.)"){
                           echo "X";
                        }
                    }
                    ?>
                 </div>
            </td>
            <td>Noche (09:30 p.m. – 06:00 a.m.)</td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <table width="390">
        <tr>
            <td width="200"><b>¿Estás trabajado actualmente?</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->TrabajoActual); ?>
        </tr>
        <tr>
            <td><b>¿Cuánto suman tus ingresos actuales?:</b></td>
            <td colspan="4" class="bordeBottom">
                <?php                                             
                    if(!empty(@$datos_entrevistado->IngresosActuales)){
                       echo @$datos_entrevistado->IngresosActuales;
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td><b>¿Cuánto suman tus obligaciones mensuales?:</b></td>
            <td colspan="4" class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->Obligaciones)){
                       echo @$datos_entrevistado->Obligaciones;
                    }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>¿Cuánto requieres ganar mensualmente?:</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                        if(!empty(@$datos_entrevistado->AspiracionSalarial)){
                           echo @$datos_entrevistado->AspiracionSalarial;
                        }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>¿Tienes vehículo?</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Vehiculo); ?>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;">
        <b>Información familiar.</b>
    </div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="200"><b>¿Nombre de tu esposo (a) o compañero (a)?:</b></td>
            <td width="280" class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->NombrePareja)){
                       echo @$datos_entrevistado->NombrePareja;
                    }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>¿Profesión, ocupación u oficio?:</b></td>
            <td class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->Profesión)){
                       echo @$datos_entrevistado->Profesión;
                    }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>¿Teléfono?:</b></td>
            <td class="bordeBottom">
                <?php 
                    if(!empty(@$datos_entrevistado->TelPareja)){
                       echo '('.@$datos_entrevistado->TelPareja.") ";
                    } 
                    if(!empty(@$datos_entrevistado->IndP2)){
                       echo @$datos_entrevistado->IndP2." ";
                    } 
                    if(!empty(@$datos_entrevistado->NumP)){
                       echo @$datos_entrevistado->NumP;
                    } 
                ?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="300">
               <b>
                  ¿Número de personas que dependen económicamente de vos?: 
               </b> 
            </td>
            <td class="bordeBottom" width="180">
                <?php                                             
                    if(!empty(@$datos_entrevistado->PersonasACargo)){
                       echo @$datos_entrevistado->PersonasACargo;
                    }
                ?> 
            </td>
        </tr>        
    </table>
    <table>
        <tr>
            <td width="150"><b>Vives en casa:</b></td>
            <td width="20">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                        if(!empty(@$datos_entrevistado->ViveEnCasa)){
                            if(@$datos_entrevistado->ViveEnCasa=='Propia'){
                                echo 'X';
                            }
                     ?>
                </div>
            </td>
            <td width="70">Propia</td>
            <td width="20">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->ViveEnCasa=='Familiar'){
                            echo 'X';
                        }
                    ?>  
                </div>
            </td>
            <td width="70">Familiar</td>
            <td width="20">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->ViveEnCasa=='Arrendada'){
                            echo 'X';
                        }
                    }
                    ?>
                </div>
            </td>
            <td width="70">Arrendada</td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="150"><b>¿Tienes hijos?</b></td>
            <?php 
                echo VerificarChecbox(@$datos_entrevistado->Hijos);
             ?>
        </tr>
    </table>
    <table>
        <?php 
            if(!empty($datos_entrevistado->hijo)){
                foreach ($datos_entrevistado->hijo as $indice => $valor) {
        ?>
        <tr>
            <td width="150">
                <b>Hijo # <?php echo $indice+1 ?></b><br/>       
                    *Nombre y edad
            </td>
            <td colspan="4" class="bordeBottom" style="vertical-align: bottom;">
                <?php 
                    echo $valor.' '.$datos_entrevistado->edad[$indice].' años'
                 ?>
            </td>
        </tr>
        <?php
                }
            }
        ?>
        
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;"><b>Información académica.</b></div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="150" rowspan="5" style="vertical-align: center;"><b>Nivel académico:</b></td>
            <td width="80">Ninguno</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                        if(!empty(@$datos_entrevistado->NivelAcademico)){
                            if(@$datos_entrevistado->NivelAcademico=='Ninguno'){
                                echo 'X';
                            }
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Bachiller</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->NivelAcademico=='Bachiller'){
                                echo 'X';
                            }
                    ?>  
                </div>
            </td>
        </tr>
        <tr>
            <td>Técnico</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->NivelAcademico=='Técnico'){
                                echo 'X';
                            }
                    ?>  
                </div>        
            </td>
        </tr>
        <tr>
            <td>Tecnólogo</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->NivelAcademico=='Tecnólogo'){
                                echo 'X';
                            }
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Profesional</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->NivelAcademico=='Profesional'){
                                echo 'X';
                            }
                        }
                    ?>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td><b>Campo de especialidad:</b></td>
            <td class="bordeBottom" colspan="4" class="bordeBottom" width="250">
                <?php                                             
                    if(!empty(@$datos_entrevistado->CampoEspecialidad)){
                       echo @$datos_entrevistado->CampoEspecialidad;
                    }
                ?> 
            </td>
        </tr>
        <tr>
            <td><b>¿Realizas estudios actualmente?:</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->EstudioActual) ?>
        </tr>
        <tr>
            <td><b>Nombre institución educativa:</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                    if(!empty(@$datos_entrevistado->InsEdu)){
                       echo @$datos_entrevistado->InsEdu;
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: center;"><b>Horario que estudias:</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                                    if(!empty($datos_entrevistado->HoraEstudioDesde)){
                                       echo $datos_entrevistado->HoraEstudioDesde.' : ';
                                    }
                                    if(!empty($datos_entrevistado->MinutoEstudioDesde)){
                                       echo $datos_entrevistado->MinutoEstudioDesde.' ';
                                    }
                                    if(!empty($datos_entrevistado->Meridiano1)){
                                       echo $datos_entrevistado->Meridiano1.' Hasta ';
                                    }
                                    if(!empty($datos_entrevistado->HoraEstudioHasta)){
                                       echo $datos_entrevistado->HoraEstudioHasta.' : ';
                                    }
                                    if(!empty($datos_entrevistado->MinutoEstudioHasta)){
                                       echo $datos_entrevistado->MinutoEstudioHasta.' ';
                                    }
                                    if(!empty($datos_entrevistado->Meridiano2)){
                                       echo $datos_entrevistado->Meridiano2;
                                    }
                            ?>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;">Información laboral.</div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td><b>¿Has sido modelo webcam?:</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->ModeloWeb); ?>
        </tr>
        <tr>
            <td><b>Nombre del estudio:</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                    if(!empty(@$datos_entrevistado->NombreEstudio)){
                       echo @$datos_entrevistado->NombreEstudio;
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Páginas trabajadas:</b></td>
            <td class="bordeBottom" colspan="4"> <?php                                             
                        if(!empty(@$datos_entrevistado->PaginasTrabajadas)){
                           echo @$datos_entrevistado->PaginasTrabajadas;
                        }
                ?> 
            </td>
        </tr>
        <tr>
            <td><b>Nombre de la última o actual empresa</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                        if(!empty($datos_entrevistado->NombreúltimaEmpresa)){
                           echo $datos_entrevistado->NombreúltimaEmpresa;
                        }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>Cargo desempeñado:</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                        if(!empty(@$datos_entrevistado->CargoDesempeñado)){
                           echo @$datos_entrevistado->CargoDesempeñado;
                        }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>Funciones realizadas:</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                        if(!empty(@$datos_entrevistado->FuncionesRealizadas)){
                           echo @$datos_entrevistado->FuncionesRealizadas;
                        }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>Fecha de ingreso:</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                        if(!empty(@$datos_entrevistado->FechaIngreso)){
                           echo @$datos_entrevistado->FechaIngreso;
                        }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>Fecha de retiro:</b></td>
            <td class="bordeBottom" colspan="4">
                <?php 
                        if(!empty(@$datos_entrevistado->FechaRetiro)){
                           echo @$datos_entrevistado->FechaRetiro;
                        }
                 ?>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="150" rowspan="5" style="vertical-align: center;"><b>Seguridad social(EPS)</b></td>
            <td width="80">Subsidiado (SISBEN)</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                            if(!empty(@$datos_entrevistado->TipoSeguridadSocial)){
                               if(@$datos_entrevistado->TipoSeguridadSocial=='Subsidiado (SISBEN)'){
                                    echo "X";
                                }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Contributivo</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->TipoSeguridadSocial=='Contributivo'){
                                    echo "X";
                                }
                    ?>  
                </div>
            </td>
        </tr>
        <tr>
            <td>Beneficiario</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->TipoSeguridadSocial=='Beneficiario'){
                                    echo "X";
                        }
                    ?>  
                </div>        
            </td>
        </tr>
        <tr>
            <td>Ninguno</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php
                        if(@$datos_entrevistado->TipoSeguridadSocial=='Ninguno'){
                                echo 'X';
                            }
                        }
                    ?>
                </div>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <table width="500">
        <tr>
            <td width="260"><b>Nombre de la entidad promotora de salud (EPS):</b></td>
            <td  width="240" class="bordeBottom"> 
                <?php                                             
                        if(!empty(@$datos_entrevistado->NombreEntidad)){
                           echo @$datos_entrevistado->NombreEntidad;
                        }
                ?> 
            </td>
        </tr>
        <tr>
            <td><b>Fondo de pensiones:</b></td>
            <td class="bordeBottom"> 
                <?php 
                        if(!empty(@$datos_entrevistado->FondoPensiones)){
                           echo @$datos_entrevistado->FondoPensiones;
                        }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>Fondo de cesantías:</b> </td>
            <td class="bordeBottom"> 
                <?php 
                        if(!empty(@$datos_entrevistado->FondoCesantías)){
                           echo @$datos_entrevistado->FondoCesantías;
                        }
                 ?>
            </td>
        </tr>
        <tr>
            <td><b>Sufres o has sufrido de alguna enfermedad importante:</b></td>
            <td class="bordeBottom"> 
                <?php 
                        if(!empty(@$datos_entrevistado->EnfermedadImportante)){
                           echo @$datos_entrevistado->EnfermedadImportante;
                        }
                 ?>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;"><b>Aptitudes específicas.</b></div>
    <div style="height: 8px;"></div>
    <div style="text-align:center;">Marca de uno (1) a diez (10) según consideres, siendo uno (1) muy poco y diez (10) muy bueno.</div>
    <div style="height: 8px;"></div>
    <table>
        <tr>
            <td width="200"><b>¿Cuánto sabes de digitación?</b></td>
            <td>1</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='1'){
                                echo 'X';
                        }
                ?>          
               </div> 
            </td>
            <td>2</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='2'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>3</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='3'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>4</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='4'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>5</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='5'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>6</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='6'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>7</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='7'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>8</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='8'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>9</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='9'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>10</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Digitacion=='10'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>           
        </tr>
        <tr>
            <td><b>¿Cuánto sabes de inglés?</b></td>
            <td>1</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='1'){
                                echo 'X';
                        }
                ?>          
               </div> 
            </td>
            <td>2</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='2'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>3</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='3'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>4</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='4'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>5</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='5'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>6</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='6'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>7</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='7'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>8</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='8'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>9</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='9'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>10</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ingles=='10'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
        </tr>
        <tr>
            <td><b>¿Tienes buena ortografía?</b></td>
            <td>1</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='1'){
                                echo 'X';
                        }
                ?>          
               </div> 
            </td>
            <td>2</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='2'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>3</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='3'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>4</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='4'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>5</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='5'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>6</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='6'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>7</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='7'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>8</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='8'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>9</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='9'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>10</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Ortografia=='10'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
        </tr>
        <tr>
            <td><b>¿Sabes bailar?</b></td>
            <td>1</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='1'){
                                echo 'X';
                        }
                ?>          
               </div> 
            </td>
            <td>2</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='2'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>3</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='3'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>4</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='4'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>5</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='5'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>6</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='6'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>7</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='7'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>8</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='8'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
            <td>9</td>
            <td>
              <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='9'){
                                echo 'X';
                        }
                ?>
              </div>  
            </td>
            <td>10</td>
            <td>
               <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
               <?php                                             
                            if(@$datos_entrevistado->Baile=='10'){
                                echo 'X';
                        }
                ?>
               </div> 
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;"><b>Presentación personal.</b></div>
    <div style="height: 20px;"></div>
    <div>
        <p>Queremos recordarte que el modelaje webcam es un trabajo de elegancia y profesionalismo, por lo cual la presentación personal es fundamental para nuestra empresa, te informamos que está prohibido transmitir con la misma ropa que llegas a nuestras instalaciones, tampoco el uso de Jeans frente a cámara.</p>

        <p>De igual manera para el caso de las chicas deberán presentarse siempre maquilladas y con las uñas en perfecto estado, igualmente deberás estar con un mínimo de treinta (30) minutos antes, recuerda llevar tu cabello y lencería siempre en perfecto estado y completamente aseado.</p>
    </div>
    <table>
        <tr>
            <td width="150"><b>¿Utilizas maquillaje?:</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Maquillaje); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="150" rowspan="6" style="vertical-align: top;"><b>Color del cabello:</b></td>
            <td width="100">Negro</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->ColorPelo=='Negro'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Castaño</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->ColorPelo=='Castaño'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Rojo</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->ColorPelo=='Rojo'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Cenizo</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->ColorPelo=='Cenizo'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Rubio</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->ColorPelo=='Rubio'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Otro</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->ColorPelo=='Otro'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="150" rowspan="6" style="vertical-align: top;"><b>Longitud del cabello:</b></td>
            <td width="100">Corto</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->ColorLargoPelo=='Corto'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Mediano</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->ColorLargoPelo=='Mediano'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Largo</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->ColorLargoPelo=='Largo'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="150"><b>¿Utilizas accesorios?:</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Accesorios); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="150" rowspan="6" style="vertical-align: top;"><b>Tamaño de tus accesorios:</b></td>
            <td width="100">Pequeños</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->TamAccesorios=='Pequeños'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Medianos</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->TamAccesorios=='Medianos'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Grandes </td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->TamAccesorios=='Grandes'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>N.A.</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->TamAccesorios=='N.A.'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
    </table>
     <table>
        <tr>
            <td width="150" rowspan="6" style="vertical-align: top;"><b>Estado de las uñas de tus manos:</b></td>
            <td width="100">Cortas – Sin pintar</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->TamAccesoriosManos=='Cortas - Sin pintar'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Cortas – Decoradas adecuadamente</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->TamAccesoriosManos=='Cortas – Decoradas adecuadamente'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Largas – Sin pintar</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->TamAccesoriosManos=='Largas – Sin pintar'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Largas – Decoradas adecuadamente</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->TamAccesoriosManos=='Largas – Decoradas adecuadamente'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="150" rowspan="6" style="vertical-align: top;"><b>Estado de las uñas de tus pies: </b></td>
            <td width="100">Cortas – Sin pintar</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->EstadoUñasPies=='Cortas - Sin pintar'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Cortas – Decoradas adecuadamente</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->EstadoUñasPies=='Cortas – Decoradas adecuadamente'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Largas – Sin pintar</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->EstadoUñasPies=='Largas – Sin pintar'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Largas – Decoradas adecuadamente</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->EstadoUñasPies=='Largas – Decoradas adecuadamente'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
    </table>
    <p>Importante, queremos informarte que ninguna de las preguntas que te presentamos a continuación serán determinantes para tu contratación, siéntete libre al responder.</p>
    <div style="text-align:center;">Perfil socio sexual. </div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="250"><b>¿Puedes sostener conversaciones sobre morbo?:</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->ConversacionMorbo); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Te masturbas?:</b></td>
            <?php echo VerificarChecbox(@$datos_entrevistado->TeMasturbas); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="150" style="vertical-align: top;"><b>¿Con que frecuencia?:</b></td>
            <td width="100">Diariamente</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->ConQueFrecuencia=='Diariamente'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="150"> </td>
            <td>Al menos una vez por semana </td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->ConQueFrecuencia=='Al menos una vez por semana '){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="150"> </td>
            <td width>Al menos una vez al mes</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->ConQueFrecuencia=='Al menos una vez al mes'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Tendrías sexo anal?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->SexoAnal); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Vez porno?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->VezPorno); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="150" rowspan="6" style="vertical-align: top;"><b>¿Con que frecuencia?:</b></td>
            <td width="100">Diariamente</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->ConQueFrecuencia=='Diariamente'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Al menos una vez por semana </td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                     <?php 
                               if(@$datos_entrevistado->ConQueFrecuencia=='Al menos una vez por semana '){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Al menos una vez al mes</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                               if(@$datos_entrevistado->FrecuenciaVezPorno=='Al menos una vez al mes'){
                                  echo 'X';
                            }
                     ?>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Has tenido relaciones sexuales con personas de tu mismo sexo?: </b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->RelacionesConMisnoGenero); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Tendrías relaciones sexuales con personas de tu mismo sexo?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->TenRelacionesMismoGenero); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Has realizado sexo oral?: </b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->RealizaSexoOral); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Has salido con alguien por dinero?: </b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->SalidoAlguienDinero); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Has tenido relaciones sexuales por dinero?: </b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->SexoPorDinero); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Actualmente tienes pareja sexual estable?: </b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->ParejaSexual); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Tienes tatuajes?: </b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Tatuajes); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="200"><b>¿En que parte(s) de tu cuerpo?:</b></td>
            <td class="bordeBottom" width="250">
                <?php 
                    if(!empty(@$datos_entrevistado->TatuajeParteCuerpo)){
                       echo @$datos_entrevistado->TatuajeParteCuerpo;
                    } 
                ?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Tienes pearcing?: </b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Pearcing); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Has practicado sexo con dolor?: </b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->SexoConDolor); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>En caso afirmativo, ¿cómo has actuado?:</b></td>
            <td width="50">Dominante</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                            if(@$datos_entrevistado->SexoDolorActuado=='Dominante'){
                               echo 'X';
                            }
                     ?>
                </div>
            </td>
            <td width="50">Sumisa</td>
            <td>
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php 
                            if(@$datos_entrevistado->SexoDolorActuado=='Sumisa'){
                               echo 'X';
                            }
                     ?>    
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Fumas?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Fuma); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Consumes actualmente drogas?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Drogas); ?>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;"><b>¿Qué estarías dispuesta a hacer en cámara?</b></div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="250"><b>¿Utilizar consolador?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Consolador); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Utilizar redes sociales con tu nombre artístico?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->NombreArtisticoRss); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Transmitir con otra persona?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->TransmitirConOtro); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Masturbarte?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Masturbarte); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Sexo anal?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->SexoAnal); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Utilizar juguetería sexual?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Jugueteria_Sexual); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Baile erótico?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->BaileErotico); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Orgasmo online?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->OrgasmoOnline); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Leche - MILF?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->LecheMilf); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Striptease?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Striptease); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Juego de roles?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Juego_de_Roles); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Disfraces?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Disfraces); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Sexo salvaje?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Sexo_Salvaje); ?>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="250">
                <b>
                ¿CAM2CAM?:<br/>
                <p style="font-size:9px;">*Ver la cámara del miembro con el que se está chateando.</p>
            </b>
            </td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Cam2Cam); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Show de aceite?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->ShowAceite); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Nalgadas?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Nalgadas); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Doble penetración?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->DoblePenetracion); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Orinar - Squirter?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Orinar_Squirter); ?>
        </tr>
    </table>
     <table>
        <tr>
            <td width="250"><b>¿Hablar sucio?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Hablar_Sucio); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Fetiche de pies?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Fetiche_de_Pies); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Fetiche de manos?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Fetiche_de_Manos); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Show dedos vagina?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Show_Dedos_Vagina); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Show dedos anal?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Show_Dedos_Anal); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Varias chicas en cámara?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Varias_Chicas_Cam); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Esclavitud o servidumbre?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Esclavitud_Servidumbre); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Dominatriz?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Dominatriz); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Azote?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Azote); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Pezones perforados?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Pezones_Perforados); ?>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;"></div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="250"><b>¿Inglés?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Inglés); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Electrónica?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Electrónica); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Vallenatos?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Vallenatos); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Rancheras?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Rancheras); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Baladas?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Baladas); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Popular?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Popular); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Pop en español?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Pop_Español); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Pop en inglés?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Pop_Inglés); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Rock en español?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Rock_Español); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250"><b>¿Rock en Inglés?:</b></td>
                <?php echo VerificarChecbox(@$datos_entrevistado->Rock_Inglés); ?>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center">Ciclo menstrual.</div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="250"><b>¿Tu ciclo menstrual es?:</b></td>
            <td width="50">Regular</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->CicloMes=="Regular"){echo'X';} ?>
                </div>
            </td>
            <td width="50">Irregular</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->CicloMes=="Irregular"){echo'X';} ?>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250" rowspan="3" style="vertical-align: top;"><b>Fechas aproximadas del periodo:</b></td>
            <td width="50">Inicio de mes</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->Periodo_Mestruación=="Inicio de mes"){echo'X';} ?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="50">Mediados de mes </td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->Periodo_Mestruación=="Mediados de mes"){echo'X';} ?>
                </div>
            </td>
        </tr>
         <tr>
            <td width="50">Finales de mes</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->Periodo_Mestruación=="Finales de mes"){echo'X';} ?>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250" rowspan="3" style="vertical-align: top;"><b>Cólicos:</b></td>
            <td width="50">Ausentes</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->Colicos=="Ausentes"){echo'X';} ?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="50">Presentes</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->Colicos=="Presentes"){echo'X';} ?>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="250" rowspan="3" style="vertical-align: top;"><b>Duración del periodo:</b></td>
            <td width="50">De uno (1) a tres (3) días</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->Duración_Periodo=="De uno (1) a tres (3) días"){echo'X';} ?>
                </div>
            </td>
        </tr>
        <tr>
            <td width="50">De tres (3) a ocho (8) días</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->Duración_Periodo=="De tres (3) a ocho (8) días"){echo'X';} ?>
                </div>
            </td>
        </tr>
         <tr>
            <td width="50">Más de ocho (8) días</td>
            <td width="50">
                <div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">
                    <?php if(@$datos_entrevistado->Duración_Periodo=="Más de ocho (8) días"){echo'X';} ?>
                </div>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="200"><b>Talla de senos o tamaño del pene:</b></td>
            <td  width="250" class="bordeBottom"> <?php echo @$datos_entrevistado->Tamaño_del_Miembro_o_senos; ?></td>
        </tr>
        <tr>
            <td><b>Cintura (según medida de jeans):</b></td>
            <td class="bordeBottom"><?php echo @$datos_entrevistado->Medida_Cintura; ?></td>
        </tr>
        <tr>
            <td><b>Estatura - metros:</b></td>
            <td class="bordeBottom"><?php echo @$datos_entrevistado->Estatura_Metros; ?></td>
        </tr>
        <tr>
            <td><b>Peso – kilos:</b></td>
            <td class="bordeBottom"><?php echo @$datos_entrevistado->Peso_Kilos; ?></td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;">
        <b>¿De tu cuerpo te gusta?</b>
    </div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="200">¿Pelo?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Pelo); ?>
        </tr>
        <tr>
            <td>¿Labios?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Labios); ?>
        </tr>
        <tr>
            <td>¿Cara?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Cara); ?>
        </tr>
        <tr>
            <td>¿Oídos?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Oidos); ?>
        </tr>
        <tr>
            <td>¿Cejas?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Cejas); ?>
        </tr>
        <tr>
            <td>¿Ojos?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Ojos); ?>
        </tr>
    </table>
</div>
    <div style="height: 20px;"></div>
    <table>
        
        <tr>
            <td width="200">¿Nariz?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Nariz); ?>
        </tr>
        <tr>
            <td>¿Uñas?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Uñas); ?>
        </tr>
        <tr>
            <td>¿Senos?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Senos); ?>
        </tr>
        <tr>
            <td>¿Manos?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Manos); ?>
        </tr>
        <tr>
            <td>¿Pies?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Pies); ?>
        </tr>
        <tr>
            <td>¿Cintura?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Cintura); ?>
        </tr>
        <tr>
            <td>¿Espalda?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Espalda); ?>
        </tr>
        <tr>
            <td>¿Hombros?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Hombros); ?>
        </tr>
        <tr>
            <td>¿Abdomen?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Abdomen); ?>
        </tr>
    </table>
    <table>
        <tr>
            <td width="200">¿Qué es lo que más te gusta de tu cuerpo?:</td>
            <td class="bordeBottom"> 
                <?php                                             
                        if(!empty(@$datos_entrevistado->MasMegustaDelCuerpo)){
                           echo @$datos_entrevistado->MasMegustaDelCuerpo;
                        }
                ?>
            </td>
        </tr>
        <tr>
            <td>¿Qué es lo que menos te gusta de tu cuerpo?:</td>
            <td class="bordeBottom"> 
                <?php 
                        if(!empty(@$datos_entrevistado->MenosMegustaDelCuerpo)){
                           echo @$datos_entrevistado->MenosMegustaDelCuerpo;
                        }
                 ?>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;"><b>Contratación.</b></div>
    <div style="height: 20px;"></div>
    <table>
        <tr>
            <td width="200">¿Qué vas a decir en casa?:</td>
            <td class="bordeBottom" width="250">
                <?php 
                        if(!empty(@$datos_entrevistado->Qué_vas_a_decir_en_tu_casa)){
                         echo @$datos_entrevistado->Qué_vas_a_decir_en_tu_casa;
                        }
                ?>
            </td>
        </tr>
        <tr>
            <td>¿Cómo te gustaría llamarte en las páginas</td>
            <td class="bordeBottom">
                <?php 
                        if(!empty(@$datos_entrevistado->Como_te_gustaría_llamarte_en_las_páginas)){
                         echo @$datos_entrevistado->Como_te_gustaría_llamarte_en_las_páginas;
                        }
                ?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="200">¿Estarías dispuesto (a) a firmar contrato por un año?:</td>
            <?php echo VerificarChecbox(@$datos_entrevistado->Firmar_Contrato); ?>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div style="text-align:center;"><b>Facultades personales.</b></div>
    <div style="height: 20px;"></div>
     <table>
         <tr>
             <td width="200">¿Aprendes fácilmente?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->AprendeFacil); ?>
         </tr>
         <tr>
             <td>¿Te gustan los retos?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->Retos); ?>
         </tr>
         <tr>
             <td>¿Puedes obedecer órdenes?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->Ordenes); ?>
         </tr>
         <tr>
             <td>¿Rompes las reglas?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->RompesReglas); ?>
         </tr>
         <tr>
             <td>¿Eres puntual?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->Puntual); ?>
         </tr>
         <tr>
             <td>¿Eres cumplido (a)?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->Cumplido); ?>
         </tr>
         <tr>
             <td>¿Eres responsable?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->Responsable); ?>
         </tr>
         <tr>
             <td>¿Cumples horarios?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->CumplesHorarios); ?>
         </tr>
         <tr>
             <td>¿Te gusta madrugar?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->Madrugar); ?>
         </tr>
         <tr>
             <td>¿Te gusta trasnochar?:</td>
             <?php echo VerificarChecbox(@$datos_entrevistado->Trasnochar); ?>
         </tr>
     </table>
     <div style="height: 40px;"></div>
     <div><b>Certifico que todas las anteriores respuestas son veraces.</b></div>
     <div style="height: 80px;"></div>
     <table>
         <tr>
             <td width="200"><b>Firma electrónica.</b></td>
             <td class="bordeBottom" width="300"> </td>
         </tr>
     </table>
</div>
<?php } ?>
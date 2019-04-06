<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.nethygvjky
*/?>
<?php 
$modulo     =   $this->ModuloActivo;
?>
<style>
.icon>.fas{
    color:orange;
}
</style>
<div class="container" style="margin-bottom:20px;">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="form">
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <?php 
                            echo TaskBar(array("name"       =>  array(  "title" =>  "Detalles entrevistado",
                                                                        'icono'=>'<i class="fas fa-user-circle"></i>',
                                                                        "url"   =>  current_url()),                     
                                                "pdf"       =>  true, 
                                        )
                                    );
                        ?>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab8" role="tab">
                        Observaciones
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab1" role="tab">
                        Información general
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">
                        Datos generales
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">
                        Presentación personal
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4" role="tab">
                        En cámara
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab5" role="tab">
                        Tipo Música
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab6" role="tab">
                        Periodo
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab7" role="tab">
                        Estructura física
                    </a>
                 </li>
         	</ul>
            <div class="tab-content" id="myTabContent">
                <div role="tabpanel" class="tab-pane fade active show" id="tab8" aria-labelledby="nacionales-tab" aria-expanded="false">
                    <div class="col-md-12">
                        <div style=" width:100%; height:20px;"></div>
                        <?php
                            HtmlObservaciones();
                        ?>
                    </div>
                </div>
                <?php
                        foreach($this->$modulo->result as  $key => $v){
                            $datos_entrevistado =    json_decode($v->json_entrevista);                               
                    ?>
				<div role="tabpanel" class="tab-pane fade" id="tab1" aria-labelledby="nacionales-tab" aria-expanded="false">
                    <div class="text-center mt-4">
                        <h4>Información general</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Turno de interés</b></div>
                        <div class="text-left col-md-6">
                            <?php
                                if(!empty($datos_entrevistado->Turno)){
                                   echo $datos_entrevistado->Turno;
                                }
                             ?> 
                        </div>
                    </div>
                    <div class="row">
                        <div  class="text-right col-md-6"><b>Inicio Prueba</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    echo @$v->fecha;
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div  class="text-right col-md-6"><b>Fin prueba</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                echo json_decode($v->json_respuestas)->fecha_fin_prueba;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Informacion Vacante</b></div>    
                        <div class="text-left col-md-6">
                            <?php 
                                if(!empty($datos_entrevistado->rss)){
                                   echo $datos_entrevistado->rss;
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Otra red</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                if(!empty($datos_entrevistado->OtraRss)){
                                   echo $datos_entrevistado->OtraRss;
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Recomendado Por</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                if(!empty($datos_entrevistado->Intermediario)){
                                   echo $datos_entrevistado->Intermediario;
                                }else{
                                    echo @$datos_entrevistado->Recomendado;
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <h4>Información personal</h4>
                    </div>
                	<div class="row">
                    	<div class="text-right col-md-6"><b>Nombre Entrevistado</b></div>
                        <div class="text-left col-md-6">
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
                    </div>
                    <div class="row">
                    	<div  class="text-right col-md-6">
                        	<b>Documento</b>
						</div>
                        <div class="text-left col-md-6">
                            <?php 
                                   echo $v->nro_piso_cedula;
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div  class="text-right col-md-6">
                        	<b>Ciudad de Expedicion</b>
						</div>
                        <div class="text-left col-md-6">
							<?php 
                            if(!empty($datos_entrevistado->cedula_ciudad_expedicion)){
                            echo $datos_entrevistado->cedula_ciudad_expedicion;
                            } 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                    	<div  class="text-right col-md-6">
                        	<b>Correo</b>
						</div>
                        <div class="text-left col-md-6">
                            <?php echo  $v->email ?>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div  class="text-right col-md-6"><b>Estatus</b></div>
                        <div class="text-left col-md-6">
                            <?php echo  $v->estatus ?>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="text-right col-md-6"><b>Fecha Nacimiento</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                if(!empty($datos_entrevistado->FechaNacimiento)){
                                   echo $datos_entrevistado->FechaNacimiento;
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Lugar de nacimiento</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                if(!empty($datos_entrevistado->CiudadNacimiento)){
                                   echo $datos_entrevistado->CiudadNacimiento;
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Estado Civil</b></div>
                        <div class="text-left col-md-6">
                           <?php 
                                if(!empty($datos_entrevistado->EstadoCivil)){
                                   echo $datos_entrevistado->EstadoCivil;
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Direccion Domicilio</b></div>
                        <div class="text-left col-md-6">
                           <?php 
                                if(!empty($datos_entrevistado->DirecciónDomicilio)){
                                   echo $datos_entrevistado->DirecciónDomicilio;
                                } 
                            ?> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Ciudad</b></div>
                        <div class="text-left col-md-6">
                            <?php                                                 
                                    if(!empty($datos_entrevistado->Ciudad)){
                                       echo $datos_entrevistado->Ciudad;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Region</b></div>
                        <div class="text-left col-md-6">
                            <?php                                                 
                                    if(!empty($datos_entrevistado->Region)){
                                       echo $datos_entrevistado->Region;
                                    } 
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Pais</b></div>
                        <div class="text-left col-md-6">
                            <?php
                                 if(!empty($datos_entrevistado->País)){
                                       echo $datos_entrevistado->País." ";
                                    }
                             ?> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Telefono Celular</b></div>
                        <div class="text-left col-md-6">
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Telefono Fijo</b></div>
                        <div class="text-left col-md-6">
                            <?php
                                if(!empty($datos_entrevistado->IndF)){
                                       echo $datos_entrevistado->IndF." ";
                                    }
                                if(!empty($datos_entrevistado->Ind2F)){
                                   echo $datos_entrevistado->Ind2F." ";
                                }
                                if(!empty($datos_entrevistado->NumFijo)){
                                   echo $datos_entrevistado->NumFijo;
                                }
                             ?> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Estrato socioeconómico</b></div>
                        <div class="text-left col-md-6">
                            <?php
                                if(!empty($datos_entrevistado->Estrato)){
                                   echo $datos_entrevistado->Estrato." ";
                                }
                             ?> 
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab2" aria-labelledby="nacionales-tab" aria-expanded="false">
                    <div class="mt-4 text-center">
                        <h4>Información financiera</h4>
                    </div>
                	<div class="row">
                        <div class="text-right col-md-6"><b>Trabaja actualmente?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                if(!empty($datos_entrevistado->TrabajoActual)){
                                   echo $datos_entrevistado->TrabajoActual." ";
                                } 
                            ?>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Ingresos</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->IngresosActuales)){
                                       echo $datos_entrevistado->IngresosActuales;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Obligaciones Mensuales</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Obligaciones)){
                                       echo $datos_entrevistado->Obligaciones;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Aspiración salarial</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->AspiracionSalarial)){
                                       echo $datos_entrevistado->AspiracionSalarial;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Tienes Vehiculo</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Vehiculo)){
                                       echo $datos_entrevistado->Vehiculo;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <h4>Información familiar</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Esposo (a) o compañero (a)</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->NombrePareja)){
                                       echo $datos_entrevistado->NombrePareja;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Profesión</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Profesión)){
                                       echo $datos_entrevistado->Profesión;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Teléfono Pareja</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                if(!empty($datos_entrevistado->TelPareja)){
                                   echo $datos_entrevistado->TelPareja." ";
                                } 
                                if(!empty($datos_entrevistado->IndP2)){
                                   echo $datos_entrevistado->IndP2." ";
                                } 
                                if(!empty($datos_entrevistado->NumP)){
                                   echo $datos_entrevistado->NumP;
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Personas Que Dependen de ti</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                       echo @$datos_entrevistado->PersonasACargo;
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Vives en casa</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->ViveEnCasa)){
                                       echo $datos_entrevistado->ViveEnCasa;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Hijos</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Hijos)){
                                       echo $datos_entrevistado->Hijos;
                                    }
                             ?>
                        </div>
                    </div>
                        <?php 
                            if(!empty($datos_entrevistado->hijo)){
                                foreach ($datos_entrevistado->hijo as $indice => $valor) {
                        ?>
                        <div class="row">
                            <div class="text-right col-md-6"><b>Hijo <?php echo $indice+1 ?></b></div>
                            <div class="text-left col-md-6">
                                <?php 
                                      echo $valor;
                                 ?>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    <div class="text-center mt-4">
                        <h4>Información Academica</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Nivel Academico</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->NivelAcademico)){
                                       echo $datos_entrevistado->NivelAcademico;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Campo Especialidad</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->CampoEspecialidad)){
                                       echo $datos_entrevistado->CampoEspecialidad;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Estudias Actualmente</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->EstudioActual)){
                                       echo $datos_entrevistado->EstudioActual;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Nombre Institución Académica</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->InsEdu)){
                                       echo $datos_entrevistado->InsEdu;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Horario</b></div>
                        <div class="text-left col-md-6">
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
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4>Información laboral</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Has sido modelo webcam?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->ModeloWeb)){
                                       echo $datos_entrevistado->ModeloWeb;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Nombre del Estudio</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->NombreEstudio)){
                                       echo $datos_entrevistado->NombreEstudio;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Páginas trabajadas</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->PaginasTrabajadas)){
                                       echo $datos_entrevistado->PaginasTrabajadas;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Ultima Empresa</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->NombreúltimaEmpresa)){
                                       echo $datos_entrevistado->NombreúltimaEmpresa;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Cargo</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->CargoDesempeñado)){
                                       echo $datos_entrevistado->CargoDesempeñado;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Fecha de Ingreso</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->FechaIngreso)){
                                       echo $datos_entrevistado->FechaIngreso;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Fecha de Retiro</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->FechaRetiro)){
                                       echo $datos_entrevistado->FechaRetiro;
                                    }
                             ?>
                        </div> 
                    </div>
                    <div class="text-center mt-4">
                        <h4>Información seguridad social</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Seguridad social(EPS)</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->TipoSeguridadSocial)){
                                       echo $datos_entrevistado->TipoSeguridadSocial;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Nombre entidad promotora de salud</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->NombreEntidad)){
                                       echo $datos_entrevistado->NombreEntidad;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Fondo de pensiones</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->FondoPensiones)){
                                       echo $datos_entrevistado->FondoPensiones;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Fondo de cesantisa</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->FondoCesantías)){
                                       echo $datos_entrevistado->FondoCesantías;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Enfermedad</b></div>
                        <div class="text-left col-md-6">
                            <?php echo $datos_entrevistado->Enfermedad; ?> (
                            <?php
                                    if(!empty($datos_entrevistado->EnfermedadImportante)){
                                       echo $datos_entrevistado->EnfermedadImportante;
                                    }
                             ?>)
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4>Aptitudes especificas</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Digitación</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->Digitacion)){
                                       echo $datos_entrevistado->Digitacion;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Inglés</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Ingles)){
                                       echo $datos_entrevistado->Ingles;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Ortografia</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Ortografia)){
                                       echo $datos_entrevistado->Ortografia;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Baile</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Baile)){
                                       echo $datos_entrevistado->Baile;
                                    }
                             ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab3" aria-labelledby="nacionales-tab" aria-expanded="false">
                    <div class="text-center mt-4">
                        <h4>Presentación personal</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Uso de maquillaje</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Maquillaje)){
                                       echo $datos_entrevistado->Maquillaje;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Color Cabello</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->ColorPelo)){
                                       echo $datos_entrevistado->ColorPelo;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Longitud del Cabello </b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->ColorLargoPelo)){
                                       echo $datos_entrevistado->ColorLargoPelo;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Accesorios </b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Accesorios)){
                                       echo $datos_entrevistado->Accesorios;
                                    }
                             ?>
                        </div>
                    </div>
                	<div class="row">
                     <div class="text-right col-md-6"><b>Tamaño Accesorios</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->TamAccesorios)){
                                       echo $datos_entrevistado->TamAccesorios;
                                    } 
                                ?>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Estado de Uñas Manos</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->TamAccesoriosManos)){
                                       echo $datos_entrevistado->TamAccesoriosManos;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Estado de Uñas Pies</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->EstadoUñasPies)){
                                       echo $datos_entrevistado->EstadoUñasPies;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4>Perfil socio sexual</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Puedes sostener conversaciones sobre morbo?</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->ConversacionMorbo)){
                                       echo $datos_entrevistado->ConversacionMorbo;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Te masturbas?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->TeMasturbas)){
                                       echo $datos_entrevistado->TeMasturbas;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Con que frecuencia?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->ConQueFrecuencia)){
                                       echo $datos_entrevistado->ConQueFrecuencia;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Tendrías sexo anal?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->SexoAnal)){
                                       echo $datos_entrevistado->SexoAnal;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Vez porno?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->VezPorno)){
                                       echo $datos_entrevistado->VezPorno;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Con que frecuencia?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->FrecuenciaVezPorno)){
                                       echo $datos_entrevistado->FrecuenciaVezPorno;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Has tenido Sexo con el mismo género</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->RelacionesConMisnoGenero)){
                                       echo $datos_entrevistado->RelacionesConMisnoGenero;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Tendrías sexo con el mismo género </b></div>
                        <div class="text-left col-md-6">
                            <?php
                                    if(!empty($datos_entrevistado->TenRelacionesMismoGenero)){
                                       echo $datos_entrevistado->TenRelacionesMismoGenero;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Has realizado sexo oral?</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->RealizaSexoOral)){
                                       echo $datos_entrevistado->RealizaSexoOral;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Has salido con alguien por dinero?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->SalidoAlguienDinero)){
                                       echo $datos_entrevistado->SalidoAlguienDinero;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Has tenido relaciones sexuales por dinero?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->SexoPorDinero)){
                                       echo $datos_entrevistado->SexoPorDinero;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Actualmente tienes pareja sexual estable?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->ParejaSexual)){
                                       echo $datos_entrevistado->ParejaSexual;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Tienes tatuajes?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Tatuajes)){
                                       echo $datos_entrevistado->Tatuajes;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                     <div class="text-right col-md-6"><b>¿En que parte de tu cuerpo?</b></div>
                     <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->TatuajeParteCuerpo)){
                                       echo $datos_entrevistado->TatuajeParteCuerpo;
                                    } 
                                ?>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Tienes pearcing?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Pearcing)){
                                       echo $datos_entrevistado->Pearcing;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Has practicado sexo con dolor? </b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->SexoConDolor)){
                                       echo $datos_entrevistado->SexoConDolor;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>En caso afirmativo, ¿cómo has actuado? </b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->SexoDolorActuado)){
                                       echo $datos_entrevistado->SexoDolorActuado;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Fumas?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Fuma)){
                                       echo $datos_entrevistado->Fuma;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                       <div class="text-right col-md-6"><b>¿Consumes actualmente Drogas?</b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Drogas)){
                                       echo $datos_entrevistado->Drogas;
                                    }
                             ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab4" aria-labelledby="nacionales-tab" aria-expanded="false">
                    <div class="text-center mt-4">
                        <h4>¿Qué estarías dispuesto(a) a hacer en cámara?</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Utilizar consolador? </b></div>
                        <div class="text-left col-md-6 icon">
                                <?php 
                                    if(!empty($datos_entrevistado->Consolador)){
                                       echo $datos_entrevistado->Consolador;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Utilizar redes sociales con tu nombre artístico?</b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->NombreArtisticoRss)){
                                       echo $datos_entrevistado->NombreArtisticoRss;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Transmitir con otra persona?  </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->TransmitirConOtro)){
                                       echo $datos_entrevistado->TransmitirConOtro;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Masturbarte?  </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Masturbarte)){
                                       echo $datos_entrevistado->Masturbarte;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Sexo anal? </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->SexoAnal)){
                                       echo $datos_entrevistado->SexoAnal;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Utilizar juguetería sexual?</b></div>
                       <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Jugueteria_Sexual)){
                                       echo $datos_entrevistado->Jugueteria_Sexual;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Baile erótico? </b></div>
                        <div class="text-left col-md-6 icon">
                                <?php 
                                    if(!empty($datos_entrevistado->BaileErotico)){
                                       echo $datos_entrevistado->BaileErotico;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Orgasmo online? </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->OrgasmoOnline)){
                                       echo $datos_entrevistado->OrgasmoOnline;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Leche - MILF?  </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->LecheMilf)){
                                       echo $datos_entrevistado->LecheMilf;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Striptease?   </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Striptease)){
                                       echo $datos_entrevistado->Striptease;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Juego de roles?  </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Juego_de_Roles)){
                                       echo $datos_entrevistado->Juego_de_Roles;
                                    }
                             ?>
                        </div>
                    </div>
                                        <div class="row">
                     <div class="text-right col-md-6"><b>¿Disfraces? </b></div>
                       <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Disfraces)){
                                       echo $datos_entrevistado->Disfraces;
                                    }
                             ?>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Sexo salvaje?  </b></div>
                        <div class="text-left col-md-6 icon">
                                <?php 
                                    if(!empty($datos_entrevistado->Sexo_Salvaje)){
                                       echo $datos_entrevistado->Sexo_Salvaje;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿CAM2CAM?  </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Cam2Cam)){
                                       echo $datos_entrevistado->Cam2Cam;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Show de aceite? </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->ShowAceite)){
                                       echo $datos_entrevistado->ShowAceite;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Nalgadas? </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Nalgadas)){
                                       echo $datos_entrevistado->Nalgadas;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Doble penetración? </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Doble_Penetración)){
                                       echo $datos_entrevistado->Doble_Penetración;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Orinar - Squirter?  </b></div>
                       <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Orinar_Squirter)){
                                       echo $datos_entrevistado->Orinar_Squirter;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Hablar sucio?   </b></div>
                        <div class="text-left col-md-6 icon">
                                <?php 
                                    if(!empty($datos_entrevistado->Hablar_Sucio)){
                                       echo $datos_entrevistado->Hablar_Sucio;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Fetiche de pies?   </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Fetiche_de_Pies)){
                                       echo $datos_entrevistado->Fetiche_de_Pies;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Fetiche de manos? </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Fetiche_de_Manos)){
                                       echo $datos_entrevistado->Fetiche_de_Manos;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Show dedos vagina?  </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Show_Dedos_Vagina)){
                                       echo $datos_entrevistado->Show_Dedos_Vagina;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Show dedos anal?  </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Show_Dedos_Anal)){
                                       echo $datos_entrevistado->Show_Dedos_Anal;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Varias chicas en cámara? </b></div>
                       <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Varias_Chicas_Cam)){
                                       echo $datos_entrevistado->Varias_Chicas_Cam;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Esclavitud o servidumbre?   </b></div>
                        <div class="text-left col-md-6 icon">
                                <?php 
                                    if(!empty($datos_entrevistado->Esclavitud_Servidumbre)){
                                       echo $datos_entrevistado->Esclavitud_Servidumbre;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Dominatriz?    </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Dominatriz)){
                                       echo $datos_entrevistado->Dominatriz;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Azote?  </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Azote)){
                                       echo $datos_entrevistado->Azote;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Pezones perforados? </b></div>
                        <div class="text-left col-md-6 icon">
                            <?php 
                                    if(!empty($datos_entrevistado->Pezones_Perforados)){
                                       echo $datos_entrevistado->Pezones_Perforados;
                                    }
                             ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab5" aria-labelledby="nacionales-tab" aria-expanded="false">
                    <div class="text-center mt-4">
                        <h4>Tipo de música</h4>
                    </div>
                    <div class="row">
                       <div class="text-right col-md-6">Electronica </div> 
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Electrónica)){
                                       echo $datos_entrevistado->Electrónica;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Vallenatos  </b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->Vallenatos)){
                                       echo $datos_entrevistado->Vallenatos;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Rancheras </b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Rancheras)){
                                       echo $datos_entrevistado->Rancheras;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Baladas  </b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Baladas)){
                                       echo $datos_entrevistado->Baladas;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Popular </b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Popular)){
                                       echo $datos_entrevistado->Popular;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Pop en español </b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Pop_Español)){
                                       echo $datos_entrevistado->Pop_Español;
                                    }
                             ?>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Rock en español </b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Rock_Español)){
                                       echo $datos_entrevistado->Rock_Español;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Rock en inglés</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->Rock_Inglés)){
                                       echo $datos_entrevistado->Rock_Inglés;
                                    } 
                                ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab6" aria-labelledby="nacionales-tab" aria-expanded="false">
                    <div class="text-center mt-4">
                        <h4>Ciclo mestrual</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Tu ciclo menstrual es?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->CicloMes)){
                                       echo $datos_entrevistado->CicloMes;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Fechas aproximadas del Periodo </b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Periodo_Mestruación)){
                                       echo $datos_entrevistado->Periodo_Mestruación;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Cólicos</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Colicos)){
                                       echo $datos_entrevistado->Colicos;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Duración del periodo </b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Duración_Periodo)){
                                       echo $datos_entrevistado->Duración_Periodo;
                                    }
                             ?>
                        </div>
                    </div> 
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab7" aria-labelledby="nacionales-tab" aria-expanded="false">
                    <div class="text-center mt-4">
                        <h4>Estructura fisica</h4>
                    </div>
                    <div class="row">
                       <div class="text-right col-md-6"><b>¿Talla de senos o tamaño del pene? </b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Tamaño_del_Miembro_o_senos)){
                                       echo $datos_entrevistado->Tamaño_del_Miembro_o_senos;
                                    }
                             ?>
                        </div>   
                    </div>
                    <div class="row">
                       <div class="text-right col-md-6"><b>Medida Cintura? </b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Medida_Cintura)){
                                       echo $datos_entrevistado->Medida_Cintura;
                                    }
                             ?>
                        </div>   
                    </div>
                    <div class="row">
                       <div class="text-right col-md-6"><b>Estatura en Metros? </b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Estatura_Metros)){
                                       echo $datos_entrevistado->Estatura_Metros;
                                    }
                             ?>
                        </div>   
                    </div>
                    <div class="row">
                       <div class="text-right col-md-6"><b>Peso en Kilos? </b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Peso_Kilos)){
                                       echo $datos_entrevistado->Peso_Kilos;
                                    }
                             ?>
                        </div>   
                    </div>
                    <div class="text-center mt-4">
                        <h4>¿De tu cuerpo te gusta?</h4>
                    </div>
                    <div class="row">
                       <div class="text-right col-md-6"><b>¿Pelo? </b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Pelo)){
                                       echo $datos_entrevistado->Pelo;
                                    }
                             ?>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Labios?</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->Labios)){
                                       echo $datos_entrevistado->Labios;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Cara?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Cara)){
                                       echo $datos_entrevistado->Cara;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Oídos?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Oidos)){
                                       echo $datos_entrevistado->Oidos;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Cejas?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Cejas)){
                                       echo $datos_entrevistado->Cejas;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Ojos? </b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Ojos)){
                                       echo $datos_entrevistado->Ojos;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Nariz? </b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Nariz)){
                                       echo $datos_entrevistado->Nariz;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Uñas?</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->Uñas)){
                                       echo $datos_entrevistado->Uñas;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Senos?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Senos)){
                                       echo $datos_entrevistado->Senos;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Manos?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Manos)){
                                       echo $datos_entrevistado->Manos;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Pies?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Pies)){
                                       echo $datos_entrevistado->Pies;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Cintura?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Cintura)){
                                       echo $datos_entrevistado->Cintura;
                                    }
                             ?>
                        </div>
                    </div>
                                        <div class="row">
                        <div class="text-right col-md-6"><b>¿Espalda?</b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Espalda)){
                                       echo $datos_entrevistado->Espalda;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Hombros?</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->Hombros)){
                                       echo $datos_entrevistado->Hombros;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Abdomen?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Abdomen)){
                                       echo $datos_entrevistado->Abdomen;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Qué es lo que más te gusta de tu cuerpo?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Parte_que_mas_te_gusta_de_tu_cuerpo)){
                                       echo $datos_entrevistado->Parte_que_mas_te_gusta_de_tu_cuerpo;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Qué es lo que menos te gusta de tu cuerpo?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Parte_que_menos_te_gusta_de_tu_cuerpo)){
                                       echo $datos_entrevistado->Parte_que_menos_te_gusta_de_tu_cuerpo;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4>Contratación</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Qué vas a decir en casa?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Qué_vas_a_decir_en_tu_casa)){
                                     echo $datos_entrevistado->Qué_vas_a_decir_en_tu_casa;
                                    }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Como te gustaría llamarte en las páginas?</b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Como_te_gustaría_llamarte_en_las_páginas)){
                                       echo $datos_entrevistado->Como_te_gustaría_llamarte_en_las_páginas;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Firmarias contrato?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Firmar_Contrato)){
                                       echo $datos_entrevistado->Firmar_Contrato;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Como te gustaria llamarte en paginas?</b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Como_te_gustaría_llamarte_en_las_páginas)){
                                       echo $datos_entrevistado->Como_te_gustaría_llamarte_en_las_páginas;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4>Facultades personales</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Aprendes fácilmente?</b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->AprendeFacil)){
                                       echo $datos_entrevistado->AprendeFacil;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Te gustan los retos?</b></div>
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Retos)){
                                       echo $datos_entrevistado->Retos;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Puedes obedecer órdenes?</b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->Retos)){
                                       echo $datos_entrevistado->Retos;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Rompes las reglas?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Ordenes)){
                                       echo $datos_entrevistado->Ordenes;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Eres puntual?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->RompesReglas)){
                                       echo $datos_entrevistado->RompesReglas;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Eres cumplido (a)? </b></div>
                        <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Cumplido)){
                                       echo $datos_entrevistado->Cumplido;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Eres responsable? </b></div>         
                       <div class="text-left col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Responsable)){
                                       echo $datos_entrevistado->Responsable;
                                    }
                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Cumples horarios? </b></div>
                        <div class="text-left col-md-6">
                                <?php 
                                    if(!empty($datos_entrevistado->CumplesHorarios)){
                                       echo $datos_entrevistado->CumplesHorarios;
                                    } 
                                ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Te gusta madrugar? </b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Madrugar)){
                                       echo $datos_entrevistado->Madrugar;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>¿Te gusta trasnochar?</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->Trasnochar)){
                                       echo $datos_entrevistado->Trasnochar;
                                    }
                            ?>  
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4>Certifico que todas las anteriores respuestas son veraces</h4>
                    </div>
                    <div class="row">
                        <div class="text-right col-md-6"><b>Certifico :</b></div>
                        <div class="text-left col-md-6">
                            <?php                                             
                                    if(!empty($datos_entrevistado->AseptoTerminos)){
                                       echo $datos_entrevistado->AseptoTerminos;
                                    }
                            ?>  
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
    	</div>	
	</div>
</div>
<script>
    $(document).ready(function(){
        var advertencia = $('.icon');
        advertencia.each(function(){
            if($.trim($(this).text()) == 'No'){
                $(this).append(' <i class="fas fa-exclamation-triangle"></i>');
            }
        });
    });
</script>
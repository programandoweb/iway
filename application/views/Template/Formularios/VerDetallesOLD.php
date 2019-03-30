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
?>
<div class="container" style="margin-bottom:100px;">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="form">
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <h3>Detalles Entrevistado.</h3>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                 <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">
                        Informacion 1
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">
                        Informacion 2
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">
                        Informacion 3
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4" role="tab">
                        Informacion 4
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab5" role="tab">
                        Informacion 5
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab6" role="tab">
                        Informacion 6
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab7" role="tab">
                        Informacion 7
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab8" role="tab">
                        Informacion 8
                    </a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab9" role="tab">
                        Informacion 9
                    </a>
                 </li>
            </ul>
                <div class="tab-content col-md-12 container">
                    <?php
                        foreach($this->$modulo->result as  $key => $v){
                            $datos_entrevistado =    json_decode($v->json_entrevista);                                  
                    ?> 
                   
                    <div id="tab7" class="tab-pane row" role="tabpanel"> 
                       <div class="text-center col-md-12"> Gustos Musicales</div>
                       <div class="text-right col-md-6">Electronica </div> 
                       <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Electrónica)){
                                       echo $datos_entrevistado->Electrónica;
                                    }
                             ?>
                        </div>
                        <div class="text-center col-md-6"><b>Vallenatos  </b></div>
                        <div>
                            <b>
                                <?php 
                                    if(!empty($datos_entrevistado->Vallenatos)){
                                       echo $datos_entrevistado->Vallenatos;
                                    } 
                                ?>
                            </b>
                        </div>
                        <div class="text-center col-md-6"><b>Rancheras </b></div>
                        <div>
                            <?php                                             
                                    if(!empty($datos_entrevistado->Rancheras)){
                                       echo $datos_entrevistado->Rancheras;
                                    }
                            ?>  
                        </div>
                        <div class="text-center col-md-6"><b>Baladas  </b></div>
                        <div>
                            <?php                                             
                                    if(!empty($datos_entrevistado->Baladas)){
                                       echo $datos_entrevistado->Baladas;
                                    }
                            ?>  
                        </div>
                        <div class="text-center col-md-6"><b>Popular </b></div>
                        <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Popular)){
                                       echo $datos_entrevistado->Popular;
                                    }
                             ?>
                        </div>
                        <div class="text-center col-md-6"><b>Electrónica </b></div>
                        <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->PopEspañol)){
                                       echo $datos_entrevistado->PopEspañol;
                                    }
                             ?>
                        </div>  
                       <div class="text-center col-md-6"><b>Rock en español </b></div>
                       <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->RockEspañol)){
                                       echo $datos_entrevistado->RockEspañol;
                                    }
                             ?>
                        </div>
                        <div class="text-center col-md-6"><b>Rock en inglés</b></div>
                        <div>
                            <b>
                                <?php 
                                    if(!empty($datos_entrevistado->RockIngles)){
                                       echo $datos_entrevistado->RockIngles;
                                    } 
                                ?>
                            </b>
                        </div>
                        <div class="text-center col-md-6"><b>¿Tu ciclo menstrual es?</b></div>
                        <div>
                            <?php                                             
                                    if(!empty($datos_entrevistado->CicloMes)){
                                       echo $datos_entrevistado->CicloMes;
                                    }
                            ?>  
                        </div>
                        <div class="text-center col-md-6"><b>Fechas aproximadas del Periodo </b></div>
                        <div>
                            <?php                                             
                                    if(!empty($datos_entrevistado->PeriodoMestruacion)){
                                       echo $datos_entrevistado->PeriodoMestruacion;
                                    }
                            ?>  
                        </div>
                        <div class="text-center col-md-6"><b>Cólicos</b></div>
                        <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Colicos)){
                                       echo $datos_entrevistado->Colicos;
                                    }
                             ?>
                        </div>
                        <div class="text-center col-md-6"><b>Duración del periodo </b></div>
                        <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->DuracionPeriodo)){
                                       echo $datos_entrevistado->DuracionPeriodo;
                                    }
                             ?>
                        </div>
                    </div>  
                    <div id="tab8" class="tab-pane row" role="tabpanel"> 
                       <div class="text-center col-md-12"><b>¿De tu cuerpo te gusta? </b></div>
                       <div class="text-center col-md-6"><b>¿Pelo? </b></div>
                       <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Pelo)){
                                       echo $datos_entrevistado->Pelo;
                                    }
                             ?>
                        </div>
                        <div class="text-center col-md-6"><b>¿Labios?</b></div>
                        <div>
                            <b>
                                <?php 
                                    if(!empty($datos_entrevistado->Labios)){
                                       echo $datos_entrevistado->Labios;
                                    } 
                                ?>
                            </b>
                        </div>
                        <div class="text-center col-md-6"><b>¿Cara?</b></div>
                        <div>
                            <?php                                             
                                    if(!empty($datos_entrevistado->Cara)){
                                       echo $datos_entrevistado->Cara;
                                    }
                            ?>  
                        </div>
                        <div class="text-center col-md-6"><b>¿Oídos?</b></div>
                        <div>
                            <?php                                             
                                    if(!empty($datos_entrevistado->Oidos)){
                                       echo $datos_entrevistado->Oidos;
                                    }
                            ?>  
                        </div>
                        <div class="text-center col-md-6"><b>¿Cejas?</b></div>
                        <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Cejas)){
                                       echo $datos_entrevistado->Cejas;
                                    }
                             ?>
                        </div>
                        <div class="text-center col-md-6"><b>¿Ojos? </b></div>
                        <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Ojos)){
                                       echo $datos_entrevistado->Ojos;
                                    }
                             ?>
                        </div>  
                        <div class="text-center col-md-12"><b>¿De tu cuerpo te gusta? </b></div>
                       <div class="text-center col-md-6"><b>¿Nariz? </b></div>
                       <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Nariz)){
                                       echo $datos_entrevistado->Nariz;
                                    }
                             ?>
                        </div>
                        <div class="text-center col-md-6"><b>¿Uñas?</b></div>
                        <div>
                            <b>
                                <?php 
                                    if(!empty($datos_entrevistado->Uñas)){
                                       echo $datos_entrevistado->Uñas;
                                    } 
                                ?>
                            </b>
                        </div>
                        <div class="text-center col-md-6"><b>¿Senos?</b></div>
                        <div>
                            <?php                                             
                                    if(!empty($datos_entrevistado->Senos)){
                                       echo $datos_entrevistado->Senos;
                                    }
                            ?>  
                        </div>
                        <div class="text-center col-md-6"><b>¿Manos?</b></div>
                        <div>
                            <?php                                             
                                    if(!empty($datos_entrevistado->Manos)){
                                       echo $datos_entrevistado->Manos;
                                    }
                            ?>  
                        </div>
                        <div class="text-center col-md-6"><b>¿Pies?</b></div>
                        <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Pies)){
                                       echo $datos_entrevistado->Pies;
                                    }
                             ?>
                        </div>
                        <div class="text-center col-md-6"><b>¿Cintura?</b></div>
                        <div class="text-center col-md-6">
                            <?php 
                                    if(!empty($datos_entrevistado->Cintura)){
                                       echo $datos_entrevistado->Cintura;
                                    }
                             ?>
                        </div>
                    </div>
                    <div id="tab9" class="tab-pane row" role="tabpanel">   
                            <div class="text-center col-md-12"><b>¿De tu cuerpo te gusta? </b></div>
                                       <div class="text-center col-md-6"><b>¿Espalda?</b></div>
                                       <div class="text-center col-md-6">
                                            <?php 
                                                    if(!empty($datos_entrevistado->Espalda)){
                                                       echo $datos_entrevistado->Espalda;
                                                    }
                                             ?>
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Hombros?</b></div>
                                        <div>
                                            <b>
                                                <?php 
                                                    if(!empty($datos_entrevistado->Hombros)){
                                                       echo $datos_entrevistado->Hombros;
                                                    } 
                                                ?>
                                            </b>
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Abdomen?</b></div>
                                        <div>
                                            <?php                                             
                                                    if(!empty($datos_entrevistado->Abdomen)){
                                                       echo $datos_entrevistado->Abdomen;
                                                    }
                                            ?>  
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Qué es lo que más te gusta de tu cuerpo?</b></div>
                                        <div>
                                            <?php                                             
                                                    if(!empty($datos_entrevistado->MasMegustaDelCuerpo)){
                                                       echo $datos_entrevistado->MasMegustaDelCuerpo;
                                                    }
                                            ?>  
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Qué es lo que menos te gusta de tu cuerpo?</b></div>
                                        <div class="text-center col-md-6">
                                            <?php 
                                                    if(!empty($datos_entrevistado->MenosMegustaDelCuerpo)){
                                                       echo $datos_entrevistado->MenosMegustaDelCuerpo;
                                                    }
                                             ?>
                                        </div> 
                                        <div class="text-center col-md-6"><b>¿Qué vas a decir en casa?</b></div>
                                        <div class="text-center col-md-6">
                                            <?php 
                                                    if(!empty($datos_entrevistado->QueVasDecirCasa)){
                                                     echo $datos_entrevistado->QueVasDecirCasa;
                                                    }
                                            ?>
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Aprendes facil?</b></div>
                                       <div class="text-center col-md-6">
                                            <?php 
                                                    if(!empty($datos_entrevistado->AprendeFacil)){
                                                       echo $datos_entrevistado->AprendeFacil;
                                                    }
                                             ?>
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Puedes obedecer órdenes?</b></div>
                                        <div>
                                            <b>
                                                <?php 
                                                    if(!empty($datos_entrevistado->Retos)){
                                                       echo $datos_entrevistado->Retos;
                                                    } 
                                                ?>
                                            </b>
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Rompes las reglas?</b></div>
                                        <div>
                                            <?php                                             
                                                    if(!empty($datos_entrevistado->Ordenes)){
                                                       echo $datos_entrevistado->Ordenes;
                                                    }
                                            ?>  
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Eres puntual?</b></div>
                                        <div>
                                            <?php                                             
                                                    if(!empty($datos_entrevistado->RompesReglas)){
                                                       echo $datos_entrevistado->RompesReglas;
                                                    }
                                            ?>  
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Eres cumplido (a)? </b></div>
                                        <div class="text-center col-md-6">
                                            <?php 
                                                    if(!empty($datos_entrevistado->Cumplido)){
                                                       echo $datos_entrevistado->Cumplido;
                                                    }
                                             ?>
                                        </div> 
                                       <div class="text-center col-md-6"><b>¿Eres responsable? </b></div>         
                                       <div class="text-center col-md-6">
                                            <?php 
                                                    if(!empty($datos_entrevistado->Responsable)){
                                                       echo $datos_entrevistado->Responsable;
                                                    }
                                             ?>
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Cumples horarios? </b></div>
                                        <div>
                                            <b>
                                                <?php 
                                                    if(!empty($datos_entrevistado->CumplesHorarios)){
                                                       echo $datos_entrevistado->CumplesHorarios;
                                                    } 
                                                ?>
                                            </b>
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Te gusta madrugar? </b></div>
                                        <div>
                                            <?php                                             
                                                    if(!empty($datos_entrevistado->Madrugar)){
                                                       echo $datos_entrevistado->Madrugar;
                                                    }
                                            ?>  
                                        </div>
                                        <div class="text-center col-md-6"><b>¿Te gusta trasnochar?</b></div>
                                        <div>
                                            <?php                                             
                                                    if(!empty($datos_entrevistado->Trasnochar)){
                                                       echo $datos_entrevistado->Trasnochar;
                                                    }
                                            ?>  
                                        </div>
                                    </div>
                            <?php 
                                } 
                            ?>
                </div>
            </div>
        </div>	
    </div>
</div>
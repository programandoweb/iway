<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.nethygvjky
*/?>
<?php 
echo form_open(current_url("Formularios/Autenticacion"));
$modulo     =   $this->ModuloActivo;
?>
<div class="container" style="margin-bottom:20px;">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="form">
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <?php 
                            echo TaskBar(array("name"       =>  array(  "title" =>  "Detalles examen",
                                                                        'icono'=>'<i class="fas fa-user-circle"></i>',
                                                                        "url"   =>  current_url()),                     
                                                "pdf"       =>  array(  "url"   =>  current_url().'/PDF',),
                                                "mail"      =>  array(  "id"    =>  "mail" ),  
                                        )
                                    );
                        ?>
                    </div>
                </div>
            </div>
            <?php
                foreach($this->$modulo->result as  $key => $v){
                    $datos_entrevistado = json_decode($v->json_entrevista);
                    $datos_examen =    json_decode($v->json_respuestas);
                    //pre($datos_examen);
                    //pre($datos_entrevistado);                                  
                                            
                            foreach ($datos_examen->pregunta as $indice => $valor) {
                               if(!empty($datos_examen->respuesta->$indice)){ 
                               $la_que_respondio   =   $datos_examen->respuesta->$indice;
                                    echo '<div class="row p-3">';
                        ?>
                                <?php
                                    foreach($valor as $key => $value){
                                        if(!empty($value)){
                                            if($key==0){
                                                echo '<div class="col-md-4">'.$value.'</div>';
                                            }else{
                                                if($key == 1){
                                                    echo '<div class="col-md-4">';
                                                }
                                                if($value==$la_que_respondio){
                                                    echo '<div class="col-md-12"><i class="fa fa-check-circle" aria-hidden="true" style="color:#FF8067;"></i> '.$value.'</div>';
                                                }else{
                                                    echo '<div class="col-md-12"><i class="fa fa-circle" aria-hidden="true"></i> '.$value.'</div>';
                                                }
                                                if($key == 3){
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                    }
                                    if( $datos_examen->$indice == 0){
                                            echo '<div class="col-md-4 text-right" style="color:red;"><i class="fa fa-times" aria-hidden="true"> Incorrecto</i></div>';
                                        }else{
                                            echo '<div class="col-md-4 text-right" style="color:green;"><i class="fa fa-check"> Correcto</i></div>';
                                        }
                                    echo '</div>';
                                }    
                            }
                } 
            ?>
        </div>
    </div>
</div>


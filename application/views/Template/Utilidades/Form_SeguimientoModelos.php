<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
//pre($this->Usuarios->result);
//pre($this->user);
echo form_open(current_url(),array('ajax' => 'true'));	?>
<div class="container" style="margin-bottom:70px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	        	<div class="row form-group item">
	            	<div class="col-md-12 text-center">
		            	<h2>Seguimiento y evaluación Modelo.</h2>
                    </div>
                </div>
                <div>
                	<div class="row item">
                        <div class="row form-group">
                            <div class="alert alert-info col-md-12" role="alert">
                                <div class="text-center">
                                    <h3>Análisis Modelo.</h3>                         
                                </div>
                                <b><h6>Para la correcta evalución, realizar un análisis con una calificación cuantitiva  entre uno (1) y diez (10), siendo uno (1) la calificación más baja y diez (10) la calificación más alta.</h6></b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="col-xs-12">
                                <b><h5>Evaluador.</h5></b>
                            </div>
                            <div class="col-xs-12">
                            <?php
                                $NombreEvaluador =  nombre($this->user); 
                            echo set_input("nombre_evaluador",$NombreEvaluador,"NombreEvaluador",true,"form-control",array("readonly"=>"readonly")); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="col-xs-12">
                                <b><h5>Modelo. *</h5></b>
                            </div>
                            <div class="col-xs-12">
                                <?php echo modelo("user_id",array("class"=>"form-control")); ?>
                            </div>
                        </div>
                    </div>
                    <div class="puntuacion item">
                    	<div class="row form-group">
                    		<div class="col md-12 mt-2 text-center">
                        		<h4 class="">Manejo informático.</h4>                      	
                        	</div>
                    	</div>                         
                    	<div class="row form-group sum-input">
                        	<div class="col-md-6 text-right">	
                            	<b>Agilidad en el manejo del teclado. *</b>
                        	</div>
                        	<div class="col-md-4 text-right">
                        		<?php echo MakeEscalaNum("AgilidadTeclado",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    		</div>
                    	</div>                    
                    	<div class="row form-group sum-input">
                        	<div class="col-md-6 text-right">	
                            	<b>Uso de comando rápidos. *</b>
                        	</div>
                        	<div class="col-md-4 text-right">
                        		<?php echo MakeEscalaNum("usoComandos",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    		</div>
                    	</div>                    
                    	<div class="row form-group sum-input">
                        	<div class="col-md-6 text-right">	
                            	<b>Uso de los recursos del navegador. *</b>
                        	</div>
                        	<div class="col-md-4 text-right">
                          		<?php echo MakeEscalaNum("usoRecursosNavegador",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    		</div>
                    	</div>                    
                    	<div class="row form-group sum-input">                    
                        	<div class="col-md-6 text-right">	
                            	<b>Calidad de la imágen (configuración). *</b>
                        	</div>
                        	<div class="col-md-4 text-right">
                          		<?php echo MakeEscalaNum("calidadImagen",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    		</div>
                    	</div>                    
                    	<div class="row form-group sum-input">                    
                        	<div class="col-md-6 text-right">	
                            	<b>Identificación de los errores de la página. *</b>
                        	</div>
                        	<div class="col-md-4 text-right">
                          		<?php echo MakeEscalaNum("identificacionErrores",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    		</div>
                    	</div>                    
                    </div>
                <div class="puntuacion item">                
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Conocimiento del inglés. *</h4>                      	
                    	</div>
                	</div>                         
                   	<div class="row form-group sum-input">
                       	<div class="col-md-6 text-right">	
                           	<b>Sostener conversaciones básicas, sin uso del traductor. *</b>
                       	</div>
                       	<div class="col-md-4 text-right">
                     		<?php echo MakeEscalaNum("conversacionesSinTraductor",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                		</div>
                	</div>                    
                	<div class="row form-group sum-input">
                    	<div class="col-md-6 text-right">	
                        <b>Uso del traductor. *</b>
                    	</div>
                    	<div class="col-md-4 text-right">
                      		<?php echo MakeEscalaNum("usoTraductor",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                		</div>
                	</div>                    
                	<div class="row form-group sum-input">
                    	<div class="col-md-6 text-right">	
                        	<b>Calidad de las traducciones. *</b>
                    	</div>
                    	<div class="col-md-4 text-right">
                      		<?php echo MakeEscalaNum("calidadTraducciones",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                		</div>
                	</div>                    
                	<div class="row form-group sum-input">                    
                    	<div class="col-md-6 text-right">	
                        	<b>Conocimiento de jerga y abreviaturas. *</b>
                    	</div>
                    	<div class="col-md-4 text-right">
                      		<?php echo MakeEscalaNum("conocimientoJerga",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                		</div>
                	</div>                    
                	<div class="row form-group sum-input">                    
                    	<div class="col-md-6 text-right">	
                        	<b>Conocimiento de palabras técnicas. *</b>
                    	</div>
                    	<div class="col-md-4 text-right">
                      		<?php echo MakeEscalaNum("conocimientopalabrasTecnicas",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                		</div>
                	</div>                    
                </div>
                <div class="puntuacion item">                                     
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Apariencia física.</h4>                      	
                    	</div>
                	</div>                         
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Estado del cabello. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("estadoCabello",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Estado de las uñas. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("estadoUnas",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Calidad del maquillaje. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("calidadMaquillaje",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">                    
                        <div class="col-md-6 text-right">	
                            <b>Uso de lencería adecuada. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("usoLenceriaAdecuada",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div> 
                </div>
                <div class="puntuacion item">                                       
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Buenas Costumbres.</h4>                      	
                    	</div>
                	</div>                        
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Organización del Room. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("OrganizacionRom",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>No se distrae con dispositivos personales. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("NoSeDistraeConDispositivos",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Solo usa el español cuando es necesario. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("UsaEspanolCuandoEsNesc",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">                    
                        <div class="col-md-6 text-right">	
                            <b>No usa jerga latina en las traduccion. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("NoJergaLatinaTraduccion",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div> 
                </div>
                <div class="puntuacion item">                    
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Conocimiento Teórico.</h4>                      	
                    	</div>
                	</div>                         
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Manejo de la plataforma de trasmisión. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("ManejoPlataforma",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Movimientos delante de la cámara. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("MovimientosCamara",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Desarrollo de su show. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("DesarrolloShow",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">                    
                        <div class="col-md-6 text-right">	
                            <b>Calidad en el uso de juguetes. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("CalidadUsoJuguetes",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                                      
                </div>
                <div class="puntuacion item">                   
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Uso de Tópics.</h4>                      	
                    	</div>
                	</div>
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Pública topics en las páginas necesarias. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("publicaTopics",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Estructura del topic. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("EstructuraTopic",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Coherencia en la redacción del topic. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("CoherenciaRedaccionTopic",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">                    
                        <div class="col-md-6 text-right">	
                            <b>Relación entre el topic y el Show. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("RelTopicShow",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                                      
                </div>
                <div class="puntuacion item">                                
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Expresión Corporal.</h4>                      	
                    	</div>
                	</div>
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Expresión de alegría. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("ExpresionAlegria",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Gesticulación. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("Gesticulacion",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Coordinación motriz. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("CordinacionMotriz",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">                    
                        <div class="col-md-6 text-right">	
                            <b>Postura corporal. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("Postura",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                                       
                    <div class="row form-group sum-input">                    
                        <div class="col-md-6 text-right">	
                            <b>Interacción con los usuarios. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("Interaccion",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                                      
                    <div class="row form-group sum-input">                    
                        <div class="col-md-6 text-right">	
                            <b>Calidad del baile. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("CalidadBaile",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                                      
                </div>
                <div class="puntuacion item">                 
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Personalidad. *</h4>                      	
                    	</div>
                	</div>
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Astucia femenina. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("Astucia",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Capacidades sexuales. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("CapacidadesSexuales",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Correcta interpretación de su Rol. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("InterpretacionRol",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>
                </div>
                <div class="puntuacion item">                                        
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Conversaciones.</h4>                      	
                    	</div>
                    </div>
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Conocimiento ortográfico. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("Ortografia",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Uso de regionalismos. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("Regionalismos",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Coherencia en la conversación. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("CoherenciaConversacion",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                 
                   <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Fluidez y calidad de la conversación. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("FluidezConversacion",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>
                </div>
                <div class="puntuacion item">                                    
                	<div class="row form-group">
                		<div class="col md-12 mt-2 text-center">
                    		<h4>Calidad y Tiempos del Desnudo.</h4>                      	
                    	</div>
                	</div>				
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Hace el desnudo de forma correcta. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("Desnudo",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Calidad del striptease. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("CalidadStriptease",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Calidad del Show Free. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("CalidadShow",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>
                   <div class="row form-group sum-input">
                        <div class="col-md-6 text-right">	
                            <b>Sensualidad en los movimientos. *</b>
                        </div>
                        <div class="col-md-4 text-right">
                          <?php echo MakeEscalaNum("SensualidadMovimientos",10,"",array("class"=>"form-control ObservacionJson","require"=>"require")); ?>
                    	</div>
                    </div>
                </div>
                <div class="puntuacion item">                     
				   <div class="col-md-12 text-center">
                   		<div class="form">
                    		<h4>Recomendaciones.</h4>                      	
                    	</div>
                   </div>
				   <div id="input-sum" class="col-md-12 mb-4 text-left">
                        <input id="sum_total" type="hidden" name="total_respuestas">
                   		<input type="text" name="Recomendaciones" class="form-control" style="height:80px" placeholder="Especifique..."/>
                   </div>
                    <div class="row">
						<div class="col-md-12">
							<div class="form-group text-center">
                           		 <button id="enviar_puntuacion" type="submit" class="btn btn-primary">Aceptar</button>
                       		</div>                        
                    	</div>
                    </div>
                </div>                                       
			</div>
       	</div>
   	</div>
</div>
<?php echo form_close();?>
<script>
    $(document).ready(function(){
        $('.puntuacion').find('.sum-input').append('<div class="col-md-2"><i class="fa fa-plus AgregarObservacion mt-2" style="cursor:pointer;"></i></div>');

        $('.sum-input').on('click','.AgregarObservacion',function(){
            var name =$(this).parent('div').parent('div').find('.ObservacionJson').attr("name");
            $(this).removeClass('fa-plus AgregarObservacion').addClass('fa-minus cerrar');
            var elem = $('<div class="col-md-12 m-4 text-left observacion"><input type="text" name="Ob_'+name+'" class="form-control" style="height:80px" placeholder="Especifique..."/></div>');
                $(this).parent('div').parent('div').append(elem);
        });
        $('.sum-input').on('click','.cerrar',function(){
            $(this).removeClass('fa-minus cerrar').addClass('fa-plus AgregarObservacion')
            $(this).parent('div').parent('div').find('.observacion').remove(); 
        });
        $('#enviar_puntuacion').click(function(e){
            e.preventDefault();
            var val = 0;
            var total = $('.ObservacionJson');
            total.each(function() {
                val += parseInt($(this).val());
            });
            $('#sum_total').val(val);
            $('#enviar_puntuacion').submit();
        });  
    });     
</script>
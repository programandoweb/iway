<?php
	$modulo				     = 	$this->ModuloActivo;	
	$periodos_de_pago	     =	centrodecostos($this->user->id_empresa)->periodo_pagos;
	$cantidad_a_mostrar	     =	($periodos_de_pago==2)?4:3;
	$mes		 =	(int)calculo_meses(date("Y-m-d"),'-'.$cantidad_a_mostrar,'m');
    if($mes < 10){
        $calculo_desde_mes = "0".$mes;
    }else{
        $calculo_desde_mes = $mes;
    }
    $calculo_desde_year      =  (int)calculo_meses(date("Y-m-d"),'-'.$cantidad_a_mostrar,"Y");
    $calculo_desde           =  $calculo_desde_year.'-'.$calculo_desde_mes.'-01';
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Estado de Resultados.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),

                                    "pdf"       =>  array(  "title" =>  "PDF",
                                                            "url"   =>  current_url().'/PDF'),
							)
						);
			?>
        	<div class="row">
            	<div class="col-md-12">
					<div class="section">
                    	<div class="bd-example bd-example-tabs" role="tabpanel">
                        	<ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item" aria-expanded="false">Resultados (<b>COP</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item3-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item" aria-expanded="false">Resultados (<b>USD</b>)</a>
                                </li>
							</ul>
                            <div class="tab-content" id="myTabContent">
                              	<div role="tabpanel" class="tab-pane fade active show" id="item1" aria-labelledby="item-tab" aria-expanded="false">
                                    <div id="controls" class="d-flex">
                                        <i class="fas fa-arrow-alt-circle-left pl-4 pt-2 pb-2 mr-auto retroceder" style="font-size: 20px;cursor: pointer;"></i>
                                        <i class="fas fa-arrow-alt-circle-right pr-4 pt-2 pb-2 ml-auto avanzar" style="font-size: 20px;cursor: pointer;"></i></div>
                                    <div id="resultados"></div>                                
								</div>
                                <div role="tabpanel" class="tab-pane fade" id="item2" aria-labelledby="item-tab" aria-expanded="false">  
                                    <div id="controls" class="d-flex">
                                        <i class="fas fa-arrow-alt-circle-left pl-4 pt-2 pb-2 mr-auto retroceder" style="font-size: 20px;cursor: pointer;"></i>
                                        <i class="fas fa-arrow-alt-circle-right pr-4 pt-2 pb-2 ml-auto avanzar" style="font-size: 20px;cursor: pointer;"></i></div>
                                    <div id="resultados_usd"></div>                               
                                </div>
							</div>                                    
						</div>                                                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var calculo_desde = '<?php echo $calculo_desde; ?>';
        var cantidad_a_mostrar = '<?php echo $cantidad_a_mostrar; ?>';
        var url = '<?php echo base_url('Reportes/consultarEstadoResultados'); ?>';
        var url2 = '<?php echo base_url('Reportes/consultarEstadoResultados2'); ?>';

        $(".retroceder").click(function(){
            var mes_a_calcular = calculo_desde.split('-');
            var calculo_mes = parseInt(mes_a_calcular[1]) -1;
            if(calculo_mes < 1){
                mes_a_calcular[1] = 12;
                parseInt(mes_a_calcular[0])-1;
            }
            if(calculo_mes < 10){var mes = "0"+calculo_mes;}else{mes = $calculo_mes}
            calculo_desde = mes_a_calcular[0]+'-'+mes+'-'+mes_a_calcular[2];
            cargar_data(calculo_desde);
        });

        $(".avanzar").click(function(){
            var mes_a_calcular = calculo_desde.split('-');
            var calculo_mes = parseInt(mes_a_calcular[1]) +1;
            if(calculo_mes < 1){
                mes_a_calcular[1] = 12;
                parseInt(mes_a_calcular[0])+1;
            }
            if(calculo_mes < 10){var mes = "0"+calculo_mes;}else{mes = $calculo_mes}
            calculo_desde = mes_a_calcular[0]+'-'+mes+'-'+mes_a_calcular[2];
            cargar_data(calculo_desde);
        });

        cargar_data(calculo_desde);
        function cargar_data(calculo_desde){
            $.post(url,{calculo_desde:calculo_desde,cantidad_a_mostrar:cantidad_a_mostrar},function(data){
            },'json').fail(function() {
                make_message("Error","Este informe no pudo ser cagado por favor consulte al administrador de sistema");
            }).done(function(data){
                $('#resultados').html(data);
            });
            $.post(url2,{calculo_desde:calculo_desde,cantidad_a_mostrar:cantidad_a_mostrar},function(data){
            },'json').fail(function() {
                make_message("Error","Este informe no pudo ser cagado por favor consulte al administrador de sistema");
            }).done(function(data2){
                $('#resultados_usd').html(data2);
            });   
        }

        /*$("#retroceder2").click(function(){
            alert("Retroceder2")
            var mes_a_calcular2 = calculo_desde2.split('-');
            var calculo_mes2 = parseInt(mes_a_calcular2[1]) -1;
            if(calculo_mes2 < 1){
                mes_a_calcular2[1] = 12;
                parseInt(mes_a_calcular2[0])-1;
            }
            if(calculo_mes2 < 10){var mes2 = "0"+calculo_mes2;}else{mes2 = $calculo_mes2}
            calculo_desde2 = mes_a_calcular2[0]+'-'+mes2+'-'+mes_a_calcular2[2];
            cargar_data(calculo_desde2);
        });

        $("#avanzar2").click(function(){
            alert("avanzar2");
            var mes_a_calcular2 = calculo_desde2.split('-');
            var calculo_mes2 = parseInt(mes_a_calcular2[1]) +1;
            if(calculo_mes2 < 1){
                mes_a_calcular2[1] = 12;
                parseInt(mes_a_calcular2[0])+1;
            }
            if(calculo_mes2 < 10){var mes2 = "0"+calculo_mes2;}else{mes2 = $calculo_mes2}
            calculo_desde2 = mes_a_calcular2[0]+'-'+mes2+'-'+mes_a_calcular2[2];
            cargar_data(calculo_desde2);
        });*/
    });
</script>
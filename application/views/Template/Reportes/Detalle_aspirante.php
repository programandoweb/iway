<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<div class="container text-center" id="pagado">
</div>
<div class="container" id="factura">
	<div class="row justify-content-md-center">
    	<div class="col">
            <div id="imprimeme">
                <div class="section__">
                    <div class="row ">
                        <div class="col-md-2">
                           Cliente
                        </div>
                        <div class="col-md-4">
                            <b>
                            </b>
                        </div>
                        <div class="col-md-3 ">
                        </div>
                        <div class="col-md-3 text-right">
                            <b>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                           Dirección
                        </div>
                        <div class="col-md-4">
                            <b>
                            </b>
                        </div>
                        <div class="col-md-3 ">
                           Ciclo de producción
                        </div>
                        <div class="col-md-3 text-right">
                            <b>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                           País
                           <br />
                           ID Cliente
                        </div>
                        <div class="col-md-4 ">
                            <b>
                            </b>
                            <br />
                            <b>
                            </b>
                        </div>
                        <div class="col-md-3 ">
                           Expedida
                           <br />
                           Vence
                        </div>
                        <div class="col-md-3 text-right">
                            <b>
                            </b>
                            <br />
                            <b>
                            </b>
                        </div>
                    </div>
                </div> 
                <div class="section">           
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="bd-example bd-example-tabs" role="tabpanel">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="false">Detalle Factura</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="procesador-tab" data-toggle="tab" href="#procesador" role="tab" aria-controls="procesador" aria-expanded="true">Procesador(es)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="registrocontable-tab" data-toggle="tab" href="#registrocontable" role="tab" aria-controls="registrocontable" aria-expanded="true">Registro Contable</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="relacionpagos-tab" data-toggle="tab" href="#relacionpagos" role="tab" aria-controls="relacionpagos" aria-expanded="true">Relación Pago</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab" aria-controls="movimientos" aria-expanded="true">Movimientos</a>
                                    </li>   
                                    <li class="nav-item">
                                        <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">Observaciones</a>
                                    </li>                            
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="false">
                                    <h1>Home</h1>                      
                                    </div>
                                    <div class="tab-pane fade" id="procesador" role="tabpanel" aria-labelledby="procesador-tab" aria-expanded="true">
                                    <h1>Procesador</h1>
                                    </div>
                                    <div class="tab-pane fade" id="registrocontable" role="tabpanel" aria-labelledby="registrocontable-tab" aria-expanded="true">  
                                    <h1>Registro Contable</h1>                            	
                                    </div>
                                    <div class="tab-pane fade" id="relacionpagos" role="tabpanel" aria-labelledby="relacionpagos-tab" aria-expanded="true">
                                    <h1>Relacion de pagos</h1>                       	
                                    </div>
                                    <div class="tab-pane fade" id="movimientos" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
                                    </div>
                                    <div class="tab-pane fade" id="observaciones" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
                                        <div class="col-md-12">
                                            <div style=" width:100%; height:20px;"></div>
                                            <?php 
                                           		HtmlObservaciones();
                                            ?>
                                        </div>
                                        <?php #echo Observaciones(current_url()); ?>
                                    </div>
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
		if($("#next").length>0){
			$('.pageright').remove();
		}
		if($(".registro_contable").length>0){
			$('[title="Anular Pagos"]').remove();
		}
		if($("#nuevo_estatus").val()=='Pagada'){
			//$("#pagado").html('<h2 class="font-weight-700 text-uppercase orange">PAGADO</h2>');
			$(".inbox").remove();
			$(".anular").remove();
			$(".confirm").remove();				
		}
		if($("#nuevo_estatus").val()=='Anulada'){
			//$("#pagado").html('<h2 class="font-weight-700 text-uppercase orange">ANULADA</h2>');
			//$("#navbarNavDropdown").remove();
			$(".inbox").remove();
			$(".anular").remove();
			$(".confirm").remove();	
			$("#excel").remove();	
		}
	});
</script>
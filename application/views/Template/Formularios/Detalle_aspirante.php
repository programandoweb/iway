<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo         =   $this->ModuloActivo;
$row            =   $this->$modulo->result;
$json = @json_decode($row[0]->data);
?>
<div class="container text-center" id="pagado">
</div>
<div class="container" id="factura">
	<div class="row justify-content-md-center">
    	<div class="col">
            <div id="imprimeme">
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <h3>Información Aspirante</h3>
                    </div>
                </div>
                <div class="section">           
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="bd-example bd-example-tabs" role="tabpanel">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="false">Informacion aspirante</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">Observaciones</a>
                                    </li>                            
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab">
                                        <?php
                                            if(!empty($json)){
                                        ?>
                                        <div class="row form-group">                    
                                            <div class="col-md-4 offset-md-2 text-right">   
                                                <div class="containerrounded">
                                                    <?php echo verArchivo('images/uploads/aspirante/'.intval($this->user->centro_de_costos).'/'.$row[0]->consecutivo); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <table>
                                                     <thead>
                                                         <tr>
                                                             <th class="text-center" colspan="2"><strong><?php echo @$json->Nombre; ?></strong></th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>
                                                         <tr>
                                                             <td width="50%">Consecutivo :</td>
                                                             <td>
                                                                <b>
                                                                    <?php echo centrodecostos($row[0]->centro_de_costos)->abreviacion.' '.' '.tipo_documento(49,true).' '.ceros($row[0]->consecutivo); ?>
                                                                </b>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                             <td>Sede :</td>
                                                             <td>
                                                                <?php echo @$json->Sede; ?>       
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td>Fecha :</td>
                                                             <td>
                                                                 <b>
                                                                    <?php echo @$json->Fecha; ?></b>
                                                                     
                                                                 </b>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td>Hora :</td>
                                                             <td><b><?php echo @$json->hora ?> : <?php echo @$json->minutos; ?> <?php echo @$json->meridiano; ?></td>
                                                         </tr>
                                                         <tr>
                                                             <td>Edad :</td>
                                                             <td><?php echo @$json->Edad; ?></td>
                                                         </tr>
                                                         <tr>
                                                             <td>Telefono :</td>
                                                             <td><?php echo @$json->Telefono; ?></td>
                                                         </tr>

                                                         <tr>
                                                             <td>Experiencia :</td>
                                                             <td><?php echo @$json->experiencia; ?></td>
                                                         </tr>

                                                        
                                                     </tbody>
                                                 </table> 
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>                      
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
<?php

$modulo		=	$this->ModuloActivo;
//pre($this->$modulo->result);
?>
<div class="container">
        <div class="row justify-content-md-center">
              <div class="col">
                   <?php 
				   echo TaskBar(array("name"		=>	array(	"title"	=>"Forma de pago.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Preferencias",
															"url"	=>	base_url($this->uri->segment(1)."/addFormaPago"),
															"lightbox"=>true),						
							)
						);
			         ?>
                <ul class="nav nav-tabs" role="tablist"> 
                 <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#activo" role="tab">
                     Activo
                   </a>
                 </li>
               <li class="nav-item">
                 <a class="nav-link" data-toggle="tab" href="#inactivo" role="tab">
                   Inactivo
                </a>
             </li> 
             </ul>
			 <div class="justify-content-md-center tab-content" id="imprimeme">
        <div id="activo" class="tab-pane active col-md-12" role="tabpanel">
            <div class="row">
                <div class=" col-md-12">
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
                               
                            	
                                <th class="text-center" ><b>Forma de pago</b></th>
                                <th class="text-center"><b>Dias de pago</b></th>
                                <th  class="text-center"><b>Acciones</b></th>
							</tr>
						</thead>
						<tbody>
                        	<?php 
								if(@count(@$this->$modulo->result['Activos'])>0){
							  		foreach(@$this->$modulo->result['Activos'] as $v){?>
                                     <!-- <?php pre($v)?>-->
                                    <tr>
                                         
                                            <td class="text-center">
                                             <?php echo   @$v->forma_pago ?>
                                            </td> 
                                            <td class="text-center">
                                            <?php echo   @$v->dias_pago ?>
                                            </td class="text-center">
                                           
                                            <td class="text-center" style="vertical-align:middle;">
                                            <a class="lightbox" title="Editar forma de pago" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/addFormaPago"."/".$v->id."/Activos")?>">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </a> 
                                              
                                                <a class="" title="Inactivar forma de pago" href="<?php echo base_url("")?>">
                                                	<i class="fas fa-toggle-on"></i>
												</a>                                              
                                            </td>
                                        </tr>	
                            <?php 	}
								}
							?>						
						</tbody>
					</table>
                </div>
            </div>
        </div>
        <div id="inactivo" class="tab-pane col-md-12" role="tabpanel">
            <div class="row">
                <div class=" col-md-12">
                    <table class="ordenar display table table-hover">
                        <thead>
                            <tr>
                                <th w class="text-center"><b>Forma de pago</b></th>
                                <th class="text-center"><b>Dias de pago</b></th>
                                <th class="text-center"><b>Acción</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(@count(@$this->$modulo->result['Inactivos'])>0){
                                    foreach(@$this->$modulo->result['Inactivos'] as $v){?>
                                        <tr>
                                          <td>
                                            <?php echo   @$v->forma_pago ?>
                                            </td>
                                            <td>
                                            <?php echo   @$v->dias_pago ?>
                                            </td>
                                            
                                            <td class="text-center" style="vertical-align:middle;">
                                            <a class="lightbox" title="Editar forma de pago" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/addFormaPago"."/".$v->id."/Inactivos")?>">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </a> 
                                              
                                                <a class="" title="Inactivar forma de pago" href="<?php echo base_url("")?>">
                                                	<i class="fas fa-toggle-on"></i>
												</a>    
                                                   
                                            </td>
                                        </tr>   
                            <?php   }
                                }
                            ?>                      
                        </tbody>
                    </table>
                </div>
            </div> 
			  
			  
		</div>
	</div>
 </div> 
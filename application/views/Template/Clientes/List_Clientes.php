<?php

$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Clientes.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar Cliente",
															"url"	=>	base_url($this->uri->segment(1)."/Add_Cliente"),
															"lightbox"=>true),						
							)
						);
			?>
        	<div class="row">
            	<div class="col-md-12">                
                	<table class="ordenar display table tablesorter">
                        <thead>
                            <tr>
                                <th width="100">
                                    No
                                </th>            
                            	<th>
                                	Empresa
                                </th>
                                <th>
                                	Persona Contacto
                                </th>
                                <th>
                                	Telefono
                                </th>
                                <th>
                                	Email
                                </th>
                                <th width="50">
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(@count($this->$modulo->result)>0){
                                     $No =0;
                                    foreach($this->$modulo->result as $v){     
                                        
							?>
                            <tr>
                                <td>
                                    <?php echo ($v->id); ?>
                                </td>
                                <td>
                                	<?php echo ($v->empresa); ?>
                                </td>
                                <td>
                                    <?php  echo ($v->persona_contacto); ?>
                                </td>
                                <td>
                                    <?php  echo ($v->telefono); ?>
                                </td>
                                <td>
                                    <?php  echo ($v->email); ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a class=" lightbox" title="Editar Cliente" data-type="iframe" href="<?php echo base_url("Clientes/Up_Cliente/".$v->id)?>">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a class=" lightbox" title="Ver Observaciones de <?php echo ($v->empresa); ?>" data-type="iframe" href="<?php echo base_url("Clientes/VerObservacion/".$v->id)?>">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a class=" lightbox" title="Agregar Observacion" data-type="iframe" href="<?php echo base_url("Clientes/AddInsidencia/".$v->id)?>">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
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
                    </table>
                    <div class="container">
                        <?php 
                            /*echo $this->pagination->create_links();*/
                        ?>
                    </div>
					<?php	#echo (isset($this->Listado))?$this->Listado:''; ?>
                </div>
            </div>
        </div>
    </div>
</div>

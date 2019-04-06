<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">Clientes. (<?php echo count($this->$modulo->result);?>)</h4>
                </div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-primary btn-md lightbox" title="Agregar Cliente" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/Add_Cliente")?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">                
                	<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                        <thead>
                            <tr>
                                <th>
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
                                <th>
                                    Ciudad
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($this->$modulo->result)>0){
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
                                        <a class="btn btn-secondary lightbox" title="Editar Cliente" data-type="iframe" href="<?php echo base_url("Clientes/Up_Cliente/".$v->id)?>">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-secondary lightbox" title="Ver Observaciones de <?php echo ($v->empresa); ?>" data-type="iframe" href="<?php echo base_url("Clientes/VerObservacion/".$v->id)?>">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-secondary lightbox" title="Agregar Observacion" data-type="iframe" href="<?php echo base_url("Clientes/AddInsidencia/".$v->id)?>">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
									}
                                }else{
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No hay registros disponibles
                                    </td>
                                </tr>
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

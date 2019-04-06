<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">Escala de Pagos.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<?php if(!empty($this->user->id_empresa)){?>
                	<a class="btn btn-primary btn-md lightbox" title="Agregar Escala de pagos" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/Add_Escala")?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
					<?php }?>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
                
                	<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                        <thead>
                            <tr>
                            	<th>
                                	Nombre
                                </th>
                                <th>
                                	Meta
                                </th>
                                <th>
                                	Estado
                                </th>
                                <th>
                                	Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($this->$modulo->result)>0){
                                    foreach($this->$modulo->result as $v){
							?>
                            <tr>
                            	<td>
                                	<?php echo $v->nombre_escala;?>
                                </td>
                                <td>
                                	<?php echo format($v->meta,false);?>
                                </td>
                                <td>
                                	<?php
										//pre($v);
										$variable	=	"CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END";
										echo $v->$variable;
									?>
                                </td>
                                <td width="100">
                                	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    	<a class="btn btn-secondary lightbox" title="Editar Escala de Pagos" data-type="iframe" href="<?php echo base_url("Ventas/Add_Escala/".$v->id_escala)?>">
                                        	<i class="fa fa-pencil" aria-hidden="true"></i>
										</a>
									</div>
                                </td>
                            </tr>
                            <?php
									}
                                }else{
                            ?>
                                <tr>
                                    <td colspan="4" class="text-center">
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
                            echo $this->pagination->create_links();
                        ?>
                    </div>
					<?php	#echo (isset($this->Listado))?$this->Listado:''; ?>
                </div>
            </div>
        </div>
    </div>
</div>

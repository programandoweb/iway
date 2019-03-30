<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
	
	Agregar
	<i class="fa fa-plus" aria-hidden="true"></i>
	Ver
	<i class="fa fa-search" aria-hidden="true"></i>
	Editar
	<i class="fas fa-edit" aria-hidden="true"></i>
*/?>
<?php $modulo		=	$this->ModuloActivo; ?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
	        <?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Presupuesto.",
															"icono"=>'<i class="fab fa-cc-visa"></i>',
															"url"	=>	current_url()),
									"pdf"		=>	true,
                                    "excel"     =>  true,
                                    "mail"      =>  array(  "id"    =>  "mail" ),
						
							)
						);
			?>
        <div class="row">
        	<div class="col-md-12">
                <div style="height: 40px;"></div>                      	  
				<div class="tab-pane" id="Totalizado" role="tabpanel">
                    <?php
                        $modulo		=	$this->ModuloActivo;
                    ?>
                    <table class="display table table-hover">
                        <thead>
                            <tr>
                                <th><b>Tipo de Gasto</b></th>
                                <th class="text-center"><b>Concepto Gasto</b></th>
                                <th class="text-center"><b>Observación</b></th>
                                <th class="text-right" width="120"><b>Valor</b></th>
                            </tr>
                        </thead>
                        <tbody>
                                

                            <?php
                                $Total=0;
                                if(count($this->$modulo->result)>0){
                                    foreach($this->$modulo->result as $v){
                            ?>
                                        <tr>
                                            <td>
                                                <?php echo($v->tipo_gasto); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo($v->concepto_gasto); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo($v->observacion); ?>
                                            </td>
                                            <td class="text-right">
                                                <?php 
                                                $Total+=$v->valor;
                                                echo format($v->valor,true);
                                                //set_input_dinamico("valor",$v,null,false,"input_dinamico"); ?>                                   	
                                            </td>	
                                        </tr>
                            <?php		
                                    }
                                }else{
                            ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center;">
                                                No se encontraron registros
                                            </td>
                                        </tr>
                            <?php		
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td ></td>
                                <td ></td>
                                <td class="text-center"><b>Total</b></td>                               
                                <td class="text-right"><b><?php echo format($Total); ?></b></td>
                            </tr>
                        </tfoot>
                    </table>
                 </div>
			</div>                
        </div>
    </div>
</div>



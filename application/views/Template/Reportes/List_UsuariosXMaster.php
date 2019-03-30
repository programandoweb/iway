<?php
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters submenu">
            	<div class="col-md-12">
                    <?php 
                        echo TaskBar(array("name"       =>  array(  "title" =>  "Usuarios X Master",
                                                                    "icono" =>  '<i class="fas fa-users"></i>',
                                                                    "url"   =>  current_url()),
                                                                    "pdf"   =>  true,
                                                                    "excel" =>  true,
                                                                    "mail"      =>  array(  "id"    =>  "mail" ),
                                    )
                                );
                    ?>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item" aria-expanded="false">Activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="item3-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item" aria-expanded="false">Inactivos</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div role="tabpanel" class="tab-pane fade active show" id="item1" aria-labelledby="item-tab" aria-expanded="false">  
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
                            <?php
                                $total_tokens=0;
                                $total_dolares=0;
                                $total_pesos=0;
                                if(count($this->$modulo->result)>0){
                                    foreach($this->$modulo->result as$k => $v){
                                        if(($k % 2) == 0){
                                            $fondo = 'oscuro';
                                        }else{
                                            $fondo = 'claro';
                                        }
                                        
                                        $ListMaster=get_ListMaster($v->id_plataforma,1);
                                        if(!empty($ListMaster)){
                            ?> 
                					<table class="display table table-hover">
                                        <?php if($k == 0){ ?>
                						<thead>
                                            <tr>
                                                <th>
                                                    Plataforma
                                                </th>
                                                <th>
                                                    Cta
                                                </th>
                                                <th>
                                                    Master
                                                </th>
                                                <th class="text-center">
                                                    Usuario/Modelo
                                                </th>
                                            </tr>
                						</thead>
                                        <?php } ?>
                						<tbody>   
                                        <?php 
                                            foreach($ListMaster as $k2 => $v2){
                                                $Nickname   =   get_Nickname($v->id_plataforma,$v2->rel_plataforma_id,1);
                                                $Cuenta     =   get_Cuenta($v2->cuenta_id);
                                        ?>
                                            <tr class="claro">
                                                <td width="100"><b><?php print_r($v->primer_nombre);?></b></td>
                                                <td width="70">
                                                    <?php echo substr($Cuenta->nro_cuenta,-4,4); ?>      
                                                </td>
                                                <td width="110"><?php echo $v2->nombre_master; ?></td>
                                                <td>
                                            <?php 
                                                foreach($Nickname as $v3){
                                                    if($v3->estado == 1){
                                            ?>
                                                    <div class="row">
                                                        <div class="col-md-6"> 
                                                            <?php print_r($v3->nickname);?>
                                                        </div>
                                                        <div class="col-md-6"> 
                                                            <?php print_r(nombre($v3));?>
                                                        </div>
                                                    </div>
                                                <?php
                                                        }
                                                    } 
                                                ?>
                                                    </td>
                                                </tr>
                                <?php 
                                                } 
                                            }
                                        }
                                    } 
                                ?>
    						</tbody>
    					</table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="item2" aria-labelledby="item-tab" aria-expanded="false">
                    <?php
                        $suma_token         =   0;
                        $suma_equivalencia  =   0;
                    ?>
                            <?php
                                $total_tokens=0;
                                $total_dolares=0;
                                $total_pesos=0;
                                if(count($this->$modulo->result)>0){
                                    foreach($this->$modulo->result as$k => $v){
                                        if(($k % 2) == 0){
                                            $fondo = 'oscuro';
                                        }else{
                                            $fondo = 'claro';
                                        }
                                        
                                        $ListMaster=get_ListMaster($v->id_plataforma,0);
                                        if(!empty($ListMaster)){
                            ?> 
                                    <table class="display table table-hover">
                                        <?php if($k == 0){ ?>
                                        <thead>
                                            <tr>
                                                <th>
                                                    Plataforma
                                                </th>
                                                <th>
                                                    Cta
                                                </th>
                                                <th>
                                                    Master
                                                </th>
                                                <th class="text-center">
                                                    Usuario/Modelo
                                                </th>
                                            </tr>
                                        </thead>
                                        <?php } ?>
                                        <tbody>   
                                        <?php 
                                            foreach($ListMaster as $k2 => $v2){
                                                $Nickname   =   get_Nickname($v->id_plataforma,$v2->rel_plataforma_id,0);
                                                $Cuenta     =   get_Cuenta($v2->cuenta_id);
                                        ?>
                                            <tr class="claro">
                                                <td width="100"><b><?php print_r($v->primer_nombre);?></b></td>
                                                <td width="70">
                                                    <?php echo substr($Cuenta->nro_cuenta,-4,4); ?>      
                                                </td>
                                                <td width="110"><?php echo $v2->nombre_master; ?></td>
                                                <td>
                                            <?php 
                                                foreach($Nickname as $v3){
                                                    if($v3->estado == 0){
                                            ?>
                                                    <div class="row">
                                                        <div class="col-md-6"> 
                                                            <?php print_r($v3->nickname);?>
                                                        </div>
                                                        <div class="col-md-6"> 
                                                            <?php print_r(nombre($v3));?>
                                                        </div>
                                                    </div>
                                                <?php
                                                        }
                                                    } 
                                                ?>
                                                    </td>
                                                </tr>
                                <?php 
                                                } 
                                            }
                                        }
                                    } 
                                ?>
                            </tbody>
                        </table>
                    </div> 
					<div class="container">
						<?php 
							echo $this->pagination->create_links();
						?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		<?php if(@$regresar== true && $this->uri->segment(4)==3){?>
			$("#back").attr("href","<?php echo base_url("Reportes/ResultadoImport/Debug/2");?>");	
			$("#back").html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> Completar para Culminar');
		<?php }?>
	});
</script>
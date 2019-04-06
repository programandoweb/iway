<?php
	//print_r($this->Profesiones);
	$colums		=	'';
	$colums		.=	'<tr>';
	$count		=	0;
	$modulo		=	$this->ModuloActivo;
    $ciclo		=	$this->$modulo->fields;
  
    
	if($this->uri->segment(2)=='FormasPagos' ||$this->uri->segment(2)=='AddDescuentos' || $this->uri->segment(2)=='Add_ActualizarEscala' || $this->uri->segment(2)=='AddSeguridadSocial'){
		return;	
	}
	foreach($ciclo as $v){
		if($v=='Acción'){
			$colums		.=	'<th width="20" class="text-center">';	
		}else{
			$colums		.=	'<th  width="20" class="text-center">';	
		}
		$colums		.=		$v;
		
		$colums		.=	'</th>';	
		$count++;
	}
	$colums		.=	'</tr>';
?>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#activos" role="tab" style="margin:0px,padding:0px">
            <i class="fas fa-angle-right"></i> Activos 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#inactivos" role="tab">
           <i class="fas fa-angle-right"></i>  Inactivos 
        </a>
    </li>
</ul>
<div class="tab-content row">
    <div class="tab-pane active col-md-12" id="activos" role="tabpanel">
        <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol="0" order="asc">
            <thead>
                <tr>
                	<?php echo $colums;?>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($this->$modulo->result[1])>0){
                        foreach($this->$modulo->result[1] as $v){
                            echo '<tr>';	
                                foreach($v as $kk=>$vv){
                                    if($kk=='edit' || $kk=="contactos" || $kk == "accion"){
                                        $class	=	'class="text-center" width="20"';	
                                    }if($kk=='nombre_legal'){
                                        $class  =   'class="text-left"';   
                                    }else{
                                        $class	=	'class="text-center"';
                                    }
                                    echo '<td '.$class.' style="vertical-align:middle;">';
                                        echo $vv;
                                    echo '</td>';
                                }
                            echo '</tr>';	
                        }
                    }else{
                ?>
                   
                <?php		
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 tab-pane" id="inactivos" role="tabpanel">
        <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
            <thead>
                <tr>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($this->$modulo->result[0])>0){
                        foreach($this->$modulo->result[0] as $v){
                            echo '<tr>';	
                                foreach($v as $kk=>$vv){
                                    if($kk=='edit' || $kk=="CASE estado WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"){
                                        $class	=	'class="text-center" width="20"';	
                                    }else{
                                        $class	=	'';
                                    }
                                    echo '<td '.$class.'>';
                                        echo $vv;
                                    echo '</td>';
                                }
                            echo '</tr>';	
                        }
                    }else{
                ?>
                   
                <?php		
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="container">
	<?php 
		echo $this->pagination->create_links();
	?>
</div>
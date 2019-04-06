<?php
	//print_r($this->Profesiones);
	$colums		=	'';
	$colums		.=	'<tr>';
	$count		=	0;
	$modulo		=	$this->ModuloActivo;
	$ciclo		=	$this->$modulo->fields;
	foreach($ciclo as $v){
		if($v!='Acción'){
			$colums		.=	'<th>';	
			$colums		.=		$v;
			
			$colums		.=	'</th>';	
			$count++;
		}
	}
	$colums		.=	'</tr>';	
?>
<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
    <thead>
        <tr>
        	<?php echo $colums;?>
        </tr>
    </thead>
    <tbody>
    	<?php
			if(count($this->$modulo->result)>0){
				foreach($this->$modulo->result as $v){
					echo '<tr>';	
						foreach($v as $kk=>$vv){
							if($kk=='edit' || $kk=="CASE estado WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"){
								$class	=	'class="text-center2" width="100"';	
							}else{
								$class	=	'';
							}
							if($kk!='edit'){
								echo '<td '.$class.'>';
									echo $vv;
								echo '</td>';
							}
						}
					echo '</tr>';	
				}
			}else{
		?>
        	<tr>
            	<td colspan="<?php echo count($ciclo);?>" class="text-center">
                	No hay registros disponibles
                </td>
            </tr>
        <?php		
			}
		?>
    </tbody>
    <tfoot>
    	<tr>
            <?php echo $colums;?>
        </tr>
    </tfoot>
</table>
<div class="container">
	<?php 
		echo $this->pagination->create_links();
	?>
</div>
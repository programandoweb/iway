<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	//pre($this->$modulo->result);return;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"><i class="fas fa-bars"></i> Dias Asistidos</h4>
                </div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-primary btn-md " href="<?php echo base_url();?>">
                    	<i class="fa fa-chevron-left" aria-hidden="true"></i> 
                        Volver
					</a>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<td><b>Modelo</b></td>                                
                                <td><b>1</b></td> 
                                <td><b>2</b></td>
                                <td><b>3</b></td> 
                                <td><b>4</b></td> 
                                <td><b>5</b></td> 
                                <td><b>6</b></td> 
                                <td><b>7</b></td> 
                                <td><b>8</b></td> 
                                <td><b>9</b></td> 
                                <td><b>10</b></td>  
                                <td><b>11</b></td> 
                                <td><b>12</b></td> 
                                <td><b>13</b></td> 
                                <td><b>14</b></td> 
                                <td><b>15</b></td>  
							</tr>
						</thead>
						<tbody>
						<?php //pre($this->$modulo->result) ?>
						 <?php foreach ($this->$modulo->result as $k => $v): ?>
						 	<tr>
								<td><?php echo $v->primer_nombre." ".$v->segundo_nombre." ".$v->primer_apellido." ".$v->segundo_apellido; ?> </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						 <?php endforeach ?>							
						</tbody>
					</table>
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

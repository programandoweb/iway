<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array('ciclos_id' => (isset($row->ciclos_id))?$row->user_id:'');
echo form_open(current_url(),array('aja' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Mes *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 
							echo MakeMes("mes",(isset($row->mes))?$row->mes:NULL,array("class"=>"form-control"));
						?>
                    </div>
				</div> 
                <?php 
					if($this->user->periodo_pagos==2){
						$semana		=	"Quicena";	
					}else if($this->user->periodo_pagos==4){
						$semana		=	"Semana";
					}	
					for($a=1;$a<=$this->user->periodo_pagos;$a++){
				?>
                	<script>
						$( function() {
							//$( "#fecha_desde<?php echo $a;?>" ).datepicker({changeMonth: true,changeYear: true, minDate: -20, maxDate: "+1M +10D" });
							$( "#fecha_desde<?php echo $a;?>" ).datepicker();
							$( "#fecha_desde<?php echo $a;?>" ).datepicker("option", "dateFormat", "yy-mm-dd" );
							$( "#fecha_desde<?php echo $a;?>" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
							
							//$( "#fecha_hasta<?php echo $a;?>" ).datepicker({changeMonth: true,changeYear: true, minDate: -20, maxDate: "+1M +10D" });
							$( "#fecha_hasta<?php echo $a;?>" ).datepicker();
							$( "#fecha_hasta<?php echo $a;?>" ).datepicker( "option", "dateFormat", "yy-mm-dd");
							$( "#fecha_hasta<?php echo $a;?>" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
							
							$( "#fecha_desde<?php echo $a;?>" ).val("<?php echo (isset($row->fecha)?$row->fecha:null);?>");
							$( "#fecha_hasta<?php echo $a;?>" ).val("<?php echo (isset($row->fecha)?$row->fecha:null);?>");
						});
					</script>
                    <div class="row form-group">                    
                        <div class="col-md-4 text-right">	
                           	<input class="form-control" type="text" value="<?php echo $semana;?> #<?php echo $a;?>" readonly="readonly" name="nombre[]"  />
                        </div>
                        <div class="col-md-4">	
                        	<input name="fecha_desde[]" value="" id="fecha_desde<?php echo $a;?>" placeholder="AAAA-MM-DD" class="form-control" require="1" type="text" readonly="readonly">
                        </div>
                        <div class="col-md-4">	
	                        <input name="fecha_hasta[]" value="" id="fecha_hasta<?php echo $a;?>" placeholder="AAAA-MM-DD" class="form-control" require="1" type="text" readonly="readonly">
                        </div>
                    </div>
                <?php }?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
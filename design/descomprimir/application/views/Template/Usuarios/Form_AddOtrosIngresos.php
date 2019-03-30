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
$hidden 	= 	array("iframe"=>"Add_Todos_Iframe");
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Funcionario *</b>
                    </div>
                    <div class="col-md-6">	
                       <?php 
							echo modelo($row, $estado = null,$extra=array("class"=>"form-control","name"=>"user_id"));
						?>
                        <input type="hidden" name="centro_de_costos" id="centro_de_costos"/>
                    </div>
				</div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Concepto *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("concepto",@$row,$placeholder='Concepto');?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Observación *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("observacion",@$row,$placeholder='Observación');?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Valor *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("valor",@$row,$placeholder='Valor');?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>¿Recurrente? *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeSiNo("recurrente",(isset($row->recurrente))?$row->recurrente:NULL,array("class"=>"form-control","id"=>"recurrente","require"=>"require"));?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>¿ciclos de pago? *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php 
							$periodo_pagos			=	get_periodo_pagos($this->user->id_empresa)->periodo_pagos;
							$date 					= 	strtotime(date("Y-m-d"));
							$mes					=	(int)(date("d")<15)?date("m"):date("m", strtotime("+1 month", $date));
							if($mes!="10" || $mes!="11" || $mes!="12"){$mes=str_replace("0","",$mes); }
							if($periodo_pagos==4){
								if(date("d")<7){
									$periodo_actual		=	2;
								}else if(date("d")>7 && date("d")<14){
									$periodo_actual		=	3;
								}else if(date("d")>14 && date("d")<21){
									$periodo_actual		=	4;
								}else{
									$periodo_actual		=	1;
								}	
							}else{
								if(date("d")<15){
									$periodo_actual		=	2;
								}else if(date("d")>15 && date("d")<30){
									$periodo_actual		=	1;
								}else{
									$periodo_actual		=	1;
								}	
							}
							$format_periodo_pago	=	format_periodo_pago($periodo_pagos,$periodo_actual,$mes);
							$periodo_new			=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
							echo $ciclo_pago		=	ciclopago($this->user->periodo_pagos,$periodo_new->mes,$periodo_new->fecha_desde);
						?>
						<input type="hidden" name="format_periodo_pago" value="<?php print_r($ciclo_pago);?>" />
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-3 text-right">	
                    	<b>Estado</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div>
                 
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
<script>
	$(document).ready(function(){
		$("#nro_cuenta").mask("9999-9999-9999-9999");
	});
</script>
<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
	if(!centro_de_costos()){
		return;
	}
?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	escala($this->user->id_escala);
$empresa    =   centrodecostos($this->user->id_empresa);
if(!empty($row)){
    if($empresa->sistema_salarial==1){
        if($this->user->periodo_pagos < 1){
            $periodo = 2;
        }else{
            $periodo = $this->user->periodo_pagos;
        }
        if($row->salario > 0){
            $salario = format($row->salario/$periodo,true);
            $sal = $row->salario/$periodo;
        }else{
            $salario = format($row->salario,true);
            $sal = $salario = $row->salario;
        }
        if($row->prima > 0){
            $porcent_prima = $row->prima/100;
        }else{
            $porcent_prima = 0;
        }
        if($row->auxilio_transporte > 0){
            $Auxilio = format($row->auxilio_transporte/$periodo,true);
            $Aux = $row->auxilio_transporte/$periodo;
        }else{
            $Auxilio = format($row->auxilio_transporte,true);
            $Aux = $row->auxilio_transporte;
        }
        $prima = format(($sal + $row->bonificacion)*$porcent_prima,true);
        $prim = $sal + $row->bonificacion;
    }else{
         if(@$row->Descuento == "valor fijo"){
            $bonif = (trm_vigente(true) - @$row->Descuento_dolar)* @$row->factor_bonificacion;
         }else{
            $bonif = (trm_vigente(true) * (1-(@$row->porcentaje_descuento_dolar / 100)))*@$row->factor_bonificacion;
         }
    }
}
$hidden 	= 	array('user_id' => (isset($row->user_id))?$row->user_id:'');
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<script>
	$( function() {
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#fecha_expedicion_documento_identidad" ).val("<?php echo (isset($row->fecha_expedicion_documento_identidad)?$row->fecha_expedicion_documento_identidad:null);?>");
		$( "#fecha_nacimiento" ).val("<?php echo (isset($row->fecha_nacimiento)?$row->fecha_nacimiento:null);?>");
		$( "#fecha_contratacion" ).val("<?php echo (isset($row->fecha_contratacion)?$row->fecha_contratacion:null);?>");
	});
</script>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Calcula tu sueldo</h3>
                    </div>
                </div>
                <div id="extra_datos">
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Escala actual *</b>
                        </div>
                        <div class="col-md-6">	
                            <div class="alert alert-info text-center" role="alert">
                                <strong><?php echo @$row->nombre_escala; ?></strong>
                            </div>
                        </div>
                    </div> 
                    <div class="row form-group">
                        <div class="col-md-6 text-right">   
                            <b>TRM Vigente *</b>
                        </div>
                        <div class="col-md-6">  
                            <div class="alert alert-info text-right" role="alert">
                                <strong><?php echo trm_vigente(); ?></strong>
                            </div>
                        </div>
                    </div>                    
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Tokens totales</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("tokens_totales",$row,$placeholder='Tokens totales',$require=true,"money text-right",array("maxlength"=>"10"));?>
                        </div>
                    </div>
                    <?php
                        if($empresa->sistema_salarial==1){
                    ?>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Básico *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("salario",@$salario,$placeholder='Basico',$require=true,"text-right",array("readonly"=>"readonly"));?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Auxilio de transporte:</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("auxilio_transporte",@$Auxilio,$placeholder='Auxilio de transporte',$require=true,"text-right",array("readonly"=>"readonly"));?>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Bonificación (aproximada): *</b>
                        </div>
                        <div class="col-md-6">	
                           <?php set_input("Bonificacion_aproximada",@$bonif,$placeholder='Bonificación',$require=true,"text-right",array("readonly"=>"readonly"));?>
                        </div>
                    </div>
                    <?php
                        if($empresa->sistema_salarial==1){
                    ?>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Prima semestral: *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("Prima_semestral",@$prima,$placeholder='Prima semestral',$require=true,"text-right",array("readonly"=>"readonly"));?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Total: *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("Total",$row,$placeholder='Total',$require=false,"text-right",array("readonly"=>"readonly"));?>
                        </div>
                    </div>
                    <?php
                        }
                    ?>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>                        
                        </div>
                    </div>                   
				</div>                    
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<?php
    if($empresa->sistema_salarial==1){
?>
    <script>
    	$(document).ready(function(){
            var porcent_prima = '<?php echo $porcent_prima; ?>';
            var salario = '<?php echo @$sal; ?>';
            var Auxilio = '<?php echo @$Aux; ?>';
            var factor_bonificacion = '<?php echo @$row->factor_bonificacion; ?>';
            var prima  = '<?php echo @$prim; ?>';
            var trm = '<?php echo trm_vigente(true); ?>';
            var meta = '<?php echo @$row->meta; ?>';
    		$('#tokens_totales').keyup(function(){
                val = circumference($(this).val());
                var result = (val - meta);
                if( result >= 1){
                    var saldo =(result*trm)*factor_bonificacion;
                    var calc_prima = (parseFloat(saldo) + parseFloat(prima))*parseFloat(porcent_prima);
                    var total = parseFloat(saldo) + parseFloat(calc_prima) + parseFloat(salario) + parseFloat(Auxilio);
                    $('#Bonificacion_aproximada').val(saldo.toFixed(2)).mask("#,##0.##", {reverse: true});
                    $('#Prima_semestral').val(calc_prima.toFixed(2)).mask("#,##0.##", {reverse: true});
                    $('#Total').val(total.toFixed(2)).mask("#,##0.##", {reverse: true});
                }
            });
    	})
    </script>
<?php
    }else{
?>
    <script>
        $(document).ready(function(){
            var bonif = '<?php echo @$bonif; ?>';
            $('#tokens_totales').keyup(function(){
                var tokens = circumference($(this).val());
                var total_bonif = parseFloat(bonif) * parseFloat(tokens);
                $('#Bonificacion_aproximada').val(total_bonif.toFixed(2)).mask("#,##0.##", {reverse: true});
            });
        })
    </script>
<?php
    }
?>

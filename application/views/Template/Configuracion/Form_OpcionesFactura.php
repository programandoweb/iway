<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$json		=	json_decode(@$row->json);
//pre($json);return;
?>
<script>
	$( function() {
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#res_fecha" ).val("<?php echo (isset($json->res_fecha)?$row->fecha_nacimiento:null);?>");
	});
</script>
<?php 


if(empty($row->resolucionFac)){
    $row = new stdClass();
    $row->resolucionFac = 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';
}
if(empty($row->piePaginaFac)){
    $row->piePaginaFac = 'Esta factura se asimila en todos sus efectos a una letra de cambio, de conformidad con el articulo 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por concepto de mora.'; 
}
if(empty($row->prefijoFacturaFac)){
   $row->prefijoFacturaFac = centrodecostos($this->user->centro_de_costos)->abreviacion;    
}
echo form_open(current_url(),array('ajaxing' => 'true'));	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre del documento </b>
                    </div>
                    <div class="col-md-6">
                    	<select class="form-control " name="nombreDocumentoFac" id="nombreDocumentoFac" require="true">
							<?php
                            	foreach(array("Factura de venta","Cuenta de Cobro") as $v){
									?>
                                    	<option value="<?php echo $v;?>" <?php if($v===@$json->nombreDocumentoFac){echo 'selected="selected"';}?> ><?php echo $v;?></option>
                                    <?php
								}
                            ?>
                        </select>
                    </div>
				</div>
                <div id="ocultar">
                    <div class="row form-group ">
                        <div class="col-md-2 text-right">
                        </div>
                        <div class="alert alert-info col-md-8 text-center" role="alert">
                            <h5 class="alert-heading">Importante:</h5>
                            <p>La presente resolución unicamente aplica a los documentos que se registren después de grabados estos cambios.</p>
                        </div>
                    </div>
                    <div class="row form-group ">
                        <div class="col-md-12 text-center">
                            <h5>Modificación Resolución DIAN</h5>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b> Número de resolución DIAN </b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("res_diam",$json,$placeholder='Número de resolución DIAN',$require=false);?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b> Fecha </b>
                        </div>
                        <div class="col-md-6">	
                             <?php set_input("res_fecha",$json,$placeholder='AAAA-MM-DD',$require=false,"datepicker");?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b> Tipo </b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("res_tipo",$json,$placeholder='Tipo',$require=false);?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b> Factura por computadores desde: </b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("fac_desde",$json,$placeholder='Factura por computadores desde',$require=false);?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b> Factura por computador hasta: </b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("fac_hasta",$json,$placeholder='Factura por computadores hasta',$require=false);?>
                        </div>
                    </div>
                </div>
				<div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Texto en pie de documento de venta:</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo form_textarea("piePaginaFac",@$json->piePaginaFac,$atrr=array("class"=>"form-control","id"=>"piePagina","maxlength"=>"270"));?>
                    </div>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">	
                        	<input type="hidden" name="selloFac" id="sello" value="<?php @$row->selloFac?>1" require="true" />
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
	var text_default	=	"Esta factura se asimila en todos sus efectos a una letra de cambio, de conformidad con el articulo 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobrarán intereses por concepto de mora.";
	var text_bd			=	"<?php echo @$json->piePaginaFac;?>";
	$(document).ready(function(){
		if($("#nombreDocumentoFac").val()=="Cuenta de Cobro"){
			var str 	= 	text_default;
			if($("#piePagina").html()){
				str 	= 	$("#piePagina").html();
			}			
			var res 	= 	str.replace("factura", "Cuenta de Cobro");			
			$("#ocultar").hide();	
			$("#piePagina").html(res);
		}
		
		$("#nombreDocumentoFac").change(function(){
			if($("#piePagina").html()){
				str 	= 	$("#piePagina").html();
			}	
			var res 	= 	"";
			if($(this).val()=="Cuenta de Cobro"){
				res 	= 	str.replace("factura","Cuenta de Cobro");
				$("#ocultar").hide();	
			}else{
				res 	= 	str.replace("Cuenta de Cobro","factura");
				$("#ocultar").show();	
			}	
			var str 	= 	text_default;
			$("#piePagina").html(res);
		})
		
		if(text_bd==''){
			$("#piePagina").html(text_default).attr("readonly","readonly");	
		}
		$("#piePagina").dblclick(function(){
			$(this).removeAttr("readonly");
		});
	});
</script>
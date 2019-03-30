<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
$row		=	getOpcionesContrato();
$json		=	json_decode(@$row->json);
//pre($json);return;
?>
<?php 
echo form_open(current_url(),array('ajax' => 'true',"redirect"=>base_url("Usuarios/Monitores")));	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Porcentaje de pago </b>
                    </div>
                    <div class="col-md-4">	
						<?php
                            set_input("porcentaje_pago",$json,$placeholder='Porcentaje de pago',$require=true);
                        ?>
                    </div>
				</div>
                 <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Descuento dolar </b>
                    </div>
                    <div class="col-md-2">  
                        <?php
                            echo MakeDescuento("descuento_dolar",@$json->descuento_dolar,array("class"=>"form-control"));
                        ?>
                    </div>
                     <div class="col-md-2"> 
                        <?php
                            set_input("valor",$json,$placeholder='Valor',$require=true);
                        ?>
                    </div>
                </div>
                
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <h5>Testigo # 01</h5>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-2 text-right">
                    </div>
	                <div class="alert alert-info col-md-8" role="alert">
                        <h5 class="alert-heading">Importante</h5>
                    	<p>La presente resolución unicamente aplica a los documentos que se registren después de grabados estos cambios.</p>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b> Nombre completo </b>
                    </div>
                    <div class="col-md-4">	
                        <?php set_input("testigo1",$json,$placeholder='Nombre completo',$require=true);?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b> Tipo de documento </b>
                    </div>
                    <div class="col-md-4">	
                         <?php echo MakeTipoIdentificacion("tipo_documento",@$json->tipo_documento,array("class"=>"form-control"));?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b> Número de documento </b>
                    </div>
                    <div class="col-md-4">	
                        <?php set_input("nro_documento",$json,$placeholder='Número de documento',$require=true);?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b> Cargo </b>
                    </div>
                    <div class="col-md-4">	
                        <?php set_input("cargo",$json,$placeholder='Cargo',$require=true);?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b> Razón social </b>
                    </div>
                    <div class="col-md-4">	
                        <?php set_input("razon_social",$json,$placeholder='Razón social',$require=true);?>
                    </div>
				</div>
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <h5>Testigo # 02</h5>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b> Nombre completo </b>
                    </div>
                    <div class="col-md-4">  
                        <?php set_input("testigo2",$json,$placeholder='Nombre completo',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b> Tipo de documento </b>
                    </div>
                    <div class="col-md-4">  
                         <?php echo MakeTipoIdentificacion("tipo_documento2",@$json->tipo_documento2,array("class"=>"form-control"));?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b> Número de documento </b>
                    </div>
                    <div class="col-md-4">  
                        <?php set_input("nro_documento2",$json,$placeholder='Número de documento',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b> Cargo </b>
                    </div>
                    <div class="col-md-4">  
                        <?php set_input("cargo2",$json,$placeholder='Cargo',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b> Razón social </b>
                    </div>
                    <div class="col-md-4">  
                        <?php set_input("razon_social2",$json,$placeholder='Razón social',$require=true);?>
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
	var text_default	=	"Esta factura se asimila en todos sus efectos a una letra de cambio, de conformidad con el articulo 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por concepto de mora.";
	var text_bd			=	"<?php echo @$json->piePaginaFac;?>";
	$(document).ready(function(){
		if(text_bd==''){
			$("#piePagina").html(text_default).attr("readonly","readonly");	
		}
		$("#piePagina").dblclick(function(){
			$(this).removeAttr("readonly");
		});
	});
</script>
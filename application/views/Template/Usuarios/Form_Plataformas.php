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
$hidden 	= 	array('type'=>$this->uri->segment(3),'iframe'=>$this->uri->segment(2),'user_id' => (isset($row->user_id))?$row->user_id:'',"redirect"=>base_url("Usuarios/Todos/".$this->uri->segment(3)));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información Básica</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre página *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("primer_nombre",$row,$placeholder='Nombre página',$require=true);?>
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Nombre Legal *</b>
                    </div>
                    <div class="col-md-6">	
                    	<?php 
							echo paginas_webcam($row);
						?>
	                    <?php #set_input("nombre_legal",$row,$placeholder='Nombre Legal',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Tipo de Página *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeTipoPagina("tipo_persona",(isset($row->tipo_persona))?$row->tipo_persona:NULL,array("class"=>"form-control","require"=>"require","id"=>"tipo_persona"));?>
                        <input type="hidden" name="moneda_de_pago" value="RSS" />
                    </div>
                </div>
                <div id="ocultar">
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Moneda de Pago *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php //echo MakeMonedaPago("moneda_de_pago",(isset($row->moneda_de_pago))?$row->moneda_de_pago:NULL,array("class"=>"form-control","require"=>"require"));?>
                            <?php echo MakeMonedaPago("moneda_de_pago",(isset($row->moneda_de_pago))?$row->moneda_de_pago:NULL,array("class"=>"form-control"));?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Equivalencia *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php echo MakeEquivalencia("",(isset($row->equivalencia))?$row->equivalencia:NULL,array("id"=>"id_equivalencia","class"=>"form-control","require"=>"require"));?>
                            <br />
                            <input type="text" class="form-control" name="equivalencia" id="equivalencia" value="<?php echo (isset($row->equivalencia))?$row->equivalencia:"";?>" readonly="readonly" />
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Dirección  *</b>
                        </div>
                        <div class="col-md-6">  
                            <?php echo set_input("direccion",$row,$placeholder='Dirección',$require=true,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Ciudad *</b>
                        </div>
                        <div class="col-md-6">  
                            <?php echo ciudad($row,"ciudad","Ciudad");?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Departamento *</b>
                        </div>
                        <div class="col-md-6">  
                            <?php echo set_input("departamento",$row,$placeholder='departamento',$require=true,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Pais *</b>
                        </div>
                        <div class="col-md-6">  
                            <?php echo set_input("pais",$row,$placeholder='pais',$require=true,"firstLetterText");?>
                        </div>
                    </div>
				</div>                     
                <div class="row form-group item">
                    <div class="col-md-6 text-right">	
                        <b>Estado del Perfil</b>
                    </div>
                    <div class="col-md-3">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
                </div> 
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
<?php echo form_close();?>
<script>
	$(document).ready(function(){
        solonumeros(".soloNumeros");
		if($("#tipo_persona").val()=='RSS'){
			$("#ocultar").hide().find("input").removeAttr("require");	
		}else{
			$("#ocultar").show().find("input#direccion").attr("require","require");	
		}
		$("#tipo_persona").change(function(){
			if($(this).val()=='RSS'){
				$("#ocultar").hide().find("input").removeAttr("require");	
			}else{
				$("#ocultar").show().find("input#direccion").attr("require","require");		
			}			
		});
	});
</script>
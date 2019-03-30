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
$row		=	$this->$modulo->result;
$hidden 	= 	array();
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información del Correo Electrónico</h3>
                    </div>
                </div>
                <div id="extra_datos">
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Correo *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("login",@$row,$placeholder='Email',$require=true);?>
                        </div>
                    </div>                    
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Dominio</b>
                        </div>
                        <?php
                        	$dominios=cpanel(true);
						?>
                        <div class="col-md-6">	
                        	<?php
								echo form_dropdown('dominio', object_to_array($dominios), @$json->dominio , array("class"=>"form-control"));
							?>	
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Es Modelo</b>
                        </div>
                        <div class="col-md-6">	
                        	<select class="form-control" name="is_model" >
								<?php 
                                    foreach(array("No","Si") as $k=> $v){
								?>
                                		<option value="<?php echo $k?>"><?php echo $v?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Password *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("password","Provisional1",$placeholder='Clave',$require=false);?>
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
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		
		
		if($("#centro_de_costos").val()==''){
			$("#extra_datos").hide();	
		}
		$("#centro_de_costos").change(function(){
			var nrooms	=	$(this).find("option:selected").data("rooms");
			$("#room_transmision").attr("data-nrooms",nrooms);
			$("#room_transmision").html("");
			for (var i=1; i<=nrooms; i++) {
				$("#room_transmision").append("<option value='"+i+"'> Room "+i+"</option>");			
			}
			$("#room_transmision").append("<option value='1000000'> Satélite</option>");
			if($("#centro_de_costos").val()==''){
				$("#extra_datos").hide();	
			}else{
				$("#extra_datos").show();	
			}
		});		
	})
</script>
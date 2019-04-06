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
$hidden 	= 	array('user_id' => (isset($row->user_id))?$row->user_id:'');
echo form_open_multipart(current_url(),array('ajaxing' => 'true'),$hidden);	?><div class="container" style="margin-bottom:70px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información de Tarea</h3>
                    </div>
                </div>
                <div id="extra_datos">
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Pantalla *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("pantalla",$row,$placeholder='Pantalla',$require=true,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Módulo *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("modulo",$row,$placeholder='Módulo',$require=true,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Sub Módulo *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("submodulo",$row,$placeholder='Sub Módulo',$require=true,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>URL *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("url",$row,$placeholder='URL',$require=true,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">   
                            <b>Prioridad *</b>
                        </div>
                        <div class="col-md-6">  
                            <?php echo MakePrioridad('prioridad', "", array('class'=>'form-control'));?>
                        </div>
                    </div>                    
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Tarea *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php echo form_textarea('descripcion', "", array('class'=>'form-control'));?>
                        </div>
                    </div>
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Tiempo Actividad *</b>
                        </div>
                        <div class="col-md-6">	
                            <?php set_input("tiempo",$row,$placeholder='Sólo en minutos',$require=true,"firstLetterText");?>
                        </div>
                    </div>
                    <div class="row form-group text-center" id="adjuntar">  
	                    <div class="col-md-6 text-right">                     
                        </div>
                        <div class="col-md-6 text-left">   
    	                    <div class="adjuntar btn btn-primary"><i class="fas fa-paperclip"></i> Adjuntar</div>
						</div>                            
                    </div>
                    <div class="row form-group item">
                        <div class="col-md-6 text-right">
                            <b>Usuarios Asignados</b>
                        </div>
                        <div class="col-md-6 text-left">   
    	                  	<select name="asignacion[]" class="form-control firstLetterText">
                                <?php
									if(count($this->$modulo->usuarios)>0){
										foreach($this->$modulo->usuarios as  $key => $v){
											
								?>			
                                			<option value="<?php print($v->user_id); ?>"><?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?></option>
								<?php       
										}
									}
								?>
                            </select>  
						</div>
                    </div>
                   <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
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
		var adjunto	=	'<div class="col-md-6 text-right"><b>Adjunto *</b></div><div class="col-md-6"><input type="file" name="userfile" /></div>';
		$(".adjuntar").click(function(){
			$("#adjuntar").html(adjunto);	
		});		
	})
</script>
<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo         =   $this->ModuloActivo;
	$pasos			=	$this->uri->segment(5,1)+1;
	$btn_adelante	=	base_url("Formularios/Examen/Examen/".$pasos);
	echo form_open($btn_adelante,array('autocomplete' => 'off'));
?>
<div class="container">
	<div class="row">
   		<div class="col">
        	<?php
				//pre($this->user->empresa);return;
            	echo TaskBar(array("name"		=>	array(	"title"	=>	"Conocimiento del aspirante. ".$this->user->empresa->nombre_legal,
															"icono"=>'<i class="fas fa-bars"></i>',
															"url"	=>	current_url()),
							)
						);
			?>
        </div> 
   	</div>
    <div class="section" style="background-color:#e9e9e9;">
        <div class="row ">
            <div class="col" style="min-height:300px;">
				<?php
					$file	=	PATH_VIEW.'/Template/Formularios/Entrevista/Examen/'.$this->uri->segment(4,1).'.php';
					if(file_exists($file)){
						$this->load->view("Template/Formularios/Entrevista/Examen/".$this->uri->segment(4,1),array("empresa",$this->user->empresa));
					}
                ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="form-group text-center">
                	<?php
                    	if($pasos>2 && $pasos<19){
							$atras=$pasos-2;
					?>
                    	<a class="btn btn-primary" href="<?php echo base_url("Formularios/Entrevista/Examen/Examen/". $atras);?>">
                            Anterior	    
                        </a>
                    <?php
						}
					?>
                    <?php
                    	if($pasos<19 && $this->uri->segment(4)!='finish'){
					?>
                        <a class="btn btn-primary continuar" href="<?php echo $btn_adelante;?>">
                            Continuar				    
                        </a>
                    <?php
						}else if($this->uri->segment(4)=='finish'){
					?>
                        <a class="btn btn-primary" href="<?php echo base_url();?>">
	                        Hasta Luego				    
                        </a>
                    <?php		
						}else{
					?>
                        <a class="btn btn-primary continuar" href="<?php echo $btn_adelante;?>">
                            Terminar
                        </a>
                    <?php		
						}
					?>
                </div>                        
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?> 
<script>
	$(document).ready(function(){
		clonar_entrevista();
		var form			=	$("form");
		var requires		=	$("[require]");
		if(requires.length>0){
			requires.each(function(index,v){
				if($(this).val()==''){
					$("a.continuar").addClass("disabled");
				}
				$(this).keyup(function(){
					if($(this).val()!=''){
						$("a.continuar").removeClass("disabled");
					}
				})
			});
		}
		var return_value	=	false;
		$("a.continuar").click(function(){
			var btn_submit	=	$(this);
			requires.each(function(index,v){
				ocultar_error($(this));	
				if($(this).val()==''){
					return_value	=	false;
					mostrar_error($(this));
					
					$(this).keyup(function(){
						ocultar_error($(this));	
						if($(this).val()!=''){
							ocultar_error($(this));	
						}else{
							mostrar_error($(this));
						}
					});
					return false;
					
				}else{
					return_value	=	true;
				}
			});
			if(return_value==true){
				form.submit();
			}
			return false;
		});
	});
	
	function mostrar_error(obj){
		var message_error	=	$('<div class="invalid-feedback fadeInDown animated ">Este dato es requerido.</div>');
		obj.focus().addClass("is-invalid").parent("div").append(message_error);
	}
	
	function ocultar_error(obj){
		obj.focus().removeClass("is-invalid").parent("div").find(".invalid-feedback").remove();
	}
	
	function clonar_entrevista(){
		var obj_clonar	=	$(".cloname");
		if(obj_clonar.length>0){
			obj_clonar.each(function(index,v){
				var btn_accion	=	$(this).find(".clonar");
				var contenedor	=	$(this);
				contenedor.find("input").each(function(index,v){
					$(this).removeAttr("id").removeAttr("require");
				})				
				var boll_clonar=false;
				btn_accion.click(function(){
					
					var inputs		=	contenedor.find("input");
					
					inputs.each(function(index,v){
						ocultar_error($(this));	
						if($(this).val()==''){
							mostrar_error($(this));
							boll_clonar=false;
							return false;	
						}
						boll_clonar=true;
					});
					if(boll_clonar==true){
						var clon	=	contenedor.find(".Opcional").clone();
										contenedor.find(".Opcional").find("input").val("");
						clon.find(".clonar").remove();
						clon.removeClass("Opcional");
						clon.find("input").attr("readonly","readonly");
						contenedor.append(clon);
					}
				});
			});
		}
	}
</script>                                        
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
$hidden 	= 	array();
echo form_open(base_url("Reportes/MakeFactura"),array('ajax' => 'true'),$hidden);?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                    	<div class="card-header" role="tab" id="headingOne">
                    		<h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                   	¿A quién facturo?
                                </a>
                    		</h5>
                		</div>
                		<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                			<div class="card-block">
								<?php 
                                	echo paginas_webcam(@$row,$estado = null,$extra=array("class"=>"form-control"),'subfuncion');
                                ?>
                			</div>
                		</div>
                	</div>
                	<div class="card">
                		<div class="card-header" role="tab" id="headingTwo">
                			<h5 class="mb-0">
                				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                					Detalle facturación
                				</a>
                			</h5>
                		</div>
                		<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                			<div class="card-block" id="contenedor_ajax">
               					Empty
                			</div>
                            <div class="text-center" id="btn-generar">
	                            <button type="submit" class="btn btn-primary btn-md"> Generar</button>
                            </div>
                		</div>
                	</div>
                </div>                  
			</div>
        </div>
    </div>
    <input type="hidden" id="direccion" name="direccion" require="require" />
    <input type="hidden" id="pais" name="pais" require="require" />
    <input type="hidden" id="identificacion_empresa" name="identificacion_empresa" require="require" />
    
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		$("#nombre_legal").click(function(){
			console.log($(this).val());
		});
	});
	function subfuncion(){
		$.post("<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/Ajax')?>",{nombre_legal:$("#nombre_legal").val()},function(data){
			$('#collapseOne').collapse('hide');
			$('#collapseTwo').collapse('show');
			$("#contenedor_ajax").html(data);
			console.log($("#total_dolares").val())
			if($("#total_dolares").val()=='' || $("#total_dolares").val()=='0.00' || $("#total_dolares").val()=='0,00' || $("#total_dolares").val()==0){
				$("#btn-generar").hide();
			}
			$("#nombre_legal").attr('name', 'nombre_cliente');
		});
	}
</script>
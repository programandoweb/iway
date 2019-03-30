<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;

echo form_open(current_url(),array('ajaxing' => 'true'));	
$row		=	$this->$modulo->result;
$extra		=	array("class"=>"form-control money","id"=>"porcentaje_retencion","maxlength"=>5);
if(@$row->porcentaje_retencion==0){
	$extra['readonly']	=	'readonly';	
}
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-6 text-left">	
                    	<b>Practicar Retención </b>
                    </div>
                    <div class="col-md-2">	
                       	<?php 
							if(@$row->porcentaje_retencion>0){
								$estado=1;	
							}else{
								$estado=0;	
							}
							echo MakeSiNo("retencion",$estado,array("class"=>"form-control","id"=>"retencion"));
						?> 
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-left">	
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("porcentaje_retencion",$row,$placeholder='%',$require=false,"firstLetterText",$extra);?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-left">	
                    	<b>Ajustar a la decena </b>
                    </div>
                    <div class="col-md-3">	
                       	<?php 
							echo MakeSelect("ajustar_decena",@$row->ajustar_decena,array("class"=>"form-control","id"=>"ajustar_decena","require"=>"true"),array("1"=>"Si"));
						?> 
                    </div>
				</div>
				<div class="row form-group">
	                <div class="col-md-6 text-left">	
                    	<b>Valor TRM </b>
                    </div>
                    <div class="col-md-3">	
                       	<?php 
                       		echo MakeSelect("Tipo_valor",@$row->Tipo_Valor,array("class"=>"form-control","id"=>"Tipo_valor"),array("Automático"=>"Automático","Manual"=>"Manual"));
						?> 
                    </div>
				</div>
                <div class="row form-group" id="TRM" style="display: none;">
	                <div class="col-md-6 text-left">	
                    	<b>Valor </b>
                    </div>
                    <div class="col-md-3">	
	                    <?php set_input("Valor_trm",$row,"Valor TRM",$require=false,"firstLetterText money",null,true);?>
                    </div>
				</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" >Agregar</button>
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
		var select_retencion	=	$("#retencion");
		var value_default		=	$("#porcentaje_retencion").val();
		var trm 				=   '<?php echo trm_vigente(true); ?>';
		//select_retencion.removeAttr("name");
		console.log(trm);
		var tipo_valor = $('#Tipo_valor option:selected').val();
		if(tipo_valor == "Manual"){
			$('#TRM').show();
		}
		$('#Tipo_valor').change(function(){
			if($(this).val() == "Manual"){
				$('#TRM').show();
			}else{
				$('#TRM').hide();
				$('input[name="Valor_trm"]').val(trm);
			}
		});
		if(select_retencion.val()==1){
			$("#porcentaje_retencion").removeAttr("readonly");
			$("#porcentaje_retencion").attr("require","true");
		}
		select_retencion.change(function(){
			if(select_retencion.val()==1){
				$("#porcentaje_retencion").removeAttr("readonly");
				$("#porcentaje_retencion").attr("require","true").val(value_default);
			}else{
				$("#porcentaje_retencion").removeAttr("require");
				$("#porcentaje_retencion").attr("readonly","readonly").val(0);				
			}	
		});
	});
</script>
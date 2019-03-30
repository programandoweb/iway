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
$hidden 	= 	array("iframe"=>"Add_Todos_Iframe","user_id"=>$this->uri->segment(3),'type' => (isset($row->type))?$row->type:'');
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>EPS *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeEPS("eps",@$row->eps,array("class"=>"form-control","require"=>"require"),$this->Usuarios->get_eps());?>
                    </div>
				</div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>ARL</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("arl",@$row,$placeholder='ARL');?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Caja Comp.</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("caja_de_compensacion",@$row,$placeholder='Caja Comp');?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Fondo de Pensión.</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("pension",@$row,$placeholder='Fondo de Pensión');?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 text-right">	
                    	<b>Fondo de Cesantías.</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("cesantias",@$row,$placeholder='Fondo de Cesantías');?>
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
		$(".item_plataforma").hide();
		if($("#id_plataforma").val()=='00000000156' || $("#id_plataforma").val()=='00000000155' || $("#id_plataforma").val()==''){
			$("#contenedor_master").hide();	
		}else{
			$("#contenedor_master").show();	
		}
		$("#id_plataforma").change(function(){
			$(".item_plataforma").hide();
			var valor 	= 	parseInt($(this).val());
			
			$("."+valor).show()
			if($("#id_plataforma").val()=='00000000156' || $("#id_plataforma").val()=='00000000155' || $("#id_plataforma").val()==''){
				$("#contenedor_master").hide();	
			}else{
				$("#contenedor_master").show();	
			}
		});
	});
</script>
<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
?>
<div class="row">
   <div class="form col-md-12">
        <div class="form-group item">
             <h3><b>Información familiar.</b></h3>
        </div>    
   </div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>Nombre de tu esposo (a) o compañero (a)</b>
   </div>
   <div class="col-md-4">
        <?php set_input("NombrePareja",@$row,$placeholder="Nombre de Esposo (a) o compañero",$require=false,"form-control");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>Profesión, ocupación u oficio.</b>
   </div>
   <div class="col-md-4">
        <?php set_input("Profesión",@$row,$placeholder="Profesión",$require=true,"form-control");?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group">
   <div class="col-md-4"><b>Teléfono</b></div>
   <div class="col-md-2">
        <?php set_input("TelPareja",@$row,$placeholder="#",$require=true,"form-control salto",array("maxlength"=>"3","data-salto"=>"IndP2")); ?>
   </div>
   <div class="col-md-2">
        <?php set_input("IndP2",@$row,$placeholder="#",$require=true,"form-control salto",array("maxlength"=>"3","data-salto"=>"NumP")); ?>
   </div>
   <div class="col-md-4">
        <?php set_input("NumP",@$row,$placeholder="#",$require=true,"form-control salto",array("maxlength"=>"4","data-salto"=>"end")); ?>
   </div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b>¿Número de personas que dependen económicamente de ti?</b>
   </div>
   <div class="col-md-4">
        <?php set_input("PersonasACargo",@$row,$placeholder="# de Personas a cargo",$require=false,"form-control salto",array("maxlength"=>"2")); ?>
   </div>
   <div class="col-md-4"></div>
</div>
<div class="row form-group ">
   <div class="col-md-4">
        <b class="pregunta">Vives en casa</b>
   </div>
   <div class="col-md-2 text-center">
        <h6>Propia</h6>
        <?php set_input_radio("ViveEnCasa","","Propia",(@$row['ViveEnCasa']=="Propia")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-2 text-center">                    
        <h6>Familiar</h6>
        <?php set_input_radio("ViveEnCasa","","Familiar",(@$row['ViveEnCasa']=="Familiar")?true:false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-2 text-center">
        <h6>Arrendada</h6>
        <?php set_input_radio("ViveEnCasa","","Arrendada",(@$row['ViveEnCasa']=="Arrendada")?true:false,"custom-control-input",""); ?>
   </div>
</div>
<div class="row form-group">
   <div class="col-md-4">
        <b class="pregunta">¿Tienes hijos? </b>
   </div> 
   <div class="col-md-2 text-center">
   		<h6>Si</h6>
		<?php echo set_input_radio("Hijos","","Si",(@$row['Hijos']=="Si")?true:false,"custom-control-input Mostrar",""); ?> 
	</div>
	<div class="col-md-2 text-center">
   		<h6>No</h6>
   		<?php echo set_input_radio("Hijos","","No",(@$row['Hijos']=="No")?true:false,"custom-control-input Mostrar",""); ?> 
   </div>
</div>
<div class="row form-group col-md-12 Opcional">
   <div class="col-md-10">
        <b>Si tu respuesta anterior fue SI, por favor escribe su informacion.</b>
   </div>
</div>
<div class="cloname">
    <div class="row form-group col-md-12 Opcional hijos_">
       	<div class="col-md-5">
            <?php set_input("hijo[]",@$row,$placeholder="Nombre Completo",$require=false); ?>
        </div>
        <div class="col-md-5">
            <?php set_input("edad[]",@$row,$placeholder="Edad",$require=false); ?>
        </div>
        <div class="col-md-2">
        	<div class=" btn btn-primary clonar">
	            <i class="fa fa-plus"></i>
            </div>
        </div>
    </div>
    <?php 
		if(isset($row['edad'])){
			foreach($row['edad'] as $k => $v){
				if($v>0){
	?>
                    <div class="row form-group col-md-12 listado_no_ajax">
                        <div class="col-md-5">
                            <?php set_input("hijo[]",@$row['hijo'][$k],$placeholder="Nombre Completo",$require=false,NULL,array("readonly"=>"readonly")); ?>
                        </div>
                        <div class="col-md-5">
                            <?php set_input("edad[]",@$row['edad'][$k],$placeholder="Edad",$require=false,"form-control salto",array("readonly"=>"readonly","maxlength"=>"2")); ?>
                        </div> 
                        <div class="col-md-2">
                            <div class=" btn btn-primary trash">
                                <i class="fa fa-trash"></i>
                            </div>
                        </div>   
                    </div>
    <?php 
				}
			}
		}
	?>
</div>
<script>
	$(document).ready(function() {
    solonumeros(".salto");
		$('.hijos_').hide();
		$(".clonado").attr("type","text").removeAttr("id");
		$('input').click(function(){
			$("a.continuar").removeClass("disabled").click(function(){$("form").submit();});
		});
		$("a.continuar").click(function(){$("form").submit();});   
		$(".clonar").click(function(){
			$(".clonado").attr("type","text");
		});
		$(".trash").click(function(){
			$(this).parent("div").parent(".listado_no_ajax").remove();
		})
		<?php echo (@$row['Hijos']=='Si')?"$('.hijos_').show();":""?>
    <?php echo (@$row['Hijos']=="No")?"$('.Opcional').hide();":""?>
    $('.Mostrar').click(function(){
      if($(this).val()=="Si"){
        $('.Opcional').slideDown(1000);
        $('.Opcional').find('input').attr('require', 1);
        $("a.continuar").removeClass("disabled");//.click(function(){$("form").submit();});
      }else{
        $('.Opcional').slideUp(1000);
        $('.Opcional').find('input').removeAttr('require');
      }
    });
	});
</script>
<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
?>
	<script>
	  $( function() {
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( ".datepicker" ).val("<?php echo @$row['cedula_fecha_expedicion']; ?>");
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
	  });
	</script>
	<input type="hidden" id="stop"  require="true" value="1"/>
    <div class="form">
        <div class="form-group item">
            <h3 class="text-center">Certificación del aspirante.</h3>
        </div>
    </div>
	<p>Por la presente y para todos los efectos legales, certifico que: </p>
    <ol>
        <li> Entiendo  que <?php echo $empresa->nombre_legal?>, operan y gestionan páginas de entretenimiento para adultos de contenido erótico. </li>
        <li>Me encuentro de manera libre y voluntaria en las instalaciones de <?php echo $empresa->nombre_legal?>. </li>
        <li> Soy de mente sana. </li>
        <li> Tengo dieciocho (18) años o más. </li>
        <li> He presentado documentación que acredita mi edad y me declaro penalmente responsable ante la falsificación o uso de documento privado o público, tipificado en el código penal Colombiano y excluyo a <?php echo $empresa->nombre_legal?> de cualquier responsabilidad, certificando que considero que ellos han actuado en razón de su buena fe penal, civil y comercial. </li>
        <li>No he sido obligada (o) o presionada (o) de ninguna manera para la presentación voluntaria a esta primera entrevista en las instalaciones de <?php echo $empresa->nombre_legal?>.</li>
        <li>Entiendo que de conformidad con lo dispuesto en la Ley Estatutaria 1581 de 2012 sobre el uso de los datos personales que se obtengan por medio de este proceso, serán recogidos y almacenados y objeto de tratamiento en bases de datos hasta por cinco (5) años más, esta base de datos cuenta con las medidas de seguridad necesarias para la conservación adecuada de los datos personales, con la aceptación de la presente autorización, permito el tratamiento de mis datos personales para las finalidades mencionadas y certifico que los datos suministrados a <?php echo $empresa->nombre_legal?> son ciertos, dejando por sentado que no he omitido o adulterado ninguna información.</li>
    </ol>
	<div class="row">
		<div class="col-md-4">
			<label><b class="pregunta">Certifico</b></label>
		</div>
		<div class="col-md-4">
			<h6>Si</h6>
			<?php echo set_input_radio("certifico","","Si",(@$row['certifico']=="Si")?true:false,"custom-control-input check",""); ?>
		</div>
		<div class="col-md-4">
			<h6>No</h6>
            <a href="<?php echo base_url("Formularios/TerminarPrueba"); ?>">
			<?php echo set_input_radio("certifico","","No",(@$row['certifico']=="No" || !isset($row['certifico']))?true:false,"custom-control-input check",""); ?>
            </a>
		</div>  
	</div>
    <div class="no_mostrar">
        <div class="row mb-4 certifico">
            <div class="col-md-4">
                <label><b>Nombres</b></label>
            </div>
            <div class="col-md-4">
                <?php set_input("PrimerNombre",@$row,$placeholder='Primer Nombre',$require=true,"firstLetterText");?>
            </div>
            <div class="col-md-4">
                <?php set_input("SegundoNombre",@$row,$placeholder='Segundo Nombre',$require=false,"firstLetterText");?>
            </div>  
        </div>
        <div class="row mb-4 certifico">
            <div class="col-md-4">
                <label><b>Apellidos</b></label>
            </div>
            <div class="col-md-4">
                <?php set_input("PrimerApellido",@$row,$placeholder='Primer Apellido',$require=true,"firstLetterText");?>                  
            </div>
            <div class="col-md-4">
                <?php set_input("SegundoApellido",@$row,$placeholder='Segundo Apellido',$require=false,"form-control");?>
            </div>  
        </div>
        <div class="row mb-4 certifico">
            <div class="col-md-4">
                <label><b>Número de Cédula</b></label>
            </div>
            <div class="col-md-4">
                <?php set_input("NroCedula",@$this->user->nro_piso_cedula,$placeholder='NroCedula',$require=true,"firstLetterText",array("readonly"=>"readonly"));?>
            </div>
        </div>        
        <div class="row mb-4 certifico">
            <div class="col-md-4">
                <label><b>Ciudad de Expedición</b></label>
            </div>	
            <div class="col-md-4">
                <?php echo lugar("cedula_ciudad_expedicion",@$row["cedula_ciudad_expedicion"]);?>
            </div>
        </div>
        <div class="row mb-4 certifico">
            <div class="col-md-4">
                <label><b>Fecha de Expedición</b></label>
            </div>	
            <div class="col-md-4">
                <?php set_input("cedula_fecha_expedicion",@$row,$placeholder='AAAA-MM-DD',$require=true,"datepicker");?>
            </div>
        </div>
    </div>
	<script>
		$(document).ready(function(){
			var respuesta 			= 	$('.check:checked').val();
			if(respuesta=='No'){
				$("#stop").val("");
				$(".continuar").attr("disabled","disabled");
				$(".no_mostrar").hide();	
			}
			if(respuesta=='Si'){
				$("#stop").val(1);
				$(".continuar").attr("disabled");	
			}
			$('.check').click(function(){
				respuesta 			= 	$(this).val();
				if(respuesta=='No'){
					$("#stop").val("");
					$(".continuar").addClass("disabled");
					$(".continuar").attr("disabled","disabled");
					$(".no_mostrar").hide();	
				}
				if(respuesta=='Si'){
					$("#stop").val(1);
					$(".continuar").removeAttr("disabled");
					$(".continuar").removeClass("disabled");
					$(".no_mostrar").show();
				}	
			});
		});		
	</script>      
<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
	//pre($empresa->nombre_comercial);
?>
<input name="fecha_inicio_prueba" type="hidden"  require="true" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
<div class="form">
    <div class="form-group item">
        <h3><b><?php echo $empresa->nombre_comercial;?> - te desea felicitar</b></h3>
    </div>
</div>
<div class="form-group ">
   <div class="col-md-12">
        <p>Felicitaciones has culminado tu Proceso de Entrevista</p><br/>
        <div style="height: 40px;"></div>
        <p>Cordialmente,</p>
        <p><?php echo $empresa->nombre_representante_legal;?></p>
   </div>
</div>

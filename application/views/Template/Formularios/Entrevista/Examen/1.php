<?php
	$empresa	=	$this->user->empresa;
	$row		=	$this->session->userdata('Encuesta');
	//pre($empresa->nombre_comercial);
  if(empty($row['fecha_inicio_prueba'])){
?>
<input name="fecha_inicio_prueba" type="hidden"  require="true" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
<?php }else{?>
  <input type="hidden"  require="true" value="1"/>
<?php } ?>
<div class="form">
    <div class="form-group item">
        <h3><b>GH1-04 Test de inglés <?php echo $empresa->nombre_comercial;?> - Ver 01.</b></h3>
    </div>
</div>
<div class="form-group ">
   <div class="col-md-12">
        <p>Quiero felicitarte por haber llegado hasta este punto, es importante recordarte que este test tiene por objetivo saber tu nivel de inglés real, no buscamos con ello "corcharte", jamás será nuestra intención, pero es vital para nosotros conocer tus competencias técnicas en este aspecto, pues ello nos permitirá saber que tanto apoyo requieres de nuestra parte, ten presente que este test será cronometrado, por lo cual cuando cumplas Ocho (8) minutos, este se cerrara de manera automática y se enviaran las respuestas a nuestra división de Gestión Humana para su respectivo análisis, ¡muchos éxitos en su desarrollo!</p><br/>
        <p>Cordialmente,</p>
        <p><?php echo $empresa->nombre_representante_legal;?></p>
   </div>
</div>

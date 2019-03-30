<?php

/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	if(!($this->session->userdata("Entrevista"))){
		$empresa    =   centrodecostos($this->user->id_empresa);
	}else{ 
		$empresa 		= 	centrodecostos($this->session->userdata("Entrevista")->empresa_id);
	}
?>
<div class="mt-5 container" style="text-align: justify;">
    <h2 class="p-5 col-md-12 text-center"><strong>Conocimiento de aspirantes <?php echo $empresa->nombre_legal?></strong></h2>

<p> Bienvenida (o) a <?php echo $empresa->nombre_legal?>;</p>

<p>  Antes de iniciar la presentación de tus test, quiero darte las gracias por estar el día de hoy en nuestras instalaciones e iniciar este proceso de selección, el cual esperamos concluya satisfactoriamente, durante los siguientes minutos realizaras tres (3) tipos de test, los cuales serán:</p>
<ul>

<li> <strong>Un test psicotécnico</strong>; este busca perfilarte para que nuestros profesionales sepan como debemos trabajar junto a vos, ten presente que en este primer test no existe respuesta equivocada, con el paso del tiempo hemos entendido que lo genial de nuestra empresa es que nos permite contar con personas ampliamente diversas, el objetivo real de este formulario será detectar tus pasiones, gustos, proyectos futuros <span>y debilidades</span>, queremos conocerte y ser parte de tus proyectos con miras a tener una mejor calidad de vida.</li>
</ul>
<br />
<ul>

<li><strong>Un test de inglés</strong>, este test tiene por objetivo saber tu nivel de inglés real, no buscamos con ello “corcharte”, jamás será nuestra intención, pero es vital para nosotros conocer tus competencias técnicas en este aspecto, pues ello nos permitirá saber que tanto apoyo requieres de nuestra parte, ten presente que este test será cronometrado, por lo cual cuando cumplas Ocho (8) minutos, este se cerrara de manera automática y se enviaran las respuestas a nuestra división de Gestión Humana para su respectivo análisis.</li>
</ul>
<br />

<ul>
<li><strong>Un test de digitación</strong>, en este test buscaremos calcular la cantidad de palabras digitadas por minutos, mi consejo es que lo realices con total tranquilidad, sin duda alguna y con toda seguridad te sorprenderás de tus capacidades.</li>
</ul>

<p>Ten presente que cada una de tus respuestas nos ayudarán a saber exactamente cómo podemos apoyarte en tu proceso de profesionalización como modelo contratante webcam, esperamos ser de gran apoyo para vos en cada parte de este proceso, por favor cada duda que tengas no dudes en consultarla con nuestro encargado (a)  de sede o escribirnos directamente a nuestro número oficial +57 <?php echo $empresa->cod_telefono." ".$empresa->telefono; ?>.</p>

<p><strong>¡Atrévete a iniciar esta aventura!</strong> y comprueba porque <?php echo $empresa->nombre_legal?> ha sido catalogada como una de las mejores empresas del entretenimiento para adultos para trabajar en Colombia.</p>

<p> Gracias por tu tiempo y mis mejores energías, cada que llegan personas geniales como vos a nuestra empresa, esta crece y asegura su estabilidad y continuidad en un mercado competitivo con grandes posibilidades para todos.</p>

<p> Cordialmente,<br /><br /><?php echo $empresa->nombre_representante_legal; ?><br />Gerente General <?php echo $empresa->nombre_legal?></p>
<p> </p>
	<div class="row">
	    <div class="col-md-12">
	        <div class="form-group text-center">
		        <a class="btn btn-primary" href="<?php echo base_url("Formularios/CertificacionAspirante/".$this->uri->segment(3));?>">
			        Proxima Pagina				    
		        </a>
	        </div>                        
	    </div>
	</div> 
</div>
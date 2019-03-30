<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo         =   $this->ModuloActivo;
	echo form_open(current_url(),array('autocomplete' => 'off'));
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
            <div class="col" style="height:300px; overflow:scroll;  overflow-x: hidden; text-align:justify;">

                    <p>Bienvenida (o) a <?php echo $this->user->empresa->nombre_legal?>;</p>
                    <p>Antes de iniciar la presentación de tus test, quiero darte las gracias por estar el día de hoy en nuestras instalaciones e iniciar este proceso de selección, el cual esperamos concluya satisfactoriamente, durante los siguientes minutos realizaras tres (3) tipos de test, los cuales serán:</p>
                    <ul>
                        <li> <strong>Un test psicotécnico</strong>; este busca perfilarte para que nuestros Profesionales sepan como debemos trabajar junto a vos, ten presente que en este primer test no existe respuesta equivocada, con el paso del tiempo hemos entendido que lo genial de nuestra empresa es que nos permite contar con personas ampliamente diversas, el objetivo real de este formulario será detectar tus pasiones, gustos, proyectos futuros <span>y debilidades</span>, queremos conocerte y ser parte de tus proyectos con miras a tener una mejor calidad de vida.</li>
                        <li><strong>Un test de inglés</strong>, este test tiene por objetivo saber tu nivel de inglés real, no buscamos con ello "corcharte", jamás será nuestra intención, pero es vital para nosotros conocer tus competencias técnicas en este aspecto, pues ello nos permitirá saber que tanto apoyo requieres de nuestra parte, ten presente que este test será cronometrado, por lo cual cuando cumplas Ocho (8) minutos, este se cerrara de manera automática y se enviaran las respuestas a nuestra división de Gestión Humana para su respectivo análisis.</li>
                        <li><strong>Un test de digitación</strong>, en este test buscaremos calcular la cantidad de palabras digitadas por minutos, mi consejo es que lo realices con total tranquilidad, sin duda alguna y con toda seguridad te sorprenderás de tus capacidades.</li>
                    </ul>
                    <p>Ten presente que cada una de tus respuestas nos ayudarán a saber exactamente cómo podemos apoyarte en tu proceso de Profesionalización como modelo contratante webcam, esperamos ser de gran apoyo para vos en cada parte de este proceso, por favor cada duda que tengas no dudes en consultarla con nuestro encargado (a)  de sede.</p>
                    <p><strong>¡Atrévete a iniciar esta aventura!</strong> y comprueba porque <?php echo $this->user->empresa->nombre_legal?> ha sido catalogada como una de las mejores empresas del entretenimiento para adultos para trabajar en Colombia.</p>
                    <p> Gracias por tu tiempo y mis mejores energías, cada que llegan personas geniales como vos a nuestra empresa, esta crece y asegura su estabilidad y continuidad en un mercado competitivo con grandes posibilidades para todos.</p>
                    <p><b> Cordialmente</b>,<br /><br /><?php echo $this->user->empresa->nombre_representante_legal; ?><br />Gerente General <?php echo $this->user->empresa->nombre_legal?></p>
                                    
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="form-group text-center">
                    <a class="btn btn-primary" href="<?php echo base_url("Formularios/Entrevista/PrimerBloque");?>">
                        Proxima Pagina				    
                    </a>
                </div>                        
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>                                         
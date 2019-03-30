<?php
	$empresa	=	$this->user->empresa;
     $row		=	$this->session->userdata('Encuesta');
    
?>

<input type="hidden"  require="true" value="1" name="finish"/>

<div id="reloj" style="background: #585858 ;
	width: 120px;
	height: 120px;
	position: fixed;
	right: 20px;
	top: 20px;
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	padding: auto;
	border: 6px inset #FE642E;
	color:white;
	z-index:1000;">
       
       <div class="container">
        <div class="row">
        <div>
            <span class="minutos"></span>
            <div class="texto">Minutos</div>
        </div>
        <div>
            <span class="segundos"></span>
            <div class="texto">Segundos</div>
        </div>
        </div>
        </div>
    </div>
<div class="form">
    <div class="form-group item">
        <h3><b>GH1-04 Test de inglés <?php echo $empresa->nombre_comercial;?> - Ver 01.</b></h3>
    </div>
</div>
<!--INICIO-->
<div class=" row form-group">
   <div class="col-md-3">
        <b>Are you going to your home?</b>
   </div>
   <div class="col-md-3">
        <h6>¿Vas para tu casa?</h6>
        <?php echo set_input_radio("1","",1,false,"custom-control-input","require"); ?>
   </div>
   <div class="col-md-3">
        <h6>¿Estás en tu casa?</h6>
        <?php echo set_input_radio("1","",0,false,"custom-control-input","require"); ?>  
   </div>
   <div class="col-md-3">
        <h6>¿Estás haciendo tu casa?</h6>
        <?php echo set_input_radio("1","",0,false,"custom-control-input","require"); ?>         
   </div>       
</div>
<!--FIN-->



<div class=" row form-group">
   <div class="col-md-3">
        <b>See</b>
   </div>
   <div class="col-md-3">
       	<h6>Ser</h6>
        <?php echo set_input_radio("2","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Oir</h6>
        <?php echo set_input_radio("2","",0,false,"custom-control-input",""); ?>  
   </div>
   <div class="col-md-3">
        <h6>Ver</h6>
        <?php echo set_input_radio("2","",1,false,"custom-control-input",""); ?>           
   </div>       
</div>




<div class=" row form-group">
   <div class="col-md-3">
        <b>I want</b>
   </div>
   <div class="col-md-3">
        <h6>Yo quiero</h6>
        <?php echo set_input_radio("3","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Querer</h6>
        <?php echo set_input_radio("3","",0,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
       	<h6>Yo deseo</h6>
        <?php echo set_input_radio("3","",0,false,"custom-control-input",""); ?>          
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
         <b>A little</b>
   </div>
   <div class="col-md-3">
        <h6>Un pequeño</h6>
        <?php echo set_input_radio("4","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Bastante</h6>
        <?php echo set_input_radio("4","",0,false,"custom-control-input",""); ?>  
   </div>
   <div class="col-md-3">
       	<h6>Un poco</h6>
        <?php echo set_input_radio("4","",0,false,"custom-control-input",""); ?>           
   </div>       
</div>



<div class=" row form-group">
   <div class="col-md-3">
         <b>Boobs</b>
   </div>
   <div class="col-md-3">
        <h6>Pechos</h6>
        <?php echo set_input_radio("5","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Senos</h6>
        <?php echo set_input_radio("5","",1,false,"custom-control-input",""); ?>  
   </div>
   <div class="col-md-3">
       	<h6>Bobina</h6>
        <?php echo set_input_radio("5","",0,false,"custom-control-input",""); ?>        
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
         <b>Tits</b>
   </div>
   <div class="col-md-3">
        <h6>Títulos</h6>
        <?php echo set_input_radio("6","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Pies</h6>
        <?php echo set_input_radio("6","",0,false,"custom-control-input",""); ?>  
   </div>
   <div class="col-md-3">
       	<h6>Tetas</h6>
        <?php echo set_input_radio("6","",1,false,"custom-control-input",""); ?>         
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
         <b>How are you?</b>
   </div>
   <div class="col-md-3">
        <h6>¿Estás?</h6>
        <?php echo set_input_radio("7","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>¿Dónde estas?</h6>
        <?php echo set_input_radio("7","",0,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
       	<h6>¿Cómo estas?</h6>
        <?php echo set_input_radio("7","",1,false,"custom-control-input",""); ?>          
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
       <b>Cum</b>
   </div>
   <div class="col-md-3">
        <h6>Semen</h6>
        <?php echo set_input_radio("8","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Obstáculos</h6>
        <?php echo set_input_radio("8","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
       	<h6>Cama</h6>
        <?php echo set_input_radio("8","",0,false,"custom-control-input",""); ?>       
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Fine thanks</b>
   </div>
   <div class="col-md-3">
        <h6>Muchas Gracias</h6>
         <?php echo set_input_radio("9","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Bien Gracias</h6>
        <?php echo set_input_radio("9","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
       	<h6>Mal Gracias</h6>
        <?php echo set_input_radio("9","",0,false,"custom-control-input",""); ?>     
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>How was your day?</b>
   </div>
   <div class="col-md-3">
        <h6>¿Qué tal tu día?</h6>
        <?php echo set_input_radio("10","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>¿Cómo estuvo tu día?</h6>
        <?php echo set_input_radio("10","",2,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
       	<h6>¿Cómo esta el día?</h6>
        <?php echo set_input_radio("10","",0,false,"custom-control-input",""); ?>      
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Ass</b>
   </div>
   <div class="col-md-3">
        <h6>Culo</h6>
        <?php echo set_input_radio("11","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Cachete</h6>
        <?php echo set_input_radio("11","",0,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
        <h6>Nalga</h6>
        <?php echo set_input_radio("11","",0,false,"custom-control-input",""); ?>       
   </div>       
</div>   



<div class=" row form-group">
   <div class="col-md-3">
      <b>Like</b>
   </div>
   <div class="col-md-3">
        <h6>Me gusta</h6>
        <?php echo set_input_radio("12","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Gustar</h6>
        <?php echo set_input_radio("12","",0,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
        <h6>Me Gustó</h6>
        <?php echo set_input_radio("12","",0,false,"custom-control-input",""); ?>       
   </div>       
</div>   


<div class=" row form-group">
   <div class="col-md-3">
      <b>I like your ass</b>
   </div>
   <div class="col-md-3">
        <h6>Me gusta tu culo</h6>
        <?php echo set_input_radio("13","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Me gusta tu cachete</h6>
        <?php echo set_input_radio("13","",0,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
        <h6>No me gustas</h6>
        <?php echo set_input_radio("13","",0,false,"custom-control-input",""); ?>     
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Pussy</b>
   </div>
   <div class="col-md-3">
        <h6>Poner</h6>
        <?php echo set_input_radio("14","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Vagina</h6>
        <?php echo set_input_radio("14","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Postura</h6>
        <?php echo set_input_radio("14","",0,false,"custom-control-input",""); ?>   
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>dick</b>
   </div>
   <div class="col-md-3">
        <h6>Pies</h6>
        <?php echo set_input_radio("15","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Pene</h6>
        <?php echo set_input_radio("15","",1,false,"custom-control-input",""); ?>  
   </div>
   <div class="col-md-3">
        <h6>Verguenza</h6>
        <?php echo set_input_radio("15","",0,false,"custom-control-input",""); ?>      
   </div>       
</div>



<div class=" row form-group">
   <div class="col-md-3">
      <b>Where are you from?</b>
   </div>
   <div class="col-md-3">
        <h6>¿Quién eres?</h6>
        <?php echo set_input_radio("16","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>¿De donde eres?</h6>
        <?php echo set_input_radio("16","",1,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
        <h6>¿Dónde estas?</h6>
        <?php echo set_input_radio("16","",0,false,"custom-control-input",""); ?>      
   </div>       
</div>



<div class=" row form-group">
   <div class="col-md-3">
      <b>Good</b>
   </div>
   <div class="col-md-3">
        <h6>Gordo</h6>
        <?php echo set_input_radio("17","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Bueno</h6>
        <?php echo set_input_radio("17","",1,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
        <h6>Dios</h6>
        <?php echo set_input_radio("17","",0,false,"custom-control-input",""); ?>        
   </div>       
</div> 



<div class=" row form-group">
   <div class="col-md-3">
      <b>Good morning</b>
   </div>
   <div class="col-md-3">
        <h6>Buen trabajo</h6>
        <?php echo set_input_radio("18","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Hasta mañana</h6>
        <?php echo set_input_radio("18","",0,false,"custom-control-input",""); ?>  
   </div>
   <div class="col-md-3">
        <h6>Buenos días</h6>
        <?php echo set_input_radio("18","",1,false,"custom-control-input",""); ?>          
   </div>       
</div>



<div class=" row form-group">
   <div class="col-md-3">
      <b>Tonight</b>
   </div>
   <div class="col-md-3">
        <h6>Esta noche</h6>
        <?php echo set_input_radio("19","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Buenas noches</h6>
        <?php echo set_input_radio("19","",0,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
        <h6>Buenos días</h6>
        <?php echo set_input_radio("19","",0,false,"custom-control-input",""); ?>            
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Tomorrow</b>
   </div>
   <div class="col-md-3">
        <h6>Mañana</h6>
        <?php echo set_input_radio("20","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Tomando</h6>
        <?php echo set_input_radio("20","",0,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
        <h6>Ayer</h6>
        <?php echo set_input_radio("20","",0,false,"custom-control-input",""); ?>                
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>See you tomorrow</b>
   </div>
   <div class="col-md-3">
        <h6>Nos vemos mañana</h6>
        <?php echo set_input_radio("21","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Te veo mañana</h6>
        <?php echo set_input_radio("21","",2,false,"custom-control-input",""); ?>  
   </div>
   <div class="col-md-3">
        <h6>Ayer te vi</h6>
        <?php echo set_input_radio("21","",0,false,"custom-control-input",""); ?>             
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Everything</b>
   </div>
   <div class="col-md-3">
        <h6>Nada</h6> 
        <?php echo set_input_radio("22","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Todo</h6>
        <?php echo set_input_radio("22","",2,false,"custom-control-input",""); ?> 
   </div>
   <div class="col-md-3">
        <h6>Mucho</h6>
        <?php echo set_input_radio("22","",0,false,"custom-control-input",""); ?>                   
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Glad</b>
   </div>
   <div class="col-md-3">
        <h6>Satisfecho</h6>
        <?php echo set_input_radio("23","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Alegre</h6>
        <?php echo set_input_radio("23","",1,false,"custom-control-input",""); ?>   
   </div>
   <div class="col-md-3">
        <h6>Triste</h6>
        <?php echo set_input_radio("23","",0,false,"custom-control-input",""); ?>                      
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>¿Quién soy yo?</b>
   </div>
   <div class="col-md-3">
        <h6>Who I am?</h6>
        <?php echo set_input_radio("24","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>How I am?</h6>
        <?php echo set_input_radio("24","",0,false,"custom-control-input",""); ?>       
   </div>
   <div class="col-md-3">
        <h6>I am?</h6>
        <?php echo set_input_radio("24","",0,false,"custom-control-input",""); ?>                    
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Nice</b>
   </div>
   <div class="col-md-3">
        <h6>Nada</h6>
        <?php echo set_input_radio("25","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Bonito</h6>
        <?php echo set_input_radio("25","",1,false,"custom-control-input",""); ?>         
   </div>
   <div class="col-md-3">
        <h6>Malo</h6>
        <?php echo set_input_radio("25","",0,false,"custom-control-input",""); ?>                 
   </div>       
</div>



<div class=" row form-group">
   <div class="col-md-3">
      <b>You are nice</b>
   </div>
   <div class="col-md-3">
        <h6>Eres Agradable</h6>
        <?php echo set_input_radio("26","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Que tengas un buen día</h6>
        <?php echo set_input_radio("26","",0,false,"custom-control-input",""); ?>          
   </div>
   <div class="col-md-3">
        <h6>Eres amable</h6>
        <?php echo set_input_radio("26","",0,false,"custom-control-input",""); ?>               
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>well</b>
   </div>
   <div class="col-md-3">
        <h6>Mal</h6>
        <?php echo set_input_radio("27","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Bien</h6>
        <?php echo set_input_radio("27","",1,false,"custom-control-input",""); ?>         
   </div>
   <div class="col-md-3">
        <h6>Bueno</h6>
        <?php echo set_input_radio("27","",0,false,"custom-control-input",""); ?>                
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>All</b>
   </div>
   <div class="col-md-3">
        <h6>Nada</h6>
        <?php echo set_input_radio("28","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Todo</h6>
        <?php echo set_input_radio("28","",1,false,"custom-control-input",""); ?>       
   </div>
   <div class="col-md-3">
        <h6>Mucho</h6>
        <?php echo set_input_radio("28","",0,false,"custom-control-input",""); ?>                     
   </div>       
</div> 


<div class=" row form-group">
   <div class="col-md-3">
      <b>Spank</b>
   </div>
   <div class="col-md-3">
        <h6>Patada</h6>
        <?php echo set_input_radio("29","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Palmadas</h6>
        <?php echo set_input_radio("29","",1,false,"custom-control-input",""); ?>    
   </div>
   <div class="col-md-3">
        <h6>Hablar</h6>
        <?php echo set_input_radio("29","",0,false,"custom-control-input",""); ?>                    
   </div>       
</div> 


<div class=" row form-group">
   <div class="col-md-3">
      <b>To Kiss</b>
   </div>
   <div class="col-md-3">
        <h6>Niños</h6>
        <?php echo set_input_radio("30","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Labios</h6>
        <?php echo set_input_radio("30","",0,false,"custom-control-input",""); ?>    
   </div>
   <div class="col-md-3">
        <h6>Besar</h6>
        <?php echo set_input_radio("30","",1,false,"custom-control-input",""); ?>                       
   </div>       
</div>  
 

<div class=" row form-group">
   <div class="col-md-3">
      <b>Fucking</b>
   </div>
   <div class="col-md-3">
        <h6>Follando</h6>
        <?php echo set_input_radio("31","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Masturbando</h6>
        <?php echo set_input_radio("31","",0,false,"custom-control-input",""); ?>     
   </div>
   <div class="col-md-3">
        <h6>Fastidiar</h6>
        <?php echo set_input_radio("31","",0,false,"custom-control-input",""); ?>                       
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Heel</b>
   </div>
   <div class="col-md-3">
        <h6>Tacones</h6>
        <?php echo set_input_radio("32","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Angel</h6>
        <?php echo set_input_radio("32","",0,false,"custom-control-input",""); ?>    
   </div>
   <div class="col-md-3">
        <h6>Infierno</h6>
        <?php echo set_input_radio("32","",0,false,"custom-control-input",""); ?>                      
   </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Both</b>
   </div>
   <div class="col-md-3">
        <h6>Bote</h6>
        <?php echo set_input_radio("33","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Ambos</h6>
        <?php echo set_input_radio("33","",1,false,"custom-control-input",""); ?>      
   </div>
   <div class="col-md-3">
        <h6>Costoso</h6>
        <?php echo set_input_radio("33","",0,false,"custom-control-input",""); ?>                      
   </div>       
</div>


<div class=" row form-group">
   	<div class="col-md-3">
      <b>To Sit</b>
   	</div>
   	<div class="col-md-3">
        <h6>Saltar</h6>
        <?php echo set_input_radio("34","",0,false,"custom-control-input",""); ?>
   	</div>
   	<div class="col-md-3">
        <h6>Parar</h6>
        <?php echo set_input_radio("34","",0,false,"custom-control-input",""); ?>         
	</div>        
   	<div class="col-md-3">
        <h6>Sentar</h6>
        <?php echo set_input_radio("34","",1,false,"custom-control-input",""); ?>                   
   	</div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Up</b>
   </div>
   <div class="col-md-3">
        <h6>Arriba</h6>
        <?php echo set_input_radio("35","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>En frente</h6>
        <?php echo set_input_radio("35","",0,false,"custom-control-input",""); ?>         
 	</div>       
   	<div class="col-md-3">
        <h6>Debajo</h6>
        <?php echo set_input_radio("35","",0,false,"custom-control-input",""); ?>                       
   	</div>       
</div>


<div class=" row form-group">
   	<div class="col-md-3">
      <b>I'll be playing in the park</b>
   	</div>
   	<div class="col-md-3">
        <h6>Están los juegos en el parque</h6>
        <?php echo set_input_radio("36","",0,false,"custom-control-input",""); ?>
   	</div>
   	<div class="col-md-3">
        <h6>Jugamos en el parque</h6>
        <?php echo set_input_radio("36","",0,false,"custom-control-input",""); ?>            
	</div>          
   	<div class="col-md-3">
        <h6>Estaré jugando en el parque</h6>
        <?php echo set_input_radio("36","",2,false,"custom-control-input",""); ?>                          
	</div>        
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Legs</b>
   </div>
   <div class="col-md-3">
        <h6>Piernas</h6>
        <?php echo set_input_radio("37","",1,false,"custom-control-input",""); ?>
    </div>
    <div class="col-md-3">
	    <h6>Brazo</h6>
        <?php echo set_input_radio("37","",0,false,"custom-control-input",""); ?>            
	</div>        
   	<div class="col-md-3">
        <h6>Manos</h6>
        <?php echo set_input_radio("37","",0,false,"custom-control-input",""); ?>                         
   </div>       
</div>


<div class=" row form-group">
    <div class="col-md-3">
    	<b>For</b>
    </div>
    <div class="col-md-3">
   		<h6>Por</h6>
    	<?php echo set_input_radio("38","",1,false,"custom-control-input",""); ?>
    </div>
    <div class="col-md-3">
    	<h6>Donde</h6>
    	<?php echo set_input_radio("38","",0,false,"custom-control-input",""); ?>          
    </div>        
    <div class="col-md-3">
    	<h6>Como</h6>
    	<?php echo set_input_radio("38","",0,false,"custom-control-input",""); ?>                          
    </div>       
</div>

<div class=" row form-group">
   	<div class="col-md-3">
      <b>I Wanna</b>
   	</div>
   	<div class="col-md-3">
        <h6>Ganas</h6>
        <?php echo set_input_radio("39","",0,false,"custom-control-input",""); ?>
   	</div>
   	<div class="col-md-3">
        <h6>Quiero</h6>
        <?php echo set_input_radio("39","",1,false,"custom-control-input",""); ?>          
	</div>        
   	<div class="col-md-3">
        <h6>Gusto</h6>
        <?php echo set_input_radio("39","",0,false,"custom-control-input",""); ?>                         
   </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
      <b>Have</b>
   </div>
   <div class="col-md-3">
        <h6>Tener</h6>
        <?php echo set_input_radio("40","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Cambio</h6>
        <?php echo set_input_radio("40","",0,false,"custom-control-input",""); ?>          
	</div>
   	<div class="col-md-3">
        <h6>Calor</h6>
        <?php echo set_input_radio("40","",0,false,"custom-control-input",""); ?>                       
   	</div>       
</div>


<div class=" row form-group">
   	<div class="col-md-3">
    	<b>Can i Help you?</b>
   	</div>
   	<div class="col-md-3">
        <h6>¿Estás aquí?</h6>
        <?php echo set_input_radio("41","",0,false,"custom-control-input",""); ?>
   	</div>
   	<div class="col-md-3">
        <h6>¿Me amas?</h6>
        <?php echo set_input_radio("41","",0,false,"custom-control-input",""); ?>          
	</div>
   <div class="col-md-3">
        <h6>¿Puedo ayudarte?</h6>
        <?php echo set_input_radio("41","",2,false,"custom-control-input",""); ?>                      
   </div>       
</div>


<div class=" row form-group">
   	<div class="col-md-3">
      	<b>Do you have a boyfriend?</b>
   	</div>
   	<div class="col-md-3">
        <h6>¿Tienes novia?</h6>
        <?php echo set_input_radio("42","",0,false,"custom-control-input",""); ?>
   	</div>
   	<div class="col-md-3">
        <h6>¿Tienes novio?</h6>
        <?php echo set_input_radio("42","",2,false,"custom-control-input",""); ?>
	</div>        
    <div class="col-md-3">
        <h6>¿Dónde esta tu novio?</h6>
        <?php echo set_input_radio("42","",0,false,"custom-control-input",""); ?>
    </div>       
</div>


<div class=" row form-group">
   <div class="col-md-3">
      <b>Great</b>
   </div>
   <div class="col-md-3">
        <h6>Grandioso</h6>
        <?php echo set_input_radio("43","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Grande</h6>
        <?php echo set_input_radio("43","",0,false,"custom-control-input",""); ?>
	</div>        
   	<div class="col-md-3">
        <h6>Gordo</h6>
        <?php echo set_input_radio("43","",0,false,"custom-control-input",""); ?>         
   	</div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
      <b>Idea</b>
   </div>
   <div class="col-md-3">
        <h6>Idea</h6>
        <?php echo set_input_radio("44","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Pensamiento</h6>
        <?php echo set_input_radio("44","",0,false,"custom-control-input",""); ?> 
	</div>        
   	<div class="col-md-3">
        <h6>Pensar</h6>
        <?php echo set_input_radio("44","",0,false,"custom-control-input",""); ?>        
   	</div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Tease</b>
   </div>
   <div class="col-md-3">
        <h6>Luchas</h6>
        <?php echo set_input_radio("45","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Saltar</h6>
        <?php echo set_input_radio("45","",0,false,"custom-control-input",""); ?> 
  </div>        
    <div class="col-md-3">
        <h6>Molestar</h6>
        <?php echo set_input_radio("45","",1,false,"custom-control-input",""); ?>        
    </div>       
</div>
        
<div class=" row form-group">
   <div class="col-md-3">
        <b>So</b>
   </div>
   <div class="col-md-3">
        <h6>Sopa</h6>
        <?php echo set_input_radio("46","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Así</h6>
        <?php echo set_input_radio("46","",1,false,"custom-control-input",""); ?> 
  </div>        
    <div class="col-md-3">
        <h6>Canción</h6>
        <?php echo set_input_radio("46","",0,false,"custom-control-input",""); ?>        
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>User</b>
   </div>
   <div class="col-md-3">
        <h6>Miembro</h6>
        <?php echo set_input_radio("47","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Usuario</h6>
        <?php echo set_input_radio("47","",1,false,"custom-control-input",""); ?> 
  </div>        
    <div class="col-md-3">
        <h6>Usado</h6>
        <?php echo set_input_radio("47","",0,false,"custom-control-input",""); ?>        
    </div>       
</div>
<div class=" row form-group">
   <div class="col-md-3">
        <b>Now</b>
   </div>
   <div class="col-md-3">
        <h6>Nuevo</h6>
        <?php echo set_input_radio("48","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Usuario</h6>
        <?php echo set_input_radio("48","",0,false,"custom-control-input",""); ?> 
  </div>        
    <div class="col-md-3">
        <h6>Ahora</h6>
        <?php echo set_input_radio("48","",1,false,"custom-control-input",""); ?>        
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Where have you been?</b>
   </div>
   <div class="col-md-3">
        <h6>I have been studied to math's test for tomorrow</h6>
        <?php echo set_input_radio("49","",2.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>I has been looking for the meaning of live</h6>
        <?php echo set_input_radio("49","",0,false,"custom-control-input",""); ?> 
  </div>        
    <div class="col-md-3">
        <h6>I have be finished to reads my second cohelo's book</h6>
        <?php echo set_input_radio("49","",0,false,"custom-control-input",""); ?>        
    </div>       
</div>
   
<div class=" row form-group">
   <div class="col-md-3">
        <b>Come</b>
   </div>
   <div class="col-md-3">
        <h6>Venir</h6>
        <?php echo set_input_radio("50","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Salir</h6>
        <?php echo set_input_radio("50","",0,false,"custom-control-input",""); ?> 
  </div>        
    <div class="col-md-3">
        <h6>I have be finished to reads my second cohelo's book</h6>
        <?php echo set_input_radio("50","",0,false,"custom-control-input",""); ?>        
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Do you want to come?</b>
   </div>
   <div class="col-md-3">
        <h6>Quieres salir?</h6>
        <?php echo set_input_radio("51","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Quieres venir?</h6>
        <?php echo set_input_radio("51","",1.5,false,"custom-control-input",""); ?> 
  </div>        
    <div class="col-md-3">
        <h6>I have be finished to reads my second cohelo's book</h6>
        <?php echo set_input_radio("51","",0,false,"custom-control-input",""); ?>        
    </div>       
</div>  

<div class=" row form-group">
   <div class="col-md-3">
        <b>Married</b>
   </div>
   <div class="col-md-3">
        <h6>Marido</h6>
        <?php echo set_input_radio("52","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Casado</h6>
        <?php echo set_input_radio("52","",1,false,"custom-control-input",""); ?> 
  </div>        
    <div class="col-md-3">
        <h6>Muerto</h6>
        <?php echo set_input_radio("52","",0,false,"custom-control-input",""); ?>        
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Do you marry with me?</b>
   </div>
   <div class="col-md-3">
        <h6>Tu eres mi marido</h6>
        <?php echo set_input_radio("53","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>¿Te casas conmigo?</h6>
        <?php echo set_input_radio("53","",1,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Tu estas muerto</h6>
        <?php echo set_input_radio("53","",0,false,"custom-control-input",""); ?>        
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Girls</b>
   </div>
   <div class="col-md-3">
        <h6>Grillos</h6>
        <?php echo set_input_radio("54","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Mujeres</h6>
        <?php echo set_input_radio("54","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Chicas</h6>
        <?php echo set_input_radio("54","",1,false,"custom-control-input",""); ?>
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Get</b>
   </div>
   <div class="col-md-3">
        <h6>Dar</h6>
        <?php echo set_input_radio("55","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Obtener</h6>
        <?php echo set_input_radio("55","",1,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Chicas</h6>
        <?php echo set_input_radio("55","",1,false,"custom-control-input",""); ?>
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Can I get your number?</b>
   </div>
   <div class="col-md-3">
        <h6>Te puedo llamar?</h6>
        <?php echo set_input_radio("56","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Puedo tener tu Número?</h6>
        <?php echo set_input_radio("56","",2,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Este es mi Número!</h6>
        <?php echo set_input_radio("56","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>



<div class=" row form-group">
   <div class="col-md-3">
        <b>Name</b>
   </div>
   <div class="col-md-3">
        <h6>Llamar</h6>
        <?php echo set_input_radio("58","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Hombre</h6>
        <?php echo set_input_radio("58","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Este es mi Número!</h6>
        <?php echo set_input_radio("58","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Write</b>
   </div>
   <div class="col-md-3">
        <h6>Escribir</h6>
        <?php echo set_input_radio("59","",1,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Hablar</h6>
        <?php echo set_input_radio("59","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Leer</h6>
        <?php echo set_input_radio("59","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Friends</b>
   </div>
   <div class="col-md-3">
        <h6>Amigos</h6>
        <?php echo set_input_radio("60","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Novios</h6>
        <?php echo set_input_radio("60","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Enemigos</h6>
        <?php echo set_input_radio("60","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Man</b>
   </div>
   <div class="col-md-3">
        <h6>Mano</h6>
        <?php echo set_input_radio("61","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Hombre</h6>
        <?php echo set_input_radio("61","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Martes</h6>
        <?php echo set_input_radio("61","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Women</b>
   </div>
   <div class="col-md-3">
        <h6>Mujeres</h6>
        <?php echo set_input_radio("62","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Esposa</h6>
        <?php echo set_input_radio("62","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Mujer</h6>
        <?php echo set_input_radio("62","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Please</b>
   </div>
   <div class="col-md-3">
        <h6>Placer</h6>
        <?php echo set_input_radio("63","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Por favor</h6>
        <?php echo set_input_radio("63","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Complacer</h6>
        <?php echo set_input_radio("63","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Too</b>
   </div>
   <div class="col-md-3">
        <h6>Juguete</h6>
        <?php echo set_input_radio("64","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Tambien</h6>
        <?php echo set_input_radio("64","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Tanto</h6>
        <?php echo set_input_radio("64","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>
<div class=" row form-group">
   <div class="col-md-3">
        <b>Pretty</b>
   </div>
   <div class="col-md-3">
        <h6>Bonita</h6>
        <?php echo set_input_radio("65","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Increible</h6>
        <?php echo set_input_radio("65","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Dulce</h6>
        <?php echo set_input_radio("65","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Active</b>
   </div>
   <div class="col-md-3">
        <h6>Actividad</h6>
        <?php echo set_input_radio("66","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Increible</h6>
        <?php echo set_input_radio("66","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Activo</h6>
        <?php echo set_input_radio("66","",0.5,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Those</b>
   </div>
   <div class="col-md-3">
        <h6>Aquellos</h6>
        <?php echo set_input_radio("67","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Aunque</h6>
        <?php echo set_input_radio("67","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Nosotros</h6>
        <?php echo set_input_radio("67","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Play</b>
   </div>
   <div class="col-md-3">
        <h6>Juego</h6>
        <?php echo set_input_radio("68","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Jugar</h6>
        <?php echo set_input_radio("68","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Juguete</h6>
        <?php echo set_input_radio("68","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>They</b>
   </div>
   <div class="col-md-3">
        <h6>Ellos</h6>
        <?php echo set_input_radio("69","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Esos</h6>
        <?php echo set_input_radio("69","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Nosotros</h6>
        <?php echo set_input_radio("69","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>The Classroom group have gone to camping at July fourth independance day</b>
   </div>
   <div class="col-md-3">
        <h6>El grupo de clase ha ido a acampar el 4 de julio día de la independecia.</h6>
        <?php echo set_input_radio("70","",2,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>El grupo de clase fue a acampar el 4 de julio día de la independencia.</h6>
        <?php echo set_input_radio("70","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>El grupo de clase va a acampar el 4 de julio día de la independencia.</h6>
        <?php echo set_input_radio("70","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>How many coins did you get?</b>
   </div>
   <div class="col-md-3">
        <h6>Cuantos monedas tienes?</h6>
        <?php echo set_input_radio("71","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Cuantas monedas obtuviste?</h6>
        <?php echo set_input_radio("71","",2,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Cuantas monedas perdiste?</h6>
        <?php echo set_input_radio("71","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>He</b>
   </div>
   <div class="col-md-3">
        <h6>Ella</h6>
        <?php echo set_input_radio("72","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>El</h6>
        <?php echo set_input_radio("72","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Yo</h6>
        <?php echo set_input_radio("72","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>It</b>
   </div>
   <div class="col-md-3">
        <h6>Esto</h6>
        <?php echo set_input_radio("73","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Esos</h6>
        <?php echo set_input_radio("73","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Eso</h6>
        <?php echo set_input_radio("73","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>We</b>
   </div>
   <div class="col-md-3">
        <h6>Nuestro</h6>
        <?php echo set_input_radio("74","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Ellos</h6>
        <?php echo set_input_radio("74","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Nosotros</h6>
        <?php echo set_input_radio("74","",0.5,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>You</b>
   </div>
   <div class="col-md-3">
        <h6>Tuyo</h6>
        <?php echo set_input_radio("75","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Tú</h6>
        <?php echo set_input_radio("75","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Mismo</h6>
        <?php echo set_input_radio("75","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Prefer</b>
   </div>
   <div class="col-md-3">
        <h6>Profesión</h6>
        <?php echo set_input_radio("76","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Preferir</h6>
        <?php echo set_input_radio("76","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Perfecto</h6>
        <?php echo set_input_radio("76","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Backrefer</b>
   </div>
   <div class="col-md-3">
        <h6>Negro</h6>
        <?php echo set_input_radio("77","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Espalda</h6>
        <?php echo set_input_radio("77","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Por atrás</h6>
        <?php echo set_input_radio("77","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>How Much</b>
   </div>
   <div class="col-md-3">
        <h6>Como estas?</h6>
        <?php echo set_input_radio("78","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Cuanto cuesta?</h6>
        <?php echo set_input_radio("78","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Cuantos son? </h6>
        <?php echo set_input_radio("78","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Nice to meet you (ntmu)</b>
   </div>
   <div class="col-md-3">
        <h6>Encantada de Conocerte</h6>
        <?php echo set_input_radio("79","",2,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Quiero conocerte</h6>
        <?php echo set_input_radio("79","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Agradable para mi</h6>
        <?php echo set_input_radio("79","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>    

<div class=" row form-group">
   <div class="col-md-3">
        <b>Fantastic</b>
   </div>
   <div class="col-md-3">
        <h6>Fantastico</h6>
        <?php echo set_input_radio("80","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Fanatico</h6>
        <?php echo set_input_radio("80","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Grandioso</h6>
        <?php echo set_input_radio("80","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Do you want to play</b>
   </div>
   <div class="col-md-3">
        <h6>Quiero jugar?</h6>
        <?php echo set_input_radio("81","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Jugamos?</h6>
        <?php echo set_input_radio("81","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Quieres Jugar ?</h6>
        <?php echo set_input_radio("81","",1.5,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>I`m Going to ...</b>
   </div>
   <div class="col-md-3">
        <h6>Vamos a hacer...</h6>
        <?php echo set_input_radio("82","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Yo voy a ...?</h6>
        <?php echo set_input_radio("82","",1.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Me Voy a ...</h6>
        <?php echo set_input_radio("82","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Call Me</b>
   </div>
   <div class="col-md-3">
        <h6>Llamame</h6>
        <?php echo set_input_radio("83","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Hablame</h6>
        <?php echo set_input_radio("83","",0,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Escribeme</h6>
        <?php echo set_input_radio("83","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Before</b>
   </div>
   <div class="col-md-3">
        <h6>Después</h6>
        <?php echo set_input_radio("84","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Antes</h6>
        <?php echo set_input_radio("84","",0.5,false,"custom-control-input",""); ?>
  </div>        
    <div class="col-md-3">
        <h6>Ahora</h6>
        <?php echo set_input_radio("84","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Change</b>
   </div>
   <div class="col-md-3">
        <h6>Cambio</h6>
        <?php echo set_input_radio("85","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Regalo</h6>
        <?php echo set_input_radio("85","",0,false,"custom-control-input",""); ?>         
  </div>        
    <div class="col-md-3">
        <h6>Ahora</h6>
        <?php echo set_input_radio("85","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Clothes</b>
   </div>
   <div class="col-md-3">
        <h6>Ropa</h6>
        <?php echo set_input_radio("86","",0.5,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Closet</h6>
        <?php echo set_input_radio("86","",0,false,"custom-control-input",""); ?>         
  </div>        
    <div class="col-md-3">
        <h6>Color</h6>
        <?php echo set_input_radio("86","",0,false,"custom-control-input",""); ?>         
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>Just</b>
   </div>
   <div class="col-md-3">
        <h6>Solo</h6>
        <?php echo set_input_radio("87","",0,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>Justo</h6>
        <?php echo set_input_radio("87","",0.5,false,"custom-control-input",""); ?>         
  </div>        
    <div class="col-md-3">
        <h6>Ambos</h6>
        <?php echo set_input_radio("87","",0,false,"custom-control-input",""); ?>                  
    </div>       
</div>

<div class=" row form-group">
   <div class="col-md-3">
        <b>If you were ever in trouble,I would give you all the help you ________</b>
   </div>
   <div class="col-md-3">
        <h6>needed</h6>
        <?php echo set_input_radio("88","",4,false,"custom-control-input",""); ?>
   </div>
   <div class="col-md-3">
        <h6>would need</h6>
        <?php echo set_input_radio("88","",0.5,false,"custom-control-input",""); ?>         
  </div>        
    <div class="col-md-3">
        <h6>will need </h6>
        <?php echo set_input_radio("88","",0,false,"custom-control-input",""); ?>                 
    </div>       
</div>
<input name="fecha_fin_prueba" type="hidden"  require="true" value="<?php echo date("Y-m-d H:i:s"); ?>"/>
<input name="json_entrevista" id="Examen" type="hidden"  require="true" value="0"/>
<script>
$(document).ready(function() {
 var html; 
 var preguntas_ingles  = $('.form-group>div>b');
 var respuestas_ingles = $('.form-group>div>h6');
 var contenedor        = $('.form-group');
preguntas_ingles.each(function(index, el) {
   html = '<input type="hidden" value="'+$(this).text()+'">';
   $(this).append(html);
});
respuestas_ingles.each(function(index, el) {
     html = '<input type="hidden" value="'+$(this).text()+'">';
     $(this).append(html);
});
contenedor.each(function(index, el) {
   $(this).find("input[type='hidden']").attr('name', 'pregunta['+index+'][]');
});
 var fecha = Date.parse('<?php echo $row['fecha_inicio_prueba']; ?>');
function getTimeRemaining(endtime) {
  var t = (fecha+endtime) - Date.parse(new Date());
  var segundos = Math.floor((t / 1000) % 60);
  var minutos = Math.floor((t / 1000 / 60) % 60);
  //var horas = Math.floor((t / (1000 * 60 * 60)) % 24);
  //var dias = Math.floor(t / (1000 * 60 * 60 * 24));

  return {
    'total': t,
    //'dias': dias,
    //'horas': horas,
    'minutos': minutos,
    'segundos': segundos
  };
}

function inicioReloj(id, endtime) {
  //var diaSpan = $(id).find('.dias');
  //var horaSpan = $(id).find('.horas');
  var minutoSpan = $(id).find('.minutos');
  var segundoSpan = $(id).find('.segundos');
//clearinterval(timeinterval);
  function actualizarReloj() {
    var t = getTimeRemaining(endtime);
    //diaSpan.html('<h2>'+t.dias+'</h2>');
    //horaSpan.html('<h2>' + t.horas + '</h2>').slice(-2);
    minutoSpan.html ('<h2>' + t.minutos + ' :</h2>');
    segundoSpan.html('<h2>' + t.segundos + '</h2>');
    if (t.total <= 0) {
       $('.continuar').trigger("click");
       clearInterval(timeinterval);
       
    }
  }
  actualizarReloj();
  var timeinterval = setInterval(actualizarReloj, 1000);
}

var deadline = parseInt(480000);
inicioReloj('#reloj', deadline);

  $('input[type = radio]').click(function(){
     var preguntas = $('input[type=radio]:checked');
     var respuesta = 0;
     preguntas.each(function(){
        respuesta += parseFloat($(this).val());
     });
     $('#Examen').val(respuesta);
  });
  $(".continuar").click(function(e){
     e.preventDefault();
     $('input[type=radio]:checked').each(function(index,el) {
       var opcion = $(this).parent().parent().find('h6').text();
       var input  = '<input type="hidden" name="respuesta['+$(this).attr('name')+']" value="'+opcion+'">';
       $(this).append(input);
     });
  }); 
});

</script>
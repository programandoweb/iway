<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
//pre($this->user);
echo form_open_multipart($this->uri->segment(1).'/'.$this->uri->segment(2).'/49',array('ajax' => 'true'));	?>
<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        <div class="form">	
            <div  id="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
              <div class="row form-group item">
	                <div class="col-md-12 text-center">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h3>Control de entrega de room</h3>
                     </a>   
                    </div>
                </div>
                </div>
                <div class="card">
                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                <div class="col-md-12">
                	<div class="form">
						<h5>Turno</h5>
                        <?php echo MakeTurnos("turnos",'',$this->user->centro_de_costos,array("class"=>"form-control options","require"=>true,"id"=>"turnos")); ?>                    
                    </div>
                 </div>
                <div class="col-md-12">
                	<div class="form">
						<h5>Room</h5>
                        <select class="form-control" name="room" id="rooms">
                            <option value="">Seleccione</option>
                        </select>
					</div>
				</div>    
                <div class="col-md-12">
                	<div class="form">
						<h5>Modelo</h5>
                        <select class="form-control" name="id_modelo" id="modelos">
                            <option value="">Seleccione</option>
                        </select>
                	</div>
                </div> 
                </div>
                </div>
                <div class="card">
                <div class="col-md-12 text-center">
                	<div class="form">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">	
                        <h4>Aseo general</h4>
                   </a>     
                    </div>
                </div>
               
               </div>
                
               <div class="card" style="padding:10px;">
                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                
                <div id="Room1">
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Suelo barrido y trapeado</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("suelo",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Cama sin sábanas (sólo protectores plásticos)</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("cama",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                    
                   <!-- <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Plástico protector de colchón desinfectado.</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("plastico",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>  -->                  
                   <!-- <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Accesorios desinfectados.</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("accesorios",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div> -->                 
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Polvo y/o manchas en mesas computador</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("polvo",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Manchas en el suelo, mesas auxiliares y/o paredes</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("manchas",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Manchas en: tendidos, base de cama, almohadas</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("tendidos",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group">                    
                        <div class="col-md-6 text-right">	
                            <b>Cristal de la cámara limpio</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("cristal",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                    
				</div>
                
                <div id="Room2">
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Lámparas en buen estado (bombillas y cables)</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("lampara",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                                      
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Armario y elementos personales ordenados</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("armario",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                    
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Ventilador y/o aire acondicionado</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("ventilador",'',array("class"=>"form-control select")); ?>
                    	</div>               
                    </div>    
        			</div>
                    </div><!-- fin acordion 2 -->
                    </div>
                    
                    <div class="card">
                    <div class="form">
	            		<div class="col-md-12 text-center">
                			<div class="form">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTree" aria-expanded="false" aria-controls="collapseTree">	
                             <h4> Equipos Informáticos</h4>
                             </a>
                   			</div>
                		</div>
                    </div>    
                	</div>
                    <div class="card"  style="padding:10px;">
                    <div id="collapseTree" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div id="Room3">                                                   
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                            <b>Computador operando</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("pc",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                      
                    <!--<div class="row form-group">
                        <div class="col-md-6 text-right">	
                           	<b>Todas la luces prendidas.</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("luces",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>-->                        
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                           	<b>Cámara web operando</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("camara",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                      
                   <!-- <div class="row form-group">
                        <div class="col-md-6 text-right">	
                           	<b>Estado de la cámara web (operativa).</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("estado",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div> -->                       
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                           	<b>Parlantes Operando</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("parlantes",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                     
                    <div class="row form-group">
                        <div class="col-md-6 text-right">	
                           	<b>Teclado y mouse Operando</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("golpes",'',array("class"=>"form-control select")); ?>
                    	</div>
                    </div>                    
                    <!--<div class="row form-group">
                        <div class="col-md-6 text-right">	
                           	<b>Clavija del internet en buen estado.</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("clavija",'',array("class"=>"form-control select")); ?>
                    	</div>                   
                    </div>-->    
                   <!-- <div class="row form-group">
                    	<div class="col-md-6 text-right">	
                           	<b>Cables del PC amarrados y en buen estado.</b>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php echo MakeSiNo("cables",'',array("class"=>"form-control select")); ?>
                    	</div>
                   	</div>-->
                       
                	<div class="row">
                    	<div class="col-md-12">
                        	<div class="form-group text-center">
                            	 <button type="submit" class="btn btn-primary">Guardar</button>
                        	</div>                        
                    	</div>
                    </div> <!-- fin acordion 3 --> 
                   
                    </div>                 
				</div>  
                </div>                  
			</div><!--fin acoridion -->
        </div><!--fin form -->    
        </div><!--col-md-8--->
    </div><!-- row justify-content-md-center -->
</div><!--fin container-->
<?php echo form_close();?>
<script>
    $('.select').change(function(){
        var input = $('<input type="text" name="ob_'+$(this).attr('name')+'" class="form-control" style="padding-bottom:60px;" placeholder="Observación">');
        var html =$('<div class="col-md-12 text-right option m-4" style="position:relative; "> <input type="text" name="ob_'+$(this).attr('name')+'" class="form-control" style="padding-bottom:60px;" placeholder="Observación"> <input id="archivo" type="file" name="file_'+$(this).attr('name')+'" style="visibility:hidden;"><i class="fa fa-file" style="position:absolute; visibility:hidden; bottom:30px;left:30px;cursor:pointer;font-size:20px; margin-top:200px" title="Adjuntar Imagen" id="file"> Adjuntar Archivo</i></div>');
           
       html.find('#file').click(function(){
                //console.log(e)
            var e =  $(this).parent('div').find('#archivo').click();
            console.log(e);
            e.change(function(img){
            console.log(img.target.files[0]);
            var name = img.target.files[0];
           
          var validar=  validarArchivo(this);
          console.log(validar.return);
             if(validar.return[0].value){
               // html.find('#file').html('<div style="position:absolute;margin-top:-115px"><img  src="<?php echo base_url();?>images/design/loder.gif"></div>'); 
                html.find('#file').html(name['name']);
             //$("#file").html('<span> '+name["name"]+'</span>');
                     
                }else{
                   // make_message("Error","Este tipo de archivo no es permitido");
                    html.find('#file').html('<p style="color:red">Error tipo de archivo no permitido</p>');
                    return false
                }
            });
                
                //console.log(html.find('#archivo')[0].files[0].name);
            });
           
        function validarArchivo(datos){
	    var extensionesValidas = ".png, .gif, .jpg";
        var maxSize = 1048576; //bytes
        var ruta = datos.value;
        var maxsize= datos.files[0].size;
        var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
	    var extensionValida = extensionesValidas.indexOf(extension);
        
      
        
        if(extensionValida < 0) {
            return {"return":[{"maxsize": maxsize , "extension":extensionValida,"value":false,error:'extencion'},  ]};
            }else{
            
                return {"return":[{"maxsize": maxsize , "extension":extensionValida,"value":true}, ]};
            }
	}
    if($(this).val() == 0 && $(this).val() != ''){  
           
            $(this).parent('div').parent('div').append(html);
           
        }else{
            $(this).parent('div').parent('div').find('.option').remove();
        }
    });
    var url = '<?php echo current_url().'/form_control'; ?>';
	$(document).ready(function(){
        var turno = '';
	   $('#turnos').change(function(event) {
        turno = $(this).val();
            $.post('<?php echo current_url().'/form_control'; ?>',{turno:turno}, function($data){
                console.log($data);
                $json = JSON.parse($data);
                $option = '<option value="">Seleccione</option>';
                $.each($json,function(index,elem){
                    $option += '<option value="'+elem.room_transmision+'">Room '+elem.room_transmision+'</option>';
                });
                $('#rooms').html($option);
            }); 
        });
     $('#rooms').change(function(event) {
        var room = $(this).val();
            $.post('<?php echo current_url().'/form_control'; ?>',{turno:turno,room:room}, function($data){
                $json = JSON.parse($data);
                $option = '<option value="">Seleccione</option>';
                $.each($json,function(index,elem){
                    $option += '<option value="'+elem.user_id+'">'+elem.primer_nombre+' '+elem.segundo_nombre+' '+elem.primer_apellido+' '+elem.segundo_apellido+'</option>';
                });
                $('#modelos').html($option);
            }); 
        });
	});
</script>
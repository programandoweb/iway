<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array('ciclos_id' => (isset($row->ciclos_id))?$row->user_id:'');
echo form_open(current_url(),array('aja' => 'true'),$hidden); ?>
<input type="hidden"  require="true" value="1"/>
<div class="container">
	<div class="row form-group">
        <div class="col-md-3 text-right">
            <b>Mes *</b>
        </div>
        <div class="col-md-6">	
            <?php 
                echo MakeMes("mes",null,intval(date('m')));
            ?>
        </div>
        <div class="advertencia offset-md-4 col-md-6"></div>
    </div>
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	             
                <?php 
					if($this->user->periodo_pagos==2){
						$semana		=	"Quicena";	
					}else if($this->user->periodo_pagos==4){
						$semana		=	"Semana";
					}	
					for($a=1;$a<=$this->user->periodo_pagos;$a++){
				?>
                	<div class="row form-group">
                        <div class="col-md-4 text-right">
                            <div>   
                                <input class="form-control" type="text" value="<?php echo $semana;?> #<?php echo $a;?>" readonly="readonly" name="nombre[]"  />
                            </div>
                            <div class="advertencia"></div>                        
                        </div>                    
                        <div class="col-md-4">
                            <div>	
	                           <?php  echo select_dias("desde",NULL,array("inicio"=>1,"fin"=>32),array("class"=>"form-control fechas verify","id"=>"desde".$a),"Fecha desde");?>
                        	   <input name="fecha_desde[]" value="" id="fecha_desde<?php echo $a;?>" placeholder="AAAA-MM-DD" class="form-control" type="hidden" readonly="readonly" require=true>
                            </div>
                            <div class="advertencia"></div>
                        </div>
                        <div class="col-md-4">
                            <div>	
	                           <?php  echo select_dias("hasta",NULL,array("inicio"=>1,"fin"=>32),array("class"=>"form-control fechas verify","id"=>"hasta".$a),"Fecha Hasta");?>
	                           <input name="fecha_hasta[]" value="" id="fecha_hasta<?php echo $a;?>" placeholder="AAAA-MM-DD" class="form-control" type="hidden" readonly="readonly" require=true>
                            </div>
                            <div class="advertencia"></div>
                        </div>
                    </div>
                <?php }?>
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
        validar_form_sin_require(".verify");
        var inactivo = $("#invalido").val();
        $('#mesese').change(function(){
            var dias = '<?php echo date("Y"); ?>';
            var numerodias = diasEnUnMes($(this).val(),dias);
            var options = $('option');
            options.each(function(){
                var obj = $(this).val();
                if(obj > numerodias){
                    $(this).hide();
                }
            });
            if( $(this).val() < inactivo){
                make_message("Importante","este mes no puede ser seleccionado");
                $('#mesese').val('');
            }
        });

        $('.fechas').keyup(function(){
            $(this).val('');
        });

		$(".fechas").change(function(){
            var year_old = parseInt('<?php echo date("Y") ?>');
            var year     = year_old;
            var mes      = '<?php echo date("m") ?>';
            if($("#mesese").val() < 12 && mes == 12 ){
                year = year_old + 1;
            }
			var dia	=	0;
			if($(this).val()<10){
				dia	=	year+"-"+ $("#mesese").val()+"-0"+$(this).val(); 	
			}else{
				dia	=	year+"-"+ $("#mesese").val()+"-"+$(this).val(); 	
			}
			$("#fecha_"+$(this).attr("id")).val(dia);
		});	
	})
</script>
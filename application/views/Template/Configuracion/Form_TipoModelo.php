<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	@json_decode(get_form_control(current_url())[0]->data);
echo form_open(current_url(),array('aja' => 'true')); ?>
<input type="hidden"  require="true" value="1"/>
<div class="container">
	<div class="form-group item">
        <div class="col-md-12 text-center">	
            <h4>Configuración tipo de modelo </h4>
        </div>
    </div>
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
                <div id="clonar">
                    <div class="row form-group">                    
                        <div class="col-md-11">
                            <input type="text" class="form-control" placeholder="Tipo de modelo">
                        </div>
                        <div class="btn btn-primary clonar" style="cursor:pointer;">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div id="mensaje" class="col-md-12 mt-2"></div>
                    </div>
                    <?php
                        if(!empty($row->Tipo_modelo)){
                            $select = '';
                            foreach ($row->Tipo_modelo as $k => $v) {
                                echo '<div class="row form-group">
                                        <div class="col-md-11">
                                            <input type="text" name="Tipo_modelo[]" class="form-control" placeholder="Tipo de modelo" value="'.$v.'" readonly="readonly"></div><div class="btn btn-primary remove" style="cursor:pointer;"><i class="fa fa-trash"></i></div><div id="mensaje" class="col-md-12 mt-2"></div></div>';
                                foreach ($row->select_tipo_modelo as $k2 => $v2){
                                    if($v == $v2){
                                        $select .= '<label id="'.$v2.'" class="custom-control custom-checkbox col-md-12 hover"><input type="checkbox" checked name="select_tipo_modelo[]" value="'.$v2.'" class="custom-control-input"><span class="custom-control-indicator"></span> <h6 class="p-1">'.$v2.'</h6></label>';
                                    }else{
                                        $select .= '<label id="'.$v.'" class="custom-control custom-checkbox col-md-12"><input type="checkbox" name="select_tipo_modelo[]" value="'.$v.'" class="custom-control-input"><span class="custom-control-indicator"></span> <h6 class="p-1">'.$v.'</h6></label>';
                                    }
                                }

                            }
                        }
                    ?>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">
                        <b>Seleccionar tipo de Modelo</b>
                    </div>
                    <div class="col-md-8">
                        <div class="form-control" id="tipo_modelo" style="height: 150px;overflow: scroll">
                            <?php
                                if(!empty($select)){
                                    echo $select;
                                }
                            ?>
                        </div>
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
        $('.remove').click(function() {
            var id = $(this).parent('.form-group').find('input').val();
            $(this).parent('.form-group').remove();
            $('#'+id).remove();
        });
        $('.clonar').click(function(){
            var input = $(this).parent('.form-group').find('input');
            console.log(input);
            if(input.val() == ""){
                $('#mensaje').html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> El campo esta vacio por favor agrege informacion para continuar.</div>');
            }else{
                $('#mensaje').html('');
                var clone = $('<div class="row form-group"><div class="col-md-11"><input type="text" name="Tipo_modelo[]" class="form-control" placeholder="Tipo de modelo" value="'+input.val()+'" readonly="readonly"></div><div class="btn btn-primary remove" style="cursor:pointer;"><i class="fa fa-trash"></i></div><div id="mensaje" class="col-md-12 mt-2"></div></div>');
                var cloneSelect = $('<label class="custom-control custom-checkbox col-md-12"><input type="checkbox" name="select_tipo_modelo[]" value="'+input.val()+'" class="custom-control-input"><span class="custom-control-indicator"></span> <h6 class="p-1">'+input.val()+'</h6></label>');
                $('#clonar').append(clone);
                $('#tipo_modelo').append(cloneSelect);
                input.val('');
                clone.find('.remove').click(function() {
                    $(this).parent('.form-group').remove();
                    $(cloneSelect).remove();
                });
            }
        });
    });
</script>
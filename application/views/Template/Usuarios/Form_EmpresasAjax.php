<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
	$row		=	$this->Usuarios->result;
?>
	<div class="row form-group">
        <div class="col-md-6 text-right">	
            <b>Centro de Costos *</b>
        </div>
        <div class="col-md-6">
            <?php  echo MakeUsers("centro_de_costos",@$row->centro_de_costos,array("class"=>"form-control","require"=>"require","pgrw-ajax"=>"{url:'".base_url("Usuarios/GetEmpresasAjax")."',contenedor:'#contenedor_ajax'}"),$this->dep_users);?>
        </div>
    </div>
	<div class="row form-group item" >
        <div class="col-md-6 text-right">	
            <b>Room de Transmisión *</b>
        </div>
        <div class="col-md-6">	
            <?php
                print_r($this->atributos_sedes);
            ?>
        </div>
	</div>                
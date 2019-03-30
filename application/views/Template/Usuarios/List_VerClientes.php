<?php
$modulo		=	$this->ModuloActivo;
 if($this->uri->segment(5) == "Activos"){
        $row    = @$this->$modulo->result["Activos"][0];
      }else{
        $row    = @$this->$modulo->result["Inactivos"][0];
      }
?>

<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-12">
		            <h4 style="font-family: 'Oswald', sans-serif;" class="font-weight-700 text-uppercase orange">
                    	Datos del Cliente
					</h4>
                </div>
            </div>
            <!--<div class="row separar">
            	<div class="col-md-6 text-right">
		           Empresa
                </div>
                <div class="col-md-6">
                    <b>
	             <?php print_r(@$row->nombre_comercial);?>
                    </b>
                </div>
			</div> -->               
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Naturaleza e identificación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo @$row->naturaleza;?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Tipo identificación
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo @tip_identificacion( @$row->tipo_identificacion)->tipo_identidad;?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Identificación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->numero_identificacion))?$row->numero_identificacion:''?>
                        <?php echo (isset($row->identificacion_ext))?"-".$row->identificacion_ext:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Nombre legal
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->nombre_legal))?@$row->nombre_legal:''?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Nombre comercial
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->nombre_comercial))?@$row->nombre_comercial:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Nombre Representante Legal
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->nombre_legal))?@$row->nombre_legal:''?>
                    </b>
                </div>
			</div>
            <div class="row separar">
                <div class="col-md-6 text-right">
		          	Idenficación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->nro_identificacion_representante_legal))?@$row->nro_identificacion_representante_legal:''?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
                 	Ciudad Exp.
				</div>                    
				<div class="col-md-6">
                    <b>
						<?php echo @ciudad_expedicion(isset($row->ciudad_expedicion) ?@$row->ciudad_expedicion:'')->union ?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Dirección
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->direccion))?$row->direccion:''?>
                    </b>
                </div>
            </div>
                   
			
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Teléfono Móvil
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->telefono))?@$row->telefono:''?>
                    </b>
                </div>
			</div>
      <div class="row separar">                
                <div class="col-md-6 text-right">
		          	Rol / Cargo
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo @rol(isset($row->rol_id)? $row->rol_id:'')->rol ?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Website
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->pagina_web))?$row->pagina_web:''?>
                    </b>
                </div>
            </div>
            <!--<div class="row separar">
            	<div class="col-md-3 text-center">
		           Mañana
                   <?php echo (isset($row->turno_manama)&& @$row->turno_manama==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Tarde
                   <?php echo (isset($row->turno_tarde)&& @$row->turno_tarde==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Noche
                   <?php echo (isset($row->turno_noche)&& @$row->turno_noche==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Intermedio
                   <?php echo (isset($row->turno_intermedio)&& @$row->turno_intermedio==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
            </div>-->
        </div>
    </div>
</div>
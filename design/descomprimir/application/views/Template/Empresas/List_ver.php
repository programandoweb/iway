<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	$row		=	$this->$modulo->result;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-12">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	Datos de la Empresa
					</h4>
                </div>
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Empresa
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php print_r($row->nombre_legal);?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Naturaleza e identificación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo $row->tipo_persona;?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Tipo identificación
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo $row->tipo_identificacion;?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Identificación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->identificacion))?$row->identificacion:''?>
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
	                    <?php echo (isset($row->nombre_legal))?$row->nombre_legal:''?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Nombre comercial
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->nombre_comercial))?$row->nombre_comercial:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Nombre Representante Legal
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->nombre_representante_legal))?$row->nombre_representante_legal:''?>
                    </b>
                </div>
			</div>
            <div class="row separar">
                <div class="col-md-6 text-right">
		          	Idenficación
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->nro_identificacion_representante_legal))?$row->nro_identificacion_representante_legal:''?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
                 	Ciudad Exp.
				</div>                    
				<div class="col-md-6">
                    <b>
						<?php echo (isset($row->ciudad_expedicion_legal))?$row->ciudad_expedicion_legal:''?>
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
		          	Nombre comercial
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->ciudad))?$row->ciudad:''?>
                    </b>
                </div>
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Dpto
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->departamento))?$row->departamento:''?>
                    </b>
                </div> 
			</div>                
			<div class="row separar">                
                <div class="col-md-6 text-right">
		          	Cod Postal
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->codigo_postal))?$row->codigo_postal:''?>
                    </b>
                </div>
			</div>
            <div class="row separar">                
                <div class="col-md-6 text-right">
		          	País
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->pais))?$row->pais:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Teléfono Móvil
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->cod_telefono))?$row->cod_telefono:''?><?php echo (isset($row->telefono))?$row->telefono:''?>
                    </b>
                </div>
			</div>
            <div class="row separar">                
                <div class="col-md-6 text-right">
		          	Otro Teléfono
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->cod_otro_telefono))?$row->cod_otro_telefono:''?><?php echo (isset($row->otro_telefono))?$row->otro_telefono:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">                
                <div class="col-md-6 text-right">
		          	Skype
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->skype))?$row->skype:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Facebook
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->facebook))?$row->facebook:''?>
                    </b>
                </div>
			</div>
            <div class="row separar">                
                <div class="col-md-6 text-right">
		          	Twitter
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->twitter))?$row->twitter:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Persona Contacto
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->persona_contacto))?$row->persona_contacto:''?>
                    </b>
                </div>
			</div>
            <div class="row separar">                
                <div class="col-md-6 text-right">
		          	Rol / Cargo
                </div>
                <div class="col-md-6">
                    <b>
						<?php echo (isset($row->rol_cargo))?$row->rol_cargo:''?>
                    </b>
                </div>                
            </div>
            <div class="row separar">
            	<div class="col-md-6 text-right">
		           Website
                </div>
                <div class="col-md-6">
                    <b>
	                    <?php echo (isset($row->website))?$row->website:''?>
                    </b>
                </div>
            </div>
            <div class="row separar">
            	<div class="col-md-3 text-center">
		           Mañana
                   <?php echo (isset($row->turno_manama)&& $row->turno_manama==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Tarde
                   <?php echo (isset($row->turno_tarde)&& $row->turno_tarde==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Noche
                   <?php echo (isset($row->turno_noche)&& $row->turno_noche==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
                <div class="col-md-3 text-center">
		           Intermedio
                   <?php echo (isset($row->turno_intermedio)&& $row->turno_intermedio==1)?'<BR><B>SI</B>':'<BR><B>NO</B>'?>
                </div>
            </div>
        </div>
    </div>
</div>
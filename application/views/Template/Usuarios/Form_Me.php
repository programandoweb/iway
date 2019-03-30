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
$hidden 	= 	array('type'=>$this->uri->segment(3),'user_id' => (isset($row->user_id))?$row->user_id:'',"redirect"=>base_url("Empresas/Listado"));
echo form_open(current_url(),array('aja' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información Básica</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre página *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("primer_nombre",$row,$placeholder='Naturaleza e identificación',$require=true);?>
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Nombre Legal *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nombre_legal",$row,$placeholder='Nombre Legal',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Tipo de Página *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeTipoPagina("tipo_persona",(isset($row->tipo_persona))?$row->tipo_persona:NULL,array("class"=>"form-control","require"=>"require"));?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Moneda de Pago *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeMonedaPago("moneda_de_pago",(isset($row->moneda_de_pago))?$row->moneda_de_pago:NULL,array("class"=>"form-control","require"=>"require"));?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Equivalencia *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php echo MakeEquivalencia("",(isset($row->equivalencia))?$row->equivalencia:NULL,array("id"=>"id_equivalencia","class"=>"form-control","require"=>"require"));?>
                        <br />
                        <input type="text" class="form-control" name="equivalencia" id="equivalencia" value="<?php echo (isset($row->equivalencia))?$row->equivalencia:"";?>" readonly="readonly" />
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Dirección *</b>
                    </div>
                    <div class="col-md-9">	
                        <input type="text" class="form-control" name="direccion"  placeholder="Dirección" maxlength="200" value="<?php echo (isset($row->direccion))?$row->direccion:''?>" require   />
                    </div>
                    <div class="row  sub-item">
                    	<div class="col-md-12">
                            <div class="input-group input-group-sm" style="padding:15px;">
                                <input type="text" class="form-control col-md-3" name="ciudad"  placeholder="Ciudad" maxlength="50"  value="<?php echo (isset($row->ciudad))?$row->ciudad:''?>" require />
                                <input type="text" class="form-control col-md-3" name="departamento"  placeholder="Departamento" maxlength="50"  value="<?php echo (isset($row->departamento))?$row->departamento:''?>" require />
                                <input type="text" class="form-control col-md-2" name="codigo_postal"  placeholder="Código Postal" maxlength="10"  value="<?php echo (isset($row->codigo_postal))?$row->codigo_postal:''?>" require />
                                <input type="text" class="form-control col-md-4" name="pais"  placeholder="País" maxlength="20"  value="<?php echo (isset($row->pais))?$row->pais:''?>" require />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado del Perfil</b>
                    </div>
                    <div class="col-md-3">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
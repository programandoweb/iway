<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/?>
<?php 
$modulo     =   $this->ModuloActivo;
$row        =   $this->$modulo->result;
$hidden     =   array('user_id' => $this->uri->segment(3),'campo' => "firma","redirect"=>base_url($this->uri->segment(1)."/Firma"));
echo form_open_multipart(current_url(),array(),$hidden); ?>
<div class="container" style="margin-bottom:100px;">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="form">
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <h3>Subir Firma</h3>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Nombre completo firmante: *</b>
                    </div>
                    <div class="col-md-6">
                        <?php set_input("NombreFirmante",@$row,$placeholder='Nombre Completo Firmante',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Titulo o cargo: *</b>
                    </div>
                    <div class="col-md-6">
                        <?php set_input("Imagen_a_subir",@$row,$placeholder='Imagen a Subir',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Documento identificación: *</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo MakeTipoIdentificacion2('DocumentoIdentificacion','',array('Class'=>'form-control')); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Número documento: *</b>
                    </div>
                    <div class="col-md-6">
                        <?php set_input("NumeroDocumento",@$row,$placeholder='Numero Documento',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Ciudad expedición: *</b>
                    </div>
                    <div class="col-md-6">
                        <?php echo expedicion('','union','Ciudad de expedicion',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Imagen Firma a Subir *</b>
                    </div>
                    <div class="col-md-6">
                        <input title="Tamaño máximo permitido 100Kb" data-filetype='var filestype = new Array(".gif", ".jpg", ".png", ".jpeg")' data-sizemax="100000" type="file" id="userfile" name="userfile" placeholder="Imagen a Subir" require >
                    </div>
                </div>
                <div class="row form-group">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Importante</h4>
                        <p>Las imágenes sólo serán permitidas con un máximo peso 100Kb y tamaño máximo de 1024px x 768px</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url($this->uri->segment(1).'/Firma');?>"><i class="fas fa-times"></i> Cerrar y Volver</a>
                        </div>                        
                    </div>
                </div>                   
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>
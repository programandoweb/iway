<?php
$modulo = $this->ModuloActivo;
$row = @json_decode($this->$modulo->result[0]->data);
echo form_open_multipart(current_url()."/49",array('ajaxing' => 'true'));   ?>
<script>
    $( function() {
        $( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
        $( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        $("#Fecha").val('<?php echo @$row->Fecha ?>');
    });
</script>
<div class="container" style="margin-bottom:100px;">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="form">
                <div class="row form-group item">
                    <div class="col-md-12 text-center">
                        <h3>Información Aspirante</h3>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Sede *</b>
                    </div>
                    <div class="col-md-6"> 
                        <?php 
                            echo MakeSucursal($this->user->id_empresa,"Sede",@$row->Sede,array("class"=>"form-control", "require"=>"require"));
                        ?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Fecha *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php set_input("Fecha",@$row->Fecha,$placeholder='AAAA-MM-DD',true,"datepicker");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Hora *</b>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4"><?php echo MakeHora("hora",@$row->hora,array("class"=>"form-control")).' - '; ?></div>
                            <div class="col-md-4"><?php echo MakeMinutos("minutos",@$row->minutos,array("class"=>"form-control")); ?></div>
                            <div class="col-md-4"><?php echo MakeMeridiano("meridiano",@$row->meridiano,array("class"=>"form-control")); ?></div>
                        </div>  
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Foto *</b>
                    </div>
                    <div class="col-md-6">  
                        <input id="foto" type="file" name="foto" style="display: none;">
                        <i class="fa fa-file" id="file" style="cursor: pointer;">  click aqui para subir foto</i>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Nombre Aspirante *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php 
                            set_input("Nombre",@$row,"Nombre del aspirante");
                        ?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Edad *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php 
                            set_input("Edad",@$row,"Edad");
                        ?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Telefono *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php 
                            set_input("Telefono",@$row,"Telefono");
                        ?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Experiencia *</b>
                    </div>
                    <div class="col-md-6">  
                    <div class="row">
                    <div class="col-md-2">
                    <h6>Si</h6>
                    <?php 
                          set_input_radio('experiencia','','SI',(@$row->experiencia == "SI")?true:false,'custom-control-input check', '');
                        ?>
                     </div> 
                     <div class="col-md-2">
                     <h6>NO</h6>
                    <?php  set_input_radio('experiencia','','NO',(@$row->experiencia == "NO")?true:false,'custom-control-input check', ''); ?>
                    <?php if(!empty($this->$modulo->result[0]->id_form_contrl)){ ?>
                        <input type="hidden" name="id_form_contrl" value="<?php echo $this->$modulo->result[0]->id_form_contrl; ?>">
                        <input type="hidden" name="consecutivo" value="$this->$modulo->result[0]->consecutivo">
                    <?php } ?>
                     </div> 
                     </div>
                    </div>
                   </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Observaciones *</b>
                    </div>
                    <div class="col-md-6">  
                        <textarea name="ObservacionAspirante" class="form-control">
                        </textarea>
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
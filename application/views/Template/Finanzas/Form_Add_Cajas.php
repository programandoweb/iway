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
$hidden = array('id_caja' => (isset($row->id_caja))?$row->id_caja:'',"redirect"=>base_url("Finanzas/Cajas"));

echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}
	set_input_hidden("id_empresa","id_empresa",$this->user->id_empresa);
	set_input_hidden("centro_de_costos","centro_de_costos",$this->user->centro_de_costos);		
?>
<div class="container" style="margin-bottom:100px;">	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Maestro Cajas</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre de Caja *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nombre_caja"  placeholder="Nombre de Caja" value="<?php echo (isset($row->nombre_caja))?$row->nombre_caja:''?>" require/>
                    </div>
                </div>
             
                <?php if (isset($row->codigo_contable)){?>
                <?php if ($row->codigo_contable!='110505'){?>
               <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Tipo de caja *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo makeTipoCaja("Tipo_de_Caja",@$row->Tipo_de_Caja,array("class"=>"form-control","id"=>"Tipo_de_Caja")) ?>
                    </div>
                </div>
                <?php }?>
                <?php }else{?>  
                    <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Tipo de caja *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo makeTipoCaja("Tipo_de_Caja",@$row->Tipo_de_Caja,array("class"=>"form-control","id"=>"Tipo_de_Caja")) ?>
                    </div>
                </div>
                <?php }?>  

                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Código Contable *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" id="codigo_contable" class="form-control" name="codigo_contable"  placeholder="Código Contable" maxlength="6" value="<?php echo (isset($row->codigo_contable))?$row->codigo_contable:''?>" readonly="readonly" require/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">   
                        <b>Responsable *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo Autocomlete_Usuarios($row,$type = array("Modelos","Monitores","Administrativos","Asociados"),'',array("class"=>"form-control"),'id_responsable') ?>
                    </div>
                </div>
                <!--div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Responsable *</b>
                    </div>
                    <div class="col-md-6">	
                         <?php  echo MakeUsersNoRoot("id_responsable",@$row->id_responsable,array("class"=>"form-control"),$this->users);?>
                    </div>
                </div-->
                <?php if (isset($row->codigo_contable)){?>
                <?php if ($row->codigo_contable!='110505'){?>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado</b>
                    </div>
                    <div class="col-md-6">
                         <?php
                            if($this->uri->segment(3) == 1){
                                $readonly = array("class"=>"form-control","disabled"=>"disabled");
                            }else{
                                $readonly = array("class"=>"form-control");
                            }
                        ?>	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,$readonly);?>
                    </div>
				</div>
                <?php 
                }else{
                  ?>
            <input type="hidden" name="estado"   value="1" />
                <?php 
                     
                    }
                    
                     ?> 
                 <?php }else{?> 
                    <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado</b>
                    </div>
                    <div class="col-md-6">
                         <?php
                            if($this->uri->segment(3) == 1){
                                $readonly = array("class"=>"form-control","disabled"=>"disabled");
                            }else{
                                $readonly = array("class"=>"form-control");
                            }
                        ?>	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,$readonly);?>
                    </div>
				</div>
                <?php }?>  
                <?php
                    if($this->uri->segment(3) == 1){
                ?>
                <div class="form-group item">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Importante; </h4>
                        <p>Caja solo puede ser inactivada cuando su saldo es igual a cero.</p>
                    </div>
                </div> 
                <?php
                    }
                ?>
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
<script>
    $(document).ready(function(){
        $('#Tipo_de_Caja').change(function(){
            if($(this).val() == "Caja principal"){
                $('#codigo_contable').val(110505);
            }else if($(this).val() == "Caja menor"){
                $('#codigo_contable').val(110510);
            }else if($(this).val() == "Caja moneda extranjera"){
                $('#codigo_contable').val(110515);
            }else{
                $('#codigo_contable').val('');
            }
        });
    });
</script>
<?php
    $m  = 'Administrativo';

    $hidden   =   array('user_id' => (isset($row->user_id))?$row->user_id:'','id' =>(isset($row->id))?$row->id:'',);
    echo form_open(current_url(),array('ajaxing' => 'true'),$hidden); 
?>
    
<div class="container mt-4">
        <div id="smartwizard">
            <ul class="d-flex justify-content-around">
                   <li><a href="#step-1"><i class="fas fa-user"></i><br /><small>Información producto</small></a></li>
                   <li><a href="#step-2"><i class="fas fa-comment"></i><br /><small>Contacto</small></a></li>
                   <li><a href="#step-3"><i class="fas fa-cogs"></i><br /><small>Configuración</small></a></li>
            </ul>
        <div>
         <div id="step-1" >
               <div class="container" style="margin-bottom:100px;">
                      <div class="row justify-content-md-center">
                             <div class="col-md-8">
                                 <div class="form">
                                     <div class="row form-group">
                                          <div class="col-md-6">
                                               <label for="Inventariable">Inventariable *</label>  
                                               <?php echo MakeSiNo("inventariable",@$row->declara_renta,array("class"=>"form-control"));?>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="Inventariable">Tipo de articulo *</label>  
                                             <?php echo set_input("tipo_articulo",@$row->direccion,$placeholder='Tipo de articulo',$require=true,"firstLetterText");?>
                                          </div>
                                     </div>
                                     <div class="row form-group">
                                          <div class="col-md-6">
                                               <label for="Inventariable">Codido de barrras</label>  
                                               <?php echo set_input("codigo_barra",@$row->codigo_barra,$placeholder='Codido de barras',$require=true,"firstLetterText");?>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="Inventariable">Referencias *</label>  
                                            <?php echo set_input("referencia",@$row->direccion,$placeholder='Referencia',$require=true,"firstLetterText");?>
                                          </div>
                                     </div>
                                     <div class="row form-group">
                                          <div class="col-md-6">
                                               <label for="Inventariable">Descripción</label>  
                                               <?php echo set_input("descripcion",@$row->codigo_barra,$placeholder='Descripcion',$require=true,"firstLetterText");?>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="Inventariable">Marca *</label>  
                                            <?php echo set_input("marca",@$row->direccion,$placeholder='Marca',$require=true,"firstLetterText");?>
                                          </div>
                                     </div>
                                 </div>
                             </div>
                      </div> 
                     
               </div> 
              
         </div>
          <div id="step-2" >
              <div class="container" style="margin-bottom:100px;">
                      <div class="row justify-content-md-center">
                             <div class="col-md-8">
                                 <div class="form">
                                     <div class="row form-group">
                                          <div class="col-md-6">
                                               <label for="Inventariable">Foto producto *</label>  
                                               <?php echo set_input("foto_producto",@$row->direccion,$placeholder='Tipo de articulo',$require=true,"firstLetterText");?>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="Inventariable">Lineas *</label>  
                                             <?php echo set_input("linea",@$row->direccion,$placeholder='Tipo de articulo',$require=true,"firstLetterText");?>
                                          </div>
                                     </div>
                                     <div class="row form-group">
                                          <div class="col-md-6">
                                               <label for="Inventariable">Unidad de medida</label>  
                                               <?php echo set_input("unidad_de_medida",@$row->codigo_barra,$placeholder='Codido de barras',$require=true,"firstLetterText");?>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="Inventariable">Referencias *</label>  
                                            <?php echo set_input("se_compra",@$row->direccion,$placeholder='Referencia',$require=true,"firstLetterText");?>
                                          </div>
                                     </div>
                                     <div class="row form-group">
                                          <div class="col-md-6">
                                               <label for="Inventariable">retencion</label>  
                                               <?php echo set_input("Referencias",@$row->codigo_barra,$placeholder='Codido de barras',$require=true,"firstLetterText");?>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="Inventariable">Se vende *</label>  
                                            <?php echo set_input("se_vende",@$row->direccion,$placeholder='Referencia',$require=true,"firstLetterText");?>
                                          </div>
                                     </div>
                                 </div>
                             </div>
                      </div> 
                     
               </div> 
        </div> 

        <div id="step-3" >
              <div class="container" style="margin-bottom:100px;">
                      <div class="row justify-content-md-center">
                             <div class="col-md-8">
                                 <div class="form">
                                     <div class="row form-group">
                                          <div class="col-md-6">
                                               <label for="Inventariable">Tarifa iva *</label>  
                                               <?php echo set_input("tarifa_iva",@$row->direccion,$placeholder='Tipo de articulo',$require=true,"firstLetterText");?>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="Inventariable">Precio de venta *</label>  
                                             <?php echo set_input("precio_venta",@$row->direccion,$placeholder='Tipo de articulo',$require=true,"firstLetterText");?>
                                          </div>
                                     </div>
                                     <div class="row form-group">
                                          <div class="col-md-6">
                                               <label for="Inventariable">Cantidad inicial</label>  
                                               <?php echo set_input("cantidad_inicial",@$row->codigo_barra,$placeholder='Codido de barras',$require=true,"firstLetterText");?>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="Inventariable">Costo inicial *</label>  
                                            <?php echo set_input("costo_inicial",@$row->direccion,$placeholder='Referencia',$require=true,"firstLetterText");?>
                                          </div>
                                     </div>
                                 </div>
                             </div>
                      </div> 
                     
               </div> 
        </div>           
    </div>
  </div>

</div>
<?php echo form_close();?>

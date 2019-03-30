
<?php
//pre($this->user)
$modulo   = $this->ModuloActivo;
  if($this->uri->segment(4) == "Activos"){
    $row    = $this->$modulo->result["Activos"][0];
  }else{
    $row    = $this->$modulo->result["Inactivos"][0];
  }
 // pre($row);
 $hidden   =   array('id' => (isset($row->id))?$row->id:'');
?>


<div class="container mt-4 tab-pane fade show active"  id="home" role="tabpanel" aria-labelledby="home-tab">
       <?php 
        echo form_open(current_url(),array('ajaxing' => 'true'),$hidden); ?>
      <div id="step-1" class="">
                <script>
                     $( function() {
                        $('[name="dias_pago"]').SoloNumeros();
                    });
                  </script>
            <div class="container formas-pago" style="margin-bottom:100px;">
                    <div class="row justify-content-md-center">
                          <div class="col-md-8"> 
                              <div class="row form-group">
                                    <div class="col-md-6">
                                          <label for="ciudad_expedicion">Forma de pago *</label>
                                            <?php echo set_input("forma_pago", (isset($row->forma_pago))?$row->forma_pago:'',  $placeholder="Forma de pago",$require=true,'',array("id"=>"forma_pago"));?>
                                    </div>
                                     <div class="col-md-6">
                                          <label for="ciudad_expedicion">Dias de pago *</label>
                                            <?php echo set_input("dias_pago", (isset($row->dias_pago))?$row->dias_pago:'',  $placeholder="Dias de pago",$require=true,'',array("id"=>"forma_pago"));?>
                                    </div>
                               </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                           <button  id="Guaradarformas" class="btn btn-primary ">Guardar</button>
                            </div>
                        </div>
                      </div>
                    
                    </div>
                </div>

        </div><!--fin set-->
  
  
   </div>
<?php echo form_close();?>
<div class="container">
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title " style="float:right; position: absolute;">Atención</h4>
        </div>
        <div class="modal-body">
          <hr>
          <p id="text-alert"></p>
          <hr>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<script>
   $('#Guaradarformas').click(function(){
      var paramIndex = []
      var inputs =  $('.formas-pago').find('input')
      console.log(inputs);
        inputs.each(function (index, val) {
               value= val
               paramIndex[index] = val.value
            })
            var found = paramIndex.find(function (element) {
              return element === ''
            })
            if(found===undefined){
               return true
            }else{
              $("#text-alert").text("Debe completar todos los campos")
              $('#myModal').modal('show');
              return false
            }

      return false;
   });
</script>
<style>
  .btn.btn-primary, .btn-primary.custom-file-control::before {
    color: white;
    background-color: #414141;
    border-color: #ccc;
    text-transform: none;
  }

  
  
  </style> 
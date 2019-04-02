<?php
$modulo		=	$this->ModuloActivo;
?>
<?php if(count($this->$modulo->result["observacion"])>0){?>
<div class="container section" style="font-size: 12px;">
  <div class="bg-faded text-left">
    <h4 class="p-4 font-weight-700 text-uppercase orange">DATOS DE CLIENTE</h4>
  </div>
  <div class="mt-4 row">
    <div class="mt-4 col-md-4">
      <b>Empresa </b>
      <?php echo $this->$modulo->result["observacion"]->empresa; ?> 
    </div>
    <div class="mt-4 col-md-4">
      <b>Persona de Contacto </b>
      <?php echo $this->$modulo->result["observacion"]->persona_contacto; ?> 
    </div>
    <div class="mt-4 col-md-4">
      <b>Telefono </b>
      <?php echo $this->$modulo->result["observacion"]->telefono; ?> 
    </div>
    <div class="mt-4 col-md-4">
      <b>Email </b>
      <?php echo $this->$modulo->result["observacion"]->email; ?> 
    </div>
    <div class="mt-4 col-md-4">
      <b>Ciudad </b>
      <?php echo $this->$modulo->result["observacion"]->ciudad; ?> 
    </div>
    <div class="mt-4 col-md-2">
      <b>ASOCEA </b>
      <?php echo SiNo($this->$modulo->result["observacion"]->asocea);?> 
    </div>
    <div class="mt-4 col-md-2">
      <b>Red|Ben </b>
      <?php echo SiNo($this->$modulo->result["observacion"]->redben); ?> 
    </div>
  </div>
</div>
<div class="container section" style="font-size: 12px">
  <ul class="nav nav-tabs" role="tablist">
             <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#observacion" role="tab" style="margin:0px,padding:0px">
                        Observaciones. 
                    </a>
             </li>
             <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#incidencias" role="tab">
                        Insidencias.
                    </a>
             </li>
  </ul>
	<div class="tab-content row justify-content-md-center">
    	<div id="observacion" class="tab-pane active col-md-12" role="tabpanel">
            <div class="row">
            	<div class="col-md-12" aria-label="breadcrumb">   
                    <div class="breadcrumb">
                        <?php
                        if(!empty($this->$modulo->result["observacion"]->observacion)){
                         echo $this->$modulo->result["observacion"]->observacion;
                        }else{
                         echo "no se ha encontrado ninguna Observacion"; 
                        } ?>
                    </div>
<?php        
    } 
?>                      
              </div>
            </div>
      </div>
      <div id="incidencias" class="tab-pane col-md-12" role="tabpanel">
            <div class="row">
              <div class="col-md-12" aria-label="breadcrumb">   
                    <?php
                        if(count($this->$modulo->result["Incidencias"])>0){
                           foreach($this->$modulo->result["Incidencias"] as $v){
                    ?>
                      <div class="breadcrumb"><?php echo $v->observacion ?></div>

                    <?php        
                           }
                        }else{
                        echo '<div class="breadcrumb">No se ha encontrado ninguna insidencia para este cliente</div>';
                        } 
                    ?>

              </div>
            </div>
      </div>
  </div>
</div>

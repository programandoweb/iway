<?php
    $modulo = $this->ModuloActivo;
?>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col">
      <?php
        $submenu = array("name"     =>  array(  "title" =>  $this->ModuloActivo.".",
                                                "url"   =>  current_url()),
                                                "add"   =>  array(  "title" =>  "Agregar empresa",
                                                                    "url"   =>  base_url($this->uri->segment(1)."/Add"),
                                                                    "lightbox"=>true),
                                                                  );
        echo TaskBar($submenu);
      ?>
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#activo" role="tab">
            Activo
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#inactivo" role="tab">
            Inactivo
          </a>
        </li>
      </ul>
      <div class="justify-content-md-center tab-content" id="imprimeme">
        <div id="activo" class="tab-pane active col-md-12" role="tabpanel">
          <div class="row">
            <div class=" col-md-12">
              <div class="container  mt-2 mb-5">
              	<div class="row justify-content-md-center">
              		<div class="col">
              			<div class="row filters uniformidad">
              				<div class="col-md-12">
                       	<table  class="display tablas_listados"  data-url="<?php echo current_url().'?estado=1'?>" style="width:100%" >
                            <thead>
                                <tr>
                                	<?php
              											echo columnas($this->campos);
              										?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                   <?php
              										 	echo columnas($this->campos);
              											?>
                                </tr>
                            </tfoot>
                        </table>
              				</div>
              			</div>
              		</div>
              	</div>
              </div>
            </div>
          </div>
        </div>
        <div id="inactivo" class="tab-pane col-md-12" role="tabpanel">
          <div class="row">
            <div class=" col-md-12">
              <div class="container  mt-2 mb-5">
              	<div class="row justify-content-md-center">
              		<div class="col">
              			<div class="row filters uniformidad">
              				<div class="col-md-12">
                       	<table  class="display tablas_listados" data-url="<?php echo current_url().'?estado=0'?>" style="width:100%">
                            <thead>
                                <tr>
                                	<?php
              											echo columnas($this->campos);
              										?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                   <?php
              										 	echo columnas($this->campos);
              											?>
                                </tr>
                            </tfoot>
                        </table>
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
  </div>
</div>

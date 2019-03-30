<?php
    $modulo = $this->ModuloActivo;
   // pre($this->user);
?>
<div class="container">
      <div class="row justify-content-md-center">
           <div class="col">
               <?php
                 $submenu = array("name"     =>  array(  "title" => "Ajuste contable.",
                                                            "url"   =>  current_url()),
                                    "add"       =>  array(  "title" =>  "Agregar empresa",
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
            
            </div>
        </div>
 </div>             
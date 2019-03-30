<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
$modulo     =   $this->ModuloActivo;
$row        =   $this->$modulo->result;
$config     =   null;
$empresa    =   centrodecostos($this->user->id_empresa);
@$escala_por_defecto = json_decode(get_form_control(base_url("Usuarios/configuracionEscala"),null,1)[0]->data)->Escala_por_defecto;
$seguridad        =   get_ConfigSeguridadSocial("id_cf_SeguridadSocial");
?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col">
        <?php     
            if($empresa->sistema_salarial==1){
                if(empty($seguridad)){
                    echo TaskBar(array("name"       =>  array(  "title" =>  "Escala de Pagos.",
                                                            "url"   =>  current_url()),
                                    "config"    =>  array(  "title" =>  "Configuración seguridad social",
                                                            "icono" =>  '<i class="fas fa-cogs"></i>',
                                                            "url"   =>  base_url($this->uri->segment(1)."/ConfigSeguridadSocial"),
                                                            "lightbox" => true)                         
                            )
                        );
                }else{
                    echo TaskBar(array("name"       =>  array(  "title" =>  "Escala de Pagos.",
                                                            "url"   =>  current_url()),
                                    "add"       =>  array(  "title" =>  "Agregar Escala de Pagos.",
                                                            "url"   =>  base_url($this->uri->segment(1)."/Add_Escala"),
                                                            "lightbox"=>true),
                                    "config"    =>  array(  "title" =>  "Configuración seguridad social",
                                                            "icono" =>  '<i class="fas fa-cogs"></i>',
                                                            "url"   =>  base_url($this->uri->segment(1)."/ConfigSeguridadSocial"),
                                                            "lightbox" => true)                         
                            )
                        );
                }
            }else{
                echo TaskBar(array("name"       =>  array(  "title" =>  "Escala de Pagos.",
                                                            "url"   =>  current_url()),
                                    "add"       =>  array(  "title" =>  "Agregar Escala de Pagos.",
                                                            "url"   =>  base_url($this->uri->segment(1)."/Add_Escala"),
                                                            "lightbox"=>true), 
                            )
                        );
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Activas" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Activas 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Inactivas" role="tab">
                               <i class="fas fa-angle-right"></i>  Inactivas 
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content row">
                        <div class="tab-pane active col-md-12" id="Activas" role="tabpanel">
                            <table class="ordenar display table table-hover" ordercol=0 "ASC">
                                <thead>
                                    <tr>
                                        <th width="250">
                                            Nombre
                                        </th>
                                        <?php if($empresa->sistema_salarial == 1){ ?>
                                        <th class="text-center">
                                            Meta
                                        </th>
                                        <?php } ?>
                                        <th class="text-center">
                                            Porcentaje pago
                                        </th>
                                        <th class="text-center">
                                            Acciónes
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->$modulo->result['activos'])>0){
                                            foreach($this->$modulo->result['activos'] as $v){
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $v->nombre_escala;?>
                                        </td>
                                        <?php if($empresa->sistema_salarial == 1){ ?>
                                        <td class="text-center">
                                            <?php echo format($v->meta,false);?>
                                        </td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <?php echo format($v->bonificacion); ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <a class="lightbox" title="Editar escala de pagos" data-type="iframe" href="<?php echo base_url("Ventas/Add_Escala/".$v->id_escala)?>">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <?php
                                                    if($v->nombre_escala ==@$escala_por_defecto){
                                                ?>
                                                    <i class="fas fa-toggle-off" id="No_apto" aria-hidden="true" style="cursor:pointer;"></i>
                                                <?php
                                                    }else{
                                                ?>
                                                <a title="Inactivar escala" href="<?php echo base_url("Ventas/CambiarEstado/".$v->id_escala).'/0'?>">
                                                    <i class="fas fa-toggle-off" aria-hidden="true"></i>
                                                </a>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }else{
                                    ?>
                                       
                                    <?php       
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane col-md-12" id="Inactivas" role="tabpanel">
                            <table class="ordenar display table table-hover">
                                <thead>
                                    <tr>
                                        <th width="250">
                                            Nombre
                                        </th>
                                        <?php if($empresa->sistema_salarial == 1){ ?>
                                        <th>
                                            Meta
                                        </th>
                                        <?php } ?>
                                        <th>
                                            Descuento dólar
                                        </th>
                                        <th class="text-center">
                                            Porcentaje pago
                                        </th>
                                        <th class="text-center">
                                            Acciónes
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->$modulo->result['inactivos'])>0){
                                            foreach($this->$modulo->result['inactivos'] as $v){
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $v->nombre_escala;?>
                                        </td>
                                        <?php if($empresa->sistema_salarial == 1){ ?>
                                        <td class="text-right">
                                            <?php echo format($v->meta,false);?>
                                        </td>
                                        <?php } ?>
                                        <td class="text-right">
                                            <?php echo $v->porcentaje_descuento_dolar; ?>
                                        </td>
                                        <td class="text-right">
                                            <?php echo format($v->bonificacion); ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <a class="lightbox" title="Editar escala de pagos" data-type="iframe" href="<?php echo base_url("Ventas/Add_Escala/".$v->id_escala)?>">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <a title="Activar escala" href="<?php echo base_url("Ventas/CambiarEstado/".$v->id_escala).'/1'?>">
                                                    <i class="fas fa-toggle-on" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }else{
                                    ?>
                                       
                                    <?php       
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#No_apto').click(function(){
            make_message('Importante:',"Esta escala no puede ser modificada, para inactivarla, favor ingrese al menú Gestión Humana / Escala de pagos y seleccione otra por defecto.");
        });
    });
</script>
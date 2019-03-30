<?php
	$menu					=	array();
	$menu["Maestros"]		=	array("Empresas"=>"Empresas","Departamentos"=>"Sucursales","Usuarios"=>"Usuarios");
	$me_logo				=	img_logo(@centrodecostos($this->user->id_empresa)->user_id);
	
	if(!empty($this->user->primer_nombre)&& !empty($this->user->primer_apellido)){
		$nombre=$this->user->primer_nombre.' '.$this->user->primer_apellido;
	}else if(!empty($this->user->persona_contacto)){
		$nombre=$this->user->persona_contacto;
	}else{
		$nombre=$this->user->abreviacion;
	}
	$sucursal=(centrodecostos($this->user->centro_de_costos))?"Sucursal <B>".centrodecostos($this->user->centro_de_costos)->abreviacion.'</B>':'';                      
	$img_perfil	= me_img_profile();
	
	//pre($me_logo);
?>
	
	<nav class="navbar navbar-toggleable-md bg-default hidden-md-down">
    	<button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarTopMenu" aria-controls="navbarTopMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
    	<div class="container">
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php if($this->uri->segment(1)==$this->ModuloActivo && !$this->uri->segment(2)){ echo 'active';}?>" style="margin-right:20px;">
                        <a class="nav-link">
                        	<?php
                                echo image('logo.png',true,false,array("class"=>"rounded mx-auto d-block","alt"=>'...'));
							?>
                      	</a>
                    </li> 
                    <li>
                        <form class="form-inline my-4 my-lg-2 align-middle" id="navBarSearchForm">
                        	<input class="form-control mr-sm-6" type="text" placeholder="Buscar">
                        	<button class="btn btn-outline-warning my-4 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                        </form> 
					</li> 
                </ul>
                
                <ul class="navbar-nav ml-auto col-sm-1">
                 	<li class="nav-item w100">
						<div class="pgrw_windows valor_dolar" 
                        		data-logo="<?php echo $me_logo;?>" 
                                data-nombre="<?php echo $nombre;?>" 
                                data-sucursal="<?php echo $sucursal;?>"
                                data-trm='<?php trm_vigente();?>'>
                    		<div class="img" style="background-image:url(<?php echo $img_perfil;?>)"></div>
                            <div class="contenido">
                            	<div class="item">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                    	<tr>
                                        	<td width="45%">
                                            	Ciclo termina en:<br />
												<?php 
                                                    $ciclos_pagos_end   =   get_ciclos_pagos_end();
                                                    if(!empty($ciclos_pagos_end)){
                                                ?>
                                                        <div class="reloj" data-time="<?php echo $ciclos_pagos_end->fecha_hasta;?> 23:59:59">
                                                            <table>
                                                                <tr>
                                                                    <td id="dias">00</td>
                                                                    <td id="horas">00</td>
                                                                    <td id="min">00</td>
                                                                    <td id="seg">00</td>
                                                                </tr>
                                                                <tr class="leyenda">
                                                                    <td><div >Días</div></td>
                                                                    <td><div >Horas</div></td>
                                                                    <td><div>Mins</div></td>
                                                                    <td><div >Segs</div></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                        		<?php 
													}else{
                                        		?>
                                                        <div class="reloj" data-time="2018-01-01 23:59:59">
                                                            <table>
                                                                <tr>
                                                                    <td id="dias">00</td>
                                                                    <td id="horas">00</td>
                                                                    <td id="min">00</td>
                                                                    <td id="seg">00</td>
                                                                </tr>
                                                                <tr class="leyenda">
                                                                    <td><div >Días</div></td>
                                                                    <td><div >Horas</div></td>
                                                                    <td><div>Mins</div></td>
                                                                    <td><div >Segs</div></td>
                                                                </tr>
                                                            </table>
                                                        </div>
												<?php
													}
												?>
											</td>
                                            <td width="10%"></td>
                                        	<td width="45%" valign="top">
                                    			Ciclo Producción:<br />
		                                    	<?php 
                                        			$ciclos_pagos_now=get_ciclos_pagos_now(); echo (!empty($ciclos_pagos_now))?''.$ciclos_pagos_now:'';                                
                                    			?>
                                                <?php if($this->user->type=='Modelos' || $this->user->type=='root'){?>
                                                    <a class="btn-group btn btn-default btn-sm" data-type="iframe" href="<?php echo base_url("Usuarios/verNickname/".$this->user->user_id."/edit");?>">
                                                        <i class="fa fa-key" aria-hidden="true" style="width:24px;"></i> Control de Acceso
                                                    </a>
                                                <?php }?>
                                                <?php if($this->user->type=='root' && $this->user->id_empresa>0){?>
                                                    <a class="dropdown-item text-center" href="<?php echo base_url("Usuarios/SetCentroCostos/".$this->user->user_id);?>">
                                                        <!--i class="fa fa-window-restore" aria-hidden="true"></i--> 
                                                        Restaurar
                                                    </a>
                                                <?php }?>
	
		                                    </td>
                                        </tr>                                        
									</table>                                        
                              	</div>
                                <div class="item">
                                    <div id="botones" class="btn-group btn-group-sm" role="group" aria-label="Basic example">
										<a class="btn btn-default" href="<?php echo base_url("Politicas/MostrarPoliticas");?>">
                                    		<!--i class="fa fa-window-restore" aria-hidden="true"></i--> 
                                            Politicas de servicio
                                   		</a>
                                    	<a class="btn btn-default" href="<?php echo base_url("Usuarios/ModificarClave");?>">
                                            <!--i class="fa fa-key" aria-hidden="true" style="width:24px;"></i-->
                                            Modificar Contraseña
                                        </a>
                                        <a class="btn btn-default" href="<?php echo base_url("Configuracion/ModificarImagen")?>">
                                            Modificar Imagen
										</a>
                                        <a class="btn btn-default" href="<?php echo base_url("autenticacion/salir")?>">
                                        	<!--i class="fa fa-unlock-alt" aria-hidden="true" style="width:24px;"></i--> 
                                            Salida Segura
										</a>
									</div>
                                </div>
                            </div>
                    	</div>		
                        <div id="get_datos_dolar" style="height:0; width:0; overflow:hidden;">
                        	<?php trm_vigente();?>
                        </div> 
					</li>
				</ul>
			</div>
		</div>               
	</nav>
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary yamm" id="slide-nav">
		<button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarTopMenu" aria-controls="navbarTopMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="container">
        	<?php if(1==2){?>
        	<a class="navbar-brand">
            	<img src="<?php echo DOMINIO;?>images/logo-440.png" />
			</a>
            <?php }?>
			<div class="navbar-brand">
			</div>
			<div class="collapse navbar-collapse " id="navbarTopMenu">
            	<div style="margin:0 auto;">
                    <ul class="navbar-nav mr-auto mt-2 mt-md-0 balancear">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo base_url()?>">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <?php 
                            if(!isset($this->user->menu) && $this->user->type=='root'){
                                $this->user->menu	=	menu();
                                $this->session->set_userdata(array('User'=>$this->user));
                            }else if(!isset($this->user->menu) && $this->user->type!='root'){
                                $this->user->menu	=	menu_usuarios($this->user->rol_id);
                                $this->session->set_userdata(array('User'=>$this->user));
                            }
                            //$this->user->menu		=	menu_usuarios($this->user->rol_id);
                            
                            if(isset($this->user->menu)){
                                foreach($this->user->menu['roles_modulos_padre'] as $k => $v){
                        ?>
                            <li class="dropdown yamm-fw nav-item active">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <?php 
                                        print_r($v->modulo);
                                    ?>
                                </a>
                                <?php foreach($this->user->menu['roles_modulos_hijos'][$v->id] as $k2 => $v2){?>
                                    <ul class="dropdown-menu">
                                        <li class="grid-demo">
                                            <div class="row">
                                                <?php  foreach($v2 as $k3=>$v3){?>
                                                    <div class="col-sm-4 padding">
                                                        <div class="block">
                                                            <h6>
                                                                <?php echo $v3->modulo?>
                                                            </h6> 
                                                            <?php foreach($this->user->menu['roles_modulos_nietos'][$v3->id] as $k4 => $v4){
                                                                    if($this->user->type=='root'){
                                                                ?>
                                                                    <div>                                               
                                                                        <a class="btn btn-link" href="<?php echo base_url($v4->url)?>">
                                                                            <?php echo $v4->modulo;?>                                           
                                                                        </a>
                                                                    </div>
                                                                <?php		
                                                                    }else if(array_search($v4->id,$this->user->menu['roles_modulos_permitidos'])===false){
                                                                        
                                                                    }else{
                                                                ?>
                                                                <div>                                               
                                                                    <a class="btn btn-link" href="<?php echo base_url($v4->url)?>">
                                                                        <?php echo $v4->modulo;?>                                           
                                                                    </a>
                                                                </div>
                                                            <?php }}?>
                                                        </div>
                                                    </div>
                                                <?php }?>                                                                                                    
                                            </div>
                                        </li>
                                    </ul>
                                <?php }?>
                            </li>
                        <?php	
                                }
                            }
                        ?>
                    </ul>
                    <ul class="navbar-nav ml-auto hidden-sm-up hidden-md-up">
                        <li class="nav-item dropdown <?php if($this->uri->segment(1)==$this->ModuloActivo && in_array($this->uri->segment(2), $menu["Maestros"])){echo "active";}?>">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php 	
                                        if(!empty($this->user->primer_nombre)&& !empty($this->user->primer_apellido)){
                                            echo $this->user->primer_nombre.' '.$this->user->primer_apellido;	
                                        }else if(!empty($this->user->persona_contacto)){
                                            echo $this->user->persona_contacto;
                                        }else{
                                            $this->user->abreviacion;
                                        }
                                ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="#"><i class="fa fa-key" aria-hidden="true" style="width:24px;"></i> Modificar Contraseña</a>
                                <?php 
                                    if($this->user->type=='CentroCostos' || $this->user->type=='Asociados'){?>
                                    <a class="dropdown-item" href="#"><i class="fa fa-money" aria-hidden="true" style="width:24px;"></i> Mis Planes de Pago</a>
                                <?php }?>
                                <a class="dropdown-item" href="<?php echo base_url("autenticacion/salir")?>"><i class="fa fa-unlock-alt" aria-hidden="true" style="width:24px;"></i> Salida Segura</a>
                            </div>
                        </li>                        
                    </ul>
				</div>                    
			</div>
		</div>                                                
    </nav>
<script>
	$(function() {
		window.prettyPrint && prettyPrint()
		$(document).on('click', '.yamm .dropdown-menu', function(e) {
			e.stopPropagation()
		})
	})
</script>


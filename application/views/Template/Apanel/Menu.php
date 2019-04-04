<?php
	$menu					=	array();
	$menu["Maestros"]		=	array("Empresas"=>"Empresas","Departamentos"=>"Sucursales","Usuarios"=>"Usuarios");
	$me_logo				=	img_logo(@get_empresa($this->user->empresa_id)->id);
    @$nombre = $this->user->primer_nombre.' '.$this->user->segundo_nombre.' '.$this->user->primer_apellido.' '.$this->user->segundo_apellido;
    //pre($this->user);
	$sucursal=(@get_empresa($this->user->empresa_id))?get_empresa($this->user->empresa_id)->nombre_legal.@get_empresa($this->user->empresa_id)->abreviacion.'</B>':'';
	$img_perfil	= me_img_profile();
	//pre($menu["Maestros"]);
?>
<header>
<div>
    
</div>
	<button type="button" id="sidebarCollapse" class="btn btn-info">
		<i class="fas fa-align-left"></i>
	</button>
    <button type="button" id="sidebarCollapse2" class="btn btn-info">
        <i class="fas fa-align-left"></i>
    </button>
    <button type="button" id="sidebarCollapse3" class="btn btn-info">
        <i class="fas fa-align-left"></i>
    </button>
    <button type="button" id="sidebarCollapse4" class="btn btn-info">
        <i class="fas fa-align-left"></i>
    </button>
	<!-- Sidebar  -->
	<nav id="sidebar">
		<div id="dismiss">
			<i class="fas fa-arrow-left"></i>
		</div>
		<div class="sidebar-header">
			<h3><?php echo SEO_NAME?></h3>
		</div>
		<ul class="list-unstyled components">
			<li class="active">
				<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Mas Visitados</a>
				<ul class="collapse list-unstyled" id="homeSubmenu">
                    <?php foreach (get_links() as $k9 => $v9) { ?>
                        <li>
                            <div data-id="<?php echo $v9->id_link; ?>" class="btn btn-link text-white" data-url="<?php echo base_url($v9->url)?>">
                                <?php echo $v9->modulo;?> (<?php echo $v9->contador; ?>)
                            </div>
                        </li>
                    <?php } ?>
				</ul>
			</li>
			<li>
				<a href="#">About</a>
				<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
				<ul class="collapse list-unstyled" id="pageSubmenu">
					<li>
						<a href="#">Page 1</a>
					</li>
					<li>
						<a href="#">Page 2</a>
					</li>
					<li>
						<a href="#">Page 3</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Portfolio</a>
			</li>
			<li>
				<a href="#">Contact</a>
			</li>
		</ul>
	</nav>
    <nav id="sidebar2">
        <div id="dismiss2">
            <i class="fas fa-arrow-left"></i>
        </div>
        <div class="sidebar-header">
            <h3><?php echo SEO_NAME?></h3>
        </div>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Mas Visitados</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <?php foreach (get_links() as $k9 => $v9) { ?>
                        <li>
                            <div data-id="<?php echo $v9->id_link; ?>" class="btn btn-link text-white" data-url="<?php echo base_url($v9->url)?>">
                                <?php echo $v9->modulo;?> (<?php echo $v9->contador; ?>)
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>
    <nav id="sidebar3">
        <div id="dismiss3">
            <i class="fas fa-arrow-left"></i>
        </div>
        <div class="sidebar-header">
            <h3><?php echo SEO_NAME?></h3>
        </div>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Mas Visitados</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <?php foreach (get_links() as $k9 => $v9) { ?>
                        <li>
                            <div data-id="<?php echo $v9->id_link; ?>" class="btn btn-link text-white" data-url="<?php echo base_url($v9->url)?>">
                                <?php echo $v9->modulo;?> (<?php echo $v9->contador; ?>)
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>
    <nav id="sidebar4">
        <div id="dismiss4">
            <i class="fas fa-arrow-left"></i>
        </div>
        <div class="sidebar-header">
            <h3><?php echo SEO_NAME?></h3>
        </div>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Mas Visitados</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <?php foreach (get_links() as $k9 => $v9) { ?>
                        <li>
                            <div data-id="<?php echo $v9->id_link; ?>" class="btn btn-link text-white" data-url="<?php echo base_url($v9->url)?>">
                                <?php echo $v9->modulo;?> (<?php echo $v9->contador; ?>)
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary yamm fixed-top" id="slide-nav">
		<button class="navbar-toggler navbar-toggler-left mb-1" type="button" data-toggle="collapse" data-target="#navbarTopMenu" aria-controls="navbarTopMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="container" style="z-index:1000;">
            <a class="navbar-brand" href="#">
                <?php echo SEO_NAME; ?>
            </a>
			<div class="collapse navbar-collapse" style=" margin-top: -5px;" id="navbarTopMenu">
            	<div style="margin:0 auto;">
                    <ul class="navbar-nav mr-auto mt-2 mt-md-0 balancear bg-primary">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo base_url()?>">
                            	Home
                            	<span class="sr-only">(current)</span>
							</a>
                        </li>
                        <?php
                            if(!isset($this->user->menu) && $this->user->rol_id ==1){
                                $this->user->menu	=	menu();
                                $this->session->set_userdata(array('User'=>$this->user));
                            }else if(!isset($this->user->menu) && $this->user->rol_id != 1){
                                $this->user->menu	=	menu_usuarios($this->user->rol_id);
                                $this->session->set_userdata(array('User'=>$this->user));
                            }
                            //$this->user->menu		=	menu_usuarios($this->user->rol_id);
                            if(isset($this->user->menu)){
                                foreach($this->user->menu['roles_modulos_padre'] as $k => $v){
                        ?>
                            <li class="dropdown yamm-fw nav-item active ">
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
                                                    <div class="col-sm-3 padding">
                                                        <div class="block">
                                                            <h5 class="block-title">
                                                                <div class="ico"><?php print($v3->ico);?></div> <div class="ts-13 text"><?php echo $v3->modulo;?></div>
                                                            </h5>
                                                            <?php foreach($this->user->menu['roles_modulos_nietos'][$v3->id] as $k4 => $v4){
                                                                    if($this->user->rol_id==1){
                                                                ?>
                                                                    <div>
                                                                        <div data-id="<?php echo $v4->id; ?>" class="btn btn-link" data-url="<?php echo base_url($v4->url)?>">
                                                                            <?php echo $v4->modulo;?>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                    }else if(array_search($v4->id,$this->user->menu['roles_modulos_permitidos'])===false){

                                                                    }else{
                                                                ?>
                                                                <div>
                                                                    <div class="btn btn-link" data-id="<?php echo $v4->id; ?>" data-url="<?php echo base_url($v4->url)?>">
                                                                        <?php echo $v4->modulo;?>
                                                                    </div>
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
				</div>
			</div>
            <ul class="nabvar-nav ml-auto ">
                <li class="dropdown <?php if($this->uri->segment(1)==$this->ModuloActivo && in_array($this->uri->segment(2), $menu["Maestros"])){echo "active";}?>">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img id="profile" src="<?php echo $img_perfil;?>">
                        </button>
                        <div class="dropdown-menu mt-3" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="#"><i class="fa fa-key" aria-hidden="true" style="width:24px;"></i> Modificar Contraseña</a>
                            <a class="dropdown-item" href="<?php echo base_url("autenticacion/salir")?>"><i class="fa fa-unlock-alt" aria-hidden="true" style="width:24px;"></i> Salida Segura</a>
                        </div>
                    </div>
                </li>                        
            </ul> 
		</div>
  	</nav>
</header>
<script>
	/*
	$(function() {
		window.prettyPrint && prettyPrint()
		$(document).on('click', '.yamm .dropdown-menu', function(e) {
			e.stopPropagation();
		})
	})*/
</script>


<script type="text/javascript">
		$(document).ready(function () {
				$("#sidebar").mCustomScrollbar({
						theme: "minimal"
				});
                $("#sidebar2").mCustomScrollbar({
                        theme: "minimal"
                });
                $("#sidebar3").mCustomScrollbar({
                        theme: "minimal"
                });
                $("#sidebar4").mCustomScrollbar({
                        theme: "minimal"
                });
				$('#dismiss, .overlay').on('click', function () {
						$('#sidebar').removeClass('active');
                        $('#sidebar2').removeClass('active');
                        $('#sidebar3').removeClass('active');
                        $('#sidebar4').removeClass('active');
						$('.overlay').removeClass('active');
				});

				$('#sidebarCollapse').on('click', function () {
						$('#sidebar').addClass('active');
						$('.overlay').addClass('active');
						$('.collapse.in').toggleClass('in');
						$('a[aria-expanded=true]').attr('aria-expanded', 'false');
				});
                $('#sidebarCollapse2').on('click', function () {
                        $('#sidebar2').addClass('active');
                        $('.overlay').addClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
                $('#sidebarCollapse3').on('click', function () {
                        $('#sidebar3').addClass('active');
                        $('.overlay').addClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
                $('#sidebarCollapse4').on('click', function () {
                        $('#sidebar4').addClass('active');
                        $('.overlay').addClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
		});
</script>

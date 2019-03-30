<div class="container text-center welcome">
	<h1 class="font-weight-700 text-uppercase">Bienvenidos</h1>
    <h2>Desarrollo Basado en Codeigniter</h2>
    <h3>Por ProgramandoWeb</h3>
    <h4>Desarrollo y Creatividad</h4>
    <h5>Info@Programandoweb.net</h5>
    <div>
		<?php print_r($this->user->session_id);?>
    </div>
    <div>
		<?php print_r(chequea_session($this->user));?>
    </div>
    <a href="<?php echo base_url("autenticacion")?>">Sistema de Autenticación</a>
</div>
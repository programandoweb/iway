<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/?>
<div class="container margin-top-100">
	<div class="row justify-content-md-center">
    	<div class="col">
        <img  width="250"  src="<?php echo DOMINIO?>images/design/iway.jpg"  class="rounded mx-auto d-block" alt="..." />
            <h2 class="text-center">Sistema de recuperación de contraseña.</h2>
            <div class="row">
            	<div class="col-md-6 offset-md-3">
					<?php echo form_open(base_url($this->uri->segment(1)."/recoverpass"),array('ajax' => 'true'));	?>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-1">
                                <input style="border:none;  border-bottom: 1px solid #b3b3b3" type="text" id="email" name="nombre_usuario" class="form-control" placeholder="Nombre de usuario" require>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-sm-10 offset-sm-1">
                            	<?php echo form_hidden('redirect',($this->agent->is_referral())?$this->agent->referrer():base_url());?>
                            	<button  style=" background-color: #414141; color: #fff; " type="submit" class="btn btn-primary" >
                                	<b>Recuperar</b>
                                </button>
                                <a  style="background: #4ae387; border: 2px solid #4ae387; " class="btn btn-warning" href="<?php echo base_url("autenticacion")?>">
                                	<b>Cancelar</b>
								</a>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>


</style>
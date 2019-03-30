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
	        <img src="<?php echo DOMINIO?>images/webcamplus-png.png" class="rounded mx-auto d-block" alt="..." />
            <h4 class="font-weight-700 text-center">Sistema de recuperación de clave.</h4>
            <div class="row">
            	<div class="col-md-6 offset-md-3">
					<?php echo form_open(base_url($this->uri->segment(1)."/recoverpass"),array('ajax' => 'true'));	?>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-1">
                                <input type="text" id="email" name="email" class="form-control" placeholder="correo@electronico.com" require>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-sm-10 offset-sm-1">
                            	<?php echo form_hidden('redirect',($this->agent->is_referral())?$this->agent->referrer():base_url());?>
                            	<button type="submit" class="btn btn-primary" >
                                	Recuperar
                                </button>
                                <a class="btn btn-warning" href="<?php echo base_url("autenticacion")?>">
                                	Cancelar
								</a>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

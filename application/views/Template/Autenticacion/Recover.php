<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <h6 class="text-left">Por favor introduce tu nombre de usuario de webcamplus.</h6>
            <div class="row">
            	<div class="col-md-6 offset-md-3">
					<?php echo form_open(base_url($this->uri->segment(1)."/recoverpass"),array('ajax' => 'true'));	?>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-1 input-group">
                                <div class="input-group-addon"><i class="fas fa-user"></i></div>
                                <input style="border:none;  border-bottom: 1px solid #b3b3b3" type="text" id="email" name="nombre_usuario" class="form-control" placeholder="Nombre de usuario" require>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-sm-10 offset-sm-1">
                            	<?php echo form_hidden('redirect',($this->agent->is_referral())?$this->agent->referrer():base_url());?>
                            	<button  style=" background-color: #414141; color: #fff; " type="submit" class="btn btn-primary" >
                                	<b>Recuperar</b>
                                </button>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="block_intro">
    <video id="video" autoplay muted loop>
	    <source src="<?php echo IMG?>intro.mp4" type="video/mp4">
    </video> 
</div>
<div class="container margin-top-100">
	<div class="row justify-content-md-center">
    	<div class="col">
            <div class="row text-center">
            	<img src="<?php echo DOMINIO?>images/webcamplus-png.png" class="rounded mx-auto d-block" alt="..." />
            	<div class="col-md-6 offset-md-3">
					<?php echo form_open(base_url($this->uri->segment(1)."/inicio_sesion"),array('ajax' => 'true'));	?>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-1">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1" style="width:40px;"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="correo@electronico.com" require>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                        	<div class="col-sm-10 offset-sm-1">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1" style="width:40px;"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" require>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-sm-10 offset-sm-1">
                            	<?php echo form_hidden('redirect',($this->agent->is_referral())?$this->agent->referrer():base_url());?>
                            	<button type="submit" id="submit" class="btn btn-warning btn-block" >
                                	Entrar
                                </button>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-sm-10 offset-sm-1 text-center">
                            	<a class="btn" style="color:#979393; font-family:Arial, Helvetica, sans-serif; font-weight:bold;" href="<?php echo base_url("autenticacion/recover")?>">
                                	Olvidé mi Contraseña
								</a>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
            <div class="col text-center" style="font-size:12px;">	
            ¿No tienes cuenta aún? <a href="#" style="color:#1049DE">Prueba WebcamPlus por Tres (3) días.</a>
            	<div style="font-size:10pxpx;">Todos los derechos reservados - LogicSoftERP 2017</div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$("#block_intro").height($(this).height()).width($(this).width());
		setTimeout(function(){ $("#block_intro").fadeOut(function(){$(this).remove()}); }, 6000);
	});
</script>   
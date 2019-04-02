<!--div id="block_intro">
    <video id="video" autoplay muted loop>
	    <source src="<?php echo IMG?>intro.mp4" type="video/mp4">
    </video> 
</div-->
<?php echo form_open(base_url($this->uri->segment(1)."/inicio_sesion"),array('ajax' => 'true')); ?>
<div class="container-fluid visible" style="min-height: 100vh;">
    <div class="row h-100" style="min-height: 100vh;">
        <div class="col-md-5 text-center form_login m-auto align-middle" >
            <img  width="250"  src="<?php echo DOMINIO; ?>images/design/iway.jpg" alt="..." />
            <div class="form-group row">
                <div class="col-sm-12 ">
                    <div class="input-group">
                       <!-- <span class="input-group-addon" id="basic-addon1" style="width:40px;">--><!--<i class="fas fa-user" aria-hidden="true"></i></span>-->
                       <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input  style="border:none;  border-bottom: 1px solid #b3b3b3" type="text" id="email" name="username" class="form-control oscuro" placeholder="Nombre de usuario">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="input-group">
                        <!--<span class="input-group-addon" id="basic-addon1" style="width:40px;">--><!--<i class="fa fa-lock" aria-hidden="true"></i></span>-->
                        <div class="input-group-addon"><i class="fas fa-key"></i></div>
                        <input style="border:none;  border-bottom: 1px solid #b3b3b3" type="password" id="password" name="password" class="form-control oscuro" placeholder="Contraseña" require>
                    </div>
                    <div>
                        <p class="text-right mt-2 opcion" style="cursor:pointer">Mostrar</p>
                        <p class="text-right mt-2 opcion" style="cursor:pointer; display:none;">Ocultar</p>
                    </div>
                </div>
            </div>
            <div class="form-group row text-center">
                <div class="col-sm-12 text-center">
                    <?php echo form_hidden('redirect',($this->agent->is_referral())?$this->agent->referrer():base_url());?>
                    <button type="submit" id="submit" class="btn btn-primary btn-block" >
                        <b>Ingresar</b>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <div class="text-left">
                    <a class="btn  contrasena lightbox" title="Olvidé mi contraseña" data-height="170" data-size="modal-sm" data-type="iframe" href="<?php echo base_url("autenticacion/recover")?>">
                        Olvidé mi Contraseña
                    </a>
                </div>
            </div>
            <div class="col text-center" style="font-size:12px;">   
                ¿No tienes cuenta aún? <a href="#" style="color:#4ae387">Prueba iway por siete (7) días.</a>
                <div style="font-size:10px;">Todos los derechos reservados - BEL Service<span style="font-size:7px;vertical-align: top;"><b>TM</b></span>  2017
                </div>
            </div>            
        </div>
        <div class="col-md-7 d-none d-md-block d-xl-block" style="margin-right: 0px;">
            <div  style="background-image: url(<?php echo DOMINIO; ?>images/design/login.jpg); width: 100%;height: 100vh; background-repeat: no-repeat;background-size: cover;">
                <!--<img  src="<?php echo DOMINIO?>images/design/login.jpg" alt="..." />-->
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
    $(document).ready(function() {
        $(".opcion").click(function(event){
            $(".opcion").show();
            if($(this).text() == "Mostrar"){
                $("#password").attr("type","text");
                $(this).hide();
            }else{
                $("#password").attr("type","password");
                $(this).hide();
            }
        });
    });
</script>
<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo         =   $this->ModuloActivo;
	if(!centro_de_costos()){
		return;
	}
	echo form_open(current_url());
?>
    <div class="container">
        <div class="section">
            <div class="row justify-content-md-center">
				<div class="col">
                    <?php 
						echo MakeCentrodeCostos($this->user->id_empresa,@$row->centro_de_costos);
					?>
                </div>
                <div class="col">
                    <?php set_input("nro_piso_cedula","",$placeholder='Número de Documento',$require=true,"firstLetterText");?>
                </div>
                <div class="col">
                    <?php set_input("email","",$placeholder='Correo Electrónico',$require=true,"firstLetterText");?>
                </div>
            </div>
             <div class="row justify-content-md-center mt-4">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary btn-md"> Enviar</button>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close();?>                                             
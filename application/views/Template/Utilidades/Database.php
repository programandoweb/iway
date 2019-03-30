<?php
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<?php 
		echo TaskBar(array("name"		=>	array(	"title"	=>	"Database MySQL",
													"url"	=>	current_url())
					)
				);
	?>
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group item">
                	<a href="<?php echo base_url("Utilidades/Database/Export")?>">
                        <div class="col-md-4 text-center">
                            <div class="flex flex-column items-center justify-center br2 ba bw3 b--white shadow-2 pa4 bg-gray2 p-5">
                                <svg aria-hidden="true" data-prefix="fas" data-icon="sign-out-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sign-out-alt fa-w-16 fa-3x">
                                    <path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z" class=""></path>
                                </svg>
                                <h3>Exportar</h3>
                            </div>                        
                        </div>                    
                    </a>
                </div>
			</div>
        </div>
    </div>
</div>
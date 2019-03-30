<?php
/* 
  DESARROLLO Y PROGRAMACIÓN
  PROGRAMANDOWEB.NET
  LCDO. JORGE MENDEZ
  info@programandoweb.net
*/?>
<?php
   $modulo     =   $this->ModuloActivo;
   //$ciclo_informacion      = get_cf_ciclos_pagos_new($this->$modulo->result->id_empresa,0);
?>
<?php 
  //$escala_escala_x_user_id  = get_escala_x_user_id2($this->$modulo->result->user_id);
?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:16px; text-align:center;font-family:font-family: 'Montserrat', sans-serif; ">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right;" valign="top">
               <?php echo $empresa->nombre_legal?><br />
                <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?>:<br />                
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br />
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table>
</div>



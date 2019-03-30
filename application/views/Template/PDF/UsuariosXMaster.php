<?php
    $modulo     =   $this->ModuloActivo;
            $suma_token         =   0;
            $suma_equivalencia  =   0;
            $total_tokens=0;
            $total_dolares=0;
            $total_pesos=0;
?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="4">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br/>
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo">
                <th>
                    Plataforma
                </th>
                <th>
                    Cta
                </th>
                <th>
                    Master
                </th>
                <th class="text-center">
                    Usuario/Modelo
                </th>
            </tr>
        </thead>
        <tbody class="bordeBottom"> 
        <?php
            if(count($this->$modulo->result)>0){
                foreach($this->$modulo->result as$k => $v){
                    $ListMaster=get_ListMaster($v->id_plataforma);
                    if(!empty($ListMaster)){

                        foreach($ListMaster as $k2 => $v2){
                            $Nickname   =   get_Nickname($v->id_plataforma,$v2->rel_plataforma_id);
                            $Cuenta     =   get_Cuenta($v2->cuenta_id);
                            if($k == $k2){
                                $borde = 'bordetop';
                            }else{
                                $borde = '';
                            }
                    ?>
                            <tr class="claro">
                                <td width="100" class="bordeAll"><b><?php print($v->primer_nombre); ?></b></td>
                                <td width="70" class="bordeAll">
                                    <?php echo substr($Cuenta->nro_cuenta,-4,4); ?>      
                                </td>
                                <td width="110" class="bordeAll"><?php echo $v2->nombre_master; ?>
                                </td>
                                <td class="bordeAll">
                        <?php 
                            foreach($Nickname as $v3){
                        ?>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="border:none;" width="90"> 
                                                <?php print_r($v3->nickname);?>
                                            </td>
                                            <td style="border:none;"> 
                                                <?php print_r(nombre($v3));?>
                                            </td>
                                        </tr>
                                    </table>
                        <?php
                            } 
                        ?>
                                </td>
                            </tr>
        <?php 
                        } 
                    }
                }
            } 
        ?>
        </tbody>
    </table>
</div>

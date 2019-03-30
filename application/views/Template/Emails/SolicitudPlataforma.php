<?php
    $json = json_decode($data[0]->data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirmacion Solicitud Plataforma</title>
</head>
<body style="width:100%; margin:0; padding:0;">
<div style="width:100%; margin:0; padding:0;">
   	<center><img src="<?php echo DOMINIO;?>images/webcamplus-png.png" style="width:300px;" /></center>
  	<div style=" width:600px; margin:0 auto; padding:20px; border: solid 1px #f2f2f2;">
        <p><b style="color: black;">Importante</b>: Hola <b><?php echo $json->nombre_modelo;?></b>, WebcamPlus® te informa que la cuenta de la plataforma <b><?php echo $json->plataforma; ?></b>; solicitada el <b><?php echo $json->fecha; ?></b> por <b><?php echo $json->responsable; ?></b> ya fué activada para tu usuario <b><?php echo $json->usuario; ?></b></p>

        <p>Cordialmente,</p>
        <div style="height: 40px;"></div>
        <p><b>Equipo WebcamPlus®.</b></p> 
        <p>Para saber mas detalles puedes acceder a tu cuenta dando<a href="https://webcamplus.com.co/belle" target="_blank"> click a este vinculo</a>.</p>
        <center>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><img src="<?php echo DOMINIO;?>images/redes/facebook.png"/></td>
                    <td><img src="<?php echo DOMINIO;?>images/redes/twitter.png"/></td>
                    <td><img src="<?php echo DOMINIO;?>images/redes/youtube.png"/></td>
                    <td><img src="<?php echo DOMINIO;?>images/redes/instagram.png"/></td>
                </tr>
            </table>
        </center>
	</div> 
</div>
</body>
</html>
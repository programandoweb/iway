<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recuperar Contraseña</title>
<style></style>
</head>
<body style="width:100%; margin:0; padding:0;">
<div style="width:100%; margin:0; padding:0;">
<div style=" width:820px; margin:0 auto; border: solid 1px #f2f2f2; background:white">
     <div style="width:820px; height:150px;    position:absolute; background:blue">
     <center><img src="<?php echo DOMINIO;?>images/banner-iway.jpg" style="width:820px;" /> <center>
     </div>
  	<div style=" width:730px; margin:0 auto; z-index:100;  position:relative; padding:20px;  border: solid 1px #f2f2f2; background:white; margin-top:180px;">
    
      <center><img src="<?php echo DOMINIO;?>images/design/iway.jpg" style="width:300px;" /></center>
        <p style="text-align:center;"><h1>Hola, <?php echo $userName;?></h1></p>
        <p>¡Bienvenido(a), ahora eres parte de WebcamPlus®, el primer y único software especializado en la administración de estudios webcam del mundo.</p>

        <p>Para ingresar a WebcamPlus® por favor da click <a href="<?php echo $href;?>" target="_blank">aquí</a>.</p>

        <p><b>Usuario</b>: <?php echo $userUsuario;?></p>
        <p><b>Contraseña</b>:<?php echo $userPassword;?></p>
        <p><b>Tipo de usuario: <?php echo ucwords($userType) ?></b></p>

        <p>Esta contraseña ha sido generada de manera automática por nuestro sistema, te invitamos a cambiarla inmediatamente al iniciar sesión, en la pestaña Modificar Contraseña.</p>
        <center>
           <div style=" background:black; padding:30px; ">
           <center>
            <table style="margin-left:50px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/facebookwhite.png"/></td>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/gorjeo.png"/></td>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/instagramwhite.png"/></td>
                    <td><img style="width:40px;" src="<?php echo DOMINIO;?>images/redes/youtubewhite.png"/></td>
                </tr>
            </table>
           </center>
            </div>
        </center>
	</div> 
    </div>
</div>
</body>
</html>
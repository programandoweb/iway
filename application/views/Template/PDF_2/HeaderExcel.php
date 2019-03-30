<?php
    $this->load->helper('numeros');
    setlocale(LC_ALL,"es_ES.UTF-8");
    $color  =   getColor($this->user->id_empresa);
    header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
    header('Content-Disposition: attachment; filename='.$this->ModuloActivo.'.xls');
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="utf-8">
        <style>
            .colorFondo{
                background-color:<?php if(empty($color)){ echo'#666'; }else{ echo $color;}?>;
                color:#fff;
            }
            .colorFondo{
               padding: 2px;
            }
            .table> td{
                border-right: 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
                border-left : 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .bordetop{
                border-top:1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .bordeBottom{
                border-bottom:1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .borderight: {
                border-right: 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>;
            }
            .bordeAll{
                border: 1px solid <?php if(empty($color)){ echo'#D8D8D8'; }else{ echo $color;}?>; 
            }
        </style>
    </head>
    <body> 
    
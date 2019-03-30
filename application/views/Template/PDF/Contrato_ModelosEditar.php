 <?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
$modulo           = $this->ModuloActivo;
$OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
//pre($this->$modulo->result);
?>

<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px; height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal?><br/>
            Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php echo $empresa->direccion;?><br />               
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br/>
            <?php #pre($empresa); ?>
        </td>
    </tr>
</table>
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página 9 / 9</td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div> 
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:10px; font-family:font-family: 'Montserrat', sans-serif;text-align: justify;">
    <div style="height: 30px;"></div>
    <?php foreach ($this->$modulo->result as $k => $v) { ?>
    <div style="text-align: center;">
        <b>
            Contrato comercial de cuentas en participación 
            <?php
                if(empty($OpcionesFactura->prefijoFacturaFac)){
                    echo @$OpcionesFactura->prefijoFacturaFac;
                }else{
                    echo @$OpcionesFactura->prefijoFacturaFac;
                }
                echo '-'.ceros(contrato($this->uri->segment(3))->consecutivo_id);  
            ?>
            <br/>entre <?php echo $empresa->nombre_legal?> y <?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>.
        </b>
    </div>
    <div style="height: 20px;"></div>
        <div class="bordeAll" style="padding: 15px 5px 15px 5px; background: #D8D8D8;">
            <p><b><?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?></b> queremos recordarle que el <b><?php echo $empresa->nombre_legal?></b> y su representante legal <b><?php echo $empresa->nombre_representante_legal; ?></b>, gestionan redes sociales interactivas en vivo y páginas de entretenimiento para adultos de contenido erótico, por la presente certifica que se encuentra de manera libre y voluntaria dentro de nuestras instalaciones ubicadas en la <b><?php echo $centrodecostos->direccion; ?></b>, en la ciudad de <b><?php echo $centrodecostos->ciudad; ?></b>, es de mente sana, tiene dieciocho (18) años o más, ha presentado documentación que acredita su edad y certifica que no ha sido obligada(o) o presionada(o) de ninguna manera a contratar con esta empresa, SI está de acuerdo con lo anterior, por favor proceder a certificar con su firma, estrictamente este parágrafo aclaratorio y leer la totalidad del presente contrato.</p>
            <div style="height: 10px;"></div>
            <table width="100%">
                <tr>
                    <td width="72%"></td>
                    <td class="bordetop" width="28%" style="text-align: right;">
                        <b><?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?></b>
                    </td>
                </tr>
            </table>
            <div style="height: 10px;"></div>
            <div style="text-align: center;">
                <small><b>*La firma de este parágrafo aclaratorio no constituye aceptación del contrato que a continuación le presentamos*</b></small>
            </div>
        </div>
        <p>Entre los suscritos a saber de una parte <b><?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?></b>, identificada(o) con <b><?php echo $v->tipo_identificacion; ?></b> número <b><?php echo $v->identificacion; ?></b> expedida en la ciudad de <b><?php echo $v->lugar_expedicion_documento_identidad; ?></b>, domiciliada(o) en la <b><?php echo $v->direccion; ?>, <?php echo $v->ciudad; ?> <?php echo $v->departamento; ?></b> y número de contacto (<b><?php echo $v->cod_telefono; ?></b>) <b><?php echo $v->telefono; ?></b>; actuando en calidad de <b>PARTICIPE COMERCIAL NO GESTOR (A)</b> quien en adelante será llamada(o) <b>LA (EL) MODELO</b>, acuerda que unirá sus esfuerzos comerciales y profesionales a los del <b><?php echo $empresa->nombre_legal?></b>; con número de identificación tributario <b><?php echo $empresa->identificacion;?></b> - <b><?php echo $empresa->identificacion_ext; ?></b>, empresa legalmente constituida, cuyo objeto social es la exportación de servicios de operación o gestión de sitios web y medios multimedia que ofrecen servicios interactivos en vivo para mayores de Dieciocho (18) años, incluyendo pero sin limitarse la operación de redes sociales encargadas de poner en contacto entre sí a personas cuya mayoría de edad les permite buscar compañía o amistad, servicios de citas y servicios de agencias matrimoniales online; con sede en la ciudad de <b><?php echo $centrodecostos->ciudad; ?></b>, en la <b><?php echo $centrodecostos->direccion; ?></b>, quien en adelante se llamará <b>LA EMPRESA</b>, actuando en calidad de <b>PARTICIPE COMERCIAL GESTOR (A)</b>, cada uno actuando como comerciante, en nombre propio declaran que entienden que estarán vinculados al entretenimiento webcam para adultos, que realizará esta actividad de forma autónoma y sin ningún tipo de presión, que los integrantes de <b>LA EMPRESA</b> le han informado a <b>LA (EL) MODELO</b> de forma detallada los beneficios y riesgos de estas labores, igualmente comprende que la actividad en mención está íntimamente relacionada con la libertad de expresión la cual es reconocida como un derecho fundamental consagrada en la DECLARACIÓN UNIVERSAL DE DERECHOS HUMANOS en su Artículo Diecinueve (19) y el Derecho fundamental de libre expresión consagrado en la CONSTITUCIÓN NACIONAL DE LA REPUBLICA DE COLOMBIA en su Artículo Veinte (20), donde “se garantiza a toda persona la libertad de expresar y difundir su pensamiento, opiniones y buen actuar”; acuerdan las partes celebrar el presente <b>CONTRATO COMERCIAL DE CUENTAS EN PARTICIPACIÓN</b>, regidas las partes por el código de comercio en sus artículos del QUINIENTOS SIETE (507) al QUINIENTOS CATORCE (514), respectivamente.</p>

        <h4 style="text-align: center;">CONSIDERACIONES PRELIMINARES.</h4>
        <p><b>Consideración # 001: LA (EL) MODELO</b> comprende y acepta que <b>LA EMPRESA</b> posee o gestiona uno o más sitios web que ofrecen servicios webcam interactivos en vivo para adultos de contenido erótico.</p>

        <p><b>Consideración # 002: LA (EL) MODELO</b> comprende su responsabilidad de promocionar de manera personal las interacciones en vivo con los usuarios de las páginas o plataformas de video transmisión erótica a las cuales <b>LA EMPRESA</b> está afiliada.</p>
        
        <p><b>Consideración # 003: LAS PARTES</b>, en su calidad de comerciantes, en cumplimiento del código de comercio en su artículo QUINIETOS SIETE (507) han expresado su interés de desarrollar las actividades comerciales objeto de este contrato en los términos establecidos en este documento, con el fin de que <b>LA EMPRESA</b> sea:</p>

        <p>a)  la encargada de la creación de los perfiles en las diferentes páginas de video transmisión erótica a las cuales se encuentra afiliado. b)  El recaudo del dinero facturado por <b>LA (EL) MODELO</b> ante tales plataformas. c) El proceso de monetización a la divisa nacional. d) La responsabilidad de adecuar sus instalaciones físicas dotándolas de mobiliarios, elementos tecnológicos y de conectividad.Y que <b>LA (EL) MODELO</b> sea: a)  La (el) encargada(o) de la transmisión en vivo en las plataformas de entretenimiento para adultos. b)  La adquisición de elementos sexuales terapéuticos que no afecten su integridad, ni salud y, c)  La gestión personal de una cuenta bancaria donde <b>LA EMPRESA</b> pueda transferir los dineros correspondientes a su actuación fruto del presente contrato.</p>

        <p><b>Consideración # 004: LAS PARTES</b> se entienden como comerciantes independientes, NO EXISTIENDO entre ellas relación laboral que conlleve a cualquier tipo de carga prestacional como primas, vacaciones, cesantías o demás compensaciones al momento de terminar el contrato o durante la vigencia del mismo, diferente a las utilidades y/o honorarios recibidos.</p>

        <p><b>Consideración # 005: LAS PARTES</b> comprenden que la forma de pago de los visitantes de internet a sitios web en adelante “CLIENTES” es por medio de compra y usos de créditos llamados generalmente “TOKENS” o cualquier mecanismo de pago en MONEDA EXTRANJERA los cuales serán trasladados por el CLIENTE al perfil de <b>LA (EL) MODELO</b> durante su interacción en vivo.</p>

        <p><b>Consideración # 006: LAS PARTES</b> comprenden que las páginas pueden, a su entera discreción, ajustar o deducir el número de fichas transferidas o tokens por cualquier motivo, en cualquier momento, sin previo aviso o notificación a <b>LA EMPRESA.</b></p>

        <p><b>Consideración # 007: LAS PARTES</b> comprenden y aceptan que para la gran mayoría de páginas web y solo en casos puntuales especificados en este contrato o mediante otro sí, cada mes se divide en dos (2) períodos de pago: el primer período de pago es del uno (1) al día quince (15) del mes (incluido), y el segundo período de pago es del dieciséis (16) al último día del mes (incluido), aclarando que los días comienzan a las 12:00:01 am hora del pacífico y terminan 11:59:59 pm hora del pacífico, por lo cual <b>LA (EL) MODELO</b> recibirá por parte de <b>LA EMPRESA</b> la cantidad de dinero ganado liquidado en pesos Colombianos, dentro de los siguientes CINCO (5) DÍAS HABILES de cada quincena en su cuenta bancaria, después de aplicado los impuestos correspondientes.</p> 

        <p><b>Consideración # 008: LA (EL) MODELO</b> comprende que <b>LA EMPRESA</b> cuenta con un sistema de monitoreo interno donde podrá acceder en cualquier momento y sin previo aviso a la transmisión en vivo, por lo cual <b>LA (EL) MODELO</b> autoriza desde ahora y de forma irrevocable por el tiempo que dure este contrato a cualquier funcionario competente de <b>LA EMPRESA</b> o quien haga sus veces para el respectivo monitoreo, control de calidad y seguimiento.</p>

        <p><b>Consideración # 009: LA (EL) MODELO</b> comprende y acepta que es la(el) única(o) intérprete autorizada(o) o protagonista, por ende <b>LA EMPRESA</b> en ningún caso permitirá la promoción o actuación de alguien más en nombre de <b>LA (EL) MODELO</b>, le queda completamente prohibido a <b>LA (EL) MODELO</b> permitir que accedan a su cuenta, compartir información de inicio de sesión, contraseñas, datos o información de cuenta con otra persona, diferente a los directivos y administradores de <b>LA EMPRESA.</b></p>
        
        <p><b>Consideración # 010: LA (EL) MODELO</b> no podrá promocionar páginas dentro de otras páginas a las que <b>LA EMPRESA</b> este afiliada pues es considerado como competencia desleal y motivo de cancelación de cuenta de forma inmediata, lo que hará que la página NO reconozca el valor total facturado de <b>LA (EL) MODELO</b>, esta es considerada como una falta grave la cual podrá dar como resultado la terminación inmediata del presente contrato.</p>

        <p><b>Consideración # 011:</b> Para el perfeccionamiento del presente contrato comercial de cuentas en participación, <b>LA (EL) MODELO</b> ha presentado uno o más documentos de identificación a <b>LA EMPRESA</b> que certifica que es mayor de edad, donde se ha podido evidenciar su nombre completo, foto y fecha de nacimiento, por ende <b>LA EMPRESA</b> en su buena fe ha procedido a realizar los respectivos registros ante las páginas de contenido erótico aliadas para la trasmisión de material explícitamente sexual, informando desde ahora <b>LA EMPRESA</b> que ante la falsificación de tales documentos por parte de <b>LA (EL) MODELO, LA EMPRESA</b> repercutirá contra esta de forma penal en amparo del Código Penal Colombiano en su TITULO IX “DELITOS CONTRA LA FE PUBLICA”, CAPITULO SEGUNDO “DE LA FALSIFICACIÓN DE SELLOS, EFECTOS OFICALES Y MARCAS” y su CAPITULO TERCERO “DE LA FALSEDAD EN DOCUMENTOS”; en los artículos comprendidos del DOSCIENTOS SETENTA Y NUEVE (279) al DOSCIENTOS NOVENTA Y SEIS (296), por falsificación en documento privado, falsificación en documento público y demás delitos contra la fe pública o aquellos a los que diese lugar considerados en el código penal Colombiano y normas concordantes, en los casos en que <b>LA (EL) MODELO</b> opte por generar su transmisión desde un lugar diferente a las instalaciones de <b>LA EMPRESA</b>, deberá garantizar que no existirá presencia de menores de edad, en caso contrario <b>LA EMPRESA</b> estará en la obligación de poner en conocimiento de las autoridades competentes esta situación, para que estas actúen de manera rigorosa ante tal conducta.</p>

        <p><b>Consideración # 012: LA (EL) MODELO</b> comprende que para la ejecución efectiva del presente contrato <b>LA EMPRESA</b> pondrá a disposición mobiliario y elementos tecnológicos, tales elementos serán entregados de manera provisional, por lo cual ante su uso indebido <b>LA EMPRESA</b> podrá poner en conocimiento de las autoridades correspondientes el “ABUSO DE CONFIANZA”, contemplado en el Código Penal Colombiano en su CAPITULO QUINTO “DEL ABUSO DE CONFIANZA”; en su articulo DOSCIENTOS CUARENTA Y NUEVE (249), <b>“El que se apropie en provecho suyo o de un tercero, de cosa mueble ajena, que se le haya confiado o entregado por un título no traslativo de dominio, incurrirá en prisión de uno (1) a cuatro (4) años y multa de diez (10) a doscientos (200) salarios mínimos legales mensuales vigentes. La pena será de prisión de uno (1) a dos (2) años y multa hasta de diez (10) salarios mínimos legales mensuales vigentes, cuando la cuantía no exceda de diez (10) salarios mínimos legales mensuales vigentes. Si no hubiere apropiación sino uso indebido de la cosa con perjuicio de tercero, la pena se reducirá en la mitad”</b>; por lo cual <b>LA (EL) MODELO</b> se obliga al momento de la terminación del presente contrato de entregar todos los elementos tecnológicos y mobiliario suministrados por <b>LA EMPRESA</b>.</p>

        <p><b>Consideración # 013: LA (EL) MODELO</b> comprende y acepta que los actos mencionados a continuación, tanto reales como simulados, están prohibidos por las páginas a las cuales <b>LA EMPRESA</b> se encuentra afiliado y no deben ser trasmitidos por este medio en actuación de <b>LA (EL) MODELO</b> o la incitación para la realización a los CLIENTES, la realización de estas prácticas es severamente castigada por las páginas: cualquier representación de <b>LA (EL) MODELO</b> que implique o sugiera que <b>LA (EL) MODELO</b> es menor de dieciocho (18) años de edad; bestialidad real o simulada, fisting; micción, defecación; incesto; necrofilia; sado-masoquismo, tortura; lesión física; violación;  mutilación genital; inserción genital de objetos o dispositivos que no sean aparatos sexuales terapéuticos y cualquier presentación o representación de los menores involucrados en una conducta física íntima o situaciones sexuales, incluyendo pero no limitados a las representaciones de desnudos lascivos, la masturbación o la conducta sexual, real o representada; y en si cualquier asunto que sea despectivo, humillante o de otra manera perjudicial para cualquier producto, persona o entidad, o cualquier otro derecho relacionado con ésta. <b>LA EMPRESA EXIGE A LA (EL) MODELO LA NO REALIZACIÓN DE ESTAS PRACTICAS</b>, dejando desde ahora y en adelante claro que <b>LA EMPRESA</b> tiene políticas claras de cero tolerancia contra la inducción o facilitación de medios tecnológicos a menores de edad y pondrá en conocimiento de la autoridad competente cualquier anomalía que al respecto se presente.</p>

        <p><b>Consideración # 014: LA (EL) MODELO</b> no podrá, en ningún caso, solicitar a cualquier CLIENTE información personal o privada, incluyendo, pero sin limitarse; nombres verdaderos, direcciones, cuentas, facturación o información de pago, y los nombres de usuario o contraseñas, ni utilizar el CLIENTE de cualquier manera para beneficio personal, la realización de esta práctica es severamente castigada por las páginas, <b>LA EMPRESA NO APRUEBA LA POSIBILIDAD DE QUE LA (EL) MODELO SE ENCUENTRE CON EL CLIENTE DE MANERA FÍSICA</b>, el objeto del presente contrato solo contempla relaciones de carácter virtual y se excluye de cualquier responsabilidad ante el no cumplimiento por parte de <b>LA (EL) MODELO</b> de la presente consideración.</p>

        <b><b>Consideración # 015: LA (EL) MODELO</b> guardará total confidencialidad durante la vigencia del presente contrato y un período de diez (10) años adicionales después de la terminación del mismo sobre el manejo y secretos comerciales internos de <b>LA EMPRESA</b>, la información exclusiva de <b>LA EMPRESA</b> incluye pero no se limita a los siguientes aspectos: sus sitios web, software, empleados, clientes, afiliados y proveedores de servicios: funciones, características, opciones, preferencias, código de programación, estilo, colores, diseños, costos, rentabilidad, estadísticas, datos y cualquier otra información de cualquier manera relacionada con <b>LA EMPRESA</b>  o sobre el cómo <b>LA EMPRESA</b> realiza negocios.</b>        

        <p><b>Consideración # 016: LA EMPRESA</b> hace especial claridad a <b>LA (EL) MODELO</b> respecto a la posibilidad de ser vista en Colombia a través de mecanismos virtuales o programas informáticos diseñados para tal fin, igualmente <b>LA (EL) MODELO</b> certifica que ha sido informada por <b>LA EMPRESA</b> de manera detallada respecto a la posibilidad de quedar información (imágenes o videos) de los shows realizados con su o sus nickname - nombre sustituto adoptado por <b>LA (EL) MODELO</b> frente a la web con el fin de preservar su identidad -  en diversos servidores los cuales NO son administrados, ni tiene competencia <b>LA EMPRESA</b>, situación que <b>LA (EL) MODELO</b> ha aceptado.</p>

        <div>
            <h4 style="text-align: center;">EL PRESENTE CONTRATO COMERCIAL DE CUENTAS EN PARTICIPACIÓN, SE REGIRA POR LAS SIGUIENTES CLAUSULAS</h4>    
        </div>
        
        <p><b>PRIMERA – OBJETO:</b> La sociedad que por el presente acto se crea tiene por finalidad y objeto desarrollar cuanta actividad sea </p>

        <p>necesaria para el debido desarrollo de actividades de entretenimiento web de contenido erótico en plataformas con operación total en el extranjero; <b>LA (EL) MODELO</b> se obliga  a realizar todas las tareas propias de la naturaleza de este contrato, por lo cual tendrá a su cargo  a) la gestión operativa de los sitios web que ofrecen servicios de interacción en vivo a los cuales se encuentra afiliada <b>LA EMPRESA</b>; dentro de los que se incluye pero sin limitarse Myfreecams® (myfreecams.com), Chaturbate® (chaturbate.com), Bongacams® (bongacams.com), Streamate® (streamatemodels.com), Livejasmin® (livejasmin.com), Camdolls® (es.camdolls.com), Streamray (cams.com) y demás que surjan dentro de la buena marcha de los negocios de <b>LAS PARTES</b>, donde <b>LA EMPRESA</b> realizará cuanta actividad sea necesaria para el correcto funcionamiento de las plataformas e instalaciones físicas.</p>

        <p><b>LA EMPRESA</b> para el buen desarrollo de sus operaciones ha diseñado una serie de horarios  con el fin de poder cumplir a <b>LA (EL) MODELO</b> con los compromisos establecidos, por lo cual <b>LA EMPRESA</b> se compromete a tener disponibilidad en uno de los siguientes tres horarios: a) TURNO MAÑANA: iniciando transmisión a las siete (7:00) de la mañana y terminando a las dos (2:00) de la tarde, b) TURNO INTERMEDIO: iniciando transmisión a las dos (2:00) de la tarde y terminando a las diez (10:00) de la noche, c) TURNO NOCHE: iniciando transmisión a las diez (10:00) de la noche y terminando a las seis (6:00) de la mañana, igualmente las partes comprenden y aceptan que los horarios aquí consignados podrán ser modificados sin previo aviso por <b>LA EMPRESA</b>, según sus necesidades comerciales, siempre buscando el mejor beneficio para <b>LA (EL) MODELO</b>, <b>LA EMPRESA</b> al momento de acordar esta sociedad comercial con <b>LA (EL) MODELO</b> ha exigido a <b>LA (EL) MODELO:</b> a)  Estar con un mínimo de treinta (30) minutos antes con el fin de estar preparado a la hora indicada de conexión. b)  La asistencia a reuniones para capacitación, evaluación de necesidades, estrategias de mercado y demás aspectos presentados. c)  La limpieza de su punto de transmisión ya que NO se acuerda este servicio adicional de <b>LA EMPRESA</b> dentro de los términos de esta sociedad, el cual tiene un costo de quince mil pesos ($15.000) cada aseo y que <b>LA (EL) MODELO</b> autoriza cargar de manera automática a sus utilidades y/o honorarios quincenales que serán transferidos a <b>LA EMPRESA</b> cada vez que esta deje en mal estado las instalaciones, físicas. d)  Reconocer a <b>LA EMPRESA</b> la suma de cuarenta mil pesos ($40.000) cada día que no asista a trasmitir <b>LA (EL) MODELO</b>, exceptuando el día de descanso semanal; ya que <b>LA EMPRESA</b> siempre tendrá disponible para <b>LA (EL) MODELO</b> un espacio de trabajo, por lo cual ante la no asistencia de parte de <b>LA (EL) MODELO</b>, esta reconocerá a <b>LA EMPRESA</b> por los diferentes costos en los cuales debió incurrir, lo anterior basado en  que ante la ausencia de <b>LA (EL) MODELO</b>, <b>LA EMPRESA</b> igual incurrió en una serie de gastos como salarios del personal administrativo, arrendamiento de la sede de transmisión, servicios de internet, servicios de acueducto y alcantarillado, servicio de energía, servicio de aseo y demás costos de operación, por lo cual una causa injustificada se entenderá como aquella que no tiene un soporte por escrito probatorio o que no fue notificada con un mínimo de Veinticuatro (24) horas previas en la página web www.webcamplus.com.co, excluyéndose las calamidades domesticas las cuales deberán ser soportadas para su análisis.</p> 

        <p>e)  Cancelar la suma de Veinte mil pesos ($20.000) por cada llegada tarde a las instalaciones de <b>LA EMPRESA</b> pues la no asistencia puntual retrasa las operaciones de <b>LA EMPRESA</b>, generando perdidas económicas que <b>LA (EL) MODELO</b> deberá suplir. f)  El pago de seguridad social.</p>

        <p><b>SEGUNDA – DURACIÓN:</b>  El término de duración de la asociación que por este contrato se constituye es de <b>VENTICUATRO (24) MESES</b>, que se contará a partir de la fecha de la firma de este documento, podrá darse por terminado en cualquier momento por cualquiera de las partes, siempre y cuando <b>LA (EL) MODELO</b> informe con un total de TREINTA (30) días antes a <b>LA EMPRESA</b> su intención de no continuar con el contrato; después de retirada <b>LA (EL) MODELO</b>, <b>LA EMPRESA</b> contará con hasta <b>DOCE (12) MESES</b> para la eliminación de sus cuentas ante las páginas trabajadas, igualmente  <b>LA (EL) MODELO</b> comprende que <b>LA EMPRESA</b> contará hasta con Quince (15) días hábiles para la consignación de los dinero facturados durante este periodo, no obstante, las partes, de común acuerdo, y según el desarrollo del proyecto, podrán anticipar o aplazar su término de vigencia.</p>
  
        <p><b>TERCERA – ÁMBITO GEOGRÁFICO:</b> Las actividades se ejecutarán en las instalaciones de <b>LA EMPRESA</b>; ubicadas la ciudad de <b><?php echo $empresa->ciudad; ?></b>, en la <b><?php echo $empresa->direccion;?></b>  y podrán ser modificado por acuerdo entre las partes, contemplando la posibilidad de que <b>LA (EL) MODELO</b> inicie transmisión desde su casa, denominada esta modalidad desde ahora y en adelante como SATELITE; donde se realizará una redistribución de ingresos a favor de <b>EL (LA) MODELO</b> y que serán acordados mediante <b>OTRO SÍ</b>.</p>

        <p><b>CUARTA - APORTES FONDO COMÚN:</b> Los partícipes de la asociación aportan al fondo común, elementos específicos que serán destinados a la transmisión en plataformas online de contenido erótico en forma exclusiva, en las siguientes proporciones:</p>

        <p>a)  <b>LA (EL) MODELO</b> deberá aportar no solo su trabajo físico, sino también cuantos elementos (juguetes) sexuales terapéuticos y </p> 

        <p>vestimenta que permita una apariencia sobresaliente en las plataformas de transmisión erótica, así como el cabal cumplimiento de los acuerdos y políticas de <b>LA EMPRESA</b> que serán consignadas en este documento. Eventualmente ante la transmisión bajo la figura denominada <b>“SATELITE”</b> <b>LA (EL) MODELO</b> deberá suministrar el mobiliario y elementos tecnológicos necesarios para el desarrollo de sus actividades diarias, salvo expreso acuerdo mediante otro sí. b)  <b>LA EMPRESA</b> se compromete por su parte a aportar las plataformas de transmisión erótica, las cuales son un aporte durante el desarrollo de esta asociación, pero que son propiedad total de <b>LA EMPRESA</b> y el mobiliario y elementos tecnológicos necesarios para el desarrollo de las actividades objeto de este contrato, mientras <b>LA (EL) MODELO</b> no se encuentre bajo la figura denomina <b>“SATELITE”</b>; salvo expreso acuerdo mediante otro sí.</b>

             <div style="height: 10px;"></div>
        <p><b>QUINTA - VALOR:</b> Para la conformación de la asociación <b>LAS PARTES</b> han acordado liquidar los ingresos totales de forma porcentual de la siguiente manera: <b>EL VALOR TOTAL PRODUCIDO DURANTE LA CONEXIÓN EN LAS PAGINAS DONDE <b>LA (EL) MODELO</b> TIENE CUENTA ABIERTA Y AUTORIZADA POR <b>LA EMPRESA</b> MULTIPLICADO POR EL PORCENTAJE ACORDADO SEGÚN PÁGINA EN UNA FRECUENCIA QUINCENAL</b>

        <p><b>PARÁGRAFO PRIMERO:</b> Acuerdan, aceptan y entienden las partes que <b>LA EMPRESA</b> cuenta con espacios de transmisión adecuadamente acondicionados con todas las herramientas necesarias requeridas para un buen resultado de facturación quincenal, por lo cual será responsabilidad de <b>LA (EL) MODELO</b> dejar en impecables condiciones las instalaciones o áreas de trabajo, libres de aceite, basura o demás elementos, por lo anterior estará <b>LA EMPRESA</b> autorizado para descontar cualquier daño al inventario generado con dolo o intención, incluyendo accidentes que se hubieran podido prevenir y que por culpa directa de <b>LA (EL) MODELO</b> desencadenaron en un daño a los bienes de <b>LA EMPRESA</b>, las partes acuerdan que <b>LA (EL) MODELO</b> escogerá como horario de</p>

        <p> transmisión el turno de la 
            <b><?php
                if($v->turno_manama != 0){
                    echo 'Mañana';
                }else if($v->turno_tarde != 0){
                    echo 'Tarde';
                }else if($v->turno_noche != 0){
                    echo 'Noche';
                }else if($v->turno_intermedio != 0){
                    echo 'Intermedio';
                }
            ?></b>
        ; <b>LA (EL) MODELO</b> contará con <b>QUINCE (15) MINUTOS</b> desde el momento de la recepción de su room, para comprobar el estado de todo el mobiliario y reportarlo a <b>LA EMPRESA</b>; transcurrido este tiempo será responsabilidad de <b>LA (EL) MODELO</b> cualquier anomalía o daño presentado.</p>

        <p><b>QUINTA -  PARTICIPACIÓN:</b> La participación en el fondo común podrá ser variada, por acuerdo entre las partes, y de ello se deberá dejar constancia en documento escrito, el cual contendrá los demás cambios contractuales que implique dicha modificación.</p>

        <b><b>SEXTA - NATURALEZA DEL CONTRATO:</b> La naturaleza del presente contrato se circunscribe al de <b>CONTRATO COMERCIAL DE CUENTAS EN PARTICIPACIÓN</b> y en consecuencia <b>NO EXISTIRÁ VÍNCULO LABORAL ALGUNO ENTRE LAS PARTES</b>, todas las decisiones deberán ser tomadas por mayoría, cada asociado tendrá una participación igual al porcentaje de su aporte al fondo común.</b> 

        <p><b>SÉPTIMA - INDEPENDENCIA:</b> Para el desarrollo de su gestión <b>LA EMPRESA</b> tendrá plena independencia, tanto técnica, como directiva y administrativa en la realización de sus actividades, lo que quiere decir que no tendrá dedicación exclusiva para con <b>LA (EL) MODELO</b>, ni estará subordinado o condicionado a trabajo, <b>LAS PARTES</b> acuerdan que EL (LA) MODELO solo desarrollará esta actividad de <b>MODELO WEBCAM</b> y generación de contenido erótico exclusivamente con <b>LA EMPRESA</b> y nadie más.</p>

        <p><b>OCTAVA - INVENTARIOS Y BALANCES:</b> Las partes acuerdas que los activos aportados por  <b>LAS PARTES</b> para tal fin, seguirán siendo propiedad de cada uno, <b>LA EMPRESA</b> se realizará una evaluación del avance de las actividades, un balance de las operaciones y se estudiaran los demás aspectos que juzguen de interés de <b>LAS PARTES</b>, <b>LA EMPRESA</b> entregará a <b>LA (EL) MODELO</b> cada quincena un discriminado sobre la forma como fueron liquidados los ingresos, en este documento se especificarán descuentos y retenciones practicadas.</p>  

        <p><b>NOVENA - CAUSALES DE TERMINACIÓN:</b> La asociación podrá darse por terminada ante la ocurrencia de cualquiera de los hechos que se relacionan a continuación:</p> 

        <p>a)  Pérdida del cincuenta por ciento (50%) del fondo común. b)  Acuerdo mediante el cual <b>LAS PARTES</b> decidan vender la totalidad del proyecto para el que se constituyeron en asociación; ante la terminación de este contrato <b>LA (EL) MODELO</b> podrá solicitar a <b>LA EMPRESA</b> la venta de las cuentas de las páginas de transmisión, tal precio será de común acuerdo. c)  Por la no realización de los trabajos operativos y dotación de mobiliario por parte de <b>LA EMPRESA</b> necesarios para el cumplimiento del objeto del contrato. d)  Por la variación injustificada por parte de <b>LA (EL) MODELO</b> de la liquidación de utilidades acordados en este contrato. e)  Por el incumplimiento injustificado de las actividades programadas dentro del plazo del contrato. f)  Por el incumplimiento por parte de <b>LA (EL) MODELO</b> de los <b>“PRINCIPIOS DE <b>LA EMPRESA</b>”</b>, comprometiéndose a aplicarlos de forma integral, entre los cuales figuran en forma enunciativa pero no limitativa los siguientes:</p>
        <div style="padding-left: 30px;">
            <p>a.  No emplear o contratar menores de edad por debajo de la edad mínima de contratación prevista por la legislación y reglamentación del trabajo en cualquier actividad directa o indirectamente relacionada con la ejecución del objeto del contrato. b.  Proporcionar a <b>LA (EL) MODELO</b> un ambiente de trabajo digno y seguro. c.  Generar un ambiente de trabajo en el que se respete la dignidad de las personas y no tolerar en su contra ninguna forma de acoso físico o sexual, discriminación o cualquier otro tipo abuso de cualquier naturaleza que este sea. d.  Cumplir en todo momento con las leyes que resulten aplicables a las actividades propias de su giro, el incumplimiento por parte de <b>LA (EL) MODELO</b> de los mencionados principios dará lugar a la terminación del presente contrato, sin perjuicio de responder por los perjuicios que tal incumplimiento cause a <b>LA EMPRESA</b>, e.  Por la terminación del proyecto.</p>
        </div> 

        <p>Frente a la ocurrencia de cualquiera de los hechos descritos <b>LA (EL) MODELO</b> podrá conminar mediante conminación escrita a <b>LA EMPRESA</b>, para que dentro de los tres (3) días siguientes a la fecha de la misma, se halle a cumplir con la obligación dentro del término señalado.</p> 

        <p>En el evento en que <b>LA EMPRESA</b> no cumpliere con la obligación dentro del término señalado <b>LA (EL) MODELO</b> está facultada(o) para dar por terminado el contrato de forma anticipada, mediante comunicación escrita dirigida a <b>LA EMPRESA</b>. Una vez <b>LA (EL) MODELO</b> proceda a la terminación anticipada del contrato comercial de cuentas en participación, se </p>

        <p>realizará la liquidación del mismo, y la cancelación de los saldos pendientes a cargo de <b>LAS PARTES</b> a más tardar en los QUINCE (15) DÍAS HÁBILES SIGUIENTES, sin que ello diere lugar a indemnización o compensación alguna en favor de <b>LA EMPRESA</b>, sin perjuicios de la aplicación de las sanciones contractuales a que haya lugar.</p>

        <p>DECIMA - LIQUIDACIÓN: La liquidación de la asociación será efectuada por los copartícipes, de común acuerdo, según sus porcentajes de participación.</p>    

        <p><b>PARÁGRAFO PRIMERO - EXCLUSIÓN:</b> <b>LA EMPRESA</b> no será responsable de las obligaciones o acreencias de carácter civil o comercial que <b>LA (EL) MODELO</b> contraiga con terceros en ejecución del presente contrato.</p>

        <p><b>DECIMA PRIMERA -  MODIFICACIONES:</b> Cualquier modificación al presente contrato debe efectuarse por escrito y anexarse a este documento mediante OTRO SÍ.</p>

        <p><b>DECIMA SEGUNDA – OBLIGACIONES ADICIONALES DE LA EMPRESA:</b> <b>LA EMPRESA</b> adquiere para con <b>LA (EL) MODELO</b> las siguientes obligaciones:</p> 

        <p>a)  Proporcionar los espacios para que <b>LA (EL) MODELO</b> dé apertura a una cuenta bancaria personal en el <b>BANCO BBVA BILBAO VIZCAYA ARGENTARIA, BANCO DAVIVIENDA S.A.</b> y/o el <b>BANCO BANCOLOMBIA S.A.</b> para el pago quincenal de sus utilidades y/o honorarios a más tardar treinta (30) días corrientes del inicio de sus actividades, en caso contrario los pagos en efectivos serán programados hasta siete (7) días posteriores al cierre del periodo de facturación, debido a los procesos internos de <b>LA EMPRESA</b>. b)  Facturar los servicios prestados con todos los requisitos de ley, donde incluirá los tributos y gravámenes y cancelará oportunamente a las autoridades encargadas del recaudo. c)  Entregar completamente limpio, libre de basura y demás elementos el ambiente de transmisión de <b>LA (EL) MODELO</b>, con el fin de que esta lo devuelva de igual manera. d)  Guardar confidencialidad sobre la información que le facilite <b>LA (EL) MODELO</b> en o para la ejecución del contrato o que por su propia naturaleza deba ser tratada como tal, se excluye de la categoría de información confidencial toda aquella información que sea divulgada por <b>LA (EL) MODELO</b>, aquella que haya de ser revelada de acuerdo con las leyes o con una resolución judicial o acto de autoridad competente, este deber se mantendrá durante un plazo de diez (10) años más a contar desde la finalización del servicio.</p>

        <p><b>DECIMA TERCERA – UTILIDADES Y PÉRDIDAS:</b>  Las utilidades que resulten del ejercicio de la asociación se distribuirán entre los asociados en los porcentajes mencionados en la CLÁUSULA QUINTA de este contrato y teniendo en cuenta la fecha en que haya hecho el aporte. En caso de pérdidas, éstas serán asumidas por <b>LA EMPRESA</b>, salvo aquellas que tengan que ver con el no pago por parte de las plataformas a <b>LA EMPRESA</b>, ante tal situación <b>LA EMPRESA</b> se excluye de responder por estos dinero ante <b>LA (EL) MODELO</b>.</p>

        <p><b>DECIMA CUARTA - POLITICAS INTEGRALES:</b> Estas políticas entrarán en vigor a partir de su firma y publicación en todas las sedes e instalaciones de <b>LA EMPRESA</b>, y aplica a todos los directivos, trabajadores, contratistas, asociados comerciales y terceros que se encuentren y/o permanezcan en las instalaciones de <b>LA EMPRESA</b>.</p>

        <p><b>a)  BIENES DE LA EMPRESA:</b> Los bienes de <b>LA EMPRESA</b> NO se deben utilizar para el beneficio personal o de cualquier otra persona que no haga parte de esta, para ello: las llamadas personales y en casos que lo ameriten usando el sentido común, están bien de manera esporádica, se convertirán en nocivas o no debidas cuando se presenten de manera recurrente, los dispositivos de comunicación, tecnológicos,  de inmobiliario y papelería  de <b>LA EMPRESA</b> son para uso racional y que involucre actividades inherentes a la compañía, el hurto o retiro de los bienes de <b>LA EMPRESA</b> o de cualquier miembro de los mismos sin justificación que lo amerite, se considerará como una falta grave que atenta contra la integridad de <b>LA EMPRESA</b>, el uso de las computadoras deberá ser el adecuado y jamás en aquellas que atenten contra el buen nombre, la ética y falten al respeto de los demás miembros <b>LA EMPRESA</b>. <b>b)  USO DE LA INFORMACIÓN:</b> Por la naturaleza de nuestra actividad y la reserva de todos, toda la información  de <b>LA EMPRESA</b> se considera de carácter NO pública, esto implica nombres de modelos, planes estratégicos, bases de datos, documentación legal, logos, entre otros, el cuidado y correcto uso de dicha información es responsabilidad de todos y cada uno de los integrantes de <b>LA EMPRESA</b>, la información no pública está igualmente restringida a familiares y amigos, la protección de la información de <b>LA EMPRESA</b> se debe dar bajo cualquier circunstancia tanto en horarios laborales o de transmisión como en otros campos y deberá conservarse sin importar si se ha finalizado la relación comercial, civil o laboral con esta.<b> c)  PRIVACIDAD:</b> Los datos personales de los empleados, contratistas, socios, asociados comerciales y clientes de <b>LA EMPRESA</b> son tratados respetando siempre la privacidad; en caso de que debamos manejar información privada se deberá tener en cuenta la responsabilidad de actuar de acuerdo con todas </p>  
 
        <p><b>las obligaciones contractuales pertinentes, limitando el acceso a la información por parte de terceros teniendo cuidado de revelar la información de manera no autorizada. d)  EXIGENCIAS: LA EMPRESA</b> exige a todos los integrantes o terceros que permanezcan dentro de sus instalaciones:</p>

         <div style="padding-left: 30px;">
            <p>a.  El uso de vocabulario adecuado y de manera amable tanto con los miembros de <b>LA EMPRESA</b> como con clientes. b.  La excelente presentación personal que posibilite un trato agradable y la facilidad de un acercamiento adecuado con su entorno. c.  El cumplimiento con las condiciones legales impuestas al momento de la contratación y su alcance contractual, así como el respeto por la compañía, su imagen y el buen nombre tanto en las actividades laborales, comerciales y civiles como por fuera de las mismas. d.  La prohibición total del acceso a menores de edad a las instalaciones, <b>LA EMPRESA</b> pondrá en conocimiento de las autoridades competentes a quien valiéndose de sus posibilidades de acceso a las instalaciones ingrese a un menor de edad y repercutirá de manera penal, aclarando que <b>LA EMPRESA</b> cuenta con políticas de cero tolerancia ante esta situación.</p>
        </div>

        <p><b>DECIMA QUINTA – POLITICA DE ALCOHOLISMO, DROGADICCIÓN Y TABAQUISMO:</b> En línea con nuestro compromiso de mantener un ambiente de trabajo seguro y sano es política de <b>LA EMPRESA</b> prohibir la posesión, uso y comercialización de drogas ilícitas, bebidas embriagantes y tabaco al igual que el uso inapropiado de sustancias psicotrópicas o químicas controladas, en las instalaciones mencionadas, está prohibido a todos los empleados, directivos, asociados comerciales, socios y contratistas presentarse al sitio de trabajo bajo la influencia del alcohol, estupefacientes o sustancias psicotrópicas (drogas que tienen la habilidad de alterar los sentimientos, percepciones o humor del individuo y que afectan el sistema nervioso central, produciendo excitación e incoordinación psicomotora), así como consumirlas y/o incitar a consumirlas en dicho sitio. Se excluye de esta política el consumo de cigarrillo dentro de los ambientes abiertos y autorizados expresamente por escrito por <b>LA EMPRESA</b>, los ambientes autorizados para el consumo de cigarrillo por <b>LA EMPRESA</b> deberán estar claramente especificados por medio de un letrero que así lo informe, en caso contrario se deberá asumir que tal espacio no está autorizado para el consumo de cigarrillo.</p>

         <p><b>DECIMA SEXTA – USO DE CLAVES Y ACCESOS A PLATAFORMAS:</b> <b>LA (EL) MODELO</b> declara conocer la responsabilidad que implica el recibir el derecho al uso de claves de acceso a los sistemas de información y transmisión webcam de cada página, facultad que es conferida exclusivamente para cumplir con el objeto de este contrato, igualmente <b>LA (EL) MODELO</b> conoce y acepta el carácter personal e intransferible del citado derecho y se compromete a no divulgarlos verbalmente o por escrito, directa o indirectamente y a no utilizarlos en acciones que no estén de acuerdo con los compromisos, funciones y usos definidos, se compromete a adoptar las medidas tendientes a evitar infectar de virus los equipos de cómputo que use y a no instalar o ejecutar programas no autorizados por <b>LA EMPRESA</b>, comprometiéndose a no divulgar información que maneje o conozca de los sistemas de <b>LA EMPRESA</b>, ni a utilizarlos para beneficio propio o de terceros, acepta que es prohibido el préstamo de claves o usuarios asignadas para la transmisión en páginas, el no cumplimiento de lo aquí consignado se considerará FALTA GRAVE.</p>

        <p><b>DECIMA SÉPTIMA – SISTEMA DE MONITOREO:</b> <b>LA (EL) MODELO</b> acepta y comprende que <b>LA EMPRESA</b> cuenta con un sistema cerrado de vigilancia integrado por un conjunto de cámaras vigiladas remotamente en gran parte de sus instalaciones, exceptuando los baños los cuales hacen parte de la integridad y privacidad de cada persona, comprometiéndose a no desconectar u ocultar la visual de la cámara, igualmente comprende y acepta que <b>LA EMPRESA</b> cuenta con un sistema de control de acceso el cual se encarga de verificar horas de ingreso de cada integrante.</p>

        <p><b>DECIMA OCTAVA - ACUERDO DE PRESENTACIÓN PERSONAL Y FORMACIÓN EN SEGUNDA LENGUA EXTRANJERA:</b> <b>LA (EL) MODELO</b> manifiesta su compromiso por asistir cada día a las instalaciones de <b>LA EMPRESA</b> de una manera impecable, demás elementos dentro de esta categoría, así como vestimenta que realce su perfil como modelo, está de acuerdo y se compromete a suministrar una sábana o edredón que se vea bien en cámara con el fin de personalizar su room de transmisión, igualmente entiende que el uso de sabanas o edredón es una política de aseo y salubridad implementada por <b>LA EMPRESA</b> y que deberá estar acorde a la decoración del espacio, para la adquisición de una sábana o edredón propio tendrá un máximo de quince (15) días para su respectiva adquisición, <b>LA EMPRESA</b> podrá retener los dineros generados por concepto de utilidad y/o honorarios a <b>LA (EL) MODELO</b> hasta el no cumplimiento efectivo de este acuerdo de manera indeterminada.</p>

        <p><b>DECIMA NOVENA – CESIÓN TOTAL DE DERECHOS:</b> <b>LA (EL) MODELO</b> autoriza a <b>LA EMPRESA</b> para utilizar sus actuaciones, nombre artístico, imagen, persona, voz, fotos, chat, video, audio, documento de identificación, datos reales y cualquier otro aspecto asociado a la interacción de páginas web en vivo para adultos, a nivel mundial,  de forma irrevocable y sin limitación, <b>LA (EL) MODELO</b> concede y asigna a <b>LA EMPRESA</b> todos los derechos, títulos, intereses y derechos de autor asociados con su apariencia, acepta desde ahora que los Nickname, cuentas en páginas, fotos, perfiles, clientes y la totalidad de las transmisiones son de propiedad de <b>LA EMPRESA</b>, por lo que entiende que la totalidad de los derechos de autor sobre las producciones y transmisiones realizadas por parte de <b>LA (EL) MODELO</b> en su calidad de interprete pertenecen de manera irrevocable y a perpetuidad a <b>LA EMPRESA</b>, <b>LA (EL) MODELO</b> está de acuerdo que <b>LA EMPRESA</b> pueda editar su apariencia estética, así como que <b>LA EMPRESA</b> podrá imponer metas de cumplimiento cada periodo para el buen desarrollo de sus negocios.</p>
        
        <p><b>PARÁGRAFO PRIMERO -  CESIÓN DEL CONTRATO: LA EMPRESA</b> no podrá ceder el contrato parcial o totalmente sin el previo consentimiento escrito de <b>LA (EL) MODELO</b>.</p>

        <p>Por la presente, <b>LA (EL) MODELO</b> exime y libera a <b>LA EMPRESA</b> de cualquier y todo reclamo, demanda o causa de acción que pueda tener, ya sea por difamación, derechos de autor, violación de derechos de privacidad o publicidad, o cualquier otro asunto que surja de cualquier manera relacionada con el uso de su apariencia o el ejercicio de los derechos aquí garantizados, certificando <b>LA (EL) MODELO</b> que todas las declaraciones, las garantías y otra información proporcionada son verdaderas y exactas, y está de acuerdo en ser legalmente responsables de cualquier reclamación que surja de tales declaraciones y garantías, <b>LA (EL) MODELO</b> certifica que tiene dieciocho (18) años de edad o más, es de mente y cuerpo sano, no está bajo la influencia de drogas o alcohol, actúa por su propia voluntad y no cree que esté violando puntos de vista morales de su comunidad, <b>LA (EL) MODELO</b> entiende perfectamente el contenido de este contrato y es legalmente capaz de ejecutarlo.</p>

        <p><b>LAS PARTES en señal de ACEPTACIÓN y RATIFICACIÓN</b> de todas y cada una de las cláusulas precedentes, de común acuerdo y a convenir a sus legítimos intereses, declaran bajo gravedad de juramento que no se encuentran incursos en ninguna de las incompatibilidades, inhabilidades o prohibiciones de que trata la ley y demás normas sobre la materia, igualmente manifiestan que esta decisión es libre y espontánea y no han sido coaccionados a la toma de esta.</p>

        <p>En constancia de lectura, conformidad, aceptación y ejecución se firma en la ciudad de <b><?php echo $empresa->ciudad ?></b> el día <b><?php setlocale(LC_ALL,"es_ES");
        echo strftime("%A %d de %B del %Y"); ?></b>.</p>
        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="30%"><b>LA EMPRESA</b></td>
                <td width="15%"></td>
                <td width="30%"><b>LA MODELO</b></td>
                <td width="5%"></td>
                <td width="20%"></td>
            </tr>
            <tr>
                <td style="height: 60px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="borderleft borderight bordetop"></td>
            </tr>
            <tr>
                <td class="bordetop"><?php echo $empresa->nombre_representante_legal; ?></td>
                <td style="border:none;width: 60px;"> </td>
                <td class="bordetop"><b><?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?></b></td>
                <td></td>
                <td class="borderleft borderight"></td>
            </tr>
            <tr>
                <td><?php echo $empresa->rol_cargo; ?></td>
                <td></td>
                <td>Representante en nombre propio.</td>
                <td></td>
                <td class="borderleft borderight"></td>
            </tr>
            <tr>
                <td>Cédula Ciudadanía No <b><?php echo $empresa->nro_identificacion_representante_legal; ?></b></td>
                <td></td>
                <td><?php echo ucwords(mb_strtolower ($v->tipo_identificacion)).' No '?><b><?php echo $v->identificacion; ?></b></td>
                <td></td>
                <td class="borderleft borderight bordeBottom"></td>
            </tr>
        </table>
    </div> 
<?php } ?>
</div>
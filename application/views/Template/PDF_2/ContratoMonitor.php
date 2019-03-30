 <?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
$modulo           = $this->ModuloActivo;
$prefijo = centrodecostos($this->user->centro_de_costos)->abreviacion;
$row        =   getOpcionesContrato();
$json       =   json_decode(@$row->json);
//pre($json);
//pre($this->$modulo->result);
//pre($empresa);
?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:10px; font-family:font-family: 'Montserrat', sans-serif;text-align: justify;"">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
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
    <div style="height: 10px;"></div>
<?php foreach ($this->$modulo->result as $k => $v) { ?>
    <div style="text-align: center;">
        <b>
            Contrato comercial de cuentas en participación 
            <?php
                    if(empty($OpcionesFactura->prefijoFacturaFac)){
                        echo $prefijo;
                    }else{
                        echo $OpcionesFactura->prefijoFacturaFac;
                    }
                    echo '-'.ceros(contrato($this->uri->segment(3))->consecutivo_id);  
            ?>
            <br/>entre <?php echo $empresa->nombre_legal?> y <?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>.
        </b>
    </div>
    <div style="height: 20px;"></div>

    <div>
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
        <p>Entre los suscritos a saber de una parte <b><?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?></b>, identificada(o) con <b><?php echo $v->tipo_identificacion; ?></b> número <b><?php echo $v->identificacion; ?></b> expedida en la ciudad de <b><?php echo $v->lugar_expedicion_documento_identidad; ?></b>, domiciliada(o) en la <b><?php echo $v->direccion; ?>, <?php echo $v->ciudad; ?> <?php echo $v->departamento; ?></b> y número de contacto (<b><?php echo $v->cod_telefono; ?></b>) <b><?php echo $v->telefono; ?></b>; actuando en calidad de <b>CONTRATISTA </b> quien en adelante será llamada(o) <b>LA (EL) CONTRATISTA</b>, acuerda que unirá sus esfuerzos comerciales y profesionales a los del <b><?php echo $empresa->nombre_legal?></b>; con número de identificación tributario <b><?php echo $empresa->identificacion;?></b> - <b><?php echo $empresa->identificacion_ext; ?></b>, empresa legalmente constituida, cuyo objeto social es la exportación de servicios de operación o gestión de sitios web y medios multimedia que ofrecen servicios interactivos en vivo para mayores de Dieciocho (18) años, incluyendo pero sin limitarse la operación de redes sociales encargadas de poner en contacto entre sí a personas cuya mayoría de edad les permite buscar compañía o amistad, servicios de citas y servicios de agencias matrimoniales online; con sede en la ciudad de <b><?php echo $empresa->ciudad; ?></b>, en la <b><?php echo $empresa->direccion; ?></b>, quien en adelante se llamará <b>LA EMPRESA</b>, actuando en calidad de <b>CONTRATANTE</b>, cada uno actuando como comerciante, en nombre propio declaran que entienden que estarán vinculados al entretenimiento webcam para adultos, que realizará esta actividad de forma autónoma y sin ningún tipo de presión, que los integrantes de <b>LA EMPRESA</b> le han informado a <b>LA (EL) CONTRATISTA</b> de forma detallada los beneficios y riesgos de estas labores, igualmente comprende que la actividad en mención está íntimamente relacionada con la libertad de expresión la cual es reconocida como un derecho fundamental consagrada en la DECLARACIÓN UNIVERSAL DE DERECHOS HUMANOS en su Artículo Diecinueve (19) y el Derecho fundamental de libre expresión consagrado en la CONSTITUCIÓN NACIONAL DE LA REPUBLICA DE COLOMBIA en su Artículo Veinte (20), donde “se garantiza a toda persona la libertad de expresar y difundir su pensamiento, opiniones y buen actuar”; acuerdan las partes celebrar el presente <b>CONTRATO COMERCIAL POR PRESTACIÓN DE SERVICIOS Y ACOMPAÑAMIENTO PROFESIONAL.</b></p>

        <h4 style="text-align: center;">CONSIDERACIONES PRELIMINARES.</h4>

        <p><b>Consideración # 001: LA (EL) CONTRATISTA</b> comprende y acepta que <b>LA EMPRESA</b> posee o gestiona uno o más sitios web que ofrecen servicios webcam interactivos en vivo para adultos de contenido erótico.</p>

        <p><b>Consideración # 002: LA (EL) CONTRATISTA</b> comprende su responsabilidad ejecutar de manera personal las actividades objeto de este contrato.</p>

        <p><b>Consideración # 003: LAS PARTES </b> se entienden como comerciantes independientes, NO EXISTIENDO entre ellas relación laboral que conlleve a cualquier tipo de carga prestacional como primas, vacaciones, cesantías o demás compensaciones al momento de terminar el contrato o durante la vigencia del mismo, diferente a los honorarios aquí establecidos. </p>

        <p>Consideración # 004: LA (EL) CONTRATISTA</b> comprende que <b>LA EMPRESA</b> cuenta con un sistema de monitoreo interno donde <b>Consideración # 005: LA (EL) CONTRATISTA</b> comprende que <b>LA EMPRESA</b> cuenta con un sistema de monitoreo interno donde podrá acceder en cualquier momento y sin previo aviso a la transmisión en vivo, por lo cual <b>LA (EL) CONTRATISTA</b> autoriza desde</p>
 
        <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
            <table>
                <tr>
                    <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                    <td style="text-align: center;font-size: 9px;">Página 1 / 7</td>
                    <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="page-break-after:always;"></div>
    <div>
        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="30%" colspan="2">
                    <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
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
        <div style="height: 10px;"></div>

        <p> ahora y de forma irrevocable por el tiempo que dure este contrato a cualquier funcionario competente de <b>LA EMPRESA</b> o quien haga sus veces para el respectivo monitoreo, control de calidad y seguimiento.</p>

        <p><b>Consideración # 006: LA (EL) CONTRATISTA</b> comprende y acepta que es la(el) única(o) persona autorizada(o) para el desarrollo de sus actividades, por ende <b>LA EMPRESA</b> en ningún caso permitirá el desarrollo de funciones de alguien más en nombre de <b>LA (EL) CONTRATISTA</b>, le queda completamente prohibido a <b>LA (EL) CONTRATISTA</b> permitir que accedan a su cuenta, compartir información de inicio de sesión, contraseñas, datos o información de cuenta, correo electrónico con otra persona, diferente a los directivos y administradores de LA EMPRESA.</p>

        <p><b>Consideración # 007:</b> Para el perfeccionamiento del presente contrato <b>COMERCIAL POR PRESTACIÓN DE SERVICIOS Y ACOMPAÑAMIENTO PROFESIONAL, LA (EL) CONTRATISTA</b> ha presentado uno o más documentos de identificación a <b>LA EMPRESA</b> que certifica que es mayor de edad, donde se ha podido evidenciar su nombre completo, foto y fecha de nacimiento, informando desde ahora <b>LA EMPRESA</b> que ante la falsificación de tales documentos por parte de <b>LA (EL) CONTRATISTA, LA EMPRESA</b> repercutirá contra esta de forma penal en amparo del Código Penal Colombiano en su <b>TITULO IX “DELITOS CONTRA LA FE PUBLICA”, CAPITULO SEGUNDO “DE LA FALSIFICACIÓN DE SELLOS, EFECTOS OFICALES Y MARCAS”</b> y su <b>CAPITULO TERCERO “DE LA FALSEDAD EN DOCUMENTOS”;</b> en los artículos comprendidos del <b>DOSCIENTOS SETENTA Y NUEVE (279) al DOSCIENTOS NOVENTA Y SEIS (296)</b>, por falsificación en documento privado, falsificación en documento público y demás delitos contra la fe pública o aquellos a los que diese lugar considerados en el código penal Colombiano y normas concordantes, en los casos en que <b>LA (EL) CONTRATISTA</b> deba entrevistar personal para desempeñarse como <b>MODELO WEBCAM</b>, deberá garantizar que no existirá presencia de menores de edad, en caso contrario <b>LA EMPRESA</b> estará en la obligación de poner en conocimiento de las autoridades competentes esta situación, para que estas actúen de manera rigorosa ante tal conducta.</p>

        <p><b>Consideración # 008: LA (EL) CONTRATISTA</b> comprende que para la ejecución efectiva del presente contrato <b>LA EMPRESA</b> pondrá a disposición mobiliario y elementos tecnológicos, tales elementos serán entregados de manera provisional, por lo cual ante su uso indebido <b>LA EMPRESA</b> podrá poner en conocimiento de las autoridades correspondientes el <b>“ABUSO DE CONFIANZA”</b>, contemplado en el Código Penal Colombiano en su CAPITULO QUINTO “DEL ABUSO DE CONFIANZA”; en su artículo DOSCIENTOS CUARENTA Y NUEVE (249), <b>“El que se apropie en provecho suyo o de un tercero, de cosa mueble ajena, que se le haya confiado o entregado por un título no traslativo de dominio, incurrirá en prisión de uno (1) a cuatro (4) años y multa de diez (10) a doscientos (200) salarios mínimos legales mensuales vigentes. La pena será de prisión de uno (1) a dos (2) años y multa hasta de diez (10) salarios mínimos legales mensuales vigentes, cuando la cuantía no exceda de diez (10) salarios mínimos legales mensuales vigentes. Si no hubiere apropiación sino uso indebido de la cosa con perjuicio de tercero, la pena se reducirá en la mitad”</b>; por lo cual <b>LA (EL) CONTRATISTA</b> se obliga al momento de la terminación del presente contrato de entregar en perfecto estado todos los elementos tecnológicos y mobiliario suministrados por <b>LA EMPRESA.</b></p> 

        <p><b>Consideración # 009: LA (EL) CONTRATISTA</b> no podrá, en ningún caso, solicitar a cualquier funcionario de <b>LA EMPRESA</b> información personal o privada para beneficio personal o de un aliado comercial directo o no de <b>LA EMPRESA</b> o de <b>LA (EL) CONTRATISTA, LA EMPRESA</b> repercutirá de manera penal contra <b>LA (EL) CONTRATISTA</b> de comprobar que ha utilizado la información de la empresa, de su equipo de trabajo, modelos, contratistas y/o accionistas para beneficio personal, estableciendo desde ahora una cláusula de confidencialidad sobre la totalidad de la información a la que tenga acceso <b>LA (EL) CONTRATISTA</b>; establecido en <b>SETENTA MILLONES, CUATROSCIENTOS CINCUENTA Y OCHOS MIL PESOS MONEDA LEGAL ($70.458.000).</b></p> 

        <p><b>Consideración # 010: LA (EL) CONTRATISTA</b> guardará total confidencialidad durante la vigencia del presente contrato y un período de diez (10) años adicionales después de la terminación del mismo sobre el manejo y secretos comerciales internos de <b>LA EMPRESA</b>, la información exclusiva de <b>LA EMPRESA</b> incluye pero no se limita a los siguientes aspectos: sus sitios web, software, empleados, clientes, afiliados y proveedores de servicios: funciones, características, opciones, preferencias, código de programación, estilo, colores, diseños, costos, rentabilidad, estadísticas, datos y cualquier otra información de cualquier manera relacionada con <b>LA EMPRESA</b>  o sobre el cómo <b>LA EMPRESA</b> realiza negocios.</p>

        <p><b>Consideración # 011: LA EMPRESA</b> hace especial claridad a <b>LA (EL) CONTRATISTA</b> respecto a la clara responsabilidad que tiene en el desarrollo de los objetivos comerciales de LA EMPRESA; lo que permitirá la continuidad o no del presente contrato comercial.</p>      

        <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
            <table>
                <tr>
                    <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                    <td style="text-align: center;font-size: 9px;">Página 2 / 7</td>
                    <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="page-break-after:always;"></div>
    <div>
        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
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
    <div style="height: 10px;"></div>

        <div>
            <h4 style="text-align: center;">EL PRESENTE CONTRATO COMERCIAL POR PRESTACIÓN DE SERVICIOS Y ACOMPAÑAMIENTO PROFESIONAL, SE REGIRA POR LAS SIGUIENTES:</h4>    
        </div>

        <p><b>PRIMERA – OBJETO: LA (EL) CONTRATISTA</b> en su calidad de trabajador independiente, se obliga para con <b>LA EMPRESA</b> a ejecutar cuanta actividad sea necesaria propias del servicio contratado el cual debe realizar de conformidad con las condiciones y cláusulas del presente documento y que consistirá en la <b>FORMACIÓN</b>, <b>CAPACITACIÓN Y MONITOREO DEL EQUIPO DE TRABAJO DE  MODELOS;</b> así como el apoyo en actividades de índole comercial y administrativo que la empresa determine según las necesidades y la buena marcha de sus negocios, sin que <b>EXISTE HORARIO DETERMINADO;</b> ni dependencia. </p>

        <p><b>SEGUNDA – DURACIÓN:</b>  El término de duración que por este contrato se constituye es de <b>VENTICUATRO (24) MESES</b>, que se contará a partir de la fecha de la firma de este documento, podrá darse por terminado en cualquier momento por parte de <b>LA EMPRESA</b> y por parte de <b>LA (EL) CONTRATISTA</b> después de cumplido el <b>SETENTA POR CIENTO (70%) DEL TIEMPO CONTRATATO</b>, siempre y cuando <b>LAS PARTE</b> informe a la otra con un total de <b>QUINCE (15)</b> días antes su intención de no continuar con el contrato; después de retirada <b>LA (EL) CONTRATISTA, LA EMPRESA</b> contará con hasta <b>TREINTA (30) DÍAS HÁBILES</b> para la consignación de los dinero adeudados, no obstante, las partes, de común acuerdo, y según el desarrollo de las actividades de <b>LA (EL) CONTRATISTA</b> podrán anticipar o aplazar su término de vigencia. </p>

        <p><b>TERCERA – ÁMBITO GEOGRÁFICO:</b> Las actividades se ejecutarán en las instalaciones de <b>LA EMPRESA;</b> ubicadas la ciudad de <b><?php echo $empresa->ciudad; ?></b>, en la <b><?php echo $empresa->direccion; ?></b> y en la ciudad de <b><?php echo $empresa->ciudad; ?></b> en la <b><?php echo $empresa->direccion ?></b> y podrán ser modificado por acuerdo entre las partes, contemplando la posibilidad de que <b>LA (EL) CONTRATISTA</b> realice actividades desde su casa de común acuerdo con <b>LA EMPRESA.</b></p>

        <p><b>CUARTA – VALOR DEL CONTRATO: LAS PARTES</b> establecen un valor mensual de <b>UN MILLON CIENTO SETENTA MIL, TRESCIENTOS PESOS MONEDA LEGAL ($1.170.300)</b>, de los cuales <b>LA (EL) CONTRATISTA</b> autoriza de manera irrevocable a la empresa para pagar a el proveedor de afiliación a seguridad social <b>PROMOVIENDO S.A.S;</b> la suma de <b>CIENTO TRECE MIL PESOS MONEDA LEGAL ($113.000)</b> y realizar las respectivas deducciones por concepto de retención en la fuente a título de servicios, para un contrato total por valor de <b>VEINTIOCHO MILLONES, CERO OCHENTA Y SITE MIL, DOSCIENTOS PESOS MONEDA LEGAL ($28.087.200)</b></p>

        <p><b>PARÁGRAFO PRIMERO:</b> Acuerdan, aceptan y entienden <b>LAS PARTES</b> ante el incumplimiento del tiempo contratado por parte de <b>EL (LA) CONTRATISTA</b> deberá pagar a <b>LA EMPRESA</b> un porcentaje equivalente al <b>VEINTICINCO PUNTO DOS POR CIENTO (25,2%)</b> sobre el valor total del contrato, estimado en <b>SIETE MILLONES, SETENTA Y SIETE MIL, NOVESCIENTOS SETENTA Y CUATRO PESOS MONEDA LEGAL ($7.077.974).</b></p>

        <p><b>QUINTA -  EXCLUSIVIDAD DEL SERVICIO: LA (EL) CONTRATANTE</b> se compromete con <b>LA EMPRESA</b> a realizar la actividad contratada y/o conexas exclusivamente para ella, el incumplimiento a esta cláusula obligará al pago de un porcentaje equivalente al <b>VEINTICINCO PUNTO DOS POR CIENTO (25,2%)</b> sobre el valor total del contrato, estimado en <b>SIETE MILLONES, SETENTA Y SIETE MIL, NOVESCIENTOS SETENTA Y CUATRO PESOS MONEDA LEGAL ($7.077.974) ,</b></p>

        <p><b>SEXTA - NATURALEZA DEL CONTRATO:</b> La naturaleza del presente contrato se circunscribe al de <b>CONTRATO COMERCIAL POR PRESTACIÓN DE SERVICIOS Y ACOMPAÑAMIENTO PROFESIONAL</b> y en consecuencia <b>NO EXISTIRÁ VÍNCULO LABORAL ALGUNO ENTRE LAS PARTES.</b> </p>        

        <p><b>SÉPTIMA - INDEPENDENCIA:</b> Para el desarrollo de su gestión <b>LA (EL) CONTRATANTE</b> tendrá plena independencia, tanto técnica, como directiva y administrativa en la realización de sus actividades, lo que quiere decir que no tendrá dedicación exclusiva para con <b>LA (EL) CONTRATISTA</b>, ni estará subordinado o condicionado a trabajo, <b>LAS PARTES</b> acuerdan que en la cláusula <b>SEXTA</b> que <b>EL (LA) CONTRATISTA</b> solo desarrollará las actividades objeto del presente contrato y actividades conexas a excepción de la de <b>MODELO WEBCAM INDEPENDIENTE</b> exclusivamente con <b>LA EMPRESA</b> y nadie más, se incluye dentro de esta limitación la posibilidad de tener o ser accionista directa o por interpuesta persona de una empresa y/o negocio que tenga por objeto social el mismo de <b>LA EMPRESA.</b></p>

        <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
            <table>
                <tr>
                    <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                    <td style="text-align: center;font-size: 9px;">Página 3 / 7</td>
                    <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="page-break-after:always;"></div>
    <div>
        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="30%" colspan="2">
                    <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
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
        <div style="height: 10px;"></div>

        <p><b>OCTAVA – OBLIGACIONES: LA EMPRESA</b> deberá facilitar acceso a la información y elementos que sean necesarios, de manera oportuna, para la debida ejecución del objeto del contrato, y, estará obligado a cumplir con lo estipulado en las demás cláusulas y condiciones previstas en este documento. <b>EL (LA) CONTRATISTA</b> deberá cumplir en forma eficiente y oportuna los trabajos encomendados y aquellas obligaciones que se generen de acuerdo con la naturaleza del servicio, además se compromete a afiliarse a una empresa promotora de salud EPS, y cotizar igualmente al sistema de seguridad social tal como lo indica el <b>ARTICULO 15 de la LEY 100 de 1993</b>, para lo cual se dará un término de <b>QUINCE (15)</b> días contados a partir de la fecha de iniciación del contrato.</p>

        <p><b>NOVENA - CAUSALES DE TERMINACIÓN:</b> Podrá darse por terminado ante la ocurrencia de cualquiera de los hechos que se relacionan a continuación: </p>

        <p>a) Acuerdo mediante el cual <b>LAS PARTES</b> decidan dar por terminado el presente contrato de prestación de servicios.<br>
        b) Por la no realización de los trabajos operativos y dotación de mobiliario por parte de <b>LA EMPRESA</b> necesarios para el cumplimiento del objeto del contrato.<br>
        c) Por la variación injustificada por parte de <b>LA (EL) CONTRATISTA</b> de los valores acordados en este contrato.<br>
        d) Por el incumplimiento injustificado de las actividades programadas dentro del plazo del contrato.<br> 
        e)   Por el incumplimiento por parte de <b>LA (EL) CONTRATISTA</b> de los <b>“PRINCIPIOS DE LA EMPRESA”</b>, comprometiéndose a aplicarlos de forma integral, entre los cuales figuran en forma enunciativa pero no limitativa los siguientes: </p>
        <div style="padding-left:30px; ">
            <p>a.   No emplear o contratar menores de edad por debajo de la edad mínima de contratación prevista por la legislación y reglamentación del trabajo en cualquier actividad directa o indirectamente relacionada con la ejecución del objeto del contrato.<br>
            b.   Proporcionar un ambiente de trabajo digno y seguro.<br>
            c.  Generar un ambiente de trabajo en el que se respete la dignidad de las personas y no tolerar en su contra ninguna forma de acoso físico o sexual, discriminación o cualquier otro tipo abuso de cualquier naturaleza que este sea.<br>
            d.   Cumplir en todo momento con las leyes que resulten aplicables a las actividades propias de su giro, el incumplimiento por parte de <b>LA (EL) CONTRATISTA</b> de los mencionados principios dará lugar a la terminación del presente contrato, sin perjuicio de responder por los perjuicios que tal incumplimiento cause a <b>LA EMPRESA</b>,<br>
            e.   Por la terminación del proyecto.</p>
        </div>
        <p>Frente a la ocurrencia de cualquiera de los hechos descritos <b>LA (EL) CONTRATISTA</b> podrá conminar mediante conminación escrita a <b>LA EMPRESA</b>, para que dentro de los tres (3) días siguientes a la fecha de la misma, se halle a cumplir con la obligación dentro del término señalado. </p>

        <p>En el evento en que <b>LA EMPRESA</b> no cumpliere con la obligación dentro del término señalado <b>LA (EL) CONTRATISTA</b> está facultada(o) para dar por terminado el contrato de forma anticipada, mediante comunicación escrita dirigida a <b>LA EMPRESA.</b> </p>

        <p>Una vez <b>LA (EL) CONTRATISTA</b> proceda a la terminación anticipada del contrato <b>COMERCIAL POR PRESTACIÓN DE SERVICIOS Y ACOMPAÑAMIENTO PROFESIONAL</b>, se realizará la liquidación del mismo, y la cancelación de los saldos pendientes a cargo de <b>LAS PARTES</b> a más tardar en los <b>TREINTA (30) DÍAS HÁBILES SIGUIENTES</b>, sin que ello diere lugar a indemnización o compensación alguna en favor de alguna de LAS PARTES, sin perjuicios de la aplicación de las sanciones contractuales a que haya lugar.</p>

        <p><b>DECIMA - SUPERVISIÓN: LA EMPRESA</b> o alguno de su(s) representante(s) supervisará(n) la ejecución del servicio encomendado, y podrá formular las observaciones del caso, para ser analizadas conjuntamente con <b>LA (EL) CONTRATISTA</b>, se establece entre LAS PARTES una reunión semanal donde se planifique cada una de las actividades a desarrollar.    </p>

        <p><b>PARÁGRAFO PRIMERO - EXCLUSIÓN: LA EMPRESA</b> no será responsable de las obligaciones o acreencias de carácter civil o comercial que <b>LA (EL) CONTRATISTA</b> contraiga con terceros en ejecución del presente contrato.</p>

        <p><b>DECIMA PRIMERA -  MODIFICACIONES:</b> Cualquier modificación al presente contrato debe efectuarse por escrito y anexarse a este documento mediante <b>OTRO SÍ.</b></p>
        <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
            <table>
                <tr>
                    <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                    <td style="text-align: center;font-size: 9px;">Página 4 / 7</td>
                    <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="page-break-after:always;"></div>
    <div>
        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="30%" colspan="2">
                    <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
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
        <div style="height: 10px;"></div>

        <p><b>DECIMA SEGUNDA – OBLIGACIONES ADICIONALES DE LA EMPRESA: LA EMPRESA</b> adquiere para con <b>LA (EL) CONTRATISTA</b> las siguientes obligaciones: </p>

        <p>a)   Proporcionar los espacios para que <b>LA (EL) CONTRATISTA</b> dé apertura a una cuenta bancaria personal en el <b>BANCO BBVA BILBAO VIZCAYA ARGENTARIA, BANCO DAVIVIENDA S.A. y/o el BANCO BANCOLOMBIA S.A.</b> para el pago quincenal de sus honorarios a más tardar treinta (30) días corrientes del inicio de sus actividades, en caso contrario los pagos en efectivos serán programados hasta siete (7) días posteriores al cierre del periodo de facturación, debido a los procesos internos de <b>LA EMPRESA.</b><br>
        b)   Facturar los servicios prestados con todos los requisitos de ley, donde incluirá los tributos y gravámenes y cancelará oportunamente a las autoridades encargadas del recaudo.<br>
        c)   Entregar completamente limpio, libre de basura y demás elementos el ambiente de transmisión de <b>LA (EL) CONTRATISTA</b>, con el fin de que esta lo devuelva de igual manera.<br>
        f)  El pago de seguridad social.<br>
        d)   Guardar confidencialidad sobre la información que le facilite <b>LA (EL) CONTRATISTA</b> en o para la ejecución del contrato o que por su propia naturaleza deba ser tratada como tal, se excluye de la categoría de información confidencial toda aquella información que sea divulgada por <b>LA (EL) CONTRATISTA</b>, aquella que haya de ser revelada de acuerdo con las leyes o con una resolución judicial o acto de autoridad competente, este deber se mantendrá durante un plazo de diez (10) años más a contar desde la finalización del servicio.</p>

        <p><b>DECIMA TERCERA – UTILIDADES Y PÉRDIDAS:</b>  Las utilidades que resulten del ejercicio de la asociación se distribuirán entre los asociados en los porcentajes mencionados en la <b>CLÁUSULA QUINTA</b> de este contrato y teniendo en cuenta la fecha en que haya hecho el aporte. En caso de pérdidas, éstas serán asumidas por <b>LA EMPRESA</b>, salvo aquellas que tengan que ver con el no pago por parte de las plataformas a <b>LA EMPRESA</b>, ante tal situación <b>LA EMPRESA</b> se excluye de responder por estos dinero ante <b>LA (EL) CONTRATISTA.</b></p>

        <p><b>DECIMA CUARTA - POLITICAS INTEGRALES:</b> Estas políticas entrarán en vigor a partir de su firma y publicación en todas las sedes e instalaciones de <b>LA EMPRESA</b>, y aplica a todos los directivos, trabajadores, contratistas, asociados comerciales y terceros que se encuentren y/o permanezcan en las instalaciones de <b>LA EMPRESA.</b></p>

        <p>a)   <b>BIENES DE LA EMPRESA:</b> Los bienes de <b>LA EMPRESA NO</b> se deben utilizar para el beneficio personal o de cualquier otra persona que no haga parte de esta, para ello: las llamadas personales y en casos que lo ameriten usando el sentido común, están bien de manera esporádica, se convertirán en nocivas o no debidas cuando se presenten de manera recurrente, los dispositivos de comunicación, tecnológicos,  de inmobiliario y papelería  de <b>LA EMPRESA</b> son para uso racional y que involucre actividades inherentes a la compañía, el hurto o retiro de los bienes de <b>LA EMPRESA</b> o de cualquier miembro de los mismos sin justificación que lo amerite, se considerará como una falta grave que atenta contra la integridad de <b>LA EMPRESA</b>, el uso de las computadoras deberá ser el adecuado y jamás en aquellas que atenten contra el buen nombre, la ética y falten al respeto de los demás miembros <b>LA EMPRESA.</b><br>
        b)   <b>USO DE LA INFORMACIÓN:</b> Por la naturaleza de nuestra actividad y la reserva de todos, toda la información  de <b>LA EMPRESA</b> se considera de carácter NO pública, esto implica nombres de modelos, planes estratégicos, bases de datos, documentación legal, logos, entre otros, el cuidado y correcto uso de dicha información es responsabilidad de todos y cada uno de los integrantes de <b>LA EMPRESA</b>, la información no pública está igualmente restringida a familiares y amigos, la protección de la información de <b>LA EMPRESA</b> se debe dar bajo cualquier circunstancia tanto en horarios laborales o de transmisión como en otros campos y deberá conservarse sin importar si se ha finalizado la relación comercial, civil o laboral con esta.<br>
        c)  <b>PRIVACIDAD:</b> Los datos personales de los empleados, contratistas, socios, asociados comerciales y clientes de <b>LA EMPRESA</b> son tratados respetando siempre la privacidad; en caso de que debamos manejar información privada se deberá tener en cuenta la responsabilidad de actuar de acuerdo con todas las obligaciones contractuales pertinentes, limitando el acceso a la información por parte de terceros teniendo cuidado de revelar la información de manera no autorizada.<br>
        d) <b>EXIGENCIAS: LA EMPRESA</b> exige a todos los integrantes o terceros que permanezcan dentro de sus instalaciones: </p>

        <p style="padding-left: 30px;">
            a. El uso de vocabulario adecuado y de manera amable tanto con los miembros de <b>LA EMPRESA</b> como con clientes.<br> 
            b.  La excelente presentación personal que posibilite un trato agradable y la facilidad de un acercamiento adecuado con su entorno.<br>
            c.  El cumplimiento con las condiciones legales impuestas al momento de la contratación y su alcance contractual, así como el respeto por la compañía, su imagen y el buen nombre tanto en las actividades laborales, comerciales y civiles como por fuera de
        </p>

        <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
            <table>
                <tr>
                    <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                    <td style="text-align: center;font-size: 9px;">Página 5 / 7</td>
                    <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="page-break-after:always;"></div>
    <div>
        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="30%" colspan="2">
                    <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
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
        <div style="height: 10px;"></div>
        <div style="padding-left: 30px;">
            <p>las mismas.<br>
            d.  La prohibición total del acceso a menores de edad a las instalaciones, <b>LA EMPRESA</b> pondrá en conocimiento de las autoridades competentes a quien valiéndose de sus posibilidades de acceso a las instalaciones ingrese a un menor de edad y repercutirá de manera penal, aclarando que LA EMPRESA cuenta con políticas de cero tolerancia ante esta situación.</p>
        </div>

        <p><b>DECIMA QUINTA – POLITICA DE ALCOHOLISMO, DROGADICCIÓN Y TABAQUISMO:</b> En línea con nuestro compromiso de mantener un ambiente de trabajo seguro y sano es política de <b>LA EMPRESA</b> prohibir la posesión, uso y comercialización de drogas ilícitas, bebidas embriagantes y tabaco al igual que el uso inapropiado de sustancias psicotrópicas o químicas controladas, en las instalaciones mencionadas, está prohibido a todos los empleados, directivos, asociados comerciales, socios y contratistas presentarse al sitio de trabajo bajo la influencia del alcohol, estupefacientes o sustancias psicotrópicas (drogas que tienen la habilidad de alterar los sentimientos, percepciones o humor del individuo y que afectan el sistema nervioso central, produciendo excitación e incoordinación psicomotora), así como consumirlas y/o incitar a consumirlas en dicho sitio. Se excluye de esta política el consumo de cigarrillo dentro de los ambientes abiertos y autorizados expresamente por escrito por LA EMPRESA, los ambientes autorizados para el consumo de cigarrillo por <b>LA EMPRESA</b> deberán estar claramente especificados por medio de un letrero que así lo informe, en caso contrario se deberá asumir que tal espacio no está autorizado para el consumo de cigarrillo.</p>

        <p><b>DECIMA SEXTA – USO DE CLAVES Y ACCESOS A PLATAFORMAS: LA (EL) CONTRATISTA</b> declara conocer la responsabilidad que implica el recibir el derecho al uso de claves de acceso a los sistemas de información y transmisión webcam de cada página, facultad que es conferida exclusivamente para cumplir con el objeto de este contrato, igualmente <b>LA (EL) CONTRATISTA</b> conoce y acepta el carácter personal e intransferible del citado derecho y se compromete a no divulgarlos verbalmente o por escrito, directa o indirectamente y a no utilizarlos en acciones que no estén de acuerdo con los compromisos, funciones y usos definidos, se compromete a adoptar las medidas tendientes a evitar infectar de virus los equipos de cómputo que use y a no instalar o ejecutar programas no autorizados por <b>LA EMPRESA</b>, comprometiéndose a no divulgar información que maneje o conozca de los sistemas de la empresa, ni a utilizarlos para beneficio propio o de terceros, acepta que es prohibido el préstamo de claves o usuarios asignadas para la transmisión en páginas, el no cumplimiento de lo aquí consignado se considerará <b>FALTA GRAVE.</b></p>

        <p><b>DECIMA SÉPTIMA – SISTEMA DE MONITOREO: LA (EL) CONTRATISTA</b> acepta y comprende que <b>LA EMPRESA</b> cuenta con un sistema cerrado de vigilancia integrado por un conjunto de cámaras vigiladas remotamente en gran parte de sus instalaciones, exceptuando los baños los cuales hacen parte de la integridad y privacidad de cada persona, comprometiéndose a no desconectar u ocultar la visual de la cámara, igualmente comprende y acepta que <b>LA EMPRESA</b> cuenta con un sistema de control de acceso el cual se encarga de verificar horas de ingreso de cada integrante.</p>

        <p><b>DECIMA OCTAVA - ACUERDO DE PRESENTACIÓN PERSONAL Y FORMACIÓN EN SEGUNDA LENGUA EXTRANJERA: LA (EL) CONTRATISTA</b> manifiesta su compromiso por asistir cada día a las instalaciones de <b>LA EMPRESA</b>  de una manera impecable,  por lo cual no utilizará ropa escotada dentro de lo que se incluye faldas, short o cualquier tipo de blusa que no refleje un perfil corporativo, igualmente manifiesta su disposición de utilizar uniforme en caso de que <b>LA EMPRESA</b> así lo determine y sea suministrado por <b>LA EMPRESA</b>; sin que esto cree vínculos contractuales diferentes a los aquí establecidos, de igual manera <b>LA (EL) CONTRATISTA</b> se compromete a no transmitir con ropa tipo exterior o con aquella que llegue a las instalaciones de <b>LA EMPRESA</b>, transmitir con un maquillaje adecuado, seguir las instrucciones de coordinadores, capacitadores, formadores y directivos de <b>LA EMPRESA</b> respecto a su estética, presentación y actuar frente a la cámara y según la estrategia y personaje definido, <b>LA (EL) CONTRATISTA</b> se compromete a descargar la aplicación móvil DUOLINGO™ y a presentar su avance como máximo cada cuatro (4) días, igualmente a profundizar en el idioma inglés y a pronunciar palabras básicas frente a cámara, así como a manejar redes sociales para la promoción permanente de su perfil, ver diariamente un mínimo de una hora páginas como Myfreecams® (Myfreecams.com) con el fin de aprender sobre presentación personal, decoración de room, ángulos, dinámicas, música y demás elementos artísticos propios de estas páginas, <b>LA (EL) CONTRATISTA</b> se compromete a adquirir juguetes sexuales terapéuticos como consoladores y demás elementos dentro de esta categoría, así como vestimenta que realce su perfil como modelo, está de acuerdo y se compromete a suministrar una sábana o edredón que se vea bien en cámara con el fin de personalizar su room de transmisión, igualmente entiende que el uso de sabanas o edredón es una política de aseo y salubridad implementada por <b>LA EMPRESA</b> y que deberá estar acorde a la decoración del espacio, para la adquisición de una sábana o edredón propio tendrá un máximo de quince (15) días para su respectiva adquisición, LA EMPRESA podrá retener los dineros generados por concepto de utilidad y/o honorarios a <b>LA (EL) CONTRATISTA</b> hasta el no cumplimiento efectivo de este acuerdo de manera indeterminada.</p>
        <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
            <table>
                <tr>
                    <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                    <td style="text-align: center;font-size: 9px;">Página 6 / 7</td>
                    <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="page-break-after:always;"></div> 
    <div>
        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="30%" colspan="2">
                    <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
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
        <div style="height: 10px;"></div>
                <div style="height: 10px;"></div>     
            <p><b>DECIMA NOVENA – CESIÓN TOTAL DE DERECHOS: LA (EL) CONTRATISTA</b> autoriza a <b>LA EMPRESA</b> para utilizar sus actuaciones, nombre artístico, imagen, persona, voz, fotos, chat, video, audio, documento de identificación, datos reales y cualquier otro aspecto asociado a la interacción de páginas web en vivo para adultos, a nivel mundial,  de forma irrevocable y sin limitación, <b>LA (EL) CONTRATISTA</b> concede y asigna a <b>LA EMPRESA</b> todos los derechos, títulos, intereses y derechos de autor asociados con su apariencia, acepta desde ahora que los Usuarios, cuentas en páginas, fotos, perfiles, clientes y la totalidad de las transmisiones son de propiedad de <b>LA EMPRESA</b>, por lo que entiende que la totalidad de los derechos de autor sobre las producciones y transmisiones realizadas por parte de <b>LA (EL) CONTRATISTA</b> en su calidad de interprete pertenecen de manera irrevocable y a perpetuidad a <b>LA EMPRESA, LA (EL) CONTRATISTA</b> está de acuerdo que <b>LA EMPRESA</b> pueda editar su apariencia estética, así como que <b>LA EMPRESA</b> podrá imponer metas de cumplimiento cada periodo para el buen desarrollo de sus negocios.</p>

            <p><b>PARÁGRAFO PRIMERO -  CESIÓN DEL CONTRATO: LA EMPRESA</b> no podrá ceder el contrato parcial o totalmente sin el previo consentimiento escrito de <b>LA (EL) CONTRATISTA.</b></p>

            <p>Por la presente, <b>LA (EL) CONTRATISTA</b> exime y libera a <b>LA EMPRESA</b> de cualquier y todo reclamo, demanda o causa de acción que pueda tener, ya sea por difamación, derechos de autor, violación de derechos de privacidad o publicidad, o cualquier otro asunto que surja de cualquier manera relacionada con el uso de su apariencia o el ejercicio de los derechos aquí garantizados, certificando <b>LA (EL) CONTRATISTA</b> que todas las declaraciones, las garantías y otra información proporcionada son verdaderas y exactas, y está de acuerdo en ser legalmente responsables de cualquier reclamación que surja de tales declaraciones y garantías, <b>LA (EL) CONTRATISTA</b> certifica que tiene dieciocho (18) años de edad o más, es de mente y cuerpo sano, no está bajo la influencia de drogas o alcohol, actúa por su propia voluntad y no cree que esté violando puntos de vista morales de su comunidad, <b>LA (EL) CONTRATISTA</b> entiende perfectamente el contenido de este contrato y es legalmente capaz de ejecutarlo.</p>

            <p><b>LAS PARTES</b> en señal de <b>ACEPTACIÓN y RATIFICACIÓN</b> de todas y cada una de las cláusulas precedentes, de común acuerdo y a convenir a sus legítimos intereses, declaran bajo gravedad de juramento que no se encuentran incursos en ninguna de las incompatibilidades, inhabilidades o prohibiciones de que trata la ley y demás normas sobre la materia, igualmente manifiestan que esta decisión es libre y espontánea y no han sido coaccionados a la toma de esta. </p>

            <p>En constancia de lectura, conformidad, aceptación y ejecución se firma en la ciudad de <b><?php echo $empresa->ciudad ?></b> el día <b><?php setlocale(LC_ALL,"es_ES");
        echo strftime("%A %d de %B del %Y"); ?></b>.</p>

        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="30%"><b>LA EMPRESA</b></td>
                <td width="15%"></td>
                <td width="30%"><b>LA (EL) CONTRATISTA</b></td>
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
                <td class="bordetop"><b><?php echo $empresa->nombre_representante_legal; ?></b></td>
                <td style="border:none;width: 60px;"></td>
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
                <td>Cédula Ciudadanía No <?php echo $empresa->nro_identificacion_representante_legal; ?></td>
                <td></td>
                <td><?php echo ucwords(mb_strtolower ($v->tipo_identificacion)).' No '?><b><?php echo $v->identificacion; ?></b></td>
                <td></td>
                <td class="borderleft borderight bordeBottom"></td>
            </tr>
        </table>
        <div style="height: 10px;"></div>
        <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="30%"><b>TESTIGO #1</b></td>
                <td width="15%"></td>
                <td width="30%"><b>TESTIGO #2</b></td>
                <td width="5%"></td>
                <td width="20%"></td>
            </tr>
            <tr>
                <td style="height: 60px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="bordetop" style="height: 18px;"><b><?php echo $json->testigo1; ?></b></td>
                <td style="border:none;width: 60px;"> </td>
                <td class="bordetop" style="height: 18px;"><b><?php echo $json->testigo2; ?></b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php if(!empty($json->razon_social)){ echo $json->razon_social;}else{echo 'Representante en nombre propio.';} ?></td>
                <td></td>
                <td><?php if(!empty($json->razon_social2)){ echo $json->razon_social2;}else{echo 'Representante en nombre propio.';} ?></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><?php echo $json->tipo_documento;?> <b><?php echo $json->nro_documento ?></b></td>
                <td></td>
                <td><?php echo $json->tipo_documento2;?> <b><?php echo $json->nro_documento2 ?></b></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
            <table>
                <tr>
                    <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
                    <td style="text-align: center;font-size: 9px;">Página 7 / 7</td>
                    <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
                </tr>
            </table>
        </div>
    </div>
<?php } ?>
</div>
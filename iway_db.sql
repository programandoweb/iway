# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v4.1.3                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          proycto.dez                                     #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2019-04-04 13:50                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Tables                                                                 #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "cf_ciclos_pagos"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE cf_ciclos_pagos (
    ciclos_id INTEGER(11) NOT NULL AUTO_INCREMENT,
    empresa_id INTEGER(11) NOT NULL,
    centro_de_costos INTEGER(11) NOT NULL,
    mes INTEGER(2) NOT NULL,
    ciclo_produccion_id VARCHAR(16) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    fecha_desde DATE NOT NULL,
    fecha_hasta DATE NOT NULL,
    TRM_Liquidacion DECIMAL(10,2) DEFAULT '0.00',
    estado INTEGER(1) NOT NULL DEFAULT '0',
    CONSTRAINT PK_cf_ciclos_pagos PRIMARY KEY (ciclos_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8;

# ---------------------------------------------------------------------- #
# Add table "mae_administrativo"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_administrativo (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    tipo_identidad_id INTEGER(11) NOT NULL,
    empresa_id INTEGER(11) NOT NULL,
    eps_id INTEGER(11) NOT NULL,
    caja_compensacion_id INTEGER(11) NOT NULL,
    tipo_cliente VARCHAR(50) NOT NULL,
    regimen_empresa VARCHAR(50) NOT NULL,
    naturaleza VARCHAR(50) NOT NULL,
    numero_identificacion VARCHAR(50) NOT NULL,
    digito_verificacion INTEGER(11) NOT NULL,
    nombre_legal VARCHAR(50) NOT NULL,
    nombre_comercial VARCHAR(100) NOT NULL,
    representante_legal VARCHAR(100) NOT NULL,
    id_representante_legal INTEGER(20) NOT NULL,
    ciudad_expedicion VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    persona_de_contacto VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    pagina_web VARCHAR(100) NOT NULL,
    Documento_moneda_extranjera TINYINT(1) NOT NULL,
    credito VARCHAR(2) NOT NULL,
    dias_de_credito INTEGER(11) NOT NULL,
    Cupo_credito FLOAT NOT NULL,
    vendeddor VARCHAR(100) NOT NULL,
    lista_de_precios VARCHAR(2) NOT NULL,
    suspendido_ventas TINYINT(1) NOT NULL,
    Fecha_registro DATE NOT NULL,
    responsable_creacion VARCHAR(100) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_administrativo PRIMARY KEY (id, tipo_identidad_id, empresa_id, eps_id, caja_compensacion_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_asociado"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_asociado (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    tipo_identidad_id INTEGER(11) NOT NULL,
    eps_id INTEGER(11) NOT NULL,
    caja_compensacion_id INTEGER(11) NOT NULL,
    id_empresa INTEGER(11) DEFAULT NULL,
    tipo_cliente VARCHAR(50) NOT NULL,
    regimen_empresa VARCHAR(50) NOT NULL,
    naturaleza VARCHAR(50) NOT NULL,
    numero_identificacion VARCHAR(50) NOT NULL,
    digito_verificacion INTEGER(11) NOT NULL,
    nombre_legal VARCHAR(50) NOT NULL,
    nombre_comercial VARCHAR(100) NOT NULL,
    representante_legal VARCHAR(100) NOT NULL,
    id_represntante_legal INTEGER(20) NOT NULL,
    ciudad_expedicion VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    persona_de_contacto VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    pagina_web VARCHAR(100) NOT NULL,
    Documento_moneda_extranjera TINYINT(1) NOT NULL,
    credito VARCHAR(2) NOT NULL,
    dias_de_credito INTEGER(11) NOT NULL,
    Cupo_credito FLOAT NOT NULL,
    vendeddor VARCHAR(100) NOT NULL,
    lista_de_precios VARCHAR(2) NOT NULL,
    suspendido_ventas TINYINT(1) NOT NULL,
    Fecha_registro DATE NOT NULL,
    responsable_creacion VARCHAR(100) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_asociado PRIMARY KEY (id, tipo_identidad_id, eps_id, caja_compensacion_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_calendario"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_calendario (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    descripcion LONGTEXT NOT NULL,
    color VARCHAR(255) NOT NULL,
    textColor VARCHAR(255) NOT NULL,
    start DATETIME NOT NULL,
    end DATETIME NOT NULL,
    estado TINYINT(4) NOT NULL DEFAULT '1',
    CONSTRAINT PK_mae_calendario PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

# ---------------------------------------------------------------------- #
# Add table "mae_centro_costo"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_centro_costo (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    empresa_id INTEGER(11) NOT NULL,
    centro_costo INTEGER(11) NOT NULL,
    fecha_registro DATE NOT NULL,
    Responsable_creacion INTEGER(11) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_centro_costo PRIMARY KEY (id, empresa_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_cliente"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_cliente (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    tipo_identidad_id INTEGER(11) NOT NULL,
    empresa_id INTEGER(11) NOT NULL,
    tipo_cliente VARCHAR(50) NOT NULL,
    regimen_empresa VARCHAR(50) NOT NULL,
    naturaleza VARCHAR(50) NOT NULL,
    numero_identificacion VARCHAR(50) NOT NULL,
    digito_verificacion INTEGER(11) NOT NULL,
    nombre_legal VARCHAR(50) NOT NULL,
    nombre_comercial VARCHAR(100) NOT NULL,
    representante_legal VARCHAR(100) NOT NULL,
    id_represntante_legal INTEGER(20) NOT NULL,
    ciudad_expedicion VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    persona_de_contacto VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    pagina_web VARCHAR(100) NOT NULL,
    Documento_moneda_extranjera TINYINT(1) NOT NULL,
    credito VARCHAR(2) NOT NULL,
    dias_de_credito INTEGER(11) NOT NULL,
    Cupo_credito FLOAT NOT NULL,
    vendeddor VARCHAR(100) NOT NULL,
    lista_de_precios VARCHAR(2) NOT NULL,
    suspendido_ventas TINYINT(1) NOT NULL,
    Fecha_registro DATE NOT NULL,
    responsable_creacion VARCHAR(100) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_cliente PRIMARY KEY (id, tipo_identidad_id, empresa_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_cliente_joberp"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_cliente_joberp (
    empresa_id INTEGER(11) NOT NULL AUTO_INCREMENT,
    regimen_empresa VARCHAR(100) NOT NULL,
    naturaleza VARCHAR(100) NOT NULL,
    fecha_matricula DATE NOT NULL,
    declara_renta VARCHAR(11) NOT NULL,
    prefijo_documento VARCHAR(50) NOT NULL,
    tipo_identificacion INTEGER(11) NOT NULL,
    numero_identificacion VARCHAR(50) NOT NULL,
    digitos_verificacion INTEGER(11) NOT NULL,
    nombre_legal VARCHAR(100) NOT NULL,
    nombre_comercial VARCHAR(100) NOT NULL,
    id_representante_legal VARCHAR(50) NOT NULL,
    ciudad_expedicion INTEGER(11) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    ciudad INTEGER(11) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    persona_contacto VARCHAR(100) NOT NULL,
    cargo INTEGER(11) NOT NULL,
    pagina_web VARCHAR(200) NOT NULL,
    descripcion_cliente VARCHAR(100) NOT NULL,
    divisa_oficial VARCHAR(20) NOT NULL,
    documento_moneda_extranjera VARCHAR(100) NOT NULL,
    logo VARCHAR(200) NOT NULL,
    logo_json LONGTEXT NOT NULL,
    fecha_registro DATE NOT NULL,
    responsable_creacion INTEGER(11) DEFAULT NULL,
    demo TEXT NOT NULL,
    color_aplicativo VARCHAR(100) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_cliente_joberp PRIMARY KEY (empresa_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

# ---------------------------------------------------------------------- #
# Add table "mae_cuenta_bancaria"                                        #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_cuenta_bancaria (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    empresa_id INTEGER(11) NOT NULL,
    banco_id INTEGER(10) NOT NULL,
    usuario INTEGER(11) NOT NULL,
    tipo_de_cuenta VARCHAR(20) NOT NULL,
    numero_de_cuenta VARCHAR(50) NOT NULL,
    fecha_registro DATE NOT NULL,
    responsable_creacion INTEGER(11) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_cuenta_bancaria PRIMARY KEY (id, empresa_id, banco_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_forma_de_pago"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_forma_de_pago (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    empresa_id INTEGER(11) NOT NULL,
    forma_pago VARCHAR(100) NOT NULL,
    dias_pago VARCHAR(100) NOT NULL,
    fecha_registro DATE NOT NULL,
    responsable_creacion INTEGER(11) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_forma_de_pago PRIMARY KEY (id, empresa_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_inventario"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_inventario (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    empresa_id INTEGER(11) NOT NULL,
    inventariable TINYTEXT NOT NULL,
    tipo_articulo VARCHAR(100) NOT NULL,
    codigo_barra VARCHAR(100) NOT NULL,
    referencia VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    garantia VARCHAR(100) NOT NULL,
    foto_producto VARCHAR(100) NOT NULL,
    linea INTEGER(11) NOT NULL,
    unidad_de_medida INTEGER(11) NOT NULL,
    se_compra INTEGER(11) NOT NULL,
    retencion INTEGER(11) NOT NULL,
    se_vende INTEGER(11) NOT NULL,
    tarifa_iva INTEGER(11) NOT NULL,
    precio_venta FLOAT NOT NULL,
    cantidad_inicial INTEGER(11) NOT NULL,
    costo_inicial FLOAT NOT NULL,
    fecha_registro DATE NOT NULL,
    responsable_creacion INTEGER(11) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_inventario PRIMARY KEY (id, empresa_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_pes_inventario"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_pes_inventario (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    empresa_id INTEGER(11) NOT NULL,
    id_conf INTEGER(11) NOT NULL,
    se_compra INTEGER(11) NOT NULL,
    se_vende INTEGER(11) NOT NULL,
    fecha_registro DATE NOT NULL,
    responsable_creacion INTEGER(11) DEFAULT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_pes_inventario PRIMARY KEY (id, empresa_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_proveedores"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_proveedores (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    tipo_identidad_id INTEGER(11) NOT NULL,
    empresa_id INTEGER(11) NOT NULL,
    rol_id INTEGER(11) NOT NULL,
    tipo_proveedor VARCHAR(100) NOT NULL,
    regimen_empresa VARCHAR(100) NOT NULL,
    Naturaleza VARCHAR(100) NOT NULL,
    numero_identificacion VARCHAR(20) NOT NULL,
    digito_verificacion INTEGER(11) NOT NULL,
    nombre_legal VARCHAR(100) NOT NULL,
    nombre_comercial VARCHAR(100) NOT NULL,
    representante_legal VARCHAR(100) NOT NULL,
    id_representante_legal VARCHAR(100) NOT NULL,
    ciudad_expedicion INTEGER(11) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    ciudad INTEGER(11) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    persona_contacto VARCHAR(100) NOT NULL,
    cargo INTEGER(11) NOT NULL,
    pagina_web VARCHAR(100) NOT NULL,
    documento_moneda_extranjera TINYTEXT NOT NULL,
    credito TINYTEXT NOT NULL,
    dias_de_credito INTEGER(11) NOT NULL,
    cupo_credito FLOAT NOT NULL,
    banco INTEGER(11) NOT NULL,
    tipo_de_cuenta VARCHAR(100) NOT NULL,
    numero_de_cuenta VARCHAR(100) NOT NULL,
    fecha_registro DATE NOT NULL,
    responsable_contratacion DATE NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_proveedores PRIMARY KEY (id, tipo_identidad_id, empresa_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "mae_usuarios_empleados"                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE mae_usuarios_empleados (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    tipo_identidad_id INTEGER(11) NOT NULL,
    empresa_id INTEGER(11) NOT NULL,
    estado_civil_id INTEGER(11) NOT NULL,
    eps_id INTEGER(11) NOT NULL,
    caja_compensacion_id INTEGER(11) NOT NULL,
    user_id INTEGER(11) NOT NULL,
    tipo_usuario INTEGER(11) NOT NULL,
    nombre_usuario VARCHAR(100) NOT NULL,
    rol_id INTEGER(11) NOT NULL,
    centro_costos INTEGER(11) NOT NULL,
    tipo_empleado VARCHAR(100) NOT NULL,
    numero_identificacion VARCHAR(20) NOT NULL,
    ciudad_expedicion INTEGER(11) NOT NULL,
    primer_nombre VARCHAR(100) NOT NULL,
    segundo_nombre VARCHAR(100) NOT NULL,
    primer_apellido VARCHAR(100) NOT NULL,
    segundo_apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    lugar_nacimiento INTEGER(11) DEFAULT NULL,
    Direccion VARCHAR(100) NOT NULL,
    ciudad INTEGER(11) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cargo INTEGER(11) NOT NULL,
    salario_basico FLOAT NOT NULL,
    arp_id INTEGER(11) NOT NULL,
    pension INTEGER(11) NOT NULL,
    censatia INTEGER(11) NOT NULL,
    forma_de_pago INTEGER(11) NOT NULL,
    tipo_de_contratacion INTEGER(11) NOT NULL,
    moneda_de_pago VARCHAR(20) NOT NULL,
    fecha_contratacion DATE NOT NULL,
    password VARCHAR(100) NOT NULL,
    foto_funcionario VARCHAR(100) NOT NULL,
    firma VARCHAR(100) NOT NULL,
    token VARCHAR(100) NOT NULL,
    inicio_sesion VARCHAR(100) NOT NULL,
    fin_sesion VARCHAR(100) NOT NULL,
    fecha_registro VARCHAR(100) NOT NULL,
    responsable_creacion INTEGER(11) NOT NULL,
    estado TINYINT(1) NOT NULL,
    CONSTRAINT PK_mae_usuarios_empleados PRIMARY KEY (id, tipo_identidad_id, empresa_id, estado_civil_id, eps_id, caja_compensacion_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "op_links"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE op_links (
    id_op_link INTEGER(11) NOT NULL AUTO_INCREMENT,
    id_link INTEGER(11) NOT NULL,
    contador INTEGER(11) NOT NULL,
    CONSTRAINT PK_op_links PRIMARY KEY (id_op_link)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

# ---------------------------------------------------------------------- #
# Add table "rp_operaciones"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE rp_operaciones (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    responsable_id INTEGER(11) NOT NULL,
    responsable_anular INTEGER(11) NOT NULL,
    consecutivo INTEGER(11) NOT NULL,
    empresa_id INTEGER(11) NOT NULL,
    centro_de_costos INTEGER(11) NOT NULL,
    nro_documento INTEGER(11) NOT NULL,
    pref_nro_documento VARCHAR(5) NOT NULL,
    tipo_documento INTEGER(1) NOT NULL,
    codigo_contable VARCHAR(10) NOT NULL,
    codigo_contable_subfijo VARCHAR(2),
    ciclo_produccion_id VARCHAR(100) DEFAULT '0',
    fecha DATE NOT NULL,
    nickname_id INTEGER(11) DEFAULT NULL,
    cliente_id INTEGER(11) DEFAULT '0',
    procesador_id INTEGER(11) DEFAULT '0',
    caja_id INTEGER(11) DEFAULT '0',
    plataforma_id INTEGER(11) DEFAULT '0',
    master_id INTEGER(11) DEFAULT '0',
    modelo_id INTEGER(11) DEFAULT '0',
    debito DECIMAL(20,10) NOT NULL,
    credito DECIMAL(20,10) NOT NULL,
    json LONGTEXT NOT NULL,
    estatus INTEGER(1) DEFAULT '1',
    estado_ciclo INTEGER(11) NOT NULL DEFAULT '0',
    CONSTRAINT PK_rp_operaciones PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8;

# ---------------------------------------------------------------------- #
# Add table "sys_arl"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_arl (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    razon_social_arl VARCHAR(150) NOT NULL,
    cod_minproteccion VARCHAR(20) NOT NULL,
    nit INTEGER(11) NOT NULL,
    div_ VARCHAR(150) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    ciudad VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    CONSTRAINT PK_sys_arl PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_bancos"                                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_bancos (
    banco_id INTEGER(10) NOT NULL AUTO_INCREMENT,
    Entidad VARCHAR(51) NOT NULL,
    Nit VARCHAR(13) NOT NULL,
    DV INTEGER(11) NOT NULL,
    Direccion VARCHAR(62) NOT NULL,
    Ciudad VARCHAR(11) NOT NULL,
    Departamento VARCHAR(15) NOT NULL,
    Telefono VARCHAR(20) NOT NULL,
    CONSTRAINT PK_sys_bancos PRIMARY KEY (banco_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_caja_comp"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_caja_comp (
    caja_compensacion_id INTEGER(11) NOT NULL AUTO_INCREMENT,
    razon_social_caja_comp VARCHAR(150) NOT NULL,
    cod_minproteccion VARCHAR(20) NOT NULL,
    nit INTEGER(11) NOT NULL,
    div_ VARCHAR(62) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    ciudad VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    CONSTRAINT PK_sys_caja_comp PRIMARY KEY (caja_compensacion_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_codigos_cup"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_codigos_cup (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    seccion VARCHAR(50) NOT NULL,
    capitulo VARCHAR(150) NOT NULL,
    codigo VARCHAR(50) NOT NULL,
    descripcion VARCHAR(1000) NOT NULL,
    CONSTRAINT PK_sys_codigos_cup PRIMARY KEY (id)
)
 ENGINE=MyISAM DEFAULT CHARSET=latin1;

# ---------------------------------------------------------------------- #
# Add table "sys_eps"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_eps (
    eps_id INTEGER(11) NOT NULL AUTO_INCREMENT,
    razon_social_eps VARCHAR(150) NOT NULL,
    cod_minproteccion VARCHAR(20) NOT NULL,
    NIT VARCHAR(20) NOT NULL,
    DV INTEGER(11) NOT NULL,
    Direccion VARCHAR(100) NOT NULL,
    ciudad VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    CONSTRAINT PK_sys_eps PRIMARY KEY (eps_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_estado_civil"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_estado_civil (
    estado_civil_id INTEGER(11) NOT NULL AUTO_INCREMENT,
    Estado VARCHAR(60) NOT NULL,
    CONSTRAINT PK_sys_estado_civil PRIMARY KEY (estado_civil_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

# ---------------------------------------------------------------------- #
# Add table "sys_gastos_generales"                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_gastos_generales (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(150) NOT NULL,
    tipo_gasto VARCHAR(100) NOT NULL,
    retencion VARCHAR(100) NOT NULL,
    iva VARCHAR(100) NOT NULL,
    admon INTEGER(11) NOT NULL,
    contrapartida INTEGER(11) NOT NULL,
    CONSTRAINT PK_sys_gastos_generales PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_iva"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_iva (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    detalle VARCHAR(20) NOT NULL,
    valor VARCHAR(20) NOT NULL,
    CONSTRAINT PK_sys_iva PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_logs"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_logs (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    user_id INTEGER(11) NOT NULL,
    fecha DATETIME NOT NULL,
    tipo_transaccion INTEGER(1) NOT NULL,
    tabla_afectada VARCHAR(100) NOT NULL,
    registro_afectado_id INTEGER(11) DEFAULT NULL,
    modulo_donde_produjo_cambio VARCHAR(250) DEFAULT 'NULL',
    accion INTEGER(1) NOT NULL,
    json LONGTEXT NOT NULL,
    CONSTRAINT PK_sys_logs PRIMARY KEY (id, user_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8;

# ---------------------------------------------------------------------- #
# Add table "sys_municipios"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_municipios (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    codigo VARCHAR(6) NOT NULL,
    ciudad VARCHAR(27) NOT NULL,
    departamento VARCHAR(56) NOT NULL,
    union_ VARCHAR(70) NOT NULL,
    CONSTRAINT PK_sys_municipios PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_otros_ingresos"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_otros_ingresos (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(100) NOT NULL,
    Retencion VARCHAR(100) NOT NULL,
    iva VARCHAR(100) NOT NULL,
    contabiliza INTEGER(10) NOT NULL,
    CONSTRAINT PK_sys_otros_ingresos PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_paises_mundo"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_paises_mundo (
    pais_id INTEGER(10) NOT NULL AUTO_INCREMENT,
    codigo VARCHAR(10) NOT NULL,
    pais VARCHAR(100) NOT NULL,
    CONSTRAINT PK_sys_paises_mundo PRIMARY KEY (pais_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_profesiones"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_profesiones (
    profesion_id INTEGER(10) NOT NULL AUTO_INCREMENT,
    profesion VARCHAR(150) NOT NULL,
    CONSTRAINT PK_sys_profesiones PRIMARY KEY (profesion_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_puc"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_puc (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    grupo VARCHAR(100) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    subtipo VARCHAR(100) NOT NULL,
    codigo VARCHAR(100) NOT NULL,
    cuenta VARCHAR(100) NOT NULL,
    CONSTRAINT PK_sys_puc PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_retenciones"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_retenciones (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    familia VARCHAR(100) NOT NULL,
    detalle VARCHAR(100) NOT NULL,
    valor_base_retencion VARCHAR(100) NOT NULL,
    CONSTRAINT PK_sys_retenciones PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_roles"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_roles (
    rol_id INTEGER(11) NOT NULL AUTO_INCREMENT,
    json LONGTEXT NOT NULL,
    json_edit LONGTEXT NOT NULL,
    json_add LONGTEXT NOT NULL,
    estado INTEGER(1) DEFAULT '1',
    type_id INTEGER(10) UNSIGNED,
    CONSTRAINT PK_sys_roles PRIMARY KEY (rol_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8;

# ---------------------------------------------------------------------- #
# Add table "sys_roles_modulos"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_roles_modulos (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    modulo_padre INTEGER(11) NOT NULL,
    modulo VARCHAR(50) NOT NULL,
    url VARCHAR(200) NOT NULL,
    order_ INTEGER(11) DEFAULT NULL,
    ico VARCHAR(100) NOT NULL,
    CONSTRAINT PK_sys_roles_modulos PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_session"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_session (
    id INTEGER(11) NOT NULL AUTO_INCREMENT,
    user_id INTEGER(11) NOT NULL,
    fecha DATETIME NOT NULL,
    session_id VARCHAR(200) NOT NULL,
    CONSTRAINT PK_sys_session PRIMARY KEY (id, user_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8;

# ---------------------------------------------------------------------- #
# Add table "sys_tipo_contrato"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_tipo_contrato (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    tipo_contrato VARCHAR(100) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    CONSTRAINT PK_sys_tipo_contrato PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_tipo_identidad"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_tipo_identidad (
    tipo_identidad_id INTEGER(11) NOT NULL AUTO_INCREMENT,
    tipo_identidad VARCHAR(100) NOT NULL,
    CONSTRAINT PK_sys_tipo_identidad PRIMARY KEY (tipo_identidad_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_tipo_usuario"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_tipo_usuario (
    type_id INTEGER(10) NOT NULL AUTO_INCREMENT,
    tipo VARCHAR(30) NOT NULL,
    CONSTRAINT PK_sys_tipo_usuario PRIMARY KEY (type_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "sys_trm"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_trm (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    fecha DATE NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    CONSTRAINT PK_sys_trm PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8;

# ---------------------------------------------------------------------- #
# Add table "sys_und_medida"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE sys_und_medida (
    id INTEGER(10) NOT NULL AUTO_INCREMENT,
    abreviacion VARCHAR(20) NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    equivale VARCHAR(20) NOT NULL,
    unidad_equivalencia VARCHAR(20) NOT NULL,
    CONSTRAINT PK_sys_und_medida PRIMARY KEY (id)
)
 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

# ---------------------------------------------------------------------- #
# Add table "usuarios"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE usuarios (
    user_id INTEGER(11) NOT NULL AUTO_INCREMENT,
    empresa_id INTEGER(11) NOT NULL,
    type_id INTEGER(10) NOT NULL,
    login VARCHAR(40),
    email VARCHAR(150),
    password VARCHAR(150),
    intentos_errados INTEGER(1),
    estado INTEGER(11) NOT NULL,
    token VARCHAR(100),
    CONSTRAINT PK_usuarios PRIMARY KEY (user_id, empresa_id, type_id)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

# ---------------------------------------------------------------------- #
# Foreign key constraints                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE cf_ciclos_pagos ADD CONSTRAINT mae_cliente_joberp_cf_ciclos_pagos
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_administrativo ADD CONSTRAINT mae_cliente_joberp_mae_administrativo
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_administrativo ADD CONSTRAINT sys_eps_mae_administrativo
    FOREIGN KEY (eps_id) REFERENCES sys_eps (eps_id);

ALTER TABLE mae_administrativo ADD CONSTRAINT sys_caja_comp_mae_administrativo
    FOREIGN KEY (caja_compensacion_id) REFERENCES sys_caja_comp (caja_compensacion_id);

ALTER TABLE mae_asociado ADD CONSTRAINT sys_tipo_identidad_mae_asociado
    FOREIGN KEY (tipo_identidad_id) REFERENCES sys_tipo_identidad (tipo_identidad_id);

ALTER TABLE mae_asociado ADD CONSTRAINT sys_eps_mae_asociado
    FOREIGN KEY (eps_id) REFERENCES sys_eps (eps_id);

ALTER TABLE mae_asociado ADD CONSTRAINT sys_caja_comp_mae_asociado
    FOREIGN KEY (caja_compensacion_id) REFERENCES sys_caja_comp (caja_compensacion_id);

ALTER TABLE mae_centro_costo ADD CONSTRAINT mae_cliente_joberp_mae_centro_costo
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_cliente ADD CONSTRAINT sys_tipo_identidad_mae_cliente
    FOREIGN KEY (tipo_identidad_id) REFERENCES sys_tipo_identidad (tipo_identidad_id);

ALTER TABLE mae_cliente ADD CONSTRAINT mae_cliente_joberp_mae_cliente
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_cuenta_bancaria ADD CONSTRAINT mae_cliente_joberp_mae_cuenta_bancaria
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_cuenta_bancaria ADD CONSTRAINT sys_bancos_mae_cuenta_bancaria
    FOREIGN KEY (banco_id) REFERENCES sys_bancos (banco_id);

ALTER TABLE mae_forma_de_pago ADD CONSTRAINT mae_cliente_joberp_mae_forma_de_pago
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_inventario ADD CONSTRAINT mae_cliente_joberp_mae_inventario
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_pes_inventario ADD CONSTRAINT mae_cliente_joberp_mae_pes_inventario
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_proveedores ADD CONSTRAINT sys_tipo_identidad_mae_proveedores
    FOREIGN KEY (tipo_identidad_id) REFERENCES sys_tipo_identidad (tipo_identidad_id);

ALTER TABLE mae_proveedores ADD CONSTRAINT mae_cliente_joberp_mae_proveedores
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_usuarios_empleados ADD CONSTRAINT sys_tipo_identidad_mae_usuarios_empleados
    FOREIGN KEY (tipo_identidad_id) REFERENCES sys_tipo_identidad (tipo_identidad_id);

ALTER TABLE mae_usuarios_empleados ADD CONSTRAINT mae_cliente_joberp_mae_usuarios_empleados
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE mae_usuarios_empleados ADD CONSTRAINT sys_estado_civil_mae_usuarios_empleados
    FOREIGN KEY (estado_civil_id) REFERENCES sys_estado_civil (estado_civil_id);

ALTER TABLE mae_usuarios_empleados ADD CONSTRAINT sys_eps_mae_usuarios_empleados
    FOREIGN KEY (eps_id) REFERENCES sys_eps (eps_id);

ALTER TABLE mae_usuarios_empleados ADD CONSTRAINT sys_caja_comp_mae_usuarios_empleados
    FOREIGN KEY (caja_compensacion_id) REFERENCES sys_caja_comp (caja_compensacion_id);

ALTER TABLE sys_logs ADD CONSTRAINT usuarios_sys_logs
    FOREIGN KEY (user_id) REFERENCES usuarios (user_id);

ALTER TABLE sys_session ADD CONSTRAINT usuarios_sys_session
    FOREIGN KEY (user_id) REFERENCES usuarios (user_id);

ALTER TABLE usuarios ADD CONSTRAINT mae_cliente_joberp_usuarios
    FOREIGN KEY (empresa_id) REFERENCES mae_cliente_joberp (empresa_id);

ALTER TABLE usuarios ADD CONSTRAINT sys_tipo_usuario_usuarios
    FOREIGN KEY (type_id) REFERENCES sys_tipo_usuario (type_id);

INSERT INTO `sys_tipo_usuario` (`type_id`, `tipo`) VALUES (1, 'Root'),        (2, 'Empresa'),        (3, 'Sucursal'),        (4, 'Asociado'),        (5, 'Directivo'),        (6, 'Administrativo'),        (7, 'Comercial'),        (8, 'Operativo'),        (9, 'Cliente'),        (10, 'Proveedor');
INSERT INTO `mae_cliente_joberp` (`empresa_id`, `regimen_empresa`, `naturaleza`,
            `fecha_matricula`, `declara_renta`, `prefijo_documento`, `tipo_identificacion`,
            `numero_identificacion`, `digitos_verificacion`, `nombre_legal`, `nombre_comercial`,
            `id_representante_legal`, `ciudad_expedicion`, `direccion`, `ciudad`, `telefono`, `celular`,
            `email`, `persona_contacto`, `cargo`, `pagina_web`, `descripcion_cliente`, `divisa_oficial`,
            `documento_moneda_extranjera`, `logo`, `logo_json`, `fecha_registro`, `responsable_creacion`,
            `demo`, `color_aplicativo`, `estado`)
      VALUES (NULL, 'Desarrollo y Sistemas', 'r', '2019-04-04', 'r', 'r', '1', 'r', '1', 'r', 'r', 'r',
              '1', 'r', '1', 'r', 'r', 'r', 'r', '1', 'r', 'r', 'r', 'r', 'r', 'r', '2019-04-04', '1', 'r', '#333333', '1');
INSERT INTO `usuarios` (`user_id`, `empresa_id`, `type_id`, `login`, `email`, `password`, `intentos_errados`, `estado`, `token`)
      VALUES ('1', '1', '1', 'root', 'root@sistemas', MD5('123456'), '0', '1', MD5('venezuela'));              
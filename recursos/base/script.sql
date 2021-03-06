CREATE TABLE USUARIOS(
    ID_USUARIO INT AUTO_INCREMENT,
    CORREO VARCHAR(50),
    NOM_USUARIO VARCHAR(50),
    AP_USUARIO VARCHAR(50),
    TELEFONO VARCHAR(30),
    TIPO VARCHAR (30) DEFAULT 'POR DEFINIR',
    CONTRASENA VARCHAR (50),
    GENERO VARCHAR(15),
    FECHA_NAC DATE,
    CIUDAD VARCHAR(50),
    PRIMARY KEY (ID_USUARIO)

);
INSERT INTO USUARIOS( ID_USUARIO, CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,TIPO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD)
VALUES (NULL,'JESSI_4508@GMAIL.COM','CECILIA','VARGAS','7228485202','CLIENTE','ABC123','FEMENINO','1998/06/09','MÉXICO');
INSERT INTO USUARIOS( ID_USUARIO, CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,TIPO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD)
VALUES (NULL,'ROSA_45@GMAIL.COM','ROSA','RAMIREZ','7228484562','CLIENTE','123456','FEMENINO','1990/01/10','MÉXICO');
INSERT INTO USUARIOS( ID_USUARIO, CORREO, NOM_USUARIO, AP_USUARIO,TELEFONO,TIPO,CONTRASENA,GENERO,FECHA_NAC,CIUDAD)
VALUES (NULL,'JAIME_45@GMAIL.COM','JAIME','PEREZ','7228495562','OPERADOR','123456','MASCULINO','1969/01/19','MÉXICO');



CREATE TABLE PEDIDOS(
    ID_PEDIDO INT AUTO_INCREMENT,
    ID_OPERADOR_FK INT,
    ID_CLIENTE_FK INT,
    ESTADO_PEDIDO VARCHAR(50) DEFAULT 'PENDIENTE',
    FECHA_PEDIDO DATE,
    DIRECCION VARCHAR (80),
    PRIMARY KEY (ID_PEDIDO),
    FOREIGN KEY (ID_OPERADOR_FK) REFERENCES USUARIOS(ID_USUARIO) ON DELETE CASCADE,
    FOREIGN KEY (ID_CLIENTE_FK) REFERENCES USUARIOS(ID_USUARIO) ON DELETE CASCADE
);
INSERT INTO PEDIDOS(ID_PEDIDO,ID_OPERADOR_FK,ID_CLIENTE_FK,ESTADO_PEDIDO,FECHA_PEDIDO,DIRECCION)
VALUES(NULL,3,1,'PENDIENTE','SYSDATE','COLORINES #113');

CREATE TABLE  PROVEEDORES(
    ID_PROVEEDOR INT AUTO_INCREMENT,
    NOM_PROVEEDOR VARCHAR(50),
    CORREO VARCHAR (50),
    DIRECCION VARCHAR(50),
    NOMBRE_ENCARGADO VARCHAR(50),
    AP_ENCARGADO VARCHAR(50),
    TELEFONO VARCHAR(50),
    PRIMARY KEY (ID_PROVEEDOR)

);
INSERT INTO PROVEEDORES(ID_PROVEEDOR,CORREO, NOM_PROVEEDOR, DIRECCION, NOMBRE_ENCARGADO, AP_ENCARGADO,TELEFONO)
VALUES(NULL,'TIENDITA MX', 'TIENDITA@GMAIL.COM','TOLUCA #114','PEDRO','ROBLES','554874105');

CREATE TABLE  CATEGORIAS(
    ID_CATEGORIA INT AUTO_INCREMENT,
    NOM_CATEGORIA VARCHAR(50),
    DESC_CATEGORIA VARCHAR(100),
    PRIMARY KEY(ID_CATEGORIA)
);
INSERT INTO CATEGORIAS(ID_CATEGORIA,NOM_CATEGORIA,DESC_CATEGORIA)
VALUES(NULL, 'ALIMENTOS','CATEGORIA ALIMENTOS');
INSERT INTO CATEGORIAS(ID_CATEGORIA,NOM_CATEGORIA,DESC_CATEGORIA)
VALUES(NULL, 'HERRAMIENTAS','CATEGORIA HERRAMIENTAS');

CREATE TABLE PRODUCTOS(
    ID_PRODUCTO INT AUTO_INCREMENT,
    ID_PROVEEDOR_FK INT,
    ID_CATEGORIA_FK INT,
    NOM_PRODUCTO VARCHAR(50),
    PRECIO FLOAT,
    DESCRIPCION VARCHAR(100),
    IMAGEN VARCHAR(100),
    ALMACEN INT,
    PRIMARY KEY(ID_PRODUCTO),
    FOREIGN KEY (ID_PROVEEDOR_FK) REFERENCES PROVEEDORES(ID_PROVEEDOR) ON DELETE CASCADE,
    FOREIGN KEY (ID_CATEGORIA_FK) REFERENCES CATEGORIAS(ID_CATEGORIA) ON DELETE CASCADE
);

CREATE TABLE DETALLE_PEDIDO(
    ID_DETALLE INT AUTO_INCREMENT,
    ID_PEDIDO_FK INT,
    ID_PRODUCTO_FK INT,
    CANTIDAD FLOAT,
    PRIMARY KEY (ID_DETALLE),
    FOREIGN KEY (ID_PEDIDO_FK) REFERENCES PEDIDOS(ID_PEDIDO) ON DELETE CASCADE,
    FOREIGN KEY (ID_PRODUCTO_FK) REFERENCES PRODUCTOS(ID_PRODUCTO) ON DELETE CASCADE

);

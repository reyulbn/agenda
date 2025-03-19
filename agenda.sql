CREATE TABLE contactos(
    id_contacto int(5) PRIMARY KEY AUTO_INCREMENT,
    nombre		varchar(100),
    email		varchar(100),
    tlf			int(9) UNIQUE NOT NULL,
    direccion	text)
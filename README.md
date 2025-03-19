# agenda - proyecto PHP

Proyecto en PHP realizado en el módulo Desarrollo Web en Entorno Servidor (DWES)<br>
del Grado Superior en Desarrollo de Aplicaciones Web (DAW).

Base de datos lanzada en XAMPP:

```sql
CREATE TABLE contactos(
    id_contacto int(5) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(100),
    email varchar(100),
    tlf int(9) UNIQUE NOT NULL,
    direccion text
);

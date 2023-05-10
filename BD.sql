CREATE DATABASE Admin COLLATE 'utf8mb4_general_ci';

CREATE TABLE Pagina (
    Nombre varchar(50) NOT NULL,
    Imagen mediumtext NOT NULL
);
CREATE TABLE Usuarios (
    IdUsuario bigint NOT NULL,
    Usuario varchar(50) NOT NULL,
    Contraseña mediumtext NOT NULL,
    Imagen mediumtext,
    Telefono bigint,
    RolAsignado varchar(20) NOT NULL,
    PRIMARY KEY (IdUsuario)
);
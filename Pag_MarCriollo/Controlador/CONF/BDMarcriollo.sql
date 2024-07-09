
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    distrito VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (nombres, direccion, distrito, correo, contrasena) VALUES
('Juan Pérez', 'Av. Principal 123', 'Miraflores', 'juan.perez@gmail.com', 'password123'),
('María Gómez', 'Jr. Libertad 456', 'San Isidro', 'maria.gomez@yahoo.com', 'securepass'),
('Pedro Rodríguez', 'Calle Lima 789', 'Lince', 'pedro.rodriguez@hotmail.com', '123456'),
('Ana Martínez', 'Av. Arequipa 1010', 'San Borja', 'ana.martinez@outlook.com', 'password'),
('Luisa Torres', 'Av. Tacna 111', 'Magdalena', 'luisa.torres@icloud.com', 'pass123'),
('Jorge García', 'Jr. Huancayo 222', 'Pueblo Libre', 'jorge.garcia@protonmail.com', '987654'),
('Carla Fernández', 'Calle Chorrillos 333', 'Surco', 'carla.fernandez@live.com', 'qwerty'),
('Ricardo Díaz', 'Av. Amazonas 444', 'La Molina', 'ricardo.diaz@yandex.com', 'abcd123'),
('Sofía López', 'Calle Lima 555', 'Barranco', 'sofia.lopez@aol.com', 'password1'),
('Martín Castro', 'Jr. Puno 666', 'Breña', 'martin.castro@zoho.com', 'password123'),
('Elena Ruiz', 'Av. Huancavelica 777', 'San Miguel', 'elena.ruiz@gmail.com', 'qwerty123'),
('Diego Ramírez', 'Calle Ayacucho 888', 'Jesus María', 'diego.ramirez@yahoo.com', 'pass456'),
('Laura Sánchez', 'Jr. Ucayali 999', 'Chorrillos', 'laura.sanchez@hotmail.com', 'abc123'),
('Carlos Vargas', 'Av. Brasil 1111', 'San Borja', 'carlos.vargas@outlook.com', 'password456'),
('Lucía Flores', 'Calle Huánuco 1212', 'Miraflores', 'lucia.flores@icloud.com', 'securepass123'),
('Andrés Guzmán', 'Av. Pardo y Aliaga 1313', 'San Isidro', 'andres.guzman@protonmail.com', 'password789'),
('Paola Pérez', 'Jr. Callao 1414', 'Barranco', 'paola.perez@live.com', '987abc'),
('Gabriel Mendoza', 'Calle Angamos 1515', 'Lince', 'gabriel.mendoza@yandex.com', 'pass789'),
('Valeria Castillo', 'Av. Arequipa 1616', 'Magdalena', 'valeria.castillo@aol.com', 'abc456'),
('Felipe Fernández', 'Jr. Huancavelica 1717', 'Surco', 'felipe.fernandez@zoho.com', 'qwe123'),
('Carolina Ruiz', 'Av. La Marina 1818', 'San Miguel', 'carolina.ruiz@gmail.com', 'passqwe'),
('Javier López', 'Calle Lima 1919', 'San Borja', 'javier.lopez@yahoo.com', '123abc'),
('Marcela Torres', 'Av. Tacna 2020', 'Miraflores', 'marcela.torres@hotmail.com', 'passabc'),
('Roberto González', 'Calle Ayacucho 2121', 'Lince', 'roberto.gonzalez@outlook.com', 'abc456qwe'),
('Isabel Sánchez', 'Av. Brasil 2222', 'Barranco', 'isabel.sanchez@icloud.com', 'passqwe123');

DROP PROCEDURE IF EXISTS SP_OBTENER_USUARIOS;

DELIMITER //

CREATE PROCEDURE SP_OBTENER_USUARIOS(IN bus VARCHAR(255))
BEGIN
    SELECT id, nombres, direccion, distrito, correo
    FROM usuarios
    WHERE id LIKE CONCAT('%', bus, '%')
	   OR nombres LIKE CONCAT('%', bus, '%')
       OR direccion LIKE CONCAT('%', bus, '%')
       OR distrito LIKE CONCAT('%', bus, '%')
       OR correo LIKE CONCAT('%', bus, '%');
END //

DELIMITER ;

DROP PROCEDURE IF EXISTS InsertarUsuario;
DELIMITER //

CREATE PROCEDURE InsertarUsuario(
    IN p_nombres VARCHAR(100),
    IN p_direccion VARCHAR(255),
    IN p_distrito VARCHAR(50),
    IN p_correo VARCHAR(100),
    IN p_contrasena VARCHAR(255)
)
BEGIN
    INSERT INTO usuarios (nombres, direccion, distrito, correo, contrasena)
    VALUES (p_nombres, p_direccion, p_distrito, p_correo, p_contrasena);
END //

DELIMITER ;

DROP PROCEDURE IF EXISTS ObtenerUsuarioPorID;
DELIMITER //

CREATE PROCEDURE ObtenerUsuarioPorID(
    IN p_id INT
)
BEGIN
    SELECT * FROM usuarios WHERE id = p_id;
END //

DELIMITER ;

DROP PROCEDURE IF EXISTS ActualizarUsuario;

DELIMITER //

CREATE PROCEDURE ActualizarUsuario(
    IN p_id INT, IN p_nombres VARCHAR(255), 
    IN p_direccion VARCHAR(255), 
    IN p_distrito VARCHAR(255), 
    IN p_correo VARCHAR(255), 
    IN p_contrasena VARCHAR(255))
BEGIN
    UPDATE usuarios
    SET nombres = p_nombres, direccion = p_direccion, distrito = p_distrito, correo = p_correo, contrasena = p_contrasena
    WHERE id = p_id;
END //

DELIMITER ;

DROP PROCEDURE IF EXISTS EliminarUsuario;
DELIMITER //

CREATE PROCEDURE EliminarUsuario(
    IN p_id INT
)
BEGIN
    DELETE FROM usuarios WHERE id = p_id;
END //

DELIMITER ;

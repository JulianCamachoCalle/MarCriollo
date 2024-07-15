
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



CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto VARCHAR(100) NOT NULL,
    detalles TEXT NOT NULL,
    foto VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

INSERT INTO productos (producto, detalles, foto, precio) VALUES
('Ceviche', 'Preparado con pescado fresco en cubos, marinado en limón y mezclado con cebolla roja, ají limo y cilantro, cada bocado combina acidez, picante y sabor herbal. Servido con camote y maíz tostado, ofrece una mezcla única de texturas y contrastes que deleitan los sentidos.', '../Recursos/platos/ceviche_A.png', 18.99),
('Chaufa de Cecina c/Platano', 'Este plato combina arroz salteado con cecina ahumada, trozos de plátano frito y otros ingredientes frescos, creando una experiencia culinaria única que cautiva con cada bocado.', '../Recursos/platos/chaufaCecina_A.png', 21.99),
('Chicharrón de Pollo c/Papas', 'El chicharrón de pollo es un plato popular que consiste en trozos de pollo marinados y fritos hasta obtener una piel crujiente y dorada, con un interior jugoso y lleno de sabor. Esta delicia culinaria es ideal como plato principal o acompañamiento en cualquier comida.', '../Recursos/platos/chicharronPollo_A.png', 19.99),
('Ensalada Mixta c/Verduras', 'El secreto de su frescura y sabor reside en la selección cuidadosa de ingredientes frescos de la huerta. Esta ensalada mixta combina una variedad de verduras crujientes y coloridas, creando una armonía de texturas y sabores. Su aderezo ligero y delicioso realza cada ingrediente, haciendo de cada bocado una experiencia refrescante y saludable.', '../Recursos/platos/ensalada_N.png', 5.99),
('Guiso de Cerdo con Camote', 'El guiso de cerdo es un plato reconfortante donde tiernos trozos de carne de cerdo se cocinan lentamente con papas y zanahorias en una salsa abundante y sabrosa. Cada ingrediente contribuye con su textura y sabor, creando una armonía deliciosa que se deshace en la boca, convirtiéndo este plato en un favorito en cualquier mesa.', '../Recursos/platos/guisoCerdo_N.png', 11.99),
('Lomo Saltado', 'El encanto de este plato reside en tiernos trozos de carne de res salteados con cebollas, tomates y ajíes, que aportan un toque picante perfecto. Pero lo que lo eleva es su salsa, una mezcla exquisita que conquista el paladar desde el primer bocado.', '../Recursos/platos/lomo_N.png', 21.99),
('Milanesa de Pollo c/Papas', 'La milanesa de pollo es un clásico que consiste en pollo tierno y jugoso, empanizado y frito hasta obtener una textura crujiente por fuera y suave por dentro. Es una experiencia gastronómica reconfortante y satisfactoria, perfecta para cualquier ocasión.', '../Recursos/platos/milanesa_A.png', 19.99),
('Papa a la Huancaina', 'Nuestra papa a la huancaína está preparada con ingredientes frescos y de alta calidad, seleccionados cuidadosamente para asegurar una experiencia gastronómica memorable. Las papas, cocidas a la perfección, se sirven cubiertas con una generosa porción de salsa huancaína, elaborada con ají amarillo, queso fresco, leche y galletas, que le dan su característico sabor y textura.', '../Recursos/platos/papHuancaina_N.png', 5.99),
('Pechuga a la Plancha c/Papas', 'La pechuga a la plancha con papas es un plato simple y delicioso que destaca por su sabor y frescura. La pechuga de pollo se cocina a la plancha para conservar su jugosidad, y se acompaña con papas doradas que añaden una textura crujiente. Esta combinación clásica y nutritiva es ideal para una comida equilibrada y satisfactoria.', '../Recursos/platos/pechugaPlancha_A.png', 19.99),
('Pollo con Champiñones con papas', 'El pollo con champiñones y papas es un plato reconfortante que combina la suavidad del pollo con la riqueza de los champiñones y la textura perfecta de las papas. Cocinado a la perfección, ofrece una mezcla equilibrada de sabores y texturas que deleitarán tu paladar en cada bocado.', '../Recursos/platos/polloChamp_N.png', 11.99),
('Sopa de Semola', 'Cada cucharada de nuestra sopa te envuelve en confort y satisfacción. El aroma tentador te lleva a recuerdos cálidos de la infancia, mientras la suavidad de la sémola cocida a la perfección acaricia tu paladar. Lo que destaca en nuestra sopa de sémola es su sabor inigualable: un caldo preparado con vegetales frescos y hierbas aromáticas, que realza el sabor de la sémola y crea una armonía que te dejará queriendo más.', '../Recursos/platos/sopSemola_A.png', 5.99),
('Pollo al Horno', 'Cada bocado de nuestro pollo al horno es un viaje de sabores, desde la crujiente piel dorada hasta la jugosa carne tierna en su interior. Cocinado a la perfección en el horno, su calor envolvente crea una textura irresistible que se derrite en la boca. Nuestra receta especial combina hierbas frescas como romero y tomillo con especias aromáticas y un toque de ajo, creando una sinfonía de sabores única que deleitará tu paladar.', '../Recursos/platos/polloHorno_A.png', 10.99),
('Tallarin Verde con Pollo al Horno', 'Este plato es una exquisita elección para quienes deseen deleitarse con un plato nutritivo y lleno de sabor. Este plato emblemático de la gastronomía peruana destaca por su vibrante salsa verde, una deliciosa mezcla de albahaca, espinaca, y queso fresco, fusionada con la cremosidad de la leche evaporada.', '../Recursos/platos/tallVer_N.png', 10.99),
('Tamalito Criollo', 'Este tamalito criollo combina masa de maíz suave con un relleno sabroso de carne sazonada, envuelto en hojas de plátano y cocido al vapor. Es una experiencia gastronómica única que evoca tradiciones culinarias auténticas, con ingredientes frescos y especias seleccionadas para deleitar en cada bocado.', '../Recursos/platos/tamal_N.png', 5.99),
('Trucha Frita c/Yuca y Arroz', 'La trucha frita con yuca y arroz celebra la frescura y simplicidad de sus ingredientes. La trucha, con piel crujiente y un interior jugoso, se acompaña de yuca dorada y arroz blanco esponjoso. Esta combinación ofrece una variedad deliciosa de texturas y sabores, creando una experiencia culinaria rica y satisfactoria.', '../Recursos/platos/trucha_N.png', 21.99);

DROP PROCEDURE IF EXISTS SP_OBTENER_PRODUCTOS;

DELIMITER //

CREATE PROCEDURE SP_OBTENER_PRODUCTOS(IN bus VARCHAR(255))
BEGIN
    SELECT id, producto, detalles, foto, precio
    FROM productos
    WHERE id LIKE CONCAT('%', bus, '%')
       OR producto LIKE CONCAT('%', bus, '%')
       OR detalles LIKE CONCAT('%', bus, '%')
       OR foto LIKE CONCAT('%', bus, '%')
       OR precio LIKE CONCAT('%', bus, '%');
END //

DELIMITER ;

-- Procedimiento para insertar un nuevo producto
DROP PROCEDURE IF EXISTS SP_INSERTAR_PRODUCTO;

DELIMITER //

CREATE PROCEDURE SP_INSERTAR_PRODUCTO(
    IN p_producto VARCHAR(100),
    IN p_detalles TEXT,
    IN p_foto VARCHAR(255),
    IN p_precio DECIMAL(10,2)
)
BEGIN
    INSERT INTO productos (producto, detalles, foto, precio)
    VALUES (p_producto, p_detalles, p_foto, p_precio);
END //

DELIMITER ;

-- Procedimiento para obtener un producto por su ID
DROP PROCEDURE IF EXISTS SP_OBTENER_PRODUCTO_POR_ID;

DELIMITER //

CREATE PROCEDURE SP_OBTENER_PRODUCTO_POR_ID(
    IN p_id INT
)
BEGIN
    SELECT * FROM productos WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento para actualizar un producto
DROP PROCEDURE IF EXISTS SP_ACTUALIZAR_PRODUCTO;

DELIMITER //

CREATE PROCEDURE SP_ACTUALIZAR_PRODUCTO(
    IN p_id INT, 
    IN p_producto VARCHAR(100), 
    IN p_detalles TEXT, 
    IN p_foto VARCHAR(255), 
    IN p_precio DECIMAL(10,2)
)
BEGIN
    UPDATE productos
    SET producto = p_producto, detalles = p_detalles, foto = p_foto, precio = p_precio
    WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento para actualizar un producto con imagen
DROP PROCEDURE IF EXISTS SP_ACTUALIZAR_PRODUCTO_CON_IMAGEN;

DELIMITER //

CREATE PROCEDURE SP_ACTUALIZAR_PRODUCTO_CON_IMAGEN(
    IN p_id INT, 
    IN p_producto VARCHAR(100), 
    IN p_detalles TEXT, 
    IN p_foto VARCHAR(255), 
    IN p_precio DECIMAL(10,2)
)
BEGIN
    UPDATE productos
    SET producto = p_producto, detalles = p_detalles, foto = p_foto, precio = p_precio
    WHERE id = p_id;
END //

DELIMITER ;

-- Procedimiento para eliminar un producto
DROP PROCEDURE IF EXISTS SP_ELIMINAR_PRODUCTO;

DELIMITER //

CREATE PROCEDURE SP_ELIMINAR_PRODUCTO(
    IN p_id INT
)
BEGIN
    DELETE FROM productos WHERE id = p_id;
END //

DELIMITER ;

-- Crear la tabla boletas
CREATE TABLE boletas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    dni VARCHAR(8) NOT NULL,
    numero_de_cuotas INT NOT NULL,
    fecha_emision DATE NOT NULL,
    pago_final DECIMAL(10, 2) NOT NULL
);

-- Insertar datos de ejemplo en la tabla boletas
INSERT INTO boletas (nombre, dni, numero_de_cuotas, fecha_emision, pago_final) VALUES
('Juan Pérez', '12345678', 3, '2024-07-10', 50.75),
('María Gómez', '23456789', 6, '2024-07-09', 30.50),
('Pedro Rodríguez', '34567890', 1, '2024-07-08', 48.00);

-- Procedimientos CRUD para la tabla boletas

-- Obtener boletas
DROP PROCEDURE IF EXISTS SP_OBTENER_BOLETAS;
DELIMITER //

CREATE PROCEDURE SP_OBTENER_BOLETAS(IN bus VARCHAR(255))
BEGIN
    SELECT id, nombre, dni, numero_de_cuotas, fecha_emision, pago_final
    FROM boletas
    WHERE id LIKE CONCAT('%', bus, '%')
       OR nombre LIKE CONCAT('%', bus, '%')
       OR dni LIKE CONCAT('%', bus, '%')
       OR numero_de_cuotas LIKE CONCAT('%', bus, '%')
       OR fecha_emision LIKE CONCAT('%', bus, '%')
       OR pago_final LIKE CONCAT('%', bus, '%');
END //

DELIMITER ;

-- Insertar una nueva boleta
DROP PROCEDURE IF EXISTS SP_INSERTAR_BOLETA;
DELIMITER //

CREATE PROCEDURE SP_INSERTAR_BOLETA(
    IN p_nombre VARCHAR(100),
    IN p_dni VARCHAR(8),
    IN p_numero_de_cuotas INT,
    IN p_fecha_emision DATE,
    IN p_pago_final DECIMAL(10, 2)
)
BEGIN
    INSERT INTO boletas (nombre, dni, numero_de_cuotas, fecha_emision, pago_final)
    VALUES (p_nombre, p_dni, p_numero_de_cuotas, p_fecha_emision, p_pago_final);
END //

DELIMITER ;

-- Obtener una boleta por su ID
DROP PROCEDURE IF EXISTS SP_OBTENER_BOLETA_POR_ID;
DELIMITER //

CREATE PROCEDURE SP_OBTENER_BOLETA_POR_ID(
    IN p_id INT
)
BEGIN
    SELECT * FROM boletas WHERE id = p_id;
END //

DELIMITER ;

-- Actualizar una boleta
DROP PROCEDURE IF EXISTS SP_ACTUALIZAR_BOLETA;
DELIMITER //

CREATE PROCEDURE SP_ACTUALIZAR_BOLETA(
    IN p_id INT, 
    IN p_nombre VARCHAR(100), 
    IN p_dni VARCHAR(8), 
    IN p_numero_de_cuotas INT, 
    IN p_fecha_emision DATE, 
    IN p_pago_final DECIMAL(10, 2)
)
BEGIN
    UPDATE boletas
    SET nombre = p_nombre, dni = p_dni, numero_de_cuotas = p_numero_de_cuotas, fecha_emision = p_fecha_emision, pago_final = p_pago_final
    WHERE id = p_id;
END //

DELIMITER ;

-- Eliminar una boleta
DROP PROCEDURE IF EXISTS SP_ELIMINAR_BOLETA;
DELIMITER //

CREATE PROCEDURE SP_ELIMINAR_BOLETA(
    IN p_id INT
)
BEGIN
    DELETE FROM boletas WHERE id = p_id;
END //

DELIMITER ;



-- Crear la tabla facturas
CREATE TABLE facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    RUC VARCHAR(11) NOT NULL,
    razon_social VARCHAR(255) NOT NULL,
    direccion_fiscal VARCHAR(255) NOT NULL,
    fecha_emision DATE NOT NULL,
    pago_final DECIMAL(10, 2) NOT NULL
);

-- Insertar datos de ejemplo en la tabla facturas
INSERT INTO facturas (nombre, RUC, razon_social, direccion_fiscal, fecha_emision, pago_final) VALUES
('Corporación Inca', '20123456789', 'Inca Trading S.A.', 'Av. Los Incas 123, Lima', '2024-07-10', 3500.75),
('Gastronomía Andina', '20234567890', 'Andina Foods S.A.C.', 'Jr. Los Andes 456, Cusco', '2024-07-11', 2750.40),
('Exportaciones Perú', '20345678901', 'Peru Export S.A.', 'Calle Comercio 789, Arequipa', '2024-07-12', 4100.00),
('Servicios Turísticos', '20456789012', 'Turismo Perú E.I.R.L.', 'Av. Miraflores 321, Lima', '2024-07-13', 1500.60),
('Hotel Machu Picchu', '20567890123', 'Machu Picchu Hotel S.A.C.', 'Jr. Cusco 654, Cusco', '2024-07-14', 5900.30),
('Consultoría Empresarial', '20678901234', 'Empresarial Consulting S.R.L.', 'Calle Negocios 987, Lima', '2024-07-15', 3200.00),
('Restaurante Ceviche', '20789012345', 'Ceviche del Mar S.A.', 'Av. Pescadores 222, Callao', '2024-07-16', 4800.20),
('Distribuidora Quinoa', '20890123456', 'Quinoa Export E.I.R.L.', 'Jr. Agricultura 333, Puno', '2024-07-17', 2600.45),
('Industrias Textiles', '20901234567', 'Textiles Andinos S.A.', 'Av. Tejidos 444, Lima', '2024-07-18', 6700.55),
('Corporación Alpaca', '21012345678', 'Alpaca Corp. S.A.', 'Calle Lana 555, Arequipa', '2024-07-19', 5200.60);

-- Procedimientos CRUD para la tabla facturas

-- Obtener facturas
DROP PROCEDURE IF EXISTS SP_OBTENER_FACTURAS;
DELIMITER //

CREATE PROCEDURE SP_OBTENER_FACTURAS(IN bus VARCHAR(255))
BEGIN
    SELECT id, nombre, RUC, razon_social, direccion_fiscal, fecha_emision, pago_final
    FROM facturas
    WHERE id LIKE CONCAT('%', bus, '%')
       OR nombre LIKE CONCAT('%', bus, '%')
       OR RUC LIKE CONCAT('%', bus, '%')
       OR razon_social LIKE CONCAT('%', bus, '%')
       OR direccion_fiscal LIKE CONCAT('%', bus, '%')
       OR fecha_emision LIKE CONCAT('%', bus, '%')
       OR pago_final LIKE CONCAT('%', bus, '%');
END //

DELIMITER ;

-- Insertar una nueva factura
DROP PROCEDURE IF EXISTS SP_INSERTAR_FACTURA;
DELIMITER //

CREATE PROCEDURE SP_INSERTAR_FACTURA(
    IN p_nombre VARCHAR(100),
    IN p_RUC VARCHAR(11),
    IN p_razon_social VARCHAR(255),
    IN p_direccion_fiscal VARCHAR(255),
    IN p_fecha_emision DATE,
    IN p_pago_final DECIMAL(10, 2)
)
BEGIN
    INSERT INTO facturas (nombre, RUC, razon_social, direccion_fiscal, fecha_emision, pago_final)
    VALUES (p_nombre, p_RUC, p_razon_social, p_direccion_fiscal, p_fecha_emision, p_pago_final);
END //

DELIMITER ;

-- Obtener una factura por su ID
DROP PROCEDURE IF EXISTS SP_OBTENER_FACTURA_POR_ID;
DELIMITER //

CREATE PROCEDURE SP_OBTENER_FACTURA_POR_ID(
    IN p_id INT
)
BEGIN
    SELECT * FROM facturas WHERE id = p_id;
END //

DELIMITER ;

-- Actualizar una factura
DROP PROCEDURE IF EXISTS SP_ACTUALIZAR_FACTURA;
DELIMITER //

CREATE PROCEDURE SP_ACTUALIZAR_FACTURA(
    IN p_id INT, 
    IN p_nombre VARCHAR(100), 
    IN p_RUC VARCHAR(11), 
    IN p_razon_social VARCHAR(255), 
    IN p_direccion_fiscal VARCHAR(255), 
    IN p_fecha_emision DATE, 
    IN p_pago_final DECIMAL(10, 2)
)
BEGIN
    UPDATE facturas
    SET nombre = p_nombre, RUC = p_RUC, razon_social = p_razon_social, direccion_fiscal = p_direccion_fiscal, fecha_emision = p_fecha_emision, pago_final = p_pago_final
    WHERE id = p_id;
END //

DELIMITER ;

-- Eliminar una factura
DROP PROCEDURE IF EXISTS SP_ELIMINAR_FACTURA;
DELIMITER //

CREATE PROCEDURE SP_ELIMINAR_FACTURA(
    IN p_id INT
)
BEGIN
    DELETE FROM facturas WHERE id = p_id;
END //

DELIMITER ;
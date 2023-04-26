-- 1. Obtener los detalles completos de todos los usuarios, ordenados alfabéticamente.
SELECT * FROM usuario ORDER BY nombre; 

-- 2. Obtener los detalles completos de todos los productos líquidos.
SELECT * FROM producto WHERE tipo=liquido; 

-- 3. Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.
SELECT * FROM venta WHERE cantidad BETWEEN 6 AND 10; 

-- 4. Obtener la cantidad total de todos los productos vendidos.
SELECT SUM(cantidad) FROM venta; 

-- 5. Mostrar los primeros 3 números de productos que se han enviado.
SELECT * FROM venta ORDER BY fecha_de_venta LIMIT 3; 

-- 6. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
SELECT 
venta.id, 
producto.nombre AS producto, 
usuario.nombre AS usuario, 
venta.cantidad, 
venta.fecha_de_venta 
FROM venta 
JOIN producto ON venta.id_producto = producto.id 
JOIN usuario ON venta.id_usuario = usuario.id; 

-- 7. Indicar el monto (cantidad * precio) por cada una de las ventas.
SELECT 
venta.id, 
producto.nombre AS producto, 
usuario.nombre AS usuario, 
venta.cantidad, 
venta.fecha_de_venta, 
ROUND(venta.cantidad * producto.precio, 2) AS total 
FROM venta 
JOIN producto ON venta.id_producto = producto.id 
JOIN usuario ON venta.id_usuario = usuario.id; 

-- 8. Obtener la cantidad total del producto 1003 vendido por el usuario 104.
SELECT SUM(cantidad) FROM venta WHERE id_usuario = 104 AND id_producto = 1003; 

-- 9. Obtener todos los números de los productos vendidos por algún usuario de ‘Avellaneda’.
SELECT producto.id, 
producto.codigo_de_barra, 
producto.nombre, 
producto.tipo, 
producto.stock, 
producto.precio, 
producto.fecha_de_creacion, 
producto.fecha_de_modificacion,
usuario.localidad AS vendido_en
FROM producto
JOIN venta ON producto.id = venta.id_producto
JOIN usuario ON venta.id_usuario = usuario.id
WHERE usuario.localidad = 'Avellaneda';

-- 10. Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’.
SELECT * FROM usuario WHERE usuario.nombre LIKE '%u%';

-- 11. Traer las ventas entre junio del 2020 y febrero 2021.
SELECT * FROM venta WHERE venta.fecha_de_venta > '2020-06-01' AND venta.fecha_de_venta < '2021-03-01';

-- 12. Obtener los usuarios registrados antes del 2021.
SELECT * FROM usuario WHERE usuario.fecha_de_registro < '2021-01-01';

-- 13. Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35.
INSERT INTO producto ('codigo_de_barra', 'nombre', 'tipo', 'stock', 'precio', 'fecha_de_creacion', 'fecha_de_modificacion') 
VALUES ('77900370', 'Chocolate', 'solido','50','25.35','2023-04-26','2023-04-26');

-- 14. Insertar un nuevo usuario .
INSERT INTO usuario ('nombre', 'apellido', 'clave', 'mail', 'fecha_de_registro', 'localidad') 
VALUES ('Joel','Mahafud','Pa$$word','joel@mail.com','2023-04-26','CABA');

-- 15. Cambiar los precios de los productos de tipo sólido a 66,60.
UPDATE 'producto' SET 'precio' = '66.60' WHERE producto.tipo = 'solido';

-- 16. Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores a 20 inclusive.
UPDATE producto SET stock = '0' WHERE producto.stock <= 20;

-- 17. Eliminar el producto número 1010.
DELETE FROM producto WHERE producto.id = 1010;

-- 18. Eliminar a todos los usuarios que no han vendido productos.
DELETE FROM usuario WHERE usuario.id NOT IN (SELECT venta.id_usuario FROM venta);
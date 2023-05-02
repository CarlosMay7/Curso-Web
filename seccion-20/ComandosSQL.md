# Comandos SQL

#### El estándar es que todos los comandos en sql esten en mayúsculas
#### Los comandos se cierran con ;

### Mostrar bases de datos disponibles
-   SHOW DATABASES;

### Crear base de datos
-   CREATE DATABASE NOMBREBD;

### Acceder o usar una base de datos
-   USE NOMBREBD;

### Mostrar las tablas en una bd (Solo nombres)
-   SHOW TABLES;

### Mostrar definicion de tabla
-   DESCRIBE Nombre_tabla;

### Crear tabla
- Después de definir la extensión del dato pueden ir los valores de NOT NULL para que se tenga que llenar y AUTO-INCREMENT para que cada vez que se agregue un registro se aumente el valor del id
- Se pueden agregar más valores a las colummnas con ,
- La primary key es lo que usa como un tipo de "índice" para buscar 

-   CREATE TABLE NOMBRETABLA(
    NOMBRE_COLUMNA TIPO_DATO(EXTENSION) NOT NULL AUTO_INCREMENT,
    Para_Decimales DEC(Cantidad_Digitos,Cantidad_Decimales),
    PRIMARY KEY(nombre_columna)
);

### Insertar valores en una tabla
- INSERT INTO nombre_tabla (Columna1, Columna n) VALUES (valor1, valorn);

#### Insertar varios registros
- INSERT INTO nombre_tabla (Columna1, Columna n) VALUES (valor1, valorn),
(valor1, valorn), ... ;

### Mostrar los registros
Se pueden combinar las sentencias para una busqueda más precisa

#### Muestra toda la tabla
- SELECT * FROM nombre_tabla;
#### Muestra una columna
- SELECT nombre_columna FROM nombre_tabla;
#### Muestra varias columnas
- SELECT nombre_columna1, nombre_columnan FROM nombre_tabla;
#### Muestra según una condición
- SELECT * FROM nombre_tabla WHERE nombre_columna condicion;
La condición puede ser =, <, >, entre otras
#### Muestra los valores en el rango
- SELECT * FROM nombre_tabla WHERE nombre_columna BETWEEN valor_minio AND valor_maximo;

### Funciones agregadoras

#### Cuenta la cantidad de veces que se repite la columna a contar
- SELECT COUNT(nombre_columna), nombre_columna_contar FROM nombre_tabla GROUP BY columna_agrupar ORDER BY COUNT(nombre_columna);

#### Suma una columna de una tabla y crea una temporal
- SELECT SUM(nombre_columna_sumar) AS nombre_tabla_temporal FROM nombre_tabla

#### Toma el valor mínimo de una columna en una tabla y crea una temporal
- SELECT MIN(nombre_columna_sumar) AS nombre_tabla_temporal FROM nombre_tabla

#### Toma el valor máximo de una columna en una tabla y crea una temporal
- SELECT MAX(nombre_columna_sumar) AS nombre_tabla_temporal FROM nombre_tabla


#### Ordena según una columna
Despues de la columna por la que ordenará se puede poner ASC/DESC si se desea ascendente o descendente
- SELECT nombre_columna1, nombre_columnan FROM nombre_tabla ORDER BY columna;

#### Mostrar una cantidad de registros
- SELECT nombre_columna1, nombre_columnan FROM nombre_tabla LIMIT limite;

#### Mostrar un registro
- SELECT nombre_columna1, nombre_columnan FROM nombre_tabla WHERE nombre_columna_condicion = valor_buscado;

### Actualizar registros
##### SIEMPRE LLEVA UN WHERE

#### Actualizar un valor del registro
- UPDATE nombre_tabla SET valor_cambiar = valor_nuevo WHERE nombre_columna_condicion = valor_condicion;
#### Actualizar varios valores
- UPDATE nombre_tabla SET valor_cambiar1 = valor_nuevo1, valor_cambiar2 = valor_nuevo2 WHERE nombre_columna_condicion = valor_condicion;

### Eliminar registros
##### SIEMPRE LLEVA UN WHERE
Los registros cuando se borran dejan el espacio "ocupado" porque cuando se agrega un nuevo registro se agrega al final, no en los espacios donde se eliminó algo
- DELETE FROM nombre_tabla WHERE nombre_columna_condicion = valor_condicion;

#### Modificar una tabla existente
- ALTER TABLE nombre_tabla ADD nombre_nueva_columna TIPO_DATO(extension) campos extra;

#### Modificar una columna
No se puede modificar el tipo de dato, pero si su extensión
- ALTER TABLE nombre_tabla CHANGE nombre_columna_cambiar nuevo_nombre;
#### Eliminar una columna
- ALTER TABLE nombre_tabla DROP COLUMN nombre_columna_eliminar;

### Eliminar tabla
- DROP TABLE nombre_tabla_eliminar;


### Buscar en SQL
El % hace que lo demás "no importe"
#### Empiece con
- SELECT * FROM nombre_tabla WHERE nombre_columna_donde_buscar LIKE "inicio_valor%";

#### Termine con
- SELECT * FROM nombre_tabla WHERE nombre_columna_donde_buscar LIKE "%final_valor"; 

#### Contenga
- SELECT * FROM nombre_tabla WHERE nombre_columna_donde_buscar LIKE "%parte_valor%";

### Concatenar columnas
El ' ' es para añadir un espacio entre ambas columnas, como concatenar una columna más
- SELECT CONCAT(columna1,' ', columnan) AS nombre_tabla_temporal FROM nombre_tabla;

### Revisar por varias condiciones

#### Se usa el IN para en una condicion insertar varios valores
- SELECT * FROM nombre_tabla WHERE nombre_columna_donde_buscar IN(valores);

#### Se usa el AND para agregar varias condiciones
- SELECT * FROM nombre_tabla WHERE nombre_columna_donde_buscar condicion AND otra_columna condicion;

#### Se pueden combinar
- SELECT * FROM nombre_tabla WHERE nombre_columna_donde_buscar IN(valores) AND otra_columna condicion;
<?php

/*
CREATE DATABASE curso_php;

USE curso_php;

CREATE TABLE usuarios(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(24) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(40) NOT NULL,
    suspendido BOOL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX(username, password, suspendido)
) ENGINE=InnoDB;
*/


print "001 Base de DATOS MySQL con \"sqli\" Estilo por procedimientos<br>";
//Conectarse a la base de datos
$host = 'localhost';
$usuario = 'root';
$clave = '';
$dbname = 'curso_php';
//me conecto al motor de BD
//$conn = mysqli_connect($host, $usuario, $clave);
//o bien directamente a la base de datos que deseo
$conn = mysqli_connect($host, $usuario, $clave, $dbname);
//or die('No me pude conectar a la base de datos');
if(!$conn)
	print "No se pudo conectar con passwd \"$clave\" <br>";

//Seleccionar una base de datos, por ejemplo si solo me conecte al motor o vengo desde otra BD
mysqli_select_db($conn, $dbname);

//Ejecutar una consulta simple
$sql = "
INSERT INTO usuarios
	(username, email, password)
VALUES
	('juanperez', 'jperez@algundominio.ext', '26ec07ef61f135494b79a13674a9a4ae')"; // DESACONSEJADO: PHP NO DESINFECTA LOS DATOS

//////////////$result = mysqli_query($conn, $sql);

//Ejecutar una consulta múltiple
$sql = "
INSERT INTO usuarios
		(username, email, password)
VALUES ('javier75','javi75@algundominio.ext','26ec07ef61f135494b79a13674a9a4ae'),
		('noelia','noe@algundominio.ext','26ec07ef61f135494b79a13674a9a4ae'),
		('ana_AR','anita@algundominio.ext','26ec07ef61f135494b79a13674a9a4ae')";      // DESACONSEJADO: PHP NO DESINFECTA LOS DATOS

//////////////////$result = mysqli_query($conn, $sql);

//Ejecutar una consulta de selección múltiple y capturar sus resultados
$sql = "
SELECT id, username, email
FROM usuarios
";
$result = mysqli_query($conn, $sql);

$registros = NULL;
//while($reg = mysqli_fetch_array($result, MYSQLI_ASSOC))	//Capturamos el array asociativo con los resultados
while($reg = mysqli_fetch_assoc($result)) //Capturamos el array asociativo con los resultados
//while($reg = mysqli_fetch_row($result)) //Capturamos el array comun (indices numericos) con los resultados
    $registros[] = $reg;

//con ASSOC esto devuelve
//$registros = array(
//array('campo1'=>'valor', 'campo2'=>'valor', 'campo7'=>'valor'),
//array('campo1'=>'valor', 'campo2'=>'valor', 'campo7'=>'valor'),
//);

mysqli_free_result($result);		//Liberar los resultados

mysqli_close($conn);        //cerrar la conexion

print "<br>";
print_r($registros);
//var_dump($registros);
print "<br><br>";



print "Forma de consultas con COMODINES<br>";
//FORMA DE CONSULTAS CON COMODINES
# Preparar las variables con los datos de conexión
# Conectarse a la base de datos
$conn = mysqli_connect($host, $usuario, $clave, $dbname);
if(!$conn)
    print "No se pudo conectar con passwd \"$clave\" <br>";
# Preparo la sentencia con los comodines ?
$sql = "
INSERT INTO
	usuarios (username, email, password)
VALUES
	(?, ?, ?)";
# Preparo los datos que voy a insertar
$username = 'Julito';
$email = 'julito@algundominio.ext';
$password = '26ec07ef61f135494b79a13674a9a4ae';
# Preparo la consulta
$pre = mysqli_prepare($conn, $sql);
# indico los datos a reemplazar con su tipo
mysqli_stmt_bind_param($pre, "sss", $username, $email, $password);
//La “s” significa string. Tres “s”, significan que los tres datos son de tipo string
//(s) string (i) entero (d) doble/decimal (b) blob

# Ejecuto la consulta
///////////mysqli_stmt_execute($pre);

# PASO OPCIONAL (SOLO PARA CONSULTAS DE INSERCIÓN):
# Obtener el ID del registro insertado. devuelve el ID generado por una query (normalmente INSERT) en una tabla con una columna que tenga el atributo AUTO_INCREMENT
////////////$nuevo_id = mysqli_insert_id($conn);  

# Cierro la consulta y la conexión
mysqli_stmt_close($pre);
//mysqli_close($conn);


# Preparar las variables con los datos de conexión
# Conectarse a la base de datos
//$conn = mysqli_connect($host, $usuario, $clave, $dbname);
# Preparo la sentencia con los comodines ?
$sql = "
SELECT
	id, email
FROM
	usuarios
WHERE
		username = ?
	AND
		password = ?";
# Preparo los datos que voy a insertar
$username = 'juanperez';
$password = '26ec07ef61f135494b79a13674a9a4ae';
#Preparo la consulta
$pre = mysqli_prepare($conn, $sql);
# indico los datos a reemplazar con su tipo
mysqli_stmt_bind_param($pre, "ss", $username, $password);
# Ejecuto la consulta
mysqli_stmt_execute($pre);
# asocio los nombres de campo a nombres de variables
mysqli_stmt_bind_result($pre, $id, $email);
# Capturo los resultados y los guardo en un array

$registros = NULL;
//print " fetch >> '".mysqli_stmt_fetch($pre)."' <br>";
while(mysqli_stmt_fetch($pre))
    $registros[] = array('id'=>$id, 'email'=>$email);

//devuelve
//$registros = array(
//array('campo1'=>'valor', 'campo2'=>'valor', 'campo7'=>'valor'),
//array('campo1'=>'valor', 'campo2'=>'valor', 'campo7'=>'valor'),
//);

# Cierro la consulta y la conexión
mysqli_stmt_close($pre);
mysqli_close($conn);

print_r($registros);
//var_dump($registros);
print "<br><br><br>";







print "002 Base de DATOS MySQL con \"sqli\" Estilo por objetos<br>";
//Conectarse a la base de datos
$host = 'localhost';
$usuario = 'root';
$clave = '';
$dbname = 'curso_php';
//me conecto al motor de BD
//$conn = new mysqli($host, $usuario, $clave);
//o bien directamente a la base de datos que deseo
$conn = new mysqli($host, $usuario, $clave, $dbname);
//or die('No me pude conectar a la base de datos');
if($conn->connect_errno)
    print "No se pudo conectar '$conn->connect_error'<br>";

//Seleccionar una base de datos, por ejemplo si solo me conecte al motor o vengo desde otra BD
//$dbname = "kkkkk";
if(!$conn->select_db($dbname))
    print "No pude cambiaer de base a datos a '$dbname' -> '$conn->errno' '$conn->error'<br>";

//Ejecutar una consulta simple
$sql = "
INSERT INTO usuarios
    (username, email, password)
VALUES
    ('Pedro', 'Pedro@algundominio.ext', '26ec07ef61f135494b79a13674a9a4ae')";  // DESACONSEJADO: PHP NO DESINFECTA LOS DATOS

////////if(!$conn->query($sql))
//////    print "ERROR en consulta $sql<br>";


//Ejecutar una consulta de selección múltiple y capturar sus resultados
$sql = "
SELECT id, username, email
FROM usuarios
";
$result  = $conn->query($sql);
if(!$result)
    print "ERROR en consulta $sql<br>";

$registros = NULL;
while($reg = $result->fetch_array( MYSQLI_ASSOC))  //Capturamos el array asociativo con los resultados
//while($reg = $result->fetch_assoc())  //Capturamos el array asociativo con los resultados
//while($reg = $result->fetch_row())  //Capturamos el array comun (indices numericos) con los resultados
    $registros[] = $reg;

print "<br>";
print_r($registros);
//var_dump($registros);

$result->free();        //Liberar los resultados
$conn->close();

print "<br><br>";


print "Forma de consultas con COMODINES<br>";
//FORMA DE CONSULTAS CON COMODINES
//me conecto al motor de BD
//$conn = new mysqli($host, $usuario, $clave);
//o bien directamente a la base de datos que deseo
$conn = new mysqli($host, $usuario, $clave, $dbname);
//or die('No me pude conectar a la base de datos');
if($conn->connect_errno)
    print "No se pudo conectar '$conn->connect_error'<br>";

# Preparo la sentencia con los comodines ?
$sql = "
INSERT INTO
    usuarios (username, email, password)
VALUES
    (?, ?, ?)";
# Preparo los datos que voy a insertar
$username = 'Julito';
$email = 'julito@algundominio.ext';
$password = '26ec07ef61f135494b79a13674a9a4ae';
# Preparo la consulta
$pre = $conn->prepare($sql);
# indico los datos a reemplazar con su tipo
$pre->bind_param("sss", $username, $email, $password);
//La “s” significa string. Tres “s”, significan que los tres datos son de tipo string
//(s) string (i) entero (d) doble/decimal (b) blob

# Ejecuto la consulta
$pre->execute();

# PASO OPCIONAL (SOLO PARA CONSULTAS DE INSERCIÓN):
# Obtener el ID del registro insertado. devuelve el ID generado por una query (normalmente INSERT) en una tabla con una columna que tenga el atributo AUTO_INCREMENT
$nuevo_id = $conn->insert_id;  
print "\$nuevo_id ----> '$nuevo_id'<br>";
# Cierro la consulta y la conexión
$pre->close();
$conn->close();


# Preparar las variables con los datos de conexión
//me conecto al motor de BD
//$conn = new mysqli($host, $usuario, $clave);
//o bien directamente a la base de datos que deseo
$conn = new mysqli($host, $usuario, $clave, $dbname);
//or die('No me pude conectar a la base de datos');
if($conn->connect_errno)
    print "No se pudo conectar '$conn->connect_error'<br>";
# Preparo la sentencia con los comodines ?
$sql = "
SELECT
    id, email
FROM
    usuarios
WHERE
        username = ?
    AND
        password = ?";

# Preparo los datos que voy a insertar
$username = 'Julito';
$password = '26ec07ef61f135494b79a13674a9a4ae';
#Preparo la consulta
$pre = $conn->prepare($sql);
# indico los datos a reemplazar con su tipo
$pre->bind_param("ss", $username, $password);
# Ejecuto la consulta
$pre->execute();
# asocio los nombres de campo a nombres de variables
$pre->bind_result($id, $email);
# Capturo los resultados y los guardo en un array

$registros = NULL;
while($pre->fetch())
    $registros[] = array('id'=>$id, 'email'=>$email);

# Cierro la consulta y la conexión
$pre->close();
$conn->close();

print_r($registros);
//var_dump($registros);
print "<br><br><br>";





/*  ESTA ES LA FORMA */
/*  ESTA ES LA FORMA */
/*  ESTA ES LA FORMA */
/*  ESTA ES LA FORMA */

print "003 Base de DATOS MySQL con objetos \"PDO (PHP DATA OBJECT)\"<br>";
/*
La capa de abstracción propia de PHP se llama PDO. PDO, biblioteca orientada a objetos.
 Utilizando PDO no podemos olvidarnos completamente del SGBD utilizado, pero la mayor parte del código es independiente del SGBD y sólo en algunas partes del programa (en la conexión con el SGBD o en la creación de tablas, por ejemplo) el código es específico del SGBD.
*/
// FUNCIÓN DE CONEXIÓN CON LA BASE DE DATOS MYSQL

$dbname = 'curso_php';
$host = "mysql:host=localhost";
$host_and_dbname = $host . ";dbname=" . $dbname;

//me puedo conectar al host+db o simplemente al host (sin el dbname) y luego referirme a cada tabla como //dbname.table o bien en algun punto conectarme a la dbname correspondiente
function conectaDB($host_and_db, $usuario, $clave)
{
    try {
        $tmp = new PDO($host_and_db, $usuario, $clave);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);     //ERRMODE_SILENT no muestra error
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);    //muestra errores como WARNING
 //       $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    //detiene el script. hay que cargar un manejador de excepciones
        $tmp->exec("set names utf8mb4");
        return $tmp;
    } catch (PDOException $e) {
//        cabecera("Error grave", MENU_PRINCIPAL);
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Error: " . $e->getMessage() . "</p>\n";
//       pie();
//       exit();
    }
}

// EJEMPLO DE USO DE LA FUNCIÓN conectaDB()
// La conexión se debe realizar en cada página que acceda a la base de datos
$db = conectaDB($host_and_dbname, $usuario, $clave);

print "<br>";

//$db = null;		//Para desconectar con la base de datos hay que destruir el objeto PDO. Si no se destruye el objeto PDO, PHP lo destruye al terminar la página.

$username = 'JulianVitale';
$email = 'julianVitale@algundominio.ext';
$password = '26ec07ef61f135494b79a13674a68956';
$consulta = "INSERT INTO usuarios
				    (username, email, password)
    			VALUES ('$username', '$email', '$password')";

//print "consulta = \"" . $consulta . "\"<br>";

$result = $db->query($consulta);
if (!$result) {
    print " <p class=\"aviso\">Error al crear el registro. cod='" . $db->errorCode() . "' '" . $db->errorInfo()[0] . "' '" . $db->errorInfo()[1] . "' text='". $db->errorInfo()[2] . "'</p>\n";
}
else {
    $nuevo_id = $db->lastInsertId();
    print "    <p>Registro '$username' creado correctamente en registro '$nuevo_id'</p>\n";
}


$consulta = "SELECT * FROM usuarios";
$result = $db->query($consulta);
if (!$result) {
    print "<p class=\"aviso\">Error en la consulta. cod='" . $db->errorCode() . "' '" . $db->errorInfo()[0] . "' '" . $db->errorInfo()[1] . "' text='" . $db->errorInfo()[2] . "'</p>\n";
} else {
    //Los valores puedo obtenerlos directamente del objeto $result (no se hasta que cantidad) o bien puedo
    //obtenerlos mediante $result->fetch().
    foreach ($result as $valor) {
        print "    $valor[username] $valor[email]<br>";
    }
    $result->closeCursor();             //cierro el cursor para poder utilizar otro si es necesario
}


print "<br>Consultas preparadas....<br>";
/*
Para evitar ataques de inyección SQL (en la lección Inyecciones SQL se comentan los ataques más elementales), se recomienda el uso de sentencias preparadas, en las que PHP se encarga de "desinfectar" los datos en caso necesario. En general, cualquier consulta que incluya datos introducidos por el usuario debe realizarse mediante consultas preparadas.
*/
// Consulta preparada
$consulta = "SELECT * FROM usuarios";
$result = $db->prepare($consulta);
if (!$result->execute()) {
    print "<p class=\"aviso\">Error en la consulta. cod='" . $result->errorCode() . "' '" . $result->errorInfo()[0] . "' '" . $result->errorInfo()[1] . "' text='" . $result->errorInfo()[2] . "'</p>\n";
} else {
    //Los valores puedo obtenerlos directamente del objeto $result (no se hasta que cantidad) o bien puedo
    //obtenerlos mediante $result->fetch().
//   foreach ($result as $valor)
//      print "X    $valor[username] $valor[email]<br>";
    for ($i=0; $i < $result->rowCount(); $i++) {
        $reg = $result->fetch(PDO::FETCH_ASSOC);        //FETCH_ASSOC indica devolver array asociativo
        print "$reg[username] $reg[email]<br>";
    }
    $result->closeCursor();             //cierro el cursor para poder utilizar otro si es necesario
}
print "<br>";
/*
Si la consulta incluye datos introducidos por el usuario, los datos pueden incluirse directamente en la consulta, pero en ese caso, PHP no realiza ninguna "desinfección" de los datos, por lo que estaríamos corriendo riesgos de ataques:
!!!!! Para que PHP desinfecte los datos, estos deben enviarse al ejecutar la consulta, no al prepararla. Para ello es necesario indicar en la consulta la posición de los datos. Esto se puede hacer de dos maneras, mediante parámetros o mediante interrogantes, aunque se aconseja la utilización de parámetros:!!!!!

mediante parámetros (:parametro)
En este caso la matriz debe incluir los nombres de los parámetros y los valores que sustituyen a los parámetros (el orden no es importante), como muestra el siguiente ejemplo:
*/
$name = "%Vitale%";
$consulta = "SELECT COUNT(*) FROM usuarios
    WHERE username LIKE :username";
$result = $db->prepare($consulta);
if (!$result->execute([":username" => $name])) {
    print "<p class=\"aviso\">Error en la consulta. cod='" . $result->errorCode() . "' '" . $result->errorInfo()[0] . "' '" . $result->errorInfo()[1] . "' text='" . $result->errorInfo()[2] . "'</p>\n";
} else {
//    $cantidad = $result->fetchColumn();        //fetchColumn() devuelve el valor de COUNT(*)
//    print "X-----    hay $cantidad \"$name\" con interrogantes ? <br>";
    foreach ($result as $valor) {
        //var_dump($valor);
        print "-----    hay $valor[0] \"$name\" con parametros : <br>";
    }
}

print "<br>";
/*
$result->execute([":username" => $username, ":email" => $email]);
*/

/*
mediantes interrogantes (?)
En este caso la matriz debe incluir los valores que sustituyen a los interrogantes en el mismo orden en que aparecen en la consulta, como muestra el siguiente ejemplo:
*/
$name = "%Vitale%";
$consulta = "SELECT COUNT(*) FROM usuarios
    WHERE username LIKE ?";
$result = $db->prepare($consulta);
if (!$result->execute([$name])) {
    print "<p class=\"aviso\">Error en la consulta. cod='" . $result->errorCode() . "' '" . $result->errorInfo()[0] . "' '" . $result->errorInfo()[1] . "' text='" . $result->errorInfo()[2] . "'</p>\n";
} else {
//    $cantidad = $result->fetchColumn();        //fetchColumn() devuelve el valor de COUNT(*)
//    print "X-----    hay $cantidad \"$name\" con interrogantes ? <br>";
    foreach ($result as $valor) {
        print "-----    hay $valor[0] \"$name\" con interrogantes ? <br>";
    }
}

print "<br>";
//saber si una BD existe
$existe   = true;
$consulta = "SELECT count(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
$result   = $db->query($consulta);
if (!$result) {
    $existe = false;
    print "<p class=\"aviso\">Error en la consulta. cod='" . $db->errorCode() . "' '" . $db->errorInfo()[0] . "' '" . $db->errorInfo()[1] . "' text='" . $db->errorInfo()[2] . "'</p>\n";
} else {
    if ($result->fetchColumn() == 0) {
        $existe = false;
    }
}
print "'$dbname' existe = $existe<br>";

//saber si una tabla existe
$existe   = true;
$consulta = "SELECT count(*) FROM information_schema.tables WHERE table_schema = '$dbname' AND table_name = 'usuarios'";
$result = $db->query($consulta);
if (!$result) {
    $existe = false;
    print "<p class=\"aviso\">Error en la consulta. cod='" . $db->errorCode() . "' '" . $db->errorInfo()[0] . "' '" . $db->errorInfo()[1] . "' text='" . $db->errorInfo()[2] . "'</p>\n";
} else {
    if ($result->fetchColumn() == 0) {
        $existe = false;
    }
}
print "'$dbname'.'usuarios' existe = $existe<br>";

//ejemplo de como consultar la cantidad de registros de una tabla.
$consulta = "SELECT COUNT(*) FROM usuarios";
$result   = $db->query($consulta);
if (!$result) {
    print "<p class=\"aviso\">Error en la consulta. cod='" . $db->errorCode() . "' '" . $db->errorInfo()[0] . "' '" . $db->errorInfo()[1] . "' text='" . $db->errorInfo()[2] . "'</p>\n";
} else {
     $cantidad = $result->fetchColumn();        //fetchColumn() devuelve el valor de COUNT(*), o sea la cantidad de registros
     print "HAY $cantidad USUARIOS<br>";
}

/*
Restricciones en los parámetros de consultas preparadas
Debido a que las consultas preparadas se idearon para optimizar el rendimiento de las consultas, el uso de parámetros tiene algunas restricciones. Por ejemplo

-los identificadores (nombres de tablas, nombres de columnas, etc) no pueden sustituirse por parámetros
-los dos elementos de una igualdad no pueden sustituirse por parámetros
-en general no pueden utilizarse parámetros en las consultas DDL (lenguaje de definición de datos) (nombre y tamaño de las columnas, etc.)
Si no podemos usar parámetros, no queda más remedio que incluir los datos en la consulta. Como en ese caso PHP no hace ninguna desinfección de los datos, la tenemos que hacer nosotros previamente.
*/

$db = null;		//Para desconectar con la base de datos hay que destruir el objeto PDO. Si no se destruye el objeto PDO, PHP lo destruye al terminar la página.


?>
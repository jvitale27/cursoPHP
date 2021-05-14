<?php
/*
PHP Global Variables - Superglobals
Some predefined variables in PHP are "superglobals", which means that they are always accessible, regardless of scope - and you can access them from any function, class or file without having to do anything special.

The PHP superglobal variables are:

$GLOBALS
$_SERVER
$_REQUEST
$_POST
$_GET
$_FILES
$_ENV
$_COOKIE
$_SESSION
*/

// SESIONES
/*
Las sesiones permiten que PHP "recuerde" datos cuando el usuario cambia de página dentro de un mismo sitio web, sin necesidad de ir pasándola de página a página como controles ocultos.
Las sesiones permiten que páginas distintas puedan acceder a una variable común, la matriz $_SESSION.

Para utilizar sesiones mediante el mecanismo propio de PHP (es decir, sin necesidad de crear funciones propias), la directiva session.save_handler del archivo de configuración php.ini debe tener el valor files.
session.save_handler = files        ; Valor recomendado en este curso
session.save_handler = user         ; Valor definido en algunos servidores
en este ultimo caso, se debe anteponer al inicio de la sesion la linea 
ini_set("session.save_handler", "files"); // Necesario únicamente cuando session.save_handler = user en php.ini
*/

// !!!!!! Las sesiones crean cookies, pero las cookies no crean sesiones  !!!!!!

//creacion de SESION
session_name("sesion_1");		//defino un nombre para la sesion. devuelve el viejo nombre de sesion
//session_id('viejoID');			//defino ID de la sesion. Sin argumento me devuelve el ID actual
session_start();			//inicio la sesion en el servidor. debe ser llamada siempre, antes de realizar cualquier otra operación relacionada con sesiones

/*
Las cookies permiten que el servidor almacene datos en el ordenador del cliente.

setcookie() define una cookie para ser enviada junto con el resto de cabeceras HTTP. Como otros encabezados, cookies deben ser enviadas antes de cualquier salida en el script (este es un protocolo de restricción). Esto requiere que hagas llamadas a esta función antes de cualquier salida, incluyendo etiquetas <html> y <head> así como cualquier espacio en blanco.
*/
//Creacion de cookies
$nombre = "nombre_apellido";
$valor = "Julian Vitale";
//$expira = time() + (3600 * 24 * 365); // 1 año
$expira = time() + (60); // 60 s
$dir = "/";			//Se debe utilizar '/' para que sea válida en todo el dominio.
$dominio = "localhost"; // no será válida en www.eugeniabahit.com
$https = FALSE;		//si es TRUE solo se transmite por HTTPS.
$http = TRUE;		//Solo se transmite por HTTP. Ejemplo: True. Siempre se recomienza indicar TRUE
//setcookie($nombre, $valor, $expira, $dir, $dominio, $https, $http);	//creacion de una cookie
setcookie($nombre, $valor, $expira);	//creacion de una cookie de nombre y apellido

$edad = "edad_en_anios";
$valor = 47;
//$expira = time() + (3600 * 24 * 365); // 1 año
$expira = time() + (60); // 60 s
//setcookie($edad, $valor, $expira, $dir, $dominio, $https, $http);	//creacion de una cookie
setcookie($edad, $valor, $expira);	//creacion de una cookie de edad

//Para modificar una cookie la creo de nuevo con los nuevos valores. NO CAMBIO SOLAMANTE LA VBLE $_COOKIE[$edad] !!!!
$valor = 49;
setcookie($edad, $valor, $expira);	//creacion de una cookie de edad

//setcookie($nombre, NULL, time()-999999);		//eliminar una cookie. El valor vacio y el tiempo negativo
//setcookie($edad, NULL, time()-999999);		//eliminar una cookie. El valor vacio y el tiempo negativo


print "000 SESIONES y COOKIES<br>";
print "el id de la sesion es " . session_id() . " y el nombre de sesion es " . session_name();
print "<br>";

$_SESSION["nombre_del_tipo"] = "Pepito Conejo";			//comparto la variable(elemento) nombre="Pepito Conejo"
print "\$_SESSION[\$nombre_del_tipo] = $_SESSION[nombre_del_tipo] y el id de sesion es " . session_id();
print "<br>";
$_SESSION["nombre_del_tipo"] = "EL JULA";			//comparto la variable(elemento) nombre="Pepito Conejo"
print "\$_SESSION[\$nombre_del_tipo] = $_SESSION[nombre_del_tipo] y el id de sesion es " . session_id();
print "<br>";

$_SESSION["edad_del_tipo"] = 22;			//comparto la variable(elemento) nombre="Pepito Conejo"
print "\$_SESSION[\$edad_del_tipo] = $_SESSION[edad_del_tipo] y el id de sesion es " . session_id();
print "<br>";

print "\$_SESSION[] = ";
print_r($_SESSION);

//en cualquier otro archivo php debo poner lo mismo para acceder a la misma matriz $_SESSION
//session_name("sesion_1");		//elijo a que sesion conectarme
//session_start();			//inicio la sesion 

//Las sesiones se pueden cerrar de varias maneras:
//•El usuario puede cerrar la sesión simplemente cerrando el navegador (no basta con cerrar las pestañas).
//•Un programa puede cerrar la sesión mediante la función session_destroy().
//session_destroy();
//session_unset();	//borra todos los valores pero permite que el resto de la página (y otras páginas) escriba o lea //					valores en $_SESSION. Es la que debe utilizarse
//unset($_SESSION["nombre_del_tipo"]);			//Elimino una variable o elemento de la sesión
//unset($_SESSION); // destruyo todas las variables de sesión creadas

// Esto destruye totalmente una SESION
//session_start();			//inicio la sesion 
//unset($_SESSION); // destruyo todas las variables de sesión creadas
//setcookie(session_name(), NULL, time()-999999);		//elimino la cookie que se genero con la sesion
//session_destroy();
print "<br><br>";


print "\$_COOKIE[$nombre] = " . $_COOKIE[$nombre] . " o " . $_COOKIE["nombre_apellido"] . "<br>";
print "\$_COOKIE[$edad] = $_COOKIE[$edad] o $_COOKIE[edad_en_anios] <br>";
//print "\$_COOKIE[] ---> ";
print_r($_COOKIE);
//var_dump($_COOKIE);
print "<br>";

//$datos_cookie = session_get_cookie_params();
//print "datos_cookie[] --> ";
//var_dump($datos_cookie);

//print_r($_COOKIE);

print "<br><br>";




/*
El delimitador <?= ... ?> El delimitador <?= es una abreviatura de la expresión <?php echo
Si se quieren escribir comentarios en los fragmentos HTML, hay que utilizar la etiqueta de comentarios de HTML <!-- .... -->. Hacerlo fuera de la etiqueta de codigo php <php
Estos comentarios, como todo el código HTML situado en los fragmentos HTML, se incluyen sin modificaciones en el resultado, por lo que pueden verse en el navegador.
Si se quieren escribir comentarios en las hojas de estilo CSS, hay que utilizar la etiqueta de comentarios de C /* .... */
/*
Estos comentarios, como todo el código CSS situado en las hojas de estilo, se incluyen sin modificaciones en el resultado, por lo que pueden verse en el navegador.
*/


//INCLUDE BIBLIOTECAS

/*
include "biblioteca1.php";		//incluye el archivo de biblioteca donde hay definiciones de constantes y funciones
require "biblioteca1.php";		//produce un error si no se encuentra el archivo (y no se procesa el resto de la página)

//también incluyen los ficheros pero que, en caso de que los ficheros ya se hayan incluido, entonces no los incluyen.
include_once "biblioteca1.php";
require_once "biblioteca1.php";
*/

//VARIABLES SUPERGLOBALES

/*$_GET //Un array asociativo tipo clave => valor, de los parámetros pasados al script mediante el método HTTP GET, es decir, parámetros pasados por URL.
$nombre = $_GET["nombre"];  //si el formulario fue enviado por el si fuen enviado por el method="get", si la direccion URL es http://example.com/?nombre=Hannes, devuelve "Hannes"
 */
/*
//$_POST //Al igual que el anterior, es un array asociativo formado por clave => valor, pero que almacena los datos pasados al script, mediante el método HTTP POST, generalmente, a través de un formulario.
$nombre = $_POST["nombre"];  //si el formulario fue enviado por el method="post", devuelve el contenido del objeto "nombre", o sea devuelve "Hannes"
*/
/*
Además de $_GET y $_POST, existen otras variables
superglobales, que veremos más adelante. Una de las más
importantes, es la variable superglobal $_SERVER que contiene
información del entorno del servidor y de la ejecución

//$_SERVER //que contiene información del entorno del servidor y de la ejecución
*/

$metodo = $_SERVER['REQUEST_METHOD'];		//retorna el method, o sea get, post, etc.
$uri = $_SERVER['REQUEST_URI'];				//retorna la URL completa que se utilizó para acceder al script

$url = $_SERVER['PHP_SELF']; //contiene la dirección de la página (relativo a la raíz, es decir, sin el nombre del servidor).
// http://www.example.com/ejemplo.php	/ejemplo.php
// http://www.example.com/ejercicios/ejemplo.php	/ejercicios/ejemplo.php
print "\$_SERVER['REQUEST_METHOD'] -> $metodo<br>\$_SERVER['REQUEST_URI'] -> $uri<br>\$_SERVER['PHP_SELF'] -> $url<br>";
//foreach($_SERVER as $clave=>$valor) {
//	echo "\$_SERVER['$clave'] = $valor<br/>";
//}

//$_REQUEST //Cuando se envía un formulario, PHP almacena la información recibida en una matriz llamada $_REQUEST. //El número de valores recibidos y los valores recibidos dependen tanto del formulario como de la acción del usuario.
//$_REQUEST["nombre"], $_REQUEST["edad"], etc. 
//$_REQUEST contiene la misma informacion que $_POST o $_GET segun como se haya enviado el formulario, con
// method="post" o method="get"

#phpinfo();

print "<br><br>";

print "001/2 Asignacion por referencias / VARIOS<br>";
define('PRECIO', 25.78);
define('PRODUCTO', 'Short de baño para niño');
define('HAY_STOCK', False);
 //estas son las formas mas comunmente utilizadas. Solo se declaran en forma GLOBAL
const PRECIOS = 25.78;
const PRODUCTOS = 'Short de baño para niños';

print "Asignacion por referencia & <br>";
$nombre = "Jula";
//Asignacion por referencia
$otronombre = &$nombre;			//asignacion por referencia(direccion). Quedan las dos ligadas, cuando cambia una cambia la 								//otra
print "nombre $nombre  otronombre $otronombre<br>";
$nombre = "Julassss";
print "nombre $nombre  otronombre $otronombre<br>";
$otronombre = "Jula";
print "nombre $nombre  otronombre $otronombre<br>";
define('NOMBRE', $nombre);

print "<br>";

print "001 FORMATOS y PRINT<br>";
$numeros = array(5, 6 ,10, 20);
$palabras = array("palabra1", "palabra2", "palabra3");
$palabrasprop = array('primera'=>'palabra1', 'segunda'=>"palabra2", "tercera"=>"palabra3");

print "hola $nombre";
print "<p>hola $nombre con los < p >  </p>";			//con formato, renglon antes y despues
print "hola '$nombre' '$numeros[2]' '$palabras[0]' '$palabrasprop[primera]'<br>";
print "hola '". $nombre . "'   " . "'" .$numeros[2] . "' '" . $palabras[0] . "' '" . $palabrasprop["tercera"] . "'  concatenada con puntos<br>";
$numero = 5.98;
$booleano = true;
printf("salidas formateadas texto=%s entero=%05d flotante=%08.2f booleano=%d<br>", $nombre, $numero, PRECIO, !$booleano);
print "Las comillas dobles (\") deben escaparse, las simples (') no <br>";		//forma de incluir el caracter ""
print "<br>";


// NUMERICAS
print "002 NUMERICAS<br>";
$numero = 5.98;
print "esta es la variable numerica: $numero <br>";
print "var_dump --> ";
var_dump($numero);			//para conocer el tipo y valor de una variable, imprime el resultado
echo "<br><br>";

// STRINGS
print "003 STRINGS<br>";
$palabra = "una palabra";
print "esta es la palabra : $palabra <br>";
$palabra = "una palabra + $palabra";
echo "esta es la palabra concatenada : $palabra<br>";
$palabra = "{$palabra}sss+ una palabra";
echo "esta es la palabra concatenada sin espacios : $palabra<br>";
$palabra = "una palabra";
$palabra = "una palabra + " . $palabra . " + la la la";
echo "esta es la palabra concatenada con punto . : $palabra<br>";
print "var_dump --> ";
var_dump($palabra);
echo "<br>";
$producto = "un producto";
$detalles_del_producto = "(";
$detalles_del_producto .= $producto;	//otra forma de concatenar, menos optimizada. Usa otra direccion de memoria
$detalles_del_producto .= ") ";
print "$detalles_del_producto<br>";
print "Las comillas dobles (\") deben escaparse, las simples (') no";		//forma de incluir el caracter ""
echo "<br><br>";

//crear un string de gran tamanio
$documento = <<<NOTA_SOBRE_HEREDOC
Es muy importante señalar que la línea con el identificador de cierre no debe
contener ningún caracter, excepto posiblemente un punto y coma (;). Esto
significa en particular que el identificador no debe usar sangría, y que no
deben existir ningún espacio ni tabulación antes o después del punto y coma.
Es muy importante darse cuenta que el primer caracter antes del identificador
de cierre debe ser un salto de línea definida por el sistema operativo local.
En los sistemas UNIX sería \n, al igual que en Mac OS X. El delimitador de
cierre (posiblemente seguido de un punto y coma) también debe ser seguido de
un salto de línea.
Si se rompe esta regla y el identificador de cierre no está "limpio", no será
considerado como un identificador de cierre, y PHP continuará buscando uno.
Si no se encuentra ningún identificador de cierre antes del final del
fichero, se producirá un error de análisis en la última línea.
NOTA_SOBRE_HEREDOC;

$cadena = "Si se realiza el cálculo (15*2)+[(12+5)*(4.3+0.45)] obtendremos el importe en $";
//reemplazar cadenas de texto que deban insertarse en bases de datos, y hayan sido recibidas mediante HTTP POST.
addslashes($cadena); //reemplaza una cadena de texto añadiendo barras invertidas a las comilla simple ('), comilla doble ("), barra invertida (\) y NUL (el byte null)..
quotemeta($cadena);  //reemplaza una cadena de texto añadiendo barras invertidas a los siguientes caracteres: . \ + * ? [ ^ ] ( $ )
stripslashes($cadena);	//eliminar las barras invertidas de una cadena espada

htmlentities($cadena); //convierte los caracteres aplicables a entidades HTML
//Esta función debe utilizarse siempre que una cadena de texto deba ser impresa en un documento HTML y se
//desconozca su contenido, para prevenir que código fuente no deseado, sea ejecutado
htmlentities($cadena, ENT_QUOTES, "UTF-8"); //convierte tanto las comillas dobles "" como las simples ''
html_entity_decode($cadena);  //caso contrario a htmlentities($cadena)

htmlspecialchars($cadena);	//solo se deseen convertir a entidades HTML, caracteres especiales tales como & " < >
htmlspecialchars($cadena, ENT_QUOTES, "UTF-8"); //convierte tanto las comillas dobles "" como las simples ''
htmlspecialchars_decode($cadena);	//lo contrario a htmlspecialchars($cadena)

//La funcion htmlentities es mas completa que la htmlspecialchars

$caracteres_permitidos = "<br></p>";
strip_tags($cadena, $caracteres_permitidos); //eliminará todas las etiquetas PHP y HTML exceptuando aquellas que se indiquen como caracteres permitidos

ltrim($cadena); 	//Elimina los espacios en blanco del inicio de la cadena
rtrim($cadena); 	//los elimina del final de la cadena
trim($cadena); 		//los elimina del inicio y final de la cadena

$resultado = nl2br($cadena);	//convertir saltos de linea en su representación HTML (<br/>):

//wordwrap($cadena,$ancho, $salto_de_linea, $no_cortar_palabras).
wordwrap($cadena, 30, "\n", True);	//ajustar el ancho de caracteres de una cadena de texto

strtolower($cadena);		//todos los caracteres a minusculas
lcfirst($cadena);			//solo primer caracter a minuscula
strtoupper($cadena);		//todos los caracteres a mayusculas
ucfirst($cadena);			//solo primer caracter a mayuscula
ucwords($cadena);			//todas las palabras a mayuscula


setlocale(LC_MONETARY, "es_ES.UTF-8");
$formato = "%(#4n";
//$moneda = money_format($formato, $cadena);	//Dar a una cadena, formato de moneda

//$cadena = number_format($numero, $decimales, $separador_decimales, $separador_miles); //retorna el número formateado como cadena de texto


// BOOLEANOS
print "004 BOOLEANOS<br>";
$booleana = true;
echo "esta es la booleana : $booleana";
echo "<br>";
print "var_dump --> ";
var_dump($booleana);
echo "<br><br>";

// ARREGLOS
print "005 ARREGLOS<br>";
$colores = array('rojo','amarillo','azul');
$colores = ['rojo','amarillo','azul'];
print "esta es el arreglo : $colores[2] $colores[1] $colores[0]<br>";
print "esta es el arreglo : $colores[2] . " . $colores[1] . " " . $colores[0];
echo "<br>";
print "var_dump --> ";
var_dump($colores);
echo "<br>";
$colores[] = "verde";	//le agrego un elemento a un array
print_r($colores);
$retorno = array_key_exists(3, $colores);		//devuelve si el indice dado del arreglo está definido o no
printf ("<br>array_key_exists---> %b<br>", $retorno);
$parametros = array("primero",4.56,87);			//puedo combinar tipos de datos en un mismo arreglo
var_dump($parametros);
echo "<br><br>";

// arreglos con propiedades
print "006 ARREGLOS con propiedades (asociativo)<br>";
$colores = array('cero'=>'rojo','uno'=>'amarillo','dos'=>'azul');
$colores2 = ['cero'=>'rojo','uno'=>'amarillo','dos'=>'azul'];
$colores3 = [['cero'=>'rojo','uno'=>'amarillo','dos'=>'azul'], ['cero'=>'azul','uno'=>'rojo','dos'=>'amarillo']];	//arreglo multiple arreglo
print "esta es el arreglo con propiedad (asociativo): $colores[uno] $colores[cero] $colores[dos]<br>";
print "esta es el arreglo con propiedad (asociativo): $colores[uno] " . $colores['cero'] . " " . $colores["dos"];
echo "<br>";
print "colores = ";
print_r($colores);
echo "<br>";
print "colores2 = ";
print_r($colores2);
echo "<br>";
print "colores3 [0] = ";
print_r($colores3[0]);
echo "<br>";
print "colores3 [1] = ";
print_r($colores3[1]);
echo "<br>";
print "var_dump --> ";
var_dump($colores);
echo "<br>";
$colores["tres"] = "verde";	//le agrego un elemento a un array
print "print_r --> ";
print_r($colores);		//impresion completa del array
$retorno = array_key_exists("tres", $colores);		//devuelve si el indice dado del arreglo está definido o no
printf ("<br>array_key_exists de \"tres\" %s ---> %b", $colores["tres"], $retorno);

$colores = array_merge($colores, ['tres'=>'cyan','cuatro'=>'magenta']);
echo "<br>";
print "despues de array_merge --> ";
print_r($colores);				//para conocer el tipo y valor de una variable, imprime el resultado
echo "<br><br>";

// Variable/Arreglos OBJETO
print "007 ARREGLOS objeto <br>";
$colores = (object)["cero"=>"rojo","uno"=>"amarillo","dos"=>"azul"];
print "esta es el objeto : $colores->uno $colores->cero $colores->dos<br>";
print "esta es el objeto : $colores->uno " . $colores->cero . " " . $colores->dos;
echo "<br>";
print "var_dump --> ";
var_dump($colores);				//para conocer el tipo y valor de una variable, imprime el resultado
echo "<br><br>";



//VARIABLES / STRINGS
print "008 VARIAS<br>";
//$retorno = array_key_exists("tres", $colores);		//devuelve si el indice dado del arreglo está definido o no
$producto = "ni idea";
echo "esta es la variable : $producto <br>";
print "var_dump --> ";
var_dump($producto);			//para conocer el tipo y valor de una variable, imprime el resultado				
echo "<br>";
$tipo_a = gettype($producto);	//para conocer el tipo de una variable, sin necesidad de imprimirla
echo "tipo de variable --> ".$tipo_a;
echo "<br>";
print "print_r --> ";
print_r($producto);				//impresion completa del array
echo "<br>";
$producto = NULL;				//vaciar una variable
unset($producto);				//destruir una variable
echo "<br>";

$producto = "un producto";
echo "isset " . isset($producto);		#devuelve si el dato está definido o no. retorna TRUE
echo "<br>";
$producto = "";
echo "isset " . isset($producto);		#retorna TRUE
echo "<br>";
$producto = NULL;
echo "isset " . isset($producto);		#retorna FALSE
echo "<br>";
unset($producto);
echo "isset " . isset($producto);		#retorna FALSE
echo "<br>";

/*
¿NULL o unset()? ¿Cuál de los dos usar?
Cuando una variable ya no es necesaria, debe priorizarse el
uso de unset sobre NULL, ya que con unset(), se libera la
dirección de la memoria en la cual había sido escrita dicha
variable.
*/

//VALIDACIONES de datos
$valor = "2.56";
is_numeric($valor);		//devuelve true si es un numero o un string convertible a numero
is_int($valor);			//devuelve true SOLO se es un numero entero. NO string
is_float($valor); 		//devuelve true SOLO se es un numero flotante. No string

ctype_digit($valor);	//revisa cada caracter de la cadena verificando si es un digito entero positivo
ctype_alnum($valor);
ctype_alpha($valor);
//ctype_ hay un monton de variantes, verlas

filter_var($valor,FILTER_VALIDATE_INT);		//devuelve true si valida el dato
//FILTER_VALIDATE_INT entero 
//FILTER_VALIDATE_BOOLEAN booleano 
//FILTER_VALIDATE_FLOAT float 
//FILTER_VALIDATE_REGEXP expresión regular 
//FILTER_VALIDATE_DOMAIN dominio web 
//FILTER_VALIDATE_URL URL no internacionalizada 
//FILTER_VALIDATE_EMAIL dirección de correo 
//FILTER_VALIDATE_IP dirección IP 
//FILTER_VALIDATE_MAC dirección MAC física 

//Validacion de caracteres en un string
$texto = "Algun texto con caracteres. - ";
//entre corchetes agrego los caracteres que permito en el array. Solo 5,6 o 7 caracteres, probar!!!!! 
//'regex:/^[a-z0-9 .\-]+$/'     //esto es para la validation rules de Laravel
//'regex:/^[\pL\pN +-]+$/'
//'no_regex:/^[\pL\pN +-]+$/'   //impido esos caracteres
preg_match('/^[\pL\pN .-]+$/', $texto);
//\pL is any letter in any language, matches also Chinese, Hebrew, Arabic, ... characters.
//\pN any kind of numeric character (means also e.g. roman numerals)
//if you want to limit to digits, then use \pNd


$a = 15;
if ($a == 10) {
//	echo "\$a es igual a 10";
}
else if ($a == 12) {
//	echo "\$a es igual a 12";
}
else if ($a == 15) {
//	echo "\$a es igual a 15";
}
else {
//	echo "\$a NO es ni 10 ni 12 ni 15";
}

$texto = is_int($a) ? "es entero" : "no es entero";
print "$a ".$texto."<br>";

$parametros = array("primero",4.56,87);
printf ("el elemento %d es un float? %s<br>",1,is_float($parametros[1]) ? "SI" : "NO");

$variable = 2;
switch ($variable) {
	case "posible valor 1":
	case "posible valor 2":
	case "posible valor 3":
/* algoritmo a ejecutar si el valor de $variable es
posible valor 1, posible valor 2 o posible valor 3
*/
		break;
	case "posible valor 4":
/* algoritmo a ejecutar si el valor de $variable es
posible valor 4
*/
		break;
	default:
// algoritmo a ejecutar si valor no ha sido contemplado en
// ningúno de los «case» anteriores
}
print "<br>";


//FECHAS / HORAS
print "Funciones de Fecha/Hora<br>";
/*
En Windows, setlocale(LC_ALL, '') establece los nombres del localismo desde la configuración regional o del lenguaje del sistema (accesible por medio del Panel de Control)
*/
setlocale(LC_ALL,"");								 //Afecta a strftime(), localeconv(), strcoll(), strtoupper(), etc
date_default_timezone_set("America/Argentina/Buenos_Aires");		//esto va al inicio. Establece el Uso-Horario
print date_default_timezone_get() . "<br>";

//ni idea de esto
//setlocale(LC_ALL,"es_AR");
//setlocale(LC_TIME,"es_AR");
//setlocale(LC_ALL,"es_ES");
//setlocale(LC_TIME, "spanish");

$ultimo_acceso = time()-3600;
print "hora : ". date("H:i:s") . "   ultimo_acceso = " . date("H:i:s",$ultimo_acceso) . "<br>";
print "hora : ". strftime("%H:%M:%S") . "   ultimo_acceso = " . strftime("%H:%M:%S",$ultimo_acceso) . "<br>";
print "hora ultimo_acceso : ".strftime("Fecha española: %c", $ultimo_acceso)."<br>";
print "hora actual : ".strftime("Fecha española: %A, %#d de %B de %Y  %H:%M:%S %p   %T")."<br>";
$datos_fecha_hora = getdate();				//devuelve una matriz horaria completa
print_r($datos_fecha_hora);
checkdate(12, 25, 2011);		//valida una fecha y devuelve true o false. Formto M, D, A
time();							//obtiene la marca de tiempo actual
//mktime();						//OBSOLETA !!!!!! obtiene la marca de tiempo actual
//mktime($hora, $minuto, $segundo, $mes, $dia, $anio, $horario_verano);	// obtiene la marca de tiempo. utilizar 																				//horario_verano=0
print "<br>".date("d/m/Y H:i:s A")."<br>"; 		//date sin la marca de tiempo como parametro, utiliza time() (hora actual)
print "<br>";


//algunos manejos de direcciones http y funciones varias
print "Funciones de manejo de http y otras<br>";
$dominio = "http://{$_SERVER['SERVER_NAME']}";
$uri = "{$dominio}{$_SERVER['REQUEST_URI']}";
$ultimo_tramo = str_replace("{$dominio}/", NULL, $uri);
print "$dominio -- $uri -- $ultimo_tramo -- {$_SERVER['REQUEST_URI']}<br>";
$partes = explode("/", $ultimo_tramo);
print_r($partes);
print " tiene " . count($partes) . " elementos el arreglo \$partes<br>";
echo "<br><br>";



print "009 FORREACH<br>";
$nombres_propios = array('Ana', 'Julia', 'Luisa', 'Alberto', 'Cecilia',
'Carlos',);
foreach($nombres_propios as $nombre) {		//recorre el contenido del array y lo va devolviendo en la vble $nombre
//	echo $nombre . chr(10);
	echo $nombre;
	echo "<br>";
}
echo "<br>";

$datos_de_juan = array('Apellido' => 'Pérez',
	'Fecha de nacimiento' => '23-11-1970',
	'Teléfonos' => array('Casa' => '4310-9030',
	'Móvil' => '15 4017-2530',
	'Trabajo' => '4604-9000'),
	'Casado' => True,
	'Pasaporte' => False,
);
print_r($datos_de_juan);
echo "<br>";
foreach($datos_de_juan as $titulo => $dato) {		//recorre el contenido del array y devuelve clave y valor
//foreach($datos_de_juan as $titulo => &$dato) {	//si quiero modificar las datos del array
	if(!is_array($dato)) {
		if($dato === True) {
			$dato = 'SI';				
		}
		else if ($dato === False) {
			$dato = 'NO';				
		}
		echo "{$titulo}: {$dato}";
		echo "<br>";
	}
	else {
		foreach($dato as $tipo_telefono => $numero) {
			echo "Teléfono {$tipo_telefono}: {$numero}";
			echo "<br>";
		}
	}
}
print_r($datos_de_juan);
echo "<br>";

$nombres = array('Ana', 'Julia', 'Luisa', 'Alberto', 'Cecilia', 'Carlos',);
foreach($nombres as &$nombre) {		//paso la direccion de cada valor para poder modificarlo
	$nombre = strtoupper($nombre);
}
print_r($nombres);
echo "<br><br>";

$years = array();
$year = 1990;
while ($year <= 2000) {
	$years[] = $year;
	$year++;
}
//print_r($years);
$years = array();
$year = 1990;
do {
	$years[] = $year;
	$year++;
} while ($year < 1990);

for ($i = 0; $i <= 3; $i++) {
//	echo $i . chr(10);
//	echo "<br>";
}

// FUNCIONES
/*
$funcion = "ni idea";
call_user_func($funcion);		//llama a la funcion con el nombre del valor de la vble $function
call_user_func($funcion, $param1, $param2);		//llama a la funcion $function pasandole 2 parametros
call_user_func_array($funcion, $parametros);	//llama a la funcion con parametros en el arreglo $parametros
$cantidad_de_argumentos = func_num_args();			//devuelva la cantidad de argumentos pasados a foo
$argumentos = func_get_args();						//devuelve el arreglo de argumentos pasados a la funcion
$argumento1 = func_get_args(0);						//devuelve el argumentos 1 (indice 0) pasado a la funcion
is_callable($funcion);							//saber si una funcion existe y es llamable
function_exists($funcion);		 			//saber si una funcion existe, no se sabe si el llamable
*/
print "010 FUNCIONES<br>";

function nombre_de_la_funcion($parametro1, $parametro2) {
// algoritmo
}
function otra_funcion() {
// algoritmo
}

nombre_de_la_funcion("hola", 2);			// llamada a una funcion

// Función que hará la llamada de retorno
function llamar_a_otra($funcion) {
	echo call_user_func($funcion);		//llama a la funcion con el nombre del valor de la vble $function
	echo call_user_func($funcion, $parametro1, $parametro2);	//llama a la funcion con parametros
	$parametros = array("primero",4.56,87);
	echo call_user_func_array($funcion, $parametros);	//llama a la funcion con parametros en el arreglo $parametros
// continuación del algoritmo
}

function foo() {
	$cantidad_de_argumentos = func_num_args();		//devuelva la cantidad de argumentos pasados a la funcion
	echo "Recibimos $cantidad_de_argumentos argumentos  ----->>> ";
	$argumentos = func_get_args();					//devuelve el arreglo de argumentos pasados a la funcion
	print_r($argumentos);
	if($cantidad_de_argumentos > 0) {
		$argumento0 = func_get_arg(0);		//devuelve un argumento dado
		$argumento00 = $argumentos[0];		//es lo mismo que el paso anterior. Soon dos formas
		print "<br>argumentos[0] = '$argumento0' o = '$argumento00'";
	}
}
foo('argumento1', 'otro_argumento');

$funcion = "nombredefuncion";
if(is_callable($funcion)) {			//saber si una funcion existe y es llamable
	call_user_func($funcion);
}
if(function_exists($funcion)) {			//saber si una funcion existe, no se sabe si el llamable
	call_user_func($funcion);
}
print "<br>";

//modificacion de variables pasadas como argumentos a funciones. Pasaje por Referencia (direccion)
// definimos una variable de ámbito global
$mi_variable_global = 10;
print "Pasaje de argumentos como referencia para modificar<br>";
print "mi_variable_global = $mi_variable_global<br>"; // salida: 10
// definimos una función que modificará la variable global
function modificar_variable_global1(&$variable, $otro_parametro) {		//la paso con el & delante
	$variable *= $otro_parametro;
}
// llamamos a la función pasando como referencia la variable global
modificar_variable_global1($mi_variable_global, 2);
// imprimimos la variable global
print "mi_variable_global = $mi_variable_global"; // salida: 20

echo "<br><br>";


//ARCHIVOS Y CARPETAS
/*
incluir archivos locales. Solo Read
include("archivo.php");
include_once("archivo.txt");
require("archivo.html");
require_once("archivo.htm");

incluir archivos remotos. Solo Read
include("http://www.miweb.com/archivo.php?foo=bar");
include_once("http://www.miweb.com/archivo.php");
require("http://www.miweb.com/archivo.html");
require_once("http://www.miweb.com/archivo.txt");

include() intenta importar al archivo indicado y en caso de no
poder hacerlo, arroja un error y continúa ejecutando el resto
del script.
Sin embargo, la función require(), cuando no logra importar el
archivo indicado, arroja un error y finaliza sin permitir que el
resto del script continúe ejecutándose
Include y require "_once"
La única diferencia que existe entre include e include_once y
require y require_once, es que si el archivo indicado con
"_once" ya ha sido incluido no volverá a importarse

$contenido = file_get_contents("http://miweb.com/mi_fichero.php?foo=15"); //devuelve el contenido foo=15 del archivo
fopen($archivo, $modo[, $include_path]);  //los [] indican parametro opcional. Abre archivo para R+W
$cursor = fopen('archivo.txt', 'r');
fclose($cursor);
$file = fopen('file.txt', 'r', TRUE); // El tercer parámetro (opcional), permite indicar si se desea buscar el 											//archivo en el include_path seteado en el archivo php.ini.
$archivo = "archivo.txt"; // nombre del archivo
$bytes = filesize($archivo); // tamaño del archivo
$cursor = fopen($archivo, "r"); // abrir archivo
$contenido = fread($cursor, $bytes); // leer contenido
fclose($cursor); // cerrar el cursor (liberar memoria)

$archivo = "archivo.txt";
$recurso = fopen($archivo, "a+");
$nuevo_contenido = "nuevo contenido";
fwrite($recurso, $nuevo_contenido);
$bytes = filesize($archivo);
$contenido = fread($recurso, $bytes);
fclose($recurso);

ftell($recurso)					//obtener la posición actual del puntero
fseek($recurso, $byte)			//movernos hacia el byte indicado

$recurso = opendir('/var/www/dominio.com/public_html/archivos/pdf');	//abrir un directorio
$recurso = opendir('../archivos/pdf');
$otro_recurso = opendir('archivos/pdf');
closedir($recurso);
readdir($recurso)		//leer de a una linea del directorio (archivo o carpeta). Debe ejecutarse recursivamente
while(($elemento = readdir($dir)) !== False)
is_dir($elemento)
is_file($elemento)
is_link($elemento)
filetype($elemento)		//retorna fifo, char, dir, block, link, file, socket y unknown.
file_exists('archivo_o_directorio')		//comprobar existencia
is_readable('archivo_o_directorio')		//comprobar si el legible
is_writable('archivo_o_directorio')		//comprobar si es escribible
*/


print "011 CODIGO HTML<br>";
$alicuota_iva = 21;
$codigo_de_producto = 1284;
$nombre_producto = "Agua Mineral Manantial x 500 ml";
$precio_bruto = 3.75;
$iva = 3.75 * 21 / 100;
$precio_neto = $precio_bruto + $iva;

//cierro la etiqueta de php
?>

/*INICIO insercion de codigo HTML con incrustaciones PHP*/
<!doctype html>
<html>
	<head>
		<title>Detalles del producto <?php echo $nombre_producto; ?></title>
	</head>
	<body>
		<p>
			<b>Producto:</b> (<?php echo $codigo_de_producto; ?>)
				<?php echo $nombre_producto; ?><br/>
			<b>Precio:</b> USD <?php echo $precio_neto; ?>.- (IVA incluido)
		</p>
	</body>
</html>
/*FIN insercion de codigo HTML*/
<br><br>
<!-- <br><br> -->

<?php
//vuelvo a abrir la etiqueta de php


print "013 WEB-SERVICES<br>";
//WEB-SERVICES
/*Un servicio web es un programa disponible en Internet y que mediante HTTP puede recibir peticiones y entregar información.

Podemos entender un servicio web como una biblioteca de funciones remota. De la misma manera que un programa que quiere realizar una tarea hace uso de una función de una biblioteca, un programa puede recurrir a un servicio web que le proporciona el resultado de una tarea.

El retorno de datos de webservice es mediante las instrucciones print, haciendo que formen una cadena, delimitada
por [] y separadas por ,
*/
?>

<!-- ejemplo de un programa web-service.  Devuelve n numeros random entre min y max--> 
<?php
/*
# webservice.php
$minimo = $_REQUEST["min"];
$maximo = $_REQUEST["max"];
$valores = $_REQUEST["n"];

//armado del arreglo a devolver
print "[";
for ($i = 0; $i < $valores - 1; $i++) {
    print rand($minimo, $maximo) . ", ";
}
print rand($minimo, $maximo);
print "]";
*/
?>

<?php
/*
$numero = file_get_contents("http://.../webservice.php");  //llamado a servicio con retorno de un valor (mediante un print).
*/
$minimo = 10;
$maximo = 20;
$cantidad = 5;
$consulta = http_build_query(["min" => $minimo, "max" => $maximo, "n" => $cantidad]); //argumentos a pasar al web service
print "http://.../webservice.php?$consulta <br>";
//$cadena = file_get_contents("http://.../webservice.php?$consulta");
//consulta o llamado, devuelve en $cadena el string(cadena) armado por el service
//para convertirlos a arreglo o matriz 
//$arreglo = json_decode($cadena);		//convierto un string en un arreglo, objeto o matriz. El string debe estar													//debidamente armado

print "<br>";


print "014 Ejemplos de json_decode() json_encode()<br>";
//ejemplo del uso de json_decode(). Convierte un string codificado en JSON a una variable de PHP.
//ejemplo del uso de json_encode(). Convierte una variable PHP en un string con la representación JSON.
$minimo = 1;
$maximo = 10;
$valores = 5;
//armado del arreglo a devolver
$texto = "[";							//PRESTAR ATENCION AL CORCHETE []. Arreglo comun
for ($i = 0; $i < $valores - 1; $i++) {
    $texto = $texto . rand($minimo, $maximo) . ", ";
}
$texto = $texto . rand($minimo, $maximo) . "]";
var_dump($texto);
$arreglo = json_decode($texto);
print "<br>Luego de json_decode = ";
var_dump($arreglo);
//print_r($arreglo);
$texto = json_encode($arreglo);
print "<br>Luego del json_encode = ";
var_dump($texto);
print "<br><br>";

$minimo = 1;
$maximo = 10;
$valores = 5;

//armado del arreglo a devolver
$texto = "{";							//PRESTAR ATENCION A LAS LLAVES {}. Debido a que es arreglo con 													//propiedades
/*
for ($i = 0; $i < $valores - 1; $i++) {
    $texto = $texto . "\"$i\"" . ": " . rand($minimo, $maximo) . ", ";
}
$texto = $texto . "\"$i\"" . ":" . rand($minimo, $maximo) . "}";
*/
for ($i = 0; $i < $valores - 1; $i++) {
    $texto = $texto . "\"indice$i\"" . ": " . rand($minimo, $maximo) . ", ";
}
$texto = $texto . "\"indice$i\"" . ": " . rand($minimo, $maximo) . "}";

var_dump($texto);
$arreglo = json_decode($texto);		//al ser un arreglo con propiedades, devuelve un object
$arregloAsoc = json_decode($texto,true);	//le indico con TRUE que devuelva un arreglo con propiedades (asociativo), no 												// arreglo de objetos
print "<br>Luego de json_decode = ";
var_dump($arreglo);
//print_r($arreglo);
$texto = json_encode($arreglo);
print "<br>Luego del json_encode = ";
var_dump($texto);
//le indico con TRUE que devuelva un arreglo con propiedade
print "<br>Luego de json_decode (con true - asociativo)= ";
var_dump($arregloAsoc);
$texto = json_encode($arregloAsoc);
print "<br>Luego del json_encode = ";
var_dump($texto);
print "<br><br>";

$u = "user";
$p = "zx";
print "codificacion md5($u, $p) = " . md5($u . $p);

print "<br><br>";


print "015 Tratamiento de ERRORES<br>";
/*
CONSTANTE 	DESCRIPCIÓN 	Interrumpe el Script?
E_ERROR Errores fatales en tiempo de ejecución. SI
E_WARNING Advertencias no fatales en tiempo de ejecución. NO
E_NOTICE Avisos en tiempo de ejecución, que indican que el script encontró algo que podría ser un error u ocurrir en el curso normal de un script. NO
E_STRICT Sugerencias de cambios al código para ampliar la compatibilidad con versiones posteriores de PHP. NO
E_DEPRECATED Avisos en tiempo de ejecución, sobre funciones obsoletas. NO
E_ALL Todos los anteriores (excepto E_STRIC, que recién es incluido en E_ALL, desde la versión 5.4 de PHP). SI
*/

//archivo a incluir en cada archivo del proyecto, para impedir mostrar lo errores en el modo PRODUCCION (no desarrollo)
//const PRODUCCION = True; // en entornos de producción, cambiar a True
const PRODUCCION = False; // en entornos de producción, cambiar a True
if(!PRODUCCION) {
	ini_set('error_reporting', E_ALL );				//All errors and warnings (includes E_STRICT as of PHP 5.4.0)
//	ini_set('error_reporting', E_ALL & ~E_NOTICE);	//(Show all errors, except for notices)
//	ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT);	//(Show all errors, except for notices and coding 																			//standards warnings.)
	ini_set('display_errors', '1');
	ini_set('track_errors', 'On');
} else {
	ini_set('display_errors', '0');
	ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_STRICT);	//Produccion
//	ini_set('error_reporting', E_COMPILE_ERROR | E_RECOVERABLE_ERROR | E_ERROR | E_CORE_ERROR);	//(Show only errors)
}
/*
 Common Values:
;   E_ALL (Show all errors, warnings and notices including coding standards.)
;   E_ALL & ~E_NOTICE  (Show all errors, except for notices)
;   E_ALL & ~E_NOTICE & ~E_STRICT  (Show all errors, except for notices and coding standards warnings.)
;   E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR  (Show only errors)
; Default Value: E_ALL
; Development Value: E_ALL
; Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT
*/

//El @ que antecede a la instruccion es para que no muestre el error en pantalla
$archivo = @fopen('archivo_que_no_existe.txt', 'r');
if(!$archivo) {
	echo 'Ha ocurrido un error en el sistema. Disculpe las molestias.';
}

print "<br><br>";


print "016 Programacion orientada a objetos<br>";

class Objeto {					//clase de un objeto
	public $color = "";
	public $tamanio = "grande";
	public $aspecto = "";
	public $antenas = array(); # será otro objeto. O sea contiene otro objeto. Falta definirlo cual es
	public $ojos = array(); # será otro objeto. O sea contiene otro objeto. Falta definirlo cual es
	public $pelos = array(); # será otro objeto. O sea contiene otro objeto. Falta definirlo cual es
	
	function flotar() { }	//metodo o funcion del objeto
}

$et = new Objeto();			//"instanciar una clase" o "crear un objeto"
print $et->color;			//vacio
print $et->tamanio;			
print $et->aspecto;			//vacio
$et->color = "rosa";
print "<br>et->color = " . $et->color;

# NuevoObjeto hereda de otra clase: Objeto  ademas agrega una propiedad/objeto (pie) y un metodo
class NuevoObjeto extends Objeto {
	public $flexibilidad = "";
	public $pie = array();		 # será otro objeto. O sea contiene otro objeto. Falta definirlo cual es

	function saltar() {				#metodo
		return parent::$aspecto;	//forma de invocar una propiedad o metodo del objeto padre
	}
}

//Para poder acceder a las propiedades del objeto, dentro de la clase, se utiliza la pseudo variable $this y lo mismo aplica paraacceder a los métodos
class A {
	public $foo = '';

	function bar() {
		$this->foo = 'Hola Mundo';
		$this->foobar();
	}
	function foobar() {
		print $this->foo;
	}
}

print "<br>";

class Antena {
	public $color = "";
	public $longitud = "";
}

$antena1 = new Antena();
$antena1->color = "gris";

class Ojo {
	const  CONSTANTE_COLOR_OJOS = "azules";
	public $color = "";
	public $tamanio = "";
}

$ojo1 = new Ojo();
$ojo1->color = "verdes";
$ojo2 = &$ojo1;

class Pelo {
	public $tipo = "";
	public $color = "";
}

$pelo1 = new Pelo();
$pelo1->tipo = "enrulado";
$pelo2 = &$pelo1;

/*
Declarar propiedades o métodos de clases como estáticos los hacen accesibles sin la necesidad de instanciar la clase. Una propiedad declarada como static no puede ser accedida con un objeto de clase instanciado (aunque un método estático sí lo puede hacer).
No se puede acceder a las propiedades estáticas a través del objeto utilizando el operador flecha (->).
Todo lo que es statico, luego de modificarse, queda modificado para todos los objetos de esa clase, los ya instanciados y los que se instancien en ele futuro. Tanto las vbles static, como los objetos static que se hayan creado 
*/
class Objeto1 {
	const  CONST_VALUE = 'Un valor constante';
	public static $estatica = 1;
	public $color = "";
	public $tamanio = "";
	public $aspecto = "";
	public $antenas = array(); # será otro objeto
	public $ojos = array(); # será otro objeto
	public static $ojos_estatica = array(); # será otro objeto. este sera static y se puede invocar con ::
	public $pelos = array(); # será otro objeto

	public function __construct(Antena $antena) {	//defino una construccion del array antenas[] con valores pasados 
		$this->antenas[] = $antena;					//como pararmetros en el momento de la creacion de la clase Objeto1
	}

	function set_ojo(Ojo $ojo) {				//Metodo para la creacion del objeto ojos[], del tipo Ojo
		$this->ojos[] = $ojo;					
	}

	static function set_ojo_estatica(Ojo $ojo) {	//idem anterior pero static. Se puede invocar tambien con ::
		self::$ojos_estatica[] = $ojo;				//dentro debo utilizar vbles static y el operador self no $this 
//		return parent::$aspecto;	//forma de invocar una propiedad o metodo del objeto padre, si lo tuviera
	}
}

//Luego instancio de la siguiente manera
$objeto1 = new Objeto1($antena1);			//instancio asignando el componente antenas[] del Objeto1, porque es un 													//__construct, le paso un objeto del tipo Antenas
$objeto1->color = "celeste";
print "El objeto1 es de color: '{$objeto1->color}'  pero la antena es de color : '{$objeto1->antenas[0]->color}'<br>";
//var_dump($objeto1);
//print "<br>";

$objeto1->color = "colorado";
$objeto1->set_ojo($ojo1);		//Agrego asociando/componiendo una propiedad/objeto mediante su metodo. Tiene que ser del 									//tipo Ojo
$objeto1->set_ojo($ojo2);		//puedo seguir agregando de la misma manera, 

$objeto1->set_ojo(new Ojo());	//otra forma, creando alli mismo el objeto componente

$cant_ojos = count($objeto1->ojos);		//cuento los elementos de un array, o sea la cantidad de ojos

$objeto1->pelos[] = $pelo1;		//Agrego asociando/componiendo una propiedad/objeto. Tiene que ser del tipo Pelo
$objeto1->pelos[] = $pelo2;		//puedo seguir agregando de la misma manera

print "El objeto1 es de color: '{$objeto1->color}' la antena es de color : '{$objeto1->antenas[0]->color}' pero los $cant_ojos ojos son '{$objeto1->ojos[0]->color}' y el pelo es '{$objeto1->pelos[1]->tipo}'<br>";
//var_dump($objeto1);
print "<br>";

/*
El Operador de Resolución de Ámbito (::) o en términos simples, el doble dos-puntos, es un token que permite acceder a elementos estáticos, constantes, y sobrescribir propiedades o métodos de una clase.
*/
$texto_obj1 = "Objeto1";					//utilzo solo un string con el nombre, no un objeto de la clase
print Objeto1::$estatica."  ".$texto_obj1::$estatica."<br>";	//puedo invocar solo con la clase, o con el string
print Objeto1::CONST_VALUE."  ".$texto_obj1::CONST_VALUE."<br>";	//para las constantes es lo mismo
Objeto1::$estatica = 2;
$texto_obj1::$estatica = 3;

//Los objeto o metodos declarados como static los puedo invocar solo con el nombre de la clase, sin un objeto instanciado, al ser estatico todo lo que se modifica se modifica para todos los objetos de esa clase, los ya instanciados y los que se instancien en el futuro.
$texto_obj1::set_ojo_estatica(new Ojo());	//la funcion esta definida como static. La puedo invocar con ::
$texto_obj1::set_ojo_estatica(new Ojo());	//la funcion esta definida como static. La puedo invocar con ::

$obj1 = new Objeto1($antena1);
$obj1->set_ojo_estatica(new Ojo());	//a una funcion static tambien la puedo invocar de manera convencional con ->
print_r($obj1::$ojos_estatica);
print "<br>";

$obj2 = new Objeto1($antena1);			//objeto nuevo con los cambios ya heredados
print_r($obj2::$ojos_estatica);
print "<br>";
print_r($objeto1::$ojos_estatica);
?>

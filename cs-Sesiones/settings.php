<?php
//setlocale(LC_ALL,"es_AR");
//setlocale(LC_TIME,"es_AR");
date_default_timezone_set("America/Argentina/Buenos_Aires");
# Dejaremos ya iniciada una sesión
session_start();
# aquí copiaremos nuestro hash MD5 obtenido con PHP-CLI. Usuario user passwd zx
const HASH_ACCESO = "76652edecf9b5e787a4e0fcc373a9371";
# formulario.html será el que pida el ingreso de user y pass al usuario
const PAGINA_LOGIN = "formulario.html";
# esta será una página cualquiera, con acceso restringido, a la cual
# redirigir al usuario después de iniciar su sesión en el sistema
const PAGINA_RESTRINGIDA_POR_DEFECTO = "pagina_de_muestra.php";
?>
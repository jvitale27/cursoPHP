<?php


/*restringida de nuestro sistema, la cual deberá invocar a la
función validar_sesion(). Es decir, en esta página (así como
en cualquier otra página restringida), colocaremos todo el
contenido de acceso privado, ya sea puramente PHP, como
HTML, una mezcla de ambos o mejor aún, código PHP que
invoque y renderize el HTML.
Todo, absolutamente todo el contenido
de estas páginas restringidas, solo será
visible al usuario si tiene la sesión
iniciada y activa. De lo contrario, el
contenido estará seguro y no será
mostrado a usuarios sin sesión iniciada
o con sesión inactiva.*/

require_once("funciones.php");
validar_sesion();
?>

<!-- contenido de ejemplo -->
<b>Bienvenido usuario registrado!</b> (<a href="salir.php">Desconectarse</a>)

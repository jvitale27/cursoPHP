<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

cabecera("Borrar todo 1", MENU_VOLVER);

/* CREACON DEL FORMULARIO CON PHP
print "    <form action=\"borrar-todo-2.php\" method=\"" . FORM_METHOD . "\">\n";
print "      <p>¿Está seguro?</p>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" value=\"Sí\" name=\"si\">\n";
print "        <input type=\"submit\" value=\"No\" name=\"no\">\n";
print "      </p>\n";
print "    </form>\n";

*/
?>
<!-- CREACION DEL FORMULARIO CON HTML e incrustaciones PHP -->
    <form action="borrar-todo-2.php" method="<?php print FORM_METHOD ?>">
		<p>¿Está seguro?</p>
		<p>
			<input type="submit" value="Sí" name="si">
			<input type="submit" value="No" name="no">
		</p>
	</form>

<?php

pie();

?>
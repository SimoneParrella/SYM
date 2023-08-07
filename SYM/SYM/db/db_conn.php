<?php

$conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=biar");

if (!$conn) {
	echo "Connection failed!";
}

?>

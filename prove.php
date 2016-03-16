<?php

mysql_connect("localhost", "root", "1404") or
    die("Connessione non riuscita: " . mysql_error());
mysql_select_db("PasteGo");


$risultato = mysql_query("SELECT Codice FROM file");
/*
while ($riga = mysql_fetch_array($risultato, MYSQL_ASSOC)) {
   printf ("ID: %s  Nome: %s", $riga["Codice"]);
  $stringatest=$riga['Codice'];
}
mysql_free_result($risultato);
*/

$row= mysql_fetch_row($risultato);
echo $row[0];
echo $row[1];

?>
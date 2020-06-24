<?php

  $DB_hostname = "localhost";
  $DB_name     = "u2489990_tahfidzh";
  $DB_username = "u2489990_tahfidz";
  $DB_password = "tahfidz2017?";

  $connection = mysql_connect($DB_hostname, $DB_username, $DB_password) or die(mysql_error());
  mysql_select_db($DB_name, $connection) or die(mysql_error());

  $delete_query = "DELETE  b
          FROM users b
          LEFT JOIN pendaftaran as p
          ON b.psbId = p.daftarId
          WHERE NOT EXISTS (SELECT * FROM prestudent WHERE b.id = prestudent.userId)
          AND b.status = 'A'
          AND b.priviledge = 3
          AND b.idChild ='1' 
          AND p.periodId ='2'";

  $result = mysql_query($delete_query) or die(mysql_error());

?>
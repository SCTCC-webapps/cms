<?php
require 'db-connect.php';
echo "Yay! I exist!";
try{
  $db = connect();
  foreach($db->query('SELECT * FROM cms_contact') as $row){
    print_r($row);
  }
  $db = null;
}catch(PDOException $e) {
  echo "Error!: ".$e->getMessage()."<br/>";
  die();
}
?>

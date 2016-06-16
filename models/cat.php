<?php
require 'db-connect.php';
function list_all_categories(){
  $sql = "SELECT * FROM  sctcc_cms.cms_cat;";
  try{
    $db = connect();
    $query = $db->prepare($sql);
    $result_set = $query->execute([]);
    $data = array();
    while($row = $query->fetch()){
        $data[$row['cat_id']] = $row['cat_desc'];
    }
    return $data;
  }catch(PDOException $e){
    log_or_echo(false, $e);
  }
};

?>

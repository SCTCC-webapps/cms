<?php
//`cat.php` was originally intended to be a function file for categories.
// You should be able to delete this file and have everything work just fine, as nothing requires it.
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

echo "<pre style='display:block; background-color:#ccffff; border:5px solid blue;'>";
//get_contacts_id_search();
print_r(get_contacts_search());
echo "</pre>";
//testbed: Rewriting functions to get, group and display data.


?>

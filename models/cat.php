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

// echo "<pre>";
// print_r(get_contacts_with_categories_no_search());
// echo "</pre>";
//testbed: Rewriting functions to get, group and display data.

/*
 * TODO: Write a function with repeated calls to get_contact_with_categories_by_id()
 * that will return all the relevant results grouped and in order.
 */
 function get_contact_id_search($show_deleted = 0, $search = null, $search_by = null, $category = null, $limit = 50, $offset = 0){
   //Reference: http://stackoverflow.com/questions/10015364/pagination-sql-query-syntax
   //Use MySQL Keywords LIMIT & OFFSET to pageinate a query.
 }
function get_contacts_with_categories($show_deleted = 0, $search = null, $search_by= null, $category = null){
  //define the query
  $sql = 'SELECT
                cms_contact.cms_id,
                cms_contact.first_name,
                cms_contact.last_name,
                cms_contact.phone_number,
                cms_contact.email_address,
                cms_contact.street_address,
                cms_contact.city,
                cms_contact.state,
                cms_contact.zip,
                cms_contact.company,
                cms_cat.cat_desc,
                cms_contact_categories.cms_cat_id
              FROM cms_contact
              INNER JOIN cms_contact_categories
              ON cms_contact.cms_id = cms_contact_categories.cms_id
              INNER JOIN cms_cat
              ON cms_cat.cat_id = cms_contact_categories.cat_id';
  $where = " WHERE soft_delete = $show_deleted";
  $order_by = " ORDER BY cms_contact.last_name, cms_contact.first_name";
  if(isset($search)){
    if($search_by == 'name'){
      $where .= "&& (first_name LIKE '%$search%' || last_name LIKE '%$search%')";
    }elseif($search_by == 'company'){
      $where .= "&& company LIKE '%$search%'";
    }else{
      $where .= "&& (first_name LIKE '%$search%' || last_name LIKE '%$search%')";
    }
  }
  if(isset($category)){
    $where .= "&& cms_cat.cat_id = $category";
  }
  try{
    $db = connect();
    $query;
    if(isset($show_deleted)){
      $query = $db->prepare($sql.$where.$order_by);
    }else{
      $query = $db->prepare($sql.$order_by);
    }

    $result_set = $query->execute([]);
    $data = group_data($query);
    $db = null;
    return $data;
  }catch(PDOException $e) {
    log_or_echo(false, $e.getMessage());
  }
}
/**
  * This function gets one contact from the database,
  * and then passes it to the data grouper,
  * before returning the results
  * in an associtive array.
  *
  * @param $id the id of the contact
  * @return $data associtiive array of the contacts with subarry for categories
  */
function get_contact_with_categories_by_id($id){
  //define the query
  $sql = 'SELECT
                cms_contact.cms_id,
                cms_contact.first_name,
                cms_contact.last_name,
                cms_contact.phone_number,
                cms_contact.email_address,
                cms_contact.street_address,
                cms_contact.city,
                cms_contact.state,
                cms_contact.zip,
                cms_contact.company,
                cms_cat.cat_desc,
                cms_contact_categories.cms_cat_id
              FROM cms_contact
              INNER JOIN cms_contact_categories
              ON cms_contact.cms_id = cms_contact_categories.cms_id
              INNER JOIN cms_cat
              ON cms_cat.cat_id = cms_contact_categories.cat_id
              WHERE cms_contact.cms_id = :cms_id
              ORDER BY cms_contact.last_name, cms_contact.first_name';
  try{
    $db = connect();
    $query = $db->prepare($sql);
    $result_set = $query->execute(["cms_id" => $id]);
    //return "<pre>".print_r($raw_data, true)."</pre>";

    $data = group_data($query);
    $db = null;
    return $data;
  }catch(PDOException $e) {
    log_or_echo(false, $e.getMessage());
  }
}
/**
  * This function groups data from the contacts table into an array.
  * Each record has it's associated categories in a sub-array.
  *
  * @param PDOStatement $query A PDO object that contains a query.
  * @return array $data An array of contacts with categories grouped.
  */
function group_data(PDOStatement $query){
  $raw_data;
  $i = 0;
  while($row = $query->fetch()){
    $raw_data[$i++] = $row;
  }
  $lastId;
  $first_iteration = true;
  $data;
  $categories;
  for($i = 0; $i < count($raw_data); $i++){
    //echo "For: $i<br/>";
    if($first_iteration){
      $last_id = $row['cms_id'];
      $first_iteration = false;
    }
    $row = $raw_data[$i];
    $current_id = $row['cms_id'];
    //start preparing new row
    if($last_id == $row['cms_id']){
      //add the data to the categories
      $cms_cat_id = $row['cms_cat_id'];
      $categories["$cms_cat_id"] = $row['cat_desc'];
      //add the latest catgory array to the main array, overwriting the data.
      $data[$last_id]['cat_array'] = $categories;
      //$data_row = $data[$last_id];
      //$data_row["cat_array"] = $categories;
    }else{
      //Change the tracked id because we are beginning a new record.
      $last_id = $row['cms_id'];
      $categories = array();
      $cms_cat_id = $row['cms_cat_id'];
      $categories["$cms_cat_id"] = $row['cat_desc'];
      //add the data because we are beginnning a new record.
      $data["$last_id"] = array(
        'id' => $row['cms_id'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'phone_number' => $row['phone_number'],
        'email_address'=> $row['email_address'],
        'street_address'=> $row['street_address'],
        'city' => $row['city'],
        'state' => $row['state'],
        'zip' => $row['zip'],
        'company' => $row['company'],
        'cat_array'=> $categories
      );
    }
  }
  return $data;
}

?>

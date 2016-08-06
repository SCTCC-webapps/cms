<?php
/**
  * `contacts_cat.php` is a file that processes common queries pertaining
  * to the retrival of contact data with asssociated categories.
  * It's included frequently and uses an array of values to handle associated data.
  *
  * The data array takes the following format (example from `print_r()`):
  *
  *   Array
  *   (
  *     [66] => Array
  *         (
  *             [id] => 66
  *              [first_name] => Hilel
  *              [last_name] => Acevedo
  *              [phone_number] => 1-449-414-1875
  *              [email_address] => Hilel.Acevedo@anteipsumlimited.com
  *              [street_address] => Ap #860-176 Dignissim. Road
  *              [city] => Charlottetown
  *              [state] => PE
  *              [zip] => C0W 2Z2
  *              [company] => Ante Ipsum Limited
  *              [cat_array] => Array
  *                  (
  *                      [66] => Aerospace
  *                      [166] => Motorcycle
  *                  )
  *
  *          )
  *
  *      [29] => Array
  *          (
  *              [id] => 29
  *              [first_name] => Alfonso
  *              [last_name] => Alvarado
  *              [phone_number] => 814-1552
  *              [email_address] => Alfonso.Alvarado@orcilacusllc.com
  *              [street_address] => P.O. Box 934, 9404 Orci. Rd.
  *              [city] => Fairbanks
  *              [state] => Alaska
  *              [zip] => 99712
  *              [company] => Orci Lacus LLC
  *              [cat_array] => Array
  *                  (
  *                      [129] => Information Technology
  *                      [29] => Police
  *                  )
  *
  *          )
  *    )
  */


/**
  * Requires the database connector.
  */
require 'db-connect.php';
//These are debug statements that can be enabled to check output.
//echo "<pre>";
//print_r(get_contacts_search());
//echo "</pre>";
/**
  * This function replaces `get_contacts_with_categories()`` and uses a proper
  * SQL grouping function `get_contact_categories()`.
  *
  * It searchs contact records in the database,
  * and returns a list of matching results,
  * with all associated data.
  *
  * If search parameters are not set,
  * then the function will return
  * all records not soft-deleted.
  * @param Point to start records for pagination.
  * @param Point to end records for pagination.
  * @param $search String to look for in the database.
  * @param $search_by Tells the function to look by contact or company name.
  *        Valid values are 'name' or 'company'. Function behavior defaults to
  *        searching by name if not set.
  * @param $category The category to search for contacts in.
  *        Search ignores category if not set.
  * that will return all the relevant results grouped and in order.
  * @return $data The array of contacts that match search criteria.
  */

 function get_contacts_search($limit = 50, $offset = 0, $search = null, $search_by = null, $category = null, $show_deleted = 0){
   //Reference: http://stackoverflow.com/questions/10015364/pagination-sql-query-syntax
   //Use MySQL Keywords LIMIT & OFFSET to pageinate a query.
   $sql = 'SELECT
                cms_contact.cms_id
                FROM cms_contact';
//                INNER JOIN cms_contact_categories
//                ON cms_contact.cms_id = cms_contact_categories.cms_id';
  $where = " WHERE cms_contact.soft_delete = $show_deleted";
  $order_by = " ORDER BY cms_contact.last_name, cms_contact.first_name LIMIT $limit OFFSET $offset";
  //$limit_offset = ' LIMIT :limit OFFSET :offset';
  $parameters = array();
  //$parameters['limit'] = $limit;
  //$parameters['offset'] = $offset;
  //$parameters['show_deleted'] = $show_deleted;

  if(isset($search)){
    if($search_by == 'name'){
      $where .= " && (first_name LIKE :f_search || last_name LIKE :l_search)";
      $parameters['f_search' ] = '%'.$search.'%';
      $parameters['l_search'] = '%'.$search.'%';
    }elseif($search_by == 'company'){
      $where .= " && company LIKE :c_search";
      $parameters['c_search' ] =  '%'.$search.'%';
    }else{
      $where .= " && (first_name LIKE :f_search || last_name LIKE :l_search)";
      $parameters['f_search' ] = '%'.$search.'%';
      $parameters['l_search'] =  '%'.$search.'%';
    }
  }
  $cat_filter_sql = 'SELECT cms_id, cat_id FROM sctcc_cms.cms_contact_categories WHERE cms_id = :cms_id && cat_id = :cat_id ';
  if(isset($category) && $category != 'no-cat'){

    $where .= " && cms_contact_categories.cat_id = :category";
    $parameters['category'] = $category;
  }
  echo "<div class='greenmessage'>". $sql.$where.$order_by ."</div>";
  $data;
  $duplicates;
  try{
    $db = connect();
    $query = $db->prepare($sql.$where.$order_by);
    print_r($parameters);
    //echo "<div class='greenmessage'><pre>".print_r($parameters)."</pre></div>";
    $result_set = $query->execute($parameters);
    for($i = 0; $row = $query->fetch(); $i++){
      //echo "CMS ID: {$row['cms_id']}\n";
      $data[$i] = get_contact_categories($row['cms_id']);
      //current(get_contact_with_categories_by_id($row['cms_id']));
      // echo "<pre style='display:block; background-color:#ccffff; border:5px solid blue;'>";
      // print_r(get_contact_with_categories_by_id($row['cms_id']));
      // echo "</pre>";
      // echo "</br>End Contact #{$row['cms_id']}</br>";
    }
    $db = null;
  }catch(PDOException $e){
    log_or_echo($e);
  }
  $data = array_unique($data, SORT_REGULAR);
  return $data;
  }
  function test_cat($cat_id, $cms_id){
    $cc = connect();
    $cat_check = $cc->prepare($cat_filter_sql);
      if(isset($category) && $category != 'no-cat'){
        $cat_check->execute(['cms_id' => $cms_id, 'cat_id' => $category]);
      }
      return $cat_check->rowCount();

  }
/**
  * This function gets one contact from the database,
  * and then returns it in array format.
  *
  * Replaces 'get_contact_with_categories_by_id()'.
  *
  * @param $id the id of the contact
  * @return $data associtiive array of the contacts with subarry for categories
  */
function get_contact_categories($id){
  //echo "$id</br>";
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
                cms_contact.company
              FROM cms_contact
              WHERE cms_contact.cms_id = :cms_id
              ORDER BY cms_contact.last_name, cms_contact.first_name';
  $cat_sql = 'SELECT
                    cms_contact_categories.cms_id,
                    cms_contact_categories.cms_cat_id,
                    cms_cat.cat_id,
                    cms_cat.cat_desc
                  FROM cms_contact_categories
                  INNER JOIN cms_cat
                  ON cms_contact_categories.cat_id = cms_cat.cat_id
                  WHERE cms_contact_categories.cms_id = :id';
  try{
    $db = connect();
    $query = $db->prepare($sql);
    $result_set = $query->execute(["cms_id" => $id]);
    //return "<pre>".print_r($raw_data, true)."</pre>";
    $contact = $query->fetch();
    $data = ['id' => $contact['cms_id'],
            'first_name' => $contact['first_name'],
            'last_name' => $contact['last_name'],
            'phone_number' => $contact['phone_number'],
            'email_address' => $contact['email_address'],
            'street_address' => $contact['street_address'],
            'city' => $contact['city'],
            'state' => $contact['state'],
            'zip' =>$contact['zip'],
            'company' =>$contact['company']];
    $cat_array = array();
    $query = $db->prepare($cat_sql);
    $query->execute(['id'=>$id]);
    for($i = 0; $row = $query->fetch();$i++){
      $cms_cat_id = $row['cms_cat_id'];
      $cat_array[$cms_cat_id] = $row['cat_desc'];
    }
    $data['cat_array'] = $cat_array;
    // echo "<pre style='display:block; background-color:#ccffff; border:5px solid blue;'>";
    // print_r($data);
    // echo "</pre>";
    // //echo "</br>End Contact #{$row['cms_id']}</br>";
    $db = null;
    return $data;
  }catch(PDOException $e) {
    log_or_echo(false, $e.getMessage());
  }
}
/**
  * This function returns an array listing all the categories in the database.
  */
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

/**
  *This function outputs a table from the results of a contacts query with grouped data.
  * Some fields have been hidden so the table is not too wide.
  * @param array $data A grouped array of data from the query.
  */
function table_display(array $data){
  // echo "<pre>";
  // print_r(get_contacts_with_categories_no_search());
  // echo "</pre>";
  echo "<table>";
  echo "<tr>".
          "<th>Name</th>".
          "<th>Email</th>".
          "<th>Company</th>".
          "<th>Categories</th>".
          "</tr>";
  foreach($data as $row){
    echo "<tr id='{$row['id']}'>";
    echo "<td>{$row['first_name']} {$row['last_name']}</td>";
    echo "<td><a href='mailto:{$row['email_address']}'/>{$row['email_address']}</a></td>";
    echo "<td>{$row['company']}</td>";
    echo "<td><ul>";
    foreach($row['cat_array'] as $cat){
      if(!empty($cat)){
        echo "<li>$cat</li>";
      }
    }
    echo "</ul></td>";
    echo "<td>";
    $actions = array('view'); //, 'update', 'delete');
      foreach($actions as $action){
        $action_button = ucfirst($action);// `ucfirst()` capitalizes the first letter in a string.
        echo "<form action='contact.php' method='POST' name='{$row['id']}_$action'>";
        echo "<input type='hidden' name='action' value='$action'/>";
        echo "<input type='hidden' name='id' value='{$row['id']}'/>";
        echo "<input type='submit' name='submit' value='$action_button' class='sctcc-button'/>";
        echo "</form>";
      }
    echo "</td>";
    echo "</tr>";
  }
  echo "</table>";

}
/**
  *This function outputs a table from the results of a contacts query with grouped data.
  *It doesn't hide any feilds.
  *
  * @param array $data A grouped array of data from the query.
  */
function table_display_full(array $data){
  // echo "<pre>";
  // print_r(get_contacts_with_categories_no_search());
  // echo "</pre>";
  echo "<table>";
  echo "<tr>".
          "<th>First Name</th>".
          "<th>Last Name</th>".
          "<th>Phone Number</th>".
          "<th>Email</th>".
          "<th>Street Address</th>".
          "<th>City</th>".
          "<th>State</th>".
          "<th>Company</th>".
          "<th>Categories</th>".
        "</tr>";
  foreach($data as $row){
    echo "<tr id='{$row['id']}'>";
    echo "<td>{$row['first_name']}</td>";
    echo "<td>{$row['last_name']}</td>";
    echo "<td>{$row['phone_number']}</td>";
    echo "<td>{$row['email_address']}</td>";
    echo "<td>{$row['street_address']}</td>";
    echo "<td>{$row['city']}</td>";
    echo "<td>{$row['state']}</td>";
    echo "<td>{$row['company']}</td>";
    echo "<td><ul>";
    foreach($row['cat_array'] as $cat){
      if(!empty($cat)){
        echo "<li>$cat</li>";
      }
    }
    echo "</ul></td>";
    echo "<td>";
    $actions = array('view'); //, 'update', 'delete');
      foreach($actions as $action){
        $action_button = ucfirst($action);// `ucfirst()` capitalizes the first letter in a string.
        echo "<form action='contact.php' method='POST' name='{$row['id']}_$action'>";
        echo "<input type='hidden' name='action' value='$action'/>";
        echo "<input type='hidden' name='id' value='{$row['id']}'/>";
        echo "<input type='submit' name='submit' value='$action_button'/>";
        echo "</form>";
      }
    echo "</td>";
    echo "</tr>";
  }
  echo "</table>";

}
/**
  *This function manages inserts, updates and deletes of contacts and their associated category relationships.
  *
  * @param array $data
  * @param $action the action to perform (valid options are `update`, `delete`, and `add`)
  */
function crud_contact(array $data, $action){

  $insert = "INSERT INTO cms_contact(
            first_name,
            last_name,
            phone_number,
            email_address,
            street_address,
            city,
            state,
            zip,
            company) VALUES (
            :first_name,
            :last_name,
            :phone_number,
            :email_address,
            :street_address,
            :city,
            :state,
            :zip,

            :company);";
  $update ="UPDATE cms_contact SET
            first_name=:first_name,
            last_name=:last_name,
            phone_number=:phone_number,
            email_address=:email_address,
            street_address=:street_address,
            city=:city,
            state=:state,
            zip=:zip,
            company=:company";
  $delete = "DELETE FROM cms_contact";
  $soft_delete = "UPDATE cms_contact SET soft_delete = 1";
  $where = " WHERE cms_id = :cms_id";

$insert_con_cat = "INSERT INTO cms_contact_categories(cms_id, cat_id) VALUES(:cms_id, :cat_id);";
$delete_con_cat = "DELETE FROM cms_contact_categories WHERE cms_id = :cms_id";
/**
  * $db is a database connection.
  * $query is a PDOStatement.
  * $x_result is any result from the query.
  */
  $db = connect();
  $query;
  $contact_result;


  if(isset($action) && $action === "update"){
    // update the contact data
    $query = $db->prepare($update.$where);
    $contact_result = $query->execute(
      [ 'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'phone_number' => $data['phone_number'],
        'email_address' => $data['email_address'],
        'street_address' => $data['street_address'],
        'city' => $data['city'],
        'state' => $data['state'],
        'zip' => $data['zip'],
        'company' => $data['company'],
        'cms_id' => $data['cms_id']
      ]);
    // delete previous categories
    $query = $db->prepare($delete_con_cat);
    $query->execute(['cms_id' => $data['cms_id']]);
    // assign cms_id to varible.
    $cms_id = $data['cms_id'];
    // insert new categories.
    $query = $db->prepare($insert_con_cat);
    foreach($data['cat_array'] as $cat){
      $cat_id = $cat;
      $query->execute(['cms_id' => $cms_id, 'cat_id'=> $cat_id]);
    }
  }elseif (isset($action) && $action === "delete") {
    //  delete category relations
    //$query = $db->prepare($delete_con_cat);
    //$query->execute(['cms_id' => $data['cms_id']]);
    //  delete contact
    $query = $db->prepare($soft_delete.$where);
    $contact_result = $query->execute(['cms_id' => $data['cms_id']]);

  }elseif(isset($action) && $action === "add"){
    // insert the new record
    $query = $db->prepare($insert);
    $contact_result = $query->execute(
    [ 'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'phone_number' => $data['phone_number'],
      'email_address' => $data['email_address'],
      'street_address' => $data['street_address'],
      'city' => $data['city'],
      'state' => $data['state'],
      'zip' => $data['zip'],
      'company' => $data['company']
    ]);
    // get cms_id from insert
    $cms_id = $db->lastInsertID();
    $query = $db->prepare($insert_con_cat);
    foreach($data['cat_array'] as $cat){
      $cat_id = $cat;
      $query->execute(['cms_id' => $cms_id, 'cat_id'=> $cat_id]);
    }
  }
  //return $result;
}
function crud_cat($action = null, $id = null, $desc = null){
  $insert = "INSERT INTO cms_cat(cat_desc) VALUES (:cat_desc)";
  $update = "UPDATE cms_cat SET cat_desc = :cat_desc";
  $delete = "DELETE FROM cms_cat";
  $where = " WHERE cat_id = :cat_id";
  $remove_relations = "DELETE FROM cms_contact_categories";
  try{
    $db = connect();
    $query;
    if(isset($action) && isset($id)){
      if($action == 'update' && isset($desc)){
          $query = $db->prepare($update.$where);
          $result = $query->execute(['cat_desc' => $desc, 'cat_id' => $id]);
      }
      elseif($action == 'delete'){
        $query = $db->prepare($remove_relations.$where);
        $result = $query->execute(['cat_id' => $id]);
        $query = $db->prepare($delete.$where);
        $result = $query->execute(['cat_id' => $id]);
      }else{
        echo "redirect 1:update/delete";
        //redirect("sctcc/views/categories.php");
      }
    }elseif(isset($action) && isset($desc)){
      if($action == 'insert'){
        $query = $db->prepare($insert);
        $result = $query->execute(['cat_desc' => $desc]);
      }else{
        echo "redirct 2: insert";
        //redirect("sctcc/views/categories.php");
      }
    }else{
      echo "redirect 3: general";
    //  redirect("sctcc/views/categories.php");
    }

  }catch(PDOException $e){
    log_or_echo($e);
  }
}

/**
  * This function gets the data on contacts from the database,
  * and then passes it to the data grouper,
  * before returning the results
  * in an associtive array.
  * @param $show_deleted Determines if you want to display a result set of
  * soft_deleted(1) records or normal(0) records. Defaults to 0.
  * @return $data associtiive array of the contacts with subarry for categories
  * @deprecated This function is no longer used in the app. Use `get_contacts_search` instead.
  */
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
  * This function has some quirky return results
  * due to the encapsulating array
  * used by `group_data()`.
  *
  * It's usually useful to call `current()` from PHP's
  * native library, as strips the useful data
  * from the array without duplicates.
  *
  * `get_contact_categories` fufills the same functionality without this quirk.
  * `get_contact_with_categories_by_id` is maintained for legacy code
  * that still calls this function and has not been refactored at this point in time.
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

function redirect($url){
  header("Location:http://localhost/".$url);
}

?>

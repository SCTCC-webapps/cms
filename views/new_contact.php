<?php
/**
  *This page receives data from `contact.php`,
  *(likely to be renamed soon, as is this page.)
  *and completes appropriate database actions.
  */
require "../models/contacts_cat.php";
require 'layout/header.php';
require 'layout/footer.php';
if(isset($_POST['action'])){
  if(isset($_POST['id'])  || $_POST['action'] === 'add'){
    // list of data feilds in incoming POST request data, excluding the category array.
    $fields = array("first_name", "last_name", "email_address", "phone_number",
                      "street_address", "city", "state", "zip", "company");


    // prepare the data array and loop through the POST feilds.
    // Filters can be applied here if appropriate.
    $data = array();
    foreach($fields as $field){
      if(array_key_exists($field, $_POST)){
        $data[$field] = $_POST[$field];
      }
    }
    $action = $_POST['action'];
    if(array_key_exists('id', $_POST)){
      $data['cms_id'] = $_POST['id'];
    }

    // get list of all categories. Run through categories on POST array to find matches.
    $cats = list_all_categories();
    $cat_array = array();
    foreach($cats as $cat_id => $cat){
      if(isset($_POST[$cat_id])){
        $cat_array[$cat_id] = $cat_id;
        //array('cat_id' => $cat_id);
        // $cat_array['cat_id'] = $cat_id;
        // $cat_array['cms_id'] = $_POST[$cat_id];
      }
    }
    //assign category array to data array and pass the data to the CRUD method.
    $data['cat_array'] = $cat_array;

    crud_contact($data, $action);
    redirect("/sctcc/views/contacts.php#{$_POST['id']}");
    //
    // //write page output, using any html returned by the crud method.
    // write_header();
    // echo "$action completed."."</br>".$html_message;
    // write_footer();

  }
}else{
      redirect("/views/contacts");
  // write_header();
  // echo "You do not have a contact or action selected. You probably navigated to this page from the wrong source. Find your contact <a href='contacts.php'>here</a>.";
  // echo "<br> ID: {$_POST['id']}";
  // echo "<br> Action: {$_POST['action']}";
  // write_footer();
}
?>

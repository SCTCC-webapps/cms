<?php
/**
  * This file is a view for the form that submits a new contact.
  */
require "../models/contacts_cat.php";
require 'layout/header.php';
require 'layout/footer.php';

if(isset($_POST['action'])){
  $action = $_POST['action'];
  write_header();

  $fields = array("first_name", "last_name", "email_address", "phone_number",
                    "street_address", "city", "state", "zip", "company");

  $labels = array("first_name" => 'First Name', "last_name" => 'Last Name', "email_address" => 'Email', "phone_number" => 'Phone Number',
                                      "street_address" => 'Street Address', "city" => 'City', "state" => 'State', "zip" => 'ZIP Code', "company" => 'Company');

  echo "<form action='new_contact.php' method='post' >";
  echo "<input type='hidden' name='action' value='$action'/>";
  if(isset($_POST['id'])){
    echo "<input type='hidden' name='id' value='{$_POST['id']}'/>";
  }
  if($action === 'delete' || $action === 'view'){
    $data = array(); // do something to fetch values.
    echo "<table>";
    foreach($fields as $field){
      echo "<tr>";
      echo "<td>{$labels[$field]}:</td>";
      echo "<td>{$data[$field]}</td>";
      echo "</tr>";
    }


    $cats = $data['cat_array'];//list_all_categories();
    echo "<tr><td><ul>";
    $index = 0;
    foreach($cats as $id => $cat){
      echo "<li>$cat</li>";
    }
    echo "</ul></td></tr>";
    echo "<input type='submit' value='Add New Contact'/>";
    echo "</form>";

  }elseif($action === 'add' || $action === 'update'){
    write_header();
    insert_or_update($_POST['id']);
    write_footer();
  }else{
    write_header();
    insert_or_update();
    write_footer();
  }
}else{
  write_header();
  insert_or_update();
  write_footer();
}

function insert_or_update($id = null){
  $data = array();
  if(isset($id)){
    $data = current(get_contact_with_categories_by_id($id));
  }else{
    foreach($fields as $field){
      $data[$field] = null;
    }
  }
  $fields = array("first_name", "last_name", "email_address", "phone_number",
                    "street_address", "city", "state", "zip", "company");

  $labels = array("first_name" => 'First Name', "last_name" => 'Last Name', "email_address" => 'Email', "phone_number" => 'Phone Number',
                                      "street_address" => 'Street Address', "city" => 'City', "state" => 'State', "zip" => 'ZIP Code', "company" => 'Company');
  echo "<form action='new_contact.php' method='post' >";
  foreach($fields as $field){
    echo "<div>";
    echo "<label for='$field'>{$labels[$field]}:</label>";
    echo "<input type='text' name='$field' value='{$data[$field]}'/>}";
    echo "</div>";
  }
  $cats = list_all_categories();
  echo "<div>";
  $index = 0;
  foreach($cats as $id => $cat){
    echo "<input type='checkbox' name='$id' value='$id'/>$cat<br>";
  }
  echo "</div>";
  echo "<input type='submit' value='Add New Contact'/>";
  echo "</form>";

}

?>

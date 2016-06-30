<?php
/**
  *This file is a view that returns a table of categories and their associated contacts.
  */

  require '../models/contacts_cat.php';
  require 'layout/header.php';
  require 'layout/footer.php';

  $name = null;
  $company = null;
  $category = null;
  if(isset($_POST['name'])){
    $name = $_POST['name'];
  }
  if(isset($_POST['company'])){
    $company = $_POST['company'];
  }
  if(isset($_POST['category'])){
    $company = $_POST['category'];
  }

  write_header();
  echo "<h3>Contacts List</h3>";
  table_display(get_contacts_with_categories(0, $name, $company, $category));
  write_footer();
  ?>

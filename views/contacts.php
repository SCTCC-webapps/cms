<?php
/**
  *This file is a view that returns a table of categories and their associated contacts.
  */

  require '../models/contacts_cat.php';
  require 'layout/header.php';
  require 'layout/footer.php';

  $search = null;
  $search_by = null;
  $category = null;
  if(isset($_POST['search'])){
    $search = $_POST['search'];
  }
  if(isset($_POST['search-by'])){
    $search_by = $_POST['search-by'];
  }
  if(isset($_POST['category'])){
    $category = $_POST['category'];
  }

  write_header();
  echo "<h3>Contacts List</h3>";
  echo "Search: $search Search By: $search_by Category: $category";
  table_display(get_contacts_with_categories(0, $search, $search_by, $category));
  write_footer();
  ?>

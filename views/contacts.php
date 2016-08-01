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
  if(isset($_GET['search'])){
    $search = $_GET['search'];
  }
  if(isset($_GET['search-by'])){
    $search_by = $_GET['search-by'];
  }
  if(isset($_GET['category'])){
    $category = $_GET['category'];
  }

  write_header();
  echo "<div class='redmessage'>Search: $search   Search By: $search_by   Category: $category</div>";
  echo "<h3>Contacts List</h3><hr>";
  //table_display(get_contacts_with_categories(0, $search, $search_by, $category));

  table_display(get_contacts_search(50, 0, $search, $search_by, $category));
  write_footer();
  ?>

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
  $page = 1;
  $show_deleted_mode = false;
/**
  * DO NOT ALLOW  users to pass $show_deleted value directly.
  * Potential SQL injection issue -
  * binding arrays don't support data types,
  * so passing a number in directly with a varible was needed.
  * same rule for $offset and $limit values.
  */
  $show_deleted = 0;

  if(isset($_GET['search'])){
    $search = $_GET['search'];
  }
  if(isset($_GET['search-by'])){
    $search_by = $_GET['search-by'];
  }
  if(isset($_GET['category'])){
    $category = $_GET['category'];
  }
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }
  if(isset($_GET['show_deleted_mode'])){
    $show_deleted_mode = $_GET['show_deleted_mode'];
  }

  if($show_deleted_mode){
    $show_deleted = 1;
  }
  write_header();
  //echo "<div class='redmessage'>Search: $search   Search By: $search_by   Category: $category</div>";
  echo "<h3>Contacts List</h3><hr>";
  //table_display(get_contacts_with_categories(0, $search, $search_by, $category));
  $page_interval = 50; #config
  $offset = $page_interval * ($page - 1);
  table_display(
    get_contacts_search($page_interval, $offset, $search, $search_by, $category, $show_deleted),
    $page,
    $page_interval,
    $show_deleted_mode,
    $_SERVER['QUERY_STRING']
  );
  write_footer();
  ?>

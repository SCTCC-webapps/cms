<?php
/**
  *This file is a view that returns a table of categories and their associated contacts.
  */

  require '../models/contacts_cat.php';
  require 'layout/header.php';
  require 'layout/footer.php';

  write_header();
  echo "<h3>Contacts List</h3>";
  table_display(get_contacts_with_categories_no_search());
  write_footer();
  ?>

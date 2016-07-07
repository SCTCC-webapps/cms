<?php
require "../models/contacts_cat.php";
require "layout/header.php";
require "layout/footer.php";

//echo "above header";
write_header();
list_cats();
write_footer();

function list_cats(){

  $cats = list_all_categories();

  echo "<table class='center'>";
  echo "<tr>";
    echo "<form method='POST' action='categories.php'>";
    echo "<td>";
      echo "<input type='text' name='new_cat'/>";
    echo "</td>";
    echo "<td>";
      echo "<input type='submit' value='Add New Category'/>";
    echo "</td>";
    echo "</form>";
  echo "</tr>";
  foreach ($cats as $id => $cat) {
    echo "<tr>";
      echo "<td>$cat</td>";
      echo "<td>";
      echo "<form method='POST' action='categories.php'/>";
        echo "<input type='hidden' name='action' value='edit'/>";
        echo "<input type='hidden' name='id' value='$id'/>";
        echo "<input type='submit' value='Rename'>";
        echo "</form>";
      echo "</td><td>";
      echo "<form method='POST' action='categories.php'/>";
        echo "<input type='hidden' name='action' value='delete'/>";
        echo "<input type='hidden' name='id' value='$id'/>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
      echo "</td>";
    echo "</tr>";
  }
  echo "</table>";
}
?>

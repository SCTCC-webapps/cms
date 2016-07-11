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
echo "<h1>Categories</h1><hr/>";
  echo "<table class='center-element'>";
  echo "<tr>";
    echo "<form method='POST' action='categories.php'>";
    echo "<td class='align-left full-width'>";
      echo "<input type='text' name='new_cat' class=''/>";
    echo "</td>";
    echo "<td class='align-right' colspan='2'>";
      echo "<input type='submit' value='Add New Category' class='full-width sctcc-button'/>";
    echo "</td>";
    echo "</form>";

  echo "</tr>";
  foreach ($cats as $id => $cat) {
    echo "<tr>";
      echo "<td class='align-left'>$cat</td>";
      echo "<td class='align-right'>";
      echo "<form method='POST' action='categories.php'/>";
        echo "<input type='hidden' name='action' value='edit'/>";
        echo "<input type='hidden' name='id' value='$id'/>";
        echo "<input type='submit' value='Rename' class='sctcc-button'>";
        echo "</form>";
      echo "</td><td class='align-right'>";
      echo "<form method='POST' action='categories.php'/>";
        echo "<input type='hidden' name='action' value='delete'/>";
        echo "<input type='hidden' name='id' value='$id'/>";
        echo "<input type='submit' value='Delete' class='sctcc-button'>";
        echo "</form>";
      echo "</td>";
    echo "</tr>";
  }
  echo "</table>";
}
?>

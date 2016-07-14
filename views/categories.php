<?php
require "../models/contacts_cat.php";
require "layout/header.php";
require "layout/footer.php";

//echo "above header";
write_header();
if(isset($_POST['action'])){
  $action = $_POST['action'];
  if($action == 'insert'){
    if(isset($_POST['desc'])){
      crud_cat($action, null, $_POST['desc']);
      //echo "<div>".$_POST['desc']."</div>";
    }
    list_cats("Category '{$_POST['desc']}' added!", "greenmessage");
  }elseif($action == 'edit' && isset($_POST['id'])){
    $cat = list_all_categories();
    $id = $_POST['id'];
    echo <<<EOD
    <div>
      <form action='categories.php' method='POST'>
        <label for="desc">Category Name</label>
        <input type='text' name='desc' value='{$cat[$id]}'></input>
        <input type='hidden' name='id' value='$id'/>
        <input type='hidden' name='action' value='update'/>
        <input type='submit' name='submit' value='Submit'/>
      </form>
    </div>
EOD;
  }elseif($action == 'update' && (isset($_POST['id']) && isset($_POST['desc']))){
    $cats = list_all_categories();
    crud_cat($action, $_POST['id'], $_POST['desc']);

    list_cats("Category '{$cats[$_POST['id']]}' was renamed to '{$_POST['desc']}'!", "greenmessage");
  }elseif($action == 'delete' && isset($_POST['id'])){
    $cats = list_all_categories();
    crud_cat($action, $_POST['id']);
    list_cats("Category '{$cats[$_POST['id']]}' was deleted!", "redmessage");
  }
}else{
  list_cats();
}
write_footer();

function list_cats($response = null, $header_style = null){
  echo "<div id = 'message' class = '$header_style'>$response</div>";
  $cats = list_all_categories();
echo "<h1>Categories</h1><hr/>";
  echo "<table class='center-element'>";
  echo "<tr>";
    echo "<form method='POST' action='categories.php'>";
    echo "<td class='align-left full-width'>";
      echo "<input type='text' name='desc' class=''/>";
    echo "</td>";
    echo "<td class='align-right' colspan='2'>";
      echo "<input type='hidden' name='action' value='insert'/>";
      echo "<input type='submit' name='submit' value='Add New Category' class='full-width sctcc-button'/>";
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

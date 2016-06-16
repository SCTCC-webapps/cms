<?php
/**
  * This file is a view for the form that submits a new contact.
  */
require "../models/contacts_cat.php";
require 'layout/header.php';
require 'layout/footer.php';
/** '$fields` and `$labels` used by the `add_or_update()` and functions defined
  * at the bottom of the page for output. Primarily avoids writing extra code,
  * simplifies output and makes it easier to change if we add more feilds to the
  * database.
  */
  //Field names from the database.
  $fields = array(
    "first_name",
    "last_name",
    "email_address",
    "phone_number",
    "street_address",
    "city",
    "state",
    "zip",
    "country",
    "company"
  );
  //How the fields are labeled.
  $labels = array(
    "first_name" => 'First Name',
    "last_name" => 'Last Name',
    "email_address" => 'Email',
    "phone_number" => 'Phone Number',
    "street_address" => 'Street Address',
    "city" => 'City',
    "state" => 'State',
    "zip" => 'ZIP Code',
    "country" => 'Country',
    "company" => 'Company'
  );

/**
  * The view is controlled to change based on the action.
  * If the action is not set, it will default to insert view.
  */
if(isset($_POST['action'])){
  $action = $_POST['action'];
  write_header();
  /** `delete` or `view` actions will trigger one view to display with slight differences.
    *
    * The `delete` view provides a confirmation that the contact
    * is the one you want to delete. `view` will display the same information
    * without the delete option.
    */
  if($action === 'delete' || $action === 'view'){
    if(isset($_POST['id'])){
      $data = get_contact_with_categories_by_id($_POST['id']);
      if($action === 'delete'){
        action_buttons($_POST['id'], ['view', 'update']);
      }elseif($action === 'view'){
        action_buttons($_POST['id'], ['update', 'delete']);
      }
      delete_or_view($data, $action);
      //echo "<pre>".print_r($data, true)."</pre>";
    }else{
      echo "No data to $action.";
    }
  }
  /**
    * The `add` and `update` actions will display a form
    * to update or create a contact.
    *
    * The `update` form will be prefilled with values from the selected contact.
    * The `add` form will be blank to allow creation of a new record.
    */
  elseif($action === 'add' || $action === 'update'){
    $data = array();
    if(isset($_POST['id'])){
      $data = get_contact_with_categories_by_id($_POST['id']);
      if($action === 'update'){
        action_buttons($_POST['id'], ['view', "delete"]);
      }
    }
    add_or_update($data, $action);
  }
  write_footer();
}
/**
  *In the event that someone loads this page without selecting an action,
  *(by a direct URL visit.) the default action is to open the insert form.
  */
else{
  write_header();
  add_or_update();
  write_footer();
}
/**
  * This function loads a form to update or create a individual contact,
  *
  *
  * @param array $data An array of data on the contact. Defaults to `null` and loads an add form if not provided.
  * @param $action The `add` or `update`. Defaults to `add` if not provided on method call.
  */

function add_or_update(array $data = null, $action = 'add'){
  global $fields;
  global $labels;

  if(is_null($data)){
    $data = array();
    foreach($fields as $field){
      $data[$field] = null;
    }
  }else {
    $data = current($data);
  }
  echo "<form action='new_contact.php' method='post' name='add_or_update' >";
  echo "<input type='hidden' name='action' value='$action'/>";
  if(isset($_POST['id'])){
    echo "<input type='hidden' name='id' value='{$_POST['id']}'/>";
  }
  foreach($fields as $field){
    echo "<div>";
    echo "<label for='$field'>{$labels[$field]}:</label>";
    echo "<input type='text' name='$field' value='{$data[$field]}'/>";
    echo "</div>";
  }

  echo "<div>";
  if(array_key_exists('cat_array', $data)){
    // loop through the full list of categories.
    $cats = list_all_categories(); // list of all categories
    $cat_array = $data['cat_array']; // list of all categories for the contact.

    foreach($cats as $id => $all_cat){
      $checked = null;
      //echo "Iteration $i <br>all_cat: $all_cat checked: $checked <br>Checking versus cat_array:<br><pre>";
      //check versus the contact's categories.
      foreach($cat_array as $con_cat){
      //  echo "\tcon_cat: $con_cat<br>";
        if($all_cat === $con_cat){
          $checked = "checked='checked'";
        }
        //echo "\tchecked: $checked<br>";
      }
      //echo "</pre>";
        echo "<input type='checkbox' $checked name='$id' value='$id'/>$all_cat<br>";
      //$i++;
    }
  }else{
    $cats = list_all_categories();
    foreach($cats as $id => $cat){
      echo "<input type='checkbox' name='$id'/>$cat<br>";
    }
  }
  echo "</div>";
  $button_value = ($action == 'add') ? "Add New Contact" : "Update Contact";
  echo "<input type='submit' value='$button_value'/>";
  echo "</form>";
  write_validator();
}
/**
  * This function loads a detailed view of a individual contact,
  * with the option to delete when enabled.
  *
  * @param array $data An array of data on the contact.
  * @param $action The `delete` or `view`. Defaults to `view` if not provided on method call.
  */
function delete_or_view(array $data, $action = 'view'){
  global $fields, $labels;

  $data = current($data);
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
  echo "</table>";
  if(isset($_POST['id']) && $action == 'delete'){
    echo "<div>";
    echo "<form action='new_contact.php' method='post'>";
    echo "<input type='hidden' name='action' value='delete'/>";
    echo "<input type='hidden' name='id' value='{$_POST['id']}'/>";
    echo "<label for='submit'>If you delete this contact, this action CANNOT be undone:</label>";
    echo "<input type='submit' name='submit' value='Delete Contact'/>";
    echo "</form>";
    echo "</div>";
  }else{
    echo "<div><a href='contacts.php#{$_POST['id']}'><- Back to Contacts</a></div>";
  }
}
function action_buttons($id, $actions = null){
  if(! isset($actions)){
    $actions = array('update', 'delete');
  }

  foreach($actions as $action){
      $action_button = ucfirst($action);//ucfirst()` capitalizes the first letter in a string.
      echo "<form action='contact.php' method='POST' name='{$id}_$action'>";
      echo "<input type='hidden' name='action' value='$action'/>";
      echo "<input type='hidden' name='id' value='{$id}'/>";
      echo "<input type='submit' name='submit' value='$action_button'/>";
      echo "</form>";
    }

}
function write_validator(){
   $validator_script = <<<EOD
    <script language="JavaScript" type="text/javascript">
    var frmValidator = new Validator("add_or_update");
    frmValidator.EnableMsgsTogether();
    frmValidator.addValidation("first_name", "req", "Please add a first name.");
    frmValidator.addValidation("first_name", "maxlen=100", "The first name must be under 100 charecters.");
    frmValidator.addValidation("last_name", "req", "Please add a last name. ");
    frmValidator.addValidation("last_name", "maxlen=100", "The last name must be under 100 charecters.");

    frmValidator.addValidation("email_address", "req", "Please add an email address.");
    frmValidator.addValidation("email_address", "email", "That is not an email address!");
    frmValidator.addValidation("email_address", "maxlen=100", "The last name must be under 100 charecters.");

    frmValidator.addValidation("phone_number", "req", "Please add a phone number");
    frmValidator.addValidation("phone_number", "maxlen=15", "Phone number must be under 100 charecters.");

    frmValidator.addValidation("street_address", "req", "Please add a street.");
    frmValidator.addValidation("street_address", "maxlen=100", "The last name must be under 100 charecters.");

    frmValidator.addValidation("city", "req", "Please add a city.");
    frmValidator.addValidation("city", "maxlen=100", "The last name must be under 100 charecters.");

    frmValidator.addValidation("state", "req" "Please add a state.");
    frmValidator.addValidation("state", "maxlen=50", "The last name must be under 50 charecters.");

    frmValidator.addValidation("zip", , "req", "Please add a ZIP code.");
    frmValidator.addValidation("zip", "maxlen=16", "The last name must be under 100 charecters.");

    frmValidator.addValidation("country", "req", "Please add a country.");
    frmValidator.addValidation("country", "maxlen=100", "The last name must be under 100 charecters.");

    frmValidator.addValidation("company", "req", "Please add a country.");
    frmValidator.addValidation("company", "maxlen=100", "The last name must be under 100 charecters.");
    </script>
EOD;
//You cannot indent closing identifiers on heredoc syntax.
    echo $validator_script;
}
?>

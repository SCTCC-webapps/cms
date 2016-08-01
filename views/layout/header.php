<?php
/**
  *This function writes the header of the html page.
  *
  * @param string $custom_code Optional value that writes page-unique
  * css and Javascript values to the `head` element of the page. Defaults to `NULL`.
  * @param string $id Optional value for styling. Determines the `id` of
  * the page's containing div. Defaults to `NULL`.
  * @param string $class Optional value for styling. Determines the `class`
  * of the page's containing `div`. Defaults to `NULL`.
  */
function write_header(string $custom_code = null)
{
    echo '<html>';
    echo '<head>';
    echo '<title>SCTCC CTech Contact Management System</title>';
    echo "<link href='css/styles.css' type='text/css' rel='stylesheet' />";
      //javascript imports, stylesheets, etc, go here.
      echo "<script language='JavaScript' src='../js/gen_validatorv4.js' type='text/javascript'></script>";
    echo "<!--imports for this page-->$custom_code";
    echo '</head>';
    echo '<body>';
    echo "<div id='contentwrap'><div id='content'>";
    if (isset($_POST['id'])) {
        echo "<div class='align-left'><a href='contacts.php#{$_POST['id']}'><<- Contacts</a></div>";
    }
    echo "<img src='img/sctcc_logo.png' id='img_header'/>";
    echo "<div>";
    nav_bar_and_search();
    echo "</div>";
}
function nav_bar_and_search(){
  echo <<<EOD
    <form action='contacts.php' method='get'>
      <label for='search'>Search:</label>
      <input type='text' name='search'/>

      <label for='search-by'> &nbsp; Search By:</label>
      <select name='search-by'>
        <option value='name'>Name</option>
        <option value='company'>Company</option>
      </select>
      <label for='catetgory'>&nbsp; Category:</label>
EOD;
    echo "<select name='category'>";
    echo "<option value = 'no-cat'>Select a category...</option>";
    $cats = list_all_categories();
    foreach($cats as $id => $cat){
      echo "<option value='{$id}'>$cat</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Search' class='sctcc-button'/>";
  echo "</form>";
}

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
function write_header(string $custom_code = NULL, string $id = NULL, string $class= NULL){
  echo "<html>";
      echo "<head>";
      //javascript imports, stylesheets, etc, go here.
      echo "<script language='JavaScript' src='../js/gen_validatorv4.js' type='text/javascript'></script>";
          echo "<!--imports for this page-->$custom_code";
      echo "</head>";
      echo "<body>";
      echo "<div id='$id' class='$class'>";
}

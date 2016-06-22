<?php
/**
  *This function writes the footer of the html page.
  *
  * @param string $custom_code Optional value that writes page-unique
  * content and Javascript values to the `<div id='footer' class='footer'>`
  * element of the page. Defaults to `NULL`.
  * @param string $class Optional value for styling. Appends additional classes
  * to the `class` of the footer div. Defaults to `NULL`.
  */

function write_footer(string $custom_code = NULL, string $class = NULL){
  echo "<div id='footer' class='footer $class'>$custom_code</div></div></div></body></html>";

}
?>

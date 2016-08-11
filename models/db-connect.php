<?php
// $db_host = 'localhost:3306';
// $db_name = 'sctcc_cms';
// $user = 'root';
// $pass = 'Pa$$w0rd';
/**
  *The `connect` function returns a PDO object that holds the database connection.
  *
  * @return PDO $db The database connection.
  */
function connect(){
  #config
  $db_host = 'localhost';
  $db_name = 'sctcc_cms';
  $user = 'root';
  $pass = 'Pa$$w0rd';

  return new PDO("mysql:host=$db_host;dbname=$db_name;",$user, $pass,
     array( PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => true, PDO::ERRMODE_EXCEPTION => true));
}
/**
  * This function provides a global control to switch between logging
  * and echoing behaviors in this application. The $mode variable inside the function code can be changed to `echo` or
  * `log` to obtain the coresponding behvior.
  * @param $override override logging behavior if enabled and echo.
  * @param PDOExcepttion $e The PDOException being logged/echoed.
  */
function log_or_echo($overide = false, PDOException $e){
  $mode = "echo"; #config
  if($mode = "echo" || $override == true) {
    echo $e->getMessage()."<br/>";
  }else if($mode == "log"){
    error_log($e->getMessage());
    echo "There was an error. We've logged the error, and you should".
      "tell your system admin that you got this message.";
  }
  function formatted_print_r($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
  }
}
?>

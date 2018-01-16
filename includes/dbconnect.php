<?php
  //database connection
  define("DB_SERVER", "localhost");
  define("DB_USER", "root");
  define("DB_PASS", "prometheuS");
  define("DB_NAME", "pm4life_con");

  $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
  $item_per_page = 9;
  $content_per_page = 8;

  if(mysqli_connect_errno())
  {
    die("Database connection failed: ".mysqli_connect_error()." (".mysqli_connect_errno().")");
  }

  $smtphost = "pm4life.org";
  $smtpuser = "info@pm4life.org";
  $smtppass = "~D#QBS1H=*gQ";
 ?>

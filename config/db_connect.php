<?php
// Connection with database
$conn = mysqli_connect('localhost', 'Debabrata', 'test12345', 'ninja_pizzas');

if (!$conn) {
  echo 'Connection error' . mysqli_connect_error();
}

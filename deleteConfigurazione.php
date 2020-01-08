<?php

  header('Content-Type: application/json');

  $id = $_POST['id'];

  if (!$id) {

    echo json_encode(-2);
    return;
  }

  $server = "localhost";
  $username = "root";
  $password = "bool";
  $dbname = "HotelDB";

  $conn = new mysqli($server, $username, $password, $dbname);
  if ($conn -> connect_errno) {

    echo json_encode(-1);
    return;
  }

  $sql = "

    DELETE FROM configurazioni
    WHERE id = ?

  ";

  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param("i", $id);

  $res = $stmt -> execute();
  $conn -> close();

  echo json_encode($res);

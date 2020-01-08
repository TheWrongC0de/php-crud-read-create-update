<?php

  header('Content-Type: application/json');

  list($title, $desc) = [

    $_POST['title'],
    $_POST['description']
  ];

  if (!$title || !$desc) {

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

  INSERT INTO configurazioni (title, description)
  VALUES ( ? , ? );

  ";

  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param("ss", $title, $desc);

  $res = $stmt -> execute();
  $conn -> close();

  echo json_encode($res);

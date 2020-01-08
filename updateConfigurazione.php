<?php

  header('Content-Type: application/json');

  list($id, $title, $desc) = [
    $_POST['id'],
    $_POST['title'],
    $_POST['description']
  ];

  if (!$id || !$title || !$desc) {

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

  // OLD SCHOOL
  // $sqlOLD = "
  //
  //   UPDATE configurazioni
  //   SET title = " . $title . " , description = " . $desc . "
  //   WHERE id = " . $id . "
  //
  // ";

  $sql = "

    UPDATE configurazioni
    SET title = ? , description = ?
    WHERE id = ?

  ";

  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param("ssi", $title, $desc, $id);

  $res = $stmt -> execute();
  $conn -> close();

  echo json_encode($res);

<?php
  $id = $_POST['id'];
  $fio = filter_var(trim($_POST['fio']),FILTER_SANITIZE_STRING);
  $date = $_POST['born'];

    $link = mysqli_connect('localhost','root','root','test') or die("Ошибка " . mysqli_error($link));

    $sql = "UPDATE `user` SET `fio`='$fio', `born_date`='$date' WHERE `id`='$id'";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    header('Location: /index.php');
  ?>

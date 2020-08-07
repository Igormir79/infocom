<?php
  $fio = filter_var(trim($_POST['fio']),FILTER_SANITIZE_STRING);
  $date = $_POST['born'];

    $link = mysqli_connect('localhost','root','root','test') or die("Ошибка " . mysqli_error($link));

    $sql = "INSERT INTO `user` (`id`, `fio`,`born_date`) VALUES (NULL, '$fio', '$date')";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    header('Location: /index.php');
  ?>

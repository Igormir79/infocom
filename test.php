<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Сортировка</title>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <div class="conteiner">
      <div class="content">
        <?php
          $today = date("Y-m-d");
          $link = mysqli_connect('localhost','root','root','diplom_db') or die("Ошибка " . mysqli_error($link));
          $filter = $_GET['filter'];
          if (! isset($filter)) {
            $filter = "id";
          }
          $query = "SELECT * FROM `test_work` ORDER BY $filter";
          $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

          if ($result) {
            $rows = mysqli_num_rows($result);
            ?>
            <table id="table-id" align="center" width=85% class="user_group">
              <tr>
                <th width=30px><a href="?filter=id"> ID</a></th>
                <th><a href="?filter=fio"> ФИО</a></th>
                <th width=200px><a href="?filter=born_date"> Дата рождения</a></th>
                <th width=90px>action</th>
              </tr>
            <?php
            for ($i = 0 ; $i < $rows ; ++$i)
            {
                $row = mysqli_fetch_row($result);

                ?>
                <tr>
                  <td align="center"><?=$row[0]?></td>
                  <td><?=$row[1]?></td>
                  <td><?=$row[2]?></td>
                  <td align="center"><button>Исправить</button> </td>
                </tr>
                <?php
            }
             ?>
           </table>
           <button id="add_user_button">Добавить нового пользователя</button>
             <?php
          }

          ?>

<dialog id="add_user_form">
  <h2>Добавление нового пользователя</h2>
  <form class="" action="add_u.php" method="post">
    <input type="text" name="fio" placeholder="Введите ФИО" value="" required> <br>
    <input type="date" name="born" value="" required max="<?=$today?>">
    <menu>
      <button type="submit">Добавить</button>
      <button id="cancel" type="reset">Закрыть</button>
    </menu>
  </form>
</dialog>


<script>
  (function() {
    var add_userButton = document.getElementById('add_user_button');
    var cancelButton = document.getElementById('cancel');
    var add_user_form = document.getElementById('add_user_form');

    // Update button opens a modal dialog
    add_userButton.addEventListener('click', function() {
      add_user_form.showModal();
    });
    // Form cancel button closes the dialog box
    cancelButton.addEventListener('click', function() {
      add_user_form.close();
    });

  })();
</script>
  </body>
</html>

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
          $link = mysqli_connect('localhost','root','root','test') or die("Ошибка " . mysqli_error($link));
          $filter = $_GET['filter'];
          if (! isset($filter)) {
            $filter = "id";
          }
          $query = "SELECT * FROM `user` ORDER BY $filter";
          $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
          $query = "SELECT * FROM `user` ORDER BY `id`";
          $result1 = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
          $arr_user = array(array());
          $i = 0;
          while ($row = mysqli_fetch_assoc($result1))
          {
              $arr_user[$i][] = $row['id'];
              $arr_user[$i][] = $row['fio'];
              $arr_user[$i][] = $row['born_date'];
              $i++;
          }
          $arr_lenght = count($arr_user);

          $jsArray = array();

          for ($i=0; $i < $arr_lenght; $i++) {
            $jsArray[] = array((int) $arr_user[$i][0], $arr_user[$i][1], $arr_user[$i][2]);
          }

          if ($result) {
            $rows = mysqli_num_rows($result);
            ?>
            <table id="table-id" align="center" width=85% class="user_group">
              <tr>
                <th width=30px><a href="?filter=id">ID</a></th>
                <th><a href="?filter=fio">ФИО</a></th>
                <th width=200px><a href="?filter=born_date">Дата рождения</a></th>
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
                  <td align="center"><button onclick="change_u('<?echo $row[0]?>')">Исправить</button> </td>
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

<dialog id="change_user_form">
  <h2>Изменение данных</h2>
  <form class="" action="change_u.php" method="post">
    <input id="u_id" type="hidden" name="id" value="">
    <input id="fio" type="text" name="fio" placeholder="" value="" required> <br>
    <input id="born_date" type="date" name="born" value="" required max="<?=$today?>">
    <menu>
      <input type="submit" name="" value="Изменить">
      <input type="button" id="c" name="" value="Закрыть">
    </menu>
  </form>
</dialog>

<script>
  (function() {
    var add_userButton = document.getElementById('add_user_button');
    var cancelButton = document.getElementById('cancel');
    var add_user_form = document.getElementById('add_user_form');
    var change_user_form = document.getElementById('change_user_form');

    add_userButton.addEventListener('click', function() {
      add_user_form.showModal();
    });

    cancelButton.addEventListener('click', function() {
      add_user_form.close();
    });


  })()
  c.onclick = function(){
    change_user_form.close();
  }
  function change_u(user_id){
    var user_array = <? echo json_encode($jsArray,  JSON_UNESCAPED_UNICODE);?>;
    var lenght_mas = <?echo json_encode($arr_lenght,  JSON_UNESCAPED_UNICODE);?>;
    for (var i = 0; i < lenght_mas; i++) {
      if (user_array[i][0] == user_id) {
        change_user_form.showModal();
        document.getElementById('u_id').value = user_array[i][0];
        document.getElementById('fio').value = user_array[i][1];
        document.getElementById('born_date').value = user_array[i][2];
      }
    }
  };

</script>
  </body>
</html>

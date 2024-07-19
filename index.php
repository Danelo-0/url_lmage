<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Главная</title>
</head>
<body>
   <!-- https://wallpaperio.net/category/4k-oboi - без https: (использовать этот url)
   https://yandex.ru/images/?source=tabbar&lr=55&redircnt=1721373155.1/ - добавить к src https: -->
   <form action="result.php" method="POST">
      <p><input required type="url" name="url" size="80"></p>
      <input type="submit" name="done" value="Го">
   </form>
</body>
</html>

<?php

//$filename = "https://809620.selcdn.ru/wallpaperio-net/wallpapers/thumbnails/77994416187d25ac0305ae70e93ab4a6.jpg";

//$size = filesize($filename) / 1024 / 1024;

//$headers = get_headers($filename, 1) ;

//$size = $headers['Content-Length'] / 1024 / 1024;

//echo "<div>{$size}</div>"
 ?>
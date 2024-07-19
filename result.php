<?php

error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $url = $_POST['url'];

    /*$options = [
      "http" => [
          "header" => "User-Agent:MyAgent/1.0\r\n"
      ]
   ];

   $context = stream_context_create($options);*/

   $content = file_get_contents($url);

    if ($content === FALSE) {
        echo "Не удалось получить содержимое страницы";
        exit;
    }

    $doc = new DOMDocument();
    $doc->loadHTML($content);
    $images = $doc->getElementsByTagName('img');

    //var_dump($images);
    
    $imageData = [];
    $totalSize = 0;

    foreach ($images as $img) {
        $src = $img->getAttribute('src');
        
        // Если к src нужно добавить hhttps: (добавить регулярку)
        //$src = "https:" . $src;

        $imageSize = getSizeImg($src);
        if ($imageSize !== false) {
            $imageData[] = ['src' => $src];
            $totalSize += $imageSize;
        }
    }

    $totalSize = $totalSize / (1024 * 1024);
}

function getSizeImg($url)
{
    $headers = get_headers($url, 1);
    if (isset($headers['Content-Length'])) {
        return (int)$headers['Content-Length'];
    }

   return false;  
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат</title>
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .image-grid img {
            width: 80%;
            height: auto;
        }
        .result {
         font-size: 24pt;
        }
    </style>
</head>
<body>
    <h1>Результат</h1>
    <div class = "image-grid">
        <?php foreach ($imageData as $data): ?>
            <div>
                <img src="<?php echo htmlspecialchars($data['src']); ?>" alt="Картинки нет">
            </div>
        <?php endforeach; ?>
    </div>
    <div class = "result"><p>На странице обнаружено <?php echo count($imageData); ?> изображений на <?php echo round($totalSize, 2); ?> МБ</p></div>
</body>
</html>
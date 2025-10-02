<?php  

    require __DIR__ . '/vendor/autoload.php';
    USE Cocur\Slugify\Slugify;

    $slugify = new Slugify();
    echo $slugify->slugify("The sky is blue, and the grass is green!!!");

   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <button>Submit</button>
</body>
</html>
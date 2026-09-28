<?php 
    $idade = 18;
    $resultado ="";

    if ($idade >= 18)
    {
        $resultado ="18";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Idade</title>
</head>
<body>
    <form>
        <label for="idade">
        <input type="number"> <?=  $resultado?>
        </label>
    </form>
</body>
</html>
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
    <link rel="stylesheet" href="idade.css">
    <title>idade</title>
</head>
<body>
<header>
        <nav>
            <a href=" index.php">inicio</a>
            <a href="cadastro.php">cadastro</a>
        </nav> 
    
</header>
</body>

<main>
    <section class="cadastro">
    </h1>cadastro</h1>
    <form>
        <label> name :</label>
        <input type="text">
        <label> idade</label>
        <input type="number">

        <button type="submit"> cadastro</button> 
    </form>
</section>
</main>
</html>
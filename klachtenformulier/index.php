<?php
session_start();

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

if (array_key_exists('error_reporting', $_SESSION)) {
    echo '<script>alert("' . $_SESSION['error_reporting']['status'] . ' | ' . $_SESSION['error_reporting']['message'] . '")</script>';
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet" type="text/css" defer>
    <script src="index.js" defer></script>
    <title>klachtenformulier - opdracht 3b/3c</title>
</head>

<body onload="init()">
    <main>
        <h1>Klachtenformulier</h1>
        <div class="formDiv">
            <form method="POST" action="./process.php">
                <?php
                if (array_key_exists('formData', $_SESSION) && !empty($_SESSION['formData'])) {
                    echo '
                    <label for="name">Name:</label>
                    <input class="name" type="text" name="name" value="' . $_SESSION['formData']['name'] . '" required onfocusout="notFocused()">
                    <label for="emailaddress">Emailaddress:</label>
                    <input class="emailaddress" type="text" name="emailaddress" value="' . $_SESSION['formData']['emailaddress'] . '" required onfocusout="notFocused()">
                    <label for="description">Description:</label>
                    <textarea name="description" fixed size>' . $_SESSION['formData']['description'] . '</textarea>
                    ';
                } else {
                    echo '
                    <label for="name">Name:</label>
                    <input class="name" type="text" name="name" required onfocusout="notFocused()">
                    <label for="emailaddress">Emailaddress:</label>
                    <input class="emailaddress" type="text" name="emailaddress" required onfocusout="notFocused()">
                    <label for="description">Description:</label>
                    <textarea name="description" fixed size></textarea>
                    ';
                }
                ?>
                <div class="buttonSection">
                    <button type="submit" name="submit">submit</button>
                    <?php
                    if (file_exists('./info.log')) {
                        echo '<a href="./info.log" target="_blank">view logs</a>';
                    } else {
                        echo '<script>console.log("\"info.log\" file not found!");</script>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
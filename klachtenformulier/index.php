<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet" type="text/css">
    <title>klachtenformulier - opdracht 3b</title>
</head>

<body>
    <main>
        <h1>Klachtenformulier</h1>
        <div class="formDiv">
            <form method="POST" action="../src/process.php">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
                <label for="emailadres">Emailadres:</label>
                <input type="text" name="emailadres" required>
                <label for="describtion">Describtion:</label>
                <textarea name="describtion" fixed size></textarea>
                <button type="submit" name="submit">submit</button>
            </form>
        </div>
    </main>
</body>

</html>
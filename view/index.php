<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Lottery number generator</title>
    <link rel="stylesheet" href="../style/style.css"/>
    <meta charset="UTF-8"/>
</head>
<body>

<h1>Lottery</h1>
<div class="form-center">
    <form action="../view/Lottery.php" method="POST">
        <label for="lottery">Let's generate numbers:</label>
        <br>
        <select name="lottery" id="lottery">
            <option value="">--- Choose a lottery ---</option>
            <option name="otos" value="otos">Ötöslottó</option>
            <option name="hatos" value="hatos">Hatoslottó</option>
            <option name="euroJackpot" value="euroJackpot">EuroJackpot</option>
        </select>
        <br>
        <input type="submit" name="submit" value="Generate"/>
    </form>
</div>
</body>
</html>
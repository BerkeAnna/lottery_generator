<!DOCTYPE html>
<html>
<head>
    <title>Lottery Number Generator</title>
</head>
<body>
    <h1>Winning Numbers</h1>
    <ul>
        <?php foreach ($winning_numbers as $number): ?>
            <li><?php echo $number; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>


}
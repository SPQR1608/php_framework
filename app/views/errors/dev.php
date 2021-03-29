<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ошибка</title>
</head>
<body>
    <h1>Something went wrong</h1>
    <p><b>Error code:</b> <?=$errno?> </p>
    <p><b>Error message:</b> <?=$errstr?> </p>
    <p><b>Error file:</b> <?=$errfile?> </p>
    <p><b>Error line:</b> <?=$errline?> </p>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="/css/main.css" rel="stylesheet"/>
    <?php \spqr\core\base\View::getMeta();?>
</head>
<body>
<div class="container">
        <ul class="nav nav-pills">
            <li><a href="/">Home</a></li>
            <li><a href="/page/about/">About</a></li>
            <li><a href="/admin/">Admin</a></li>
            <?php /*foreach ($menu as $item): */?><!--
                <li role="presentation"><a href="<?/*= $item['id'] */?>"><?/*= $item['title'] */?></a></li>
            --><?php /*endforeach; */?>
        </ul>
    <h1>Admin panel</h1>
    <?=$content?>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<?php foreach ($scripts as $script) {echo $script;}?>
</body>
</html>
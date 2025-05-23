<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>
        <?
        $boxName = file_get_contents('/island/config/box-name.txt', false, null);
        if ($boxName == null || $boxName == "")
            $boxName = "Island Encoder";
        echo $boxName
        ?>
    </title>
    <link rel="icon" href="/img/favicon.png" type="image/png" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/switch/bootstrap-switch.css" rel="stylesheet">
    <link href="js/confirm/jquery-confirm.min.css" rel="stylesheet" />
    <link href="vendor/slider/css/bootstrap-slider.min.css" rel="stylesheet" />
    <link href="vendor/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="css/my.css" rel="stylesheet">
    <link rel="stylesheet" id="langcss">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/jquery.jsonrpcclient.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/global.js" id="globaljs" defLang="cn"></script>
</head>

<body>

<!DOCTYPE html>
<html lang="en-Zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>itzane | a life-long learner</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/home/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/home/css/misc.css">
    <link rel="stylesheet" href="/home/css/blue-scheme.css">
    <link rel="shortcut icon" href="/home/images/favicon.ico" type="image/x-icon" />
    @yield("css")
</head>
<body>
@include("layouts.nav")
@yield("content")

@include("layouts.footer")
<!-- JavaScripts -->
<script src="/home/js/jquery-1.10.2.min.js"></script>
<script src="/home/js/jquery-migrate-1.2.1.min.js"></script>
<!-- Scripts -->
<script src="/home/js/plugins.js"></script>
<script src="/home/js/min/medigo-custom.min.js"></script>
@yield("script")
</body>
</html>
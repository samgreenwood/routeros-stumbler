
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stumble Kit</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 50px;
        }
        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
    </style>


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Stumble Kit</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Scan</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <h1>Survey for <?=$site->getName()?></h1>
      <table class="table table-bordered-table striped" id="scans-table">
          <thead>
            <tr>
                <th>Site Name</th>
                <th>Best Signal</th>
                <th>Last Signal</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
      </table>
    </div>

</div><!-- /.container -->

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/handlebars.js"></script>
<script type="text/javascript" src="/js/scan.js"></script>


<script id="scan-row-template" type="text/x-handlebars-template">
    <tr id="{{ssid}}">
        <td>{{ssid}}</td>
        <td class="best-signal">{{signal}}</td>
        <td class="last-signal">{{signal}}</td>
    </tr>
</script>
</body>
</html>

<!DOCTYPE html>
<html>
	<head>
		<title>MVC-Framework</title>

		<link rel="stylesheet" href="{url}public/css/bootstrap.css" />
        <link rel="stylesheet" href="{url}public/css/footer.css" />
        <link rel="stylesheet" href="{url}public/css/default.css" />
        <link rel="stylesheet" href="{url}public/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="{url}public/css/jquery-ui.min.css" rel="stylesheet">

        <style id="holderjs-style" type="text/css">
            .holderjs-fluid {font-size:16px;font-weight:bold;text-align:center;font-family:sans-serif;margin:0}
        </style>
        
        <script type="text/javascript" src="{url}public/js/jquery.js"></script>
        <script type="text/javascript" src="{url}public/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="{url}public/js/result.js"></script>
        <script type="text/javascript" src="{url}public/js/default.js"></script>
        <script type="text/javascript" src="{url}public/js/holder.js"></script>
        <script type="text/javascript" src="{url}public/js/bootstrap.js"></script>
        <script type="text/javascript" src="{url}public/js/bbcode-editor.js"></script>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
        {if $js == true}
            {for key=js from=js}
                <script type="text/javascript" src="{url}views/{$js}"></script>
            {endfor}
        {endif}

        {if $css == true}
            {for key=css from=css}
                <link rel="stylesheet" href="{url}views/{$css}" />
            {endfor}
        {endif}
	</head>
	<body>
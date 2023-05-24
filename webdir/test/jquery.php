<?php 

if ($_GET) {
    print_r($_GET);
    exit;
}

?>
<html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        Demo below:
        <br>
        <form method="GET" action="#">
            <input name='basic' value='tag1, tag2 autofocus'>
            <input type="submit">
        </form>
        <script>
            // The DOM element you wish to replace with Tagify
var input = document.querySelector('input[name=basic]');

// initialize Tagify on the above input node reference
new Tagify(input)
        </script>
    </body>
</html>

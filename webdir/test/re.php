<?php 

define("rep", 1);
require '../common.php';
?>
<html>
<body>
<?php

$str = "multi
    line
    string";
echo $str;
echo "<br><br>\n";
$str2 = escape_newlines($str);
echo $str2;
echo "<br><br>\n";
echo nl2br($str);
echo "<br><br>\n";

?>
</body>
</html>

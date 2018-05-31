<html>
<body>
<form enctype="multipart/form-data" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="upfile" type="file" accept="images/*" />
    <input type="submit" value="Send File" />
</form>


<pre>
<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST')  return;
print_r($_FILES);
$fn     = $_FILES['upfile']['name'];
$file   = $_FILES['upfile']['tmp_name'];

file_put_contents('gs://ps-adorama/uploads/' + $fn, file_get_contents($file));
?>
</pre>
</body>
</html>
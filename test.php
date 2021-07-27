<?php 
ob_start();
?>

<h1 style = "text-align:center; color: red;">Je suis un test de Ob</h1>

<?php $content = ob_get_clean();
echo $content;
 
?>

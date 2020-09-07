<?php
$title = 'Page d\'administration du site';
$titre = 'Page d\'administration du site';
ob_start();
?>

<?php
$content = ob_get_clean();
require('views/commons/gabarit.php');
?>




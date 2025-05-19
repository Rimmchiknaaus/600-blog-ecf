<?php
$lang = $args['lang'] ?? ($_SESSION['lang'] ?? 'fr');

if (isset($args['language'])) {
    $language = $args['language'];
} else {
    require $_SERVER['DOCUMENT_ROOT'] . "/view/lang/lang.$lang.php";
}

<?php
require 'lib/site.inc.php';
$view = new ECommerce\Views\AddUserView($site);
if(!$view->protect($site, $user)) {
    header("location: " . $view->getProtectRedirect());
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="user">

    <?php
    echo $view->nav($site);
    echo $view->present();
    echo $view->footer();
    ?>

</div>

</body>
</html>

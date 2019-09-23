<?php
$open = true;
require 'lib/site.inc.php';
$view = new ECommerce\HomeView($site, $user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="mainpage">
    <?php
    echo $view->header($site);
    echo $view->presentSub();
    echo $view->footer();
    ?>
</div>

</body>
</html>

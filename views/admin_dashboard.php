<?php

    if ( ! defined( 'ABSPATH' ) ) die();

?>
<h1>Opciones</h1>
<form action="options.php" method="post">
    <?php

        settings_fields( 'cfya_settings_group' );
        do_settings_sections( 'cfya_plugin' );
        submit_button();

    ?>
</form>

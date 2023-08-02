<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
settings_errors();
?>
<div class="wrap">
    <h1>Cookie Details Settings</h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('cd-setting-section');
        do_settings_sections('cd-setting-section');
        submit_button();
        ?>
    </form>
</div>

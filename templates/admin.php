<div class="wrap">
    <h1>WPCM Plugin</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php settings_fields('wpcm_options_group'); ?>
        <?php do_settings_sections('wpcm_plugin'); ?>
        <?php submit_button(); ?>
    </form>
</div>

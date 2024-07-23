<?php
/**
 * Admin functionality of the plugin.
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/admin
 */
?>

<div class="header-logo">
    <img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/ff_logo_dark.png" alt="ff_logo_dark">
</div>
<div>
    <h1>Plugin Settings</h1>
    <button id="refresh-data-button" class="button button-primary">Refresh Data</button>
</div>
<div class="admin-table">
    <div id="api-response">
        <!-- Data will load here -->
    </div>
</div>


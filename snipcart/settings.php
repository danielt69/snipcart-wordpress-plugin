<?php
/*
Adds the settings page in the admin.
*/

function snipcart_add_admin_menu() {
    add_options_page('Snipcart Settings', 'Snipcart', 'manage_options',
        'snipcart-settings', 'snipcart_display_settings_page');
}

function snipcart_display_settings_page() {
    if (!current_user_can('manage_options')) // TODO necessary?
        wp_die('You do not have sufficient permissions to access this page.');
    $saved = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $api_key = esc_attr($_POST['api-key']);
        update_option('snipcart_api_key', $api_key);
        $saved = true;
    }

    $form = array();
    $form['api-key'] = get_option('snipcart_api_key');

    ?>
    <div class="wrap">
        <?php screen_icon('options-general'); ?>
        <h2>Snipcart Settings</h2>
        <?php if ($saved): ?>
        <div id="setting-error-settings_updated" class="updated settings-error">
            <p>
                <strong>
                    Settings saved.
                </strong>
            </p>
        </div>
        <?php endif; ?>
        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="api-key">
                            API Key
                        </label>
                    </th>
                    <td>
                        <input type="text"
                            name="api-key"
                            id="api-key"
                            class="regular-text"
                            value="<?php echo $form['api-key'] ?>"
                            />
                    </td>
                </tr>
            </table>
            <p>
                <input type="submit"
                    value="Save Changes"
                    class="button-primary"/>
            </p>

        </form>
    </div>
    <?php
}

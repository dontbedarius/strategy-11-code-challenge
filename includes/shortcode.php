<?php
/**
 * Displaying data from the REST API using Shortcode
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/includes
 */
function register_shortcodes() {
    add_shortcode( 'directory_plugin_table', 'shortcode_handler' );
}
add_action( 'init', 'register_shortcodes' );

// Handle Shortcode
function shortcode_handler(){
    // Fetch the data and cache it
    $data = get_cached_data();

    ob_start();
    ?>

   <div id="directory-plugin-table">This is to test the shortcode</div>
    <?php
    return ob_get_clean();
}
/**
 * Fetch and cache the data
 *
 * @return array Data and HTML
 */
function get_cached_data() {
    $transient_key = 'directory_plugin_data';
    $data = get_transient($transient_key);

    if (false === $data) {
        // Fetch data from API
        $response = wp_remote_get('http://api.strategy11.com/wp-json/challenge/v1/1');
        
        if (is_wp_error($response)) {
            $data = array('html' => 'Failed to load data.');
        } else {
            $body = wp_remote_retrieve_body($response);
            $api_data = json_decode($body, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $data = array(
                    'headers' => $api_data['data']['headers'],
                    'rows' => $api_data['data']['rows'],
                    'html' => format_data_as_html($api_data['data'])
                );

                // Cache data for 1 hour
                set_transient($transient_key, $data, HOUR_IN_SECONDS);
            } else {
                $data = array('html' => 'Failed to parse data.');
            }
        }
    }
    
    return $data;
}

// Format API data into HTML
function format_data_as_html($data) {
    $html = '<table>';
    $html .= '<thead><tr>';
    
    foreach ($data['headers'] as $header) {
        $html .= '<th>' . esc_html($header) . '</th>';
    }
    $html .= '</tr></thead><tbody>';
    
    foreach ($data['rows'] as $row) {
        $html .= '<tr>';
        $html .= '<td>' . esc_html($row['id']) . '</td>';
        $html .= '<td>' . esc_html($row['fname']) . '</td>';
        $html .= '<td>' . esc_html($row['lname']) . '</td>';
        $html .= '<td>' . esc_html($row['email']) . '</td>';
        $html .= '<td>' . esc_html(date('Y-m-d', $row['date'])) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';
    
    return $html;
}

// AJAX handler to refresh data
function refresh_data() {
    $data = get_cached_data();
    wp_send_json($data);
}
add_action('wp_ajax_refresh_data', 'refresh_data');
add_action('wp_ajax_nopriv_refresh_data', 'refresh_data');

<?php
/**
 * Ajax functionality of the plugin.
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/admin
 */

// Include WordPress Load
// require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

// Handle AJAX request
function handle_ajax_request() {
    // Check if the user has permission to access this
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array('message' => 'Unauthorized') );
    }

    // Fetch data from the API
    $transient_key = 'directory_plugin_data';
    $data = get_transient($transient_key);

    if ( false === $data ) {
        // Fetch data from API
        $response = wp_remote_get('http://api.strategy11.com/wp-json/challenge/v1/1');

        if ( is_wp_error($response) ) {
            wp_send_json_error( array('message' => 'Failed to load data.') );
        } else {
            $body = wp_remote_retrieve_body($response);
            $api_data = json_decode($body, true);

            if ( json_last_error() === JSON_ERROR_NONE ) {
                $data = array(
                    'success' => true,
                    'title' => isset($api_data['title']) ? $api_data['title'] : '',
                    'headers' => isset($api_data['data']['headers']) ? $api_data['data']['headers'] : array(),
                    'rows' => isset($api_data['data']['rows']) ? $api_data['data']['rows'] : array(),
                    'html' => format_data_as_html($api_data['data'])
                );

                // Cache data for 1 hour
                set_transient($transient_key, $data, HOUR_IN_SECONDS);
            } else {
                wp_send_json_error( array('message' => 'Failed to parse data.') );
            }
        }
    } else {
        // Add 'success' key for consistent response
        $data['success'] = true;
    }

    wp_send_json_success($data);
}
add_action('wp_ajax_refresh_data', 'handle_ajax_request');
add_action('wp_ajax_nopriv_refresh_data', 'handle_ajax_request');

// Function to format data as HTML (same as in your previous implementation)
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
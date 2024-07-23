<?php
/**
 * WP CLI Command To Refresh API Data
 * 
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/includes
 */
if ( defined( 'WP_CLI' ) && WP_CLI ) {

    class Directory_Plugin_CLI {

        // The command to refresh the data
        public function refresh_data( $args, $assoc_args ) {
            $transient_key = 'directory_plugin_data';
            delete_transient( $transient_key );
            $response = wp_remote_get('http://api.strategy11.com/wp-json/challenge/v1/1');

            if ( is_wp_error($response) ) {
                WP_CLI::error( 'Failed to load data from the API.' );
                return;
            }

            $body = wp_remote_retrieve_body($response);
            $api_data = json_decode($body, true);

            if ( json_last_error() === JSON_ERROR_NONE ) {
                $data = array(
                    'headers' => $api_data['data']['headers'],
                    'rows' => $api_data['data']['rows'],
                    'html' => $this->format_data_as_html($api_data['data'])
                );
                set_transient($transient_key, $data, HOUR_IN_SECONDS);

                WP_CLI::success( 'Data successfully refreshed.' );
            } else {
                WP_CLI::error( 'Failed to parse API data.' );
            }
        }

        // Format data as HTML
        private function format_data_as_html($data) {
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
    }

    // Register CLI command
    WP_CLI::add_command( 'directory-plugin refresh-data', array( 'Directory_Plugin_CLI', 'refresh_data' ) );
}
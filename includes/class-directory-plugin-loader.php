<?php

/**
 * Register all actions and filters for the plugin
 * @package    Directory_Plugin
 * @subpackage Directory_Plugin/includes
 */
class Directory_Plugin_Loader{
    protected $actions;

    // Initialize the collections used to maintain the actions
    public function __construct() {
		  $this->actions = array();
	  }

    public function add_action( $hook, $component, $callback) {
      $this->actions[] = array(
          'hook' => $hook,
          'component' => $component,
          'callback' => $callback,
      );
    }

    public function run() {
      foreach ( $this->actions as $action ) {
        add_action( $action['hook'], array( $action['component'], $action['callback'] ));
      }
    }
}
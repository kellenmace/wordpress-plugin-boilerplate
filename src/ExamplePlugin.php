<?php

namespace ExamplePlugin;

use ExamplePlugin\Interfaces\Hookable;

/**
 * Main plugin class.
 */
final class ExamplePlugin {
	/**
	 * Class instances.
	 */
	private $instances = [];

	/**
	 * Main method for running the plugin.
	 */
	public function run() {
		$this->create_instances();
		$this->register_hooks();
	}

	private function create_instances() {
		// $this->instances['project_post_type'] = new PostTypes\ProjectPostType();
	}

	private function register_hooks() {
		foreach ( $this->get_hookable_instances() as $instance ) {
            $instance->register_hooks();
        }
	}

	private function get_hookable_instances() {
        return array_filter( $this->instances, fn( $instance ) => $instance instanceof Hookable );
    }
}

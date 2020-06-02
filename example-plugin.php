<?php
/**
 * Plugin Name: Example Plugin
 * Description: Example Plugin core plugin.
 * Version:     0.1.0
 * Author:      Kellen Mace
 * Author URI:  https://kellenmace.com/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

add_action( 'plugins_loaded', function() {
    $autoload = plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

    $dependencies = [
        'Composer autoload files' => is_readable( $autoload ),
        // 'WPGraphQL' => class_exists('WPGraphQL'),
    ];

    $missing_dependencies = array_keys( array_diff( $dependencies, array_filter( $dependencies ) ) );

    $display_admin_notice = function() use ( $missing_dependencies ) {
        ?>
        <div class="notice notice-error">
            <p>The Example Plugin core plugin can't be loaded because these dependencies are missing:</p>
            <ul>
                <?php foreach ( $missing_dependencies as $missing_dependency ) : ?>
                    <li><?php echo esc_html( $missing_dependency ); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    };

    // If dependencies are missing, display admin notice and return early.
    if ( $missing_dependencies ) {
        add_action( 'network_admin_notices', $display_admin_notice ); // Needed for multisite ony.
        add_action( 'admin_notices', $display_admin_notice );

        return;
    }

    // Optional:
    // define( 'EXAMPLE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
    // define( 'EXAMPLE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

    require_once $autoload;

    ( new ExamplePlugin\ExamplePlugin() )->run();
} );
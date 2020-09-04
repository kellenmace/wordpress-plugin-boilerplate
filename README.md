# WordPress Plugin Boilerplate

Boilerplate for scaffolding new WordPress plugins.

- Uses a PSR-4 autoloader.
- Displays a WP admin notice and doesn't run when dependencies are missing.
- Provides a `Hookable` interface that all classes with action/filter hooks can implement.

## Steps to use

1. Clone this repo into your `/plugins` directory
1. Rename the `wordpress-plugin-boilerplate` directory
1. Rename the `example-plugin.php` file
1. Rename the `src/ExamplePlugin.php` file
1. Run a search and replace for these strings: `Example Plugin`, `ExamplePlugin`, `example-plugin`
1. Add your plugin's dependencies to the `$dependencies` array in the main plugin file
1. Run `composer install` from the main plugin directory
1. Run `rm README.md && rm -rf .git` from the main plugin directory to remove the readme and the git repo, since you won't need them anymore
1. Activate the plugin

You can then begin creating classes and instantiating them inside of the main plugin class file's `create_instances()` method.

Any classes that implement the `Hookable` interface will have their action/filter hooks registered automatically.

A `src/PostTypes/ProjectPostType.php` file to register a new `project` post type may look like this, for example:

```php
<?php

namespace ExamplePlugin\PostTypes;

use ExamplePlugin\Interfaces\Hookable;

class ProjectPostType implements Hookable {
    const KEY = 'project';

    public function register_hooks() {
        add_action( 'init', [ $this, 'register' ] );
    }

    public function register() {
        register_post_type( self::KEY, [
          'public' => true,
          'labels' => [
            'name'          => _x( 'Projects', 'Post type general name', 'example-plugin' ),
            'singular_name' => _x( 'Project', 'Post type singular name', 'example-plugin' ),
            'menu_name'     => _x( 'Projects', 'Admin Menu text', 'example-plugin' ),
            // ...
          ],
        ] );
    }
}
```

## Minimum Software Requirements

- PHP 7.4+

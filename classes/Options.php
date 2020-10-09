<?php


namespace Kntnt\Form_Shortcode_Deny_Email_Domains;


trait Options {

    // The call `option()` returns an option named as this plugin if it exists
    // and is an array. If it doesn't exists or is not an array, false is
    // returned.
    //
    // The call `option($key)` returns option()[$key] if the key exists.
    // If the $key is null or false or empty or don't exists, false is returned.
    //
    // The call `option($key, $default)` behave as `option($key)` with the
    // change that if the $key is null or false or empty or don't exists,
    // following happens: If $default is a callable, it is called and its
    // return value is returned. Otherwise the $default itself is returned.
    //
    // The call `option($key, $default, $update)` behave as
    // `option($key, $default)` with the change that the returned value is
    // stored if $key is not null nor false nor empty but don't exists and
    // $update == true.
    //
    // The call `option($key, $default, $update, $plugin)` where $plugin is a
    // non-empty string and the plugin directory of Wordpress contains a plugin
    // main file named "$plugin/$plugin.php" and this plugin is active, behaves
    // as if `option($key, $default, $update)` where called on this plugin.
    public static final function option( $key = null, $default = false, $update = false, $plugin = null ) {

        // Return default value if the provided plugin isn't active.
        // Use this plugin if no plugin is provided.
        if ( $plugin ) {
            if ( ! is_plugin_active( "$plugin/$plugin.php" ) ) {
                return self::evaluate( $default );
            }
        }
        else {
            $plugin = Plugin::ns();
        }

        // Get the options of the plugin.
        $opt = get_option( $plugin, null );

        // Return default value if the options isn't an array.
        if ( ! is_array( $opt ) ) {
            return self::evaluate( $default );
        }

        // If key is provided, return it's corresponding value. Return default
        // if the key is missing, and add the default value to options if
        // the update flag is set.
        if ( $key ) {
            if ( ! isset( $opt[ $key ] ) ) {
                $opt[ $key ] = self::evaluate( $default );
                if ( $update ) {
                    update_option( $plugin, $opt );
                }
            }
            return $opt[ $key ];
        }

        return $opt;

    }

    // Saves the `$key` and `$value` as a key/value-pair in an array named
    // as this plugin and stored in as WordPress option.
    public static final function set_option( $key, $value ) {
        $opt = get_option( Plugin::ns(), [] );
        $opt[ $key ] = $value;
        return update_option( Plugin::ns(), $opt );
    }

    // Deletes a key/value-pair, where the key is `$key`, in an array named as
    // this plugin, stored as WordPress option.
    public static final function delete_option( $key ) {
        $opt = get_option( Plugin::ns(), [] );
        if ( isset( $opt[ $key ] ) ) {
            unset( $opt[ $key ] );
            return update_option( Plugin::ns(), $opt );
        }
        return false;
    }

    // Returns $value(...$args) if $value is callable, and $value if it is not
    // callable.
    public static final function evaluate( $value, ...$args ) {
        return is_callable( $value ) ? call_user_func( $value, ...$args ) : $value;
    }

}
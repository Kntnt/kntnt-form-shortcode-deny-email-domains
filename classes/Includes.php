<?php


namespace Kntnt\Form_Shortcode_Deny_Email_Domains;


trait Includes {

    // Returns the absolute path to the file with the path `$file` relative
    // the plugin's includes directory to a file.
    public static final function path_to_include_file( $include_file ) {
        return Plugin::plugin_dir( "includes/$include_file" );
    }

    // Import the file with the absolute path `$template_file`. If the file
    // contains PHP-code, it is evaluated in a context where the each element
    // of associative array `$template_variables` is converted into a variable
    // with the name and value of the elements key and value, respectively. The
    // resulting content is included at the point of execution of this function
    // if  `$return_template_as_string` is false (default), otherwise returned
    // as a string.
    /** @noinspection PhpInconsistentReturnPointsInspection */
    public static final function load_from_includes( $include_file, $variables = [], $return_as_string = false ) {
        extract( $variables, EXTR_SKIP );
        if ( $return_as_string ) {
            ob_start();
        }
        /** @noinspection PhpIncludeInspection */
        require self::path_to_include_file( $include_file );
        if ( $return_as_string ) {
            return ob_get_clean();
        }
    }

}
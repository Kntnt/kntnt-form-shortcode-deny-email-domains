<?php


namespace Kntnt\Form_Shortcode_Deny_Email_Domains;


class Plugin extends Abstract_Plugin {

    use Logger;
    use Options;
    use Includes;

    public function classes_to_load() {
        return [
            'public' => [
                'plugins_loaded' => [
                    'Form_Extender',
                    'Post_Handler',
                ],
            ],
            'admin' => [
                'init' => [
                    'Settings',
                ],
            ],
        ];
    }

    protected static function dependencies() { return [ 'kntnt-form-shortcode/kntnt-form-shortcode.php' => 'Kntnt Form Shortcode' ]; }

}

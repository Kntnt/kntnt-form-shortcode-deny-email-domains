<?php


namespace Kntnt\Form_Shortcode_Deny_Email_Domains;


class Settings extends Abstract_Settings {

    protected function menu_title() {
        return __( 'KFS Deny Email Domains', 'kntnt-form-shortcode-deny-email-domains' );
    }

    protected function fields() {

        $fields['domains'] = [
            'type' => 'text area',
            'label' => __( "Email domain deny list", 'kntnt-form-shortcode-deny-email-domains' ),
            'description' => __( 'List line by line email domains to be blocked.', 'kntnt-form-shortcode-deny-email-domains' ),
            'cols' => 80,
            'rows' => 20,
            'filter-before' => function ( $domains ) { return implode( "\n", $domains ); },
            'filter-after' => function ( $domains ) { return array_map( 'trim', explode( "\n", $domains ) ); },
        ];

        $fields['submit'] = [
            'type' => 'submit',
        ];

        return $fields;

    }

}
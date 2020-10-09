<?php


namespace Kntnt\Form_Shortcode_Deny_Email_Domains;


final class Form_Extender {

    private $email_fields = [];

    public function run() {
        add_filter( 'kntnt-form-shortcode-field', [ $this, 'save_id' ], 10, 3 );
        add_filter( 'kntnt-form-shortcode-content-after', [ $this, 'add_ids_as_hidden_fields' ], 10, 2 );
    }

    public function save_id( $form_id, $field_id, $field_type ) {
        if ( 'email' == $field_type ) {
            Plugin::log( '$form_id = %s, $field_id = %s, $field_type = %s', $form_id, $field_id, $field_type );
            $this->email_fields[ $form_id ][] = $field_id;
        }
    }

    public function add_ids_as_hidden_fields( $content, $form_id ) {
        if ( isset( $this->email_fields[ $form_id ] ) ) {
            foreach ( $this->email_fields[ $form_id ] as $field_id => $email_field ) {
                $field = strtr( '<input type="hidden" id="{form-id}-email-fields-{field-id}" name="{form-id}[email-fields][{field-id}]" value="{value}">', [
                    '{form-id}' => $form_id,
                    '{field-id}' => $field_id,
                    '{value}' => $email_field,
                ] );
                $content .= $field;
                Plugin::log( $field );
            }
        }
        return $content;
    }

}
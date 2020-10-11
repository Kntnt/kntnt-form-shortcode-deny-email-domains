<?php /** @noinspection PhpUnused */

namespace Kntnt\Form_Shortcode_Deny_Email_Domains;


final class Post_Handler {

    private $email_fields = [];

    public function run() {
        add_filter( 'kntnt-form-shortcode-post-data', [ $this, 'extract_emails_field' ], 9 );
        add_filter( 'kntnt-form-shortcode-pre-success', [ $this, 'is_success' ], 10, 2 );
    }

    public function extract_emails_field( $form_data ) {
        if ( isset( $form_data['email-fields'] ) ) {
            $this->email_fields = $form_data['email-fields'];
            Plugin::log( '$email_fields = %s', $this->email_fields );
            unset( $form_data['email-fields'] );
        }
        return $form_data;
    }

    public function is_success( $success, $form_data ) {
        foreach ( $this->email_fields as $email_field ) {
            $success = $success && ! $this->is_blocked( $form_data[ $email_field ] );
        }
        return $success;
    }

    private function is_blocked( $email ) {
        if ( false !== filter_var( $email, FILTER_VALIDATE_EMAIL ) && ( $pos = strpos( $email, '@' ) ) !== false ) {
            $domain = strtolower( substr( $email, $pos + 1 ) );
            $is_blocked = in_array( $domain, Plugin::option( 'domains' ) );
            if ( $is_blocked ) {
                Plugin::log( 'Blocking "%s" because the domain "%s" is on the block list.', $email, $domain );
            }
        }
        else {
            $is_blocked = true;
        }
        return $is_blocked;
    }

}
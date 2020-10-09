<?php

spl_autoload_register( function ( $class ) {
    $dn = explode( '-', ucwords( basename( __DIR__ ), '-' ) );
    $ns = array_shift( $dn ) . '\\' . implode( '_', $dn );
    $ns_len = strlen( $ns );
    if ( 0 == substr_compare( $class, $ns, 0, $ns_len ) ) {
        require_once __DIR__ . '/classes/' . substr( $class, $ns_len + 1 ) . '.php';
    }
} );

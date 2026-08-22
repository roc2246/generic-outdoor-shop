<?php
/**
 * ACF Field Name Constants
 *
 * Centralized definitions for ACF field names used throughout the theme.
 * This prevents hard-coded field names from breaking templates if field names change.
 */

// Product Fields
if ( ! defined( 'GENERIC_OUTDOOR_PRODUCT_NAME_FIELD' ) ) {
	define( 'GENERIC_OUTDOOR_PRODUCT_NAME_FIELD', 'product_name' );
}
if ( ! defined( 'GENERIC_OUTDOOR_PRODUCT_PRICE_FIELD' ) ) {
	define( 'GENERIC_OUTDOOR_PRODUCT_PRICE_FIELD', 'price' );
}
if ( ! defined( 'GENERIC_OUTDOOR_PRODUCT_DESCRIPTION_FIELD' ) ) {
	define( 'GENERIC_OUTDOOR_PRODUCT_DESCRIPTION_FIELD', 'product_description' );
}
if ( ! defined( 'GENERIC_OUTDOOR_PRODUCT_RELATED_FIELD' ) ) {
	define( 'GENERIC_OUTDOOR_PRODUCT_RELATED_FIELD', 'related_products' );
}

// Service Fields
if ( ! defined( 'GENERIC_OUTDOOR_SERVICE_NAME_FIELD' ) ) {
	define( 'GENERIC_OUTDOOR_SERVICE_NAME_FIELD', 'service_name' );
}
if ( ! defined( 'GENERIC_OUTDOOR_SERVICE_PRICE_FIELD' ) ) {
	define( 'GENERIC_OUTDOOR_SERVICE_PRICE_FIELD', 'service_price' );
}
if ( ! defined( 'GENERIC_OUTDOOR_SERVICE_DESCRIPTION_FIELD' ) ) {
	define( 'GENERIC_OUTDOOR_SERVICE_DESCRIPTION_FIELD', 'service_description' );
}
if ( ! defined( 'GENERIC_OUTDOOR_SERVICE_RELATED_FIELD' ) ) {
	define( 'GENERIC_OUTDOOR_SERVICE_RELATED_FIELD', 'related_services' );
}

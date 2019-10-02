<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}



// try to make this an array
function jumpseller_settings_init() {
	// register a new setting for "reading" page
	register_setting( 'reading', 'storecode' );
	register_setting( 'reading', 'storetoken' );

	// register a new section in the "reading" page
	add_settings_section(
		'jumpseller_settings_section',
		'Jumpseller Configuration',
		'jumpseller_settings_section_cb',
		'reading'
	);

	// register a new field in the "jumpseller_settings_section" section, inside the "reading" page
	add_settings_field(
		'jumpseller_settings_storecode',
		'Jumpseller storecode',
		'jumpseller_settings_field_storecode',
		'reading',
		'jumpseller_settings_section'
	);

	// register a new field in the "jumpseller_settings_section" section, inside the "reading" page
	add_settings_field(
		'jumpseller_settings_storetoken',
		'Jumpseller storetoken',
		'jumpseller_settings_field_storetoken',
		'reading',
		'jumpseller_settings_section'
	);
}
/**
 * register jumpseller_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'jumpseller_settings_init' );

/**
 * callback functions
 */

// section content cb
function jumpseller_settings_section_cb() {
	echo '<p>This is where you set storecode and storetoken.</p>';
}

// field content cb
function jumpseller_settings_field_storecode() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option( 'storecode' );
	// output the field
	if ( isset( $setting ) ) {
		echo '<input type="text" name="storecode" value=" ' . esc_attr( $setting ) . '">';
	}

}

// field content cb
function jumpseller_settings_field_storetoken() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option( 'storetoken' );
	// output the field
	if ( isset( $setting ) ) {
		echo '<input type="text" name="storetoken" value=" ' . esc_attr( $setting ) . '">';
	}

}


/*
$jumpseller_data_ = jumpseller_data_();
$storecode = $jumpseller_data_["storecode"];
$storetoken = $jumpseller_data_["storetoken"];
*/
$storecode  = get_option( 'storecode' );
$storetoken = get_option( 'storetoken' );



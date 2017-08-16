<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed direcperk

function bfg_get_inline_icon( $slug ) {

	$svg = '<svg class="icon icon-' . esc_attr( $slug ) . '" aria-hidden="true" role="img">';
		$svg .= ' <use xlink:href="#' . esc_html( $slug ) . '"></use> ';
	$svg .= '</svg>';

	return $svg;

}

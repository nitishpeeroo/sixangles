<?php
/**
 * File that does SVG Generation.
 *
 * @package Row Separators
 */

$mainSVGPHPFilename = 'svgs.php';
$savedSVGFilename = '_DEV_separator-template.svg';

// Process the SVG file.
$file = file_get_contents( $savedSVGFilename );

$file = str_replace( "\n", '', $file );
preg_match_all( '#((<g[^>]+>)(.*?)</g>)#', $file, $svgMatches );


$svgs = array();
foreach ( $svgMatches[3] as $key => $svgMatch ) {
	$svg = trim( $svgMatch );
	if ( empty( $svg ) ) {
		continue;
	}

	$svg = preg_replace( '/\s+/', ' ', $svg );
	$svg = str_replace( '<', "\n<", $svg );
	$svg = preg_replace( '/id=(\'|")[^\'"]+(\'|")\s?/', '', $svg );

	$title = $svgMatches[2][ $key ];
	preg_match( '/id=[\'"]([^\'"]+)[\'"]/', $title, $titleMatches );
	$title = $titleMatches[1];

		preg_match_all( '/(\_x..\_)/', $title, $specialMatches );
	foreach ( $specialMatches[1] as $specialMatch ) {
		$title = str_replace( $specialMatch, hex_to_str( trim( $specialMatch, '_x' ) ), $title );
	}
	$title = str_replace( '_', ' ', $title );

	$id = $title;
	$name = '';
	$height = '200';

	if ( stripos( $title, '|' ) != false ) {
		list( $id, $name, $height ) = explode( '|', $title );
	} else {
		continue;
	}
	if ( empty( $name ) ) {
		$name = $id;
	}

	// If there are duplicate layer names, this will show up in the height parameter as a number, get rid of it.
	$height = preg_replace( '/[^0-9].*$/', '', $height );

	$svgs[ $id ] = "
	\$ret['$id'] = array(
		'name' => __( '$name', GAMBIT_ROW_SEPARATORS ),
		'width' => 1600,
		'height' => $height,
		'svg' => '$svg',
	);
";
}

// Sort.
ksort( $svgs );

/**
 * Converts hex to string.
 *
 * @param string $hex - The input, in hexadecimal form.
 * @return string $string - The input, now in alphanumeric string form.
 */
function hex_to_str( $hex ) {
	$string = '';
	for ( $i = 0; $i < strlen( $hex ) -1; $i += 2 ) {
		$string .= chr( hexdec( $hex[ $i ].$hex[ $i + 1 ] ) );
	}
	return $string;
}



/**
 * Save the new PHP contents.
 */
$mainScript = explode( "\n", file_get_contents( $mainSVGPHPFilename ) );

$newFileContents = '';
$waitForEnd = false;
foreach ( $mainScript as $line ) {
	if ( $waitForEnd ) {
		if ( preg_match( '/\/\/ DECOR SVG CODE END/', $line ) ) {
			$waitForEnd = false;
		}
		if ( $waitForEnd ) {
			continue;
		}
	}
	if ( preg_match( '/\/\/ DECOR SVG CODE START/', $line ) ) {
		$waitForEnd = true;
		$newFileContents .= $line . "\n";

		foreach ( $svgs as $svg ) {
			$newFileContents .= $svg;
		}
		continue;
	}
	$newFileContents .= $line . "\n";
}

$mainScript = fopen( $mainSVGPHPFilename, 'w' );
fwrite( $mainScript, $newFileContents );
fclose( $mainScript );

?>

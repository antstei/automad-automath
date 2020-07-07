<?php
/**
 *	Automad Automath
 *
 * 	An automad extension to display beautiful mathematical notations using the KaTeX math typesetting library.
 *
 * 	@author Tobias Antensteiner
 * 	@copyright Copyright (C) 2020 Tobias Antensteiner - <https://tobis.website>
 * 	@license MIT license
 */

namespace Antstei;

defined('AUTOMAD') or die('Direct access not permitted!');

class Automath {


	/**
	 * 	Main function of the extension.
	 *
	 * 	@param array $options
	 * 	@param object $Automad
	 * 	@return string string the output of the extension
	 */

	public function Automath($options, $Automad) {

		// Define some defaults.
		$defaults = array(
			'source' => 'cdn',
			'defer' => False,
			'element' => 'document.body',
			'delimiters' => [['left' => '$$', 'right' => '$$', 'display' => True]],
			'ignoredTags' => ['script', 'noscript', 'style', 'textarea', 'pre', 'code'],
			'ignoredClasses' => [],
			'errorCallback' => 'console.error',
		);

		// Merge defaults with predefined options.
		if (array_key_exists('delimiters', $options)) {
			$options['delimiters'] = json_decode($options['delimiters'], True);
			$options['delimiters'] = array_merge($defaults['delimiters'], $options['delimiters']);
		}

		if (array_key_exists('ignoredTags', $options)) {
			$options['ignoredTags'] = json_decode($options['ignoredTags'], True);
			$options['ignoredTags'] = array_merge($defaults['ignoredTags'], $options['ignoredTags']);
		}

		if (array_key_exists('ignoredClasses', $options)) {
			$options['ignoredClasses'] = json_decode($options['ignoredClasses'], True);
			$options['ignoredClasses'] = array_merge($defaults['ignoredClasses'], $options['ignoredClasses']);
		}

		$options = array_merge($defaults, $options);

		//
		$htmlOutput = '<!-- -->';

		// Source
		switch ($options['source']) {
			case 'cdn':
			default:
				$htmlOutput .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css" integrity="sha384-zB1R0rpPzHqg7Kpt0Aljp8JPLqbXI3bhnPWROx27a9N0Ll6ZP/+DiW/UqRcLbRjq" crossorigin="anonymous">';
				$htmlOutput .= '<script ' . ($options['defer'] ? 'defer ' : '') . 'src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js" integrity="sha384-y23I5Q6l+B6vatafAwxRu/0oK/79VlbSz7Q9aiSZUvyWYIYsd+qj+o24G5ZU2zJz" crossorigin="anonymous"></script>';
				$htmlOutput .= '<script ' . ($options['defer'] ? 'defer ' : '') . 'src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/contrib/auto-render.min.js" integrity="sha384-kWPLUVMOks5AQFrykwIup5lo0m3iMkkHrD0uJ4H5cjeGihAutqP0yW0J6dpFiVkI" crossorigin="anonymous"></script>';
				break;
		}

		// Element
		$htmlOutput .= '<script>document.addEventListener("DOMContentLoaded",function(){renderMathInElement(' . $options['element'] . ',';

		// Delimiters
		$htmlOutput .= '{delimiters:' . json_encode($options['delimiters']) . ',';

		// Ignored tages
		$htmlOutput .= 'ignoredTags:' . json_encode($options['ignoredTags']) . ',';

		// Ignored classes
		$htmlOutput .= 'ignoredClasses:' . json_encode($options['ignoredClasses']) . ',';

		// Error callback
		$htmlOutput .= 'errorCallback:' . $options['errorCallback'];

		$htmlOutput .= '});});</script>';

		return $htmlOutput;
		
	}
}

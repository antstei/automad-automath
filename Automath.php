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

		$htmlOutput = '<strong>Antstei's automath extension is (almost) working :D</strong>';

		return $htmlOutput;
	}


}

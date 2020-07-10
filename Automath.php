<?php
/**
 *	Automad Automath
 *
 * 	An Automad extension to display beautiful mathematical notations using the KaTeX math typesetting library.
 *
 * 	@author Tobias Antensteiner
 * 	@copyright Copyright (C) 2020 Tobias Antensteiner - <https://tobis.website>
 * 	@license MIT License
 */

namespace Antstei;
use Automad\Core as Automad;

defined('AUTOMAD') or die('Direct access not permitted!');

class Automath {

    /**
    * 	Main function to build KaTeX bootstrap code.
    *
    * 	@param array $options
    * 	@param object $Automad
    * 	@return string KaTeX bootstrap code
    */

    public function Automath($options, $Automad) {
        /* Define defaults. */
        $defaults = array(
            // Automath options.
            'source' => 'cdn',
            'defer' => false,
            'includedPageTags' => array(),
            'includedQueryFields' => array('filter', 'search'),

            // Supported KaTeX API options.
            'element' => 'document.body',
            'delimiters' => array(array('left' => '$', 'right' => '$', 'display' => false)),
            'ignoredTags' => array(),
            'ignoredClasses' => array(),
            'errorCallback' => null,
            'preProcess' => null
        );

        /* Create start of KaTeX bootstrap code string. */
        $htmlOutput = '';

        /* Merge predefined defaults of list of page tags to include and of list of query fields to include with validated provided options. */
        // Check if provided list of page tags to include is a valid list.
        if (array_key_exists('includedPageTags', $options)) {
            $includedPageTags = json_decode($options['includedPageTags'], true);
            if (is_array($includedPageTags) and json_last_error() === JSON_ERROR_NONE) {
                $options['includedPageTags'] = array_unique(array_merge($defaults['includedPageTags'], $includedPageTags), SORT_REGULAR);
            } else {
                Automad\Debug::log($options['includedPageTags'], ucfirst(self::getJSONErrorDescription()) . ' occurred while parsing provided list of page tags to include');
                $options['includedPageTags'] = $defaults['includedPageTags'];
            }
        } else {
            $options['includedPageTags'] = $defaults['includedPageTags'];
        }

        // Check if provided list of query strings to include is a valid list.
        if (array_key_exists('includedQueryFields', $options)) {
            $includedQueryFields = json_decode($options['includedQueryFields'], true);
            if (is_array($includedQueryFields) and json_last_error() === JSON_ERROR_NONE) {
                $options['includedQueryFields'] = array_unique(array_merge($defaults['includedQueryFields'], $includedQueryFields), SORT_REGULAR);
            } else {
                Automad\Debug::log($options['includedQueryFields'], ucfirst(self::getJSONErrorDescription()) . ' occurred while parsing provided list of query fields to include');
                $options['includedQueryFields'] = $defaults['includedQueryFields'];
            }
        } else {
            $options['includedQueryFields'] = $defaults['includedQueryFields'];
        }

        /* Check if current page's list of page tags is subset of list of page tags to include or current page's list of query fields is subset of list of query fields to include. */
        if (!empty($options['includedPageTags']) and array_intersect($Automad->Context->get()->tags, $options['includedPageTags']) === array() and
                !empty($options['includedQueryFields']) and array_intersect(array_keys($_GET), $options['includedQueryFields']) === array()) {
            $htmlOutput .= '';
        } else {
            /* Merge remaining not scalar-typed predefined defaults with validated provided options. */

            // Check if provided list of delimiters is a valid list of KaTeX delimiters.
            if (array_key_exists('delimiters', $options)) {
                $delimiters = json_decode($options['delimiters'], true);
                if (is_array($delimiters) and
                        !empty($delimiters) and
                        array_keys($delimiters) === range(0, count($delimiters)-1) and
                        count($delimiters) < 2 ? array_keys($defaults['delimiters'][0]) === array_keys($delimiters[0]) :
                        array_keys($defaults['delimiters'][0]) === array_keys(call_user_func_array('array_intersect_key', $delimiters)) and
                        array_keys($defaults['delimiters'][0]) === array_keys(call_user_func_array('array_merge', $delimiters)) and
                        json_last_error() === JSON_ERROR_NONE) {
                    $options['delimiters'] = array_unique(array_merge($defaults['delimiters'], $delimiters), SORT_REGULAR);
                } else {
                    Automad\Debug::log($options['delimiters'], ucfirst(self::getJSONErrorDescription()) . ' occurred while parsing provided list of delimiters');
                    $options['delimiters'] = $defaults['delimiters'];
                }
            }

            // Check if provided list of tags to ignore is a valid KaTeX list of DOM node types to ignore.
            if (array_key_exists('ignoredTags', $options)) {
                $ignoredTags = json_decode($options['ignoredTags'], true);
                if (is_array($ignoredTags) and !empty($ignoredTags) and json_last_error() === JSON_ERROR_NONE) {
                    $options['ignoredTags'] = array_unique(array_merge($defaults['ignoredTags'], $ignoredTags), SORT_REGULAR);
                } else {
                    Automad\Debug::log($options['ignoredTags'], ucfirst(self::getJSONErrorDescription()) . ' occurred while parsing provided list of DOM node types to ignore');
                    $options['ignoredTags'] = $defaults['ignoredTags'];
                }
            }

            // Check if provided list of classes to ignore is a valid KaTeX list of DOM node class names to ignore.
            if (array_key_exists('ignoredClasses', $options)) {
                $ignoredClasses = json_decode($options['ignoredClasses'], true);
                if (is_array($ignoredClasses) and !empty($ignoredClasses) and json_last_error() === JSON_ERROR_NONE) {
                    $options['ignoredClasses'] = array_unique(array_merge($defaults['ignoredClasses'], $ignoredClasses), SORT_REGULAR);
                } else {
                    Automad\Debug::log($options['ignoredClasses'], ucfirst(self::getJSONErrorDescription()) . ' occurred while parsing provided list of DOM node class names to ignore');
                    $options['ignoredClasses'] = $defaults['ignoredClasses'];
                }
            }

            // Merge remaining scalar-typed predefined defaults with provided options.
            $options = array_merge($defaults, $options);

            /* Build HTML output of KaTeX bootstrap code. */
            $htmlOutput .= '<!-- antstei/automath-chunk start: autogenerated HTML code to display beautiful mathematical notations using the KaTeX math typesetting library. -->';

            // Include KaTeX source.
            switch ($options['source']) {
                case 'cdn':
                default:
                    $htmlOutput .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css" integrity="sha384-zB1R0rpPzHqg7Kpt0Aljp8JPLqbXI3bhnPWROx27a9N0Ll6ZP/+DiW/UqRcLbRjq" crossorigin="anonymous">';
                    $htmlOutput .= '<script ' . ($options['defer'] ? 'defer ' : '') . 'src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js" integrity="sha384-y23I5Q6l+B6vatafAwxRu/0oK/79VlbSz7Q9aiSZUvyWYIYsd+qj+o24G5ZU2zJz" crossorigin="anonymous"></script>';
                    $htmlOutput .= '<script ' . ($options['defer'] ? 'defer ' : '') . 'src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/contrib/auto-render.min.js" integrity="sha384-kWPLUVMOks5AQFrykwIup5lo0m3iMkkHrD0uJ4H5cjeGihAutqP0yW0J6dpFiVkI" crossorigin="anonymous"></script>';
                    break;
            }

            // Supply HTML DOM element.
            $htmlOutput .= '<script>document.addEventListener("DOMContentLoaded",function(){renderMathInElement(' . $options['element'] . ',';

            // Supply delimiters.
            $htmlOutput .= '{delimiters:' . json_encode($options['delimiters']) . ',';

            // Supply list of tags to ignore.
            if (!empty($options['ignoredTags'])) {
                $htmlOutput .= 'ignoredTags:' . json_encode($options['ignoredTags']) . ',';
            }

            // Supply list of classes to ignore.
            if (!empty($options['ignoredClasses'])) {
                $htmlOutput .= 'ignoredClasses:' . json_encode($options['ignoredClasses']) . ',';
            }

            // Supply error callback function.
            if (!is_null($options['errorCallback'])) {
                $htmlOutput .= 'errorCallback:' . $options['errorCallback'];
            }

            // Supply callback function to process math expressions before rendering.
            if (!is_null($options['preProcess'])) {
                $htmlOutput .= 'preProcess:' . $options['preProcess'];
            }

            /* Create end of KaTeX bootstrap code string. */
            $htmlOutput .= '});});</script><!-- antstei/automath-chunk end -->';
            Automad\Debug::log($options, 'Created KaTeX bootstrap code string successfully using the following options');
        }

        return $htmlOutput;
    }

    /**
     * 	Helper function to get human readable error description of the last JSON error.
     *
     * 	@return string JSON error description
     */

    private static function getJSONErrorDescription() {
        switch(json_last_error()) {
            case JSON_ERROR_DEPTH:
                return 'stack depth error';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                return 'state mismatch error';
                break;
            case JSON_ERROR_CTRL_CHAR:
                return 'CTRL character error';
                break;
            case JSON_ERROR_SYNTAX:
                return 'syntax error';
                break;
            case JSON_ERROR_UTF8:
                return 'UTF8 encoding error';
                break;
            default:
                return 'unknown error (' . json_last_error() . ')';
                break;
        }
    }
}

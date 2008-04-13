<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005-2008 Oliver Klee (typo3-coding@oliverklee.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Class 'tx_contactslist_templatehelper' for the 'contactslist' extension
 * (the class is taken from the 'seminars' extension).
 *
 * This utitity class provides some commonly-used functions for handling templates
 * (in addition to all functionality provided by the base classes).
 *
 * This is an abstract class; don't instantiate it.
 *
 * @package		TYPO3
 * @subpackage	tx_contactslist
 *
 * @author	Oliver Klee <typo-coding@oliverklee.de>
 */

require_once(PATH_tslib.'class.tslib_pibase.php');

class tx_contactslist_templatehelper extends tslib_pibase {
	/** all HTML template subparts, using the marker name without ### as keys (e.g. 'MY_MARKER') */
	var $templateCache = array();

	/** list of subpart names that shouldn't be displayed in the detailed view;
	    set a subpart key like '###FIELD_DATE###' and the value to '' to remove that subpart */
	var $subpartsToHide = array();

	/** list of populated markers and their contents (with the keys being the marker names) */
	var $markers = array();

	/** list of the names of all markers (and subparts) of a template */
	var $markerNames;

	/**
	 * Dummy constructor: Does nothing.
	 *
	 * Call $this->init() instead.
	 *
	 * @access public
	 */
	function tx_seminars_templatehelper() {
	}

	/**
	 * Retrieves all subparts from the plugin template and write them to $this->templateCache.
	 *
	 * The subpart names are automatically retrieved from the template file set in $this->conf['templateFile']
	 * (or via flexforms) and are used as array keys. For this, the ### are removed, but the names stay uppercase.
	 *
	 * Example: The subpart ###MY_SUBPART### will be stored with the array key 'MY_SUBPART'.
	 *
	 * Please note that each subpart may only occur once in the template file.
	 *
	 * @access protected
	 */
	function getTemplateCode() {
		/** the whole template file as a string */
		$templateRawCode = $this->cObj->fileResource($this->getConfValue('templateFile'));
		$this->markerNames = $this->findMarkers($templateRawCode);

		$subpartNames = $this->findSubparts($templateRawCode);

		foreach ($subpartNames as $currentSubpartName) {
			$this->templateCache[$currentSubpartName] = $this->cObj->getSubpart($templateRawCode, $currentSubpartName);
		}

		return;
	}

	/**
	 * Finds all subparts within a template.
	 * The subparts must be within HTML comments.
	 *
	 * @param	String		the whole template file as a string
	 *
	 * @return	array		a list of the subpart names (uppercase, without ###, e.g. 'MY_SUBPART')
	 *
	 * @access protected
	 */
	function findSubparts($templateRawCode) {
		$matches = array();
		preg_match_all('/<!-- *(###)([^#]+)(###)/', $templateRawCode, $matches);

		return array_unique($matches[2]);
	}

	/**
	 * Finds all markers within a template.
	 * Note: This also finds subpart names.
	 *
	 * The result is one long string that is easy to process using regular expressions.
	 *
	 * Example: If the markers ###FOO### and ###BAR### are found, the string "#FOO#BAR#" would be returned.
	 *
	 * @param	String		the whole template file as a string
	 *
	 * @return	String		a list of markes as one long string, separated, prefixed and postfixed by '#'
	 *
	 * @access private
	 */
	function findMarkers($templateRawCode) {
		$matches = array();
		preg_match_all('/(###)([^#]+)(###)/', $templateRawCode, $matches);

		$markerNames = array_unique($matches[2]);

		return '#'.implode('#', $markerNames).'#';
	}

	/**
	 * Gets a list of markers with a given prefix.
	 * Example: If the prefix is "WRAPPER" (or "wrapper", case is not relevant), the following array
	 * might be returned: ("WRAPPER_FOO", "WRAPPER_BAR")
	 *
	 * If there are no matches, an empty array is returned.
	 *
	 * The functions <code>findMarkers</code> must be called before this function may be called.
	 *
	 * @param	String	case-insensitive prefix for the marker names to look for
	 *
	 * @return	array	Array of matching marker names
	 *
	 * @access private
	 */
	function getPrefixedMarkers($prefix) {
		$matches = array();
		preg_match_all('/(#)('.strtoupper($prefix).'_[^#]*)#/', $this->markerNames, $matches);

		$result = array_unique($matches[2]);

		return $result;
	}

	/**
	 * Sets a marker's content.
	 *
	 * Example: If the prefix is "field" and the marker name is "one", the marker
	 * "###FIELD_ONE###" will be written.
	 *
	 * If the prefix is empty and the marker name is "one", the marker
	 * "###ONE###" will be written.
	 *
	 * @param	String		the marker's name without the ### signs, case-insensitive, will get uppercased, must not be empty
	 * @param	String		the marker's content, may be empty
	 * @param	String		prefix to the marker name (may be empty, case-insensitive, will get uppercased)
	 *
	 * @access protected
	 */
	function setMarkerContent($markerName, $content, $prefix = '') {
		$this->markers[$this->createMarkerName($markerName, $prefix)] = $content;

		return;
	}

	/**
	 * Takes a comma-separated list of subpart names and writes them to $this->subpartsToHide.
	 * In the process, the names are changed from 'aname' to '###BLA_ANAME###' and used as keys.
	 * The corresponding values in the array are empty strings.
	 *
	 * Example: If the prefix is "field" and the list is "one,two", the array keys
	 * "###FIELD_ONE###" and "###FIELD_TWO###" will be written.
	 *
	 * If the prefix is empty and the list is "one,two", the array keys
	 * "###ONE###" and "###TWO###" will be written.
	 *
	 * @param	String		comma-separated list of at least 1 subpart name to hide (case-insensitive, will get uppercased)
	 * @param	String		prefix to the subpart names (may be empty, case-insensitive, will get uppercased)
	 *
	 * @access protected
	 */
	function readSubpartsToHide($subparts, $prefix = '') {
		$subpartNames = explode(',', $subparts);

		foreach ($subpartNames as $currentSubpartName) {
			$this->subpartsToHide[$this->createMarkerName($currentSubpartName, $prefix)] = '';
		}

		return;
	}

	/**
	 * Creates an uppercase marker (or subpart) name from a given name and an optional prefix.
	 *
	 * Example: If the prefix is "field" and the marker name is "one", the result will be
	 * "###FIELD_ONE###".
	 *
	 * If the prefix is empty and the marker name is "one", the result will be "###ONE###".
	 *
	 * @access private
	 */
	function createMarkerName($markerName, $prefix = '') {
		// if a prefix is provided, uppercase it and separate it with an underscore
		if ($prefix) {
			$prefix = strtoupper($prefix).'_';
		}

		return '###'.$prefix.strtoupper(trim($markerName)).'###';
	}

	/**
	 * Multi substitution function with caching. Wrapper function for cObj->substituteMarkerArrayCached(),
	 * using $this->markers and $this->subparts as defaults.
	 *
	 * During the process, the following happens:
	 * 1. $this->subpartsTohide will be removed
	 * 2. for the other subparts, the subpart marker comments will be removed
	 * 3. markes are replaced with their corresponding contents.
	 *
	 * @param	String		key of the subpart from $this->templateCache, e.g. 'LIST_ITEM' (without the ###)
	 *
	 * @return	String		content stream with the markers replaced
	 *
	 * @access protected
	 */
	function substituteMarkerArrayCached($key) {
		// remove subparts (lines) that will be hidden
		$noHiddenSubparts = $this->cObj->substituteMarkerArrayCached($this->templateCache[$key], array(), $this->subpartsToHide);

		// remove subpart markers by replacing the subparts with just their content
		$noSubpartMarkers = $this->cObj->substituteMarkerArrayCached($noHiddenSubparts, array(), $this->templateCache);

		// replace markers with their content
		return $this->cObj->substituteMarkerArrayCached($noSubpartMarkers, $this->markers);
	}

	/**
	 * Writes all localized labels for the current template into their corresponding template markers.
	 *
	 * For this, the label markers in the template must be prefixed with "LABEL_" (e.g. "###LABEL_FOO###"),
	 * and the corresponding localization entry must have the same key, but lowercased and without the ###
	 * (e.g. "label_foo").
	 *
	 * @access protected
	 */
	function setLabels() {
		$labels = $this->getPrefixedMarkers('label');

		foreach ($labels as $currentLabel) {
			$this->setMarkerContent($currentLabel, $this->pi_getLL(strtolower($currentLabel)));
		}

		return;
	}

	/**
	 * Sets the all CSS classes from TS for the template in $this->markers.
	 * The list of needed CSS classes will be extracted from the template file.
	 *
	 * Classes are set only if they are set via TS, else the marker will be an empty string.
	 *
	 * @access protected
	 */
	function setCSS() {
		$cssEntries = $this->getPrefixedMarkers('class');

		foreach ($cssEntries as $currentCssEntry) {
			$this->setMarkerContent($currentCssEntry, $this->createClassAttribute($this->getConfValue(strtolower($currentCssEntry))));
		}

		return;
	}

	/**
	 * Creates an CSS class attribute. The parameter is the class name.
	 *
	 * Example: If the parameter is 'foo', our extension is named 'bar' and we are in p1,
	 * then the return value is 'class="tx-bar-pi1-foo"'.
	 *
	 * If the parameter is an emtry string, the return value is an empty string as well
	 * (not an attribute with an empty value).
	 *
	 * @param	String	a CSS class name (may be empty)
	 *
	 * @return	String	a CSS class attribute (may be empty)
	 *
	 * @access protected
	 */
	function createClassAttribute($className) {
		return !empty($className) ? $this->pi_classParam($className) : '';
	}

	/**
	 * Gets a value from flexforms or TS setup.
	 * The priority lies on flexforms; if nothing is found there, the value
	 * from TS setup is returned. If there is no field with that name in TS setup,
	 * an empty string is returned.
	 *
	 * @param	String		field name to extract
	 * @param	String		sheet pointer, eg. "sDEF"
	 *
	 * @return	String		the value of the corresponding flexforms or TS setup entry (may be empty)
	 *
	 * @access protected
	 */
	function getConfValue($fieldName, $sheet = 'sDEF') {
		$flexformsValue = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], $fieldName, $sheet);
		$confValue = isset($this->conf[$fieldName]) ? $this->conf[$fieldName] : '';

		return ($flexformsValue) ? $flexformsValue : $confValue;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contactslist/class.tx_contactslist_templatehelper.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/contactslist/class.tx_contactslist_templatehelper.php']);
}

?>

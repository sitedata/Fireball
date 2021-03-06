<?php
namespace cms\system\content\type;

use cms\data\content\Content;

/**
 * Interface for content types.
 * 
 * @author	Jens Krumsieck
 * @copyright	2013 - 2017 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
interface IContentType {
	/**
	 * Returns the formatted output for the given content.
	 *
	 * @param	\cms\data\content\Content	$content
	 * @return	string
	 */
	public function getOutput(Content $content);
	/**
	 * Returns the formatted output for the given content used by sortable lists.
	 *
	 * @param	\cms\data\content\Content	$content
	 * @return	string
	 */
	public function getSortableOutput(Content $content);

	/**
	 * Returns the icon name (with icon prefix) for this content type.
	 * 
	 * @return	string
	 */
	public function getIcon();
	
	/**
	 * Returns a short preview for this content type.
	 *
	 * @param Content $content
	 * @return	string
	 */
	public function getPreview(Content $content);
	
	/**
	 * Returns whether it's currently possible to create a content of this
	 * type.
	 *
	 * @param string $position
	 * @return bool
	 */
	public function isAvailableToAdd($position);

	/**
	 * Reads content type specific parameters.
	 */
	public function readParameters();

	/**
	 * Reads content type specific form parameters.
	 */
	public function readFormParameters();

	/**
	 * Validates the submitted form data. In case of invalid inputs, throw
	 * an instance of '\wcf\system\exception\UserInputException'
	 * @param mixed[] $data
	 */
	public function validate(&$data);

	/**
	 * Returns the template name for the acp forms
	 * 
	 * @return	string
	 */
	public function getFormTemplate();

	/**
	 * Returns the template name for the frontend inline editing forms
	 *
	 * @return	string
	 */
	public function getInlineFormTemplate();
}

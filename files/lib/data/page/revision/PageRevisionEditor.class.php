<?php
namespace cms\data\page\revision;

use wcf\data\DatabaseObjectEditor;

/**
 * Functions to edit a page revision.
 * 
 * @author	Florian Frantzen
 * @copyright	2013 - 2017 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 *
 * @mixin PageRevision
 * @method PageRevision getDecoratedObject()
 */
class PageRevisionEditor extends DatabaseObjectEditor {
	/**
	 * @inheritDoc
	 */
	protected static $baseClass = PageRevision::class;
}

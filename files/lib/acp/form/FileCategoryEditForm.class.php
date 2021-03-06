<?php
namespace cms\acp\form;

use wcf\acp\form\AbstractCategoryEditForm;

/**
 * Shows the file category edit form.
 * 
 * @author	Florian Frantzen
 * @copyright	2013 - 2017 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class FileCategoryEditForm extends AbstractCategoryEditForm {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'fireball.acp.menu.link.fireball.file';

	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['admin.fireball.file.canAddFile'];

	/**
	 * @inheritDoc
	 */
	public $objectTypeName = 'de.codequake.cms.file';
}

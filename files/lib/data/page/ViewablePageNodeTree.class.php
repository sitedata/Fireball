<?php
namespace cms\data\page;

/**
 * Generates a tree of all viewable pages. Pages are considered as viewable
 * when they are set as visible or the current user has the permission to see
 * invisible pages.
 * 
 * @author	Florian Frantzen
 * @copyright	2014 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class ViewablePageNodeTree extends PageNodeTree {
	/**
	 * @see	\cms\data\page\PageNodeTree::isIncluded()
	 */
	protected function isIncluded(PageNode $pageNode) {
		if (!$pageNode->isVisible()) {
			return false;
		}

		return parent::isIncluded($pageNode);
	}
}

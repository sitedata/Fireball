<?php
namespace cms\system\sitemap;

use cms\data\page\PageNodeTree;
use wcf\system\sitemap\ISitemapProvider;
use wcf\system\WCF;

/**
 * @author	Jens Krumsieck
 * @copyright	2014 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class CMSSitemapProvider implements ISitemapProvider {
	/**
	 * @see	\wcf\system\sitemap\ISitemapProvider::getTemplate()
	 */
	public function getTemplate() {
		$nodeList = new PageNodeTree(0);

		// sitemap only supports up to child-child-pages
		$nodeList->setMaxDepth(2);

		WCF::getTPL()->assign(array(
			'pageList' => $nodeList->getIterator()
		));

		return WCF::getTPL()->fetch('cmsSitemap', 'cms');
	}
}

<?php
namespace cms\system;

use cms\page\PagePage;
use wcf\system\application\AbstractApplication;

/**
 * Fireball core.
 * 
 * @author	Jens Krumsieck
 * @copyright	2013 - 2015 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class CMSCore extends AbstractApplication {
	/**
	 * @see \wcf\system\application\AbstractApplication::$primaryController
	 */
	protected $primaryController = PagePage::class;
}

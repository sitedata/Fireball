<?php
namespace cms\system\content\type;

use cms\data\content\Content;
use cms\data\file\File;
use cms\data\file\FileCache;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;

/**
 * @author	Jens Krumsieck
 * @copyright	2013 - 2017 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class FileContentType extends AbstractContentType {
	/**
	 * @inheritDoc
	 */
	protected $icon = 'fa-file';
	
	/**
	 * @inheritDoc
	 */
	protected $previewFields = ['fileID'];

	/**
	 * @inheritDoc
	 */
	public function getOutput(Content $content) {
		$file = FileCache::getInstance()->getFile($content->fileID);

		WCF::getTPL()->assign([
			'file' => $file
		]);

		return parent::getOutput($content);
	}
	
	/**
	 * @inheritDoc
	 */
	public function getPreview(Content $content) {
		$file = FileCache::getInstance()->getFile($content->{$this->previewFields[0]});
		if ($file !== null) return $file->getTitle();
		else return parent::getPreview($content);
	}

	/**
	 * @inheritDoc
	 */
	public function validate(&$data) {
		if (!isset($data['fileID'])) {
			throw new UserInputException('fileID');
		}

		$file = new File($data['fileID']);
		if (!$file->fileID) {
			throw new UserInputException('fileID');
		}
	}

	/**
	 * @param integer $fileID  image id
	 * @return File
	 */
	public function getFile($fileID) {
		return new File($fileID);
	}
}

<?php

namespace cms\system\page\type;
use cms\page\LinkPage;
use wcf\form\AbstractForm;
use wcf\system\exception\UserInputException;
use wcf\util\StringUtil;

/**
 * @author	Florian Gail
 * @copyright	2013 - 2017 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class LinkPageType extends AbstractPageType {
	/**
	 * @inheritdoc
	 */
	public $frontendController = LinkPage::class;

	/**
	 * @inheritdoc
	 */
	public $canHaveContent = false;

	/**
	 * @inheritDoc
	 */
	public $assignValues = [
		'url' => '',
		'delayedRedirect' => 0,
		'redirectMessage' => '',
		'delay' => 5
	];
	
	/**
	 * @inheritDoc
	 */
	public function readFormParameters(AbstractForm $form) {
		$formParameters = parent::readFormParameters($form);
		
		if (isset($_POST['url'])) $this->assignValues['url'] = StringUtil::trim($_POST['url']);
		$this->assignValues['delayedRedirect'] = isset($_POST['delayedRedirect']) ? 1 : 0;
		if (isset($_POST['redirectMessage'])) $this->assignValues['redirectMessage'] = StringUtil::trim($_POST['redirectMessage']);
		if (isset($_POST['delay'])) $this->assignValues['delay'] = intval($_POST['delay']);
		
		return array_merge($formParameters, $this->assignValues);
	}
	
	/**
	 * @inheritDoc
	 */
	public function validate(AbstractForm $form) {
		$specificFormParameters = $form->specificFormParameters;

		if (empty($specificFormParameters['url']))
			throw new UserInputException('url');
		
		if (!empty($specificFormParameters['delayedRedirect']) && empty($specificFormParameters['delay']))
			throw new UserInputException('delay');
	}
	
	/**
	 * @inheritDoc
	 */
	public function getSaveArray() {
		return [
			'data' => [
				'additionalData' => $this->assignValues
			]
		];
	}
	
	/**
	 * @inheritDoc
	 */
	public function readData(AbstractForm $form) {
		$return = parent::readData($form);
		
		if (empty($_POST)) {
			if (!empty($form->page->additionalData['url'])) $return['url'] = $form->page->additionalData['url'];
			if (!empty($form->page->additionalData['delayedRedirect'])) $return['delayedRedirect'] = $form->page->additionalData['delayedRedirect'];
			if (!empty($form->page->additionalData['redirectMessage'])) $return['redirectMessage'] = $form->page->additionalData['redirectMessage'];
			if (!empty($form->page->additionalData['delay'])) $return['delay'] = $form->page->additionalData['delay'];
		}
		
		return $return;
	}
}

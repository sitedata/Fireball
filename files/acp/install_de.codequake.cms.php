<?php
use wcf\data\category\CategoryEditor;
use wcf\data\package\update\server\PackageUpdateServerAction;
use wcf\system\WCF;

/**
 * @author           Jens Krumsieck, Florian Gail
 * @copyright        2013 - 2017 codeQuake
 * @license          GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package          de.codequake.cms
 */
$sql = "UPDATE	wcf" . WCF_N . "_option
	SET	optionValue = ?
	WHERE	optionName = ?";
$optionUpdate = WCF::getDB()->prepareStatement($sql);

// set default page title
if (!defined('PAGE_TITLE') || !PAGE_TITLE) {
	$optionUpdate->execute(['Fireball CMS 3.1', 'page_title']);
}

$sql = "SELECT	objectTypeID
	FROM	wcf" . WCF_N . "_object_type
	WHERE	objectType = ?
		AND definitionID = (
			SELECT	definitionID
			FROM	wcf" . WCF_N . "_object_type_definition
			WHERE	definitionName = ?
		)";
$statement = WCF::getDB()->prepareStatement($sql);
$statement->execute([
	'de.codequake.cms.file',
	'com.woltlab.wcf.category'
]);
$row = $statement->fetchArray();
$categoryObjectTypeID = $row['objectTypeID'];

// create default file category
CategoryEditor::create([
	'objectTypeID' => $categoryObjectTypeID,
	'title' => 'Default Category',
	'time' => TIME_NOW
]);

// add MysteryCode update server
if (isset($this->instruction['attributes']['installupdateserver']) && $this->instruction['attributes']['installupdateserver'] == 1) {
	$serverURL = 'https://update.mysterycode.de/tornado/';
	
	// check if update server already exists
	$sql = "SELECT	packageUpdateServerID
		FROM	wcf" . WCF_N . "_package_update_server
		WHERE	serverURL = ?";
	$statement = WCF::getDB()->prepareStatement($sql);
	$statement->execute([$serverURL]);
	$row = $statement->fetchArray();
	if ($row === false) {
		$objectAction = new PackageUpdateServerAction([], 'create', [
			'data' => [
				'serverURL' => $serverURL
			]
		]);
		$objectAction->executeAction();
	}
}

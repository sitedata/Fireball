<?php
use cms\data\content\ContentEditor;
use cms\data\content\ContentList;
use wcf\data\object\type\ObjectTypeCache;

$multiColumnID = ObjectTypeCache::getInstance()->getObjectTypeIDByName('de.codequake.cms.content.type', 'de.codequake.cms.content.type.columns');

$list = new ContentList();
$list->readObjects();

foreach ($list->getObjects() as $content) {
	$width = array();

	// two columns
	if ($content->getTypeName() == 'de.codequake.cms.content.type.twocolumns') {
		$width = array(
			substr($content->width, 0, 2),
			substr($content->width, 2, 2)
		);
	}
	//three columns
	else if ($content->getTypeName() == 'de.codequake.cms.content.type.threecolumns') {
		$width = array(
			substr($content->width, 0, 2),
			substr($content->width, 2, 2),
			substr($content->width, 4, 2)
		);
	}
	//four columns
	else if ($content->getTypeName() == 'de.codequake.cms.content.type.fourcolumns') {
		$width = array(
			substr($content->width, 0, 2),
			substr($content->width, 2, 2),
			substr($content->width, 4, 2),
			substr($content->width, 6, 2)
		);
	}

	// check if it's a multicolumn type
	if (!empty($width)) {
		$columnData = array('columnData' => $width);
		$update = array(
			'contentTypeID' => $multiColumnID,
			'contentData' => serialize($columnData)
		);
		$editor = new ContentEditor($content);
		$editor->update($update);
	}
}

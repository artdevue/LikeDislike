<?php
/**
 * Resolve creating db tables
 *
 * @package LikeDislike
 * @subpackage build
 */
 
if ($object->xpdo) {
	$modx =& $object->xpdo;
	$modelPath = $modx->getOption('likedislike.core_path',null,$modx->getOption('core_path').'components/likedislike/').'model/';
	$modx->addPackage('likedislike',$modelPath);

	$manager = $modx->getManager();

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
			$manager->createObjectContainer('LikedislikeIpBlock');
			$manager->createObjectContainer('LikedislikeItems');
			$manager->createObjectContainer('LikedislikeVotes');
			$manager->createObjectContainer('ModGoods');
			$manager->createObjectContainer('ModLog');
			$manager->createObjectContainer('ModOrderedGoods');
			$manager->createObjectContainer('ModOrders');
			$manager->createObjectContainer('ModStatus');
			$manager->createObjectContainer('ModWarehouse');
			$manager->createObjectContainer('ModPayment');
			$manager->createObjectContainer('ModGallery');
			$manager->createObjectContainer('ModTags');
			$manager->createObjectContainer('ModKits');
			
			break;
		case xPDOTransport::ACTION_UPGRADE:
			break;
	}
}
return true;

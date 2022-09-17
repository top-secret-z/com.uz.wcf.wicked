<?php
namespace wcf\system\event\listener;
use wcf\system\cache\builder\WickedAvatarCacheBuilder;
use wcf\system\cache\builder\WickedBanCacheBuilder;
use wcf\system\cache\builder\WickedDeletionCacheBuilder;
use wcf\system\cache\builder\WickedDisableCacheBuilder;
use wcf\system\cache\builder\WickedSignatureCacheBuilder;
use wcf\system\event\IEventListener;

/**
 * Listen to user actions for Pillory
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedUserActionListener implements IParameterizedEventListener {
	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName, array &$parameters) {
		if (!MODULE_WICKED) return;
		
		$action = $eventObj->getActionName();
		if ($action == 'ban' || $action == 'unban') {
			WickedBanCacheBuilder::getInstance()->reset();
		}
		
		$action = $eventObj->getActionName();
		if ($action == 'disable' || $action == 'enable') {
			WickedDisableCacheBuilder::getInstance()->reset();
		}
		
		if ($action == 'disableAvatar' || $action == 'enableAvatar') {
			WickedAvatarCacheBuilder::getInstance()->reset();
		}
		
		if ($action == 'disableSignature' || $action == 'enableSignature') {
			WickedSignatureCacheBuilder::getInstance()->reset();
		}
		
		if ($action == 'update') {
			$params = $eventObj->getParameters();
			if (isset($params['data']['quitStarted'])) {
				WickedDeletionCacheBuilder::getInstance()->reset();
			}
			
			if (isset($params['data']['banned'])) {
				WickedBanCacheBuilder::getInstance()->reset();
			}
			
			if (isset($params['data']['disableAvatar'])) {
				WickedAvatarCacheBuilder::getInstance()->reset();
			}
			
			if (isset($params['data']['disableSignature'])) {
				WickedSignatureCacheBuilder::getInstance()->reset();
			}
		}
	}
}

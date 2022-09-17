<?php
namespace wcf\system\event\listener;
use wcf\system\cache\builder\WickedSuspensionCacheBuilder;
use wcf\system\event\IEventListener;

/**
 * Listen to suspension actions for Pillory
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedUserSuspensionListener implements IParameterizedEventListener {
	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName, array &$parameters) {
		if (!MODULE_WICKED) return;
		
		if ($eventObj->getActionName() == 'create' || $eventObj->getActionName() == 'revoke' || $eventObj->getActionName() == 'update') {
			WickedSuspensionCacheBuilder::getInstance()->reset();
		}
	}
}

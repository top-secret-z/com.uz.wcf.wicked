<?php
namespace wcf\system\event\listener;
use wcf\system\cache\builder\WickedWarningCacheBuilder;
use wcf\system\event\IEventListener;

/**
 * Listen to warning actions for Pillory
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedUserWarningListener implements IParameterizedEventListener {
	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName, array &$parameters) {
		if (!MODULE_WICKED) return;
		
		if ($eventObj->getActionName() == 'create' || $eventObj->getActionName() == 'revoke') {
			WickedWarningCacheBuilder::getInstance()->reset();
		}
	}
}

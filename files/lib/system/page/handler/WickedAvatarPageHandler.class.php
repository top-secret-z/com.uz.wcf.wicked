<?php
namespace wcf\system\page\handler;
use wcf\data\page\Page;
use wcf\system\WCF;

/**
 * Menu page handler for the wicked avatar page.
 *
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedAvatarPageHandler extends AbstractMenuPageHandler {
	/**
	 * @inheritDoc
	 */
	public function isVisible($objectID = null) {
		return WCF::getSession()->getPermission('user.wicked.avatar.canView');
	}
}

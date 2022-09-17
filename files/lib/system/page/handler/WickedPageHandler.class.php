<?php
namespace wcf\system\page\handler;
use wcf\data\page\Page;
use wcf\system\WCF;

/**
 * Menu page handler for the wicked overview page.
 *
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedPageHandler extends AbstractMenuPageHandler {
	/**
	 * @inheritDoc
	 */
	public function isVisible($objectID = null) {
		if (WCF::getSession()->getPermission('user.wicked.avatar.canView')) return true;
		if (WCF::getSession()->getPermission('user.wicked.ban.canView')) return true;
		if (WCF::getSession()->getPermission('user.wicked.deletion.canView')) return true;
		if (WCF::getSession()->getPermission('user.wicked.signature.canView')) return true;
		if (WCF::getSession()->getPermission('user.wicked.suspension.canView')) return true;
		if (WCF::getSession()->getPermission('user.wicked.warning.canView')) return true;
		
		return false;
	}
}

<?php
namespace wcf\page;
use wcf\data\user\User;
use wcf\system\cache\builder\WickedAvatarCacheBuilder;
use wcf\system\cache\builder\WickedBanCacheBuilder;
use wcf\system\cache\builder\WickedCoverPhotoCacheBuilder;
use wcf\system\cache\builder\WickedDeletionCacheBuilder;
use wcf\system\cache\builder\WickedDisableCacheBuilder;
use wcf\system\cache\builder\WickedSignatureCacheBuilder;
use wcf\system\cache\builder\WickedSuspensionCacheBuilder;
use wcf\system\cache\builder\WickedWarningCacheBuilder;
use wcf\system\WCF;

/**
 * Shows the wicked overview page.
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedPage extends AbstractPage {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'com.uz.wcf.wicked.Wicked';
	
	/**
	 * @inheritDoc
	 */
	public $neededModules = ['MODULE_WICKED'];
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['user.wicked.avatar.canView','user.wicked.coverPhoto.canView','user.wicked.disable.canView','user.wicked.ban.canView', 'user.wicked.deletion.canView', 'user.wicked.signature.canView', 'user.wicked.suspension.canView', 'user.wicked.warning.canView'];
	
	/**
	 * @inheritDoc
	 */
	public $enableTracking = false;
	
	/**
	 * data
	 */
	
	/**
	 * @inheritDoc
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign([
				'allowSpidersToIndexThisPage' => false,
				'avatars' => WickedAvatarCacheBuilder::getInstance()->getData(),
				'bans' => WickedBanCacheBuilder::getInstance()->getData(),
				'coverPhotos' => WickedCoverPhotoCacheBuilder::getInstance()->getData(),
				'deletions' => WickedDeletionCacheBuilder::getInstance()->getData(),
				'disables' => WickedDisableCacheBuilder::getInstance()->getData(),
				'signatures' => WickedSignatureCacheBuilder::getInstance()->getData(),
				'suspensions' => WickedSuspensionCacheBuilder::getInstance()->getData(),
				'warnings' => WickedWarningCacheBuilder::getInstance()->getData()
		]);
	}
}

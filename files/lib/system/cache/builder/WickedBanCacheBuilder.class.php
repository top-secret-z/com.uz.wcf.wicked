<?php
namespace wcf\system\cache\builder;
use wcf\data\user\UserProfileList;

/**
 * Caches the names of the banned users.
 *
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedBanCacheBuilder extends AbstractCacheBuilder {
	/**
	 * @inheritDoc
	 */
	protected $maxLifetime = 600;
	
	/**
	 * @inheritDoc
	 */
	public function rebuild(array $parameters) {
		$userList = new UserProfileList();
		$userList->getConditionBuilder()->add('user_table.banned = ?', [1]);
		$userList->sqlOrderBy = "user_table.username ASC";
		$userList->readObjects();
		
		return $userList->getObjects();
	}
}

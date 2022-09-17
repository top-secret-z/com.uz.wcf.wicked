<?php
namespace wcf\system\cache\builder;
use wcf\data\user\UserProfile;
use wcf\data\user\infraction\suspension\UserInfractionSuspensionList;
use wcf\system\cache\runtime\UserProfileRuntimeCache;
use wcf\system\WCF;

/**
 * Caches the names of the suspended users.
 *
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedSuspensionCacheBuilder extends AbstractCacheBuilder {
	/**
	 * @inheritDoc
	 */
	protected $maxLifetime = 600;
	
	/**
	 * @inheritDoc
	 */
	public function rebuild(array $parameters) {
		$suspensionList = new UserInfractionSuspensionList();
		$suspensionList->getConditionBuilder()->add('user_infraction_suspension.revoked <> ?', [1]);
		$suspensionList->readObjects();
		$suspensions = $suspensionList->getObjects();
		
		if (empty($suspensions)) return [];
		
		$userIDs = [];
		foreach ($suspensions as $suspension) {
			$userIDs[] = $suspension->userID;
		}
		$users = UserProfileRuntimeCache::getInstance()->getObjects(array_unique($userIDs));
		
		usort($users, function(UserProfile $a, UserProfile $b) {
			return strcmp($a->username, $b->username);
		});
		
		return $users;
	}
}

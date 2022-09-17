<?php
namespace wcf\system\cache\builder;
use wcf\data\user\UserProfile;
use wcf\data\user\infraction\warning\UserInfractionWarningList;
use wcf\system\cache\runtime\UserProfileRuntimeCache;
use wcf\system\WCF;

/**
 * Caches the names of the warned users.
 *
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedWarningCacheBuilder extends AbstractCacheBuilder {
	/**
	 * @inheritDoc
	 */
	protected $maxLifetime = 600;
	
	/**
	 * @inheritDoc
	 */
	public function rebuild(array $parameters) {
		$warningList = new UserInfractionWarningList();
		$warningList->getConditionBuilder()->add('user_infraction_warning.revoked <> ?', [1]);
		$warningList->readObjects();
		$warnings = $warningList->getObjects();
		
		if (empty($warnings)) return [];
		
		$userIDs = [];
		foreach ($warnings as $warning) {
			$userIDs[] = $warning->userID;
		}
		$users = UserProfileRuntimeCache::getInstance()->getObjects(array_unique($userIDs));
		
		usort($users, function(UserProfile $a, UserProfile $b) {
			return strcmp($a->username, $b->username);
		});
		
		return $users;
		}
}

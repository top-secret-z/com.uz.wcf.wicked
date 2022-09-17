<?php
namespace wcf\page;
use wcf\data\user\User;
use wcf\data\user\infraction\suspension\WickedUserInfractionSuspensionList;
use wcf\system\cache\runtime\UserProfileRuntimeCache;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the wicked suspension page.
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedSuspensionPage extends SortablePage {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'com.uz.wcf.wicked.Suspension';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['user.wicked.suspension.canView'];
	
	/**
	 * @inheritDoc
	 */
	public $neededModules = ['MODULE_WICKED'];
	
	/**
	 * @inheritDoc
	 */
	public $itemsPerPage = MEMBERS_LIST_USERS_PER_PAGE;
	
	/**
	 * @inheritDoc
	 */
	public $defaultSortField = 'username';
	
	/**
	 * @inheritDoc
	 */
	public $defaultSortOrder = 'ASC';
	
	/**
	 * username filter
	 */
	public $username = '';
	
	/**
	 * @inheritDoc
	 */
	public $validSortFields = ['username', 'lastActivityTime', 'time', 'expires', 'title'];
	
	/**
	 * @inheritDoc
	 */
	public $objectListClassName = WickedUserInfractionSuspensionList::class;
	
	/**
	 * user data
	 */
	protected $userProfiles = [];
	
	/**
	 * @inheritdoc
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (!empty($_REQUEST['username'])) $this->username = StringUtil::trim($_REQUEST['username']);
	}
	
	/**
	 * @inheritDoc
	 */
	protected function initObjectList() {
		parent::initObjectList();
		
		$this->objectList->getConditionBuilder()->add("user_infraction_suspension.revoked <> ?", [1]);
		
		// filter
		if (!empty($this->username)) {
			$this->objectList->getConditionBuilder()->add('user_table.username LIKE ?', ['%' . $this->username . '%']);
		}
	}
	
	/**
	 * @inheritDoc
	 */
	protected function readObjects() {
		parent::readObjects();
		
		$userIDs = [];
		foreach ($this->objectList as $suspension) {
			if ($suspension->userID) $userIDs[] = $suspension->userID;
		}
		if (!empty($userIDs)) $this->userProfiles = UserProfileRuntimeCache::getInstance()->getObjects(array_unique($userIDs));
	}
	
	/**
	 * @inheritDoc
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign([
				'username' => $this->username,
				'userProfiles' => $this->userProfiles
		]);
	}
}

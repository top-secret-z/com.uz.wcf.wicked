<?php
namespace wcf\page;
use wcf\data\user\User;
use wcf\data\user\infraction\warning\WickedUserInfractionWarningList;
use wcf\system\cache\runtime\UserProfileRuntimeCache;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the wicked warning page.
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedWarningPage extends SortablePage {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'com.uz.wcf.wicked.Warning';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['user.wicked.warning.canView'];
	
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
	 * @inheritDoc
	 */
	public $validSortFields = ['username', 'lastActivityTime', 'judgeID', 'time', 'expires', 'title', 'reason'];
	
	/**
	 * @inheritDoc
	 */
	public $objectListClassName = WickedUserInfractionWarningList::class;
	
	/**
	 * username filter
	 */
	public $username = '';
	
	/**
	 * user data
	 */
	protected $judgeProfiles = [];
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
		
		$this->objectList->getConditionBuilder()->add("user_infraction_warning.revoked <> ?", [1]);
		
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
		
		$userIDs = $judgeIDs = [];
		foreach ($this->objectList as $warning) {
			if ($warning->userID) $userIDs[] = $warning->userID;
			if ($warning->judgeID) $judgeIDs[] = $warning->judgeID;
		}
		if (!empty($userIDs)) $this->userProfiles = UserProfileRuntimeCache::getInstance()->getObjects(array_unique($userIDs));
		if (!empty($judgeIDs)) $this->judgeProfiles = UserProfileRuntimeCache::getInstance()->getObjects(array_unique($judgeIDs));
	}
	
	/**
	 * @inheritDoc
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign([
				'username' => $this->username,
				'userProfiles' => $this->userProfiles,
				'judgeProfiles' => $this->judgeProfiles
		]);
	}
}

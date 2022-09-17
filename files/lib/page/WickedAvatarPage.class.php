<?php
namespace wcf\page;
use wcf\data\user\User;
use wcf\data\user\UserProfileList;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the wicked avatar page.
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedAvatarPage extends SortablePage {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'com.uz.wcf.wicked.Avatar';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['user.wicked.avatar.canView'];
	
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
	public $validSortFields = ['username', 'lastActivityTime', 'disableAvatarExpires', 'disableAvatarReason'];
	
	/**
	 * @inheritDoc
	 */
	public $objectListClassName = UserProfileList::class;
	
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
		
		$this->objectList->getConditionBuilder()->add("user_table.disableAvatar = ?", [1]);
		
		// filter
		if (!empty($this->username)) {
			$this->objectList->getConditionBuilder()->add('user_table.username LIKE ?', ['%' . $this->username . '%']);
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign([
				'username' => $this->username
		]);
	}
}

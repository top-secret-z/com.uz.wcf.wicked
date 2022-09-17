<?php
namespace wcf\page;
use wcf\data\user\User;
use wcf\data\user\UserProfileList;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the wicked deletion page.
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedDeletionPage extends SortablePage {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'com.uz.wcf.wicked.Deletion';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['user.wicked.deletion.canView'];
	
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
	public $validSortFields = ['username', 'lastActivityTime', 'quitStarted'];
	
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
		
		$this->objectList->getConditionBuilder()->add("user_table.quitStarted <> ?", [0]);
		
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
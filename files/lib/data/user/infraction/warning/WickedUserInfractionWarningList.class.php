<?php
namespace wcf\data\user\infraction\warning;
use wcf\system\WCF;

/**
 * Creates the wicked UserInfractionSuspensionList.
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedUserInfractionWarningList extends UserInfractionWarningList {
	/**
	 * Creates a new WickedUserInfractionWarningList object.
	 */
	public function __construct() {
		parent::__construct();
		
		$this->sqlSelects = 'user_table.username, user_table.lastActivityTime';
		$this->sqlJoins = " LEFT JOIN wcf".WCF_N."_user user_table ON (user_table.userID = user_infraction_warning.userID)";
	}
	
	/**
	 * @inheritDoc
	 */
	public function countObjects() {
		$sql = "SELECT	COUNT(*)
				FROM	wcf".WCF_N."_user_infraction_warning user_infraction_warning
				LEFT JOIN wcf".WCF_N."_user user_table ON (user_table.userID = user_infraction_warning.userID)
				".$this->sqlConditionJoins."
				".$this->getConditionBuilder()->__toString();
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute($this->getConditionBuilder()->getParameters());
		
		return $statement->fetchSingleColumn();
	}
}

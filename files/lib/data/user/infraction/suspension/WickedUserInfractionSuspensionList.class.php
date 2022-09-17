<?php
namespace wcf\data\user\infraction\suspension;
use wcf\system\WCF;

/**
 * Creates the wicked UserInfractionSuspensionList.
 * 
 * @author		2017-2022 Zaydowicz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		com.uz.wcf.wicked
 */
class WickedUserInfractionSuspensionList extends UserInfractionSuspensionList {
	/**
	 * Creates a new WickedUserInfractionSuspensionList object.
	 */
	public function __construct() {
		parent::__construct();
		
		$this->sqlSelects = 'user_table.username, infraction_suspension.title';
		$this->sqlJoins = " LEFT JOIN wcf".WCF_N."_user user_table ON (user_table.userID = user_infraction_suspension.userID)
							LEFT JOIN wcf".WCF_N."_infraction_suspension infraction_suspension ON (infraction_suspension.suspensionID = user_infraction_suspension.suspensionID)";
	}
	
	/**
	 * @inheritDoc
	 */
	public function countObjects() {
		$sql = "SELECT	COUNT(*)
				FROM	wcf".WCF_N."_user_infraction_suspension user_infraction_suspension
				LEFT JOIN wcf".WCF_N."_user user_table ON (user_table.userID = user_infraction_suspension.userID)
				LEFT JOIN wcf".WCF_N."_infraction_suspension infraction_suspension ON (infraction_suspension.suspensionID = user_infraction_suspension.suspensionID)
				".$this->sqlConditionJoins."
				".$this->getConditionBuilder()->__toString();
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute($this->getConditionBuilder()->getParameters());
		
		return $statement->fetchSingleColumn();
	}
}

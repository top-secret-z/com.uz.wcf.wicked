<?php

/*
 * Copyright by Udo Zaydowicz.
 * Modified by SoftCreatR.dev.
 *
 * License: http://opensource.org/licenses/lgpl-license.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
namespace wcf\data\user\infraction\suspension;

use wcf\system\WCF;

/**
 * Creates the wicked UserInfractionSuspensionList.
 */
class WickedUserInfractionSuspensionList extends UserInfractionSuspensionList
{
    /**
     * Creates a new WickedUserInfractionSuspensionList object.
     */
    public function __construct()
    {
        parent::__construct();

        $this->sqlSelects = 'user_table.username, infraction_suspension.title';
        $this->sqlJoins = " LEFT JOIN wcf" . WCF_N . "_user user_table ON (user_table.userID = user_infraction_suspension.userID)
                            LEFT JOIN wcf" . WCF_N . "_infraction_suspension infraction_suspension ON (infraction_suspension.suspensionID = user_infraction_suspension.suspensionID)";
    }

    /**
     * @inheritDoc
     */
    public function countObjects()
    {
        $sql = "SELECT    COUNT(*)
                FROM    wcf" . WCF_N . "_user_infraction_suspension user_infraction_suspension
                LEFT JOIN wcf" . WCF_N . "_user user_table ON (user_table.userID = user_infraction_suspension.userID)
                LEFT JOIN wcf" . WCF_N . "_infraction_suspension infraction_suspension ON (infraction_suspension.suspensionID = user_infraction_suspension.suspensionID)
                " . $this->sqlConditionJoins . "
                " . $this->getConditionBuilder()->__toString();
        $statement = WCF::getDB()->prepareStatement($sql);
        $statement->execute($this->getConditionBuilder()->getParameters());

        return $statement->fetchSingleColumn();
    }
}

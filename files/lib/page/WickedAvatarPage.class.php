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
namespace wcf\page;

use wcf\data\user\UserProfileList;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the wicked avatar page.
 */
class WickedAvatarPage extends SortablePage
{
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
    public function readParameters()
    {
        parent::readParameters();

        if (!empty($_REQUEST['username'])) {
            $this->username = StringUtil::trim($_REQUEST['username']);
        }
    }

    /**
     * @inheritDoc
     */
    protected function initObjectList()
    {
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
    public function assignVariables()
    {
        parent::assignVariables();

        WCF::getTPL()->assign([
            'username' => $this->username,
        ]);
    }
}

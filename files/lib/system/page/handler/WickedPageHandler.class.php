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
namespace wcf\system\page\handler;

use wcf\data\page\Page;
use wcf\system\WCF;

/**
 * Menu page handler for the wicked overview page.
 */
class WickedPageHandler extends AbstractMenuPageHandler
{
    /**
     * @inheritDoc
     */
    public function isVisible($objectID = null)
    {
        if (WCF::getSession()->getPermission('user.wicked.avatar.canView')) {
            return true;
        }
        if (WCF::getSession()->getPermission('user.wicked.ban.canView')) {
            return true;
        }
        if (WCF::getSession()->getPermission('user.wicked.deletion.canView')) {
            return true;
        }
        if (WCF::getSession()->getPermission('user.wicked.signature.canView')) {
            return true;
        }
        if (WCF::getSession()->getPermission('user.wicked.suspension.canView')) {
            return true;
        }
        if (WCF::getSession()->getPermission('user.wicked.warning.canView')) {
            return true;
        }

        return false;
    }
}

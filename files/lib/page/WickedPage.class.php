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

use wcf\system\cache\builder\WickedAvatarCacheBuilder;
use wcf\system\cache\builder\WickedBanCacheBuilder;
use wcf\system\cache\builder\WickedCoverPhotoCacheBuilder;
use wcf\system\cache\builder\WickedDeletionCacheBuilder;
use wcf\system\cache\builder\WickedDisableCacheBuilder;
use wcf\system\cache\builder\WickedSignatureCacheBuilder;
use wcf\system\cache\builder\WickedSuspensionCacheBuilder;
use wcf\system\cache\builder\WickedWarningCacheBuilder;
use wcf\system\WCF;

/**
 * Shows the wicked overview page.
 */
class WickedPage extends AbstractPage
{
    /**
     * @inheritDoc
     */
    public $activeMenuItem = 'com.uz.wcf.wicked.Wicked';

    /**
     * @inheritDoc
     */
    public $neededModules = ['MODULE_WICKED'];

    /**
     * @inheritDoc
     */
    public $neededPermissions = ['user.wicked.avatar.canView', 'user.wicked.coverPhoto.canView', 'user.wicked.disable.canView', 'user.wicked.ban.canView', 'user.wicked.deletion.canView', 'user.wicked.signature.canView', 'user.wicked.suspension.canView', 'user.wicked.warning.canView'];

    /**
     * @inheritDoc
     */
    public $enableTracking = false;

    /**
     * data
     */

    /**
     * @inheritDoc
     */
    public function assignVariables()
    {
        parent::assignVariables();

        WCF::getTPL()->assign([
            'allowSpidersToIndexThisPage' => false,
            'avatars' => WickedAvatarCacheBuilder::getInstance()->getData(),
            'bans' => WickedBanCacheBuilder::getInstance()->getData(),
            'coverPhotos' => WickedCoverPhotoCacheBuilder::getInstance()->getData(),
            'deletions' => WickedDeletionCacheBuilder::getInstance()->getData(),
            'disables' => WickedDisableCacheBuilder::getInstance()->getData(),
            'signatures' => WickedSignatureCacheBuilder::getInstance()->getData(),
            'suspensions' => WickedSuspensionCacheBuilder::getInstance()->getData(),
            'warnings' => WickedWarningCacheBuilder::getInstance()->getData(),
        ]);
    }
}

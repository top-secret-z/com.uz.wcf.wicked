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
namespace wcf\system\event\listener;

use wcf\system\cache\builder\WickedAvatarCacheBuilder;
use wcf\system\cache\builder\WickedBanCacheBuilder;
use wcf\system\cache\builder\WickedDeletionCacheBuilder;
use wcf\system\cache\builder\WickedDisableCacheBuilder;
use wcf\system\cache\builder\WickedSignatureCacheBuilder;

/**
 * Listen to user actions for Pillory
 */
class WickedUserActionListener implements IParameterizedEventListener
{
    /**
     * @see    wcf\system\event\IEventListener::execute()
     */
    public function execute($eventObj, $className, $eventName, array &$parameters)
    {
        if (!MODULE_WICKED) {
            return;
        }

        $action = $eventObj->getActionName();
        if ($action == 'ban' || $action == 'unban') {
            WickedBanCacheBuilder::getInstance()->reset();
        }

        $action = $eventObj->getActionName();
        if ($action == 'disable' || $action == 'enable') {
            WickedDisableCacheBuilder::getInstance()->reset();
        }

        if ($action == 'disableAvatar' || $action == 'enableAvatar') {
            WickedAvatarCacheBuilder::getInstance()->reset();
        }

        if ($action == 'disableSignature' || $action == 'enableSignature') {
            WickedSignatureCacheBuilder::getInstance()->reset();
        }

        if ($action == 'update') {
            $params = $eventObj->getParameters();
            if (isset($params['data']['quitStarted'])) {
                WickedDeletionCacheBuilder::getInstance()->reset();
            }

            if (isset($params['data']['banned'])) {
                WickedBanCacheBuilder::getInstance()->reset();
            }

            if (isset($params['data']['disableAvatar'])) {
                WickedAvatarCacheBuilder::getInstance()->reset();
            }

            if (isset($params['data']['disableSignature'])) {
                WickedSignatureCacheBuilder::getInstance()->reset();
            }
        }
    }
}

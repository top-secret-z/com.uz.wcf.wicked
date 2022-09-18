{capture assign='sidebarRight'}
    <section class="box">
        <form method="post" action="{link controller=Wicked}{/link}">
            <h2 class="boxTitle">{lang}wcf.wicked.details{/lang}</h2>

            <div class="boxContent">
                <ol class="boxMenu">
                    {if $__wcf->session->getPermission('user.wicked.avatar.canView')}
                        <li><a href="{link controller='WickedAvatar'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.avatars{/lang}</span></a></li>
                    {/if}
                    {if MODULE_USER_COVER_PHOTO && $__wcf->session->getPermission('user.wicked.coverPhoto.canView')}
                        <li><a href="{link controller='WickedCoverPhoto'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.coverPhotos{/lang}</span></a></li>
                    {/if}
                    {if MODULE_USER_SIGNATURE && $__wcf->session->getPermission('user.wicked.signature.canView')}
                        <li><a href="{link controller='WickedSignature'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.signatures{/lang}</span></a></li>
                    {/if}
                    {if $__wcf->session->getPermission('user.wicked.disable.canView')}
                        <li><a href="{link controller='WickedDisable'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.disables{/lang}</span></a></li>
                    {/if}
                    {if $__wcf->session->getPermission('user.wicked.ban.canView')}
                        <li><a href="{link controller='WickedBan'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.bans{/lang}</span></a></li>
                    {/if}
                    {if $__wcf->session->getPermission('user.wicked.deletion.canView')}
                        <li><a href="{link controller='WickedDeletion'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.deletions{/lang}</span></a></li>
                    {/if}
                    {if MODULE_USER_INFRACTION && $__wcf->session->getPermission('user.wicked.warning.canView')}
                        <li><a href="{link controller='WickedWarning'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.warnings{/lang}</span></a></li>
                    {/if}
                    {if MODULE_USER_INFRACTION && $__wcf->session->getPermission('user.wicked.suspension.canView')}
                        <li><a href="{link controller='WickedSuspension'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.suspensions{/lang}</span></a></li>
                    {/if}

                    {event name='moreWickedBox'}
                </ol>
            </div>
        </form>
    </section>
{/capture}

{include file='header'}

{if $__wcf->session->getPermission('user.wicked.avatar.canView')}
    <section class="section">
        <h2 class="sectionTitle">{lang}wcf.wicked.avatars{/lang} <span class="badge">{#$avatars|count}</span></h2>

        {if $avatars|count}
            <ul class="inlineList commaSeparated">
                {foreach from=$avatars item=avatar}
                    <li><a href="{link controller='User' object=$avatar}{/link}" class="userLink" data-user-id="{@$avatar->userID}">{@$avatar->getFormattedUsername()}</a></li>
                {/foreach}
            </ul>
        {else}
            <p>{lang}wcf.wicked.user.none{/lang}</p>
        {/if}
    </section>
{/if}

{if $__wcf->session->getPermission('user.wicked.coverPhoto.canView')}
    <section class="section">
        <h2 class="sectionTitle">{lang}wcf.wicked.coverPhotos{/lang} <span class="badge">{#$coverPhotos|count}</span></h2>

        {if $coverPhotos|count}
            <ul class="inlineList commaSeparated">
                {foreach from=$coverPhotos item=coverPhoto}
                    <li><a href="{link controller='User' object=$coverPhoto}{/link}" class="userLink" data-user-id="{@$coverPhoto->userID}">{@$coverPhoto->getFormattedUsername()}</a></li>
                {/foreach}
            </ul>
        {else}
            <p>{lang}wcf.wicked.user.none{/lang}</p>
        {/if}
    </section>
{/if}

{if MODULE_USER_SIGNATURE && $__wcf->session->getPermission('user.wicked.signature.canView')}
    <section class="section">
        <h2 class="sectionTitle">{lang}wcf.wicked.signatures{/lang} <span class="badge">{#$signatures|count}</span></h2>

        {if $signatures|count}
            <ul class="inlineList commaSeparated">
                {foreach from=$signatures item=signature}
                    <li><a href="{link controller='User' object=$signature}{/link}" class="userLink" data-user-id="{@$signature->userID}">{@$signature->getFormattedUsername()}</a></li>
                {/foreach}
            </ul>
        {else}
            <p>{lang}wcf.wicked.user.none{/lang}</p>
        {/if}
    </section>
{/if}

{if $__wcf->session->getPermission('user.wicked.disable.canView')}
    <section class="section">
        <h2 class="sectionTitle">{lang}wcf.wicked.disables{/lang} <span class="badge">{#$disables|count}</span></h2>

        {if $disables|count}
            <ul class="inlineList commaSeparated">
                {foreach from=$disables item=disable}
                    <li><a href="{link controller='User' object=$disable}{/link}" class="userLink" data-user-id="{@$disable->userID}">{@$disable->getFormattedUsername()}</a></li>
                {/foreach}
            </ul>
        {else}
            <p>{lang}wcf.wicked.user.none{/lang}</p>
        {/if}
    </section>
{/if}

{if $__wcf->session->getPermission('user.wicked.ban.canView')}
    <section class="section">
        <h2 class="sectionTitle">{lang}wcf.wicked.bans{/lang} <span class="badge">{#$bans|count}</span></h2>

        {if $bans|count}
            <ul class="inlineList commaSeparated">
                {foreach from=$bans item=ban}
                    <li><a href="{link controller='User' object=$ban}{/link}" class="userLink" data-user-id="{@$ban->userID}">{@$ban->getFormattedUsername()}</a></li>
                {/foreach}
            </ul>
        {else}
            <p>{lang}wcf.wicked.user.none{/lang}</p>
        {/if}
    </section>
{/if}

{if $__wcf->session->getPermission('user.wicked.deletion.canView')}
    <section class="section">
        <h2 class="sectionTitle">{lang}wcf.wicked.deletions{/lang} <span class="badge">{#$deletions|count}</span></h2>

        {if $deletions|count}
            <ul class="inlineList commaSeparated">
                {foreach from=$deletions item=deletion}
                    <li><a href="{link controller='User' object=$deletion}{/link}" class="userLink" data-user-id="{@$deletion->userID}">{@$deletion->getFormattedUsername()}</a></li>
                {/foreach}
            </ul>
        {else}
            <p>{lang}wcf.wicked.user.none{/lang}</p>
        {/if}
    </section>
{/if}

{if MODULE_USER_INFRACTION && $__wcf->session->getPermission('user.wicked.warning.canView')}
    <section class="section">
        <h2 class="sectionTitle">{lang}wcf.wicked.warnings{/lang} <span class="badge">{#$warnings|count}</span></h2>

        {if $warnings|count}
            <ul class="inlineList commaSeparated">
                {foreach from=$warnings item=warning}
                    <li><a href="{link controller='User' object=$warning}{/link}" class="userLink" data-user-id="{@$warning->userID}">{@$warning->getFormattedUsername()}</a></li>
                {/foreach}
            </ul>
        {else}
            <p>{lang}wcf.wicked.user.none{/lang}</p>
        {/if}
    </section>
{/if}

{if MODULE_USER_INFRACTION && $__wcf->session->getPermission('user.wicked.suspension.canView')}
    <section class="section">
        <h2 class="sectionTitle">{lang}wcf.wicked.suspensions{/lang} <span class="badge">{#$suspensions|count}</span></h2>

        {if $suspensions|count}
            <ul class="inlineList commaSeparated">
                {foreach from=$suspensions item=suspension}
                    <li><a href="{link controller='User' object=$suspension}{/link}" class="userLink" data-user-id="{@$suspension->userID}">{@$suspension->getFormattedUsername()}</a></li>
                {/foreach}
            </ul>
        {else}
            <p>{lang}wcf.wicked.user.none{/lang}</p>
        {/if}
    </section>
{/if}

{event name='moreWickedContent'}

{include file='footer'}

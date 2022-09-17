{capture assign='pageTitle'}{$__wcf->getActivePage()->getTitle()}{if $pageNo > 1} - {lang}wcf.page.pageNo{/lang}{/if}{/capture}

{capture assign='contentTitle'}{lang}{$__wcf->getActivePage()->getTitle()}{/lang} <span class="badge">{#$items}</span>{/capture}

{capture assign='canonicalURLParameters'}sortField={@$sortField}&sortOrder={@$sortOrder}{/capture}

{capture assign='headContent'}
	{if $pageNo < $pages}
		<link rel="next" href="{link controller='WickedWarning'}pageNo={@$pageNo+1}&{@$canonicalURLParameters}{/link}">
	{/if}
	{if $pageNo > 1}
		<link rel="prev" href="{link controller='WickedWarning'}{if $pageNo > 2}pageNo={@$pageNo-1}&{/if}{@$canonicalURLParameters}{/link}">
	{/if}
	<link rel="canonical" href="{link controller='WickedWarning'}{if $pageNo > 1}pageNo={@$pageNo}&{/if}{@$canonicalURLParameters}{/link}">
{/capture}

{capture assign='sidebarRight'}
	<section class="jsOnly box">
		<form method="post" action="{link controller='WickedWarning'}{/link}">
			<h2 class="boxTitle">{lang}wcf.global.filter{/lang}</h2>
			
			<div class="boxContent">
				<dl>
					<dt></dt>
					<dd>
						<input type="text" name="username" class="long" value="{$username}" placeholder="{lang}wcf.user.username{/lang}" autocomplete="off">
					</dd>
				</dl>
			</div>
			
			<div class="formSubmit">
				<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s">
				{csrfToken}
			</div>
		</form>
	</section>
	
	<section class="box">
		<form method="post" action="{link controller=Wicked}{/link}">
			<h2 class="boxTitle">{lang}wcf.wicked.details{/lang}</h2>
			
			<div class="boxContent">
				<ol class="boxMenu">
					<li><a href="{link controller='Wicked'}{/link}" class="boxMenuLink"><span class="boxMenuLinkTitle">{lang}wcf.wicked.overview{/lang}</span></a></li>
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

{hascontent}
	<div class="paginationTop">
		{content}
			{assign var='linkParameters' value=''}
			{if $username}{capture append=linkParameters}&username={@$username|rawurlencode}{/capture}{/if}
			
			{pages print=true assign=pagesLinks controller='WickedWarning' link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder$linkParameters"}
		{/content}
	</div>
{/hascontent}

{if $objects|count}
	<div class="section tabularBox">
		<table class="table">
			<thead>
				<tr>
					<th class="columnUser{if $sortField == 'username'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='WickedWarning'}pageNo={@$pageNo}&sortField=username&sortOrder={if $sortField == 'username' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{@$linkParameters}{/link}">{lang}wcf.user.username{/lang}</a></th>
					<th class="columnLastActivity columnText{if $sortField == 'lastActivityTime'} active {@$sortOrder}{/if}"><a href="{link controller='WickedWarning'}pageNo={@$pageNo}&sortField=lastActivityTime&sortOrder={if $sortField == 'lastActivityTime' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{@$linkParameters}{/link}">{lang}wcf.wicked.lastActivityTime{/lang}</a></th>
					<th class="columnJudgeID columnText{if $sortField == 'judgeID'} active {@$sortOrder}{/if}"><a href="{link controller='WickedWarning'}pageNo={@$pageNo}&sortField=judgeID&sortOrder={if $sortField == 'judgeID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{@$linkParameters}{/link}">{lang}wcf.wicked.judgeID{/lang}</a></th>
					<th class="columnTime columnText{if $sortField == 'time'} active {@$sortOrder}{/if}"><a href="{link controller='WickedWarning'}pageNo={@$pageNo}&sortField=time&sortOrder={if $sortField == 'time' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{@$linkParameters}{/link}">{lang}wcf.wicked.time{/lang}</a></th>
					<th class="columnExpires columnText{if $sortField == 'expires'} active {@$sortOrder}{/if}"><a href="{link controller='WickedWarning'}pageNo={@$pageNo}&sortField=expires&sortOrder={if $sortField == 'expires' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{@$linkParameters}{/link}">{lang}wcf.wicked.expires{/lang}</a></th>
					<th class="columnReason columnText{if $sortField == 'reason'} active {@$sortOrder}{/if}"><a href="{link controller='WickedWarning'}pageNo={@$pageNo}&sortField=reason&sortOrder={if $sortField == 'reason' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{@$linkParameters}{/link}">{lang}wcf.wicked.reason{/lang}</a></th>
					
				</tr>
				
			</thead>
			
			<tbody>
				{foreach from=$objects item=warning}
					{assign var='userProfile' value=$userProfiles[$warning->userID]}
					
					<tr class="statementTableRow">
						<td class="columnIcon columnAvatar">
							<p>{@$userProfile->getAvatar()->getImageTag(48)}</p>
						</td>
						<td class="columnText columnUsername">
							<h3>
								<a href="{link controller='User' object=$userProfile}{/link}" class="userLink" data-user-id="{@$userProfile->userID}">{@$userProfile->getFormattedUsername()}</a>
							</h3>
						</td>
						<td class="columnLastActivity columnText">{if $userProfile->lastActivityTime}{@$userProfile->lastActivityTime|time}{else}-{/if}</td>
						<td class="columnJudgeID columnText">{if $warning->judgeID}{$judgeProfiles[$warning->judgeID]->username}{else}-{/if}</td>
						<td class="columnTime columnText">{if $warning->time}{$warning->time|date}{else}{lang}wcf.wicked.time.no{/lang}{/if}</td>
						<td class="columnExpires columnText">{if $warning->expires}{$warning->expires|date}{else}{lang}wcf.wicked.expires.no{/lang}{/if}</td>
						<td class="columnReason columnText">{$warning->reason}</td>
						
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
{else}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/if}

<footer class="contentFooter">
	{hascontent}
		<div class="paginationBottom">
			{content}{@$pagesLinks}{/content}
		</div>
	{/hascontent}
	
	{hascontent}
		<nav class="contentFooterNavigation">
			<ul>
				{content}{event name='contentFooterNavigation'}{/content}
			</ul>
		</nav>
	{/hascontent}
</footer>

{include file='footer'}

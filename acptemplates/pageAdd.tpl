{capture assign='pageTitle'}{lang}cms.acp.page.{@$action}{/lang}{/capture}
{include file='header'}
{include file='aclPermissions'}
{include file='multipleLanguageInputJavascript' elementIdentifier='title' forceSelection=false}
{include file='multipleLanguageInputJavascript' elementIdentifier='description' forceSelection=false}
{include file='multipleLanguageInputJavascript' elementIdentifier='metaDescription' forceSelection=false}
{include file='multipleLanguageInputJavascript' elementIdentifier='metaKeywords' forceSelection=false}

<script data-relocate="true">
	//<![CDATA[
	$(function() {
			WCF.TabMenu.init();
	});
	//]]>
</script>

{if $pageID|isset}
	{include file='aclPermissionJavaScript' containerID='userPermissionsContainer' categoryName='user.*' objectID=$pageID}
{else}
	{include file='aclPermissionJavaScript' containerID='userPermissionsContainer' categoryName='user.*'}
{/if}

<header class="boxHeadline">
    <h1>{lang}cms.acp.page.{@$action}{/lang}</h1>
</header>

{if $errorField}
<p class="error">{lang}wcf.global.form.error{/lang}</p>
{/if}

{if $success|isset}
<p class="success">{lang}wcf.global.success.{@$action}{/lang}</p>
{/if}

<div class="contentNavigation">
    <nav>
        <ul>
            <li><a href="{link application='cms' controller='PageList'}{/link}" title="{lang}cms.acp.menu.link.cms.page.list{/lang}" class="button"><span class="icon icon24 icon-list"></span> <span>{lang}cms.acp.menu.link.cms.page.list{/lang}</span></a></li>
            {event name='contentNavigationButtons'}
        </ul>
    </nav>
</div>

<form method="post" action="{if $action == 'add'}{link application='cms' controller='PageAdd'}{/link}{else}{link application='cms' controller='PageEdit' id=$pageID}{/link}{/if}">
    <div class="tabMenuContainer" data-active="{$activeTabMenuItem}" data-store="activeTabMenuItem">
		<nav class="tabMenu">
			<ul>
				<li><a href="{@$__wcf->getAnchor('general')}">{lang}wbb.acp.board.category.general{/lang}</a></li>
				<li><a href="{@$__wcf->getAnchor('userPermissions')}">{lang}cms.acp.page.userPermissions{/lang}</a></li>
				{event name='tabMenuTabs'}
			</ul>
		</nav>
			<div id="general" class="container containerPadding tabMenuContent">
				<fieldset>
					<legend>{lang}cms.acp.page.general{/lang}</legend>
					{if $pageList != null}
					<dl {if $errorField == 'parentID'}class="formError"{/if}>
						<dt><label for="parentID">{lang}cms.acp.page.general.parentID{/lang}</label></dt>
						<dd>
							<select id="parentID" name="parentID">
								<option value="0" {if parentID == 0} selected="selected"{/if}>{lang}cms.acp.page.general.parentID.no{/lang}</option>
								{foreach from=$pageList item='item'}
								<option value="{$item->pageID}" {if $item->pageID == $parentID}selected="selected"{/if}>{$item->title|language}</option>
								{/foreach}
							</select>
						</dd>
					</dl>
					{/if}
					<dl {if $errorField == 'title'}class="formError"{/if}>
						<dt><label for="title">{lang}cms.acp.page.general.title{/lang}</label></dt>
						<dd>
							<input type="text" id="title" name="title" value="{$i18nPlainValues['title']}" class="long" required="required" />
							{if $errorField == 'title'}
								<small class="innerError">
									{if $errorType == 'empty'}
									{lang}wcf.global.form.error.empty{/lang}
									{else}
									{lang}cms.acp.page.title.error.{@$errorType}{/lang}
									{/if}
								</small>
							{/if}
						</dd>
					</dl>
					<dl  {if $errorField == 'description'}class="formError"{/if}>
						<dt><label for="description">{lang}cms.acp.page.general.description{/lang}</label></dt>
						<dd>
							<textarea id="description" name="description" rows="5" cols="40" class="long">{$i18nPlainValues['description']}</textarea>
							{if $errorField == 'description'}
								<small class="innerError">
									{lang}cms.acp.page.description.error.{@$errorType}{/lang}
								</small>
							{/if}
						</dd>
					</dl>
				</fieldset>
				<fieldset>
					<legend>{lang}cms.acp.page.meta{/lang}</legend>
					<dl  {if $errorField == 'metaDescription'}class="formError"{/if}>
						<dt><label for="metaDescription">{lang}cms.acp.page.meta.metaDescription{/lang}</label></dt>
						<dd>
							<textarea id="metaDescription" name="metaDescription" rows="5" cols="40" class="long">{$i18nPlainValues['metaDescription']}</textarea>
							{if $errorField == 'metaDescription'}
								<small class="innerError">
									{lang}cms.acp.page.metaDescription.error.{@$errorType}{/lang}
								</small>
							{/if}
						</dd>
					</dl>
					<dl  {if $errorField == 'metaKeywords'}class="formError"{/if}>
						<dt><label for="metaKeywords">{lang}cms.acp.page.meta.metaKeywords{/lang}</label></dt>
						<dd>
							 <input type="text" id="metaKeywords" name="metaKeywords" value="{$i18nPlainValues['metaKeywords']}" class="long" />
							{if $errorField == 'metaKeywords'}
								<small class="innerError">
									{lang}cms.acp.page.metaKeywords.error.{@$errorType}{/lang}
								</small>
							{/if}
						</dd>
					</dl>

					<dl  {if $errorField == 'robots'}class="formError"{/if}>
						<dt><label for="robots">{lang}cms.acp.page.meta.robots{/lang}</label></dt>
						<dd>
							<select id="robots" name="robots">
								<option value="index,follow" {if $robots =="index,follow"}selected="selected"{/if}>{lang}cms.acp.page.meta.robots.indexfollow{/lang}</option>
								<option value="index,nofollow {if $robots =="index,nofollow"}selected="selected"{/if}">{lang}cms.acp.page.meta.robots.indexnofollow{/lang}</option>
								<option value="noindex,follow {if $robots =="noindex,follow"}selected="selected"{/if}">{lang}cms.acp.page.meta.robots.noindexfollow{/lang}</option>
								<option value="noindex,nofollow {if $robots =="noindex,nofollow"}selected="selected"{/if}">{lang}cms.acp.page.meta.robots.noindexnofollow{/lang}</option>
							</select>
						</dd>
					</dl>
				</fieldset>
				<fieldset>
					<legend>{lang}cms.acp.page.optional{/lang}</legend>
					<dl  {if $errorField == 'invisible'}class="formError"{/if}>
						<dt><label for="invisible">{lang}cms.acp.page.optional.invisible{/lang}</label></dt>
						<dd>
							<input type="checkbox" name="invisible" id="invisible" value="1" {if $invisible == 1}checked="checked"{/if} />
						</dd>
					</dl>
					<dl  {if $errorField == 'showOrder'}class="formError"{/if}>
						<dt><label for="showOrder">{lang}cms.acp.page.optional.showOrder{/lang}</label></dt>
						<dd>
							 <input type="text" id="showOrder" name="showOrder" value="{$showOrder}" class="long" />
							{if $errorField == 'showOrder'}
								<small class="innerError">
									{lang}cms.acp.page.showOrder.error.{@$errorType}{/lang}
								</small>
							{/if}
						</dd>
					</dl>
				</fieldset>
				{event name='fieldsets'}
			</div>
			<div id="userPermissions" class="container containerPadding tabMenuContent">
				<fieldset>
					<legend>{lang}cms.acp.page.userPermissions{/lang}</legend>
					<dl id="userPermissionsContainer">
						<dt>{lang}wcf.acl.permissions{/lang}</dt>
						<dd></dd>
					</dl>
				</fieldset>
			</div>
			{event name='tabMenuContents'}
		</div>
			<div class="formSubmit">
				<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s" />
				{@SID_INPUT_TAG}
				<input type="hidden" name="action" value="{@$action}" />
				{if $pageID|isset}<input type="hidden" name="id" value="{@$pageID}" />{/if}
			</div>
			
</form>

{include file='footer'}
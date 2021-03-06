{**
 * Страница вывода ошибок
 *}

{extends 'layouts/layout.base.tpl'}

{block 'layout_options' append}
    {$layoutShowSystemMessages = false}
{/block}

{block 'layout_page_title'}
    {if $aMsgError[0].title}
        {$aLang.error}: <span>{$aMsgError[0].title}</span>
    {/if}
{/block}

{block 'layout_content'}
    <p>{$aMsgError[0].msg}</p>
    <p>
        <a href="javascript:history.go(-1);">{$aLang.site_history_back}</a>, 
        <a href="{router page='/'}">{$aLang.site_go_main}</a>
    </p>
{/block}
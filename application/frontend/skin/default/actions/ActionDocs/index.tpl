{**
 * Главная
 *
 *}

{extends 'layouts/layout.base.tpl'}

{block 'layout_content'}
    <div>
        Версии:
        <ul>
        {foreach $docsVersions as $version}
            <li>
                <a href="{router page='docs'}{$docsType}/{$version}/">{$version}</a>
            </li>
        {/foreach}
        </ul>
    </div>

    <br/>
    <br/>
    <br/>

    <table width="100%">
        <tr valign="top">
            <td>
                {$docsIndex}
            </td>
            <td>
                {$docsContent}
            </td>
        </tr>
    </table>
{/block}
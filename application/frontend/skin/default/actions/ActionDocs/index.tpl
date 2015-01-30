{**
 * Главная
 *
 *}

{extends 'layouts/layout.base.tpl'}

{block 'layout_content'}
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
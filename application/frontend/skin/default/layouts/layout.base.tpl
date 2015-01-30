{**
 * Основной лэйаут
 *
 * @param string  $layoutNavContent         Название навигации
 * @param string  $layoutNavContentPath     Кастомный путь до навигации контента
 * @param string  $layoutShowSystemMessages Кастомный путь до навигации контента
 *}

{extends 'Component@layout.layout'}

{block 'layout_options' append}
    {$layoutShowSystemMessages = $layoutShowSystemMessages|default:true}

    {* Получаем блоки для вывода в сайдбаре *}
    {include 'blocks.tpl' group='right' assign=layoutSidebarBlocks}
    {$layoutSidebarBlocks = trim( $layoutSidebarBlocks )}
{/block}

{block 'layout_head_styles' append}
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
{/block}

{block 'layout_head' append}
    <script>
        ls.lang.load({json var = $aLangJs});
        ls.registry.set({json var = $aVarsJs});
    </script>

    {**
     * Тип сетки сайта
     *}
    {if {Config::Get('view.grid.type')} == 'fluid'}
        <style>
            .grid-role-userbar,
            .grid-role-nav .nav--main,
            .grid-role-header .jumbotron-inner,
            .grid-role-container {
                min-width: {Config::Get('view.grid.fluid_min_width')};
                max-width: {Config::Get('view.grid.fluid_max_width')};
            }
        </style>
    {else}
        <style>
            .grid-role-userbar,
            .grid-role-nav .nav--main,
            .grid-role-header .jumbotron-inner,
            .grid-role-container { width: {Config::Get('view.grid.fixed_width')}; }
        </style>
    {/if}
{/block}

{block 'layout_body'}
    {**
     * Основная навигация
     *}
    <nav class="grid-row grid-role-nav">
        меню
    </nav>


    {**
     * Основной контэйнер
     *}
    <div id="container" class="grid-row grid-role-container {hook run='container_class'} {if ! $layoutSidebarBlocks}no-sidebar{/if}">
        {* Вспомогательный контейнер-обертка *}
        <div class="grid-row grid-role-wrapper" class="{hook run='wrapper_class'}">
            {**
             * Контент
             *}
            <div class="grid-col grid-col-8 grid-role-content" role="main">

                {hook run='content_begin'}

                {* Основной заголовок страницы *}
                {block 'layout_page_title' hide}
                    {* TODO: Временный фикс *}
                    <h2 class="page-header">
                        {$smarty.block.child}
                    </h2>
                    {*include 'components/page-header/page-header.tpl' text="{$smarty.block.child}"*}
                {/block}

                {block 'layout_content_header'}
                    {* Системные сообщения *}
                    {if $layoutShowSystemMessages}
                        {if $aMsgError}
                            {component 'alert' text=$aMsgError mods='error' close=true}
                        {/if}

                        {if $aMsgNotice}
                            {component 'alert' text=$aMsgNotice close=true}
                        {/if}
                    {/if}
                {/block}

                {block 'layout_content'}{/block}

                {hook run='content_end'}
            </div>

            {**
             * Сайдбар
             * Показываем сайдбар только если есть добавленные блоки
             *}
            {if $layoutSidebarBlocks}
                <aside class="grid-col grid-col-4 grid-role-sidebar" role="complementary">
                    {$layoutSidebarBlocks}
                </aside>
            {/if}
        </div> {* /wrapper *}


        {* Подвал *}
        <footer class="grid-row grid-role-footer">
            {block 'layout_footer'}
                {hook run='footer_begin'}
                {hook run='copyright'}
                {hook run='footer_end'}
            {/block}
        </footer>
    </div> {* /container *}

    {**
     * Тулбар
     * Добавление кнопок в тулбар
     *}
    {add_block group='toolbar' name='components/toolbar-scrollup/toolbar.scrollup.tpl' priority=-100}

    {* Подключение тулбара *}
    {component 'toolbar'}
{/block}
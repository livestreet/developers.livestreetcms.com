<?php

/*
 * LiveStreet CMS
 * Copyright © 2013 OOO "ЛС-СОФТ"
 *
 * ------------------------------------------------------
 *
 * Official site: www.livestreetcms.com
 * Contact e-mail: office@livestreetcms.com
 *
 * GNU General Public License, version 2:
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * ------------------------------------------------------
 *
 * @link http://www.livestreetcms.com
 * @copyright 2013 OOO "ЛС-СОФТ"
 * @author Maxim Mzhelskiy <rus.engine@gmail.com>
 *
 */

class ActionDocs extends Action
{
    /**
     * Инициализация
     *
     */
    public function Init()
    {

    }

    /**
     * Регистрация евентов
     *
     */
    protected function RegisterEvent()
    {
        $this->AddEventPreg('/^(framework)|(cms)$/i', '/^([\w]{1,10})?$/i', '/^([\w\-\.]{1,100})?$/i', 'EventDocsRead');
    }

    /**
     * Вывод рейтинговых топиков
     */
    protected function EventDocsRead()
    {
        $sType = $this->sCurrentEvent;
        $sVersion = $this->GetParam(0);
        $sPage = $this->GetParam(1) ?: 'intro';

        /**
         * Проверяем версию
         */
        if (!$sVersion or !$this->Main_CheckAllowDocsVersion($sVersion)) {
            Router::LocationAction("docs/{$sType}/" . Config::Get('app.default_docs_version') . ($sPage ? '/' . $sPage : '/'));
        }
        /**
         * Проверяем страницу
         */
        $sPagePath = Config::Get('path.root.server') . "/resources/docs/{$sVersion}/{$sType}/";
        $sPageContent = $sPagePath . $sPage . '.md';
        if (!$this->Fs_IsExistsFileLocal($sPageContent)) {
            return $this->EventNotFound();
        }
        /**
         * Базовый URL
         */
        $sRootUrl = Config::Get('path.root.web') . '/docs';

        $this->Viewer_Assign('docsContent', $this->Main_ReadDocsContent($sPageContent, $sRootUrl, $sVersion));
        $this->Viewer_Assign('docsIndex',
            $this->Main_ReadDocsContent($sPagePath . 'documentation.md', $sRootUrl, $sVersion));
        $this->Viewer_Assign('docsCurrentVersion', $sVersion);
        $this->Viewer_Assign('docsVersions', Config::Get('app.allow_versions'));
        $this->Viewer_Assign('docsType', $sType);
        /**
         * Устанавливаем шаблон вывода
         */
        $this->SetTemplateAction('index');
    }

    /**
     * Выполняется при завершении экшена (любых эвентов)
     *
     */
    public function EventShutdown()
    {

    }
}
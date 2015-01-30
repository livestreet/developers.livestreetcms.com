<?php

class ModuleMain extends Module
{

    public function Init()
    {

    }

    public function CheckAllowDocsVersion($sVersion)
    {
        return in_array($sVersion, Config::Get('app.allow_versions'));
    }

    public function ParserMarkdown($sText)
    {
        $oParsedown = new Parsedown();
        return $oParsedown->text($sText);
    }

    public function ReadDocsContent($sFile, $sRootUrl, $sVersion)
    {
        return $this->Cache_Remember('docs.content.' . $sFile, function () use ($sFile, $sRootUrl, $sVersion) {

            $sContent = str_replace('{{url}}', $sRootUrl, file_get_contents($sFile));
            $sContent = str_replace('{{version}}', $sVersion, $sContent);
            return $this->ParserMarkdown($sContent);

        }, 60 * 10);
    }
}
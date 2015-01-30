<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

/**
 * !!!!! ВНИМАНИЕ !!!!!
 *
 * Ничего не изменяйте в этом файле!
 * Все изменения нужно вносить в файл config/config.local.php
 */
define('LS_VERSION', '2.0.0');

/**
 * Основные настройки путей
 * Если необходимо установить движек в директорию(не корень сайта) то следует сделать так:
 * $config['path']['root']['web']    = 'http://'.$_SERVER['HTTP_HOST'].'/subdir';
 * и увеличить значение $config['path']['offset_request_url'] на число вложенных директорий,
 * например, для директории первой вложенности www.site.ru/livestreet/ поставить значение равное 1
 */
$config['path']['root']['server'] = dirname(dirname(dirname(__FILE__)));
$config['path']['root']['web'] = isset($_SERVER['HTTP_HOST']) ? 'http://' . $_SERVER['HTTP_HOST'] : null;
$config['path']['offset_request_url'] = 0;


/**
 * Настройки HTML вида
 */
$config['view']['skin'] = 'default';        // Название текущего шаблона
$config['view']['theme'] = 'default';            // тема оформления шаблона (шаблон должен поддерживать темы)
$config['view']['rtl'] = false;
$config['view']['name'] = 'LiveStreet для разработчиков';                   // название сайта
$config['view']['description'] = 'Информационный сайт для разработчиков LiveStreet CMS'; // seo description
$config['view']['keywords'] = 'livestreet, php, develop, документация, помощь, уроки';      // seo keywords

/**
 * Настройки кеширования
 */
$config['sys']['cache']['use'] = false;               // использовать кеширование или нет
$config['sys']['cache']['type'] = 'file';             // тип кеширования: file, xcache и memory. memory использует мемкеш, xcache - использует XCache

// Модуль Security
$config['module']['security']['hash'] = "livestreet_security_key"; // "примесь" к строке, хешируемой в качестве security-кода

// Какие модули должны быть загружены на старте
$config['module']['autoLoad'] = array('Hook', 'Cache', 'Logger', 'Security', 'Session', 'Lang', 'Message');
/**
 * Настройка базы данных
 */
$config['db']['params']['host'] = 'localhost';
$config['db']['params']['port'] = '3306';
$config['db']['params']['user'] = 'root';
$config['db']['params']['pass'] = '';
$config['db']['params']['type'] = 'mysqli';
$config['db']['params']['dbname'] = 'social';
/**
 * Настройка таблиц базы данных
 */
$config['db']['table']['prefix'] = 'prefix_';

//$config['db']['table']['user'] = '___db.table.prefix___user';
$config['db']['tables']['engine'] = 'InnoDB';  // InnoDB или MyISAM

/**
 * Настройки роутинга
 */
$config['router']['rewrite'] = array(

);
// Правила реврайта для REQUEST_URI
$config['router']['uri'] = array(

);
// Распределение action
$config['router']['page']['error'] = 'ActionError';
$config['router']['page']['index'] = 'ActionIndex';
$config['router']['page']['docs'] = 'ActionDocs';
// Глобальные настройки роутинга
$config['router']['config']['default']['action'] = 'index';
$config['router']['config']['default']['event'] = null;
$config['router']['config']['default']['params'] = null;
$config['router']['config']['default']['request'] = null;
$config['router']['config']['action_not_found'] = 'error';
// Принудительное использование https для экшенов. Например, 'login' и 'registration'
$config['router']['force_secure'] = array();

/**
 * Подключение компонентов
 */
$config['components'] = array(
    // Базовые компоненты
    'css-reset', 'css-helpers', 'typography', 'forms', 'grid', 'ls-vendor', 'ls-core', 'ls-component', 'accordion', 'alert', 'dropdown', 'button', 'block',
    'nav', 'tooltip', 'tabs', 'modal', 'table', 'text', 'uploader', 'field', 'pagination', 'editor', 'more', 'crop',
    'perfomance', 'toolbar', 'actionbar', 'page-header', 'progressbar', 'badge', 'autocomplete', 'icon', 'item', 'highlighter', 'jumbotron',

    // Компоненты LS CMS
    'toolbar-scrollup','notification'
);

$config['head']['default']['js'] = array(
    //"___path.skin.web___/components/ls-vendor/html5shiv.js" => array('browser' => 'lt IE 9'),
    //"___path.skin.web___/components/ls-vendor/jquery.placeholder.min.js" => array('browser' => 'lt IE 9'),

    "___path.application.web___/frontend/components/ls-vendor/jquery-1.9.1.min.js",
    "___path.application.web___/frontend/components/ls-vendor/jquery-ui/js/jquery-ui-1.10.2.custom.min.js",

    "//yandex.st/share/share.js" => array('merge' => false),
);

$config['head']['default']['css'] = array();

// Стили для RTL языков
if ( $config['view']['rtl'] ) {
    //$config['head']['default']['css'][] = "___path.skin.web___/components/vote/css/vote-rtl.css";
    //$config['head']['default']['css'][] = "___path.skin.web___/components/alert/css/alert-rtl.css";
}

// Подключение темы
if ( $config['view']['theme'] ) {
    $config['head']['default']['css'][] = "___path.skin.web___/themes/___view.theme___/style.css";
}

/**
 * Установка локали
 */
setlocale(LC_ALL, "ru_RU.UTF-8");
date_default_timezone_set('Europe/Moscow'); // See http://php.net/manual/en/timezones.php

/**
 * Настройки типографа текста Jevix
 * Добавляем к настройках из /framework/config/jevix.php
 */
$config['jevix'] = array_merge_recursive((array)Config::Get('jevix'), require(dirname(__FILE__) . '/jevix.php'));


/**
 * App config
 */
$config['app']['allow_versions']=array('master');
$config['app']['default_docs_version']='master';



return $config;
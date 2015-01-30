/**
 * Инициализации модулей
 *
 * @license   GNU General Public License, version 2
 * @copyright 2013 OOO "ЛС-СОФТ" {@link http://livestreetcms.com}
 * @author    Denis Shakhov <denis.shakhov@gmail.com>
 */

jQuery(document).ready(function($){
	// Хук начала инициализации javascript-составляющих шаблона
	ls.hook.run('ls_template_init_start',[],window);

	$('html').removeClass('no-js');

	/**
	 * Иниц-ия модулей ядра
	 */
	ls.init({
		production: false
	});

	ls.dev.init();


	/**
	 * IE
	 */
	if ( $( 'html' ).hasClass( 'oldie' ) ) {
		// Эмуляция placeholder'ов в IE
		$( 'input[type=text], textarea' ).placeholder();
	}


	/**
	 * Modals
	 */
	$('.js-modal-default').lsModal();


	/**
	 * Accordion
	 */
	$('.js-accordion-default').lsAccordion({
		collapsible: true
	});


	/**
	 * Dropdowns
	 */
	$('.js-dropdown-default').livequery(function () {
		$(this).lsDropdown();
	});


	/**
	 * Tabs
	 */
	$( '.js-tabs-auth, .js-tabs-block' ).lsTabs();


	$('.js-date-picker').datepicker();

	$('[data-type=captcha]').livequery(function () {
		$(this).lsCaptcha();
	});


	/**
	 * Alerts
	 */
	$('.js-alert').lsAlert();


	/**
	 * Tooltips
	 */
	$('.js-tooltip').lsTooltip();

	$('.js-popover-default').lsTooltip({
		useAttrTitle: false,
		trigger: 'click',
		classes: 'tooltip-light'
	});

	/**
	 * Code highlight
	 */
	$( 'pre code' ).lsHighlighter();


	/**
	 * Blocks
	 */
	$( '.js-block-default' ).lsBlock();

	/**
	 * Editor
	 */
	$( '.js-editor-default' ).lsEditor();

	/**
	 * Form validate
	 */
	$('.js-form-validate').parsley({
		validators: {
			rangetags: function (val, arrayRange) {
				var tag_count = val.replace(/ /g, "").match(/[^\s,]+(,|)/gi);
				return tag_count && tag_count.length >= arrayRange[0] && tag_count.length <= arrayRange[1];
			}
		},
		// TODO: Вынести в лок-ию
		messages: {
			rangetags: "Кол-во тегов должно быть от %s до %s"
		}
	});

	/**
	 * Лайтбокс
	 */
	$('a.js-lbx').colorbox({ width:"100%", height:"100%" });


	/**
	 * Toolbar
	 */
	$('.js-toolbar').lsToolbar({
		target: '.grid-role-wrapper',
		offsetX: 10
	});
	$('.js-toolbar-scrollup').lsToolbarScrollUp();

	/**
	 * Fotorama
	 */
	$( '.fotorama' ).livequery(function() {
		$( this ).fotorama();
	});

	// Хук конца инициализации javascript-составляющих шаблона
	ls.hook.run('ls_template_init_end',[],window);
});
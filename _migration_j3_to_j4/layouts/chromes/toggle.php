<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2019 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * html5 (chosen html5 tag and font header tags)
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

$module = $displayData['module'];
$params = $displayData['params'];

if ((string)$module->content === '') {
    return;
}
if (empty($module->content)) return;
$moduleSfx = $params->get('moduleclass_sfx');
$tag = 'div';
$role = '';
if (false !== strpos($moduleSfx, 'menu')) {
    $tag = 'nav';
    $role = 'role="navigation"';
}

$showtitleToggle = 0;
if (preg_match('/title/', $moduleSfx)) $showtitleToggle = 1;

$moduleTitle = $module->title;

$headerLevel = isset($attribs['headerLevel']) ? (int)$attribs['headerLevel'] : 3;
echo '<' . $tag . ' ' . $role . ' id="module_' . $module->id . '" class="module' . htmlspecialchars($moduleSfx) . '">';
if (1 == JFactory::getApplication()->getTemplate(true)->params->get('info')) echo $module->position . ' :: ' . $module->module;
$title = $module->title;
if (1 == $module->showtitle) {
    echo '<h' . $headerLevel . ' class="moduleHeader title">';
    echo $title;
    echo '</h' . $headerLevel . '>';
}
$moduleTitleHeaderOpen = $moduleTitleHeaderClose = $moduleTitle;
if (1 == $showtitleToggle) {
    $moduleTitleHeaderOpen = JText::_('TPL_QLPROTO_OPEN');
    $moduleTitleHeaderClose = JText::_('TPL_QLPROTO_CLOSE');
}
//if(false!==strpos($moduleSfx,'menu') AND false!==strpos($moduleSfx,'image')) $moduleTitleHeader=$moduleTitleHeaderOpen=$moduleTitleHeaderClose='&#9776;';
if (false !== strpos($moduleSfx, 'menu') and false !== strpos($moduleSfx, 'image')) $moduleTitleHeader = $moduleTitleHeaderOpen = $moduleTitleHeaderClose = '&#8801;	';
echo '<div class="moduleHeader qlopen"><a>';
echo $moduleTitleHeaderOpen;
echo '</a></div>';
echo '<div class="moduleHeader qlclose"><a>';
echo $moduleTitleHeaderClose;
echo '</a></div>';
echo '<div class="moduleContent">';
echo $module->content;
echo '</div>';
echo '</' . $tag . '>';

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

$module  = $displayData['module'];
$params  = $displayData['params'];

if ((string) $module->content === '') {
    return;
}

$tag='div';
$role='';
if(false!==strpos($params->get('moduleclass_sfx'),'menu'))
{
    $tag='nav';
    $role='role="navigation"';
}
if (empty($module->content)) return;
echo '<'.$tag.' '.$role.' id="module_'.$module->id.'" class="module'.htmlspecialchars($params->get('moduleclass_sfx')).'">';
if ($module->showtitle):
    $headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
    echo clsQlproto::getInfo($module,0);
    if ($module->showtitle) echo '<h'.$headerLevel.' class="moduleHeader">'.$module->title.'</h'.$headerLevel.'>';
endif;
echo '<div class="moduleContent">';
echo $module->content;
echo '</div>';
echo '</'.$tag.'>';

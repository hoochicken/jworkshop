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
clsQlSvo::getInfo($module);
if (empty($module->content)) return;
elseif (0 < strpos($params->get('moduleclass_sfx'), 'bareback')) include __DIR__ . '/none.php';
elseif (0 < strpos($params->get('moduleclass_sfx'), 'toggle')) include __DIR__ . '/toggle.php';
else include __DIR__ . '/simple.php';
return true;

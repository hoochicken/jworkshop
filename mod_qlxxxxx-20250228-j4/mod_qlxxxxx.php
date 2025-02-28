<?php
/**
 * @package		mod_qlxxxxx
 * @copyright	Copyright (C) 2022 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ql\Module\Qlxxxxx\Site;

// no direct access
use Joomla\CMS\Helper\ModuleHelper;
use Ql\Module\Qlxxxxx\Site\QlxxxxxHelper;

defined('_JEXEC') or die;
require_once __DIR__ . '/QlxxxxxHelper.php';

/** @var $module  */
/** @var $params  */
$qlxxxxxHelper = new QlxxxxxHelper($module, $params);

require ModuleHelper::getLayoutPath('mod_qlxxxxx', $params->get('layout', 'default'));

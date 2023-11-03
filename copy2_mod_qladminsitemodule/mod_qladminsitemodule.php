<?php
/**
 * @package		mod_qladminsitemodule
 * @copyright	Copyright (C) 2022 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ql\Module\Qlxxxxx\Admin;

// no direct access
use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;
require_once dirname(__FILE__).'/helper.php';

/** @var $module  */
/** @var $params  */
$obj_helper = new QladminsitemoduleHelper($module, $params);

require ModuleHelper::getLayoutPath('mod_qladminsitemodule', $params->get('layout', 'default'));

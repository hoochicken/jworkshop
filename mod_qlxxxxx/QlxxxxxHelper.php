<?php
/**
 * @package        mod_qlqlxxxxx
 * @copyright    Copyright (C) 2023 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ql\Module\Qlxxxxx\Site;
// no direct access
use Joomla\Registry\Registry;
use stdClass;

defined('_JEXEC') or die;

class QlxxxxxHelper
{
    public Registry $params;
    public stdClass $module;

    function __construct($module, $params)
    {
        $this->module = $module;
        $this->params = $params;
    }

    public function someMethod()
    {

    }
}

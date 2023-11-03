<?php
/**
 * @package        mod_qlqladminsitemodule
 * @copyright    Copyright (C) 2015 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Ql\Module\Qlxxxxx\Admin;

// no direct access
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

class QladminsitemoduleHelper
{
    public Registry $params;
    public \stdClass $module;

    function __construct(\stdClass $module, Registry$params)
    {
        $this->module = $module;
        $this->params = $params;
    }

    public function someMethod()
    {

    }
}

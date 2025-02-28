<?php
/**
 * @package     Hoochicken\Module\Qlxxxxx
 *
 * @copyright   Copyright (C) 2025 Mareike Riegel. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

namespace Hoochicken\Module\Qlxxxxx\Site\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Hoochicken\Module\Qlxxxxx\Site\Helper\QlxxxxxHelper;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    protected function getLayoutData(): array
    {
        $data = parent::getLayoutData();

        $helperName = 'QlxxxxxHelper';
        $data['message'] = $this->getHelperFactory()->getHelper($helperName)->getMessage($data['params'], $this->getApplication());

        return $data;
    }
}
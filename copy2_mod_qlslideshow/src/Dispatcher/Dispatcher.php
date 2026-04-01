<?php
/**
 * @package     Hoochicken\Module\Qlslideshow
 *
 * @copyright   Copyright (C) 2025 Mareike Riegel. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

namespace Hoochicken\Module\Qlslideshow\Site\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Hoochicken\Module\Qlslideshow\Site\Helper\QlslideshowHelper;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    protected function getLayoutData(): array
    {
        $data = parent::getLayoutData();

        $helperName = 'QlslideshowHelper';
        $data['message'] = $this->getHelperFactory()->getHelper($helperName)->getMessage($data['params'], $this->getApplication());

        return $data;
    }
}
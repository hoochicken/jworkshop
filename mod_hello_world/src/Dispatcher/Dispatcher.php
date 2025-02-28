<?php
/**
 * @package     Vendor\Module\HelloWorld
 *
 * @copyright   Copyright (C) 2025 Your Name. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

namespace Vendor\Module\HelloWorld\Site\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Vendor\Module\HelloWorld\Site\Helper\HelloWorldHelper;

/**
 * Dispatcher class for mod_hello_world
 *
 * @since  1.0.0
 */
class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    /**
     * Returns the layout data
     *
     * @return  array
     *
     * @since   1.0.0
     */
    protected function getLayoutData(): array
    {
        $data = parent::getLayoutData();

        $helperName = 'HelloWorldHelper';
        $data['message'] = $this->getHelperFactory()->getHelper($helperName)->getMessage($data['params'], $this->getApplication());

        return $data;
    }
}
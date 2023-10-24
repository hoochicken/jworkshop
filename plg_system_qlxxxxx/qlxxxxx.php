<?php
/**
 * @package        plg_system_qlxxxxx
 * @copyright    Copyright (C) 2024 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

//no direct access
defined('_JEXEC') or die ('Restricted Access');

jimport('joomla.plugin.plugin');

class plgSystemQlxxxxx extends JPlugin
{
    public $params;
    public $data;

    /**
     * constructor
     * setting language
     * @param $subject
     * @param $config
     */
    public function __construct(&$subject, $config)
    {
        $lang = Factory::getApplication()->getLanguage();
        $lang->load('plg_content_qlstatistics', dirname(__FILE__));
        parent::__construct($subject, $config);
    }

    /**
     *  method to get documents and scripts needed
     */
    public function includeScripts()
    {
        if ($this->params->get('jquery', false)) {
            JHtml::_('jquery.framework');
        }
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
        $wa->registerAndUseStyle('plg_system_qlxxxxx', 'plg_system_qlxxxxx/qlxxxxx.css');
        $wa->registerAndUseScript('plg_system_qlxxxxx', 'plg_system_qlxxxxx/qlxxxxx.js');
    }

    /**
     *
     */
    public function onAfterRender()
    {

    }
}
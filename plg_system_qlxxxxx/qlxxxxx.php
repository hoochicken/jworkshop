<?php
/**
 * @package		plg_system_qlxxxxx
 * @copyright	Copyright (C) 2019 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
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
    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
        $this->includeScripts();
    }

    /**
     *  method to get documents and scripts needed
     */
    function includeScripts()
    {
        if (true === (bool) $this->params->get('jquery', false)) {
            JHtml::_('jquery.framework');
        }
        JHtml::_('stylesheet', 'media/plg_system_qlxxxxx/css/qlxxxxx.css');
        JHtml::_('script', 'media/plg_system_qlxxxxx/js/qlxxxxx.js');
        // $objDoc = JFactory::getDocument();
        // $objDoc->addScriptDeclaration('var qlSiteOffset=' . $offset . ';');
    }

    /**
     * 
     */
    public function onAfterRender()
    {

    }
}
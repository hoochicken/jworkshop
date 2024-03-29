<?php
/**
 * @package        plg_content_qlxxxxx
 * @copyright      Copyright (C) 2020 ql.de All rights reserved.
 * @author         Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

//no direct access
defined('_JEXEC') or die ('Restricted Access');

jimport('joomla.plugin.plugin');


class plgContentQlxxxxx extends JPlugin
{

    protected $strCallStart = 'qlxxxxx';
    protected $strCallEnd = '/qlxxxxx';
    protected $arrReplace = [];
    protected $arrAttributesAvailable = ['class', 'id', 'style', 'type', 'title', 'layout',];
    public $params;
    private $boolDebug = false;

    /**
     * onContentPrepare :: some kind of controller of plugin
     * @param $strContext
     * @param $objArticle
     * @param $objParams
     * @param int $numPage
     * @return bool
     * @throws Exception
     */
    public function onContentPrepare($strContext, &$objArticle, &$objParams, $numPage = 0)
    {
        //if search => ignore
        if ('com_finder.indexer' === $strContext) {
            return true;
        }

        $input = JFactory::getApplication()->input;
        $this->boolDebug = $input->getBool('ql_content_debug', false);

        //if no plg tag in article => ignore
        if (false === strpos($objArticle->text, '{' . $this->strCallStart) && false === strpos($objArticle->text, '{' . $this->strCallEnd . '}')) {
            return true;
        }

        // $this->getStyles();

        //clear tags, tries to avoid code like <p><div> etc.
        $objArticle->text = $this->clearTags($objArticle->text);

        //replace tags
        $objArticle->text = $this->replaceStartTags($objArticle->text);
    }

    /**
     * replaces placeholder tags {qlxxxxx ...} with actual html code
     * @param $strText
     * @return mixed
     * @internal param $text
     */
    private function replaceStartTags($strText)
    {
        // get matches
        $arrMatches = $this->getMatches($strText);

        //if no matches found (can't be, but just in case ...)
        if (0 === count($arrMatches) || !isset($arrMatches[0])) {
            return $strText;
        }

        // write into more beautiful variables
        $complete = $arrMatches[0];
        $attributes = $arrMatches[1];
        $content = $arrMatches[2];

        //iterate through matches
        foreach ($complete as $numKey => $strContent) {
            //get replacement array (written to class variable)
            $this->arrReplace[$numKey] = $this->getAttributes($this->arrAttributesAvailable, $attributes[$numKey]);
            $this->arrReplace[$numKey]['content'] = $content[$numKey];

            //get html code
            $this->arrReplace[$numKey]['html'] = $this->getHtml($numKey, $this->arrReplace[$numKey]);
        }

        //iterate through matches
        foreach ($complete as $numKey => $strContent) {
            $strText = str_replace($strContent, $this->arrReplace[$numKey]['html'], $strText);
        }

        //return text
        return $strText;
    }

    /**
     * @param $string
     * @return array
     */
    private function getMatches($string)
    {
        //get matches to {qlxxxxx}
        $strRegex = '~{' . $this->strCallStart . '(.*?)}(.+?){' . $this->strCallEnd . '}~s';
        preg_match_all($strRegex, $string, $arrMatches);
        return $arrMatches;
    }

    /**
     * method to get attributes
     * @param $arrAttributesAvailable
     * @param $string
     * @return array
     */
    private function getAttributes($arrAttributesAvailable, $string)
    {
        $strSelector = implode('|', $arrAttributesAvailable);
        preg_match_all('~(' . $strSelector . ')="(.+?)"~s', $string, $arrMatches);
        $arrAttributes = [];
        if (is_array($arrMatches)) {
            foreach ($arrMatches[0] as $k => $v) {
                if (isset($arrMatches[1][$k]) && isset($arrMatches[2][$k])) {
                    $arrAttributes[$arrMatches[1][$k]] = $arrMatches[2][$k];
                }
            }
        }
        return $arrAttributes;
    }

    /**
     * method to clear tags
     * @param $str
     * @return mixed
     */
    private function clearTags($str)
    {
        $str = str_replace('<p>{' . $this->strCallEnd . '}', '{' . $this->strCallEnd . '}<p>', $str);
        $str = str_replace('{' . $this->strCallEnd . '}', '{' . $this->strCallEnd . '}', $str);
        $str = preg_replace('!<p>{' . $this->strCallStart . '}</p>!', '{' . $this->strCallStart . '}', $str);
        $this->debugPrintText($str);
        return $str;
    }

    /**
     * @param $str
     */
    private function debugPrintText($str)
    {
        if (!$this->boolDebug) {
            return;
        }
        echo '<pre>' . htmlspecialchars($str) . '</pre>';
    }

    /**
     * @param $intCounter
     * @param $arrData
     * @return string
     */
    private function getHtml($intCounter, $arrData)
    {
        // initiating variables for output
        $objParams = $this->params;
        extract($arrData);
        $class = isset($class) ? $class : '';
        $id = isset($id) ? $id : 'qlxxxxx' . $intCounter;
        $style = isset($style) ? $style : '';
        $type = isset($type) ? $type : '';
        $title = isset($title) ? $title : '';
        $layout = isset($layout) ? $layout : '';

        // get layout path
        $strPathLayout = $this->getLayoutPath($this->_type, $this->_name, $layout);
        include $strPathLayout;

        // load into buffer, and return
        ob_start();
        $strHtml = ob_get_contents();
        ob_end_clean();
        return $strHtml;
    }

    /**
     * @param $extType
     * @param $extName
     * @param $layout
     * @return string
     */
    private function getLayoutPath($extType = 'content', $extName = 'qlxxxxx', $layout)
    {
        $strLayoutFile = !empty($layout) ? $layout : $this->params->get('layout', $layout);
        $strPathLayout = JPluginHelper::getLayoutPath($extType, $extName, $strLayoutFile);
        if (!file_exists($strPathLayout)) {
            $strPathLayout = JPluginHelper::getLayoutPath($extType, $extName, 'default');
            die($strPathLayout);
        }
        return $strPathLayout;
    }

    /**
     * method to get matches according to search string
     * @internal param string $text haystack
     * @internal param string $searchString needle, string to be searched
     */
    private function getStyles()
    {
        $numBorderWidth = $this->params->get('borderwidth');
        $strBorderColor = $this->params->get('bordercolor');
        $strBorderType = $this->params->get('bordertype');
        $strFontColor = $this->params->get('fontcolor');
        $numPadding = $this->params->get('padding');
        $numOpacity = $this->params->get('backgroundopacity');
        $strBackgroundColor = $this->getBgColor($this->params->get('backgroundcolor'), $numOpacity);

        $arrStyle = [];
        $arrStyle[] = '.qlxxxxx {color:' . $strFontColor . '; border:' . $numBorderWidth . 'px ' . $strBorderType . ' ' . $strBorderColor . '; padding:' . $numPadding . 'px; background:' . $strBackgroundColor . ';}';
        $strStyle = implode("\n", $arrStyle);
        JFactory::getDocument()->addStyleDeclaration($strStyle);
    }

    /**
     *
     */
    private function includeScripts()
    {
        if (1 == $this->params->get('jquery')) {
            JHtml::_('jquery.framework');
        }
        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();
        $wa->registerAndUseStyle('plg_content_qlxxxxx', 'plg_content_qlxxxxx/qlxxxxx.css');
        $wa->registerAndUseScript('plg_content_qlxxxxx', 'plg_content_qlxxxxx/qlxxxxx.js');
    }

    /**
     * @param $bg
     * @param $opacity
     * @return string
     */
    private function getBgColor($bg, $opacity)
    {
        include_once __DIR__ . '/php/clsPlgContentQlxxxxxColor.php';
        $objColor = new clsPlgContentQlxxxxxColor;
        $arr = $objColor->html2rgb($bg);
        $numOpacity = $opacity / 100;
        return 'rgba(' . implode(',', $arr) . ',' . $numOpacity . ')';
    }
}

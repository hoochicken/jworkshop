<?php
/**
 * @package        mod_qladminsitemodule
 * @copyright    Copyright (C) 2022 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;

// no direct access

/** @var stdClass $module */
/** @var \Joomla\Registry\Registry $params */
/** @var \Ql\Module\Qlxxxxx\Admin\QladminsitemoduleHelper $qlxxxxxHelper */

defined('_JEXEC') or die;
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerStyle('qladminsitemodule', 'mod_qladminsitemodule/styles.css');
$wa->useStyle('qladminsitemodule');
?>

<div class="qladminsitemodule" id="module<?php echo $module->id ?>">
</div>
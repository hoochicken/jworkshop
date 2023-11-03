<?php
/**
 * @package        mod_qlxxxxxadmin
 * @copyright    Copyright (C) 2022 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;

// no direct access

/** @var stdClass $module */
/** @var \Joomla\Registry\Registry $params */
/** @var \Ql\Module\Qlxxxxx\Admin\QlxxxxxadminHelper $qlxxxxxHelper */

defined('_JEXEC') or die;
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerStyle('qlxxxxxadmin', 'mod_qlxxxxxadmin/styles.css');
$wa->useStyle('qlxxxxxadmin');
?>

<div class="qlxxxxxadmin" id="module<?php echo $module->id ?>">
</div>
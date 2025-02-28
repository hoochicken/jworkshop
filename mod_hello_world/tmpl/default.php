<?php
/**
 * @package     Vendor\Module\HelloWorld
 *
 * @copyright   Copyright (C) 2025 Your Name. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;

/** @var Joomla\Registry\Registry $params */
/** @var stdClass $module */
/** @var object $message Data from ModuleHelper::getMessage() */

// Get the WebAsset Manager
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();



// Add stylesheets and scripts


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
?>

<div class="<?php echo 'mod_hello_world ' . $moduleclass_sfx; ?>">
    <?php if ($message->error) : ?>
        <div class="alert alert-error">
            <?php echo Text::_($message->error); ?>
        </div>
    <?php else : ?>
        <?php if ($message->show_title) : ?>
            <h3><?php echo Text::_('MOD_HELLO_WORLD_TITLE'); ?></h3>
        <?php endif; ?>
        
        <div class="module-content">
            <?php echo $message->message; ?>
        </div>
    <?php endif; ?>
</div>
<?php
/**
 * @package		plg_system_qlxxxxx
 * @copyright	Copyright (C) 2016 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

//no direct access
defined('_JEXEC') or die ('Restricted Access');
if (false!==$data->message)
{
    echo '<div class="qlxxxxx alert alert-notice">'.$data->message.'</div>';
    return;
}
$id='qlxxxxx'.$counter;
//echo '<pre>';print_r($data->states);die;
if(isset($data->states['id']) AND ''!=$data->states['id'])$id=$data->states['id'];
$tag1=$tag2='div';
if('ul'==$params->get('tag','div')) { $tag1='ul';$tag2='li'; };?>
<div id="<?php echo $id;?>" class="qlxxxxx <?php echo $data->states['class'];?>">
    <?php if(''!=$data->states['title']) :?>
        <h<?php echo $params->get('headline',4);?>>
            <?php echo $data->states['title'];?>
        </h<?php echo $params->get('headline',4);?>>
    <?php endif;?>
    <<?php echo $tag1;?> class="qlxxxxxContainer navi">
        <?php foreach($data->files as $k=>$v) : ?>
                <<?php echo $tag2;?> class="qlxxxxx-item" onclick="qlxxxxxNextTrack(<?php echo $counter; ?>,<?php echo $k;?>);">
                    <?php if(1==$params->get('iconPlay',1)) echo '<span class="icon-play"> </span>';?>
                    <?php echo $v['name'];?>
                </<?php echo $tag2;?>>
        <?php endforeach;?>
    </<?php echo $tag1;?>>
    <div class="qlxxxxxContainer player">
        <audio autoplay="true" id="qlxxxxx_player<?php echo $counter; ?>" controls>
        <source id="qlxxxxx_source<?php echo $counter; ?>" src="<?php if(1==$data->states['autostart']) echo $data->files[0]['path'];?>" type="audio/mpeg" preload="auto" />
        <?php echo JText::_('PLG_SYSTEM_QLXXXXX_MSG_BROWSERDOESNTLIKEMEDIATAG');?>
        </audio>
    </div>
</div>
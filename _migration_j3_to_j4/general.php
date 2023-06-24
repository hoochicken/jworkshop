Admin-Module 
Position: menu
<p>QUICKLINKS</p>
<ul>
<li><a href="/administrator/index.php?option=com_installer&amp;view=install" target="_self">Installation</a></li>
<li><a href="/administrator/index.php?option=com_plugins" target="_self">Plugins</a></li>
<li><a href="/administrator/index.php?option=com_modules&amp;view=modules&amp;client_id=0" target="_self">Modules</a></li>
<li><a href="/administrator/index.php?option=com_templates&amp;view=templates&amp;client_id=0" target="_self">Templates</a></li>
</ul>


<?php 
# clsQlproto.php::menu()
$app = Factory::getApplication();
$menu= $app->getMenu();

JHtml::_('content.prepare', $item->introtext, '', 'com_content.blog'); 

each()
  
shitBrowser
  

$this->columns = $this->params->get('num_columns', 1);
  
public $getClassMain = '';
public $main = 'div';


// $db->query($query);
$$this->item->params('aliasoption') = $item->getParams('aliasoption');
$itemParams = $item->getParams();

$tag = empty($tag) ? 'div' : $tag;


$obj_qlproto->aside ?? 'div'

  
# ????
echo $this->pagination->getPagesCounter(); 



$dispatcher = Joomla\CMS\Factory::getApplication()->getDispatcher();

$event = new Joomla\Event\Event('onContentPrepare', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$res = $dispatcher->dispatch('onContentPrepare', $event);

$event = new Joomla\Event\Event('onContentAfterTitle', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$results = $dispatcher->dispatch('onContentAfterTitle', $event)->getArgument('result');
$afterDisplayTitle = trim(implode("\n", $results));

$event = new Joomla\Event\Event('onContentBeforeDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$results = $dispatcher->dispatch('onContentBeforeDisplay', $event)->getArgument('result');
$beforeDisplayContent = trim(implode("\n", $results));

$event = new Joomla\Event\Event('onContentAfterDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$results = $dispatcher->dispatch('onContentAfterDisplay', $event)->getArgument('result');
$afterDisplayContent = trim(implode("\n", $results));

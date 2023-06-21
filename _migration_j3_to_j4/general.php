<?php 
# clsQlproto.php::menu()
$app = Factory::getApplication();
$menu= $app->getMenu();

JHtml::_('content.prepare', $item->introtext, '', 'com_content.blog'); 

each()
  
shitBrowser
  

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

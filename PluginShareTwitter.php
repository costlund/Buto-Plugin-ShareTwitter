<?php
class PluginShareTwitter{
  function __construct() {
    wfPlugin::includeonce('wf/yml');
  }
  public function page_demo(){
    wfPlugin::enable('share/twitter');
    wfPlugin::enable('icons/bootstrap_v1_8_1');
    $widget = wfDocument::createWidget('share/twitter', 'button_share_page');
    wfDocument::renderElement(array($widget));
  }
  public function widget_button_share_page($data){
    $data = new PluginWfArray($data);
    if(!$data->get('data/u')){
      if(wfRequest::get('u')){
        $data->set('data/u', wfRequest::get('u'));
      }else{
        $data->set('data/u', wfServer::calcUrl(true));
      }
    }
    /**
     * text
     */
    if(!$data->get('data/text') && wfGlobals::get('settings/application/title')){
      $data->set('data/text', wfGlobals::get('settings/application/title'));
    }else{
      $data->set('data/text', 'Sharing a page.');
    }
    /**
     * 
     */
    $data->set('data/href', 'http://twitter.com/share?url='.$data->get('data/u').'&hashtags='.$data->get('data/hashtags').'&text='.$data->get('data/text'));
    /**
     * 
     */
    $element = wfDocument::getElementFromFolder(__DIR__, __FUNCTION__);
    $element->setByTag($data->get('data'));
    wfDocument::renderElement($element);
  }
}
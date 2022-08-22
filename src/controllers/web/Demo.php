<?php 
/**
 *
 * @copyright (C), 2013-, King.
 * @name Test.php
 * @author King
 * @version stable 2.0
 * @Date 2022年6月4日下午3:47:22
 * @Class List class
 * @Function List function_container
 * @History King 2022年6月4日下午3:47:22 2017年3月8日下午4:20:28 0 第一次建立该文件
 */
 namespace Demo\Controller;
 
 use Tiny\MVC\Controller\Controller;
use Demo\Model\UserInfo;
use Tiny\MVC\Web\HttpCookie;
use Tiny\MVC\Request\Param\Get;
use Tiny\Cache\Storager\PHP;
use Tiny\Config\Configuration;
use Tiny\Lang\Lang;
use Tiny\MVC\Web\HttpSession;
use Tiny\MVC\View\View;
use Tiny\Net\IpArea;
use Demo\Model\User\UserInfoByRedis;
use Tiny\Cache\Cache;
use Demo\Common\Example;
                                                 
/**
*  测试类
*  
* @package App.Controller
* @since 2022年6月4日下午3:48:06
* @final 2022年6月4日下午3:48:06
*/
 class Demo extends Controller
 {
     /**
      *  自动注解的方式加载类实例
      *
      * @autowired
      *
      * @var \Demo\Model\UserInfo
      */
     protected $userinfoModel;
     
     /**
      * 
      * {@inheritDoc}
      * @see \Tiny\MVC\Controller\ControllerBase::onBeginExecute()
      */
     public function onBeginExecute()
     {
         if (!$this->application->isDebug) {
            $this->response->appendBody('Access Denied!');
             return false;
         }
     }
     
     /**
      *
      * @param HttpCookie $cookie Cookie操作实例
      * @param Get $get GET操作实例
      * @param UserInfo $userinfoModel 自动加载模型实例
      * @param PHP $cache 缓存操作实例
      * @param Configuration $config 配置操作实例
      * @param Lang $lang 语言包操作实例
      * @param HttpSession $session Session操作实例
      * @param View $view 视图操作实例
      */
     public function indexAction(Get $get,Lang $lang, HttpSession $session, HttpCookie $cookie, \Demo\Model\User\UserInfoByRedis $userinfoModel, Configuration $config, Cache $cache, \Example $gexample, Example $cexample)
     {
         // session
         if (!$session['example']) {
             $session['example'] = 'tinyphp';
         }
         
         // $container->get('bootstrap');
         // cookie
         if (!$cookie['example']) {
             $cookie['example'] = '100';
         }
         
         // $request->get
         $actionName = $this->request->getActionName();
         $pageid = $this->request->get['pageid'];
         
         $controllerName = $this->request->getControllerName();
         
         $moduleName = $this->request->getModuleName();
         
         // request->filter
         $name = $this->request->get->formatString('name', 'tinyphp');
         $isName = $this->request->get->isRequired('name') ? 'true' : 'false';
         
         $userInfo = $userinfoModel->getUsers();
         $userInfo = array_merge($userInfo, $this->userinfoModel->getUsers());
         
         // cached
         $cached = $cache->get('aa');
         if (!$cached) {
             $cached = 'aaaax';
             $cache->set('aa', $cached);
         }
         
         $this->assign([
             'ip' => $this->request->ip,
             'iparea' => IpArea::get($this->request->ip),
             'actionName' => $actionName,
             'controllerName' => $controllerName,
             'moduleName' => $moduleName,
             'name' => $name,
             'sessionExample' => $session['example'],
             'cookieExample' => $cookie['example'],
             'langExample' => $lang->translate('status.0', 'example'),
             'configExample' => $config['default.example'],
             'moduleConfigExample' => $this->module->config['default.modulename'],
             'globalExample' => $gexample->get(),
             'commonExample' => $cexample->get(),
             'defName' => 'tinyphp',
             'isName' => $isName,
             'users' => $userInfo,
             'cached' => $cached,
             'pageid' => $pageid,
         ]);
         $this->display('test/index.htm');
     }
 }
?>
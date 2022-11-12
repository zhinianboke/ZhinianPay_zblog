<?php
#注册插件
RegisterPlugin("ZhinianPay_zblog", "ActivePlugin_ZhinianPay_zblog");

function ActivePlugin_ZhinianPay_zblog() {
    Add_Filter_Plugin('Filter_Plugin_ViewPost_Template', 'ZhinianPay_zblog_html');
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags', 'ZhinianPay_zblog_Edit'); 
    
}

function ZhinianPay_zblog_Edit() {
    global $zbp;
	
	$zbp->footer .=  '<link href="'.$zbp->host.'zb_users/plugin/ZhinianPay_zblog/css/ZhinianPay.css" rel="stylesheet"> <script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/ZhinianPay_zblog/js/ZhinianPay.js"></script>';	
} 

function ZhinianPay_zblog_html($template) {    			  			
	global $zbp;    			    	
	$PID = $template->GetTags('article')->ID;    	   	 		
	$content = $template->GetTags('article')->Content;    					 		
	$template->GetTags('article')->Content = ZhinianPay_zblog_str($content,$PID);    			  	  
} 


function ZhinianPay_zblog_str($content, $pid) {
	global $zbp;
	
    
    $zhiniantempContent = $content;
    $zhiniantempContent = preg_replace('/{ZhinianPay[^}]*}/', 'ZhinianPayStart', $zhiniantempContent);
    $zhiniantempContent = preg_replace('/{\/ZhinianPay}/', 'ZhinianPayEnd', $zhiniantempContent);
    
    $start = 'ZhinianPayStart';
    $end = 'ZhinianPayEnd';
    
    $hideContent = substr($zhiniantempContent, strlen($start)+strpos($zhiniantempContent, $start),(strlen($zhiniantempContent) - strpos($zhiniantempContent, $end))*(-1));
	
	$start = 'money=';
    $end = '}';
    $input = $content;
    $money = substr($input, strlen($start)+strpos($input, $start), strpos($input, '}', strpos($input, 'money='))-(strlen($start)+strpos($input, $start)));

    
    // 获取支付参数
    $alipay_appid = $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_appid;
    $app_private_key = $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_private_key;
    $alipay_public_key = $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_public_key;
    
    $appId = $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_appid;
    $mchId = $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_mchId;
    $mchKey = $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_mchKey;
    
    $yizhif_interfUrl = $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_interfUrl;
    $yizhifu_pid = $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_pid;
    $yizhifu_miyao = $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_miyao;
    
    $mazhifu_interfUrl = $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_interfUrl;
    $mazhifu_pid = $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_pid;
    $mazhifu_miyao = $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_miyao;
    
    
    $alipay = $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_zhifu;
    $wxpay = $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_zhifu;
    $qqpay = $zbp->Config('ZhinianPay_zblog')->ffyd_qq_zhifu;
    
    $qqNum = $zbp->Config('ZhinianPay_zblog')->ffyd_qq;
    $cardId = $zbp->Config('ZhinianPay_zblog')->ffyd_shouquanma;
    $cookietime = $zbp->Config('ZhinianPay_zblog')->ffyd_cookietime;
    if(empty($cookietime)) {
        $cookietime = 1;
    }
    
    $returnUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    $cid = $returnUrl;
    $str = $cid;
    $new = '';
    if ($str[strlen($str) - 1] != '0') {
        for ($i = 0; $i < strlen($str); ++$i) {
            $new .= chr(ord('a') + intval($str[$i]) - 1);
        }
    }
    $cookieName =  'ZhinianPayCookie'.$new;
    if(!isset($_COOKIE[$cookieName])) {
		$randomCode = md5(uniqid(microtime(true),true));
		setcookie($cookieName, $randomCode, time()+3600*24*$cookietime);
	}
	$bussId = $_COOKIE[$cookieName];
    
    $form = '<form style="display:none;" target="_blank" action="https://dy.zhinianboke.com/pay/zhifu/ZhiFu001/init" method="post" id="subscribe_form"><input type="hidden" name="qqNum" value="'.$qqNum.'"><input type="hidden" name="alipay" value="'.$alipay.'"><input type="hidden" name="wxpay" value="'.$wxpay.'"><input type="hidden" name="qqpay" value="'.$qqpay.'"><input type="hidden" name="appId" value="'.$appId.'"><input type="hidden" name="mchId" value="'.$mchId.'"><input type="hidden" name="mchKey" value="'.$mchKey.'"><input type="hidden" id="ZhinianPay_cardId" name="cardId" value="'.$cardId.'"><input type="hidden" id="ZhinianPay_cookietime" value="'.$cookietime.'"><input type="hidden" name="orderName" value="文章付费阅读"><input type="hidden" id="ZhinianPay_cookieName" value="'.$cookieName.'"><input type="hidden" id="ZhinianPay_bussId" name="bussId" value="'.$bussId.'"><input type="hidden" name="orderDes" value="文章付费阅读"><input type="hidden" name="alipayAppid" value="'.$alipay_appid.'"><input type="hidden" name="alipayAppPrivateKey" value="'.$app_private_key.'"><input type="hidden" name="alipayPublicKey" value="'.$alipay_public_key.'"><input type="hidden" id="ZhinianPay_orderFee" name="orderFee" value="'.$money.'"><input type="hidden" name="returnUrl" value="'.$returnUrl.'"><input type="hidden" name="interfUrl" value="'.$yizhif_interfUrl.'"><input type="hidden" name="pid" value="'.$yizhifu_pid.'"><input type="hidden" name="miyao" value="'.$yizhifu_miyao.'"><input type="hidden" name="mazhifuInterfUrl" value="'.$mazhifu_interfUrl.'"><input type="hidden" name="mazhifuPid" value="'.$mazhifu_pid.'"><input type="hidden" name="mazhifuMiyao" value="'.$mazhifu_miyao.'"><input type="submit" value="" id="submit"></form>';
    
    
    $replaceEnd = '<div id="zhinianpay_content" style="display: none;">'.$hideContent.'</div>';
    $replaceEnd = $replaceEnd . '<span id="zhinian_hide">此处内容作者设置了 <i id="zhinian_hide__button">付费'.$money . ' 元(点击此处支付，付费后请刷新界面) </i>可见，付费后 '. $cookietime . ' 天内有效</span>'.$form;
    $content = preg_replace('/{ZhinianPay[^}]*}([\s\S]*?){\/ZhinianPay}/', $replaceEnd, $content);
	return $content;
    

    
}  


function InstallPlugin_ZhinianPay_zblog() {}
function UninstallPlugin_ZhinianPay_zblog() {}
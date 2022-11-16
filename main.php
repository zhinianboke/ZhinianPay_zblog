<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('ZhinianPay_zblog')) {$zbp->ShowError(48);die();}

if (count($_POST) > 0) {
//CheckIsRefererValid();
}

if(count($_POST)>0){
    $zbp->Config('ZhinianPay_zblog')->ffyd_shouquanma = $_POST['ffyd_shouquanma'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_qq = $_POST['ffyd_qq'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_cookietime = $_POST['ffyd_cookietime'];
    
    $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_zhifu = $_POST['ffyd_zhifubao_zhifu'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_zhifu = $_POST['ffyd_weixin_zhifu'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_qq_zhifu = $_POST['ffyd_qq_zhifu'];
    
    
    $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubaodangmianfu_appid = $_POST['ffyd_zhifubaodangmianfu_appid'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_appid = $_POST['ffyd_zhifubao_appid'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_private_key = $_POST['ffyd_zhifubao_private_key'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_public_key = $_POST['ffyd_zhifubao_public_key'];
    
    $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_appid = $_POST['ffyd_weixin_appid'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_mchId = $_POST['ffyd_weixin_mchId'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_mchKey = $_POST['ffyd_weixin_mchKey'];
    
    $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_interfUrl = $_POST['ffyd_yizhifu_interfUrl'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_pid = $_POST['ffyd_yizhifu_pid'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_miyao = $_POST['ffyd_yizhifu_miyao'];
    
    $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_interfUrl = $_POST['ffyd_mazhifu_interfUrl'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_pid = $_POST['ffyd_mazhifu_pid'];
    $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_miyao = $_POST['ffyd_mazhifu_miyao'];
    
    
    $zbp->ShowHint('good');
    $zbp->SaveConfig('ZhinianPay_zblog');
}

$blogtitle='执念付费阅读';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
        <a href="main.php" ><span class="m-left">付费阅读设置</span></a>
  </div>
  <div id="divMain2">
    <form method="post">
          <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
        	<tr>	
        	  <th width="12%"><p align="center">参数</p></th>
        	  <th width="16%"><p align="center">参数值</p></th>
        	  <th width="60%"><p align="center">说明</p></th>
        	</tr>
        	<tr>
        	    <th>
            		<p align="center">授权码</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_shouquanma" name="ffyd_shouquanma" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_shouquanma;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center">授权码(只需3元-申请地址：<a href="https://dy.zhinianboke.com" target="_BLANK">https://dy.zhinianboke.com</a><br>
        <span style="color:red;">下面的支付宝和微信配置不填写也可以使用，不过要到 https://dy.zhinianboke.com 的支付管理菜单中进行提现，请知悉<br/>不填写也可以自行到账，填写下方易支付或者是码支付商户id和秘钥即可</span>)</p>
    	        </th>
        	</tr> 
        	
        	<tr>
        	    <th>
            		<p align="center">QQ号码</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_qq" name="ffyd_qq" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_qq;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center">不做收款使用，只做头像显示</p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">免登录Cookie保存时间</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_cookietime" name="ffyd_cookietime" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_cookietime;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center">即付费后几天内可以重复阅读(天)：<br/>付费后多长时间内可以重复阅读，默认为1天</p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">是否开启支付宝支付</p>
        	    </th>
        	    <th>
            		<p align="center">
            		
            		    <select name="ffyd_zhifubao_zhifu" style="width: 180px;height:30px">
                		    <option value="" <?php if($zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_zhifu == '') echo ' selected="selected"'  ?>>关闭(默认)</option>
                	    	<option value="01" <?php if($zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_zhifu == '01') echo ' selected="selected"'  ?>>开启</optiaon>
            	    	</select>
            		</p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">是否开启微信支付</p>
        	    </th>
        	    <th>
            		<p align="center">
            		
            		    <select name="ffyd_weixin_zhifu" style="width: 180px;height:30px">
                		    <option value="" <?php if($zbp->Config('ZhinianPay_zblog')->ffyd_weixin_zhifu == '') echo ' selected="selected"'  ?>>关闭(默认)</option>
                	    	<option value="01" <?php if($zbp->Config('ZhinianPay_zblog')->ffyd_weixin_zhifu == '01') echo ' selected="selected"'  ?>>开启</optiaon>
            	    	</select>
            		</p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">是否开启QQ支付</p>
        	    </th>
        	    <th>
            		<p align="center">
            		
            		    <select name="ffyd_qq_zhifu" style="width: 180px;height:30px">
                		    <option value="" <?php if($zbp->Config('ZhinianPay_zblog')->ffyd_qq_zhifu == '') echo ' selected="selected"'  ?>>关闭(默认)</option>
                	    	<option value="01" <?php if($zbp->Config('ZhinianPay_zblog')->ffyd_qq_zhifu == '01') echo ' selected="selected"'  ?>>开启</optiaon>
            	    	</select>
            		</p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">支付宝当面付appid</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_zhifubaodangmianfu_appid" name="ffyd_zhifubaodangmianfu_appid" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubaodangmianfu_appid;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">支付宝应用appid</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_zhifubao_appid" name="ffyd_zhifubao_appid" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_appid;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">支付宝应用私钥</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_zhifubao_private_key" name="ffyd_zhifubao_private_key" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_private_key;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">支付宝公钥</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_zhifubao_public_key" name="ffyd_zhifubao_public_key" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_zhifubao_public_key;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">微信公众号appid</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_weixin_appid" name="ffyd_weixin_appid" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_appid;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">微信商户号</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_weixin_mchId" name="ffyd_weixin_mchId" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_mchId;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">微信商户密钥</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_weixin_mchKey" name="ffyd_weixin_mchKey" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_weixin_mchKey;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">易支付API接口支付地址</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_yizhifu_interfUrl" name="ffyd_yizhifu_interfUrl" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_interfUrl;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center">填写对应易支付网站中的API接口支付地址,注意后面有 mapi.php <br>
		例如：https://suyan.qqdsw8.cn/mapi.php</p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">易支付商户ID</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_yizhifu_pid" name="ffyd_yizhifu_pid" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_pid;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center">申请地址如下 <a href="https://suyan.qqdsw8.cn/user/reg.php" target="_BLANK">https://suyan.qqdsw8.cn/user/reg.php</a> <br/>
		<span style="color:red;">本站不对该地址资金结算做保证，只是提供一个渠道</span></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">易支付商户密钥</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_yizhifu_miyao" name="ffyd_yizhifu_miyao" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_yizhifu_miyao;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">码支付API接口支付地址</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_mazhifu_interfUrl" name="ffyd_mazhifu_interfUrl" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_interfUrl;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center">填写对应码支付网站中的支付请求支付地址,注意后面可能有 submit.php <br>
		例如：https://pay.ococn.cn/submit.php</p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">码支付商户ID</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_mazhifu_pid" name="ffyd_mazhifu_pid" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_pid;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center">申请地址如下 <a href="https://pay.ococn.cn/User/Login.php?invite_user=199451637" target="_BLANK">https://pay.ococn.cn/User/Login.php?invite_user=199451637</a> <br/>
		<span style="color:red;">本站不对该地址资金结算做保证，只是提供一个渠道</span></p>
    	        </th>
        	</tr>
        	
        	<tr>
        	    <th>
            		<p align="center">码支付商户密钥</p>
        	    </th>
        	    <th>
            		<p align="center"><input id="ffyd_mazhifu_miyao" name="ffyd_mazhifu_miyao" type="text" value="<?php echo $zbp->Config('ZhinianPay_zblog')->ffyd_mazhifu_miyao;?>" /></p>
        	    </th>
        	    <th>
        	        <p align="center"></p>
    	        </th>
        	</tr>
        	
        	
        	
        	
            </table>
            <hr/>
            <p>
                <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
            </p>
        </form>
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>
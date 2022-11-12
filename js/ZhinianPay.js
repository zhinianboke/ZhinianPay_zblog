document.addEventListener('DOMContentLoaded', () => {
    
    var btn = document.getElementById('zhinian_hide__button');
    if(btn) {
        btn.addEventListener('click',function() {
            console.log(2);
            var cookieValue = "";
            var strcookie = document.cookie;//获取cookie字符串
            var arrcookie = strcookie.split("; ");//分割
            //遍历匹配
            for ( var i = 0; i < arrcookie.length; i++) {
                var arr = arrcookie[i].split("=");
                if (arr[0] == document.getElementById('ZhinianPay_cookieName').value){
                    cookieValue = arr[1];
                    break;
                }
            }
            document.getElementById("ZhinianPay_bussId").value = cookieValue;
            var submit = document.getElementById("submit");
    	    submit.click();
	    },false);
    }
    
    if(document.getElementById("ZhinianPay_bussId").value) {
        var cardId = document.getElementById("ZhinianPay_cardId").value;
        var bussId = document.getElementById("ZhinianPay_bussId").value;
        var ajax;
        if(window.XMLHttpRequest) {
            ajax = new XMLHttpRequest();
        }
        else if(window.ActiveXObject) {
            ajax = new ActiveXObject();
        }
        if(ajax != null) {
        	// 指定结果处理器
            ajax.onreadystatechange = function() {
                if(ajax.readyState == 4) {
                    if(ajax.status == 200 || ajax.status == 304) {
                        var data = JSON.parse(ajax.responseText);
                        if(data.status == '200' && data.data == 'success') {
                            document.getElementById("zhinianpay_content").style.display = "";
                            document.getElementById("zhinian_hide").style.display = "none";
                        }
                        else {
                            document.getElementById("zhinianpay_content").style.display = "none";
                            document.getElementById("zhinian_hide").style.display = "";
                        }
                    }
                    else {
                        document.getElementById("zhinianpay_content").style.display = "none";
                        document.getElementById("zhinian_hide").style.display = "";
                    }
                }
                else {
                    document.getElementById("zhinianpay_content").style.display = "none";
                    document.getElementById("zhinian_hide").style.display = "";
                }
            }
            // 发送请求
            ajax.open("GET", 'https://dy.' + 'zhinianboke.com' + '/api/getPayStatus?cardId=' + cardId + '&bussId=' + bussId);
            ajax.send(null);
            
        }else{
            // 浏览器不支持XMLHttpRequest
        }
    }
});

    var xmlHttp;
	var uName;
	var uPwd;
	var uRePwd;
    
    window.onload = function()
    {
    	var sendButton = document.getElementById("regBtn");
        sendButton.onclick = startRequest;
    }
	
	function check()
	{
		uPwd = $("#userPwd").val();
		uRePwd = $("#rePwd").val();
		if( uPwd==uRePwd )
		{
			return true;
		}
		else
		{
			document.getElementById("result").innerHTML = "两次输入密码不一致";
			return false;
		}	
	}
        
    function createXMLHttpRequest(){
      if( window.ActiveXObject){
      	xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      else if( window.XMLHttpRequest )
      {
      	xmlHttp = new XMLHttpRequest();
      }
    }
    
    function startRequest(){
		if( check()==true )
		{
			document.getElementById("result").innerHTML = "请稍等...";
			uName = $("#userName").val(); 
	
			createXMLHttpRequest();
			xmlHttp.onreadystatechange = handleStateChange;
			xmlHttp.open("POST", "backstage/registerUser.php", true);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send("userName=" + uName + "&userPwd=" + uPwd);
		}
    }
    
    function handleStateChange(){
    	if( xmlHttp.readyState == 4 )
        {
        	if( xmlHttp.status == 200 )
            {
				if( xmlHttp.responseText=="true" )
				{
					location.href = "home.php";
				}
				else
                	//document.getElementById("result").innerHTML = "注册失败*0*,请重试";
					document.getElementById("result").innerHTML = xmlHttp.responseText;
            }
        }
    }

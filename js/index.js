$(function(){
	$("#submit").onclick = function(){
		$.post("server/php/loginUser.php",
			{ userName:$("[name='userName']").[0].val(),
				userPwd:$("[name='userPwd']").[0].val()
			},
			function(data){
				$("error_msg").val(data);
			}
			);
	}
});
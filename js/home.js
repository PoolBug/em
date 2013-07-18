window.onload = function() {
	//$("button.destroy").click();
	//$("tr").css( "display","" );
	$("#merge_btn").click( function(){
		if($("tr").length == 0){
			alert("No image select");
			return false;
		}
		//$("button.destroy").click();
		/*$.ajax({
			type:"post",
			url:"server/php/MergeImages.php",
			dataType:"json",
			success:function(msg){
				//if(msg["status"]){
					alert("Merge succees");
					$("button.destroy").click();
					location.replace("server/php/editImageDescription.php");
				//}
				//else {
					alert("Sorry! Merge fial. You can try again.");
				//}
			},
			error:function(){
				alert("merge fail");
			}
		});
		//alert("all image destroy.");
		*/
		$("button.merge").button("loading");
		$("button").attr("disabled", "disabled");
		location.href = "server/php/MergeImages.php";
	});
	$("button.cancel").click( function() {
		$("button.destroy").click();
	});
	
	//$("button.cancel").click();
};


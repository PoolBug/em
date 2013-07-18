window.onload = function()
{
	$("#showCarousel").click( function() {
		if( $("#myCarousel").css("display") == "none" ){
			initMyCarousel();
			$("#myCarousel").css("display", "");
		} 
		else {
			destroyMyCarousel();
			$("#myCarousel").css("display") == "none";
		}
	});
}

function initMyCarousel()
{
	var thumbnail_divs = $("div.thumbnail");
	if (thumbnail_divs.length == 0)
		return false;
		
	var carousel_indicators = $("ol.carousel-indicators");
	var carousel_inner = $("div.carousel-inner");
	//for( var i = 0; i < thumbnail_divs.length; i++)
	var i = 0;
	thumbnail_divs.each( function(){
		var carousel_indicator = '<li data-target="#myCarousel" data-slide-to="' + i + '"></li>';
		carousel_indicators.append( carousel_indicator );
		i++;
		//alert($(this).find("img"));
		//alert($(this).find("img").attr("src"));
		var img_src = $(this).find("img").attr("src");
		var img_content = $(this).find("textarea").val();
		var item = '<div class="item"><img src="' + img_src + '" /><div class="carousel-caption"><p>' + img_content + '</p></div></div>'
		carousel_inner.append( item );
	});
	$("ol.carousel-indicators").children().first().attr("class","active");
	$("div.carousel-inner").children().first().attr("class", "active item");
}

function destroyMyCarousel()
{
	$("ol.carousel-indicators").empty();
	$("div.carousel-inner").empty();
	$("#myCarousel").css("display", "none");
}

function destroyResultImage( image_id )
{
	if( confirm("Are you sure?") ){
		$.post("server/php/deleteImageById.php", 
			{image_id:image_id},
			function(data){
				//alert(data);
				location.reload();
			}
		);
	}
};
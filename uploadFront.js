
window.onload = function(){
	addSubmitListener();
}

function addSubmitListener()
{
	submitBtn = document.getElementById('submitBtn');
	submitBtn.onclick = function()
	{
		fileArr = document.getElementsByName('upfile[]');
		if( fileArr.length>1 )
			document.forms[0].submit();
		else
			alert("no image");
	}
}


function deleteAImgField(delBtn)
{	
	if ( noNeedToDeleteThisImgField(delBtn) ) {
		return true;
	};
	if( confirm('Are you sure to Delete?') )
		delBtn.parentNode.parentNode.removeChild( delBtn.parentNode );
		
	// if there is no empty imgField to add image, add a empty imgField
	if (needToAddAnImageField()){
		addAnImageField();
		return true;
	}

}

function noNeedToDeleteThisImgField(delBtn) {

	var file_field = delBtn.parentNode.firstChild;
	while( !file_field.src )
		file_field = file_field.nextSibling;
	if ( file_field.src.indexOf('symbolAdd.png') != -1 ){
		alert('No need to delete this!'); 
		return true;
	}
}

function needToAddAnImageField() {
	var files = document.getElementsByTagName('img');
	for( var i = 0; i < files.length; i++ ){
		if( files[i].src.indexOf('symbolAdd.png') != -1 ){
			break;
		}
	}
	if( files.length < 1 || i >= files.length){
		return true;
	}
	else {
		return false;
	}
}

// ����һ���ϴ��ļ���button
function addAnImageField()
{
	if( uploadImgNumExceedMaxNum() ){
		return false;
	}
	else {
		addAnImageFieldByCloneOtherField();
	}
}

function uploadImgNumExceedMaxNum() {
	// �ж��ϴ�ͼƬ�����Ƿ��Ѿ������������
	var temp = document.getElementsByName('upfile[]');
	var max_img_num = 16;
	if( temp.length >= max_img_num )
	{
		//alert("No more than " + max_img_num + " images!");
		return false;
	}
}

function addAnImageFieldByCloneOtherField() 
{
	var img_field = document.getElementById('imgField');
	var new_node = img_field.getElementsByClassName('aImgField')[0].cloneNode(true);
	new_node.getElementsByClassName('upfile')[0].value = null;
	new_node.getElementsByTagName('img')[0].src = 'symbolAdd.png';
	//alert(new_node.getElementsByClassName('upfile')[0].value);
	img_field.appendChild(new_node);
}

function clickUploadFile( objImgTag )
{
	var targetTag = objImgTag.parentNode.firstChild;
	while(targetTag.name != 'upfile[]')
		targetTag = targetTag.nextSibling;
	targetTag.click();
}

function imagePreview( upfileBtn )
{
	// ����ϴ��ļ��Ƿ�ΪͼƬ
	if (!isImageFile(upfileBtn))
	{
		alert("Sorry, the image can't be recognized, please upload another one.");
		return false;
	}
	var imgObj = new Image();
	// ���Ԥ��ͼƬҪ�����λ��
	var imgObjPreview = getTagImgToPlaceImage(upfileBtn);
	//alert(upfileBtn+imgObjPreview);
	//upfileBtn.click();
	
	if(upfileBtn.files && upfileBtn.files[0]){
        //imgObjPreview.style.width = '300px';
        imgObjPreview.style.height = '200px';
		imgObjPreview.src = window.URL.createObjectURL( upfileBtn.files[0] );
		imgObj.src = imgObjPreview.src;
	} else if(imgObjPreview.filters){
		upfileBtn.select();
		upfileBtn.blur();
		var imgSrc = document.selection.createRange().text;
		var localImagId = imgObjPreview;
		alert(localImagId.id);
		//�������ó�ʼ��С
		//localImagId.style.width = "300px";
		localImagId.style.height = "200px";
		try {
			localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
			localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
			//localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src='"+nfile+"')";  
		}catch(e){
				alert("���ϴ���ͼƬ��ʽ����ȷ��������ѡ��!");
				return false;
		}
        document.selection.empty();
	}else alert("Broswer not support preview!");
	
	//showImageInfo(imgObj);
	addAnImageField();
	return true;
}

function showImageInfo(imgObj){
	if (imgObj.readyState == "complete"){
		alert("地址："+imgObj.src+"\n宽度："
            +imgObj.width+"px\n高度："+imgObj.height+
            "px\n大小："+imgObj.fileSize+"字节");
	}
}

// �ж��ϴ����Ƿ�ΪͼƬ��֧�ֵĸ�ʽ����
function isImageFile( upfileBtn )
{
	if (!upfileBtn.value)
		return false;
	
	var st = upfileBtn.value.split('.');	// �и��ļ���
	var file_type = st[ st.length-1 ];		// ��ú�׺��
	if ( 	//֧�ֵĸ�ʽ
		(file_type == 'gif')
		|| (file_type == 'jpg')
		|| (file_type == 'jpeg')
		|| (file_type == 'bmp')
		|| (file_type == 'png')
		)
		return true;
		
	return false;
}

// ���Ԥ��ͼƬҪ�����λ�ã�obj��
function getTagImgToPlaceImage(upfileBtn)
{
	var targetTag = upfileBtn.parentNode.firstChild;
	while(!targetTag.src)
		targetTag = targetTag.nextSibling;
	return targetTag
}
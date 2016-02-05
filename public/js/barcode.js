function onEnter(e){
	var key=e.keyCode || e.which;
	if(key==13){
		showCell();
	}
}

function showCell(){
	iObj=document.getElementById("indexCell");
	index=iObj.value.trim();
	newIndex=eval(index)+1;
	
	rObj=document.getElementById("readBarcode");
	valBarcode=rObj.value.trim();

	rObj.value="";rObj.focus(); iObj.value=newIndex;
	doRequested('viewResult'+index,'readCell.php?val='+valBarcode+'&index='+newIndex,false);
}

//点击打卡管理中的选择背景图上传图片
var loadImageFile = (function () {
if (window.FileReader) {   
var oPreviewImg = null, oFReader = new window.FileReader(),   
rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;  
oFReader.onload = function (oFREvent) { 
if (!oPreviewImg) {   
var newPreview = document.getElementById("imagePreview");   
oPreviewImg = new Image();   
oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";   
oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";   
newPreview.appendChild(oPreviewImg);   
}   
oPreviewImg.src = oFREvent.target.result;   
};     
return function () {   
var aFiles = document.getElementById("imageInput").files;
size = aFiles[0].size;
if (aFiles.length === 0) { return; }   
if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }   
oFReader.readAsDataURL(aFiles[0]);   
}     
}     
})();  
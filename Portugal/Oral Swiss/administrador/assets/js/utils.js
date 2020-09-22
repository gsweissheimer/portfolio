function readFile(input, vfUploadId,vfMinWidth,vfMinHeight,vfUploadCrop,vfFunOperationEnd) {
  if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            var image  = new Image();
            image.addEventListener("load", function () {
              var imageInfo = input.name    +' '+ // get the value of `name` from the `file` Obj
                  image.width  +'×'+ // But get the width from our `image`
                  image.height +' '+
                  input.type    +' '+
                  Math.round(input.size/1024) +'KB';
                if(image.height >= vfMinHeight && image.width >= vfMinWidth){
                  $(vfUploadId).addClass('ready');
                  vfUploadCrop.croppie('bind', {
                    url: e.target.result
                  }).then(function(){
                    //console.log('jQuery bind complete');
                  });
                  vgFlagCanUpload = true;
                }else{
                  vgFlagCanUpload = false;
                }
                vfFunOperationEnd();
            });
            image.src = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
      }
}

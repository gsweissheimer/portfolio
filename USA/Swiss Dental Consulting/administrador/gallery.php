<div class="modal fade " id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><span class="glyphicon glyphicon-th"></span> <?=TRANS_GALLERY_TITLE; ?> </h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="nabTab"><a href="#1" aria-controls="1" role="tab" data-toggle="tab"><?= TRANS_GALLERY_NEW_FILE; ?></a></li>
          <li role="presentation" class="nabTab active"><a href="#2" aria-controls="2" role="tab" data-toggle="tab"><?= TRANS_GALLERY_IMAGE; ?></a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane d-flex h100" id="1">
            <form id="frm-file" name="frm-file" method="POST" enctype="multipart/form-data">
              <div class="col-sm-6" style="height:100%;">
                <p><?= TRANS_GALLERY_NEW_FILE_TITLE; ?></p>
                <div class="image-upload-wrap">
                  <input type='file' class="file-upload-input" name="uploadFile" onchange="funUploadFile(this)" id="uploadFile"/>
                  <div class="drag-text">
                    <h3><?=TRANS_GALLERY_NEW_FILE_UPLOAD; ?></h3>
                  </div>
                </div>
              </div>
              <div class="col-sm-1" style="height:100%;">
                OR
              </div>
              <div class="col-sm-5" style="height:100%;">
                <p><?= TRANS_GALLERY_NEW_FILE_TITLE; ?></p>
                <div class="form-group">
                  <label for="usr">Youtube Link:</label>
                  <input type="text" class="form-control" id="youSrc" name="youSrc">
                </div>
                <div class="form-group">
                  <button type="button" name="button" class="btn btn-info" onclick="funUploadFile(this)" id="youBtn">Upload</button>
                </div>
              </div>
              <input type="hidden" name="cmdEval" value="addFile">
              <input type="hidden" name="bot" value="">
            </form>
          </div>
          <div role="tabpanel" class="tab-pane active d-flex h100" id="2">
            <div class="row w100">
            <div id="filters" class="col-xs-12 marg-bot-20">
            </div>

            <div class="col-sm-12 d-flex">
              <div class="col-sm-9 no-pad-right" style="border:1px solid #ccc;">
                  <div id="gallery-parent" class="gallery-parent">
                  </div>
              </div>
              <div class="col-sm-3 gallery-info">
                <div id="gallery-child-info" class="gallery-right-tab-img hidden">
                  <div class="gallery-wrapper">
                    <div class="img-inner">
                        <img id="img-info" src="assets/img/user2-160x160.jpg" alt="" class="img-responsive">
                    </div>
                  <p>Detalhes</p>
                  <p id="img-size">1920x1080</p>
                  <p class="gallery-delete" onclick="funDeleteImage()">Delete Image</p>
                  <hr class="gallery-info-sep">
                  <form id="frm-update-info" method="post" action="includes/gallery-control.php">
                    <div class="input-group">
                      <label for="img-name">Nome da Imagem</label>
                      <input class="gallery-full-width" type="text" name="img-name" id="img-name" value="">
                    </div>
                    <div class="input-group">
                      <label for="img-alt">Texto Alternativo</label>
                      <input class="gallery-full-width" type="text" name="img-alt" id="img-alt" value="">
                    </div>
                    <div class="input-group">
                      <label for="desc">Description</label>
                      <textarea class="gallery-full-width gallery-textarea" type="text" name="img-desc" id="img-desc"></textarea>
                    </div>
                    <input type="hidden" name="cmdEval" value="updateImage">
                    <input type="hidden" name="bot" value="">
                    <div class="input-group">
                      <button id="btnUpdate" class="btn btn-primary hidden">Update</button>
                    </div>
                  </form>
                </div>

              </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="modal-footer">
        <span id="btnComplete" class="btn btn-success pull-right disabled" onclick="funImportData()"> Choose File</span>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var vgImageId = "";
  var vgIsMultiUpload = false;
  var vgObject = "";
  var vgSource = "";
  function funOpenGallery(isMultiUpload=false,vfObject,vfSource = "all"){
    vgIsMultiUpload = isMultiUpload;
    vgObject = vfObject;
    vgSource = vfSource;
    funCreateAll();
  }
  document.getElementById("btnUpdate").onclick = function(ev) {ev.preventDefault();funUpdateInfo()};
  function funUpdateInfo(){
    var myform = document.getElementById("frm-update-info");
    var fd = new FormData(myform );
    var url = $(myform).attr("action")+"?i=" + vgImageId;
    $.ajax({
      type: "POST",
      url: url,
      data: fd,
      cache:false,
      async: false,
      success: function (data) {
        var response = data.split("||");
        if(response[0]=="true"){
          $.notify(response[1],"success");
          $('.nav-tabs a[href="#2"]').tab('show');
          $(response[2]).prependTo("#gallery-parent");
          initGallery();
        }else{
          $.notify(response[1],"error");
        }
        $("#file-upload-input").val(null);
      },
      error: function(chr, desc, err){
        $.notify(response[1],"error");
        $("#file-upload-input").val(null);
      },
      cache: false,
      contentType: false,
      processData: false
    });
  }
  function funCreateAll(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var response = this.responseText;
          var viArrayValues = response.split("||");
          if(viArrayValues[0] == "true"){
              document.getElementById("gallery-parent").innerHTML = viArrayValues[1];
              document.getElementById("filters").innerHTML = viArrayValues[2];
              initGallery();
              $("#myModal").modal();
          }else{
              //alert("ERRO");
              $.notify("Oppsss... Something happened","error");
          }
      }
    };
    var query = window.location.search.substring(1);
    xmlhttp.open("GET", "includes/gallery-control.php?cmdEval=getInfoGallery", true);
    xmlhttp.send();
  }

  function funDeleteImage(){
    var url = "includes/gallery-control.php?cmdEval=deleteImage&i="+vgImageId;
    $.ajax({
      type: "POST",
      url: url,
      cache:false,
      async: false,
      success: function (data) {
        var response = data.split("||");
        if(response[0]=="true"){
          $.notify(response[1],"success");
          $(".gallery-parent").find("[data-id="+vgImageId+"]").parent().remove();
          $('#gallery-child-info').addClass("hidden");
        }else{
          $.notify(response[1],"error");
        }

      },
      error: function(chr, desc, err){
        $.notify(response[1],"error");
      },
      cache: false,
      contentType: false,
      processData: false
    });
  }
  function funControlFilters(vfFilter){
    $(".gallery-parent .all").addClass("hidden");
    $(".gallery-parent ."+vfFilter).removeClass("hidden");
  }
  function initGallery(){
    $("#file-upload-input").val('');
    $('.btn-filter').click(function(ev){
      ev.preventDefault();
      funControlFilters($(this).data("filter"));
    });
    $('.gallery-child img').parent().click(function(ev){
      ev.preventDefault();
      var currentEleHasClass = $(this).hasClass('border-active');
      if(!vgIsMultiUpload && !currentEleHasClass){
        $('.gallery-child img').parent().removeClass('border-active');
        $('.gallery-child').find('.abso-div').remove();
      }
      if(currentEleHasClass){
        $(this).removeClass('border-active');
        $(this).find('.abso-div').remove();
        $('#gallery-child-info').addClass("hidden");
      }else{
        $('#btnComplete').removeClass("disabled");
        $('#gallery-child-info').removeClass("hidden");
        $('#btnUpdate').removeClass("hidden");
        $(this).addClass('border-active');
        var imgSel = $(this).find('img');
        vgImageId = $(imgSel).data('id');
        var size = $(imgSel).data('width') + ' x ' + $(imgSel).data('height') + ' px';
        $('#img-size').html(size);
        $('#img-name').val($(imgSel).data('name'));
        $('#img-alt').val($(imgSel).data('alt'));
        $('#img-desc').val($(imgSel).data('desc'));
        $('#img-info').attr('src',$(imgSel).attr('src'));
        $(this).append('<div class="abso-div"><i class="fa fa-check" aria-hidden="true"></i></div>');
      }
    });

    $("#btnUpload").click(function() {
      $("input[id='my_file']").click();
    });
    if(vgSource != "" || vgSource != "all"){
      funControlFilters(vgSource);
      $("#filters").addClass("hidden");
    }
  }


  function funUploadFile(input) {
    if ((input.files && input.files[0]) || $(input).attr("id") == "youBtn") {
      var myform = document.getElementById("frm-file");
      var fd = new FormData(myform );
      var url = "includes/gallery-control.php";
      $.ajax({
        type: "POST",
        url: url,
        data: fd,
        cache:false,
        async: false,
        success: function (data) {
          var response = data.split("||");
          alert(response[0]);
          if(response[0]=="true"){
            $.notify(response[1],"success");
            $('.nav-tabs a[href="#2"]').tab('show');
            $(response[2]).prependTo("#gallery-parent");
            initGallery();
          }else{
            $.notify(response[1],"error");
          }
          $("#file-upload-input").val(null);
        },
        error: function(chr, desc, err){
          $.notify(response[1],"error");
          $("#file-upload-input").val(null);
        },
        cache: false,
        contentType: false,
        processData: false
      });
    } else {
      alert("invalid file");
      //removeUpload();
    }
  }

  function funImportData(){
    var viImages = "";
    var viSep = "";
    var img = "";
    
    if(!$("#btnComplete").hasClass('disabled')){
      var images = [];
      $( ".border-active" ).each(function( index ) {
        if(viImages != ""){viSep = "||";}
        viImages += viSep + $(this).find('img').data('id');
        img =  $(this).find('img').attr('src');
        images.push(img);
      });
      //console.log(typeof vgObject);
      //return false;
      if(typeof(vgObject)=="object"){vgObject = $(vgObject).attr("id");}

      $("#"+vgObject).val(viImages);

      
      if($("#bg_"+vgObject).length) {
        
        $("#bg_"+vgObject).attr("src",img)
      
      } else if ($("#bg_container").length) {
        //advanced banner adicionar
        $("#bg_container").html('');
        html = "";
        for (let i = 0; i < images.length; i++) {
          html += "<img style='padding-top: 10px;' src='"+images[i]+"' class='img-responsive'>"
        }
        $("#bg_container").html(html);
      
      }
      //$("#bg_"+vgObject).attr("src",img);
      /*$("#bg_container")
      for (let i = 0; i < images.length; i++) {
        console.log(images[i]);
      }*/
      $('#myModal').modal('hide');
    }

  }

</script>

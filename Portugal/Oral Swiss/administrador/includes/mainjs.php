<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/app.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="assets/plugins/chartjs/Chart.min.js"></script>
<script src="assets/js/notify.js"></script>

<script src="assets/plugins/tooltip/tooltip.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="components/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="includes/utils.js"></script>
<script>
  var url = "<?php //echo $_SESSION['mainPage'];?>";
  // Will only work if string in href matches with location
  $('ul.sidebar-menu a[href="'+ url +'"]').parent().addClass('active');

  // Will also work for relative and absolute hrefs
  $('ul.sidebar-menu a').filter(function() {
      return this.href == url;
  }).parent().addClass('active');

  function loadjscssfile(filename, filetype){
    if (filetype=="js"){ //if filename is a external JavaScript file
        var fileref=document.createElement('script')
        fileref.setAttribute("type","text/javascript")
        fileref.setAttribute("src", filename)
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("type", "text/css")
        fileref.setAttribute("href", filename)
    }
    if (typeof fileref!="undefined")
        document.getElementsByTagName("head")[0].appendChild(fileref)
  }
  var filesadded="" //list of files already added

function checkloadjscssfile(filename, filetype){
    if (filesadded.indexOf("["+filename+"]")==-1){
        loadjscssfile(filename, filetype)
        filesadded+="["+filename+"]" //List of files added in the form "[filename1],[filename2],etc"
    }
    else
        alert("file already added!")
}

</script>
<script src="assets/plugins/select2/select2.full.min.js"></script>
<script src="assets/plugins/datepicker/datepicker.js"></script>
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script type="text/javascript">
    function funStartEditor(){
        $("textarea").not("#img-desc").each(function(){
            var id = $(this).attr("id");
            //console.log(id);
            CKEDITOR.replace( id ,{
                toolbar: [
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                    { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField' ] },
                    '/',
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                    { name: 'links', items: [ 'Link', 'Unlink' ] },
                    { name: 'insert', items: [ 'Flash', 'HorizontalRule', 'Smiley'] },
                    '/',
                    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                    { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                ]
            });
        });
    }
    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    function funCreateCodOpe(text){
        var today = new Date();
        var dd = addZero(today.getDate());
        var mm = addZero(today.getMonth()+1); //January is 0!
        var yyyy = today.getFullYear();
        var h = addZero(today.getHours());
        var m = addZero(today.getMinutes());
        var s = addZero(today.getSeconds());
        var cod = dd+""+mm+""+yyyy+""+text+""+h+""+m+""+s;
        cod = cod.split("").reverse().join("");
        return cod;
    }

    function funNewRef(vfId){
        if(vfId == ""){vfId="idNews";}
        var idNews = document.getElementById(vfId).value;
        document.getElementById("codOper").value = funCreateCodOpe(idNews) ;
    }

    var listner = "";
    function funStartListen(){
        listner = setInterval(funListenAction, 650);
    }
    var counter = 0;
    function funListenAction(){
        clearInterval(listner);
        var codRef = document.getElementById("codOper").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                var viArrayValues = response.split("||");
                if(viArrayValues[0] == "true"){
                    var status = viArrayValues[1];
                    var msg = viArrayValues[2];
                    if(status=="1"){
                        $.notify(msg,"success");
                        funNewRef("");
                        window.location.assign("noticias.php");
                    }else if(status=='0'){
                        $.notify(msg,"error");
                        funNewRef("");
                    }else{
                        counter++;
                        if(counter<=3) {
                            funStartListen();
                        }else {
                            $.notify("Ocorreu um erro. Por favor, entre em contacto com a equipa tecnica!","error");
                            funNewRef("");
                        }
                    }
                }else{
                    //alert("ERRO");
                    console.log(response)
                    $.notify("Oppsss... Aconteceu um erro ao tentar ir buscar informação tradução!","error");
                }
            }
        };
        var query = window.location.search.substring(1);
        //xmlhttp.open("GET", "includes/getStatusAction.php?code=" + codRef, true);
        //xmlhttp.send();

        xmlhttp.open("POST", "includes/getStatusAction.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("code=" + codRef);
    }


</script>

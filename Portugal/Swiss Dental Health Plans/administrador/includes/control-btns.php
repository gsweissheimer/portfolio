<script>
  $(document).ready(function() {
    alert("carlos");
    funEnabledOrDisabled(true);
  });
  function funEnabledOrDisabled(vfIsToDisable){
      var form = document.getElementById("formFamo");
      var elements = form.elements;
      alert(elements.length)
      for (var i = 0, len = elements.length; i < len; ++i) {
          if(elements[i].type != "submit"){
              elements[i].disabled = vfIsToDisable;
          }
      }
  }

  function funActiveEdit(vfIsToActive){
      event.preventDefault();
      funEnabledOrDisabled(vfIsToActive);
      if(vfIsToActive){
          document.getElementById("btn-edit").classList.remove('hide');
          document.getElementById("btn-save").classList.add('hide');
          document.getElementById("btn-cancel").classList.add('hide');
      }else{
          document.getElementById("btn-edit").classList.add('hide');
          document.getElementById("btn-save").classList.remove('hide');
          document.getElementById("btn-cancel").classList.remove('hide');
      }
  }
</script>

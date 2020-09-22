function funEnabledOrDisabled(vfIsToDisable,vfFormId){
    var form = document.getElementById(vfFormId);
    var elements = form.elements;
    for (var i = 0, len = elements.length; i < len; ++i) {
        if(elements[i].type != "submit"){
            if(elements[i].type=="textarea"){
              // elements[i].disabled = vfIsToDisable;
              // debugger
              // $('textarea').attr('contenteditable', vfIsToDisable);
            }else{
              elements[i].disabled = vfIsToDisable;
            }
        }
    }
}

function funActiveEdit(vfIsToActive,vfFormId){
    event.preventDefault();
    funEnabledOrDisabled(vfIsToActive,vfFormId);
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

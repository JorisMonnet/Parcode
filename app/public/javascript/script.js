function showForm(){
    if(document.getElementById(editForm).Visibility==hidden){
        document.getElementById(editForm).setVisibility= visible;
        document.getElementById(deleteForm).setVisibility= visible;
    }else{
        document.getElementById(editForm).setVisibility= hidden;
        document.getElementById(deleteForm).setVisibility= hidden;
    }
}
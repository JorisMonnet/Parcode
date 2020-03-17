function showForm(){
    if(document.getElementById('editForm').style.visibility === 'hidden'){
        document.getElementById('editForm').style.visibility = 'visible';
        document.getElementById('deleteForm').style.visibility = 'visible';
    }else{
        document.getElementById('editForm').style.visibility = 'hidden';
        document.getElementById('deleteForm').style.visibility = 'hidden';
    }
}
function showEditComment(commentIndex){
    let hiddenForm = document.getElementsByClassName('hiddenForm');
    if(hiddenForm[commentIndex].style.display !=="block"){
        hiddenForm[commentIndex].style.display = "block";
        for(let i=0;i<hiddenForm.length;i++)
            hiddenForm[i].style.display = i==commentIndex?"block":"none";
    }else
        hiddenForm[commentIndex].style.display = "none";
}

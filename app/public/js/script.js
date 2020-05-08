function showEditComment(commentIndex){
    let hiddenForm = document.getElementsByClassName('hiddenForm');
    if(hiddenForm[commentIndex].style.display !=="block"){
        hiddenForm[commentIndex].style.display = "block";
        for(let i=0;i<hiddenForm.length;i++)
        if(i!=commentIndex)
            hiddenForm[i].style.display = "none";
    }else
        hiddenForm[commentIndex].style.display = "none";
}
function showEditComment(commentIndex){
    let hiddenForm = document.getElementsByClassName('hiddenForm');
    if(hiddenForm[commentIndex]!=null)
        if(hiddenForm[commentIndex].style.display === "none"){
            hiddenForm[commentIndex].style.display = "block";
            hiddenForm[commentIndex+1].style.display = "block";
        }else{
            hiddenForm[commentIndex].style.display = "none";
            hiddenForm[commentIndex+1].style.display = "none";
        }
}
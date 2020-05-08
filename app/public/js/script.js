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
function upvote(commentIndex){
    let votes = document.getElementsByClassName('voteLabel');
    let glyphicon_up = document.getElementsByClassName('glyphicon_up');
    let glyphicon_down = document.getElementsByClassName('glyphicon_down');
    if(parseInt(votes[commentIndex].innerHTML)>-1)
        glyphicon_up[commentIndex].style.visibility = "hidden";
    else
        glyphicon_up[commentIndex].style.visibility = "visible"
    votes[commentIndex].innerHTML= parseInt(votes[commentIndex].innerHTML)+1;
    if(glyphicon_down[commentIndex].style.visibility == "hidden")
        glyphicon_down[commentIndex].style.visibility = "visible"
}
function downvote(commentIndex){
    let votes = document.getElementsByClassName('voteLabel');
    let glyphicon_up = document.getElementsByClassName('glyphicon_up');
    let glyphicon_down = document.getElementsByClassName('glyphicon_down');
    if(parseInt(votes[commentIndex].innerHTML)<1)
        glyphicon_down[commentIndex].style.visibility = "hidden";
    else
        glyphicon_down[commentIndex].style.visibility = "visible"
    votes[commentIndex].innerHTML= parseInt(votes[commentIndex].innerHTML)-1;
    if(glyphicon_up[commentIndex].style.visibility == "hidden")
        glyphicon_up[commentIndex].style.visibility = "visible"
}
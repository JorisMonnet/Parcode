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

function sendVotes(votes,commentIndex) {
    let ids = document.getElementsByClassName('idComment');
    let request = new XMLHttpRequest();
    let data = new FormData();
    data.append('votes', votes);
    data.append('id',ids[commentIndex].innerHTML);
  
    request.open('POST', 'updateVotes',true);
    
    request.send(data);
}
var listVotes=[];

function addVote(commentIndex){
    if(listVotes[commentIndex]==null)
        listVotes[commentIndex] = new Vote(commentIndex);
}

class Vote{
    constructor(commentIndex){
        this.upvoted = false;
        this.downvoted = false;
        this.glyphicon_down = document.getElementsByClassName('glyphicon_down')[commentIndex];
        this.glyphicon_up = document.getElementsByClassName('glyphicon_up')[commentIndex];
        this.votes = document.getElementsByClassName('voteLabel');
        this.value = parseInt(this.votes[commentIndex].innerHTML);
        this.commentIndex = commentIndex
    }

    upvote(){
        this.upvoted= !this.upvoted;
        this.glyphicon_up.style.visibility = this.upvoted? "hidden": "visible";
        
        if(this.downvoted)
            this.showTwoGlyph();
        this.value+=1;
        this.votes[this.commentIndex].innerHTML=this.value;
        sendVotes(this.value,this.commentIndex);
    }

    downvote(){
        this.downvoted= !this.downvoted;
        this.glyphicon_down.style.visibility = this.downvoted? "hidden": "visible";
        
        if(this.upvoted)
            this.showTwoGlyph();
        this.value-=1;
        this.votes[this.commentIndex].innerHTML=this.value;
        sendVotes(this.value,this.commentIndex);
    }
    showTwoGlyph(){
        this.glyphicon_up.style.visibility = "visible";
        this.glyphicon_down.style.visibility = "visible";
        this.upvoted = !this.upvoted
        this.downvoted = !this.downvoted
    }
}
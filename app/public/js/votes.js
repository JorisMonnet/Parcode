function sendVotes(votes,commentIndex,value,idVote) {
    let idComments = document.getElementsByClassName('idComment');
    let request = new XMLHttpRequest();
    let data = new FormData();
    data.append('votes', votes);
    data.append('idComments',idComments[commentIndex].innerHTML);
    data.append('idVote', idVote);
    data.append('value',value);

    request.open('POST', 'updateVotes',true);
    
    request.send(data);

    window.location.reload();    //resort comments 
}

var listVotes=[];

function addVote(commentIndex,valueUser=0,idVote){
    if(listVotes[commentIndex]==null)
        listVotes[commentIndex] = new Vote(commentIndex,valueUser,idVote);
}

class Vote{
    constructor(commentIndex,ValueUser,idVote){
        this.upvoted = ValueUser>0;
        this.downvoted = ValueUser<0;
        this.glyphicon_down = document.getElementsByClassName('glyphicon_down')[commentIndex];
        this.glyphicon_up = document.getElementsByClassName('glyphicon_up')[commentIndex];
        
        if(this.upvoted)
            this.glyphicon_up.style.visibility = "hidden";
        if(this.downvoted)
            this.glyphicon_down.style.visibility = "hidden";

        this.votes = document.getElementsByClassName('voteLabel');
        this.value = parseInt(this.votes[commentIndex].innerHTML);
        this.commentIndex = commentIndex
        this.idVote = idVote;
    }

    upvote(){
        this.upvoted= !this.upvoted;
        this.glyphicon_up.style.visibility = this.upvoted? "hidden": "visible";
        
        if(this.downvoted)
            this.showTwoGlyph();
        this.value+=1;
        this.votes[this.commentIndex].innerHTML=this.value;
        sendVotes(this.value,this.commentIndex,1,this.idVote);
    }

    downvote(){
        this.downvoted= !this.downvoted;
        this.glyphicon_down.style.visibility = this.downvoted? "hidden": "visible";
        
        if(this.upvoted)
            this.showTwoGlyph();
        this.value-=1;
        this.votes[this.commentIndex].innerHTML=this.value;
        sendVotes(this.value,this.commentIndex,-1,this.idVote);
    }

    showTwoGlyph(){
        this.glyphicon_up.style.visibility = "visible";
        this.glyphicon_down.style.visibility = "visible";
        this.upvoted = !this.upvoted
        this.downvoted = !this.downvoted
    }
}
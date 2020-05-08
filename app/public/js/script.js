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
    
    if(glyphicon_up[commentIndex].style.visibility == "hidden")
        glyphicon_up[commentIndex].style.visibility = "visible"

    votes[commentIndex].innerHTML= parseInt(votes[commentIndex].innerHTML)-1;
    sendVotes(parseInt(votes[commentIndex].innerHTML))
    
}
function sendVotes(value) {
    var XHR = new XMLHttpRequest();
    var urlEncodedData = "";
  
    // Transformez l'objet data en un tableau de paires clé/valeur codées URL.
    let urlEncodedDataPairs=encodeURIComponent(votes) + '=' + encodeURIComponent(value);
  
    // remplacez tous
    // les espaces codés en % par le caractère'+' ; cela correspond au comportement
    // des soumissions de formulaires de navigateur.
    urlEncodedData = urlEncodedDataPairs.replace(/%20/g, '+');
  
    // Définissez ce qui se passe en cas de succès de soumission de données
    XHR.addEventListener('load', function(event) {
      alert('Ouais ! Données envoyées et réponse chargée.');
    });
  
    // Définissez ce qui arrive en cas d'erreur
    XHR.addEventListener('error', function(event) {
      alert('Oups! Quelque chose s\'est mal passé.');
    });
  
    // Configurez la requête
    XHR.open('POST', 'updateVotes');
  
    // Ajoutez l'en-tête HTTP requise pour requêtes POST de données de formulaire 
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    // Finalement, envoyez les données.
    XHR.send(urlEncodedData);
  }
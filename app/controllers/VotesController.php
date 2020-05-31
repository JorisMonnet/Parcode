<?php

require_once('app/models/Votes.php');

/**
 * Class which controlls the votes by the users
 */
class VotesController
{
    /**
     * This function is useful to know if the User had already voted for this comment
     * @param int $idComment it's the id of the comment which is voted by the user
     * @return bool if the user has already voted for this comment or not
     */
    public static function hasVoted($idComment){
        if(isset($_SESSION['userid'])){
            $votes = Votes::fetchSomething($idComment,"comments");
            return ($votes==null?false:in_array($_SESSION['userid'],$votes));
        }
    }

    /**
     * This function add a New votes to the database
     * @param int $value this can be 1 or -1 and corresponds to a downvote or an upvote
     * @param int $idcomments this is the id of the comment which is voted by the user
     * @return void the controller ask to the model to save in db the changes via save()
     */
    public static function parseAdd($value,$idComments){
        $vote = new Votes;
        $vote->setAuthor($_SESSION['userid']);
        $vote->setComments($idComments);
        $vote->setValue($value);
        $vote->save();
    }

    /**
     * This function delete a comment 
     * @param int $id the id of the vote we want to delete in the table
     * @return void
     * @throws Exception if the vote doesn't exist
     */
    public static function parseDelete($id){
        $vote=Votes::fetchSomething($id,"id");
        if(!$vote::delete($id))
            throw new Exception("Vote doesn't exist", 1);
    }

    /**
     * This function update a vote, if the value is now 0 after the new vote, 
     * we just delete the row in the database, otherwise, we update the vote with the entry table.
     * all entry elements are set, it had been verified in CommentController
     * @param array $entry all the entry to update the Vote table
     * @return void
     */
    public static function parseUpdate($entry){
        $vote = Votes::fetchSomething($entry['id'],"id");
        if($vote->getValue()+$entry['value']===0)
            VotesController::parseDelete($entry['id']);
        else
            Votes::update($entry);
    }
}
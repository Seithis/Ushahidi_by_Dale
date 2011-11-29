<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Revision Request - Load All Events
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Dale Douglas
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class revisionevents{

    public function __construct(){
        Event::add('system.pre_controller', array($this, 'add'));
    }
    public function add(){
        Event::add('ushahidi_action.report_extra', array($this, 'showRevisions'));
    }
    //returns all the comments for an incident
    public function getComments($incident_id=false){
        $db=Database::instance();
        $query="SELECT * FROM comment";
        if($incident_id != FALSE){
			$query .= ' WHERE incident_id = '.(int)$incident_id.';';
		}
		
		return $db->query($query);
    }
    /*Gets the current incident's ID number from the address bar, and then separates
    *out any comments with !revise! in them
    *
    */
    public function showRevisions(){
    //gets the incident id
        $id= (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	    $id=strrchr($id, "/");
	    $id=substr($id,1,strlen($id));
	    $comments=$this->getComments($id);
	    //just a check for if it's already printed out the header for the revision request area
	    $check=false;
	    if(count($comments)>0){  
	        foreach($comments as $comment){
	            //this is the tag it searches for
	            $value=stristr($comment->comment_description,"!revise!");
	            
	            if($value!=false){
	            //Removes the tag from the printout here
	                $value=substr($value,8);
	                //if it's already printed the title, don't do it again
	                if(!$check){
	                    ?><h6><?php echo "Requests for Revision"?></h6>
                        <?php
                        $check=true;
	                }
	                ?><b><?php echo $comment->comment_author?></b>
	                <?php echo '('.date('M j Y', strtotime($comment->comment_date)).')<br/>';
	                echo $value.'<br/>';
	                
	                
	            }
	        }
	    }
    }
}
new revisionevents;

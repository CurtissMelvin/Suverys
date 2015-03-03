<?php
/**
 * 
 * survey_view.php works with survey_list.php to create a list/view app
 *
 * The difference between demo_list.php and demo_list_pager.php is the reference to the 
 * Pager class which processes a mysqli SQL statement and spans records across multiple  
 * pages. 
 *
 * The associated view page, demo_view_pager.php is virtually identical to demo_view.php. 
 * The only difference is the pager version links to the list pager version to create a 
 * separate application from the original list/view. 
 * 
 * @package SurveySez
 * @author Curtiss Melvin <curtissm@hotmail.com>
 * @version 1.0 02/05/2015
 * @link http://www.curtissmelvin.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see survey_view.php
 * @see survey_list.php
 * @see index.php
 * @see Pager_inc.php 
 * @todo Create survey_view.php
 */

# '../' works for a sub-folder.  use './' for the root  

require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
 
# check variable of item passed in - if invalid data, forcibly redirect back to demo_list_pager.php page
if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
     $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
}else{
    myRedirect(VIRTUAL_PATH . "surveys/index.php");
}


$mySurvey = new Survey($myID);
if($mySurvey->isValid){
$config->titleTag = $mySurvey->Title . " survey!"; #overwrite PageTitle with Muffin info!
}
else{
$config->titleTag = "No such survey!";
}

//dumpDie($mySurvey);

# END CONFIG AREA ----------------------------------------------------------

get_header(); #defaults to theme header or header_inc.php

echo '
<h3 align="center">' . $config->titleTag . '</h3>
';
if($mySurvey->isValid)
{ #check to see if we have a valid SurveyID
    echo "<b>" . $mySurvey->SurveyID . ") </b>";
    echo "<b>" . $mySurvey->Title . "</b>-->";
    echo "<b>" . $mySurvey->Description . "</b><br />";
    echo $mySurvey->showQuestions();
    echo responseList($myID);
}else{
    echo "Sorry, no such survey!";   
}

get_footer(); #defaults to theme footer or footer_inc.php



function responseList($myID)
    {
       
    $myReturn = '';
     $sql = "select DateAdded,ResponseID from wn15_Responses where SurveyID=$myID";
     
     
        #reference images for pager
        $prev = '<img src="' . VIRTUAL_PATH . 'images/arrow_prev.gif" border="0" />';
        $next = '<img src="' . VIRTUAL_PATH . 'images/arrow_next.gif" border="0" />';
       
        # Create instance of new 'pager' class
        $myPager = new Pager(10,'',$prev,$next,'');
        $sql = $myPager->loadSQL($sql);  #load SQL, add offset
       
        # connection comes first in mysqli (improved) function
        $result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
        if(mysqli_num_rows($result) > 0)
        {#records exist - process
            if($myPager->showTotal()==1){$itemz = "responses";}
                else{$itemz = "responses";}  //deal with plural
         $myReturn .= '<div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</div>';
            while($row = mysqli_fetch_assoc($result))
            {# process each row
                  $myReturn .= '<div align="center">
                             <a href="' . VIRTUAL_PATH . 'Surveys/response_view.php?id=' . (int)$row['ResponseID'] . '">' . dbOut($row['DateAdded']) . '</a>';
                
               $myReturn .= '</div>';
            }
             $myPager->showNAV(); # show paging nav, only if enough records     
        }else{#no records
            "<div align=center>There are currently  No responses?  There must be a mistake!!</div>";   
        }
        @mysqli_free_result($result);
   
    return $myReturn ;
   
   
    }


?>


     
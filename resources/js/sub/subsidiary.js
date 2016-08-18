/*
*
* This file contain subsidiaries functions, like call CONFIRM Y/N windows and other.
*
 */

// Confirm window for delete buttons
function areUSure() {
    if(confirm("Вы уверены?")){
       return true;
    }else{
       return false;
    }
}
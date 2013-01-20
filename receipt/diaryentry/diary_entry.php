<?php

session_start();
/* if(!session_is_registered(username)) {
  header("location:../../index.php");
  } //$session id */


define('include_config', TRUE);
include_once '../../dbfiles/config.php';
if(!defined('include_diary_entry_class')){header('location:../../nodirectaccess.html');}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of diary_entry
 *
 * @author inderjeet
 */
class diary_entry {

    
    private $file_id; // array with entry indexes
    private $rec_id;
    private $mode;
    private $type;
    private $la;
    private $leda;
    private $recda;
    private $diada;
    private $name;
    private $add;
    private $email;
    private $country;
    private $state;
    private $contact;
    private $department;
    private $category;
    private $subject;
    private $tag;
    private $query= array();
    public function entry($mode, $la, $type, $le_da, $rec_da, $dia_da, $na, $add, $em, $c, $s, $con, $dep, $cat, $sub) {
        /* function will insert an entry into database
          with the following fields and generate a unique receipt
         */
        
        //echo 'a';
        $this->mode = $mode; //delivery mode variable
        $this->type = $type; // type of document
        $this->la = $la; //language of receipt
        $this->leda = $le_da; // letter date
        $this->recda= $rec_da; // received date
        $this->diada = $dia_da; // diary date
        $this->name = $na; // name of sender
        $this->add = $add; // address
        $this->tag= $_SESSION['dep'];
        $this->email = $em; // email of sender
        $this->country = $c; // country code
        $this->state= $s; //state code
        $this->contact = $con; // contact
        $this->department = $dep; // department 
        $this->category= $cat; // category
        $this->subject = $sub; //subject       
        db_connect();
        $this->query[file_id]= mysql_query("Select max(id) as id_file from file_upload");
        $result= mysql_fetch_assoc($this->query[file_id]);
        $this->file_id= $result['id_file'];
        $this->query[rec_id]= mysql_query("Select max(id) as rec_id from receipts ");
        $result2= mysql_fetch_assoc($this->query[rec_id]);
        $this->rec_id= $result2['rec_id']+1; 
        $this->query[rec]= mysql_query("Insert into receipts (id, del_mode, lang, type, rece_date, letter_date, diary_date, file_id, name, address, email, country, state, contact, department, category, subject, tag, user) values ('$this->rec_id', '$this->mode', '$this->la', '$this->type', '$this->recda', '$this->leda', '$this->diada', '$this->file_id', '$this->name', '$this->add', '$this->email', '$this->country', '$this->state', '$this->contact', '$this->department', '$this->category', '$this->subject', '$this->tag', '$_SESSION[username]')");
        if(!$this->query[rec]){
            echo mysql_error();
            header('location:../up_form.php?mesg=query_failed');
        }
        else{
            header('location:../up_form.php?mesg=success');
        }
    }

}
class del_file{
    private $id;
    public function delete($i) {
        $this->id= $i;
        db_connect();
        $del_up_file= mysql_query("Delete from file_upload where id=(Select file_id from receipts where id='$this->id')");
        if(!$del_up_file){
            $mesg= '<span style="color:red">'.  mysql_error().'</span>';
            header('location:../browse.php?mesg='.$mesg);
        }
        else{
        $del_up_file_info= mysql_query("Delete from receipts where id='$this->id'");
        if(!$del_up_file_info){
            $mesg= '<span style="color:red">'.  mysql_error().'</span>';
             header('location:../browse.php?mesg='.$mesg);
        }
        else{
            $mesg= '<span style="color:green">Receipt id '.$this->id.' had been deleted</span>';
             header('location:../browse.php?mesg='.$mesg);
        }
        }  
    }
}

?>

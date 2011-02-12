<?php
//--------------------------------------------------------------------------------------------------------------------------
// data_create.ejs.php
// v0.0.2
// Under GPLv3 License
//
// Integrated by: Ernesto Rodriguez in 2011
//
// Remember, this file is called via the Framework Store, this is the AJAX thing.
//--------------------------------------------------------------------------------------------------------------------------

// *************************************************************************************
// SANITIZE ALL ESCAPES
// *************************************************************************************
$sanitize_all_escapes=true;

// *************************************************************************************
// STOP FAKE REGISTER GLOBALS
// *************************************************************************************
$fake_register_globals=false;

// *************************************************************************************
// Load the OpenEMR Libraries
// *************************************************************************************
require_once("../../registry.php");

// *************************************************************************************
// Parce the data generated by EXTJS witch is JSON
// *************************************************************************************
$data = json_decode ( $_POST['row'] );

// *************************************************************************************
// Validate and pass the POST variables to an array
// This is the moment to validate the entered values from the user
// although Sencha EXTJS make good validation, we could check again 
// just in case 
// *************************************************************************************
// general info
$row['fname']             = trim($data[0]->fname);
$row['mname']             = trim($data[0]->mname);
$row['lname']             = trim($data[0]->lname);
$row['specialty']         = trim($data[0]->specialty);
$row['organization']      = trim($data[0]->organization);
$row['valedictory']       = trim($data[0]->valedictory);
// primary address
$row['street']            = trim($data[0]->street);
$row['streetb']           = trim($data[0]->streetb);
$row['city']              = trim($data[0]->city);
$row['state']             = trim($data[0]->state);
$row['zip']               = trim($data[0]->zip);
// secondary address
$row['street2']           = trim($data[0]->street2);
$row['streetb2']          = trim($data[0]->streetb2);
$row['city2']             = trim($data[0]->city2);
$row['state2']            = trim($data[0]->state2);
$row['zip2']              = trim($data[0]->zip2);
// phones
$row['phone']             = trim($data[0]->phone);
$row['phonew1']           = trim($data[0]->phonew1);
$row['phonew2']           = trim($data[0]->phonew2);
$row['phonecell']         = trim($data[0]->phonecell);
$row['fax']               = trim($data[0]->fax);
//additional info
$row['email']             = trim($data[0]->email);
$row['assistant']         = trim($data[0]->assistant);
$row['url']               = trim($data[0]->url);

$row['upin']              = trim($data[0]->upin);
$row['npi']               = trim($data[0]->npi);
$row['federaltaxid']      = trim($data[0]->federaltaxid);
$row['taxonomy']          = trim($data[0]->taxonomy);
$row['notes']             = trim($data[0]->notes);



// *************************************************************************************
// Finally that validated POST variables is inserted to the database
// This one make the JOB of two, if it has an ID key run the UPDATE statement
// if not run the INSERT stament
// *************************************************************************************
sqlStatement("INSERT INTO 
        users 
      SET
        username          = '" . "" . "', " . "
        password          = '" . "" . "', " . "
        fname             = '" . $row['fname'] . "', " . "
        mname             = '" . $row['mname'] . "', " . "
        lname             = '" . $row['lname'] . "', " . "
        specialty         = '" . $row['specialty'] . "', " . "
        organization      = '" . $row['organization'] . "', " . "
        valedictory       = '" . $row['valedictory'] . "', " . "
        street            = '" . $row['street'] . "', " . "
        streetb           = '" . $row['streetb'] . "', " . "
        city              = '" . $row['city'] . "', " . "
        state             = '" . $row['state'] . "', " . "
        zip               = '" . $row['zip'] . "', " . "
        street2           = '" . $row['street2'] . "', " . "
        streetb2          = '" . $row['streetb2'] . "', " . "
        city2             = '" . $row['city2'] . "', " . "
        state2            = '" . $row['state2'] . "', " . "
        zip2              = '" . $row['zip2'] . "', " . "
        phone             = '" . $row['phone'] . "', " . "
        phonew1           = '" . $row['phonew1'] . "', " . "
        phonew2           = '" . $row['phonew2'] . "', " . "
        phonecell         = '" . $row['phonecell'] . "', " . "
        fax               = '" . $row['fax'] . "', " . "
        email             = '" . $row['email'] . "', " . "
        assistant         = '" . $row['assistant'] . "', " . "
        url               = '" . $row['url'] . "', " . "
        upin              = '" . $row['upin'] . "', " . "
        npi               = '" . $row['npi'] . "', " . "
        federaltaxid      = '" . $row['federaltaxid'] . "', " . "
        taxonomy          = '" . $row['taxonomy'] . "', " . "
        notes             = '" . $row['notes'] . "'");
?>
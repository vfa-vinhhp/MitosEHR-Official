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
session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');
include_once($_SESSION['site']['root']."/library/dbHelper/dbHelper.inc.php");
include_once($_SESSION['site']['root']."/library/passwords/password.class.php");
require_once($_SESSION['site']['root']."/library/phpAES/AES.class.php");
//******************************************************************************
// Reset session count 10 secs = 1 Flop
//******************************************************************************
$_SESSION['site']['flops'] = 0;
//-------------------------------------------
// password to AES and validate
//-------------------------------------------
$aes = new AES($_SESSION['site']['AESkey']);
//------------------------------------------
// Database class instance
//------------------------------------------
$mitos_db = new dbHelper();
$password_class = new password();
// *************************************************************************************
// Parse the data generated by EXTJS witch is JSON
// *************************************************************************************
$data = json_decode ( $_POST['row'], true );
// *************************************************************************************
// Validate and pass the POST variables to an array
// This is the moment to validate the entered values from the user
// although Sencha EXTJS make good validation, we could check again 
// just in case 
// *************************************************************************************
if($data['nPassword'] != null || $data['nPassword'] != '' && $data['oPassword'] != null || $data['oPassword'] != '' ){

    $password_class->nPassword = $data['nPassword'];
    $password_class->oPassword = $data['oPassword'];
    $password_class->user_id = $data['id'];
    $password_class->changePassword();
    //$ret = $aes->encrypt($data['oPassword']);
    //$sql = "SELECT * FROM users
    //         WHERE id='" . $data['id'] . "'
    //           AND password='" . $ret . "'
    //           AND authorized='1'
    //         LIMIT 1";
    //$mitos_db->setSQL($sql);
    //$rec = $mitos_db->fetch();
    //if ($rec['username'] == ""){
    //    echo "{ success: false, errors: { reason: 'The password you provided is invalid.'}}";
    //    return;
    //} else {
    //$row['password']       	  = $aes->encrypt($data['nPassword']);
    //}
}else{
    $row['username']          = $data['username'];
    $row['title']             = $data['title'];
    $row['fname']             = $data['fname'];
    $row['mname']             = $data['mname'];
    $row['lname']             = $data['lname'];
    $row['facility_id']       = $data['facility_id'];
    $row['specialty']         = $data['specialty'];
    $row['valedictory']       = $data['valedictory'];
    $row['url']               = $data['url'];
    $row['upin']              = $data['upin'];
    $row['npi']               = $data['npi'];
    $row['federaltaxid']      = $data['federaltaxid'];
    $row['taxonomy']          = $data['taxonomy'];
}

// *************************************************************************************
// Finally that validated POST variables is inserted to the database
// This one make the JOB of two, if it has an ID key run the UPDATE statement
// if not run the INSERT statement
// *************************************************************************************
$sql = $mitos_db->sqlBind($row, "users", "U", "id='" .$data['id'] . "'");
$mitos_db->setSQL($sql);
$ret = $mitos_db->execLog();

if ( $ret == "" ){
	echo '{ success: false, errors: { reason: "'. $ret[2] .'" }}';
} else {
	echo "{ success: true }";
}

?>
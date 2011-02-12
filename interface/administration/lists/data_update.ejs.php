<?php
//--------------------------------------------------------------------------------------------------------------------------
// data_create.ejs.php
// v0.0.2
// Under GPLv3 License
//
// Integrated by: GI Technologies Inc. in 2011
//
// Remember, this file is called via the Framework Store, this is the AJAX thing.
//--------------------------------------------------------------------------------------------------------------------------

// *************************************************************************************
//SANITIZE ALL ESCAPES
// *************************************************************************************
$sanitize_all_escapes=true;

// *************************************************************************************
//STOP FAKE REGISTER GLOBALS
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
$row['id'] = trim($data[0]->id);
$row['name'] = trim($data[0]->name);
$row['phone'] = trim($data[0]->phone);
$row['fax'] = trim($data[0]->fax);
$row['street'] = trim($data[0]->street);
$row['city'] = trim($data[0]->city);
$row['state'] = trim($data[0]->state);
$row['postal_code'] = trim($data[0]->postal_code);
$row['country_code'] = trim($data[0]->country_code);
$row['federal_ein'] = trim($data[0]->federal_ein);
$row['x12_sender_id'] = trim($data[0]->x12_sender_id);
$row['service_location'] = (trim($data[0]->service_location) == 'on' ? 1 : 0);
$row['accepts_assignment'] = (trim($data[0]->accepts_assignment) == 'on' ? 1 : 0);
$row['billing_location'] = (trim($data[0]->billing_location) == 'on' ? 1 : 0);
$row['pos_code'] = trim($data[0]->pos_code);
$row['domain_identifier'] = trim($data[0]->domain_identifier);
$row['attn'] = trim($data[0]->attn);
$row['tax_id_type'] = trim($data[0]->tax_id_type);
$row['facility_npi'] = trim($data[0]->facility_npi);

// *************************************************************************************
// Finally that validated POST variables is inserted to the database
// This one make the JOB of two, if it has an ID key run the UPDATE statement
// if not run the INSERT stament
// *************************************************************************************
sqlStatement("UPDATE 
				facility 
			SET
				id = '" . $row['id'] . "', " . "
				name = '" . $row['name'] . "', " . "
				phone = '" . $row['phone'] . "', " . "
				fax = '" . $row['fax'] . "', " . "
				street = '" . $row['street'] . "', " . "
				city = '" . $row['city'] . "', " . "
				state = '" . $row['state'] . "', " . "
				postal_code = '" . $row['postal_code'] . "', " . "
				country_code = '" . $row['country_code'] . "', " . "
				federal_ein = '" . $row['federal_ein'] . "', " . "
				service_location = '" . $row['service_location'] . "', " . " 
				billing_location = '" . $row['billing_location'] . "', " . "
				accepts_assignment = '" . $row['accepts_assignment'] . "', " . "
				pos_code = '" . $row['pos_code'] . "', " . "
				domain_identifier = '" . $row['domain_identifier'] . "', " . "
				attn = '" . $row['attn'] . "', " . " 
				tax_id_type = '" . $row['tax_id_type'] . "', " . "
				facility_npi = '" . $row['facility_npi'] . "' " . " 
			WHERE id ='" . $row['id'] . "'");

?>
<?php 
session_start();

if(!isset($_SESSION['id'])){
	header("location: ?p=1&session=session-invalid");
	exit();	
} 
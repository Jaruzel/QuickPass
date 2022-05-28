<?php
$host=$_SERVER['HTTP_HOST'];
$url=$_SERVER['REQUEST_URI'];
$site=$_SERVER['REQUEST_SCHEME']."://".$host;

$specials=array("!","£","$","%","&","*","@","~");

$page=fnReadFile("_page.html");

$noundata=fnReadFile("nouns.txt");
$verbdata=fnReadFile("verbs.txt");
$adjdata=fnReadFile("adjectives.txt");
$nounarray=explode("\r\n",$noundata);
$verbarray=explode("\r\n",$verbdata);
$adjarray=explode("\r\n",$adjdata);

$passwordlist="";
for ($loop = 0; $loop <= 10; $loop++) {
	$getpass=fnBuildPass();
	$passwordlist=$passwordlist."<div class='password-entry'>".$getpass."</div>";
}

$page=str_replace("%PASSWORDS%",$passwordlist,$page);

echo($page);

exit();


function fnBuildPass() {

	global $nounarray, $verbarray, $adjarray, $specials;
	
	$nounid=rand(0,count($nounarray)-1);
	$verbid=rand(0,count($verbarray)-1);
	$adjid=rand(0,count($adjarray)-1);
	$spcid=rand(0,count($specials)-1);
	
	//Done like this so the format can be easily adjusted.
	$ThePassword="";
	$ThePassword=$ThePassword.$adjarray[$adjid];
	$ThePassword=$ThePassword.$verbarray[$verbid];
	$ThePassword=$ThePassword.$nounarray[$nounid];
	$ThePassword=$ThePassword.rand(0,9);
	$ThePassword=$ThePassword.rand(0,9);
	$ThePassword=$ThePassword.rand(0,9);
	$ThePassword=$ThePassword.rand(0,9);
	$ThePassword=$ThePassword.$specials[$spcid];
			
	return $ThePassword;

}

// ------------------------------------------------------------------------------------
function fnReadFile($fileName) 
{
	$strFileData="";
	if (file_exists($fileName)) {
		$objFile = fopen($fileName, "r") or die("Unable to open file!");
		if (filesize($fileName)>0) {
			$strFileData=fread($objFile,filesize($fileName));
		}
		return $strFileData;
		
	} else {
		return "";
	}
}


?>

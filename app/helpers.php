<?php 

/**
*	Contact parser
*	
*	This function take $ic and find a contact in rzp then start parsing data.
*	First i prepare more data and contact array(). Than take H3 in class .data and explode it to format 
*	[number of findet contact, name of contact] or [number of findet contact,titel of contact, name of contact] 
*	this datas give to array contact like name. Next i explode address and parameters i give to contact.
*	I teke  moreData and i take from there ic.
*	Last i check if is contact "Fyzická osoba" and if is it explode name and give it to array as 
*	firstname and lastname. 
*	$moreData = [Typ podnikatele, Sídlo, Role Subjektu, IČ];
*
* 	@param (string) $ic IČ of contact
*	@return (array) of contacts
*
*/
function getContactsBy($ic='') {
	$page = new Htmldom('http://www.rzp.cz/cgi-bin/aps_cacheWEB.sh?VSS_SERV=ZVWSBJFND&PRESVYBER=0&VYPIS=2&ICO='.e($ic).'&Action=Search');
	
		$data = $page->find('.data')[0];
		$contact 				= array();
		$moreData 				= $data->find('.aktual');

		$nadpis 				= explode('. ',$data->find('h3')[0]->plaintext);
		$address				= explode(', ',$moreData[1]->plaintext);
		
		$contact['name'] 		= (count($nadpis)>2)?$nadpis[1].'. '.$nadpis[2]:$nadpis[1]; 

		$contact['adress'] 		= $address[0];
		$contact['zip_code']	= $address[1];
		$contact['city']		= $address[2];
		$contact['ic']			= $moreData[3]->plaintext;

		if($moreData[0]->plaintext == 'Fyzická osoba') {
			echo count($nadpis);
			$index =(count($nadpis)==3?2:1);
			echo $index;
			$fullname 				= explode(' ',($nadpis[$index]));
			$contact['firstname'] 	= $fullname[0];
			$contact['lastname'] 	= $fullname[1];
		}
	
	
	return $contact;
}
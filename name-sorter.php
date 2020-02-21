<?php

class ReadFile{
	public $NameFile = 'unsorted-names-list.txt';
	public $NewNameFile = 'sorted-names-list.txt';

	function get_name_file($NameFile){
	    $this->NameFile = $NameFile;
	}

	function set_name_file($NewNameFile){
	    $this->NewNameFile = $NewNameFile;
	}


	function getFirstName($name){
	    return implode(' ', array_slice(explode(' ', $name), 0, -1));
	}

	function getLastName($name){
	    return array_slice(explode(' ', $name), -1)[0];
	}

	function getDataName(){
		$getNameFile = new ReadFile();
		$fp = fopen($getNameFile->NameFile, "r");
		$content = fread($fp, filesize($getNameFile->NameFile));
		$lines = explode("\n", $content);
		fclose($fp);
		return $lines;
	}

	function sortDataName(){
		$datalines = $this->getDataName();
		foreach ($datalines as $name) {
		$fname = $this->getFirstName($name);
		$lname = $this->getLastName($name);
		$DataName = array(
			'firstname' => $fname,
			'lastname' => $lname
		);

	  	$firstnames[] = $fname;
		$lastnames[] = $lname;
		$DataNameFull[] = $DataName;
		}
		array_multisort($lastnames, SORT_ASC, $firstnames, SORT_ASC, $DataNameFull);

		foreach ($DataNameFull as $finalNameSort) {
			echo $finalNameSort['firstname']." ".$finalNameSort['lastname']."<br>";
			$finalnames[] = ($finalNameSort['firstname']) ? $finalNameSort['firstname']." ".$finalNameSort['lastname'] : $finalNameSort['lastname'];
		}
		return $finalnames;
	}

	function saveDataName(){
		$saveNameFile = new ReadFile();
		$datafilenames = $this->sortDataName();
		$myfile = fopen($saveNameFile->NewNameFile, "w") or die("Unable to open file!");
		fwrite($myfile, implode("\n", $datafilenames));
		fclose($myfile);
	}
}

	$run = new ReadFile();
	$run->saveDataName();

# I wrote this code
?>
<?php
if(!empty($_POST['data'])){
	$root = $_SERVER['DOCUMENT_ROOT'];
	$data =  $_POST['data'];
	$name = str_replace(' ','-',$data);
	copy('arquivos/'.$data, "arquivos/temp/".$name);
	//echo $name;
	$lineExec = 'start winword '.$root.'/word/arquivos/'.$data;
	//echo "start winword ".$root."/word/arquivos/".$data;
	exec('start winword '.$root.'/word/arquivos/temp/'.$name);
}
?>
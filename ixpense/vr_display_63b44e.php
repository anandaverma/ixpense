<?php

function vrErrorNotFound ($filename) {
	header("HTTP/1.0 404 Not Found");
	echo ("Requested page not found");
	exit;
}


function getHtmlContent($filename) {
	if ($filename == 'index.html') {
		if (!file_exists ('index.html')) $filename = 'index.htm';
	}

	if (!file_exists($filename))
		return vrErrorNotFound ($filename);

	$fileLength = strlen ($filename);

	if (strpos (strtolower ($filename), '.htm', $fileLength-5) !== false) {
		$content = implode('',file($filename));

		if (file_exists ($filename)) return $content;
	}

	exit;
}

function vrInsertBanner ($vrCode, $content) {
	$contentReplaced = str_replace ('<!--__REPLACE_THIS__-->', $vrCode, $content);

	if ($contentReplaced == $content) {
		$contentReplaced = preg_replace ('/<!--[ ]*__REPLACE_THIS__[ ]*-->/', $vrCode, $content);
	}

	if ($contentReplaced == $content) {
		$contentReplaced = str_replace ('</body>', $vrCode . '</body>', $content);
	}

	if ($contentReplaced == $content) {
		$contentReplaced = str_replace ('</BODY>', $vrCode . '</BODY>', $content);
	}

	if ($contentReplaced == $content) {
		$contentReplaced = str_replace ('</Body>', $vrCode . '</Body>', $content);
	}

	return $contentReplaced;
}

$content = getHtmlContent(str_replace ('../', '', $_GET['filename']));
include_once ('63b44e375386f6f19c527e7.php');
$voltRank = new VoltRank ();
echo vrInsertBanner ($voltRank->display (), $content);

?>
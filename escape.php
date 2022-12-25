<?php
function escape_html(string $s) {
	$s = str_replace('"', '&quot', $s);
	$s = str_replace('&', '&amp', $s);
	$s = str_replace('<', '&lt', $s);
	$s = str_replace('>', '&gt', $s);
return $s;
}

function escape_pg(string $s) {
	#$s = str_replace("'", "\\'", $s);
	# "abc'def" -> "abc\\'def"
	$s = str_replace('\'', '\\\'', $s);
	$s = str_replace('\n', '\r', $s);
	$s = str_replace('\\', '\t', $s);
return $s;
}


//$s = str_replace('\'', '\'\'', $s);
# "abc'def" -> "abc''def"
?>
<?php

	require_once '../include.php';

	if (array_key_exists('your-message', $_POST) && strlen($_POST['your-message']))
	{
		$headers = "From: Site da loja <loja@furries.com.br>\r\nReply-To: furriesbr@googlegroups.com";
		$name = $_POST['your-name'];
		$email = $_POST['your-email'];
		$link = $_POST['your-link'];
		$body = $_POST['your-message'];
		$msg = "De: $name <$email>\r\n\r\nLink: $link\r\n\r\n$body";
		mail('loja@furries.com.br', 'Sugestao', $msg, $headers);
		$smarty->page('sent');
	}
	else if ($_SERVER['QUERY_STRING'] == 'test')
		$smarty->page('sent');
	else
		$smarty->page('contact');

?>

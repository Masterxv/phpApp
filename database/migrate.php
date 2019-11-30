<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require ('tables/apps.php');
	require ('tables/chat.php');
	require ('tables/emails.php');
	require ('tables/files.php');
	require ('tables/guests.php');
	require ('tables/license_details.php');
	require ('tables/licenses.php');
	require ('tables/logs.php');
	require ('tables/push_messages.php');
	require ('tables/push_subscriptions.php');
	require ('tables/queries.php');
	require ('tables/recharge_history.php');
	require ('tables/sessions.php');
	require ('tables/usage_report.php');
	require ('tables/users.php');
	require ('tables/validation_messages.php');
	require ('tables/validation_rules.php');
	require ('tables/virtual_alias.php');
	require ('tables/virtual_domains.php');
	require ('tables/virtual_users.php');
}
?>
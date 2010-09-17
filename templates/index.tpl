<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Support Dashboard</title>
		
		<link rel="stylesheet" type="text/css" href="./templates/css/reset.css" media="screen">
		<link rel="stylesheet" type="text/css" href="./templates/css/style.css" media="screen">
	</head>
	<body>
		<div id="main">
			<div id="info_bar">
				<h1>Support Calls</h1>
				<h1>
					{$total_call_count} {if $total_call_count == 1} call {else} calls {/if} / 
					{$total_call_duration} {if $total_call_duration == 1} minute {else} minutes {/if} / 
					${$total_spent} spent
				</h1>
			</div>
			<table id="calls" cellspacing="0" summary="Support calls placed.">
				<tr>
					<th scope="col">Caller</th>
					<th scope="col">Time</th>
					<th scope="col">Duration</th>
				</tr>
				{loop $calls}
				<tr>
					<td>{$from}</td>
					<td>{date_format $start_time "%B %e, %Y at %l:%M %p"}</td>
					<td>{$duration} {if $duration == 1} minute {else} minutes {/if}</td>
				</tr>
				{/loop}
			</table>
		</div>
	</body>
</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Support Dashboard</title>
		
		<link rel="stylesheet" type="text/css" href="./templates/css/reset.css" media="screen">
		<link rel="stylesheet" type="text/css" href="./templates/css/style.css" media="screen">

		{* There's no point showing a chart for anything less than 5 datapoints *}
		{if $total_call_count > 5}
		<style type="text/css">
			#info_bar h1 + h1 {
				margin-bottom: 4em;
			}

			#call_volume_chart {
				clear: both;
				width: 940px;
				height: 49px;
				margin-bottom: 4.2em;
			}
		</style>

		<script src="./templates/js/raphael-min.js" type="text/javascript" charset="utf-8"></script>
		<script src="./templates/js/g.raphael-min.js" type="text/javascript" charset="utf-8"></script>
		<script src="./templates/js/g.dot-min.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" charset="utf-8">
			// Essentially straight from http://g.raphaeljs.com/dotchart.html
			window.onload = function () {
				var r = Raphael("call_volume_chart"),
					xs = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
					ys = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
					data = [{$call_volume_chart_data}],
					axisx = ["12 AM", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12 PM", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11 PM"];
				r.g.txtattr.font = "11px 'Fontin Sans', Fontin-Sans, sans-serif";
                
				r.g.dotchart(0, 0, 920, 49, xs, ys, data, {literal}{symbol: "o", max: 12, heat: false, axis: "0 0 1 0", axisxstep: 23, axisystep: 1, axisxlabels: axisx, axisxtype: " ", axisytype: " ", axisylabels: " "}{/literal}).hover(function () {
					this.tag = this.tag || r.g.tag(this.x, this.y, this.value, 0, this.r + 2).insertBefore(this);
					this.tag.show();
				}, function () {
					this.tag && this.tag.hide();
				});
			};
		</script>
		{/if}
	</head>
	<body>
		{if isset($error)}
			<p class="error">{$error}</p>
		{/if}
		<div id="main">
			<div id="info_bar">
				<h1>Support Calls</h1>
				<h1>
					{$total_call_count} {if $total_call_count == 1} call {else} calls {/if} / 
					{$total_call_duration} {if $total_call_duration == 1} minute {else} minutes {/if} / 
					${$total_spent} spent
				</h1>
			</div>
			{if $total_call_count > 5} <div id="call_volume_chart"></div> {/if}
			<table id="calls" cellspacing="0" summary="Support calls placed.">
				<tr>
					<th scope="col">Caller</th>
					<th scope="col">Location</th>
					<th scope="col">Time</th>
					<th scope="col">Duration</th>
				</tr>
				{loop $calls}
				<tr>
					<td>{$from}</td>
					<td>{if count_characters($location) > 0} {$location} {else} &#8211; {/if}</td>
					<td>{$start_time}</td>
					<td>{$duration} {if $duration == 1} minute {else} minutes {/if}</td>
				</tr>
				{/loop}
			</table>
		</div>
	</body>
</html>

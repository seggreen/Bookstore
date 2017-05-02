<?php
 session_start();

	# title...
	$title = "";

	# import db connection
	include "config/db.php";

	# include functions
	include "config/includes/functions.php";

	# import header
	include "config/includes/dashboard_header.php";

	#ERROR.....
	$errors = [];
?>
<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>Book Title</th>
						<th>Author</th>
						<th>Price</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>the knowledge gap</td>
						<td>maja</td>
						<td>January, 10</td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr>
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>

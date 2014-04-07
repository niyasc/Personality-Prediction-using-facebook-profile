<head>
<?php if (isset($title)): ?>
            <title>Personality Test : <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Personality Test</title>
        <?php endif ?>
<link rel="stylesheet" type="text/css" href="./css/mystyle.css">
<link href="./css/bootstrap.css" rel="stylesheet"/>
</head>
<div class='header'>
<table class='table'>
	<tr>
		<td style='font-size:20px;text-decoration:underline'>
			Personality Test
		</td>
		<td style='text-align:right'>
			<?php
				if($template=="question.php")
					echo "Welcome ".$values["name"];
			?>
		</td>
	</tr>
</table>
</div>
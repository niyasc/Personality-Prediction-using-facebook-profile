<div style = "text-align:center">
 	<h4>
		<?=$values["name"]["name"]?>
	</h4>
	<img src = "<?=$values["image"]?>" style = "width:100px"/> 
</div>

<?php
	$traits = $values["traits"];
	$names = ["Extraversion", "Agreeableness", "Conscientiousness", "Neuroticism", "Openness"];
	if(count($traits[0])==1) //User has not attended the questions
	{
		echo "<table class = 'table table-striped table-borderd table-condensed' style='margin-left:auto; margin-right:auto'>";
			echo "<tr>";
				echo "<td>";
					<h4>Traits</h4>
				echo "</td>";
				echo "<td>";
					<h4>Predicted Value</h4>
				echo "</td>";
			echo "</tr>";
			$i = 0;
			while($i < 5)
			{
				echo "<tr>";
					echo "<td>";
						echo $names[$i];
					echo "</td>";
					echo "<td>";
						echo round($traits[$i], 2);
					echo "</td>";
				echo "</tr>";
				$i += 1;
			}
		echo "</table>";
	}
	else
	{
		echo "<table class = 'table table-striped table-borderd table-condensed' style='margin-left:auto; margin-right:auto'>";
			echo "<tr>";
				echo "<td>";
					<h4>Traits</h4>
				echo "</td>";
				echo "<td>";
					<h4>Predicted Value</h4>
				echo "</td>";
				echo "<td>";
					<h4>Actual Value</h4>
				echo "</td>";
				echo "<td>";
					<h4>Error</h4>
				echo "</td>";
				
			echo "</tr>";
			$i = 0;
			while($i < 5)
			{
				echo "<tr>";
					echo "<td>";
						echo $names[$i];
					echo "</td>";
					echo "<td>";
						echo round($traits[$i][0], 2);
					echo "</td>";
					echo "<td>";
						echo round($traits[$i][1], 2);
					echo "</td>";
					echo "<td>";
						echo round($traits[$i][2], 2);
					echo "</td>";
				echo "</tr>";
				$i += 1;
			}
		echo "</table>";
	}


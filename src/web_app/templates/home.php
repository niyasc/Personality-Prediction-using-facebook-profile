<div style = "text-align:center">
 	<h4>
		<?=$values["name"]["name"]?>
	</h4>
	<img src = "<?=$values["image"]?>" style = "width:100px"/> 
</div>

<?php
	function plot($color='black',$length=5)
	{
		//print 'in plot';
		echo "<div style='border:0px solid white;background:".$color.";height:25px;width:".($length*50)."'>";
		echo round($length,2);
		echo "</div>";
		//echo $length;
	}
	$colors = ["yellow", "green", "orange", "lightblue", "silver"];
	$traits = $values["traits"];
	$names = ["Extraversion", "Agreeableness", "Conscientiousness", "Neuroticism", "Openness"];
	if(count($traits[0])==1) //User has not attended the questions
	{
		echo "<table class = 'table table-striped table-bordered' style='margin-left:auto; margin-right:auto; width:400px'>";
			echo "<tr>";
				echo "<td>";
					echo "<h4>Traits</h4>";
				echo "</td>";
				echo "<td>";
					echo "<h4>Predicted Value</h4>";
				echo "</td>";
			echo "</tr>";
			$i = 0;
			while($i < 5)
			{
				echo "<tr>";
					echo "<td>";
						echo "<h5>".$names[$i]."</h5>";
					echo "</td>";
					echo "<td>";
						//echo round($traits[$i], 2);
						plot($colors[$i], $traits[$i]);
					echo "</td>";
				echo "</tr>";
				$i += 1;
			}
		echo "</table>";
		echo "<div style='text-align:center'>";
			echo "<a href='index-test.php' class='btn btn-primary'>";
				echo "<h4>Take Personality Quiz</h4>";
			echo "</a>";
		echo "</div>";

	}
	else
	{
		echo "<table class = 'table table-striped table-bordered' style='margin-left:auto; margin-right:auto; width:400px'>";
			echo "<tr>";
				echo "<td>";
					echo "<h4>Traits</h4>";
				echo "</td>";
				echo "<td>";
					echo "<h4>Predicted Value</h4>";
				echo "</td>";
				echo "<td>";
					echo "<h4>Actual Value</h4>";
				echo "</td>";
				echo "<td>";
					echo "<h4>Error</h4>";
				echo "</td>";
				
			echo "</tr>";
			$i = 0;
			while($i < 5)
			{
				echo "<tr>";
					echo "<td>";
						echo "<h5>".$names[$i]."</h5>";
					echo "</td>";
					echo "<td>";
						//echo round($traits[$i][0], 2);
						plot($colors[$i], $traits[$i][0]);
					echo "</td>";
					echo "<td>";
						//echo round($traits[$i][1], 2);
						plot($colors[$i], $traits[$i][1]);
					echo "</td>";
					echo "<td>";
						echo round($traits[$i][2], 2)."%";
					echo "</td>";
				echo "</tr>";
				$i += 1;
			}
		echo "</table>";
		echo "<div style='text-align:center'>";
                        echo "<a href='index-test.php' class='btn btn-primary'>";
                                echo "<h4>Retake Personality Quiz</h4>";
                        echo "</a>";
                echo "</div>";
	}
?>
<div style="text-align:center;font-size:20px;">
  You may find significance of above traits <a href="http://en.wikipedia.org/wiki/Big_Five_personality_traits" target="_blank"> here</a>
</div>


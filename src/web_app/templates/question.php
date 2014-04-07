<style>
</style>

<script>

</script>
<div required='' class='start-back' style="">
<form method="POST" action="questionnire.php" >
<input type="hidden" name='turn' value="<?=$values['turn']?>" />
<input type="hidden" name="1" value="<?=$values['result']['1']?>"/>
<input type="hidden" name="2" value="<?=$values['result']['2']?>"/>
<input type="hidden" name="3" value="<?=$values['result']['3']?>"/>
<input type="hidden" name="4" value="<?=$values['result']['4']?>"/>
<input type="hidden" name="5" value="<?=$values['result']['5']?>"/>

<?php
	$question=$values["questions"];
	echo "<table class='table table-bordered' style='margin-left:auto;margin-right:auto;width:1200px;'>";
		echo "<tr>";
			echo "<td style='width:50px'>";
				echo "<h4>S.No</h4>";
			echo "</td>";
			echo "<td>";
				echo "<h4>Question</h4>";
				echo "<h4>( I consider myself as one who ........)</h4>";
			echo "</td>";
			echo "<td style='width:100px'>";
				echo "<h4>Disagree strongly</h4>";
			echo "</td>";
			echo "<td style='width:100px'>";
				echo "<h4>Disagree a little</h4>";
			echo "</td>";
			echo "<td style='width:100px'>";
				echo "<h4>Neither agree nor disagree</h4>";
			echo "</td>";
			echo "<td style='width:100px'>";
				echo "<h4>Agree a little</h4>";
			echo "</td>";
			echo "<td style='width:100px'>";
				echo "<h4>Agree strongly</h4>";
			echo "</td>";
		echo "</tr>";
		$count=0;
	foreach($questions as $question)
	{
		echo "<input type='hidden' name='feature".$question["sn"]."' value=".$question["feature"].">";
		echo "<tr>";
						echo "<td style='font-size:18px'>";
							echo $question["sn"];
						echo "</td>";
						echo "<td style='font-size:18px'>";
							print $question["question"]."?";
						echo "</td>";
						//echo "<td>";
				if($question["priority"]==0)
							{
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=1 onClick='check' required='' class=".$count."></input>";
					echo "</td>";
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=2  required='' class=".$count."></input>";
					echo "</td>";
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=3  required='' class=".$count."></input>";
					echo "</td>";
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=4  required='' class=".$count."></input>";
					echo "</td>";
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=5  required='' class=".$count."></input>";
					echo "</td>";
				}
				else
				{
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=5  required='' class=".$count."></input>";
					echo "</td>";
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=4  required='' class=".$count."></input>";
					echo "</td>";
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=3  required='' class=".$count."></input>";
					echo "</td>";
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=2  required='' class=".$count."></input>";
					echo "</td>";
					echo "<td>";
					echo "<input type='radio' name='answer".$question["sn"]."' value=1  required='' class=".$count."></input>";
					echo "</td>";				
				}
						//echo "</td>";
			
		echo "</tr>";
		$count+=1;
	}
		
	//print_r($questions);
	echo "</table>";
?>
<div style='text-align:center'>
<input type='submit' class='btn btn-primary' value="submit"  name='submit' >
</div>
</form>
</div>
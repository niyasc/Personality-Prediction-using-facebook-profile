<div style = "text-align:center">
 	<h4>
		<?=$values["name"]["name"]?>
	</h4>
	<img src = "<?=$values["image"]?>" style = "width:100px"/> 
</div>

<table class='table table-striped table-bordered' style = "width:400px; margin-left:auto; margin-right:auto">
	<tr>
		<td>
			<table class='table table-striped table-bordered'>
				<tr>
					<td>
						<h4>Traits</h4>
					</td>
				</tr>
				<?php
				foreach($values["predicted"] as $key=>$value)
				{
					echo "<tr>";
						echo "<td>";
							echo $key;
						echo "</td>";
					echo "</tr>";
				}
				?>
			</table>
				
		</td>

		<td>
			<table class='table table-striped table-bordered'>
				<tr>
					<td>
						<h4>Predicted Values</h4>
					</td>
				</tr>
				<?php
					foreach($values['predicted'] as $value)
					{
						echo "<tr>";
							echo "<td>";
								echo round($value, 2);
							echo "</td>";
						echo "</tr>";			
					}
				?>
			</table>

		</td>

		<td>
			Actual if any
		</td>
		
		<td>
			Error
		</td>
	</tr>
</table>
	

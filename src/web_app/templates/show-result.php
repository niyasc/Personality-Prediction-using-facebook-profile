<div class='start-back' style="height:80%">
<?php 
	$result=$values["result"];
	function plot($color='black',$length=5)
	{
		//print 'in plot';
		echo "<div style='border:0px solid white;background:".$color.";height:25px;width:".($length*50)."'>";
		echo round($length,2);
		echo "</div>";
		//echo $length;
	}

  // create an array of values for the chart. These values 
  // could come from anywhere, POST, GET, database etc. 
  //$result = ["1"=>2.3,"2"=>3.3,"3"=>1.2,"4"=>3.6,"5"=>4.2]; 
?>
  <table  class='' style="margin-left:auto;margin-right:auto;">
    <tr>
      <td style="text-align:center">
        <div style="font-size:20px;color:blue">
          <?=$values["name"]?>
        </div>
          <?php
             echo "<img src='http://graph.facebook.com/".$values["id"]."/picture?type=large' style='width:100px'>";
          ?>
      </td>
    </tr>
    <tr>
    	<td>
    		<table class='table table-bordered table-striped' style="margin-left:auto;margin-right:auto;background:white">
  	<tr>
  		<td>
  			Extraversion
  		</td>
  		<td>
  			<?php plot('yellow',$result["1"]);?>
  		</td>
  	</tr>
  	<tr>
  		<td>
  			Agreeableness
  		</td>
  		<td>
  			<?php plot('green',$result["2"]);?>
  		</td>
  	</tr>
  	<tr>
  		<td>
  			Conscientiousness
  		</td>
  		<td>
  			<?php plot('orange',$result["3"]);?>
  		</td>
  	</tr>
  	<tr>
  		<td>
  			Neuroticism
  		</td>
  		<td>
  			<?php plot('gold',$result["4"]);?>
  		</td>
  	</tr>
  	<tr>
  		<td>
  			Openness
  		</td>
  		<td>
  			<?php plot('silver',$result["5"]);?>
  		</td>
  	</tr>
  </table>
  	</td>
  </tr>
  </table>
  
  <div style="text-align:center;font-size:20px;">
  You may find significance of these features <a href="http://en.wikipedia.org/wiki/Big_Five_personality_traits" target="_blank"> here</a>
  </div>
  <div style="text-align:center;font-size:30px;color:gold">
    Thanks for your cooperation. We will be back soon
  </div>
</div>
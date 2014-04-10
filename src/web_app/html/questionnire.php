<?php
	require_once("../includes/config.php");
	require_once("../includes/initialize.php");
        $info=$facebook->api('/me?field=id,name','GET',array('access_token' => $access_token));
        $name=$info['name'];
        $id=$info['id'];
        //$name="Test";
        //$id="test id";
	if(!isset($_POST['turn']))
	{
		//beginning of test
		$q=query("select * from questions limit 0,11");

		$result=array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0);
		//print_r($result);
		render("question.php",array("title"=>"Question 1 to 11","questions"=>$q,"result"=>$result,"name"=>$name,"id"=>$id,"turn"=>0));
	}
	else
	{
		//update attribute values
		$result=array("1"=>$_POST["1"],"2"=>$_POST["2"],"3"=>$_POST["3"],"4"=>$_POST["4"],"5"=>$_POST["5"]);
		$turn=$_POST['turn'];
		$i=$turn*11+1;
		$stop=($turn+1)*11;
		while($i<=$stop)
		{
			$result[$_POST["feature".$i]]+=$_POST["answer".$i];
			$i+=1;
		}
		//print_r($result);
		if($turn==3)
		{
			$result["1"]=$result["1"]/8;
			$result["2"]=$result["2"]/9;
			$result["3"]=$result["3"]/9;
			$result["4"]=$result["4"]/8;
			$result["5"]=$result["5"]/10;
			$ret=query("select * from features where uid=?",$id);
                        if(count($ret)==0)
                        {
	                   query("insert into features values(?,?,?,?,?,?)",$id,$result["1"],$result["2"],$result["3"],$result["4"],$result["5"]);
                        }
                        else
                        {
	                   query("delete from features where uid=?",$id);
	                   query("insert into features values(?,?,?,?,?,?)",$id,$result["1"],$result["2"],$result["3"],$result["4"],$result["5"]); 

                        }
			redirect("index-home.php");
		}
		else
		{
			$turn+=1;
			$start=$turn*11;
			$end=($turn+1)*11;
			$q=query("select * from questions limit ".$start.",11");

			//$result=array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0);
			//print_r($result);
			$start+=1;
			render("question.php",array("title"=>"Question ".$start." to ".$end."","questions"=>$q,"result"=>$result,"name"=>$name,"id"=>$id,"turn"=>$turn));
		}
	}
?>

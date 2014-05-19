<?php
	//include("data/vendor/autoloader.php");
	//use \NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer;
	
	function predictPersonality($id)
	{
		
		
		$like_category=['Political party', 'Non-profit organization', 'Website', 'Community', 'Education', 'Journalist', 'Just for fun', 'Computers/internet website', 'Politician', 'Political organization', 'Organization', 'Tv channel', 'App page', 'Media/news/publishing', 'Non-governmental organization (ngo)', 'Community organization', 'News/media website', 'Local business', 'Public figure', 'Education website', 'Entertainment website', 'Magazine', 'Company', 'School', 'Entertainer', 'Product/service', 'Interest', 'Computers', 'Studio', 'Computers/technology', 'Software', 'Cause', 'Personal blog', 'Religion', 'Electronics', 'University', 'Book', 'Games/toys', 'Tv show', 'Movie', 'Government organization', 'Food/beverages', 'Travel/leisure', 'Professional sports team', 'Cars', 'Radio station', 'Recreation/sports website', 'Fictional character', 'Author', 'Telecommunication', 'Camera/photo', 'Music chart', 'Clothing', 'Athlete', 'Retail and consumer merchandise', 'Video game', 'Book series', 'Music', 'Musician/band', 'Book genre', 'Actor/director', 'Sports/recreation/activities', 'Tv network', 'Sports league', 'Sport', 'State/province/region', 'City', 'Tv genre', 'Teacher', 'Artist', 'Society/culture website', 'Writer', 'Personal website', 'News personality', 'Public places', 'Consulting/business services', 'Education/work status', 'Outdoor gear/sporting goods', 'Automobiles and parts', 'Restaurant/cafe', 'Food', 'Sports venue', 'Movie character', 'Government official', 'Arts/humanities website', 'Bank/financial institution', 'Song', 'Internet/software', 'Household supplies', 'Attractions/things to do', 'Record label', 'Comedian', 'Arts/entertainment/nightlife', 'Airport', 'Science website', 'Doctor', 'Waterfall', 'Album', 'Bar', 'Health/beauty', 'Regional website', 'Reference website', 'Musical genre', 'Tv', 'Tv/movie award', 'Health/medical/pharmaceuticals', 'Food/grocery', 'Business person', 'Jewelry/watches', 'Professional services', 'Amateur sports team', 'Shopping/retail', 'Library', 'Movie theater', 'Literary editor', 'Other', 'Monarch', 'Aerospace/defense', 'Publisher', 'Work position', 'Book store', 'Language', 'Small business', 'Music video', 'Community/government', 'Church/religious organization', 'Teens/kids website', 'Country', 'Field of study', 'Movie general', 'Profession', 'Legal/law', 'Automotive', 'Real estate', 'Pet services', 'Engineering/construction', 'Home improvement', 'Home/garden website', 'Transport/freight', 'Tours/sightseeing', 'Hotel', 'Chef', 'Vitamins/supplements', 'Phone/tablet', 'Local/travel website', 'Business services', 'Neighborhood', 'Government website', 'Hospital/clinic', 'Health/wellness website', 'Landmark', 'Diseases', 'Club', 'Drugs', 'Event planning/event services', 'Museum/art gallery', 'Photographer', 'Producer', 'Concentration or major', 'Health/medical/pharmacy',  ];
		$inputs = [];
		$file=fopen("./data/".$id.".data","r");
		if($file!=NULL)
		{
			$data=unserialize(fread($file,filesize('./data/'.$id.'.data')));
			fclose($file);

			$gender=$data['gender'];
			$groups=$data["groups"];
			$friends=$data["friends"];
			$likes=$data['likes'];
			$status=$data['statuses'];
			$lc_fraction=[];

			foreach($like_category as $c)
			{
				$lc_fraction[$c]=0;
			}

			foreach($likes["data"] as $like)
			{
				$lc_fraction[$like['category']]+=1;
			}

			$group_count=count($groups["data"]);
			$like_count=count($likes["data"]);
			$sgf_count=0;
			$ogf_count=0;
			foreach($friends["data"] as $friend)
			{
				if(isset($friend['gender'])&&$friend['gender']==$gender)
				{
					$sgf_count+=1;
				}
				else
					$ogf_count+=1;
			}	
			$status_count=count($status['data']);
			// find categorywise likes
		
		
		
			$inputs['friend_count']=($ogf_count+$sgf_count);
			$inputs['sgf/tf']=$sgf_count*100/($sgf_count+$ogf_count);
			$inputs['ogf/tf']=$ogf_count*100/($sgf_count+$ogf_count);
			$inputs['sgf/ogf'] = $sgf_count *100/ $ogf_count ;
			$inputs['group_count']=$group_count;
			$inputs['like_count']=$like_count;
			$inputs['status_count']=$status_count;
			foreach($like_category as $lc)
			{
				$inputs[$lc.'/total_likes'] = $lc_fraction[$lc]*100/$like_count;
			}
			
			$statuses = $data["statuses"]["data"];
			$text="";
			foreach( $statuses as $status)
			{
				if(isset($status["message"]))
					$text = $text." ".$status["message"];
			}
			
 	
 	
			//$punct = new WhitespaceAndPunctuationTokenizer();
 	
		
			$tokens = explode(" ", $text);
			//$tokens = $punct->tokenize($text);
		
			$lower = [];
			foreach($tokens as $token)
			{
				array_push($lower, strtolower($token));
			}
 	
 			$first_singular = ["i", "i'm", "me", "mine", "my", "myself"];
 			$first_plural = ["we", "we're", "us", "our", "ours", "ourselves"];
 			$second = ["you", "you're", "yours"];
 			$third_singular = ["he", "she", "her", "his", "him", "himself", "herself"];
 			$third_plural = ["they", "theirs", "their", "them"];
 			$relative = ["that", "which", "who", "whom", "whose", "which ever", "whoever", "whomever"];
 			$indefinite_singular = ["anybody", "anyone", "anything", "each", "either", "everybody", "everyone", "everything", "neither", "nobody", "nothing", "one", "somebody", "someone", "something"];
 			$indefinite_plural = ["both", "few", "many", "several"];
 			$indefinite_sorp = ["all", "any", "most", "none", "some"];
 			$symbols = [".", "?", ",", "<", ">", "/", "'", ";", ":", "[", "{", "]", "}", "`", "~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "+", "="];
 		
 			$feat=["fs" => 0, "fp" => 0, "s" => 0, "ts" => 0, "tp" => 0, "rel" => 0, "is" => 0, "ip" => 0, "isop" => 0, "sym" => 0];
 		
 			foreach($lower as $l)
 			{
 				if ( in_array($l, $first_singular))
 					$feat["fs"]+=1;
				else if(in_array($l, $first_plural))
					$feat["fp"]+=1;
				else if(in_array($l, $second))
					$feat["s"]+=1;
				else if(in_array($l, $third_singular))
					$feat["ts"]+=1;
				else if(in_array($l, $third_plural))
					$feat["tp"]+=1;
				else if(in_array($l, $relative))
					$feat["rel"]+=1;
				else if(in_array($l, $indefinite_singular))
					$feat["is"]+=1;
				else if(in_array($l, $indefinite_plural))
					$feat["ip"] += 1;
				else if(in_array($l, $indefinite_sorp))
					$feat["isop"]+=1;
				else if(in_array($l, $symbols))
 					$feat["sym"]+=1;
 			}
 			foreach($feat as $key=>$val)
 			{
 				$feat[$key]/=(count($lower)+1);
 				$inputs[$key]=$feat[$key];
 			}
 			$feat["wps"] = count($lower)/count($statuses);
 			$inputs["wps"]=$feat["wps"];
			
		}
		else
		{
			print "unable to open file\n";
		}
		
		$file = fopen('newinput.csv', 'w');
		$temp= [$id];
		foreach($inputs as $input)
		{
			array_push($temp, $input);
		}
		fputcsv($file, $temp);
		fclose($file);
		
		$traits = system('python predict-personality.py');
		//print_r($traits);
		$traits = explode(" ", $traits);
		unset($traits[5]);
		return $traits;
	}	

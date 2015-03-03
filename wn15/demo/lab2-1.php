<html>
<?php
//lap2-1.php
?>
<body>
<?php

if(isset($_POST['submit']))
	{//show post data

	if(isset($_POST['shows']))
		{//process shows
			$last = array_pop($_POST['shows']);
			$last = " and " . $last;
			$shows = implode(",",$_POST['shows']);
			$shows = $show . $last;
			echo $shows;
		}
		
	else
		{
			echo 'no shows';
		}
        
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        
    }
    else
    {//show form
        echo '
        <form action="' .  THIS_PAGE  . '" method="post">
		<p>Please pick your favorite TV shows:</p>
		<input type="checkbox" name="shows[]" value="Archer" /> Archer<br />
		<input type="checkbox" name="shows[]" value="Always Sunny" /> Always Sunny in Philadephia<br />
		<input type="checkbox" name="shows[]" value="Dukes" /> Dukes of Hazzards<br />
		<input type="checkbox" name="shows[]" value="GOT" /> Game of Thrones<br />
		<input type="checkbox" name="shows[]" value="Sex" /> Sex And the City<br />
        <input type="submit" value="Show It!" name="submit" />
        
        </form>
        ';
    }
?>
</body>
</html>

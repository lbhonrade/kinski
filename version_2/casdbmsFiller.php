INSERT INTO `alumni` (`Student_Number`, `Last_Name`, `First_Name`, `Middle_Initial`, `Home_Address`, `Office_Address`, `Contact_Number`, `Mobile_Number`, `Email_Address`) VALUES
<?php 
	  $firstnames=file_get_contents("sample_info_db/firstnames.txt");
	  $firstnames=explode("\r\n",$firstnames);
	  $totalFirstNames=count($firstnames);
	  $lastnames=file_get_contents("sample_info_db/lastnames.txt");
	  $lastnames=explode("\r\n",$lastnames);
	  $totalLastNames=count($lastnames);
	  
	  $isAvailable=array_fill(0,10,array_fill(0,100000,true));
	  $courses=array(array("BS Computer Science","BSCS",4),
					array("BA Communication Art","BACA",4),
					array("BS Biology","BSBIO",4),
					array("BA Sociology","BASOC",4),
					array("BS Applied Physics","BSAP",4),
					array("BS Statistics","BSSTAT",4),
					array("BS Mathematics","BSMATH",4),
					array("BS Applied Mathematics","BSAM",4),
					array("BS Chemistry","BSCHEM",4),
					array("BA Philosophy","BAPHILO",4),
					array("MS Computer Science","MSCS",2),
					array("D Computer Science","DCS",2));
	  srand(time());
	  $first=true;
	  for($i=0;$i<10;$i++) 
		for($j=0;$j<50;$j++){
			do{
				$num=rand(1,99999);
			}while(!$isAvailable[$i][$num]);
			$isAvailable[$i][$num]=false;
			$stdNo=sprintf("'%d-%'05d'",1996+$i,$num);
		?>
			<?php echo $first?" ":",";if($first) $first=false; ?>(<?php echo $stdNo; ?>, '<?php echo $lastnames[$num%$totalLastNames]; ?>', '<?php echo $firstnames[$num%$totalFirstNames]; ?>', '<?php echo sprintf("%c",rand(65,90)); ?>', 'Home Address<?php echo $num; ?>', 'Office Address<?php echo $num; ?>', '+<?php echo rand(63900,63999).sprintf("%'07.0f",rand(0,1000000)); ?>', '+<?php echo rand(63900,63999).sprintf("%'07.0f",rand(0,1000000)); ?>', '<?php echo $num; ?>@cas.uplb.edu.ph')
<?php   } ?>;

INSERT INTO `alumni_degrees` (`Student_Number`, `Degree`, `Semester_Graduated`, `Year_Graduated`) VALUES
<?php
	$first=true;
	for($i=0;$i<10;$i++)
		for($j=0;$j<100000;$j++){
			if(!$isAvailable[$i][$j]){
			$stdNo=sprintf("'%d-%'05d'",1996+$i,$j);
			$degreeCount=rand(4,2011-1996-$i);
			$isSelected=array_fill(0,12,false);
			$sem=array('1','2','S');
			$randCourse=0;
			for($k=0;$k<$degreeCount;$k+=$courses[$randCourse][2]){
				do{
				$randCourse=rand(0,11);
				}while($isSelected[$randCourse]);
				if($k+$courses[$randCourse][2]>$degreeCount) break;
				$isSelected[$randCourse]=true;
?>
<?php echo $first?" ":",";if($first) $first=false; ?>(<?php echo $stdNo; ?>, '<?php echo $courses[$randCourse][1]; ?>', '<?php echo $sem[rand(0,2)]; ?>','<?php echo (1996+$i+$k+$courses[$randCourse][2]);?>')
<?php }}}?>;


INSERT INTO `pending_users` (`Username`, `Password`, `Role`) VALUES
<?php
	$first=true;
	for($i=0;$i<10;$i++)
		for($j=0;$j<50000;$j++){
			if(!$isAvailable[$i][$j]){
			$stdNo=sprintf("'%d-%'05d'",1996+$i,$j);
?>
<?php echo $first?" ":",";if($first) $first=false; ?>(<?php echo $stdNo; ?>, '861613f5a80abdf5a15ea283daa64be3', 'alumni')
<?php }}?>;

INSERT INTO `users` (`Username`, `Password`, `Role`) VALUES
<?php
	$first=true;
	for($i=0;$i<10;$i++)
		for($j=50000;$j<100000;$j++){
			if(!$isAvailable[$i][$j]){
			$stdNo=sprintf("'%d-%'05d'",1996+$i,$j);
?>
<?php echo $first?" ":",";if($first) $first=false; ?>(<?php echo $stdNo; ?>, '861613f5a80abdf5a15ea283daa64be3', 'alumni')
<?php }}?>;

<?php /*Up to here...*/exit; ?>


INSERT INTO `student` (`Student_Number`, `Last_Name`, `First_Name`, `Middle_Initial`, `Course`, `Home_Address`, `Contact_Number`, `Mobile_Number`, `Email_Address`) VALUES
<?php 
	  $isAvailable=array_fill(0,4,array_fill(0,100000,true));
	  srand(time());
	  $first=true;
	  for($i=0;$i<4;$i++) 
		for($j=0;$j<100;$j++){
			do{
				$num=rand(1,99999);
			}while(!$isAvailable[$i][$num]);
			$isAvailable[$i][$num]=false;
			$stdNo=sprintf("'%d-%'05d'",2007+$i,$num);
		?>
			<?php echo $first?" ":",";if($first) $first=false; ?>(<?php echo $stdNo; ?>, '<?php echo $lastnames[$num%$totalLastNames]; ?>', '<?php echo $firstnames[$num%$totalFirstNames]; ?>', '<?php echo sprintf("%c",rand(65,90)); ?>', '<?php echo $courses[rand(0,10)][1]; ?>', 'Home Address<?php echo $num; ?>', '+<?php echo rand(63900,63999).sprintf("%'07.0f",rand(0,1000000)); ?>', '+<?php echo rand(63900,63999).sprintf("%'07.0f",rand(0,1000000)); ?>', '<?php echo $num; ?>@cas.uplb.edu.ph')
<?php   } ?>;

INSERT INTO `users` (`Username`, `Password`, `Role`) VALUES

<?php
	for($i=0;$i<4;$i++)
		for($j=50000;$j<100000;$j++){
			if(!$isAvailable[$i][$j]){
			$stdNo=sprintf("'%d-%'05d'",2007+$i,$j);
?>
(<?php echo $stdNo; ?>, '861613f5a80abdf5a15ea283daa64be3', 'student'),
<?php }}?>;
--('admin_win01', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
--('admin_win02', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
--('admin_win03', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
--('admin_win04', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
--('admin_win05', '861613f5a80abdf5a15ea283daa64be3', 'admin'),
--('admin_win06', '861613f5a80abdf5a15ea283daa64be3', 'admin');

INSERT INTO `pending_users` (`Username`, `Password`, `Role`) VALUES
<?php
	$first=true;
	for($i=0;$i<4;$i++)
		for($j=0;$j<50000;$j++){
			if(!$isAvailable[$i][$j]){
			$stdNo=sprintf("'%d-%'05d'",2007+$i,$j);
?>
<?php echo $first?" ":",";if($first) $first=false; ?>(<?php echo $stdNo; ?>, '861613f5a80abdf5a15ea283daa64be3', 'student')
<?php }}?>;

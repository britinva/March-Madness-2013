<?php
$teams = array("Cincinnati", "Georgetown", "Georgia Tech", "Boston College", "Charlotte", "Richmond", "Minnesota", "Illinois", "Iowa State", "Oklahoma", "LSU", "Georgia", "Alabama St", "Jackson St", "Virginia Tech", "NC State", "Penn State", "Michigan", "Dayton", "Butler", "Nebraska", "Purdue", "St. Josephs", "Xavier", "Wake Forest", "Maryland", "Vanderbilt", "Arkansas", "Clemson", "Florida State", "Baylor", "Oklahoma State");
$espn_ids = array(2132,46,59,103,2429,257,135,356,66,201,99,61,2011,2296,259,152,213,130,2168,2086,158,2509,2603,2752,154,120,238,8,22,52,239,197);
$acronyms = array("CIN", "GTWN", "GT", "BC", "CHAR", "RICH", "MINN", "ILL", "ISU", "OKLA", "LSU", "UGA", "ALST", "JKST", "VT", "NCST", "PSU", "MICH", "DAY", "BUT", "NEB", "PUR", "JOES", "XAV", "WAKE", "MD", "VAN", "ARK", "CLEM", "FSU", "BAY", "OKST");


for ($i = 0; $i < 32; $i++) {
	$arr[] = array(
		"college" => $teams[$i], 		"logo" => "http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/".$espn_ids[$i].".png?w=200&h=200&transparent=true", 		"acronym" => $acronyms[$i]
	);
}
echo json_encode($arr);

<?php 

$mata_kuliah = [
	'Anastesi', 'Dalam', 'Jiwa', 'Obgin', 'Mata', 'Rehab', 'Gilut', 'Saraf', 'Anak', 'THT', 'Kulit', 'Forensik', 'Bedah', 'Radio', 'Libur', 'TEMP'
];

$tempat = [
	'RSUD Kayu Agung', 'RSUD Muara Enim', 'RSUD Bari', 'RSUD Jambi', 'RSUD Linggau', 'RSUD Sekayu', 'RSKMM'
];

$grup = [
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 3,
		'jadwal'	=> []
	],
	[
		'anggota' 	=> 4,
		'jadwal'	=> []
	],
];

// array_search() => return index of an element in array

function scheduling($mata_kuliah, $grup, $tempat)
{
	$temp_index = [];
	for ($i = 0; $i < count($grup); $i++)
	{
		$temp_mk = $mata_kuliah;
		while (count($temp_mk) > 0)
		{
			for ($j = 0; $j < count($temp_mk); $j++)
			{
				if (!in_array($temp_mk[$j], $grup[$i]['jadwal']))
				{
					if (!isset($temp_index[$temp_mk[$j]]))
						$temp_index[$temp_mk[$j]] = [];
					$grup[$i]['jadwal'] []= $temp_mk[$j];
					$idx = array_search($temp_mk[$j], $grup[$i]['jadwal']);
					if (array_search($idx, $temp_index[$temp_mk[$j]]) !== FALSE)
					{
						unset($grup[$i]['jadwal'][count($grup[$i]['jadwal']) - 1]);
						$grup[$i]['jadwal'] = array_values($grup[$i]['jadwal']);
					}
					else
					{
						$temp_index[$temp_mk[$j]] []= $idx;
						if (count($temp_index[$temp_mk[$j]]) >= 15)
							$temp_index[$temp_mk[$j]] = [];
						unset($temp_mk[$j]);
						$temp_mk = array_values($temp_mk);
						break;
					} 
				}
			}
		}
	}

	return $grup;
}
shuffle($mata_kuliah);
$jadwal = scheduling($mata_kuliah, $grup, $tempat);
$i = 0;
foreach ($jadwal as $row)
{
	$jadwal[$i++]['jadwal'] = array_diff($row['jadwal'], ['TEMP']);
}

$colors = [
	'Anastesi' 	=> 'purple',
	'Dalam'		=> 'green',
	'Jiwa'		=> 'grey',
	'Obgin'		=> 'red',
	'Mata'		=> 'yellow',
	'Rehab'		=> 'darkgreen',
	'Gilut'		=> 'orange',
	'Anak'		=> 'magenta',
	'THT'		=> 'teal',
	'IKM'		=> 'orange',
	'Kulit'		=> 'grey',
	'Bedah'		=> 'lightblue',
	'Forensik'	=> 'darkblue',
	'Radio'		=> 'yellow',
	'Libur'		=> 'white',
	'Saraf'		=> 'orange'
];

$colspans = [
	'Anastesi' 	=> 5,
	'Dalam'		=> 10,
	'Jiwa'		=> 5,
	'Obgin'		=> 10,
	'Mata'		=> 5,
	'Rehab'		=> 2,
	'Gilut'		=> 3,
	'Anak'		=> 10,
	'THT'		=> 5,
	'IKM'		=> 10,
	'Kulit'		=> 5,
	'Bedah'		=> 10,
	'Forensik'	=> 5,
	'Radio'		=> 2,
	'Libur'		=> 3,
	'Saraf'		=> 5
];

?>

<!DOCTYPE html>
<html>
<head>
	<title>E-Scheduling</title>
	<link rel="stylesheet" type="text/css" href="flatui/dist/css/flat-ui.min.css">
	<script type="text/javascript" src="flatui/dist/css/flat-ui.min.css"></script>
</head>
<body>

<?php
echo "<button class='btn btn-danger' onclick='location.reload()'>Re-generate schedule</button><br/><br/>";
echo "<table class='table table-bordered' style='color: black; border-collapse: collapse;' border='1'>
		<thead>
			<tr>
				<th>GRUP</th>
				<th>2</th>
				<th>9</th>
				<th>16</th>
				<th>23</th>
				<th>30</th>
				<th>6</th>
				<th>13</th>
				<th>20</th>
				<th>27</th>
				<th>4</th>
				<th>11</th>
				<th>18</th>
				<th>25</th>
				<th>1</th>
				<th>8</th>
				<th>15</th>
				<th>22</th>
				<th>29</th>
				<th>5</th>
				<th>12</th>
				<th>19</th>
				<th>26</th>
				<th>3</th>
				<th>10</th>
				<th>17</th>
				<th>24</th>
				<th>31</th>
				<th>7</th>
				<th>14</th>
				<th>21</th>
				<th>28</th>
				<th>5</th>
				<th>12</th>
				<th>19</th>
				<th>26</th>
				<th>2</th>
				<th>9</th>
				<th>16</th>
				<th>23</th>
				<th>30</th>
				<th>6</th>
				<th>13</th>
				<th>20</th>
				<th>27</th>
				<th>3</th>
				<th>10</th>
				<th>17</th>
				<th>24</th>
				<th>1</th>
				<th>8</th>
				<th>15</th>
				<th>22</th>
				<th>29</th>
				<th>5</th>
				<th>12</th>
				<th>19</th>
				<th>26</th>
				<th>3</th>
				<th>10</th>
				<th>17</th>
				<th>24</th>
				<th>31</th>
				<th>7</th>
				<th>14</th>
				<th>21</th>
				<th>28</th>
				<th>4</th>
				<th>11</th>
				<th>18</th>
				<th>25</th>
				<th>2</th>
				<th>9</th>
				<th>16</th>
				<th>23</th>
				<th>30</th>
				<th>6</th>
				<th>13</th>
				<th>20</th>
				<th>27</th>
				<th>4</th>
				<th>11</th>
				<th>18</th>
				<th>25</th>
				<th>1</th>
				<th>8</th>
			</tr>
		</thead>
		<tbody>";
$j = 0;
foreach ($jadwal as $row)
{
	echo "<tr>";
	$k = 0;
	foreach ($row['jadwal'] as $schedule)
	{
		if ($k == 0)
			echo "<td>GRUP " . ($j + 1) . "</td>";
		echo "<td style='background-color: ".$colors[$schedule]."' colspan='".$colspans[$schedule]."'>" . $schedule . "</td>";
		$k++;
	}
	echo "<tr>";
	$j++;
}
echo "</tbody></table>";

?>

</body>
</html>
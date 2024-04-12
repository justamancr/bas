<?php
// 71220
$input = "Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green";

// Load the file into a string
 $input = file_get_contents("input2.txt");

$games = explode("\n", $input);

$total_power = 0;

foreach ($games as $game) {
    //var_dump($game);

    $info = explode(": ", $game);
    $cubes = explode("; ", $info[1]);
    $min = ['red'=>0,'blue'=>0,'green'=>0];

    foreach ($cubes as $cube) {
        //var_dump($cube);

        $colors = explode(", ", $cube);
        //var_dump($colors);

        foreach ($colors as $color) {
            $parts = explode(" ", $color);
            $min [$parts[1]] = max ( $min[$parts[1]] , intval($parts[0]) ) ;
        }
    }
    //var_dump($min);

    // Calculate the power of the minimum set of cubes
    $power = $min['red'] * $min['blue'] * $min['green'];
    $total_power += $power;
}

echo "The sum of the power of the minimum sets of cubes: $total_power";

<?php
// first part 2377
// I missunderstood and was accumulating the used cubes.

$input = "Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green";

// Load the file into a string
$input = file_get_contents("input2.txt");
$games = explode("\n", $input);

$possible_games = [];

foreach ($games as $game) {
    $info = explode(": ", $game);
    $cubes = explode("; ", $info[1]);

    $is_possible = true;

    foreach ($cubes as $cube) {
        $colors = explode(", ", $cube);
        foreach ($colors as $color) {
            $parts = explode(" ", $color);
            switch ($parts[1]) {
                case 'red':
                    if (intval($parts[0]) > 12) {
                        $is_possible = false;
                    }
                    break;
                case 'green':
                    if (intval($parts[0]) > 13) {
                        $is_possible = false;
                    }
                    break;
                case 'blue':
                    if (intval($parts[0]) > 14) {
                        $is_possible = false;
                    }
                    break;
            }
        }
    }

    if ($is_possible) {
        $game_id = intval(explode(" ", $info[0])[1]);
        $possible_games[] = $game_id;
    }
}

$sum = array_sum($possible_games);

echo "The sum of IDs of possible games: $sum";

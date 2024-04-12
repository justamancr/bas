<?php
// ownerproof-4088514-1712884635-fc21ba46b0af

define("FIRST", FALSE);

// first part 54634
// second part 53855.
// Was particularly tricky for the overlaps like "twone" or "oneight" or even n-level or cyclic like "twoneightwo..."
// tried with regex, but it started to get tricky. Ended up using a brute force.

// Your calibration document
$calibrationDocument = [
    "1abc2",
    "pqr3stu8vwx",
    "a1b2c3d4e5f",
    "treb7uchet"
];

// Load the file into an array
$file_array = file("input.txt", FILE_IGNORE_NEW_LINES);

// Function to extract calibration values and sum them up
function sumCalibrationValues($document) {
    $sum = 0;
    foreach ($document as $line) {
        // Second part of the task
        echo $line.'<br>';
        $line = (FIRST)? $line : replaceSpelledNumbersWithInt($line);
        echo $line.'<br>';

        if (preg_match_all('/\d/', $line, $matches)) {
            $firstDigit = $matches[0][0];
            $lastDigit = end($matches[0]);
            $calibrationValue = $firstDigit * 10 + $lastDigit; // Combining into a two-digit number
            $sum += (int)$calibrationValue; // Adding to the sum
        } else {
            echo "error in line; $line";
        }
        echo '<pre>';
        print_r($matches[0]);
        echo '</pre>';

        echo 'firstDigit: '.$firstDigit.',lastDigit: '.$lastDigit.' calibrationValue: '.$calibrationValue."\n<BR><BR>";

    }
    return $sum;
}

/*
$string = "1fooeightwo"."<br>";
echo replaceSpelledNumbersWithInt($string);
$string = "one1twonetwo"."<br>";
echo replaceSpelledNumbersWithInt($string);
*/
function replaceSpelledNumbersWithInt($string) {
    $string = bruteForceCleanString($string);
    $numberMap = [
        'zero' => '0',
        'one' => '1',
        'two' => '2',
        'three' => '3',
        'four' => '4',
        'five' => '5',
        'six' => '6',
        'seven' => '7',
        'eight' => '8',
        'nine' => '9'
    ];

    foreach ($numberMap as $word => $digit) {
        $string = str_replace($word, $digit, $string);
    }

    return $string;
}


function bruteForceCleanString($string){
    $numberMap = [
        'zerone' => '0one',
        'twone' => '2one',
        'oneight' => '1eight',
        'threeight' => '3eight',
        'fiveight' => '5eight',
        'sevenine' => '7nine',
        'eightwo' => '8two',
        'eighthree' => '8three',
        'nineight' => '9eight'
    ];

    $foundFlag = true;

    while ($foundFlag) {
        $foundFlag = false;
        foreach ($numberMap as $word => $replacement) {
            $pos = strpos($string, $word);
            if ($pos !== false) {
                $string = substr_replace($string, $replacement, $pos, strlen($word));
                $foundFlag = true;
            }
        }
    }

    return $string;
}

// Calculate the sum of all calibration values
$totalSum = sumCalibrationValues($file_array);
echo "The sum of all calibration values is: $totalSum\n";

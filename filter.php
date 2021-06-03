<?php

if(isset($_POST["orderRating"]) && $_POST["orderRating"]!="")
    $orderByRating = $_POST["orderRating"];
else
    $orderByRating = "CHOOSE A VALUE!!!";

if(isset($_POST["minRating"]) && $_POST["minRating"]!="")
    $minimumRating = $_POST["minRating"];
else
    $minimumRating = "CHOOSE A VALUE!!!";

if(isset($_POST["orderDate"]) && $_POST["orderDate"]!="")
    $orderByDate = $_POST["orderDate"];
else
    $orderByDate = "CHOOSE A VALUE!!!";

if(isset($_POST["prioritizeText"]) && $_POST["prioritizeText"]!="")
    $prioritizeByText = $_POST["prioritizeText"];
else
    $prioritizeByText = "CHOOSE A VALUE!!!";

//We collected the data from the form successfully, now let's filter the json!!

$strJsonFileContents = file_get_contents("reviews.json");
//var_dump($strJsonFileContents); // show contents
$newjson = substr($strJsonFileContents, 3); //json_decode fails because of UTF BOM character, so this was needed
$json = json_decode($newjson, true);
//var_dump($json);

$finalJson = []; //array to collect the final filtered json
//First we have to filter the reviews with or without review text
foreach ($json as $reviewText => $value) {
    if($prioritizeByText == "Yes")
    {
        if($value['reviewText'] != null)
        {
            array_push($finalJson, $value);
        }
    }
    else
    {
        if($value['reviewText'] == null)
        {
            array_push($finalJson, $value);
        }
    }
}

function sortByRating($a, $b)
{
    return $a['rating'] < $b['rating'];
}

function sortByDate($a, $b)
{
    return $a['reviewCreatedOnDate'] < $b['reviewCreatedOnDate'];
}


usort($finalJson, 'sortByRating'); //we sort by rating in descending order (Highest First)

if($orderByRating == 'Lowest First')
{
    $finalJson=array_reverse($finalJson);
}

usort($finalJson, 'sortByDate'); //we sort by date in descending order (Newest First)

if ($orderByDate == 'Oldest First')
{
    $finalJson = array_reverse($finalJson);
}

//We remove the reviews from the json with ratings lower than the minimum rating given
foreach ($finalJson as $rating => $value) {
    if (intval($minimumRating) > $value['rating']) {
        unset($finalJson[$rating]);
    }
}
//The filtered json is ready to go!

var_dump($finalJson);


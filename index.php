<?php

require("lib/SurveyMonkeySpoof/SurveyMonkeySpoof.php");

use lib\SurveyMonkeySpoof\SurveyMonkeySpoof;

$surveyMonkeySpoof = new SurveyMonkeySpoof();
$surveyMonkeySpoof->setSurveyId("2S833S2");
$surveyMonkeySpoof->setSurveyQuestionId("725782097");
$surveyMonkeySpoof->setSurveyAnswerId("8282574965");
echo $surveyMonkeySpoof->spoofVote();

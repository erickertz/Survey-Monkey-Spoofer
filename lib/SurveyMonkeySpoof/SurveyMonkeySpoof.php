<?php namespace lib\SurveyMonkeySpoof;

class SurveyMonkeySpoof
{

	private $isPrevious = false;
	private $surveyUrl;
	private $surveyId;
	private $surveyQuestionId;
	private $surveyAnswerId;
	private $domDocument;

	public function __construct(){
		$this->domDocument = new \DomDocument();
	}

	public function setSurveyId($id){
		$this->surveyId = $id;		
	}

	public function setSurveyUrl($url){
		$this->surveyUrl = $url;		
	}

	public function setIsPrevious($isPrevious){
		$this->isPrevious = $isPrevious;		
	}

	public function setSurveyData($surveyData){
		$this->surveyData = $surveyData;
	}

	public function setSurveyQuestionId($id){
		$this->surveyQuestionId = $id;		
	}

	public function setSurveyAnswerId($id){
		$this->surveyAnswerId = $id;		
	}

	private function fetchSurveyData(){
		$surveyHtml = file_get_contents($this->surveyUrl.$this->surveyId);
		$this->domDocument->loadHTML($surveyHtml);
		$surveyDataElement = $this->domDocument->getElementById("survey_data");
		$surveyData = $surveyDataElement->getAttribute('value');
		return $surveyData;
	}

	public function spoofVote(){
		$surveyData = $this->fetchSurveyData();
		$postData = $this->surveyQuestionId."=".$this->surveyAnswerId."&is_previous=".$this->isPrevious."&survey_data=".$surveyData; 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->surveyUrl.$this->surveyId);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, 3);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

}

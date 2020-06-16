<?php


namespace App\Models;


use App\Core\Config;
use App\Core\Model;
use App\Includes\NoteHandlerTrait;
use App\Includes\ParametersHandlerTrait;
use App\Includes\Session;

class Kidney extends Model
{
    use NoteHandlerTrait;
    use ParametersHandlerTrait;

    private $_note = array();

    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
    }

    public function generateTests()
    {
        $systolic = (int)$this->data["bp-sys"];
        $diastolic = (int)$this->data["bp-dia"];
        $hypertension = $this->bloodPressureHandler($systolic, $diastolic);

        $rbc = round($this->data["rbc"], 3);
        $hemo = round($this->data["hemo"], 3);
        $rbc_class = $this->hematologyFactors($rbc, $hemo);

        $bu = round($this->data["bu"], 3);
        $sc = round($this->data["sc"], 3);
        $sod = round($this->data["sod"], 3);
        $pot = round($this->data["pot"], 3);
        $su = round($this->data["su"], 3);

        $sugar_class = $this->biochemicalFactors($su, $bu, $sc, $sod, $pot);

        $sg = round($this->data["sg"], 5);
        $al = $this->data["al"];
        $wbcc = $this->data["wbcc"];
        $rbcc = $this->data["rbcc"];

        $alscRatio = round($al / $sc, 2);
        $albumin_class = $this->urinaryFactors($sg, $al, $rbcc, $wbcc, $alscRatio);

        $extraTest = $this->generateExtraTest();

        $fromAzure = $this->checkDiseaseAzure([$diastolic, $sg, $albumin_class, $sugar_class, $rbc_class,
            $bu, $sc, $sod, $pot, $hemo, (int)$wbcc * 1000,
            $rbcc, $hypertension]);

        $data = [];
        array_push($data, $systolic, $diastolic, $sg, $al, $alscRatio,
                    $su, $rbc, $bu, $sc, $sod, $pot, $hemo,
                    $wbcc, $rbcc, $fromAzure["ckd"], $fromAzure["ckdprecision"], $extraTest['bun_sc_ratio'],
                    $extraTest['clearance_creatinine'], $extraTest['gfr'],
                    array_values($this->getNotes()));

       $this->insert("details_table", $data);
    }

    public function generateExtraTest()
    {
        $urea = $this->data["bu"];
        $creatinine = $this->data["sc"];
        $acute = $this->acute($urea, $creatinine);

        $userDetails = $this->getUserAgeAndWeight();

        $chronic = $this->chronic($userDetails["age"], $userDetails["weight"], $creatinine);


        return [
            "bun_sc_ratio" => $acute,
            "clearance_creatinine" => $chronic["clearance_creatinine"],
            "gfr" => $chronic["gfr"]
        ];
    }

    private function checkDiseaseAzure(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Config::getInstance()->getConfig("azure/url"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n  \"Inputs\": {\n    
            \"input1\": {\n      
            \"ColumnNames\": [\n              
            \"Bp\",\n        
            \"Sg\",\n        
            \"Al\",\n        
            \"Su\",\n        
            \"Rbc\",\n        
            \"Bu\",\n        
            \"Sc\",\n        
            \"Sod\",\n        
            \"Pot\",\n        
            \"Hemo\",\n        
            \"Wbcc\",\n        
            \"Rbcc\",\n        
            \"Htn\",\n      ],\n      
            \"Values\": [\n        
            [\n          
            \" $data[0] \",\n          
            \" $data[1] \",\n          
            \" $data[2] \",\n          
            \" $data[3] \",\n          
            \" $data[4] \",\n          
            \" $data[5] \",\n          
            \" $data[6] \",\n          
            \" $data[7] \",\n          
            \" $data[8] \",\n          
            \" $data[9] \",\n          
            \" $data[10] \",\n          
            \" $data[11] \",\n          
            \" $data[12] \",\n                       
            ]\n      ]\n    }\n  },\n  \"GlobalParameters\": {}\n}",
            CURLOPT_HTTPHEADER => Config::getInstance()->getConfig("azure/header"),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        var_dump($response);
        $result = json_decode($response, true);
        $class = (int)$result["Results"]["output1"]["value"]["Values"][0][13];
        $precision = (float)$result["Results"]["output1"]["value"]["Values"][0][14];

        $this->checkIfPositive($class, $precision);

        return [
            "ckd" => $class,
            "ckdprecision" => $precision
        ];
    }

    private function checkIfPositive($class, $precision)
    {
        if ($class === 1) {
            $this->writeNote("ckd", $precision * 100 . "% smo sigurni da imate kronicnu bubreznu bolest.");
        } else {
            $this->writeNote("ckd", $precision * 100 . "% smo sigurni da nemate kronicnu bubreznu bolest.");
        }
    }

    protected function getNote($name)
    {
        return $this->getNoteFromTable($name);
    }

    protected function getUserAgeAndWeight()
    {
        $details = $this->load("users", "id", Session::get("id"), ["age", "weight"]);
        return $details[0];
    }
}
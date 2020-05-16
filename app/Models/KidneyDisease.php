<?php


namespace App\Models;


use App\Core\Model;
use App\Includes\NoteHandlerTrait;
use App\Includes\ParametersHandlerTrait;

class KidneyDisease extends Model
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

    public function generateDisease()
    {
var_dump($this->data);
        $systolic = (int)$this->data["bp-sys"];
        $diastolic = (int)$this->data["bp-dia"];
        $hypertension = $this->bloodPressureHandler($this->data["bp-sys"], $this->data["bp-dia"]);

        $hemo = round($this->data["hemo"], 3);
        $rbc = $this->hematologyFactors($this->data["rbc"], $hemo);

        $bu = round($this->data["bu"], 3);
        $sc = (int)$this->data["sc"];
        $sod = round($this->data["sod"], 3);
        $pot = round($this->data["pot"], 3);
        $su = $this->biochemicalFactors($this->data["su"], $bu, $sc, $sod, $pot);

        $sg = round($this->data["sg"], 5);
        $wbcc = $this->data["wbcc"];
        $rbcc = $this->data["rbcc"];
        $al = $this->urinaryFactors($sg, $this->data["al"], $rbcc, $wbcc);

        $ckd = $this->checkDiseaseAzure([
            $systolic,
            $sg,
            $al,
            $su,
            $rbc,
            $bu,
            $sc,
            $sod,
            $pot,
            $hemo,
            $wbcc * 1000,
            $rbcc,
            $hypertension
        ]);

        $data = [];
        array_push($data, $systolic, $diastolic, $sg, $this->data["al"], $this->data["su"], $this->data["rbc"], $bu, $sc, $sod, $pot, $hemo, $wbcc, $rbcc, $ckd,
                                        array_values($this->getNotes()));

        $this->insert("details_table", $data);
    }

    private function checkDiseaseAzure(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://ussouthcentral.services.azureml.net/workspaces/41b329e8ef0a43318ccdfcbbb3bd2019/services/81e1935857de484cb2f7fcf90662701b/execute?api-version=2.0&details=true",
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
                        \"Htn\"\n      ],\n      
                        \"Values\": [\n        [\n          
                        \"$data[0]\",\n          
                        \"$data[1]\",\n          
                        \"$data[2]\",\n          
                        \"$data[3]\",\n          
                        \"$data[4]\",\n          
                        \"$data[5]\",\n          
                        \"$data[6]\",\n          
                        \"$data[7]\",\n          
                        \"$data[8]\",\n          
                        \"$data[9]\",\n          
                        \"$data[10]\",\n          
                        \"$data[11]\",\n          
                        \"$data[12]\"\n        
                        ]\n      ]\n    }\n  },\n  \"GlobalParameters\": {}\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer Qs/0gDydgJGrELzauNxO90KLo0Fu4bGNwFJV5YJwDtvgQ/87NTBDx5amukGmte3s+gxib/cyLrnRKHOrAmHSzA==",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        var_dump($data);
        $result = json_decode($response, true);
        $class = (int)$result["Results"]["output1"]["value"]["Values"][0][13];
        $precision = (float)$result["Results"]["output1"]["value"]["Values"][0][14];

        $this->checkIfPositive($class, $precision);

        return $class;
    }

    private function checkIfPositive($class, $precision)
    {
        if ($class === 1) {
            $this->writeNote("ckd", "We are " . $precision * 100 . "% sure that you have Chronic Kidney Disease.");
        } else {
            $this->writeNote("ckd", "We are " . $precision * 100 . "% sure that you do not have Chronic Kidney Disease.");
        }
    }

    protected function getNote($name)
    {
        return $this->getNoteFromTable($name);
    }
}
<?php


namespace App\Includes;


trait ParametersHandlerTrait
{
    public function bloodPressureHandler($systolic, $diastolic)
    {
        $tempereryNote = '';

        if($systolic < 120 &&  $diastolic < 80)
        {
            return 0;
        }
        else if((120 <= $systolic && $systolic < 130) && (80 <= $diastolic && $diastolic < 85))
        {
            return 0;
        }
        else if((130 <= $systolic && $systolic < 140) || (85 <= $diastolic && $diastolic < 90))
        {
            $tempereryNote = $this->getNote('bp_elevated');

            $this->writeNote('bp_elevated', $tempereryNote["note"]);

            return 0;
        }
        else if((140 <= $systolic && $systolic < 160) || (90 <= $diastolic && $diastolic < 100))
        {
            $tempereryNote = $this->getNote('bp_h1');

            $this->writeNote('bp_h1', $tempereryNote["note"]);

            return 1;
        }
        else if((160 <= $systolic && $systolic < 180) || (100 <= $diastolic && $diastolic < 110))
        {
            $tempereryNote = $this->getNote('bp_h2');

            $this->writeNote('bp_h2', $tempereryNote["note"]);

            return 1;
        }
        else if($systolic >= 180 || $diastolic >= 110)
        {
            $tempereryNote = $this->getNote('bp_h3');

            $this->writeNote('bp_h3', $tempereryNote["note"]);

            return 1;
        }
    }

    public function specificGravity($x)
    {
        if($x < 1.005)
        {
            //low
        }
        else if(1.005 <= $x && $x < 1.030)
        {
            //normal
        }
        else if($x >= 1.030)
        {
            //high
        }
    }

    public function sugar($x)
    {
        if($x > 17.4)
        {
            //very high, diabetes
        }
        else if(11 <= $x && $x <= 17.4)
        {
            //high, diabetes
        }
        else if(7 <= $x && $x < 11)
        {
            //line, diabetes
        }
        else if(4 <= $x && $x < 7)
        {
           if($x > 6)
           {
               //diabetes
           }
           else{
               //normal
           }
        }
        else if(2.8 <= $x && $x < 4)
        {
            //normal
        }
        else if(2.8 > $x)
        {
            //hypoglikemia
        }
    }

    public function redCells($x)
    {
        if("Female") {
            if ($x > 5.4) {
                //low
            } else if (4.2 <= $x && $x <= 5.4) {
                //normal
            } else if ($x < 4.2) {
                //low
            }
        }
        else{
            if ($x > 6.3) {
                //high
            } else if (4.5 <= $x && $x <= 6.3) {
                //normal
            } else if ($x < 4.5) {
                //low
            }
        }
    }

    public function bloodUrea($x)
    {
        if ($x > 8.3) {
            //high
        } else if (2.8 <= $x && $x <= 8.3) {
            //normal
        } else if ($x < 2.8) {
            //low
        }
    }

    public function serumCreatinine($x)
    {
        if("Female") {
            if ($x > 90) {
                //high
            } else if (49 <= $x && $x <= 90) {
                //normal
            } else if ($x < 49) {
                //low
            }
        }
        else{
            if ($x > 104) {
                //high
            } else if (60 <= $x && $x <= 104) {
                //normal
            } else if ($x < 60) {
                //low
            }
        }
    }

    public function sodium($x)
    {
        if ($x > 146) {
            //high
        } else if (137 <= $x && $x <= 146) {
            //normal
        } else if ($x < 137) {
            //low
        }
    }

    public function potassium($x)
    {
        if ($x > 5.1) {
            //high
        } else if (3.9 <= $x && $x <= 5.1) {
            //normal
        } else if ($x < 3.9) {
            //low
        }
    }

    public function haemoglobin($x)
    {
        if("Female") {
            if ($x > 15.3) {
                //high
            } else if (12.3 <= $x && $x <= 15.3) {
                //normal
            } else if ($x < 12.3) {
                //low
            }
        }
        else{
            if ($x > 17.5) {
                //high
            } else if (14 <= $x && $x <= 17.5) {
                //normal
            } else if ($x < 14) {
                //low
            }
        }
    }

    public function whiteCellsCount($x)
    {
        if ($x > 11000) {
            //high
        } else if (4500 <= $x && $x <= 11000) {
            //normal
        } else if ($x < 4500) {
            //low
        }
    }

    public function redCellsCount($x)
    {
        if ($x > 4) {
            //high
        }
        else if ($x <= 4) {
            //normal
        }
    }
}
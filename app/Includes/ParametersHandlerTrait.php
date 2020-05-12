<?php


namespace App\Includes;


trait ParametersHandlerTrait
{
    public function bloodPressureHandler($systolic, $diastolic)
    {
        $tempereryNote = '';

        if($systolic < 120 && $diastolic < 80)
        {
            $tempereryNote = $this->getNote('bp_normal');

            $this->writeNote('bp_normal', $tempereryNote["note"]);

            return 0;
        }
        else if((120 <= $systolic && $systolic < 130) && (80 <= $diastolic && $diastolic < 85))
        {
            $tempereryNote = $this->getNote('bp_normal');

            $this->writeNote('bp_normal', $tempereryNote["note"]);

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
        $tempereryNote = '';

        if($x < 1.005)
        {
            $tempereryNote = $this->getNote('sg_low');

            $this->writeNote('sg_low', $tempereryNote["note"]);
        }
        else if(1.005 <= $x && $x < 1.025)
        {
            $tempereryNote = $this->getNote('sg_normal');

            $this->writeNote('sg_normal', $tempereryNote["note"]);
        }
        else if($x >= 1.025)
        {
            $tempereryNote = $this->getNote('sg_high');

            $this->writeNote('sg_high', $tempereryNote["note"]);
        }
    }

    public function albumin($x)
    {
        $tempereryNote = '';

        if($x > 350)
        {
            $tempereryNote = $this->getNote('al_macro');

            $this->writeNote('al_macro', $tempereryNote["note"]);

            return 5;
        }
        else if(300 <= $x && $x <= 350)
        {
            $tempereryNote = $this->getNote('al_macro');

            $this->writeNote('al_macro', $tempereryNote["note"]);

            return 4;
        }
        else if(30 <= $x && $x < 300)
        {
            $tempereryNote = $this->getNote('al_micro');

            $this->writeNote('al_micro', $tempereryNote["note"]);

            return 3;
        }
        else if($x < 30)
        {
            if($x > 27)
            {
                $tempereryNote = $this->getNote('al_normal');

                $this->writeNote('al_normal', $tempereryNote["note"]);

                return 2;
            }
            else if( $x > 25 ){
                $tempereryNote = $this->getNote('al_normal');

                $this->writeNote('al_normal', $tempereryNote["note"]);

                return 1;
            }
            else{
                $tempereryNote = $this->getNote('al_normal');

                $this->writeNote('al_normal', $tempereryNote["note"]);

                return 0;
            }
        }
    }

    public function sugar($x)
    {
        $tempereryNote = '';

        if($x > 17.4)
        {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            return 5;
        }
        else if(11 <= $x && $x <= 17.4)
        {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            return 4;
        }
        else if(7 <= $x && $x < 11)
        {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            return 3;
        }
        else if(4 <= $x && $x < 7)
        {
           if($x > 6)
           {
               $tempereryNote = $this->getNote('su_high');

               $this->writeNote('su_high', $tempereryNote["note"]);

               return 2;
           }
           else{
               $tempereryNote = $this->getNote('su_normal');

               $this->writeNote('su_normal', $tempereryNote["note"]);

               return 2;
           }
        }
        else if(2.8 <= $x && $x < 4)
        {
            $tempereryNote = $this->getNote('su_normal');

            $this->writeNote('su_normal', $tempereryNote["note"]);

            return 1;
        }
        else if(2.8 > $x)
        {
            $tempereryNote = $this->getNote('su_low');

            $this->writeNote('su_low', $tempereryNote["note"]);

            return 0;
        }
    }

    public function redCells($x)
    {
        $tempereryNote = '';

        if(Session::get("Gender") === "Female") {
            if ($x > 5.4) {
                $tempereryNote = $this->getNote('rbc_high');

                $this->writeNote('rbc_low', $tempereryNote["note"]);

                return 1;
            } else if (4.2 <= $x && $x <= 5.4) {
                $tempereryNote = $this->getNote('rbc_normal');

                $this->writeNote('rbc_normal', $tempereryNote["note"]);

                return 0;
            } else if ($x < 4.2) {
                $tempereryNote = $this->getNote('rbc_low');

                $this->writeNote('rbc_low', $tempereryNote["note"]);

                return 0;
            }
        }
        else{
            if ($x > 6.3) {
                $tempereryNote = $this->getNote('rbc_high');

                $this->writeNote('rbc_low', $tempereryNote["note"]);

                return 1;
            } else if (4.5 <= $x && $x <= 6.3) {
                $tempereryNote = $this->getNote('rbc_normal');

                $this->writeNote('rbc_normal', $tempereryNote["note"]);

                return 0;
            } else if ($x < 4.5) {
                $tempereryNote = $this->getNote('rbc_low');

                $this->writeNote('rbc_low', $tempereryNote["note"]);

                return 0;
            }
        }
    }

    public function bloodUrea($x)
    {
        $tempereryNote = '';

        if ($x > 8.3) {
            $tempereryNote = $this->getNote('bu_high');

            $this->writeNote('bu_high', $tempereryNote["note"]);
        } else if (2.8 <= $x && $x <= 8.3) {
            $tempereryNote = $this->getNote('bu_normal');

            $this->writeNote('bu_normal', $tempereryNote["note"]);
        } else if ($x < 2.8) {
            $tempereryNote = $this->getNote('bu_low');

            $this->writeNote('bu_low', $tempereryNote["note"]);
        }
    }

    public function serumCreatinine($x)
    {
        $tempereryNote = '';

        if(Session::get("Gender") === "Female") {
            if ($x > 90) {
                $tempereryNote = $this->getNote('sc_high');

                $this->writeNote('sc_high', $tempereryNote["note"]);
            } else if (49 <= $x && $x <= 90) {
                $tempereryNote = $this->getNote('sc_normal');

                $this->writeNote('sc_normal', $tempereryNote["note"]);
            } else if ($x < 49) {
                $tempereryNote = $this->getNote('sc_low');

                $this->writeNote('sc_low', $tempereryNote["note"]);
            }
        }
        else{
            if ($x > 104) {
                $tempereryNote = $this->getNote('sc_high');

                $this->writeNote('sc_high', $tempereryNote["note"]);
            } else if (60 <= $x && $x <= 104) {
                $tempereryNote = $this->getNote('sc_normal');

                $this->writeNote('sc_normal', $tempereryNote["note"]);
            } else if ($x < 60) {
                $tempereryNote = $this->getNote('sc_low');

                $this->writeNote('sc_low', $tempereryNote["note"]);
            }
        }
    }

    public function sodium($x)
    {
        $tempereryNote = '';

        if ($x > 146) {
            $tempereryNote = $this->getNote('sod_high');

            $this->writeNote('sod_high', $tempereryNote["note"]);
        } else if (137 <= $x && $x <= 146) {
            $tempereryNote = $this->getNote('sod_normal');

            $this->writeNote('sod_normal', $tempereryNote["note"]);
        } else if ($x < 137) {
            $tempereryNote = $this->getNote('sod_low');

            $this->writeNote('sod_low', $tempereryNote["note"]);
        }
    }

    public function potassium($x)
    {
        $tempereryNote = '';

        if ($x > 5.1) {
            $tempereryNote = $this->getNote('pot_high');

            $this->writeNote('pot_high', $tempereryNote["note"]);
        } else if (3.9 <= $x && $x <= 5.1) {
            $tempereryNote = $this->getNote('pot_normal');

            $this->writeNote('pot_normal', $tempereryNote["note"]);
        } else if ($x < 3.9) {
            $tempereryNote = $this->getNote('pot_low');

            $this->writeNote('pot_low', $tempereryNote["note"]);
        }
    }

    public function hemoglobin($x)
    {
        $tempereryNote = '';

        if(Session::get("Gender") === "Female") {
            if ($x > 15.3) {
                $tempereryNote = $this->getNote('hemo_high');

                $this->writeNote('hemo_high', $tempereryNote["note"]);
            } else if (12.3 <= $x && $x <= 15.3) {
                $tempereryNote = $this->getNote('hemo_normal');

                $this->writeNote('hemo_normal', $tempereryNote["note"]);
            } else if ($x < 12.3) {
                $tempereryNote = $this->getNote('hemo_low');

                $this->writeNote('hemo_low', $tempereryNote["note"]);
            }
        }
        else{
            if ($x > 17.5) {
                $tempereryNote = $this->getNote('hemo_high');

                $this->writeNote('hemo_high', $tempereryNote["note"]);
            } else if (14 <= $x && $x <= 17.5) {
                $tempereryNote = $this->getNote('hemo_normal');

                $this->writeNote('hemo_normal', $tempereryNote["note"]);
            } else if ($x < 14) {
                $tempereryNote = $this->getNote('hemo_low');

                $this->writeNote('hemo_low', $tempereryNote["note"]);
            }
        }
    }

    public function whiteCellsCount($x)
    {
        $tempereryNote = '';

        if ($x > 11000) {
            $tempereryNote = $this->getNote('wbcc_high');

            $this->writeNote('wbcc_high', $tempereryNote["note"]);
        } else if (4500 <= $x && $x <= 11000) {
            $tempereryNote = $this->getNote('wbcc_normal');

            $this->writeNote('wbcc_normal', $tempereryNote["note"]);
        } else if ($x < 4500) {
            $tempereryNote = $this->getNote('wbcc_low');

            $this->writeNote('wbcc_low', $tempereryNote["note"]);
        }
    }

    public function redCellsCount($x)
    {
        $tempereryNote = '';

        if ($x > 4) {
            $tempereryNote = $this->getNote('rbcc_high');

            $this->writeNote('rbcc_high', $tempereryNote["note"]);
        }
        else if ($x <= 4) {
            $tempereryNote = $this->getNote('rbcc_normal');

            $this->writeNote('rbcc_normal', $tempereryNote["note"]);
        }
    }
}
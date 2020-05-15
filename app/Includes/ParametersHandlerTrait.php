<?php


namespace App\Includes;


trait ParametersHandlerTrait
{
    public function bloodPressureHandler($systolic, $diastolic)
    {

        if ($systolic < 120 && $diastolic < 80) {
            $tempereryNote = $this->getNote('bp_optimum');

            $this->writeNote('bp_normal', $tempereryNote["note"]);

            return 0;
        } else if ((120 <= $systolic && $systolic < 130) && (80 <= $diastolic && $diastolic < 85)) {
            $tempereryNote = $this->getNote('bp_normal1');

            $this->writeNote('bp_normal1', $tempereryNote["note"]);

            return 0;
        } else if ((130 <= $systolic && $systolic < 140) || (85 <= $diastolic && $diastolic < 90)) {
            $tempereryNote = $this->getNote('bp_normal2');

            $this->writeNote('bp_normal2', $tempereryNote["note"]);

            return 0;
        } else if ((140 <= $systolic && $systolic < 160) || (90 <= $diastolic && $diastolic < 100)) {
            $tempereryNote = $this->getNote('bp_h1');

            $this->writeNote('bp_h1', $tempereryNote["note"]);

            return 1;
        } else if ((160 <= $systolic && $systolic < 180) || (100 <= $diastolic && $diastolic < 110)) {
            $tempereryNote = $this->getNote('bp_h2');

            $this->writeNote('bp_h2', $tempereryNote["note"]);

            return 1;
        } else if ($systolic >= 180 || $diastolic >= 110) {
            $tempereryNote = $this->getNote('bp_h3');

            $this->writeNote('bp_h3', $tempereryNote["note"]);

            return 1;
        }
    }

    public function specificGravity($x)
    {

        if ($x < 1.001) {
            $tempereryNote = $this->getNote('sg_low');

            $this->writeNote('sg_low', $tempereryNote["note"]);
        } else if (1.001 <= $x && $x < 1.035) {
            $tempereryNote = $this->getNote('sg_normal');

            $this->writeNote('sg_normal', $tempereryNote["note"]);
        } else if ($x >= 1.035) {
            $tempereryNote = $this->getNote('sg_high');

            $this->writeNote('sg_high', $tempereryNote["note"]);
        }
    }

    public function albumin($x)
    {

        if ($x > 350) {
            $tempereryNote = $this->getNote('alb_high');

            $this->writeNote('alb_high', $tempereryNote["note"]);

            return 5;
        } else if (300 <= $x && $x <= 350) {
            $tempereryNote = $this->getNote('alb_high');

            $this->writeNote('alb_high', $tempereryNote["note"]);

            return 4;
        } else if (30 <= $x && $x < 300) {
            $tempereryNote = $this->getNote('alb_micro');

            $this->writeNote('alb_micro', $tempereryNote["note"]);

            return 3;
        } else if ($x < 30) {
            if ($x > 27) {
                $tempereryNote = $this->getNote('alb_normal');

                $this->writeNote('alb_normal', $tempereryNote["note"]);

                return 2;
            } else if ($x > 25) {
                $tempereryNote = $this->getNote('alb_normal');

                $this->writeNote('alb_normal', $tempereryNote["note"]);

                return 1;
            } else {
                $tempereryNote = $this->getNote('alb_normal');

                $this->writeNote('alb_normal', $tempereryNote["note"]);

                return 0;
            }
        }
    }

    public function sugar($x)
    {

        if ($x > 11.1) {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            return 5;
        } else if (8.1 <= $x && $x <= 11.1) {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            return 4;
        } else if (6.1 <= $x && $x < 8.1) {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            return 3;
        } else if (4.1 <= $x && $x < 6.1) {
                $tempereryNote = $this->getNote('su_normal');

                $this->writeNote('su_normal', $tempereryNote["note"]);

                return 2;

        } else if (2.8 <= $x && $x < 4.1) {
            $tempereryNote = $this->getNote('su_normal');

            $this->writeNote('su_normal', $tempereryNote["note"]);

            return 1;
        } else if (2.8 > $x) {
            $tempereryNote = $this->getNote('su_low');

            $this->writeNote('su_low', $tempereryNote["note"]);

            return 0;
        }
    }

    public function redCells($x)
    {
        if (Session::get("Gender") === "Female") {
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
        } else {
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
        if (Session::get("Gender") === "Female") {
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
        } else {
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
        if (Session::get("Gender") === "Female") {
            if ($x > 16) {
                $tempereryNote = $this->getNote('hemo_high');

                $this->writeNote('hemo_high', $tempereryNote["note"]);
            } else if (12 <= $x && $x <= 16) {
                $tempereryNote = $this->getNote('hemo_normal');

                $this->writeNote('hemo_normal', $tempereryNote["note"]);
            } else if ($x < 12) {
                $tempereryNote = $this->getNote('hemo_low');

                $this->writeNote('hemo_low', $tempereryNote["note"]);
            }
        } else {
            if ($x > 18) {
                $tempereryNote = $this->getNote('hemo_high');

                $this->writeNote('hemo_high', $tempereryNote["note"]);
            } else if (14 <= $x && $x <= 18) {
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
        if ($x > 4) {
            $tempereryNote = $this->getNote('rbcc_high');

            $this->writeNote('rbcc_high', $tempereryNote["note"]);
        } else if ($x <= 4) {
            $tempereryNote = $this->getNote('rbcc_normal');

            $this->writeNote('rbcc_normal', $tempereryNote["note"]);
        }
    }

    public function redAndWhiteCells($rbc, $rbcc, $wbcc)
    {
        if ($rbc > 5) {
            $tempereryNote = $this->getNote('rbc_high');

            $this->writeNote('rbc_high', $tempereryNote["note"]);

            $rbc_temp = 1;
        } else if ($rbc <= 5) {
            $tempereryNote = $this->getNote('rbc_normal');

            $this->writeNote('rbc_normal', $tempereryNote["note"]);

            $rbc_temp = 0;
        }

        if ($rbcc > 3) {
            $tempereryNote = $this->getNote('rbcc_high');

            $this->writeNote('rbcc_high', $tempereryNote["note"]);
        } else if ($rbc <= 3) {
            $tempereryNote = $this->getNote('rbcc_normal');

            $this->writeNote('rbcc_normal', $tempereryNote["note"]);
        }

        if ($wbcc > 10) {
            $tempereryNote = $this->getNote('wbcc_high');

            $this->writeNote('wbcc_high', $tempereryNote["note"]);
        } else if ($rbc <= 10) {
            $tempereryNote = $this->getNote('wbcc_normal');

            $this->writeNote('wbcc_normal', $tempereryNote["note"]);
        }

        return $rbc_temp;
    }

    public function sodiumAndPotassium($sod, $pot)
    {
        if ($sod > 145) {
            $tempereryNote = $this->getNote('sod_high');

            $this->writeNote('sod_high', $tempereryNote["note"]);
        } else if (136 <= $sod && $sod <= 145) {
            $tempereryNote = $this->getNote('sod_normal');

            $this->writeNote('sod_normal', $tempereryNote["note"]);
        } else if ($sod < 136) {
            $tempereryNote = $this->getNote('sod_low');

            $this->writeNote('sod_low', $tempereryNote["note"]);
        }

        if ($pot > 5.3) {
            $tempereryNote = $this->getNote('pot_high');

            $this->writeNote('pot_high', $tempereryNote["note"]);
        } else if (3.5 <= $pot && $pot <= 5.3) {
            $tempereryNote = $this->getNote('pot_normal');

            $this->writeNote('pot_normal', $tempereryNote["note"]);
        } else if ($pot < 3.5) {
            $tempereryNote = $this->getNote('pot_low');

            $this->writeNote('pot_low', $tempereryNote["note"]);
        }
    }

    public function bloodUreaAndSerumCreatinine($bu, $sc)
    {
        if ($bu > 8.3) {
            $tempereryNote = $this->getNote('bu_high');
            $this->writeNote('bu_high', $tempereryNote["note"]);
        } else if (2.8 <= $bu && $bu <= 8.3) {
            $tempereryNote = $this->getNote('bu_normal');
            $this->writeNote('bu_normal', $tempereryNote["note"]);
        } else if ($bu < 2.8) {
            $tempereryNote = $this->getNote('bu_low');
            $this->writeNote('bu_low', $tempereryNote["note"]);
        }

        if (Session::get("Gender") === "Female") {
            if ($sc > 107) {
                $tempereryNote = $this->getNote('sc_high');

                $this->writeNote('sc_high', $tempereryNote["note"]);
            } else if (63 <= $sc && $sc <= 107) {
                $tempereryNote = $this->getNote('sc_normal');

                $this->writeNote('sc_normal', $tempereryNote["note"]);
            } else if ($sc < 63) {
                $tempereryNote = $this->getNote('sc_low');

                $this->writeNote('sc_low', $tempereryNote["note"]);
            }
        } else {
            if ($sc > 125) {
                $tempereryNote = $this->getNote('sc_high');

                $this->writeNote('sc_high', $tempereryNote["note"]);
            } else if (79 <= $sc && $sc <= 125) {
                $tempereryNote = $this->getNote('sc_normal');

                $this->writeNote('sc_normal', $tempereryNote["note"]);
            } else if ($sc < 79) {
                $tempereryNote = $this->getNote('sc_low');

                $this->writeNote('sc_low', $tempereryNote["note"]);
            }
        }
    }
}
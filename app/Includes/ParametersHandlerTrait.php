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

    public function hematologyFactors($rbc, $hemo)
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

        if (Session::get("Gender") === "Female") {
            if ($hemo > 16) {
                $tempereryNote = $this->getNote('hemo_high');

                $this->writeNote('hemo_high', $tempereryNote["note"]);
            } else if (12 <= $hemo && $hemo <= 16) {
                $tempereryNote = $this->getNote('hemo_normal');

                $this->writeNote('hemo_normal', $tempereryNote["note"]);
            } else if ($hemo < 12) {
                $tempereryNote = $this->getNote('hemo_low');

                $this->writeNote('hemo_low', $tempereryNote["note"]);
            }
        } else {
            if ($hemo > 18) {
                $tempereryNote = $this->getNote('hemo_high');

                $this->writeNote('hemo_high', $tempereryNote["note"]);
            } else if (14 <= $hemo && $hemo <= 18) {
                $tempereryNote = $this->getNote('hemo_normal');

                $this->writeNote('hemo_normal', $tempereryNote["note"]);
            } else if ($hemo < 14) {
                $tempereryNote = $this->getNote('hemo_low');

                $this->writeNote('hemo_low', $tempereryNote["note"]);
            }
        }

        return $rbc_temp;
    }

    public function biochemicalFactors($su, $bu, $sc, $sod, $pot)
    {
        if ($su > 11.1) {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            $suger = 5;
        } else if (8.1 <= $su && $su <= 11.1) {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            $suger = 4;
        } else if (6.1 <= $su && $su < 8.1) {
            $tempereryNote = $this->getNote('su_high');

            $this->writeNote('su_high', $tempereryNote["note"]);

            $suger = 3;
        } else if (4.1 <= $su && $su < 6.1) {
            $tempereryNote = $this->getNote('su_normal');

            $this->writeNote('su_normal', $tempereryNote["note"]);

            $suger = 2;

        } else if (2.8 <= $su && $su < 4.1) {
            $tempereryNote = $this->getNote('su_normal');

            $this->writeNote('su_normal', $tempereryNote["note"]);

            $suger = 1;
        } else if (2.8 > $su) {
            $tempereryNote = $this->getNote('su_low');

            $this->writeNote('su_low', $tempereryNote["note"]);

            $suger = 0;
        }

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

        return $suger;
    }

    public function urinaryFactors($sg, $alb, $rbcc, $wbcc)
    {
        if ($sg < 1.001) {
            $tempereryNote = $this->getNote('sg_low');

            $this->writeNote('sg_low', $tempereryNote["note"]);
        } else if (1.001 <= $sg && $sg < 1.035) {
            $tempereryNote = $this->getNote('sg_normal');

            $this->writeNote('sg_normal', $tempereryNote["note"]);
        } else if ($sg >= 1.035) {
            $tempereryNote = $this->getNote('sg_high');

            $this->writeNote('sg_high', $tempereryNote["note"]);
        }

        if ($alb > 350) {
            $tempereryNote = $this->getNote('alb_high');

            $this->writeNote('alb_high', $tempereryNote["note"]);

            $al = 5;
        } else if (300 <= $alb && $alb <= 350) {
            $tempereryNote = $this->getNote('alb_high');

            $this->writeNote('alb_high', $tempereryNote["note"]);

            $al = 4;
        } else if (30 <= $alb && $alb < 300) {
            $tempereryNote = $this->getNote('alb_micro');

            $this->writeNote('alb_micro', $tempereryNote["note"]);

            $al = 3;
        } else if ($alb < 30) {
            if ($alb > 27) {
                $tempereryNote = $this->getNote('alb_normal');

                $this->writeNote('alb_normal', $tempereryNote["note"]);

                $al = 2;
            } else if ($alb > 25) {
                $tempereryNote = $this->getNote('alb_normal');

                $this->writeNote('alb_normal', $tempereryNote["note"]);

                $al = 1;
            } else {
                $tempereryNote = $this->getNote('alb_normal');

                $this->writeNote('alb_normal', $tempereryNote["note"]);

                $al = 0;
            }
        }
        if ($rbcc > 3) {
            $tempereryNote = $this->getNote('rbcc_high');

            $this->writeNote('rbcc_high', $tempereryNote["note"]);
        } else if ($rbcc <= 3) {
            $tempereryNote = $this->getNote('rbcc_normal');

            $this->writeNote('rbcc_normal', $tempereryNote["note"]);
        }

        if ($wbcc > 10) {
            $tempereryNote = $this->getNote('wbcc_high');

            $this->writeNote('wbcc_high', $tempereryNote["note"]);
        } else if ($wbcc <= 10) {
            $tempereryNote = $this->getNote('wbcc_normal');

            $this->writeNote('wbcc_normal', $tempereryNote["note"]);
        }

        return $al;
    }
}
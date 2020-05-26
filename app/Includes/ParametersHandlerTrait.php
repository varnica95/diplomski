<?php


namespace App\Includes;


trait ParametersHandlerTrait
{
    public function bloodPressureHandler($systolic, $diastolic)
    {
        if ($systolic < 120 && $diastolic < 80) {
            $note = $this->getNote('bp_optimum');
            $this->writeNote('bp_normal', $note["note"]);

            return 0;
        } else if ((120 <= $systolic && $systolic < 130) && (80 <= $diastolic && $diastolic < 85)) {
            $note = $this->getNote('bp_normal1');
            $this->writeNote('bp_normal1', $note["note"]);

            return 0;
        } else if ((130 <= $systolic && $systolic < 140) || (85 <= $diastolic && $diastolic < 90)) {
            $note = $this->getNote('bp_normal2');
            $this->writeNote('bp_normal2', $note["note"]);

            return 0;
        } else if ((140 <= $systolic && $systolic < 160) || (90 <= $diastolic && $diastolic < 100)) {
            $note = $this->getNote('bp_h1');
            $this->writeNote('bp_h1', $note["note"]);

            return 1;
        } else if ((160 <= $systolic && $systolic < 180) || (100 <= $diastolic && $diastolic < 110)) {
            $note = $this->getNote('bp_h2');
            $this->writeNote('bp_h2', $note["note"]);

            return 1;
        } else if ($systolic >= 180 || $diastolic >= 110) {
            $note = $this->getNote('bp_h3');
            $this->writeNote('bp_h3', $note["note"]);

            return 1;
        }
    }

    public function hematologyFactors($rbc, $hemo)
    {
        if ($rbc >= 5.5) {
            $note = $this->getNote('rbc_high');
            $this->writeNote('rbc_high', $note["note"]);

            $hemo_anemia = 0;
        } else if ($rbc < 5.5) {
            $note = $this->getNote('rbc_normal');
            $this->writeNote('rbc_normal', $note["note"]);

            $hemo_anemia = 1;
        }

        if (Session::get("Gender") === "Female") {
            if ($hemo > 16) {
                $note = $this->getNote('hemo_high');
                $this->writeNote('hemo_high', $note["note"]);
            } else if (12 <= $hemo && $hemo <= 16) {
                $note = $this->getNote('hemo_normal');
                $this->writeNote('hemo_normal', $note["note"]);
            } else if ($hemo < 12) {
                $note = $this->getNote('hemo_low');
                $this->writeNote('hemo_low', $note["note"]);
            }
        } else {
            if ($hemo > 18) {
                $note = $this->getNote('hemo_high');
                $this->writeNote('hemo_high', $note["note"]);
            } else if (14 <= $hemo && $hemo <= 18) {
                $note = $this->getNote('hemo_normal');
                $this->writeNote('hemo_normal', $note["note"]);
            } else if ($hemo < 14) {
                $note = $this->getNote('hemo_low');
                $this->writeNote('hemo_low', $note["note"]);
            }
        }
        return $hemo_anemia;
    }

    public function biochemicalFactors($su, $bu, $sc, $sod, $pot)
    {
        if ($su >= 11.1) {
            $note = $this->getNote('su_high');
            $this->writeNote('su_high', $note["note"]);

            $sugar = 3;
        } else if (6.1 <= $su && $su < 11.1) {
            $note = $this->getNote('su_high');
            $this->writeNote('su_high', $note["note"]);

            $sugar = 2;
        } else if (2.8 <= $su && $su < 6.1) {
            $note = $this->getNote('su_normal');
            $this->writeNote('su_normal', $note["note"]);

            $sugar = 0;
        } else if (2.8 > $su) {
            $note = $this->getNote('su_low');
            $this->writeNote('su_low', $note["note"]);

            $sugar = 1;
        }

        if ($bu > 8.3) {
            $note = $this->getNote('bu_high');
            $this->writeNote('bu_high', $note["note"]);
        } else if (2.8 <= $bu && $bu <= 8.3) {
            $note = $this->getNote('bu_normal');
            $this->writeNote('bu_normal', $note["note"]);
        } else if ($bu < 2.8) {
            $note = $this->getNote('bu_low');
            $this->writeNote('bu_low', $note["note"]);
        }

        if (Session::get("Gender") === "Female") {
            if ($sc > 107) {
                $note = $this->getNote('sc_high');
                $this->writeNote('sc_high', $note["note"]);
            } else if (63 <= $sc && $sc <= 107) {
                $note = $this->getNote('sc_normal');
                $this->writeNote('sc_normal', $note["note"]);
            } else if ($sc < 63) {
                $note = $this->getNote('sc_low');
                $this->writeNote('sc_low', $note["note"]);
            }
        } else {
            if ($sc > 125) {
                $note = $this->getNote('sc_high');
                $this->writeNote('sc_high', $note["note"]);
            } else if (79 <= $sc && $sc <= 125) {
                $note = $this->getNote('sc_normal');
                $this->writeNote('sc_normal', $note["note"]);
            } else if ($sc < 79) {
                $note = $this->getNote('sc_low');
                $this->writeNote('sc_low', $note["note"]);
            }
        }

        if ($sod > 145) {
            $note = $this->getNote('sod_high');
            $this->writeNote('sod_high', $note["note"]);
        } else if (136 <= $sod && $sod <= 145) {
            $note = $this->getNote('sod_normal');
            $this->writeNote('sod_normal', $note["note"]);
        } else if ($sod < 136) {
            $note = $this->getNote('sod_low');
            $this->writeNote('sod_low', $note["note"]);
        }

        if ($pot > 5.3) {
            $note = $this->getNote('pot_high');
            $this->writeNote('pot_high', $note["note"]);
        } else if (3.5 <= $pot && $pot <= 5.3) {
            $note = $this->getNote('pot_normal');
            $this->writeNote('pot_normal', $note["note"]);
        } else if ($pot < 3.5) {
            $note = $this->getNote('pot_low');
            $this->writeNote('pot_low', $note["note"]);
        }
        return $sugar;
    }

    public function urinaryFactors($sg, $alb, $rbcc, $wbcc, $ratio)
    {
        if ($sg < 1.001) {
            $note = $this->getNote('sg_low');
            $this->writeNote('sg_low', $note["note"]);
        } else if (1.001 <= $sg && $sg < 1.035) {
            $note = $this->getNote('sg_normal');
            $this->writeNote('sg_normal', $note["note"]);
        } else if ($sg >= 1.035) {
            $note = $this->getNote('sg_high');
            $this->writeNote('sg_high', $note["note"]);
        }

        if(Session::get("gender") === "Female") {
            if ($alb > 300 || $ratio > 28) {
                $note = $this->getNote('alb_high');
                $this->writeNote('alb_high', $note["note"]);

                $al = 2;
            } else if ((30 <= $alb && $alb < 300) || ( 2.8 <= $ratio && $ratio < 28)) {
                $note = $this->getNote('alb_micro');
                $this->writeNote('alb_micro', $note["note"]);

                $al = 1;
            } else if ($alb < 30 || $ratio < 2.8) {
                $note = $this->getNote('alb_normal');
                $this->writeNote('alb_normal', $note["note"]);
                $al = 0;
            }
        }else{
            if ($alb > 300 || $ratio > 20) {
                $note = $this->getNote('alb_high');
                $this->writeNote('alb_high', $note["note"]);

                $al = 2;
            } else if ((30 <= $alb && $alb < 300) || ( 2 <= $ratio && $ratio < 20)) {
                $note = $this->getNote('alb_micro');
                $this->writeNote('alb_micro', $note["note"]);

                $al = 3;
            } else if ($alb < 30 || $ratio < 2) {
                $note = $this->getNote('alb_normal');
                $this->writeNote('alb_normal', $note["note"]);

                $al = 0;
            }
        }
        if ($rbcc > 3) {
            $note = $this->getNote('rbcc_high');
            $this->writeNote('rbcc_high', $note["note"]);
        } else if ($rbcc <= 3) {
            $note = $this->getNote('rbcc_normal');
            $this->writeNote('rbcc_normal', $note["note"]);
        }

        if ($wbcc > 10) {
            $note = $this->getNote('wbcc_high');
            $this->writeNote('wbcc_high', $note["note"]);
        } else if ($wbcc <= 10) {
            $note = $this->getNote('wbcc_normal');
            $this->writeNote('wbcc_normal', $note["note"]);
        }
        return $al;
    }

    public function acute($urea, $creatinine)
    {
        $bu = $urea / 0.357;
        $sc = $creatinine / 88.4;

        $bun_sc_ratio = round($bu/$sc, 2);

        if ($bun_sc_ratio > 20)
        {
            $note = $this->getNote('acu_preren');

            $this->writeNote('acu_preren', $note["note"]);
        }else if(10 <= $bun_sc_ratio && $bun_sc_ratio <= 15)
        {
            $note = $this->getNote('acu_ren');

            $this->writeNote('acu_ren', $note["note"]);
        }else{
            $note = $this->getNote('acu_normal');

            $this->writeNote('acu_normal', $note["note"]);
        }

        return $bun_sc_ratio;
    }

    public function chronic($age, $weight, $creatinine)
    {

        $sc = $creatinine / 88.4;

        $clearance_creatinine = round(((140 - $age) * $weight) / (72 * $sc), 2);
        $gfr = round(186 * pow($sc, -1.154) * pow($age, -0.203), 2);

        if(Session::get("gender") === "Female") {
            $clearance_creatinine = $clearance_creatinine * 0.85;
            $gfr = $gfr * 0.742;
        }

        if($clearance_creatinine < 40)
        {
            $note = $this->getNote('crcl_anem');
            $this->writeNote('crcl_anem', $note["note"]);

            $ckd_anemia = 1;
        }else{
            $note = $this->getNote('crcl_anem_normal');
            $this->writeNote('crcl_anem_normal', $note["note"]);

            $ckd_anemia = 0;
        }

        if($clearance_creatinine > 50)
        {
            $note = $this->getNote('crcl_normal');
            $this->writeNote('crcl_normal', $note["note"]);
        }else if(30 <= $clearance_creatinine && $clearance_creatinine <= 50)
        {
            $note = $this->getNote('crcl_mild');
            $this->writeNote('crcl_mild', $note["note"]);
        }else if(10 <= $clearance_creatinine && $clearance_creatinine < 30)
        {
            $note = $this->getNote('crcl_mod');
            $this->writeNote('crcl_mod', $note["note"]);
        }else if($clearance_creatinine < 10)
        {
            $note = $this->getNote('crcl_heavy');
            $this->writeNote('crcl_heavy', $note["note"]);
        }else if($clearance_creatinine < 5)
        {
            $note = $this->getNote('crcl_dialysis');
            $this->writeNote('crcl_dialysis', $note["note"]);
        }

        if($gfr > 90)
        {
            $note = $this->getNote('ckd_0');
            $this->writeNote('ckd_0', $note["note"]);
        }else if($gfr === 90)
        {
            $note = $this->getNote('ckd_1');
            $this->writeNote('ckd_1', $note["note"]);
        }else if(60 <= $gfr && $gfr < 90)
        {
            $note = $this->getNote('ckd_2');
            $this->writeNote('ckd_2', $note["note"]);
        }else if(30 <= $gfr && $gfr < 60)
        {
            $note = $this->getNote('ckd_3');
            $this->writeNote('ckd_3', $note["note"]);
        }else if(15 <= $gfr && $gfr < 30)
        {
            $note = $this->getNote('ckd_4');
            $this->writeNote('ckd_4', $note["note"]);
        }else if($gfr < 15)
        {
            $note = $this->getNote('ckd_5');
            $this->writeNote('ckd_5', $note["note"]);
        }

        return [
            "clearance_creatinine" => $clearance_creatinine,
            "gfr" => $gfr
        ];
    }
}
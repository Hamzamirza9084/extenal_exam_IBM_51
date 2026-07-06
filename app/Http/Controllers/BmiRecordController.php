<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BmiRecord;

class BmiRecordController extends Controller
{
    public function index()
    {
        return view('bmi');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'age' => 'required|integer|min:2|max:120',
            'gender' => 'required|string|in:male,female,other',
            'height' => 'required|numeric|min:50|max:300', // cm
            'weight' => 'required|numeric|min:2|max:500',  // kg
        ]);

        $heightInMeters = $validated['height'] / 100;
        $bmi = $validated['weight'] / ($heightInMeters * $heightInMeters);
        $bmi = round($bmi, 2);

        $classification = $this->getClassification($bmi);

        BmiRecord::create([
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'bmi' => $bmi,
            'classification' => $classification,
        ]);

        return redirect()->route('bmi.index')->with([
            'bmi' => $bmi,
            'classification' => $classification,
            'success' => 'BMI calculated successfully!'
        ]);
    }

    private function getClassification($bmi)
    {
        if ($bmi < 16) {
            return 'Severe Thinness';
        } elseif ($bmi >= 16 && $bmi < 17) {
            return 'Moderate Thinness';
        } elseif ($bmi >= 17 && $bmi < 18.5) {
            return 'Mild Thinness';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            return 'Normal';
        } elseif ($bmi >= 25 && $bmi < 30) {
            return 'Overweight';
        } elseif ($bmi >= 30 && $bmi < 35) {
            return 'Obese Class I';
        } elseif ($bmi >= 35 && $bmi < 40) {
            return 'Obese Class II';
        } else {
            return 'Obese Class III';
        }
    }
}

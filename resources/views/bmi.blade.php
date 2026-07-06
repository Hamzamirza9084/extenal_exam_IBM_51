<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium BMI Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ffffff;
            --primary-hover: #e2e8f0;
            --secondary: #d1d5db;
            --bg-color: #000000;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-main: #ffffff;
            --text-muted: #9ca3af;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            background-image: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            background-size: cover;
            background-attachment: fixed;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .glass-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.2rem;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: var(--text-main);
            font-size: 1rem;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background: rgba(0, 0, 0, 0.3);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }
        
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.2rem;
        }

        select.form-control option {
            background-color: var(--bg-color);
            color: var(--text-main);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: #ffffff;
            border: none;
            border-radius: 12px;
            color: #000000;
            font-size: 1.1rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            background: #e2e8f0;
            box-shadow: 0 10px 20px -10px rgba(255, 255, 255, 0.3);
        }

        .btn-submit:active {
            transform: translateY(1px);
        }

        .result-card {
            margin-top: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            border: 1px solid var(--glass-border);
            text-align: center;
            animation: fadeIn 0.5s ease-out forwards;
        }

        .result-card h2 {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .bmi-value {
            font-size: 3rem;
            font-weight: 700;
            margin: 0.5rem 0;
            color: white;
        }

        .classification {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1rem;
            background: rgba(255,255,255,0.1);
        }
        
        /* Classification Colors */
        .class-Severe.Thinness { color: #ffffff; background: rgba(255, 255, 255, 0.2); }
        .class-Moderate.Thinness { color: #e5e7eb; background: rgba(229, 231, 235, 0.2); }
        .class-Mild.Thinness { color: #d1d5db; background: rgba(209, 213, 219, 0.2); }
        .class-Normal { color: #000000; background: #ffffff; }
        .class-Overweight { color: #d1d5db; background: rgba(209, 213, 219, 0.2); }
        .class-Obese.Class.I { color: #e5e7eb; background: rgba(229, 231, 235, 0.2); }
        .class-Obese.Class.II { color: #f3f4f6; background: rgba(243, 244, 246, 0.2); }
        .class-Obese.Class.III { color: #ffffff; background: rgba(255, 255, 255, 0.3); }

        .error-msg {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="glass-panel">
            <div class="header">
                <h1>BMI Calculator</h1>
                <p>Enter your details below to check your Body Mass Index</p>
            </div>

            <form action="{{ route('bmi.calculate') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" class="form-control" placeholder="e.g. 25" required min="2" max="120" value="{{ old('age') }}">
                    @error('age') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="height">Height (cm)</label>
                    <input type="number" id="height" name="height" step="0.1" class="form-control" placeholder="e.g. 175" required min="50" max="300" value="{{ old('height') }}">
                    @error('height') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" id="weight" name="weight" step="0.1" class="form-control" placeholder="e.g. 70" required min="2" max="500" value="{{ old('weight') }}">
                    @error('weight') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn-submit">Calculate BMI</button>
            </form>

            @if(session('bmi'))
                <div class="result-card">
                    <h2>Your Result</h2>
                    <div class="bmi-value">{{ session('bmi') }}</div>
                    @php
                        $classSafe = str_replace(' ', '.', session('classification'));
                    @endphp
                    <div class="classification class-{{ $classSafe }}">
                        {{ session('classification') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

</body>
</html>

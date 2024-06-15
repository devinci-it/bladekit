<div {{ $attributes->merge(['class' => 'multi-step-form']) }}>
    @foreach ($titles as $index => $title)
        <div class="step-title {{ $loop->first ? 'active' : '' }}">
            <h3>{{ $title }}</h3>
        </div>
    @endforeach

    <div class="steps">
        {{ $slot }}
    </div>

    <div class="form-navigation">
        <button type="button" class="prev-step btn round" style="display: none;" onclick="prevStep()">{{ $buttonLabels['prev'] }}</button>
        <button type="button" class="next-step btn round" onclick="nextStep()">{{ $buttonLabels['next'] }}</button>
        <button type="submit" class="submit-form btn round" style="display: none;">{{ $buttonLabels['submit'] }}</button>
    </div>
</div>

@push('styles')
    <style>
        .multi-step-form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        .multi-step-form .step-title {
            display: none;
            text-align: center;
        }
        .multi-step-form .step-title.active {
            display: block;
        }
        .multi-step-form .steps {
            flex: 1;
        }
        .multi-step-form .step {
            display: none;
            width: 100%;
        }
        .multi-step-form .step.active {
            display: block;
        }
        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }
        .form-navigation button {
            cursor: pointer;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 1rem;
        }
        .form-navigation button:disabled {
            background-color: #cccccc;
        }
        .form-navigation button.round {
            border-radius: 20px;
        }
        .form-navigation button:hover {
            background-color: #0056b3;
        }
        .shake {
            animation: shake 0.3s;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }
        .form-group {
            width: 100%;
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }
        @media (max-width: 768px) {
            .form-navigation button {
                width: 100%;
                margin-top: 0.5rem;
            }
            .form-navigation {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let steps = document.querySelectorAll('.multi-step-form .step');
            let stepTitles = document.querySelectorAll('.multi-step-form .step-title');
            let prevButton = document.querySelector('.prev-step');
            let nextButton = document.querySelector('.next-step');
            let submitButton = document.querySelector('.submit-form');
            let currentStep = 0;

            function initialize() {
                steps = document.querySelectorAll('.multi-step-form .step');
                stepTitles = document.querySelectorAll('.multi-step-form .step-title');
                prevButton = document.querySelector('.prev-step');
                nextButton = document.querySelector('.next-step');
                submitButton = document.querySelector('.submit-form');

                if (steps.length > 0) {
                    showStep(currentStep);
                } else {
                    console.error('No steps found');
                }
            }

            function showStep(stepIndex) {
                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === stepIndex);
                });
                stepTitles.forEach((title, index) => {
                    title.classList.toggle('active', index === stepIndex);
                });

                if (prevButton) {
                    prevButton.style.display = stepIndex === 0 ? 'none' : 'inline-block';
                }
                if (nextButton) {
                    nextButton.style.display = stepIndex === steps.length - 1 ? 'none' : 'inline-block';
                }
                if (submitButton) {
                    submitButton.style.display = stepIndex === steps.length - 1 ? 'inline-block' : 'none';
                }
            }

            window.nextStep = function () {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            }

            window.prevStep = function () {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            }

            initialize();
        });
    </script>
@endpush

<!-- resources/views/components/multistep-form.blade.php -->
<div id="multistep-form">
    <form id="form" action="{{ $action }}" method="POST">
        @csrf
        <div class="steps">
            @foreach($steps as $step)
                {!! $step['content'] !!}
            @endforeach
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentStep = 0;
    const steps = document.querySelectorAll('.step');
    const nextButtons = document.querySelectorAll('.next');
    const prevButtons = document.querySelectorAll('.prev');

    function showStep(step) {
        steps.forEach((s, index) => {
            s.classList.toggle('active', index === step);
        });
    }

    showStep(currentStep);

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });
});
</script>

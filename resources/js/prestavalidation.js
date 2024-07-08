document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.step');
    const nextButtons = document.querySelectorAll('.nextStep');
    const prevButtons = document.querySelectorAll('.prevStep');
    let currentStep = 0;

    function showStep(step) {
        steps.forEach((stepElement, index) => {
            stepElement.classList.toggle('hidden', index !== step);
        });
    }

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            currentStep++;
            showStep(currentStep);
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            currentStep--;
            showStep(currentStep);
        });
    });

    showStep(currentStep);
});
function checkIfValidIBAN(input) {
    if (input.value.length === 27) {
        input.classList.remove('border', 'border-red-500');
        input.classList.add('border', 'border-green-500');
    } else {
        input.classList.remove('border', 'border-green-500');
        input.classList.add('border', 'border-red-500');
    }
}

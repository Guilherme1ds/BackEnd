import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Input masking helpers
function applyMask(value, maskType) {
    const digits = value.replace(/\D/g, '');

    if (maskType === 'cpf') {
        const part1 = digits.slice(0, 3);
        const part2 = digits.slice(3, 6);
        const part3 = digits.slice(6, 9);
        const part4 = digits.slice(9, 11);
        let formatted = part1;
        if (part2) formatted += '.' + part2;
        if (part3) formatted += '.' + part3;
        if (part4) formatted += '-' + part4;
        return formatted;
    }

    if (maskType === 'cnpj') {
        const part1 = digits.slice(0, 2);
        const part2 = digits.slice(2, 5);
        const part3 = digits.slice(5, 8);
        const part4 = digits.slice(8, 12);
        const part5 = digits.slice(12, 14);
        let formatted = part1;
        if (part2) formatted += '.' + part2;
        if (part3) formatted += '.' + part3;
        if (part4) formatted += '/' + part4;
        if (part5) formatted += '-' + part5;
        return formatted;
    }

    if (maskType === 'phone') {
        const part1 = digits.slice(0, 2);
        const part2 = digits.slice(2, 7);
        const part3 = digits.slice(7, 11);
        let formatted = '';
        if (part1) formatted += '(' + part1 + ')';
        if (part2) formatted += ' ' + part2;
        if (part3) formatted += '-' + part3;
        return formatted;
    }

    if (maskType === 'cep') {
        const part1 = digits.slice(0, 5);
        const part2 = digits.slice(5, 8);
        let formatted = part1;
        if (part2) formatted += '-' + part2;
        return formatted;
    }

    // Default: return digits only
    return digits;
}

function initInputMasks() {
    document.querySelectorAll('[data-mask]').forEach((input) => {
        const maskType = input.getAttribute('data-mask');

        const onInput = (event) => {
            const value = event.target.value;
            const formatted = applyMask(value, maskType);
            event.target.value = formatted;
        };

        input.addEventListener('input', onInput);

        // Apply formatting to any initial value
        if (input.value) {
            input.value = applyMask(input.value, maskType);
        }
    });
}

// Initialize on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initInputMasks);
} else {
    initInputMasks();
}

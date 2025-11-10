/**
 * JavaScript para el formulario de citas veterinarias
 * Maneja validación y mejoras de UX
 */

document.addEventListener('DOMContentLoaded', function() {
    initAppointmentForm();
});

/**
 * Inicializar el formulario de citas
 */
function initAppointmentForm() {
    const form = document.querySelector('form');
    const fechaInput = document.getElementById('fecha');
    const telefonoInput = document.getElementById('telefono');
    
    if (!form) return;
    
    // Establecer fecha mínima como hoy
    if (fechaInput) {
        fechaInput.min = new Date().toISOString().split('T')[0];
    }
    
    // Validación del formulario al enviar
    form.addEventListener('submit', handleFormSubmit);
    
    // Validación de teléfono en tiempo real
    if (telefonoInput) {
        telefonoInput.addEventListener('input', formatPhoneNumber);
    }
    
    // Validación en tiempo real de campos requeridos
    setupRealTimeValidation(form);
    
    // Auto-capitalizar nombres
    setupAutoCapitalize();
    
    // Confirmación antes de limpiar formulario
    const resetButton = document.querySelector('button[type="reset"]');
    if (resetButton) {
        resetButton.addEventListener('click', handleFormReset);
    }
}

/**
 * Manejar el envío del formulario
 */
function handleFormSubmit(e) {
    const form = e.target;
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    let firstInvalidField = null;
    
    // Validar campos requeridos
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('is-invalid');
            
            if (!firstInvalidField) {
                firstInvalidField = field;
            }
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    // Validar email
    const emailField = document.getElementById('email');
    if (emailField && emailField.value) {
        if (!isValidEmail(emailField.value)) {
            isValid = false;
            emailField.classList.add('is-invalid');
            if (!firstInvalidField) {
                firstInvalidField = emailField;
            }
        }
    }
    
    // Validar teléfono
    const telefonoField = document.getElementById('telefono');
    if (telefonoField && telefonoField.value) {
        if (telefonoField.value.length < 7) {
            isValid = false;
            telefonoField.classList.add('is-invalid');
            if (!firstInvalidField) {
                firstInvalidField = telefonoField;
            }
        }
    }
    
    // Validar motivo (mínimo 10 caracteres)
    const motivoField = document.getElementById('motivo');
    if (motivoField && motivoField.value) {
        if (motivoField.value.trim().length < 10) {
            isValid = false;
            motivoField.classList.add('is-invalid');
            if (!firstInvalidField) {
                firstInvalidField = motivoField;
            }
        }
    }
    
    if (!isValid) {
        e.preventDefault();
        alert('Por favor, complete todos los campos obligatorios correctamente (marcados con *)');
        
        // Hacer scroll al primer campo inválido
        if (firstInvalidField) {
            firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(() => firstInvalidField.focus(), 500);
        }
    }
}

/**
 * Formatear número de teléfono
 */
function formatPhoneNumber(e) {
    const input = e.target;
    // Permitir solo números, guiones, espacios, paréntesis y +
    input.value = input.value.replace(/[^0-9\-\s\+\(\)]/g, '');
}

/**
 * Validar formato de email
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Configurar validación en tiempo real
 */
function setupRealTimeValidation(form) {
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
        
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Validación especial para email
    const emailField = document.getElementById('email');
    if (emailField) {
        emailField.addEventListener('blur', function() {
            if (this.value && !isValidEmail(this.value)) {
                this.classList.add('is-invalid');
            } else if (this.value) {
                this.classList.remove('is-invalid');
            }
        });
    }
    
    // Validación especial para motivo (mínimo 10 caracteres)
    const motivoField = document.getElementById('motivo');
    if (motivoField) {
        motivoField.addEventListener('input', function() {
            const counter = document.getElementById('motivo-counter');
            const currentLength = this.value.trim().length;
            
            if (!counter) {
                const counterDiv = document.createElement('div');
                counterDiv.id = 'motivo-counter';
                counterDiv.className = 'small text-muted mt-1';
                this.parentNode.parentNode.appendChild(counterDiv);
            }
            
            const counterEl = document.getElementById('motivo-counter');
            if (currentLength < 10) {
                counterEl.textContent = `${currentLength}/10 caracteres mínimos`;
                counterEl.classList.add('text-warning');
                counterEl.classList.remove('text-success');
            } else {
                counterEl.textContent = `${currentLength} caracteres`;
                counterEl.classList.add('text-success');
                counterEl.classList.remove('text-warning');
            }
        });
    }
}

/**
 * Auto-capitalizar nombres
 */
function setupAutoCapitalize() {
    const nombreFields = ['nombre_dueno', 'nombre_mascota'];
    
    nombreFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('blur', function() {
                this.value = capitalizeWords(this.value);
            });
        }
    });
}

/**
 * Capitalizar palabras
 */
function capitalizeWords(str) {
    return str.replace(/\b\w/g, char => char.toUpperCase());
}

/**
 * Manejar reseteo del formulario
 */
function handleFormReset(e) {
    if (!confirm('¿Está seguro de que desea limpiar todos los campos del formulario?')) {
        e.preventDefault();
    } else {
        // Limpiar clases de validación
        const form = e.target.closest('form');
        const invalidFields = form.querySelectorAll('.is-invalid');
        invalidFields.forEach(field => field.classList.remove('is-invalid'));
        
        // Eliminar contador de caracteres si existe
        const counter = document.getElementById('motivo-counter');
        if (counter) {
            counter.remove();
        }
    }
}

/**
 * Función auxiliar para mostrar mensajes de confirmación
 */
function showConfirmation(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
    alertDiv.style.zIndex = '9999';
    alertDiv.innerHTML = `
        <strong><i class="bi bi-check-circle-fill me-2"></i>${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto-dismiss después de 5 segundos
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

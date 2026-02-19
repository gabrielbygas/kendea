@extends('layouts.app')

@section('title', __('Contact') . ' - KENDEA')

@section('content')
<div class="page-header py-5" style="background: linear-gradient(135deg, #FF6A00 0%, #E55F00 100%);">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold" style="color: white !important;">{{ __('Contact') }}</h1>
        <p class="lead">{{ __('Nous sommes là pour vous aider') }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2>{{ __('Contactez-nous') }}</h2>
            <div class="contact-info mt-4">
                <div class="mb-4">
                    <h5><i class="bi bi-whatsapp text-success me-2"></i> WhatsApp</h5>
                    <p class="text-muted">+971 XX XXX XXXX</p>
                </div>
                <div class="mb-4">
                    <h5><i class="bi bi-envelope text-primary me-2"></i> Email</h5>
                    <p class="text-muted">info@kendea.ae</p>
                </div>
                <div class="mb-4">
                    <h5><i class="bi bi-clock text-primary me-2"></i> {{ __('Horaires') }}</h5>
                    <p class="text-muted">{{ __('Lundi - Dimanche: 9h00 - 21h00') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <h2>{{ __('Envoyez-nous un message') }}</h2>
            <form id="contact-form" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Nom') }}</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Message') }}</label>
                    <textarea name="message" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="submit-btn">
                    <span id="submit-text">{{ __('Envoyer') }}</span>
                    <span id="submit-spinner" class="d-none">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        {{ __('Envoi en cours...') }}
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = $('#submit-btn');
        const submitText = $('#submit-text');
        const submitSpinner = $('#submit-spinner');
        
        // Disable button and show spinner
        submitBtn.prop('disabled', true);
        submitText.addClass('d-none');
        submitSpinner.removeClass('d-none');
        
        $.ajax({
            url: '{{ route("contact.send") }}',
            method: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    if (typeof showToast === 'function') {
                        showToast(response.message, 'success');
                    } else {
                        alert(response.message);
                    }
                    
                    // Reset form
                    form[0].reset();
                }
            },
            error: function(xhr) {
                let errorMsg = '{{ __("Une erreur est survenue. Veuillez réessayer.") }}';
                
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Show validation errors
                    const errors = xhr.responseJSON.errors;
                    errorMsg = Object.values(errors).flat().join('\n');
                }
                
                if (typeof showToast === 'function') {
                    showToast(errorMsg, 'error');
                } else {
                    alert(errorMsg);
                }
            },
            complete: function() {
                // Re-enable button and hide spinner
                submitBtn.prop('disabled', false);
                submitText.removeClass('d-none');
                submitSpinner.addClass('d-none');
            }
        });
    });
});
</script>
@endpush
@endsection

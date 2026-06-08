<section class="mj-section mj-section--beige">
    <div class="mj-container mj-reveal">
        <div class="mj-cta">
            <h2 class="mj-cta__title">{{ __('website.contact_cta_title') }}</h2>
            <p class="mj-cta__text">{{ __('website.contact_cta_text') }}</p>
            <div class="mj-cta__actions">
                <a href="{{ route('web.contact.index') }}" class="mj-btn mj-btn--gold">
                    <i class="bi bi-envelope" aria-hidden="true"></i> {{ __('website.contact_us') }}
                </a>
                <a href="{{ route('web.request-information.create') }}" class="mj-btn mj-btn--outline">
                    <i class="bi bi-file-earmark-text" aria-hidden="true"></i> {{ __('website.request_information') }}
                </a>
            </div>
        </div>
    </div>
</section>

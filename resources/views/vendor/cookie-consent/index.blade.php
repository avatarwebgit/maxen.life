@php
    $locale = $app->getLocale();
    $setting = \App\Models\Setting::first();
@endphp

<div role="dialog" aria-labelledby="lcc-modal-alert-label" aria-describedby="lcc-modal-alert-desc" aria-modal="true" class="lcc-modal lcc-modal--alert js-lcc-modal d-flex js-lcc-modal-alert" style="display: none;"
     data-cookie-key="{{ config('cookie-consent.cookie_key') }}"
     data-cookie-value-analytics="{{ config('cookie-consent.cookie_value_analytics') }}"
     data-cookie-value-marketing="{{ config('cookie-consent.cookie_value_marketing') }}"
     data-cookie-value-both="{{ config('cookie-consent.cookie_value_both') }}"
     data-cookie-value-none="{{ config('cookie-consent.cookie_value_none') }}"
     data-cookie-expiration-days="{{ config('cookie-consent.cookie_expiration_days') }}"
     data-gtm-event="{{ config('cookie-consent.gtm_event') }}"
     data-ignored-paths="{{ implode(',', config('cookie-consent.ignored_paths', [])) }}"
>
    <div class="lcc-modal__actions d-flex align-items-center">
        <button type="button" class="lcc-button js-lcc-accept">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="55" viewBox="0 0 55 55">
                <path id="Path_1086" data-name="Path 1086" d="M24.524,39.92,9.965,25.361l5.475-5.475,9.081,9.081L45.83,7.658a26.964,26.964,0,1,0,4.755,6.2Z" transform="translate(0.5 0.5)" fill="none" stroke="#000" stroke-width="1"/>
            </svg>
        </button>
        <button type="button" class="lcc-button lcc-button--link js-lcc-essentials">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="55" viewBox="0 0 55 55">
                <path id="Path_1087" data-name="Path 1087" d="M92.694,0a27,27,0,1,0,27,27,27,27,0,0,0-27-27m17.291,38.871-5.419,5.419L92.694,32.419,80.824,44.29,75.4,38.871,87.276,27,75.4,15.129l5.42-5.419,11.87,11.871L104.566,9.71l5.419,5.419L98.114,27Z" transform="translate(-65.194 0.5)" fill="none" stroke="#000" stroke-width="1"/>
            </svg>
        </button>
    </div>
    <div class="lcc-modal__content">
{{--        <h2 id="lcc-modal-alert-label" class="lcc-modal__title">--}}
{{--            @lang('cookie-consent::texts.alert_title')--}}
{{--        </h2>--}}
        <p id="lcc-modal-alert-desc" class="lcc-text">
        {{$setting->text_cookie_en}}
        </p>
    </div>

</div>

<div role="dialog" aria-labelledby="lcc-modal-settings-label" aria-describedby="lcc-modal-settings-desc" aria-modal="true" class="lcc-modal lcc-modal--settings js-lcc-modal js-lcc-modal-settings" style="display: none;">
    <button class="lcc-modal__close js-lcc-settings-toggle" type="button">
        <span class="lcc-u-sr-only">
            @lang('cookie-consent::texts.settings_close')
        </span>
        &times;
    </button>
    <div class="lcc-modal__content">
        <div class="lcc-modal__content">
            <h2 id="lcc-modal-settings-label" class="lcc-modal__title">
                @lang('cookie-consent::texts.settings_title')
            </h2>
            <p id="lcc-modal-settings-desc" class="lcc-text">
                {!! trans('cookie-consent::texts.settings_text', [ 'policyUrl' => config("cookie-consent.policy_url_$locale")]) !!}
            </p>
            <div class="lcc-modal__section lcc-u-text-center">
                <button type="button" class="lcc-button js-lcc-accept">
                    @lang('cookie-consent::texts.settings_accept_all')
                </button>
            </div>
            <div class="lcc-modal__section">
                <label for="lcc-checkbox-essential" class="lcc-label">
                    <input type="checkbox" id="lcc-checkbox-essential" disabled="disabled" checked="checked">
                    <span>@lang('cookie-consent::texts.setting_essential')</span>
                </label>
                <p class="lcc-text">
                    @lang('cookie-consent::texts.setting_essential_text')
                </p>
            </div>
            <div class="lcc-modal__section">
                <label for="lcc-checkbox-funtcional" class="lcc-label">
                    <input type="checkbox" id="lcc-checkbox-funtcional" disabled="disabled" checked="checked">
                    <span>@lang('cookie-consent::texts.setting_functional')</span>
                </label>
                <p class="lcc-text">
                    @lang('cookie-consent::texts.setting_functional_text')
                </p>
            </div>
            <div class="lcc-modal__section">
                <label for="lcc-checkbox-analytics" class="lcc-label">
                    <input type="checkbox" id="lcc-checkbox-analytics">
                    <span>@lang('cookie-consent::texts.setting_analytics')</span>
                </label>
                <p class="lcc-text">
                    @lang('cookie-consent::texts.setting_analytics_text')
                </p>
            </div>
            <div class="lcc-modal__section">
                <label for="lcc-checkbox-marketing" class="lcc-label">
                    <input type="checkbox" id="lcc-checkbox-marketing">
                    <span>@lang('cookie-consent::texts.setting_marketing')</span>
                </label>
                <p class="lcc-text">
                    @lang('cookie-consent::texts.setting_marketing_text')
                </p>
            </div>
        </div>
    </div>
    <div class="lcc-modal__actions">
        <button type="button" class="lcc-button js-lcc-settings-save">
            @lang('cookie-consent::texts.settings_save')
        </button>
    </div>
</div>


<script type="text/javascript" src="{{ asset("vendor/cookie-consent/js/cookie-consent.js") }}"></script>

@php
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $settings?->site_name ?? 'Ahla Finance',
        'url' => url('/'),
        'logo' => $settings?->logo ? asset($settings->logo) : asset('images/logo.png'),
        'description' => $settings?->meta_description ?? 'Ahla Finance Digitale révolutionne les services financiers au Tchad',
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => $settings?->phone ?? '',
            'email' => $settings?->email ?? '',
            'contactType' => 'Customer Service',
        ],
    ];

    if ($settings) {
        $sameAs = [];
        if ($settings->facebook_url) $sameAs[] = $settings->facebook_url;
        if ($settings->twitter_url) $sameAs[] = $settings->twitter_url;
        if ($settings->instagram_url) $sameAs[] = $settings->instagram_url;
        if ($settings->linkedin_url) $sameAs[] = $settings->linkedin_url;
        if (count($sameAs) > 0) {
            $schema['sameAs'] = $sameAs;
        }
    }
@endphp
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>


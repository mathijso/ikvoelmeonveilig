<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? 'Veiligheidsnetwerk - Voel je veiliger met hulp in de buurt' }}</title>
<meta name="description" content="{{ $description ?? 'Een veiligheidsnetwerk dat mensen in je buurt waarschuwt wanneer je je onveilig voelt. Directe hulp binnen 5 kilometer van je locatie.' }}" />

<!-- Favicon -->
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:title" content="{{ $title ?? 'Veiligheidsnetwerk - Voel je veiliger met hulp in de buurt' }}" />
<meta property="og:description" content="{{ $description ?? 'Een veiligheidsnetwerk dat mensen in je buurt waarschuwt wanneer je je onveilig voelt. Directe hulp binnen 5 kilometer van je locatie.' }}" />
<meta property="og:image" content="{{ url('/og-image.svg') }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{ url()->current() }}" />
<meta property="twitter:title" content="{{ $title ?? 'Veiligheidsnetwerk - Voel je veiliger met hulp in de buurt' }}" />
<meta property="twitter:description" content="{{ $description ?? 'Een veiligheidsnetwerk dat mensen in je buurt waarschuwt wanneer je je onveilig voelt. Directe hulp binnen 5 kilometer van je locatie.' }}" />
<meta property="twitter:image" content="{{ url('/og-image.svg') }}" />

<!-- Theme Color -->
<meta name="theme-color" content="#dc2626" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

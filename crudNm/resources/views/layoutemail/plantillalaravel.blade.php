@component('mail::message')
    # Formulario de contacto
    ## Enviado por: {{ $nombre }}
    ## Email del remitente: _{{ $email }}_
    ## Mensaje:
    > {{ $contenido }}
@endcomponent

<x-mail::message>
# Nouveau message de contact

Vous avez reçu un nouveau message depuis le formulaire de contact de KENDEA.

**Nom:** {{ $contactData['name'] }}  
**Email:** {{ $contactData['email'] }}

**Message:**

{{ $contactData['message'] }}

---

Ce message a été envoyé depuis le formulaire de contact du site KENDEA.  
Vous pouvez répondre directement à cet email pour contacter {{ $contactData['name'] }}.

Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>

# PulpmediaNgHttpBundle

## Minimal Configuration

   	# app/config/security.yml
         
    firewalls:
        main:
            access_denied_handler: pulpmedia_ng_http.accessdenied_handler
            entry_point: pulpmedia_ng_http.authentication_handler
LAB: https://portswigger.net/web-security/authentication/password-based/lab-broken-bruteforce-protection-ip-block
# What is the implemented protection?
- if you submitted 3 incorrect login attempts, your IP gets blocked
but the flaw is that the counter gets resetted at each correct attempt.

# Work around
- bruteForce the victims password and with the valid credentials you have, login every 3rd time to reset the IP-Blocking counter.

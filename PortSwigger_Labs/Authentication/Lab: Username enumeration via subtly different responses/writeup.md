LAB : https://portswigger.net/web-security/authentication/password-based/lab-username-enumeration-via-subtly-different-responses
# Flaw
there is a typo in the response, the response differs between an invalid username and an incorrect password.

# solution
enumerate the usernames until you get a different response, then start bruteForcing the password


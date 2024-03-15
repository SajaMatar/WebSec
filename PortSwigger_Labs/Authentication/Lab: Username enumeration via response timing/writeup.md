LAB: https://portswigger.net/web-security/authentication/password-based/lab-username-enumeration-via-response-timing
# What to use 
use the response time to determine the valid username, the longest one means the username is valid and the password was checked.

# Protection implemented
IP-Blocking, which can be bypassed by changing the X-Forwarded-For parameter in the header. (in both username and password testing)

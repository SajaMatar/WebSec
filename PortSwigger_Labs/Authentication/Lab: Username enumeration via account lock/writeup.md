LAB: https://portswigger.net/web-security/authentication/password-based/lab-username-enumeration-via-account-lock
# What is the implemented protection?
locks the account with 5 failed login attempts
the flaw here is prompting the lock to the user(attacker), in this case the attacker will know that this is a valid username

# Solution
try to find the valid username(the one that gets locked), then start bruteForcing the password

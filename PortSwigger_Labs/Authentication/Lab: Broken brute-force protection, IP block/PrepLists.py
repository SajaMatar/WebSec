# created by sm6r,2024
# Lab: Broken brute-force protection, IP block
# this code preps usernames/passwords lists used by solution.py

candidatePasses= open("CandidatePasswords.txt","r")
usernames= open("usernames.txt","a")
passwords= open("passwords.txt","a")

for i in range(50):
    print(f"wiener\ncarlos\ncarlos",file=usernames)
    
passes = candidatePasses.readlines()
for i in range(0,100,2):
    print(f"peter\n{passes[i].strip()}\n{passes[i+1].strip()}",file=passwords)


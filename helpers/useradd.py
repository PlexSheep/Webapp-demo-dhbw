import requests

file1 = open("familynames-usa-top1000.txt", 'r')
names = file1.readlines()

for i in range(0, 1000):
    r = requests.post("http://localhost:8080/auth/register.php", data={'MAIL': names[i] + '@test.com', 'USER': names[i], 'PASS':'password'})
    print(r)



import requests

for i in range(0, 1000):
    r = requests.post("http://localhost:8080/auth/register.php", data={'MAIL': 'test' + str(i) + '@test.com', 'USER':'tets' + str(i), 'PASS':'password'})
    print(r)



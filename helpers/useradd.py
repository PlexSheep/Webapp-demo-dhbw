import requests

file1 = open("familynames-usa-top1000.txt", 'r')
sql = open("users.sql", "a")
names = file1.readlines()

user_string = """
({i}, '{name}', '$argon2id$v=19$m=65536,t=4,p=1$ZkRjNVJVaU83M1E1U3EuMg$ANBFNE+qN31RzlANFQGVsFoqS1LHqLJ/iNlQxt9p1YA', '{name}@test.de'),
"""

for i in range(0, 1000):
    sql.write(user_string.format(i = i, name = names[i].strip("\n")))



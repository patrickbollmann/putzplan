import pymysql
from operator import itemgetter
count = 0
user = []
schedule = [0,0,0,0,0,0,0]
wert = [8,7,7,6,5,5,5] #Kosten in folgender Reihenfolge: Wohnzimmer,Küche,Treppenhaus,Bad,Toiletten,Müll,Keller  (durchschnitt 6)
sql = ""

conn = pymysql.connect(host="db.danielki.de",user="user",
                                        passwd="pass",
                                        db="putzplan",
										use_unicode=True,
										charset="utf8")
cur = conn.cursor()
cur.execute("SELECT * FROM `person` WHERE active = 1 ORDER BY score") #wähle aktive Nutzer, sortiere diese aufsteigend nach score

print(cur.description)
print()

for row in cur:
    user.append([row[0],row[2]]) # erstelle liste mit ID und Sore der Nutzer. Sortiert nach score aufsteigend

print(user)

for i in range(len(schedule)):  #verteilt Aufgaben nach Score
    schedule[i] = user[0][0]
    user[0][1] += wert[i]
    user = sorted(user, key=itemgetter(1))

user = sorted(user, key=itemgetter(0))
for i in range(len(user)):  #update neue scores in db
    cur.execute("UPDATE person SET score = "+ str(user[i][1]) + " WHERE personid = " + str(i+1))
conn.commit()

print(sql)
print(user)
print(schedule)


sout = ""
for i in schedule:  ##Konkartiniere string mit putzplan ids
    sout+= str(i) + ", "
sout = sout[:-2]
print(sout)
    #Schreibe putzplan in db
cur.execute("INSERT INTO `schedule` (`scheduleid`, `date`, `wohnzimmer`, `kueche`, `Treppenhaus`, `bad`, `toiletten`, `muell`, `keller`) VALUES (NULL, CURRENT_TIMESTAMP," + sout + ");")
conn.commit()

cur.close()
conn.close()

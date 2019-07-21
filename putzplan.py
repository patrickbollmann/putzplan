import pymysql
from operator import itemgetter
count = 0
user = []
done = []
penalty = []
schedule = [0,0,0,0,0,0,0]
wert = [8,8,6,6,6,5,4] #Kosten in folgender Reihenfolge: Wohnzimmer,Küche,Treppenhaus,Bad,Toiletten,Müll,Keller
sql = ""

def bereichid(x):
    if x == "bad":
        return 0
    if x == "kueche":
        return 1
    if x == "muell":
        return 2
    if x == "toiletten":
        return 3
    if x == "wohnzimmer":
        return 4
    if x == "treppenhaus":
        return 5
    if x == "keller":
        return 6

conn = pymysql.connect(host="db.danielki.de",user="user",
                                        passwd="pass",
                                        db="putzplan",
										use_unicode=True,
										charset="utf8")
cur = conn.cursor()

#penaltys vergeben
cur.execute("SELECT * FROM `done` WHERE scheduleid = (SELECT MAX(scheduleid) FROM done)")
for row in cur:
    print(row)
    if row[1] != 1:
        done.append("bad")
    if row[2] != 1:
        done.append("kueche")
    if row[3] != 1:
        done.append("muell")
    if row[4] != 1:
        done.append("toiletten")
    if row[5] != 1:
        done.append("wohnzimmer")
    if row[6] != 1:
        done.append("treppenhaus")
    if row[7] != 1:
        done.append("keller")
print(done)
cur.execute("SELECT bad,kueche,muell,toiletten,wohnzimmer,treppenhaus,keller FROM `schedule` WHERE scheduleid = (SELECT MAX(scheduleid) FROM schedule)")
for row in cur:
    for i in done:
        penalty.append(row[bereichid(i)])

print(penalty)
for i in penalty:
    cur.execute("UPDATE person SET score = score -10 WHERE personid =" + str(i))

#Plan erstellen
cur.execute("SELECT * FROM `person` WHERE active = 1 ORDER BY score")  #wähle aktive Nutzer, sortiere diese aufsteigend nach score
print(cur.description)
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
for i in schedule:  #Konkartiniere string mit putzplan ids
    sout+= str(i) + ", "
sout = sout[:-2]
print(sout)
    #Schreibe putzplan in db
cur.execute("INSERT INTO `schedule` (`scheduleid`, `date`, `wohnzimmer`, `kueche`, `Treppenhaus`, `bad`, `toiletten`, `muell`, `keller`) VALUES (NULL, CURRENT_TIMESTAMP," + sout + ");")
conn.commit()

cur.execute("SELECT scheduleid FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule)")
for row in cur:
    scheduleid = row[0]
#schreibe neuen eintrag in done
cur.execute("INSERT INTO `done` (`scheduleid`, `bad`, `kueche`, `muell`, `toiletten`, `wohnzimmer`, `treppenhaus`, `keller`) VALUES ('"+ str(scheduleid) +"', '0', '0', '0', '0', '0', '0', '0');")
conn.commit()

cur.close()
conn.close()
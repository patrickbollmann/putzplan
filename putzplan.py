import PPdatabase
import pymysql
from operator import itemgetter

db = PPdatabase.DataBase()

#Strafen vergeben
strafen = db.query("SELECT User, Wert FROM `location` WHERE Done != 1")
print("Strafen gehen an:")

for row in strafen:
    print(row["User"])
    db.query("UPDATE person SET score = score -"+str((row['Wert']+5))+", penalty = penalty+1 WHERE name ='" + row['User']+"'")
   
#Plan erstellen
locationquery = db.query("SELECT Name, Wert FROM `location` ORDER BY Wert DESC")
for row in locationquery:
    location = row["Name"]
    wert = row["Wert"]
    user = db.query("SELECT name FROM `person` WHERE active = 1 ORDER BY score ASC LIMIT 1")  #Wähle user mit geringstem Score
    for x in user:
        username = x["name"]
        db.query("UPDATE person SET score = score + "+str(wert)+" WHERE name ='"+username+"'") #setzte neuen Score für user
        db.query("UPDATE location SET user = '"+username+"', Beschwerde = '', Done = 0 WHERE Name = '"+location+"'") #vergebe Aufgabe, lösche Beschwerde, setze Done auf 0
        print(location+": "+username)
        
#inaktive nutzer bekommen score +10
inactive = db.query("SELECT personid, name FROM `person` WHERE active = 0")  #wähle inaktive nutzer
print("inaktiv sind:")
for row in inactive:
    print(row["name"])
    db.query("UPDATE person SET score = score +10, active =1 WHERE personid =" + str(row["personid"]))

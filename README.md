# Putzplan
Fairer Putzplan mit Datenbank
https://patrickbollmann.de/putzplan/

Die Aufteilung geschieht nach einem Score. Dieser Score erhöht sich mit jedem geputzten Bereich. Verschiedene Bereiche geben unterschiedlich viel Score -> wer am wenigsten geputzt hat muss am meisten machen um den Score auszugleichen.

Score boni der einzelnen Bereiche: 
[8,8,6,6,6,5,5] #Kosten in folgender Reihenfolge: Wohnzimmer,Küche,Treppenhaus,Bad,Toiletten,Müll,Keller

Montag morgens wird putzplan.py einmal ausgeführt und ein neuer Plan wird erstellt.

Wird eine Aufgabe nicht richtig erledigt kann dies reported werden. Sollte die zuständige Person dies nicht bis zum Ende des Plans korrigieren wird der Score um 10 Punkte reduziert.
Wird nicht geputzt wird der Score um 10 Ponkte reduziert

# Putzplan
Fairer Putzplan mit Datenbank

Die Aufteilung geschieht nach einem Score. Dieser Score erhöht sich mit jedem geputzten Bereich. Verschiedene Bereiche geben unterschiedlich viel Score -> wer am wenigsten geputzt hat muss am meisten machen um den Score auszugleichen.

Score boni und die einzelnen Bereiche sind in der Datenbank gesetzt


Montag morgens wird putzplan.py einmal ausgeführt und ein neuer Plan wird erstellt.

Wird eine Aufgabe nicht richtig erledigt kann dies reported werden. Sollte die zuständige Person dies nicht bis zum Ende des Plans korrigieren wird der Score um den ursprünglichen Score -5 Punkte reduziert.
Wird nicht geputzt wird der Score un den ursprünglichen Score -5  reduziert.

<h1>Tickets</h1>
<hr>
<h2>Verktyg</h2>
<ul>
    <li> Github </li>
    <li> Filezilla </li>
    <li> PhPmyAdmin </li>
    <li> Binero </li>
    <li> Trello </li>
</ul>

<h2>Mappstruktur</h2>
<img src="readme_imgs/mappstruktur.PNG">

Github
Master
Test
Develop
feature
Server
Subdomän på binero.
Skicka till binero via filezilla.
Databas i phpMyAdmin. 
Hitta ett sätt att importera databas till phpMyAdmin från antingen:
En annan db i phpmyadmin.
Workbench. 
User stories
Användare
Jag som användare vill kunna:
Events:
Söka efter event. 
Se kommande events.
Se events av typen sport.
Se events av typen Konsert.
Kunna välja att se events av kategorin:
Sport.
Konsert
Etc
Kunna välja att se events av subkategorin:
Fotboll
Ishockey
Etc.
Kunna välja att se events av subkategorin:
Fotboll, Män.
Fotboll, Kvinnor.
Ishockey, Män.
Ishockey, Kvinnor.
Etc.
Kunna välja:
Sektion
Rad
Plats
Flera platser bredvid varandra.
Konto:
Se mina uppgifter.
Ändra mina uppgifter.
Ta bort mitt konto.
Skapa konto. 
Logga in.
Logga ut.
Se mina ordrar.
Se detaljer på mina ordrar.
Se vilka event jag har köpt biljetter till.
Kunna välja att filtrera så jag endast ser event jag har köpt biljetter till som ännu varit. 
Få ett mail med ordernr, pris och annan relevant information. 
Varukorg:
Lägga till biljetter i varukorg.
Se totalpriset av min varukorg.
Kunna gå till kassa. 
Se innehållet av min varukorg. 
Se hur lång tid det är innan min varukorg timear ut. 
Admin
Jag som admin vill kunna:
Konto:
Logga in / logga ut.
Skapa:
Kunder.
Anställda.
Admins.
Events.
Arenor.
Sections.
Rows.
seats.
Se:
Kunder.
Anställda.
Admins.
Events.
Arenor.
Uppdatera:
Kunder.
Anställda.
Admins
Events.
Arenor.


Employee
Jag som employee vill kunna:
Logga in.
Logga ut. 
‘Skanna’ Biljetter för att se om biljetten är köpt.
‘Skanna’ Biljetter för att se om biljetten redan är skannad. 
‘Skanna’ Biljetter och se vem som har köpt den. 
Prioritet
Prio 1
Skapa Arena:
Använd Stored Procedure för att skapa arena, section, rad och platser samtidigt. 
Arena AV SEATS: 100.
SECTION (arena 1) 1: 50;
SECTION (arena 1) 2: 50;
ROW (section1) 1: 25;
ROW (section2) 2: 25;
SEAT (row1) 1: plats1;

Skapa antalet platser (seats) med hjälp av rows, seats, arenas.
Kommer behöva JOINA:
Arena.
Sections
Rows.
Seats.

EXTRA - Skapa visualisering av arenan:
Hämta alla platser från arenan.
Alla platser som finns i tickets är:
Gröna = Ej såld.
Röd = Köpt.
Svart = Säljs ej. 
Skapa event
Kategorier
Skapa tickets.
Skapa antalet biljetter beroende på arena. 
EJ PRIO
Skapa antalet platser beroende på öppna sections, rows etc. 


Admin:
Logga in / logga ut.
Funktionalitet färdig. 
Skapa arena.
Skapa Event.
Skapa biljetter.
Kund:
Köpa biljett.
Logga in / logga ut.
Funktionalitet färdig. 
Skapa konto.
Funktionalitet färdig. 
Employee:
Logga in / logga ut.
Funktionalitet färdig. 
Skapa konto
Funktionalitet färdig. 



Databas
Vilken databas ska vi använda? phpMyAdmin eller workbench?
Vi behöver veta hur man laddar ned DB som ett skript, och kör det i phpmyadmin, om vi kan göra det, kan vi utveckla lokalt och sedan ladda upp. 

UML
ARENA
Arena
id
namn
kapacitet
väg
vägnr
postort
ort
stad
1
Friends
200
karalväg
15
18147
lidingö
stockholm
2
summerburst
300
annan
4
18139
huddinge
stockholm

ArenaSection
Id
arenaId
section
ingång







arenaSectionRowSeat
Id
arenaSectionRowId
seat









handikappPlatser
Id
arenasectionRowSeatId
seat









Event
events
id
namn
typ
kapacitet

Customers
Id
firstname
lastname
emial
phone
username
password

Orders
Id
customerId
orderDate
SUM








seatStatus
Id
eventId
arenaSectionRowId
orderId
sold
scanned



Extra
History 

Id
event
plats
tickets
soldTickets
sumSoldTickets


En kund kan ha flera biljetter, så å ‘mina sidor’, så visar vi en sida för biljetter, och sen en undersida för konotuppgifter som kan redigeras
På seatstatus har vi information om: 
Vilken kund som äger biljetten.
Vilket event det är.
Vad biljetten kosta.
Huruvida biljetten är såld.
Huruvida biljetten är skannad.
Vilken adress.
Vilken ingång, sektion, rad, plats. 
UML


TO-DO
Kontrollera userstories. 
Göra UML. 
Vilka sidor vi kommer behöva.
DoD.
Tidsuppskattning.
Prio.
Trello
Skiss.
Product Breakdown
Sprint planning. 

Sidor
Customer
Startsida
Events sida
Event sida
Konto sida
Admin
Login sida / startsida.
Skapa nytt event
Hantera events
Skapa event.
Ta bort event.


Hantera biljetter
Skapa biljetter
Ta bort biljetter. 
Ändra biljetter.
Se biljetter.
Se kunder(?)
Ta bort kunder (?)
Ändra kunder (?)
Skapa kunder (?)
Controller
Log in sida
Ta en biljett
Se om biljetten är köpt.
Se om biljetten har scannats. 
DoD
Sprint
Producerad kod för funktionalitet.
Miljö på sidan som tillåter användning av funktionalitet. 
User stories träffade.
Går igenom test.
Produktägaren accepterar.
Dokumentation klar.
Upplagt på github Feature branch. 
Projekt
Kod följer önskad kvalité.
Kod testat på i testmiljö. 
Produktägaren accepterar.
Kod testad på live server. 
Merge till master.
Alla branches förutom master borttagna.
Upplagt på tillgänglig server.
DB upplagd på tillgänglig server.
Dokumentation klar. 


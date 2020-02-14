CANVIOS EN LA BBDD RESPECTO (SUPONGO) A SINU
--------------------------------------------
- En elementos añadí una columna que dice que si el elemento se muestra en narrazioni o no, para los videos que cuelgan dentro de atelier.

PROBLEMAS
---------
- Des del principio no hemos sabido qué quieren exactamente en la web, ni donde ni como ni con qué formato van a querer subir las cosas. Entonces practicamente cada vez que han querido subir
nuevo material hemos tenido que adaptar de malas maneras alguna cosa. O subir algo donde no es lógico, o programar algo funcional pero que deberia estar hecho distinto des del principio, etc.


PLAN BASE
---------
Hoy o mañana:
. Han pedido subir unos videos en un galeria de fotos. Se puede programar, pero que nos digan de una puta vez qué van a hacer con la web, donde quieren mostrar qué, porque estamos haciendo 
el gilipollas.
	. Crear los videos como videos normales, pero hacer que se muestren en la zona de Atelier d'Artisti (3h)
		. Con un elemento Play para que se vea que son videos
		. O USAR LO DE LOS GRUPOS QUE HICE PARA LOS VIDEOS
		
. Actualizar codigo en los paneles, donde no sé ni si hay grupos.
		

Domingo:
. Activar en el menú el botón de NEWS i poner la descripción que pasaron.
	. Saber qué van a meter en el futuro en esta pagina, como van a mostrar las notícias, habrá un listado de noticias y se podrá entrar en cada una? Según lo que sabemos ahora por la informacion
	que nos han dado, como siempre pura mierda, es una pagina con un texto, pero seguramente dentro de un tiempo diran Queremos meter otro texto ejje. Como? Qué quieren?
	. Diseñar una pagina de News (nose cris)
	. Maquetar i programar la pagina
. Poner en Atelier d'Artista la información de la residencia de Raffaele Fiorella que se puede encontrar en esto que pasaron de NEWS.
	. Que me la pasen separada y que me cuenten donde la quieren, en atelier d'artista hay un texto, no me da la gana ver yo en qué parte meter la informacion de la residencia.

Viernes que viene:
. Only the stories of Dante appear in the home. Can we make sure that there is a rotation of the stories / videos? (2h)
    . Rotar lo que aparece en la home automaticamente.
. It would be useful to have a search button to search for stories, otherwise it is very difficult to search for them (1dia)
    . Integrar un teclat perquè és per touch
    . Autorrellenar amb videos que hi ha?
    . Disseny, maquetació i programació de pantalla on apareixen els resultats.
. The site on the mobile does not work well, all the images are superimposed. Do you also visualize it like this? can it be improved? (2dias)
    . Revisar opcions
    . Fer canvis profunds de maquetació/funcionament, perquè no té sentit que en movil es vegi aquella cosa dels videos per alla.
. Soon we should also launch the call for artists, is there a way to highlight on the home a different content from the videos? (?)
    . Revisar opcions


- Si algun dia no carga los elementos de la portada, vigilar que no sea que hay acentos en algun titulo o algo así. La lia al hacer el Ajax, concretamente JSON_DECODE i ENCODE...
Ver qué hacer en este caso.. u.u sorry gerard del futuro.

- Ordenar codigo, borrar lo inutil


CORRECCIONS
-----------


PLAN BASE DONE
--------------
. Creacion de la base de datos donde se almacenan los elementos que van apareciendo (1h)
. Preparar simulacro de material (30min)
. Plantilla basica para portada (15min (10min)
. Aplicar diseño a los elementos de las capas (3h)
. Pillar últimos elementos de cada tipo y crear las capas al iniciar la web
    . Creacion base de datos con los elementos por tipo (1h)
    . Funcionamiento creacion de capas al incio (2h)
. Pensar funcionamiento de capas dinamicas ( ? )
. Fer la secció conjunta de Calendario i News/Blog (2h)
. Aplicar el disseny de la part dels panells a la web (3h)
- Limpiar codigo, dejar lo necesario, ordenar (2h)
- Posar els logos de dalt (30min)
- Arreglar logos de la llista de partners (30min)
- Disseny i funcionament del menú -> demanar a paula (1h)
- Pagines internes -> 
	. Team (3h)
	. Calendario -> la dificultat es posar el calendari (4h)
	. Narrazioni, Atelier, Creazioni (3h)
- Ver qual es el logo de la union europea para fondo negro
- Integrar paginas individuales como en los paneles -> (3h)
	. Video
	. Galeria
- Corregir i arreglar cosetes de la secció de Showcase -> hi ha d'haber creazioni a la versió final? (2h)
- Acabar la portada rara ->
	. Programar funcionaminento de capas dinamicas (5h)
	. Funcionaminento titulo siempre encima pero sin molestar mucho (2h)
	. Buscador (2h)
	. Reparticion de elementos equilibrada (2h)
- Poner algo en los elementos de la portada quando se abren para ir al elemento 
- Acabar la portada rara (1dia) ->
	. Aislar elemento clicado y hacer accion correspondiente - iniciar video, audio, ir al elemento (4h)


CORRECCIONS APLICADES
---------------------
- in the presentation text (and a bit everywhere if present), the acronym "ABC" should be removed. When we talk about finance we must always insert the following sentence:
"Live Museum, Live Change è un progetto di PAV, tra i vincitori dell'Avviso Atelier Arte Bellezza Cultura della Regione Lazio"
- below, please put in Italian the writing "in collaboration with" - "in collaborazione con" and again, invert the Sovrintendenza and Museum logos.
- The last sentence "Per lo sviluppo delle attività Live Museum, Live Change PAV si avvale del network costruito con ECCOM-Idee per la Cultura, Melting Pro e Visiva Lab." should have the same size as the whole text
- under the heading "in collaborazione con" the logos of the Sovrintendenza and Museo must be inverted: first Sovrintendenza and then Museo.
- in the description of Visivalab, there is a typo in the company name ("visivalav").

1. HOME: it is possible to block the top of the page where the logos are? the icons/images continue to fluctuate, often overlapping with them.
3. In ATELIER D'ARTISTA, there should only be one box that links back to I MERCATI SENZA TEMPO page. Audio products will feed into the page dedicated to MERCATI SENZA TEMPO.
4. Again in the ATELIER D'ARTISTA page, in the box that refers to the FONDAMENTA page, we remove the names of Francesca Garolla and Mohammed Ali Bas.
5. in the box that refers to the FONDAMENTA page, we remove the names of Francesca Garolla and Mohammed Ali Bas.
6. for now, you can delete the CONTACT page and put in the footer the mail as you suggested
7. for the moment, I would also delete the NEWS page.
2. can you please replace the text of CHI SIAMO? attached the definitive one

ATELIER
- Fondamenta. Frammenti di drammaturgie section is missing.
Here all the document that you need for it
https://www.dropbox.com/sh/6ep9l9z79hqln6l/AABnw1knVoCJqmuxDxYEmiBJa?dl=0
- I mercati senza tempo section is missing. Look here https://www.dropbox.com/s/i8zq2jcuumepz60/I%20mercati%20senza%20tempo.%20Ai%20confini%20del%20suono_DESCRIZIONE%20PROVVISORIA%20e%20BIO.doc?dl= 0
Within this last section, the 5 audio products should be inserted

HOME
- the LMLC logo should be in png. We remove the white around which makes everything not very harmonious
- the LMLC logo should be followed by the words "sguardi e voci da Traiano", as inserted in the central logo of the panels. (This version of the logo was created by Visivalab, we don't have it)

CHI SIAMO
- definitive text attached
- then replace "promosso da" with "intervento realizzato da" + bio PAV
- to follow, insert the wording "in collaboration con" + Comune and Mercati logo
- to follow, insert the wording "in network con" + short descriptions Eccom, Melting, Visivalab

- moving icons cannot touch or overlap, even in small part, at the top logos.
- the logos of the Region and of the European Union must be on the right and not in the center 
and please add below  "PROGETTO CO-FINANZIATO DALL'UNIONE EUROPEA".
- below (footer) where there are everyone's logos, you need to remove the word PARTNER and insert in the order:
1. "intervento realizzato da" + PAV logo
2. "in collaborazione con" + Comune and Mercati logo (https://www.dropbox.com/sh/pjwve9e6t40cgwb/AABM36LP-RKFSPfkRjuDMCi7a?dl=0)
3. "in network con" + loghi Eccom, Melting Pro, Visivalab

NARRAZIONI / ATELIER ETC
- in the various sections, we ask to have the band at the top with the logos in white, so that the LMLC logo does not seem to be attacked and is more homogeneous

NEWS
- I would remove the blog wording that accompanies the NEWS section

CALENDARIO
for the moment we remove it, considering that we do not have scheduled appointments. When we need it, we will ask you to add it

- the writing under the European Union logo must be in Italian
IN THE MENU
according to the guidelines, in the menu we must add "Link CE" linked to the website www.europa.eu

. Text of the "chi siamo"
. Instead of "TEAM" please write "PROMOSSO DA PAV" and to follow the text that describes who Pav is.
Down "IN COLLABORAZIONE CON" and the description of ECCOM, MELTING PRO and VISIVALAB. Texts "team benefciario_fornitori" attached.
CONTATTI
. for now we only have facebook, in the meantime we decide which e-mail we will use. fb - https://www.facebook.com/TraianoLiveMuseum/ @TraianoLiveMuseum
- The texts must be checked carefully, some are in Spanish. For example, the date June 5 of the inauguration is not in Italian.
. Partner logos on the bottom must be replaced (attached). maybe you can create a light band to make them more harmonious.
	we could create a graphic element to distinguish PAV from others (which are officially suppliers). what do you think about it? some ideas?
. For the correct wording in the footer we expect to have precise indications.
- Arreglar estil chi siamo
Logos:
. TOP PAGE: we prefer The project logo with white background. The European one, has to be in Italian (without accent).
. According to the official communication guidelines, we have to create a connection with the official European funds pages on www.europa.eu
- We should put order in the Home, at the center there is a bit of chaos.
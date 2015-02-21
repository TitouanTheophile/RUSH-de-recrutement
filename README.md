 .d8888b.                    d8b          888 888                    888 
d88P  Y88b                   Y8P          888 888                    888 
Y88b.                                     888 888                    888 
 "Y888b.    .d88b.   .d8888b 888  8888b.  888 888  888  .d88b.   .d88888 
    "Y88b. d88""88b d88P"    888     "88b 888 888 .88P d88""88b d88" 888 
      "888 888  888 888      888 .d888888 888 888888K  888  888 888  888 
Y88b  d88P Y88..88P Y88b.    888 888  888 888 888 "88b Y88..88P Y88b 888 
 "Y8888P"   "Y88P"   "Y8888P 888 "Y888888 888 888  888  "Y88P"   "Y88888 

 RUSH de Recrutement KOD 2014

############## COMMENT CREER UNE BRANCHE ##################

- creer une branche local dev sur laquelle travailler 
  git checkout -b dev
C'est un raccourcie de :
         - git branche dev (crée une branche local dev que toi seul peux utiliser)
         - git checkout dev (permet de travailler sur )l branche dev)

- Apres tu fais ton taffe dans ton coin.

- Quand tu ve avancé dans ton code mais que tu n'as pas finis tu add puis committtes changements
 Inutile de push tu ne pourras pas puisque ta branche est local et non remote.

- Quand tu as finis ton taffe sur ta branche et que le code est prête à aller en prod :
    - git checkout master (pour retourner sur lla prod)
    - git merge dev (pour ajouter tes changement à la branche master )
    - git push (pour envoyer tes changements )que je vais ensuite recuperer sur mon pc)

############# FINIT ##############
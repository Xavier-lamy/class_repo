# Installation d'un système d'exploitation sur un raspberry

## Raspbian
raspberry pi imager: pour créer "l'image" operating systme image que l'on mettera sur la carte sd du raspberry pour installer l'os
version lite de l'os: pas de gestionnaire de fenêtre donc plus léger
puis on écrit sur la carte sd

dans boot on créé un fichier ssh:  ``$ touch ssh``
dans rootfs: ``cd etc`` puis ``cd wpa`` : ``nano wpa-supplicant.conf``
dans ssid: identifiant wifi
psk: le mot de passe wifi

ip addr  = (sous windows) ipconfig

sous linux (avec ubuntu) pour les droits administrateur ``sudo su`` puis taper le mot de passe

pour retrouver l'ip du raspberry : on peut ainsi retrouver la passerelle du réseau wifi
``id addr``


dans un système linux:  
bin = applis  
dev cartes réseaux  
etc = configuration  
home = users

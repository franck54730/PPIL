Le cakePhp utilisé est la version 2.5

Pour cloner le projet dans sont serveur apache (wamp ou autre), sachant que j'utilise GitBash :
   - il faut se placer dans le dossier www de votre serveur.
   - il faut crée le dossier ou vous allez mettre le projet (moi je l'ai appelé "ppil")
   - il faut se placer dedans
   - il faut le cloner ici avec la commande : "git clone https://github.com/franck54730/PPIL ."
	le point est important c'est pour dire de cloner dans le dossier courant.
   si vous avez fait ceci normalement vous devriez avoir cette arborescence :
www/
   ppil/
      .git/
      app/
      lib/
      nbproject/
      ect ect

Tout ce qui est relatif a la configuration n'a pas a être versionner seul le code et le framework doivent l'être donc
pensez à les ajouter au .gitignore

Aussi le fichier database.php doit etre versionner car on en a besoin mais chaqu'un doit avoir le sien du coup on
va l'ignorer aussi mais differement car ca ne marche pas avec .gitignore si le fichier est versionner
<?php
/**
* namespace Espace de nom correspondant généralement au dossier contenant le controlleur
*
**/
namespace BlogBundle\Controller;

/**
*	Utilisation de la classe Controller parente pour définir notre controlleur
*
**/
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; // Classe permettant de retourner une réponse HTTP simplement.
use Symfony\Component\HttpFoundation\Request; // Classe permettant de retourner toutes les information http ($_GET, $_POST, $_SESSION)
class BlogController extends Controller{
	public function indexAction(){
		 return $this->render(
			"BlogBundle:Hello:index.html.twig",
			array(
				"pageTitle" => "J'aime Symfony",
				"innerTitle" => "Symfony exposé par le contrôleur"
			)
		 );//"Bonjour Symfony !!!");
	}
	
	/**
	* Permet de récupérer un paramètre qui vient d'une URL de type /blog/post/{id}
	* @param int $id
	* @return \Symfony\Component\HttpFoundation\Response
	*/
	public function voirAction($id, Request $httpRequest){
	
		//Maintenant on peut acceder au paramètres de requete HTTP
		// (Tout ce qui se situe après ? dans la requette HTTP)
		// Par l'intermediaire de l'objet Request $httpRequest sur une url de type :
		// blog.dev/app_dev.php/blog/post/36?action=delete
		$action = $httpRequest->query->get("action","voir");
		
		//La méthode $this->generateurl() permet de convertir
		//le nom d'une route en une URL :
		// $this->generateurUrl("blog_ajouter") => http://blog.dev/app_dev.php/blog/ajouter
		$url = "";
		
		if($action == "ajouter"){
			$url = $this->generateUrl("blog_hello");
			return $this->redirect($url);
			
		}
	
		//Charger le post correspondant à l'id passé en paramètre
		return $this->render(
			"BlogBundle:Hello:article.html.twig",
			array(
				"pageTitle" => "J'aime Symfony",
				"innerTitle" => "Symfony exposé par le contrôleur",
				"id" => $id,
				"action" => $action,
				"url" => $url
			)
		 );
	}
	public function ajouterAction(){
		$idCree = 5; // Pour l'instant on va créer une valeur "artificielle"
		//Dans la classe controleur, on récupère un objet session
		// et de cet objet session, on utilise le service getFlashBag();
		// set flash messages
		//$session->getFlashBag()->add('notice', 'Profile updated');
		$flashMessage = $this->get("session")->getFlashBag();
		$flashMessage->add("info","Je suis un message Flash, service de Symfony.");
		$flashMessage->add("Info","Je suis capable d'afficher la valeur " . $idCree);
			
		return $this->render(
			"BlogBundle:Hello:ajouter.html.twig",
			array(
				"date" => date("d-m-Y H:i:s")
			)
		);
	}	
	private function toHtml($id){
		return "
		<!doctype html>
		<html>
			<head>
				<title>Symfony is beautifull</title>
			</head>
			
			<body>
				<h1>Bonjour Symfony</h1>
				<h2>Tu as demandé de traiter : " . $id . "<br /></h2>
			</body>
		</html>
		";
	}	
}
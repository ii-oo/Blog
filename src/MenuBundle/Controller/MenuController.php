<?php

namespace MenuBundle\Controller;

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller{
	private function menu(){
		return  array(// Tableau principal "menu"
				array(
						"libelle" => "Accueil",
						"route" => "blog_homepage",
						"titre" => "Retour à l'accueil de myBlog"
				),
				array(
						"libelle" => "Articles",
						"route" => "",
						"titre" => "Blog",
						"enfants" => array(
								array(
										"libelle" => "Tous les articles",
										"route" => "blog_hello",
										"titre" => "Voir tous les articles"
								),
								array(
										"libelle" => "Les 5 derniers articles",
										"route" => "blog_ajouter",
										"titre" => "Voir les 5 derniers articles"
								),
								array(
										"libelle" => "Voir l'article",
										"route" => "blog_voir",
										"titre" => "Voir unarticle en particulier",
										"identifiant" => 26				),
					 )
				),
				
				array(
						"libelle" => "Contact",
						"route" => "blog_contact",
						"titre" => "Ecrire au contact"
				),
		);
	}
	public function indexAction(){
       	return $this->render(
    			"MenuBundle:Default:menu.html.twig",
    			array(
    				"menu" => $this->menu()
    			)
    		);
    }
}

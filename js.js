function verif()
{
	var Dt=document.contact.mail.value;
	var epsi=Dt.split('@');
	if ( document.contact.nom.value=="")
	{
		alert("Erreur : vous n'avez pas saisi votre nom");
		document.contact.nom.focus();
		return false;
	}
	else if ( document.contact.mail.value=="")
	{
		alert("Erreur : vous n'avez pas saisi votre adresse e-mail");
		document.contact.mail.focus();
		return false;
	}
	else if ( epsi[1]!="epsi.fr")
	{
		alert("Erreur : vous n'avez pas saisi votre adresse e-mail de l'epsi");
		document.contact.mail.focus();
		return false;
	}
	else if ( document.contact.prenom.value=="")
	{
		alert("Erreur : vous n'avez pas saisi votre prénom");
		document.contact.prenom.focus();
		return false;
	}			
	else if ( document.contact.mdp.value=="")
	{
		alert("Erreur : vous n'avez pas saisi de mot de passe");
		document.contact.mdp.focus();
		return false;
	}
	else if ( document.contact.promo.value=="" || (document.contact.promo.value!="2016" && document.contact.promo.value!="2015" && document.contact.promo.value!="2014" && document.contact.promo.value!="2013" && document.contact.promo.value!="2012"))
	{
		alert("Erreur : Seulement promos 2012, 2013, 2014, 2015 et 2016 sont acceptées");
		document.contact.promo.focus();
		return false;
	}
	else
	{
		return true;
	}
}

function valid()
{
	if (confirm("Voulez-vous supprimer votre compte ?"))
	return true;
	else
	return false;
}

function valid2()
{
	if (confirm("Voulez-vous supprimer les commandes ?"))
	return true;
	else
	return false;
}

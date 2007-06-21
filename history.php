<?php
////////////////////////////////////////////////////////////////////////////////
// ***** BEGIN LICENSE BLOCK *****
// This file is part of ChuWiki.
// Copyright (c) 2004 Vincent Robert and contributors. All rights
// reserved.
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA//
//
// ***** END LICENSE BLOCK *****
////////////////////////////////////////////////////////////////////////////////

require(dirname(__FILE__) . '/sdk/sdk.php');
/////////////////////////////////////////////////////////////

// Chargement des informations de la page
$strPage = ChuWiki::GetCurrentPage();
$strDate = ChuWiki::GetPostedValue('Date');

if ( isset($_POST['Preview']) )
{
	// Chargement du contenu wiki sauvegardé pour cette page
	$strWikiContent = ChuWiki::GetSavedWikiContent($strPage, $strDate);
}
else if ( isset($_POST['Save']) && $strDate !=  '' )
{
	// En mode restauration
	$strWikiContent = ChuWiki::GetSavedWikiContent($strPage, $strDate);

	// Enregistremet de la page
	ChuWiki::Save($strPage, $strWikiContent);

	// Redirection vers l'affichage de la page
	header('Location: ' . ChuWiki::GetScriptURI('Wiki')  . ChuWiki::FileNameEncode($strPage));
	exit();
}
else
{
	// Chargement du contenu wiki pour cette page
	$strWikiContent = ChuWiki::GetWikiContent($strPage);
}

// On ajoute du contenu supplémentaire pour certaines pages comme la liste ou les changements
$strModifiedWikiContent = $strWikiContent . ChuWiki::GetSpecialContent($strPage);

// Rendu wiki
$strHtmlContent = ChuWiki::Render($strModifiedWikiContent);

// Récupération de la liste des sauvegardes pour ce fichier
$aHistory = ChuWiki::GetHistory($strPage);

// Contruction de la liste des historiques avec sélection de la date choisie
$datePost = ChuWiki::GetPostedValue('Date');
if ( $datePost == '')
{
	$datePost = reset($aHistory);
}

$strHistory = '';
if ( sizeof($aHistory) == 0 )
{
	$strHistory .= '<option value=""></option>' . "\n";
}
else
{
	foreach($aHistory as $date)
	{
		$strHistory .= '<option value="' . $date . '"';
		if ( $date == $datePost )
		{
			$strHistory .= ' selected="selected"';
		}
		$strHistory .= '>' . ChuWiki::FormatDate($date) . '</option>' . "\n";
	}
}
/////////////////////////////////////////////////////////////

// Chargement du template
$strContent = ChuWiki::LoadTemplate('history');

// Les premiers remplacements sont en fonction du fichier de config
$astrReplacements = ChuWiki::BuildStandardReplacements();

// Ajoute les remplacements « runtime »
ChuWiki::AddReplacement($astrReplacements, 'Page.Name', htmlspecialchars($strPage));
ChuWiki::AddReplacement($astrReplacements, 'Page.Wiki', $strWikiContent);
ChuWiki::AddReplacement($astrReplacements, 'Page.Html', $strHtmlContent);
ChuWiki::AddReplacement($astrReplacements, 'Page.History', $strHistory);

// Applique les remplacements
$strContent = ChuWiki::ReplaceAll($strContent, $astrReplacements);

/////////////////////////////////////////////////////////////
ChuWiki::WriteXhtmlHeader();
echo $strContent;
?>

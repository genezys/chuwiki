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
// ***** END LICENSE BLOCK *****
////////////////////////////////////////////////////////////////////////////////

require(dirname(__FILE__) . '/sdk/sdk.php');
/////////////////////////////////////////////////////////////

$wiki = new Chuwiki();

// Chargement des informations de la page
$strPage = $wiki->GetCurrentPage();

// Chargement du contenu wiki pour cette page
$strWikiContent = $wiki->GetWikiContent($strPage);

// Ajout des contenus spéciaux de certaines pages
$strModifiedWikiContent = $wiki->AddSpecialWikiContent($strPage, $strWikiContent);

// Rendu wiki
$strHtmlContent = $wiki->Render($strModifiedWikiContent);

/////////////////////////////////////////////////////////////

// Chargement du template
$strContent = $wiki->LoadTemplate('wiki');

// Les premiers remplacements sont en fonction du fichier de config
$astrReplacements = $wiki->BuildStandardReplacements();

// Ajoute les remplacements « runtime »
$wiki->AddReplacement($astrReplacements, 'Page.Name', htmlspecialchars($strPage));
$wiki->AddReplacement($astrReplacements, 'Page.Wiki', $strWikiContent);
$wiki->AddReplacement($astrReplacements, 'Page.Html', $strHtmlContent);

// Applique les remplacements
$strContent = $wiki->ReplaceAll($strContent, $astrReplacements);

/////////////////////////////////////////////////////////////
$wiki->WriteXhtmlHeader();
echo $strContent;
?>
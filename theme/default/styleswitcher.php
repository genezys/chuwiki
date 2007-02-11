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

function printStylesheet($strName)
{
?>
<style type="text/css" media="screen, print" title="<?php echo $strName ?>">
@import url('&Config.URI;&Config.ThemePath;/<?php echo $strName ?>.css');
</style>
<?php
}

function printAlternateStylesheet($strName)
{
?>
<link rel="alternate stylesheet" type="text/css" media="screen, print" title="<?php echo $strName ?>" href="&Config.URI;&Config.ThemePath;/<?php echo $strName ?>.css"/>
<?php
}
/////////////////////////////////////////////////////////////////////////

// Récupération du cookie de style
$strStyle = '';
if(isset($_COOKIE['Style']))
{
	$strStyle = $_COOKIE['Style'];
}

if($strStyle == '') // Aucun style choisi
{
	printStylesheet('ChuWiki');
	printAlternateStylesheet('DarkBlue');
	printAlternateStylesheet('Icy');
}
else // L'utilisateur a choisi un style
{
	printStylesheet($strStyle);
	printAlternateStylesheet('ChuWiki');
	printAlternateStylesheet('DarkBlue');
	printAlternateStylesheet('Icy');
}
/////////////////////////////////////////////////////////////////////////
?>
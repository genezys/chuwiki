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

define('CookieName', 'Style');

// Style à appliquer
//$strStyle = substr($_SERVER['PATH_INFO'], 1);
$strStyle = urldecode($_SERVER['QUERY_STRING']);


setcookie(CookieName, $strStyle, time() + 3600 * 24 * 365, 
	dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));

$strReferer = $_SERVER['HTTP_REFERER'];

// Gestion de magic_quotes
if ( get_magic_quotes_gpc() )
{
	$strReferer = stripslashes($strReferer);
}
header('Location: ' . $strReferer);
?>
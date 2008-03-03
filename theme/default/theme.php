<?php

function WriteLine($str)
{
	echo $str;
	echo "\n";
}

function BeginDocument($strMode)
{
	WriteLine('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
	WriteLine('<html xmlns="http://www.w3.org/1999/xhtml" lang="&Lang.Code;" xml:lang="&Lang.Code;">');
	WriteLine('<head>');
	WriteLine('<title>&Config.Title;&Lang.WikiTitle; &Page.Name;</title>');
	if( $strMode !== 'wiki' ) 
	{ 
		WriteLine('<meta name="robots" content="noindex,nofollow"/>');
	}
	WriteLine('<meta name="Generator" content="&Config.Version;"/>');
	WriteLine('<link rel="stylesheet" type="text/css" title="ChuWiki" href="&Config.URI;&Config.ThemePath;/ChuWiki.css"/>');
	WriteLine('<link rel="alternate" type="application/rss+xml" href="&Config.URI;latest-change.php" />');
	WriteLine('</head>');
	WriteLine('');
	WriteLine('<body>');
	WriteLine('<p id="Logo"><a href="&Config.WikiURI;&Lang.DefaultPage;">&Config.Title;</a></p>');
	if( $strMode == 'wiki' )
	{
		WriteLine('<h1>&Page.Name;</h1>');
	}
	else if( $strMode == 'edit' )
	{
		WriteLine('<h1>&Lang.EditTitle; &Page.Name;</h1>');
	}
	else if( $strMode == 'history' )
	{
		WriteLine('<h1>&Lang.HistoryTitle; &Page.Name;</h1>');
	}
}

function WriteMenu()
{
	WriteLine('<div id="Menu">');
	WriteLine('<h2><a href="&Config.WikiURI;&Lang.MenuPage;">&Lang.MenuPage;</a></h2>');
	WriteLine('<ul>');
	WriteLine('<li><a href="&Config.WikiURI;&Lang.DefaultPage;">&Lang.DefaultPage;</a></li>');
	WriteLine('<li><a href="&Config.WikiURI;&Lang.ChangesPage;">&Lang.ChangesPage;</a></li>');
	WriteLine('<li><a href="&Config.WikiURI;&Lang.ListPage;">&Lang.ListPage;</a></li>');
	WriteLine('</ul>');
	echo ChuWiki::RenderPage(ChuWiki::GetLangVar('MenuPage'));
	
	WriteLine('</div>');
}

function EndDocument($strMode)
{
	WriteLine('<hr id="UtilsSeparator"/>');
	WriteLine('<ul id="Utils">');

	$strBackLine = '<li><a href="&Config.WikiURI;&Page.Name;">&Lang.Back;</a></li>';

	if( $strMode == 'edit' )
	{
		WriteLine($strBackLine);
	}
	else
	{
		WriteLine('	<li><a href="&Config.EditURI;&Page.Name;#Wiki">&Lang.Edit;</a></li>');
	}

	if( $strMode == 'history' )
	{
		WriteLine($strBackLine);
	}
	else
	{
		WriteLine('	<li><a href="&Config.HistoryURI;&Page.Name;">&Lang.History;</a></li>');
	}

	WriteLine('	<li><form id="Search" action="&Config.WikiURI;&Lang.SearchPage;" method="post"><p><input type="text" name="Search"/><input type="submit" class="Button" value="&Lang.SearchPage;"/></p></form></li>');

	WriteLine('</ul>');
	WriteLine('');
	WriteLine('</body>');
	WriteLine('</html>');
}

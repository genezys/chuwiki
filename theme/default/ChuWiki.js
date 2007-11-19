(function(){

window.onload = function()
{
	var editor = document.getElementById("Wiki");
	if( editor )
	{
		function ResizeEditor()
		{
			editor.style.height = editor.scrollHeight + "px";
		}
		editor.onkeyup = ResizeEditor;
		editor.onkeydown = ResizeEditor;
		editor.onmousemove = ResizeEditor;
		ResizeEditor();
	}
}

})()
var WebTool = {
	webPageLocation:function(url)
	{
		location.replace(url);
	},
	webPageOpen:function(url)
	{
		window.open(url);
	},
    webPageOpenByPost:function(url, postFileds)
	{
        var postFormStr = "<form method='POST' action='" + url + "'>\n";
        for (var key in postFileds)
        {
            if (postFileds.hasOwnProperty(key))
            {
                postFormStr += "<input type='hidden' name='" + key + "' value='" + postFileds[key] + "'></input>";
            }
        }
        postFormStr += "</form>";
        var formElement = $(postFormStr);
        $('body').append(formElement);
        $(formElement).submit();
	},
};

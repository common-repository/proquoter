(function(){
 
    tinymce.create('tinymce.plugins.proquoter', {
 
        init : function(ed, url){
			var t = this;
            t.url = url;
			
			ed.addCommand('proquoterLeftCmd', function(){
				t._quote(ed,t,"left");
            });
            ed.addButton('proquoterLeft', {
                title: 'Create pull-quote image to the left',
                image: url + '/pqbuttonleft.gif',
                cmd: 'proquoterLeftCmd'
            });			
			ed.addCommand('proquoterRightCmd', function(){
				t._quote(ed,t,"right");
            });
            ed.addButton('proquoterRight', {
                title: 'Create pull-quote image to the right',
                image: url + '/pqbuttonright.gif',
                cmd: 'proquoterRightCmd'
            });			
        },
        createControl : function(n, cm){
            return null;
        },
        getInfo : function(){
            return {
                longname: 'Pro Quoter',
                author: '@ProWritingAid',
                authorurl: 'http://quotes.prowritingaid.com/',
                infourl: 'http://quotes.prowritingaid.com/',
                version: "1.0"
            };
        },
		_quote : function(ed, t, direction){
			// get the selected text from the editor if there is any				
			var content = encodeURIComponent(ed.selection.getContent());
			var dialogUrl = t.url+"/pq_dialog.php?leftorright="+direction+"&quote="+content;
			ed.windowManager.open({
				url : dialogUrl,
				title : "Quote Image Selector",
				width : 750,  
				height : 500,
				inline : "true"
			}, {
			});				
		}
    });
	
    tinymce.PluginManager.add('proquoter', tinymce.plugins.proquoter);
})();
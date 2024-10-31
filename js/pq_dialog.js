tinyMCEPopup.requireLangPack();

	var PQDialog = {
		init : function() {
			var ed = tinyMCEPopup.editor, el = document.getElementById('iframecontainer'), ifr, doc, css, cssHTML = '';
		},

		insert : function(imageName,imageText,author,leftorright) {
			// we need to make sure that we save the image			            
			//var saveUrl = ajaxurl+"action=PQ_save&id="+imageName+"&quoteText="+encodeURIComponent(imageText)+"&quoteauthor="+encodeURIComponent(author);
			var saveUrl = "http://quotes.prowritingaid.com/en/Quotes/SaveUserQuote?id="+imageName+"&quoteText="+encodeURIComponent(imageText)+"&quoteauthor="+encodeURIComponent(author);
			
			tinymce.util.XHR.send({
				url : saveUrl,
				success : function(text) {									
				},
				error : function( type, req, o ){					
				}
			});
			setTimeout(function() {
				tinyMCEPopup.editor.selection.setContent("<img class='align"+leftorright+"' src='http://quotes.prowritingaid.com/UserQuotes/"+imageName+"' alt='"+imageText+"' width='300' height='200' />");
				tinyMCEPopup.close();
			}, 2000);
		},
		
		// reload the window to generate some new quote images
		reload : function(page) {
			 
		}
	};

	tinyMCEPopup.onInit.add(PQDialog.init, PQDialog);
		
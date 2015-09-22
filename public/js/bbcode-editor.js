$(document).ready(function(){
	function handleBBcodeTagEvent(ref_id, get){
		var title;
		var description;
		var img;
		var shortcut;
		var ret;

		$.ajax({
			type: "GET",
			url: "../public/editor/bbcode.xml",
			dataType: "xml",
			success: function(xml){
				$(xml).find('Tag').each(function(idx){
					var id = $(this).attr('id');

					if(id === ref_id){
						title = $(this).attr('title');
						description = $(this).find('Description').text();
						img = $(this).find('Img').text();
						shortcut = $(this).find('Shortcut').text();

						var data = {
							title: title,
							description: description,
							img: img,
							shortcut: shortcut
						}

						if(get == 'description'){
							ret = description;
						}
					}
				});
			}
		});

		return ret;
	}

	$(".bbcode-bar-group img").mouseover(function(){
		var id = $(this).attr('id');

		var tag = handleBBcodeTagEvent(id, 'description');

		if(typeof tag !== 'undefined'){
			$('#bbcode-desc').html(tag);
		}
	}).mouseout(function(){
		$('#bbcode-desc').html("");
	});

	$('.bbcode-bar-group img').click(function(){
		var type = $(this).attr('id');
		/*var tag = handleBBcodeTagEvent();*/
		ShowSelection(type, 'tag');
	});

	$('.bbcode-bar-smiley img').click(function(){
		var type = $(this).attr('id');
		/*var tag = handleBBcodeTagEvent();*/
		ShowSelection(type, 'smiley');
	});
});

function ShowSelection(bbcode, type){
	var textComponent = document.getElementById('bbcode-editor');
	var selectedText;

	var insert = bbcode;

	if(type == 'tag'){
		var beginTag = '[' + insert + ']';
		var endTag = '[/' + insert + ']';
	}

	// IE version
	if(document.selection != undefined){
		textComponent.focus();
		var sel = document.selection.createRange();
		selectedText = sel.text;
	}else if (textComponent.selectionStart != undefined){
		var startPos = textComponent.selectionStart;
		var endPos = textComponent.selectionEnd;

		var preText = (textComponent.value).substring(0, startPos);
		var postText = (textComponent.value).substring(endPos, textComponent.value.length);

		if((endPos - startPos) > 0){
			selectedText = textComponent.value.substring(startPos, endPos)

			textComponent.length = preText.length + beginTag.length + selectedText.length + endTag.length + postText.length;

			textComponent.value = preText + beginTag + selectedText + endTag + postText;

			selectedText = textComponent.value.substring(startPos, endPos);
		}else if(startPos >= 0){
			if(type == 'tag'){
				textComponent.value = preText + beginTag + endTag + postText;
			}else if(type == 'smiley'){
				textComponent.value = preText + ' ' + bbcode + ' ' + postText;
			}
		}
	}
}
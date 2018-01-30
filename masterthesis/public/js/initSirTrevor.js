$(document).ready(function () {
	var editor = new SirTrevor.Editor({
		el: document.querySelector('.sir-trevor'),
		defaultType: 'Text',
		blockTypes: ['Text', 'Image', 'Video'],
	});
	SirTrevor.setDefaults({
		uploadUrl: '/api/fileupload/create',
	});
});


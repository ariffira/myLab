var keystone = require('keystone');

exports = module.exports = function (req, res) {

	var view = new keystone.View(req, res);
	var locals = res.locals;

	// locals.section is used to set the currently selected
	// item in the header navigation.
	locals.section = 'Generate New idea';
	locals.formData = req.body || {};

	view.on('post', { action: 'idea.generate' }, function () {
		console.log('Generating new ideas.....');
		console.log(locals.formData.title);
		console.log(locals.formData.description);
		console.log(locals.formData.moreContent);
	});


	// Render the view
	// add session layout view for signin ignore default layout
	view.render('idea', { layout: 'myUI' });
};

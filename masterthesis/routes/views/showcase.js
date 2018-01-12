var keystone = require('keystone');

exports = module.exports = function (req, res) {

	var view = new keystone.View(req, res);
	var locals = res.locals;

	// locals.section is used to set the currently selected
	// item in the header navigation.
	locals.section = 'Create showcase';

	// Render the view
	// add session layout view for signin ignore default layout
	view.render('showcase', { layout: 'myUI' });
};

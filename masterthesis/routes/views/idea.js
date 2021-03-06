// @file idea.js
// @path /routes/views/idea.js
// @description New idea generate for the project by students
// @author: MD Ariful Islam

var keystone = require('keystone');
var Idea = keystone.list('Idea');

exports = module.exports = function (req, res) {

	var view = new keystone.View(req, res);
	var locals = res.locals;

	// locals.section is used to set the currently selected
	// item in the header navigation.
	locals.section = 'Generate New idea';
	locals.formData = req.body || {};
	locals.validationErrors = {};

	view.on('post', { action: 'idea.generate' }, function (next) {
		// console.log(locals.formData.file_upload);
		// creating a new object for project data
		var newIdea = new Idea.model({
			title: locals.formData.title,
			description: locals.formData.description,
			createdBy: locals.user._id, // add user data
			file_upload: locals.formData.file_upload,
		});
		// console.log(newIdea);
		console.log('Generating new Ideas.....');
		// saving ideas in database
		newIdea.save(function (err, result) {
			if (err) {
				locals.data.validationErrors = err.errors;
				console.log(err);
			} else {
				req.flash('success', 'Your Idea saved successfully...');
				console.log(result);
				return res.redirect('/idea');
			}
			next();
		});

	});


	// Render the view
	// add session layout view for signin ignore default layout
	view.render('idea', { layout: 'myUI' });
};

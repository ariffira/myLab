// @file pblGenerate.js
// @path /routes/views/pblGenerate.js
// @description Project generate by creating a driving question
// @author: MD Ariful Islam

var keystone = require('keystone');
var Project = keystone.list('Project');

exports = module.exports = function (req, res) {

	var view = new keystone.View(req, res);
	var locals = res.locals;

	// locals.section is used to set the currently selected
	locals.section = 'Generate Project';
	locals.formData = req.body || {};
	locals.validationErrors = {};

	view.on('post', { action: 'pbl.generate' }, function (next) {
		// console.log(req.user.email);
		var newProject = new Project.model({
			title: locals.formData.title,
			description: locals.formData.description,
			createdBy: locals.user, // add user data
			file_upload: locals.formData.file_upload,
		});
		console.log('Generating new PBL project.....');
		newProject.save(function (err, result) {
			if (err) {
				locals.data.validationErrors = err.errors;
				console.log(err);
			} else {
				req.flash('success', 'A new Project generated...');
				console.log(result);
				return res.redirect('/pblGenerate');
			}
			next();
		});
	});

	// Render the view
	// add session layout view for signin ignore default layout
	view.render('pblGenerate', { layout: 'myUI' });
};

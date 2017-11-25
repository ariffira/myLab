// @file teachersignin.js
// @path /routes/views/session/teachersignin.js
// @description login for teacher

var keystone = require('keystone');

exports = module.exports = function (req, res) {

	var view = new keystone.View(req, res);
	var locals = res.locals;

	// Set locals
	locals.section = 'teachersignin';
	locals.filters = {
	};
	locals.data = {
	};

	// Render the view
	// add session layout view for signin ignore default layout
	view.render('teachersignin', { layout: 'session' });
};

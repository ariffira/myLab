/* eslint-disable no-trailing-spaces */
// @file teachersignin.js
// @path /routes/views/session/teachersignin.js
// @description login for teacher

var keystone = require('keystone');

exports = module.exports = function (req, res) {

	var view = new keystone.View(req, res);
	// var locals = res.locals;

	var UserList = keystone.list(keystone.get('user model'));
	var locals = {
		csrf: { header: {} },
		logo: keystone.get('signin logo'),
		user: req.user ? {
			id: req.user.id,
			name: UserList.getDocumentName(req.user) || '(no name)',
		} : undefined,
		userCanAccessTeacher: !!(req.user && req.user.userCanAccessTeacher),
	};
	locals.csrf.header[keystone.security.csrf.CSRF_HEADER_KEY] = keystone.security.csrf.getToken(req, res);
	// Set locals
	locals.section = 'teachersignin';
	locals.filters = {
	};
	locals.data = {
	};
	console.log(locals.user);
	view.on('post', { action: 'user.login' }, function (next) {
		console.log('Successful login');
		console.log(locals);
		next();
	});
	
	// Render the view
	// add session layout view for signin ignore default layout
	view.render('teachersignin', { layout: 'session' });
};

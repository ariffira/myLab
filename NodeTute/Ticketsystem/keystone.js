// Simulate config options from your production environment by
// customising the .env file in your project's root folder.
require('dotenv').config();

// Require keystone
var keystone = require('keystone');
var handlebars = require('express-handlebars');

keystone.init({
	'name': 'TicketSystem',
	'brand': 'TicketSystem',

	'less': 'public',
	'static': 'public',
	'favicon': 'public/pbl_logo.png',
	'views': 'templates/views',
	'view engine': '.hbs',

	'custom engine': handlebars.create({
		layoutsDir: 'templates/views/layouts',
		partialsDir: 'templates/views/partials',
		defaultLayout: 'default',
		helpers: new require('./templates/views/helpers')(),
		extname: '.hbs',
	}).engine,

	'auto update': true,
	'session': true,
	'auth': true,
	'user model': 'User',
});
keystone.import('models');
keystone.set('locals', {
	_: require('lodash'),
	env: keystone.get('env'),
	utils: keystone.utils,
	editable: keystone.content.editable,
});
keystone.set('routes', require('./routes'));
// set sign-in logo out of module
keystone.set('signin logo', '/images/logo-email.gif');

keystone.set('nav', {
	posts: ['posts', 'post-categories'],
	galleries: 'galleries',
	enquiries: 'enquiries',
	users: 'users',
	manageTickets: 'tickets',
});


keystone.start();

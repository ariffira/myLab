var _ = require('lodash');


/**
	Initialises the standard view locals
*/
exports.initLocals = function (req, res, next) {
	res.locals.navLinks = [
		{ label: 'Home', key: 'home', href: '/' },
		{ label: 'Ideas', key: 'blog', href: '/blog' },
		{ label: 'Gallery', key: 'gallery', href: '/gallery' },
		{ label: 'Contact', key: 'contact', href: '/contact' },
		{ label: 'Showcase', key: 'showcase', href: '/showcase' },
		{ label: 'Registration', key: 'registration', href: '/registration' },
		{ label: 'Sirtrevor Test', key: 'sirtrevor', href: '/sirtrevor' },
		{ label: 'Sign-in as Teacher', key: 'teachersignin', href: '/teachersignin' },
	];
	res.locals.user = req.user;
	next();
};


/**
	Fetches and clears the flashMessages before a view is rendered
*/
exports.flashMessages = function (req, res, next) {
	var flashMessages = {
		info: req.flash('info'),
		success: req.flash('success'),
		warning: req.flash('warning'),
		error: req.flash('error'),
	};
	res.locals.messages = _.some(flashMessages, function (msgs) { return msgs.length; }) ? flashMessages : false;
	next();
};


/**
	Prevents people from accessing protected pages when they're not signed in
 */
exports.requireUser = function (req, res, next) {
	if (!req.user) {
		req.flash('error', 'Please sign in to access this page.');
		res.redirect('/keystone/signin');
	} else {
		next();
	}
};

/**
    Access control for Teacher and student
 */
exports.requirePblUser = function (req, res, next) {
	if (!req.user) {
		res.redirect('/teachersignin');
	} else {
		next();
	}
};

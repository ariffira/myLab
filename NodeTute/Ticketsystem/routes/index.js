var keystone = require('keystone');
var middleware = require('./middleware');
var importRoutes = keystone.importer(__dirname);

// Common Middleware
keystone.pre('routes', middleware.initLocals);
keystone.pre('render', middleware.flashMessages);

// Import Route Controllers
var routes = {
	views: importRoutes('./views'),
};

// Setup Route Bindings
exports = module.exports = function (app) {
	// Views
	app.get('/', routes.views.index);
	app.get('/blog/:category?', routes.views.blog);
	app.get('/blog/post/:post', routes.views.post);
	app.get('/gallery', routes.views.gallery);
	app.all('/contact', routes.views.contact);
	app.get('/tickets/:ticketslug', function(req, res){
		res.send('A ticket which has a slug:', req.param.ticketslug);
	});
	app.all('/registration', routes.views.registration);
	app.get('/sirtrevor', routes.views.sirtrevor);
	app.get('/showcase', routes.views.showcase);
	
};

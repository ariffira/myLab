var keystone = require('keystone');
var Registration = keystone.list('Registration');

exports = module.exports = function (req, res) {

	var view = new keystone.View(req, res);
	var locals = res.locals;

	// Set locals
	locals.section = 'registration';
	locals.formData = req.body || {};
	locals.validationErrors = {};
	locals.registrationSubmitted = false;

	// On POST requests, add the registration item to the database
	view.on('post', { action: 'registration.create' }, function(next) {
        var newRegistration = new Registration.model({
            name: {
                first: locals.formData.first,
                last: locals.formData.last
            }
        });

        var updater = newRegistration.getUpdateHandler(req);

        updater.process(req.body, {
            fields: 'email, password, phone, institution',
            flashErrors: true,
            logErrors: true
        }, function(err,result) {
            if (err) {      
                data.validationErrors = err.errors; 
            } else {
                req.flash('success', 'Account created. Please sign in.');               
                return res.redirect('/');
            }
            next();
        });

    });


	view.render('registration');
};

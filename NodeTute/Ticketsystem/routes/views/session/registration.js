// @file registration.js
// @path /routes/views/session/registration.js
// @description Handles the post request when the user tries to registration up.

var keystone = require('keystone');
var User = keystone.list('User');

exports = module.exports = function (req, res) {

	var view = new keystone.View(req, res);
	var locals = res.locals;

	// Set locals
	locals.section = 'registration';
	locals.formData = req.body || {};
	locals.validationErrors = {};
	locals.registrationSubmitted = false;

	view.on('post', { action: 'user.create' }, function (next) {

		if (locals.formData.password !== locals.formData.password_confirm) {
			req.flash('error', 'The passwords do not match.');
			next();
		}

		var newUser = new User.model({
			name: {
				first: locals.formData.first,
				last: locals.formData.last,
			},
			email: locals.formData.email,
			password: locals.formData.password,
			//password_confirm: locals.formData.password_confirm,
		});
		console.log(newUser); //here newuser isAdmin is false
		newUser.isAdmin = true;
		// console.log(newUser); //here newuser isAdmin is true
		newUser.save(function (err, result) {
			if (err) {
				locals.data.validationErrors = err.errors;
				console.log(err);
			} else {
				req.flash('success', 'Account created. Please sign in.');
				// console.log(result); //here result makes password encrypted
				// redirect to sign in page for teacher
				return res.redirect('/teachersignin');
			}
			next();
		});

	});

	// Render the view of template
	// TODO: add another layout for registration session than default
	view.render('registration');
};

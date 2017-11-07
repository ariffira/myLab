var keystone = require('keystone'),
    Types = keystone.Field.Types;

/**
 * Registration Model
 * ===================
 */
var Registration = new keystone.List('Registration');

Registration.add({
    name: { type: Types.Name, required: true, index: true },
    email: { type: Types.Email, initial: true, required: true, unique: true, index: true },
    password: { type: Types.Password, initial: true, required: true, index: true },    
    phone: { type: String, initial: true},
    institution: { type: String, initial: true, required: true },
});

Registration.register();
var keystone = require('keystone');
var Types = keystone.Field.Types;
var GeneratePBL = new keystone.List('GeneratePBL');

GeneratePBL.add({
	title: { type: String, required: true, initial: true },
	description: { type: Types.Html, wysiwyg: true, required: true, initial: true },
	image: { type: Types.CloudinaryImage, initial: true },
	startTime: { type: Types.Datetime, required: true, initial: true, index: true },
	endTime: { type: Types.Datetime, required: true, initial: true, index: true },

});

GeneratePBL.schema.virtual('canAccessKeystone').get(function () {
	return true;
});

GeneratePBL.defaultColumns = 'title, startTime, endTime';

GeneratePBL.register();


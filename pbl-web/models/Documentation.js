var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Documentation Model
 * ==========
 */
var Documentation = new keystone.List('Documentation');

Documentation.add({
	title: { type: String, required: true, initial: true },
	documentContent: { type: Types.Html, wysiwyg: true },
	// documentContent: { type: String },
	createdBy: { type: Types.Relationship, ref: 'User' },
	projectId: { type: Types.Relationship, ref: 'Project' },
	createdAt: { type: Date, default: Date.now },
});

/**
 * page registration
 */
// default columns
// Documentation.defaultColumns = '';
Documentation.register();

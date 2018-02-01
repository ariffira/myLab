var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Project Model
 * ==========
 */
var Project = new keystone.List('Project');

Project.add({
	title: { type: String, required: true, initial: true },
	description: { type: Types.Textarea },
	createdBy: { type: Types.Relationship, ref: 'User' },
	createdAt: { type: Date, default: Date.now },
	publishedAt: Date,
	file_name: { type: String },
	uploaded_file_path: { type: Types.Url },
});

/**
 * page registration
 */
// default columns
Project.defaultColumns = 'title, createdBy, createdAt';
Project.register();

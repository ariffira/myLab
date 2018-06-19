var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Presentation Model
 * ==========
 */
var Presentation = new keystone.List('Presentation');

Presentation.add({
	createdBy: { type: Types.Relationship, ref: 'User' },
	projectId: { type: Types.Relationship, ref: 'Project' },
	createdAt: { type: Date, default: Date.now },
	publishedAt: Date,
	resources_upload: { type: Types.Code, language: 'json' },
	uploaded_file_path: { type: Types.Url },
	file_name: { type: String },
});

/**
 * page registration
 */
Presentation.register();

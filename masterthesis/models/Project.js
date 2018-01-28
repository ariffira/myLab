var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Project Model
 * ==========
 */
var Project = new keystone.List('Project');
var myStorage = new keystone.Storage({
	adapter: keystone.Storage.Adapters.FS,
	fs: {
		path: 'public/uploads/files',
		publicPath: '/uploads/files',
	},
});

Project.add({
	title: { type: String, required: true, initial: true },
	description: { type: Types.Textarea },
	createdBy: { type: Types.Relationship, ref: 'User' },
	createdAt: { type: Date, default: Date.now },
	publishedAt: Date,
	file_upload: { type: Types.File, storage: myStorage },
});

/**
 * page registration
 */
// default columns
Project.defaultColumns = 'title, createdBy, createdAt';
Project.register();

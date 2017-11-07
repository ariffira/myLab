var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Showcase Model
 * ==========
 */

var Showcase = new keystone.List('Showcase', {
	map: { name: 'title' },
	autokey: { path: 'slug', from: 'title', unique: true },
});

Showcase.add({
	title: { type: String, required: true },
	state: { type: Types.Select, options: 'draft, published, archived', default: 'draft', index: true },
	image: { type: Types.CloudinaryImage },
	content: {
		brief: { type: Types.Html, wysiwyg: true, height: 150 },
		extended: { type: Types.Html, wysiwyg: true, height: 400 },
	},
});

Showcase.schema.virtual('content.full').get(function () {
	return this.content.extended || this.content.brief;
});

Showcase.defaultColumns = 'title, state|20%';
Showcase.register();

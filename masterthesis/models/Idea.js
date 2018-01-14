var keystone = require('keystone');
var Types = keystone.Field.Types;

/**
 * Idea Model
 * ==========
 */
var Idea = new keystone.List('Idea');

Idea.add({
	title: { type: String, required: true , initial: true},
	description: { type: Types.Textarea, required: true, initial: true },
	author: { type: Types.Relationship, ref: 'User' },
	createdAt: { type: Date, default: Date.now },
});

/**
 * Registration
 */
// default columns for adminUI
Idea.defaultColumns = 'title, description, author, createdAt';
Idea.register();

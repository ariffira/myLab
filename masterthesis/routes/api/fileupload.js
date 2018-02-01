var async = require('async'),
	keystone = require('keystone');
var exec = require('child_process').exec;
var fs = require('file-system');

var FileData = keystone.list('FileUpload');

/**
 * List Files
 */
exports.list = function (req, res) {
	FileData.model.find(function (err, items) {

		if (err) return res.apiError('database error', err);

		res.apiResponse({
			collections: items,
		});

	});
};

/**
 * Get File by ID
 */
exports.get = function (req, res) {

	FileData.model.findById(req.params.id).exec(function (err, item) {

		if (err) return res.apiError('database error', err);
		if (!item) return res.apiError('not found');

		res.apiResponse({
			collection: item,
		});

	});
};


/**
 * Update File by ID
 */
exports.update = function (req, res) {
	FileData.model.findById(req.params.id).exec(function (err, item) {
		if (err) return res.apiError('database error', err);
		if (!item) return res.apiError('not found');

		var data = (req.method == 'POST') ? req.body : req.query;

		item.getUpdateHandler(req).process(data, function (err) {

			if (err) return res.apiError('create error', err);

			res.apiResponse({
				collection: item,
			});

		});
	});
};

/**
 * Upload a New File
 */
exports.create = function (req, res) {

	var item = new FileData.model();
	var	data = (req.method == 'POST') ? req.body : req.query;
	item.getUpdateHandler(req).process(req.files, function (err) {

		if (err) return res.apiError('error', err);

		res.apiResponse({
			file_upload: item,
		});

	});
};

/**
 * Upload a New File
 */
exports.create1 = function (req, res) {
	var myJSON = JSON.stringify(req.files);
	console.log(myJSON.attachment.path);
	/*
	fs.readFile(req.files.attachment.file.path, function(err, data){

		var newPath = "/protected/uploads/files/"+req.files.attachment.file.name;  //log data to find your right files path
		fs.writeFile(newPath, data, function(err) {

			if(err)
			{
				console.log('Error writing file');
				console.log(err);
				res.json(null);
			}
			else
			{
				res.json({ path: newPath}); //Respond with json! This will be attached to your sir trevor block
			}
		});
	}); */
};

/**
 * Delete File by ID
 */
exports.remove = function (req, res) {
	var fileId = req.params.id;
	FileData.model.findById(req.params.id).exec(function (err, item) {

		if (err) return res.apiError('database error', err);

		if (!item) return res.apiError('not found');

		item.remove(function (err) {

			if (err) return res.apiError('database error', err);

			// Delete the file
			exec('rm public/uploads/files/' + fileId + '.*', function (err, stdout, stderr) {
				if (err) {
					console.log('child process exited with error code ' + err.code);
					return;
				}
				console.log(stdout);
			});

			return res.apiResponse({
				success: true,
			});
		});

	});
};

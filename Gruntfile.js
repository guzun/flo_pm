module.exports = function( grunt ){

	// Project configuration
	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),
		less: {
			dev: {
				options: {
					paths: ['css']
				},
				files: {
					'css/general.css': ['css/general.less']
				}
			}
		},
		watch: {
			files: 'css/*.less',
			tasks: ['less']
		}
		

	});

	// Autoload Grunt plugins
	require('load-grunt-tasks')(grunt);

	// Default task
	grunt.registerTask('default', ['watch']);

};
// See: http://24ways.org/2013/grunt-is-not-weird-and-hard/
module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		clean: {
			build: {
				src: [ 'build' ]
			},
		},

		sass: {
			build: {
				options: {
					compass: true,
					style: 'expanded'
				},
				files: {
					'build/css/style.css': 'sass/style.scss'
				}
			}
		},

		concat: {
			build: {
				src: [
					'bower_components/iOS-Orientationchange-Fix/ios-orientationchange-fix.js',
					'bower_components/jquery.fitvids/jquery.fitvids.js',
					'bower_components/jquery-placeholder/jquery.placeholder.js',
					'bower_components/picturefill/picturefill.js',
					'bower_components/svgeezy/svgeezy.js',
					'bower_components/superfish/dist/js/superfish.js',
					'js/*.js'
				],
				dest: 'build/js/scripts.js',
			}
		},

		uglify: {
			options: {
				preserveComments: 'some',
			},
			build: {
				src: 'build/js/scripts.js',
				dest: 'build/js/scripts.min.js'
			}
		},

		autoprefixer: {
			style: {
				options: {
					browsers: ['last 2 version', 'ie 8', 'ie 9'],
					cascade: true,
				},
				src: 'build/css/style.css',
				dest: 'build/css/style.css',
			}
		},

		csso: {
			compress: {
				options: {
					restructure: true,
					report: 'min'
				},
				files: {
					'build/css/style.min.css': ['build/css/style.css']
				}
			}
		},

		colorguard: {
			options: {
				threshold: 3
			},
			build: {
				src: 'build/css/style.css'
			}
		},

		imagemin: {
			build: {
				files: [{
					expand: true,
					cwd: 'images/',
					src: ['**/*.{png,jpg,gif,svg}'],
					dest: 'build/images/'
				}],
				options: {
					cache: false // Bug: https://github.com/gruntjs/grunt-contrib-imagemin/issues/140
				}
			}
		},

		watch: {
			js: {
				files: ['js/**/*.js'],
				tasks: ['concat', 'uglify'],
				options: {
					spawn: false,
				},
			},

			css: {
				files: ['sass/**/*.scss'],
				tasks: ['sass', 'autoprefixer', 'csso'],
				options: {
					spawn: false,
				}
			},

			images: {
				files: ['images/**/*'],
				tasks: ['newer:imagemin'],
				options: {
					spawn: false,
				}
			}
		}

	});

	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-csso');
	grunt.loadNpmTasks('grunt-colorguard');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-notify');

	grunt.registerTask('default', ['clean', 'sass', 'concat', 'uglify', 'imagemin', 'autoprefixer', 'csso', 'colorguard', 'watch']);

};
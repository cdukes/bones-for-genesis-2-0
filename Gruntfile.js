// See: http://24ways.org/2013/grunt-is-not-weird-and-hard/
module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		clean: {
			build: {
				src: ['build']
			}
		},

		sass: {
			options: {
				compass: true,
				style: 'expanded',
				precision: 3
			},
			build: {
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
					'js/scripts.js'
				],
				dest: 'build/js/scripts.js'
			}
		},

		uglify: {
			options: {
				preserveComments: 'some',
			},
			build: {
				files: {
					'build/js/scripts.min.js': 'build/js/scripts.js'
				}
			}
		},

		autoprefixer: {
			options: {
				cascade: true
			},
			build: {
				files: {
					'build/css/style.css': ['build/css/style.css']
				}
			}
		},

		csso: {
			options: {
				report: 'min'
			},
			build: {
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
			options: {
				cache: false // Bug: https://github.com/gruntjs/grunt-contrib-imagemin/issues/140
			},
			build: {
				files: [{
					expand: true,
					cwd: 'images/',
					src: ['**/*.{png,jpg,gif,svg}'],
					dest: 'build/images/'
				}]
			}
		},

		watch: {
			js: {
				files: ['js/**/*.js'],
				tasks: ['concat', 'uglify'],
				options: {
					spawn: false
				}
			},

			css: {
				files: ['sass/**/*.scss'],
				tasks: ['sass', 'autoprefixer', 'csso'],
				options: {
					spawn: false
				}
			},

			images: {
				files: ['images/**/*'],
				tasks: ['newer:imagemin'],
				options: {
					spawn: false
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

	grunt.registerTask('default', ['clean', 'sass', 'concat', 'uglify', 'imagemin', 'autoprefixer', 'csso', 'watch']);

};
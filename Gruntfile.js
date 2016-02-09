// See: http://24ways.org/2013/grunt-is-not-weird-and-hard/
module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		clean: {
			build: {
				src: ['build']
			}
		},

		csscomb: {
			options: {
				config: 'sass/.csscomb.json'
			},
			build: {
				expand: true,
				cwd: 'sass/',
				src: ['**/*.scss', '!_mixins.scss'],
				dest: 'sass/'
			}
		},

		sass: {
			options: {
				compass: true,
				style: 'expanded',
				precision: 3,
				sourcemap: 'none'
			},
			build: {
				files: {
					'build/css/style.css': 'sass/style.scss',
					'build/css/admin.css': 'sass/admin.scss'
				}
			}
		},

		csslint: {
			build: {
				options: {
					csslintrc: 'sass/.csslintrc'
				},
				src: [
					'build/css/style.css',
					'build/css/admin.css'
				]
			}
		},

		grunticon: {
			options: {
				compressPNG: true
			},
			build: {
				files: [{
					expand: true,
					cwd: 'svgs/',
					src: ['*.svg', '*.png'],
					dest: 'build/svgs/'
				}]
			}
		},

		jshint: {
			options: {
				globals: {
					jQuery: true
				}
			},
			build: {
				files: {
					src: ['js/**/*.js']
				}
			}
		},

		concat: {
			build: {
				src: [
					'bower_components/include-media-export/include-media.js',
					'bower_components/iOS-Orientationchange-Fix/ios-orientationchange-fix.js',
					'bower_components/jquery-placeholder/jquery.placeholder.js',
					'bower_components/jquery.fitvids/jquery.fitvids.js',
					'bower_components/js-cookie/src/js.cookie.js',
					'bower_components/superfish/dist/js/superfish.js',
					'bower_components/svgeezy/svgeezy.js',
					'build/svgs/grunticon.loader.js',
					'js/scripts.js'
				],
				dest: 'build/js/scripts.js',
				nonull: true
			},
			admin: {
				src: [
					'js/admin.js'
				],
				dest: 'build/js/admin.js',
				nonull: true
			}
		},

		uglify: {
			options: {
				preserveComments: 'some'
			},
			build: {
				files: {
					'build/js/scripts.min.js': 'build/js/scripts.js',
					'build/js/admin.min.js': 'build/js/admin.js'
				}
			}
		},

		autoprefixer: {
			options: {
				cascade: true
			},
			build: {
				files: {
					'build/css/style.css': ['build/css/style.css'],
					'build/css/admin.css': ['build/css/admin.css']
				}
			}
		},

		csso: {
			options: {
				report: 'min'
			},
			build: {
				files: {
					'build/css/style.min.css': ['build/css/style.css'],
					'build/css/admin.min.css': ['build/css/admin.css']
				}
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
				tasks: ['concat'],
				options: {
					spawn: false
				}
			},

			css: {
				files: ['sass/**/*.scss'],
				tasks: ['sass', 'autoprefixer'],
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
			},

			svgs: {
				files: ['svgs/**/*'],
				tasks: ['newer:grunticon'],
				options: {
					spawn: false
				}
			}
		}

	});

	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-csslint');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-csscomb');
	grunt.loadNpmTasks('grunt-csso');
	grunt.loadNpmTasks('grunt-grunticon');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-notify');

	grunt.registerTask('default', ['clean', 'sass', 'grunticon', 'concat', 'imagemin', 'autoprefixer', 'watch']);
	grunt.registerTask('build', ['clean', 'csscomb', 'sass', 'grunticon', 'jshint', 'concat', 'uglify', 'imagemin', 'autoprefixer', 'csso']);

};

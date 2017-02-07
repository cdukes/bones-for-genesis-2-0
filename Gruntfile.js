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
				config: 'config/csscomb.json'
			},
			build: {
				expand: true,
				cwd: 'sass/',
				src: ['**/*.scss', '!_mixins.scss'],
				dest: 'sass/'
			}
		},

		postcss: {
			scss: {
				options: {
					syntax: require('postcss-scss'),
					processors: [
						require('postcss-flexbugs-fixes')
					]
				},
				src: 'sass/**/*.scss'
			},
			css: {
				options: {
					processors: [
						require('postcss-import'),
						require('postcss-color-rgba-fallback'),
						require('postcss-easings'),
						require('postcss-focus'),
						require('postcss-assets'),
						require('autoprefixer')({
							cascade: true,
							flexbox: false
						}),
					]
				},
				src: 'build/**/*.css'
			}
		},

		sass: {
			options: {
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

		jshint: {
			options: {
				strict: true
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
					'bower_components/js-cookie/src/js.cookie.js',
					'bower_components/vanilla-fitvids/dist/fitvids.js',
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
				preserveComments: 'some',
				sourceMap: false
			},
			build: {
				files: {
					'build/js/scripts.min.js': 'build/js/scripts.js',
					'build/js/admin.min.js': 'build/js/admin.js'
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
				tasks: ['sass', 'postcss:css'],
				options: {
					spawn: false
				}
			},

			images: {
				files: ['images/**/*'],
				tasks: ['newer:imagemin', 'sass', 'postcss:css'],
				options: {
					spawn: false
				}
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-csscomb');
	grunt.loadNpmTasks('grunt-csso');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-notify');
	grunt.loadNpmTasks('grunt-postcss');

	grunt.registerTask('default', ['clean', 'imagemin', 'sass', 'concat', 'postcss:css', 'watch']);
	grunt.registerTask('build', ['clean', 'imagemin', 'csscomb', 'postcss:scss', 'sass', 'jshint', 'concat', 'uglify', 'postcss:css', 'csso']);

};

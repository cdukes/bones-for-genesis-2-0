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
						require('postcss-flexbugs-fixes'),
						require('postcss-line-height-px-to-unitless'),
						require('postcss-gradient-transparency-fix')
					]
				},
				src: 'sass/**/*.scss'
			},
			css: {
				options: {
					processors: [
						require('postcss-import'),
						require('postcss-assets'),
						require('postcss-color-rgba-fallback'),
						require('postcss-focus'),
						require('postcss-will-change'),
						require('autoprefixer')({
							cascade: true,
							flexbox: false
						})
					]
				},
				src: 'build/css/**/*.css'
			},
			mainOnly: {
				options: {
					processors: [
						require('postcss-normalize')({
							forceImport: true
						})
					]
				},
				src: 'build/css/style.css'
			}
		},

		jshint: {
			options: {
				strict: true,
				laxbreak: true,
				esversion: 6
			},
			build: {
				files: {
					src: ['js/**/*.js']
				}
			}
		},

		eslint: {
			options: {
				configFile: 'config/eslint.json',
				fix: true
			},
			build: {
				files: {
					src: ['js/**/*.js']
				}
			}
		},

		shell: {
			prettier: {
				command: 'prettier --use-tabs --single-quote --parser=flow --write js/**/*.js'
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

		svg_sprite: {
			options: {
				mode: {
					symbol: {
						inline: true,
						sprite: 'icons.svg',
						dest: '.'
					},
				},
				shape: {
					dimension: {
						maxWidth: 100,
						maxHeight: 100,
						precision: 3
					},
					id: {
						generator: function(name) {
							return 'icon-' + name.replace('.svg', '');
						}
					}
				},
				svg: {
					xmlDeclaration: false,
					doctypeDeclaration: false,
					dimensionAttributes: false
				}
			},
			build: {
				expand: true,
				cwd: 'svgs',
				src: ['**/*.svg'],
				dest: 'build/svgs'
			},
		},

		sass: {
			options: {
				style: 'expanded',
				precision: 3
			},
			build: {
				files: {
					'build/css/style.css': 'sass/style.scss',
					'build/css/admin.css': 'sass/admin.scss'
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

		webpack: {
			build: require('./config/webpack.config')
		},

		concat: {
			scripts: {
				src: [
					'build/js/scripts.js',
				],
				dest: 'build/js/scripts.js',
				nonull: true
			},
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

		watch: {
			js: {
				files: ['js/**/*.js'],
				tasks: ['webpack', 'concat'],
				options: {
					spawn: false
				}
			},

			css: {
				files: ['sass/**/*.scss'],
				tasks: ['sass', 'postcss:css', 'postcss:mainOnly'],
				options: {
					spawn: false
				}
			},

			images: {
				files: ['images/**/*'],
				tasks: ['newer:imagemin', 'sass', 'postcss:css', 'postcss:mainOnly'],
				options: {
					spawn: false
				}
			},

			svgs: {
				files: ['svgs/**/*.svg'],
				tasks: ['svg_sprite'],
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
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-csscomb');
	grunt.loadNpmTasks('grunt-csso');
	grunt.loadNpmTasks('grunt-eslint');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-notify');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-shell');
	grunt.loadNpmTasks('grunt-svg-sprite');
	grunt.loadNpmTasks('grunt-webpack');

	grunt.registerTask(
		'default',
		[
			// Remove old files
			'clean',

			// Build images
			'imagemin',

			// Build SVGs
			'svg_sprite',

			// Build CSS
			'sass',
			'postcss:css',
			'postcss:mainOnly',

			// Build JS
			'webpack',
			'concat',

			// Watch for changes
			'watch'
		]
	);

	grunt.registerTask(
		'build',
		[
			// Remove old files
			'clean',

			// Cleanup CSS
			'csscomb',
			'postcss:scss',

			// Cleanup JS
			'jshint',
			'eslint',
			'shell',

			// Build images
			'imagemin',

			// Build SVGs
			'svg_sprite',

			// Build CSS
			'sass',
			'postcss:css',
			'postcss:mainOnly',
			'csso',

			// Build JS
			'webpack',
			'concat',
			'uglify',
		]
	);


};

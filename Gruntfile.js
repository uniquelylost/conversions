module.exports = function(grunt) {
	
	// Force use of Unix newlines
	grunt.util.linefeed = '\n';
	
	// Configuration
	grunt.initConfig({
		sass: {
			dist: {
				options: {
					style: 'nested',
					precision: 5,
				},
				files: {
					'build/theme.css': 'sass/theme.scss',
					'build/font-awesome.css': 'sass/font-awesome.scss',
					'build/gutenberg-editor-style.css': 'sass/gutenberg-editor-style.scss',
					'build/classic-editor-style.css': 'sass/classic-editor-style.scss',
					'build/conversions-customizer.css': 'sass/customizer.scss',
				}
			}
		},
		concat: {
			basic_and_extras: {
				files: {
					'build/theme.js': ['node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'js/skip-link-focus-fix.js', 'node_modules/slick-carousel/slick/slick.js', 'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.js', 'js/theme.js'],
					'build/conversions-customizer.js': ['js/conversions-repeater.js', 'js/fontawesome-iconpicker.js', 'js/customizer-conditionals.js', 'js/homepage_sorting.js'],
					'build/theme.css': ['build/theme.css', 'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.css'],
				},
			},
		},
		lineending: {
			dist: {
				options: {
					eol: 'lf'
				},
				files: {
					'build/theme.css': ['build/theme.css'],
					'build/theme.js': ['build/theme.js'],
				}
			}
		},
		postcss: {
			options: {
				processors: [
					require('autoprefixer')({
						overrideBrowserslist: ['> 0.5%, last 2 versions, Firefox ESR, not dead']
					})
				]
			},
			dist: {
				src: 'build/theme.css'
			}
		},
		rtlcss: {
			myTask:{
				options: {
					opts: {
						clean:false
					},
				},
				expand : true,
				src    : ['build/theme.css'],
				ext    : '.rtl.css'
			}
		},
		cssmin: {
			target: {
				files: {
					'build/theme.min.css': ['build/theme.css'],
					'build/theme.rtl.min.css': ['build/theme.rtl.css'],
					'build/font-awesome.min.css': ['build/font-awesome.css'],
					'build/gutenberg-editor-style.min.css': ['build/gutenberg-editor-style.css'],
					'build/classic-editor-style.min.css': ['build/classic-editor-style.css'],
					'build/conversions-customizer.min.css': ['build/conversions-customizer.css'],
				}
			}
		},
		uglify: {
			options: {
				mangle: false,
			},
			my_target: {
				files: {
					'build/theme.min.js': ['build/theme.js'],
					'build/conversions-customizer.min.js': ['build/conversions-customizer.js'],
				}
			}
		},
		watch: {
			sass: {
				files: ['sass/*.scss'],
				tasks: ['all'],
			},
			scripts: {
				files: ['js/*.js'],
				tasks: ['all'],
			},
		},
		copy: {
			main: {
				files: [
					// includes files within path
					{ 
						expand: true,
						flatten: true,
						src: ['node_modules/@fortawesome/fontawesome-free/webfonts/*'], 
						dest: 'fonts/',
						filter: 'isFile'
					},
					{ 
						expand: true,
						flatten: true,
						src: ['node_modules/slick-carousel/slick/fonts/*'], 
						dest: 'fonts/',
						filter: 'isFile'
					},
				],
			},
		},
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('@lodder/grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-rtlcss');
	grunt.loadNpmTasks('grunt-lineending');
	
	// Run All Tasks
	grunt.registerTask('all', ['sass', 'concat', 'lineending', 'postcss', 'rtlcss', 'cssmin', 'uglify', 'copy']);

};